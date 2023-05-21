<?php

namespace App\Http\Controllers;

use App\Casefile;
use App\CasefileEvidence;
use App\Post;
use File;
use Redirect;
use Illuminate\Http\Request;

class CasefileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('casefile.list')->with([
            'casefiles' => Casefile::get()
        ]);
    }

    /**
     * Display a listing of the file cases.
     *
     * @return \Illuminate\Http\Response
     */
    public function filedcases()
    {
        return view('casefile.filedcases')->with([
            'casefiles' => Casefile::where('status', '!=', 'initiating')->get() 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('casefile.create')->with([
            'post' => $post
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:2', 'max:30'],
            'status' => ['required', 'in:initiating,filed,hearings,justified,rejected'],
            'post_id' => 'required|integer|exists:posts,id|min:1|max:10',
            'file_url' => ['nullable','string', 'min:5', 'max:191'],
            'case_id' => ['nullable','string', 'min:5', 'max:191'],
            'court_name' => ['nullable','string', 'min:5', 'max:191'],
            'body' => ['required', 'string', 'min:5'],
            'evidence_title' => ['required', 'string', 'min:2', 'max:30'],
            'evidence_data' => ['required']
        ]);

        $extention = $request->evidence_data->getClientOriginalExtension();
        if ($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png' || $extention == 'gif')
            $type = 'image';

        else if ($extention == 'mp3')
            $type = 'audio';

        else if ($extention == 'mp4' || $extention == 'mpeg')
            $type = 'video';
            
        else if ($extention == 'txt' || $extention == 'doc' || $extention == 'docx' || $extention == 'pdf')
            $type = 'text';
        else
            return back()->withStatus('Invalid file type. Upload a file of type jpg, jpeg, png, gif, mp3, mp4, mpeg, txt, doc, docx, pdf only.');
        
        $casefile = new Casefile();
        $casefile->title = $request->title;
        $casefile->post_id = $request->post_id;
        $casefile->user_id = auth()->user()->id;
        $casefile->status = $request->status;
        $casefile->body = $request->body;
        $casefile->file_url = $request->file_url;
        $casefile->case_id = $request->case_id;
        $casefile->court_name = $request->court_name;
        $casefile->save();

        $evidence = new CasefileEvidence();
        $evidence->title = $request->evidence_title;
        $evidence->casefile_id = $casefile->id;
        $evidence->type = $type;
        $evidence->data = "filler";
        $evidence->save();

        $fileName = $evidence->id.'.'.$extention; 
        $path = public_path().'\\data\\casefiles\\'.$casefile->id;

        if (!File::exists($path))
            File::makeDirectory($path, $mode = 0777, true, true);
        
        $request->evidence_data->move($path, $fileName);
        $evidence->data = $fileName;
        $evidence->save();

        return Redirect::route('casefile.show', $casefile->id)->withStatus(__('Successfully generated the case file!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Casefile  $casefile
     * @return \Illuminate\Http\Response
     */
    public function show(Casefile $casefile)
    {
        $evidences = $casefile->evidences;
        return view('casefile.details')->with([
            'casefile' => $casefile,
            'images' => $evidences->where('type', 'image'),
            'audios' => $evidences->where('type', 'audio'),
            'videos' => $evidences->where('type', 'video'),
            'texts'  => $evidences->where('type', 'text'),
            'username' => $casefile->user->name,
            'post' => $casefile->post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Casefile  $casefile
     * @return \Illuminate\Http\Response
     */
    public function edit(Casefile $casefile)
    {
        if (auth()->user()->id != $casefile->user->id)
            return back()->withStatus(__('Your are not authorised to edit this file'));

        return view('casefile.edit')->with([
            'casefile' => $casefile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Casefile  $casefile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Casefile $casefile)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:2', 'max:30'],
            'status' => ['required', 'in:initiating,filed,hearings,justified,rejected'],
            'file_url' => ['nullable','string', 'min:5', 'max:191'],
            'case_id' => ['nullable','string', 'min:5', 'max:191'],
            'court_name' => ['nullable','string', 'min:5', 'max:191'],
            'body' => ['required', 'string', 'min:5'],
        ]);
        if (auth()->user()->id != $casefile->user->id)
            return back()->withStatus(__('Your are not authorised to edit this file'));
        
        $casefile->title = $request->title;
        $casefile->status = $request->status;
        $casefile->body = $request->body;
        $casefile->file_url = $request->file_url;
        $casefile->case_id = $request->case_id;
        $casefile->court_name = $request->court_name;
        $casefile->save();

        return Redirect::route('casefile.show', $casefile->id)->withStatus(__('Successfully updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Casefile  $casefile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Casefile $casefile)
    {
        if (auth()->user()->id != $casefile->user->id)
            return back()->withStatus(__('Your are not authorised to edit this file'));
        if ($casefile->evidences->count() != 0)
            return back()->withStatus(__('Your case file has atleast one evidence so it cannot be deleted!'));
        
        $casefile->delete();
        File::deleteDirectory(public_path().'\\data\\casefiles\\'.$casefile->id);
        return redirect()->route('home')->withStatus(__('Case file successfully deleted.'));
    }
}
