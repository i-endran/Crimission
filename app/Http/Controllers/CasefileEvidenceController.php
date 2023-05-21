<?php

namespace App\Http\Controllers;

use App\CasefileEvidence;
use App\Casefile;
use File;
use Redirect;
use Illuminate\Http\Request;

class CasefileEvidenceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Casefile $casefile)
    {
        if (auth()->user()->id != $casefile->user->id)
            return back()->withStatus(__('Your are not authorised to add evidence to this file'));

        return view('casefileevidence.create')->with([
            'casefile' => $casefile,
            'evidence_titles' => CasefileEvidence::select('title')->where('casefile_id', $casefile->id)->get()
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
            'title' => ['required', 'string', 'min:3', 'max:30'],
            'casefile_id' => 'required|integer|exists:casefiles,id|min:1|max:10',
            'file' => ['required']
        ]);

        if (auth()->user()->id != Casefile::find($request->casefile_id)->user->id)
            return back()->withStatus(__('Your are not authorised to add evidence to this file'));

        $extention = $request->file->getClientOriginalExtension();
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

        $evidence = new CasefileEvidence();
        $evidence->title = $request->title;
        $evidence->casefile_id = $request->casefile_id;
        $evidence->type = $type;
        $evidence->data = "filler";
        $evidence->save();

        $fileName = $evidence->id.'.'.$extention; 
        $path = public_path().'\\data\\casefiles\\'.$request->casefile_id;

        if (!File::exists($path))
            File::makeDirectory($path, $mode = 0777, true, true);
        
        $request->file->move($path, $fileName);
        $evidence->data = $fileName;
        $evidence->save();

        return Redirect::route('casefileevidence.create', $request->casefile_id)->withStatus(__('Successfully created evidence!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CasefileEvidence  $casefileEvidence
     * @return \Illuminate\Http\Response
     */
    public function edit(CasefileEvidence $casefileEvidence)
    {
        if (auth()->user()->id != $casefileEvidence->casefile->user->id)
            return back()->withStatus(__('Your are not authorised to add evidence to this file'));

        return view('casefileevidence.edit')->with([
            'evidence' => $casefileEvidence,
            'casefile' => $casefileEvidence->casefile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CasefileEvidence  $casefileEvidence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CasefileEvidence $casefileEvidence)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:30'],
            'casefile_id' => 'required|integer|exists:casefiles,id|min:1|max:10',
        ]);

        if (auth()->user()->id != Casefile::find($request->casefile_id)->user->id)
            return back()->withStatus(__('Your are not authorised to edit this evidence.'));
        if ($request->casefile_id != $casefileEvidence->casefile_id)
            return back()->withStatus('Invalid funtion. Cannot change the parent file!');
        
        $casefileEvidence->title = $request->title;
        if ($request->file == null) {
            $casefileEvidence->save();
            return Redirect::route('casefile.show', $casefileEvidence->casefile_id)->withStatus('Successfully updated the evidence:'.$casefileEvidence->title.' with same file!');
        }

        $extention = $request->file->getClientOriginalExtension();
        if ($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png' || $extention == 'gif')
            $casefileEvidence->type = 'image';

        else if ($extention == 'mp3')
            $casefileEvidence->type = 'audio';

        else if ($extention == 'mp4' || $extention == 'mpeg')
            $casefileEvidence->type = 'video';
            
        else if ($extention == 'txt' || $extention == 'doc' || $extention == 'docx' || $extention == 'pdf')
            $casefileEvidence->type = 'text';
        else
            return back()->withStatus('Invalid file type. Upload a file of type jpg, jpeg, png, gif, mp3, mp4, mpeg, txt, doc, docx, pdf only.');
        
        $fileName = $casefileEvidence->id.'.'.$extention; 
        $path = public_path().'\\data\\casefiles\\'.$casefileEvidence->casefile_id;
        if (File::exists($path.'\\'.$casefileEvidence->data))
            File::delete($path.'\\'.$casefileEvidence->data);
        else if (!File::exists($path))
            File::makeDirectory($path, $mode = 0777, true, true);
            
        $newFileName = $casefileEvidence->id.'.'.$extention;
        $request->file->move($path, $newFileName);
        $casefileEvidence->data = $newFileName;
        $casefileEvidence->save();

        return Redirect::route('casefile.show', $casefileEvidence->casefile_id)->withStatus('Successfully updated the evidence:'.$casefileEvidence->title.'!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CasefileEvidence  $casefileEvidence
     * @return \Illuminate\Http\Response
     */
    public function destroy(CasefileEvidence $casefileEvidence)
    {
        if (auth()->user()->id != $casefileEvidence->casefile->user->id)
            return back()->withStatus(__('Your are not authorised to delete this evidence.'));
        
        $path = public_path().'\\data\\casefiles\\'.$casefileEvidence->casefile_id;
        if (File::exists($path.'\\'.$casefileEvidence->data))
                File::delete($path.'\\'.$casefileEvidence->data);

        $casefileEvidence->delete();
        return Redirect::route('casefile.show', $casefileEvidence->casefile_id)->withStatus('Successfully deleted the evidence!'); 
    }
}
