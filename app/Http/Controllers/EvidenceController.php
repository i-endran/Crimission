<?php

namespace App\Http\Controllers;

use App\Evidence;
use App\Post;
use Illuminate\Http\Request;
use File;
use Redirect;

class EvidenceController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('evidences.create')->with([
            'post' => $post,
            'evidence_titles' => Evidence::select('title')->where('post_id', $post->id)->get()
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
            'mac' => ['required', 'string', 'min:6', 'max:191'],
            'post_id' => 'required|integer|exists:posts,id|min:1|max:10',
            'file' => ['required']
        ]);
        
        if ($request->file == null)
            return Redirect::back()->withErrors(['file','Please attach a media file.']);

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

        $evidence = new Evidence();
        $evidence->title = $request->title;
        $evidence->mac = $request->mac;
        $evidence->type = $type;
        $evidence->post_id = $request->post_id;
        $evidence->data = 'filename';
        $evidence->save();
        
        $fileName = $evidence->id.'.'.$extention; 

        $path = public_path().'\\data\\posts\\'.$evidence->post_id;
        if (!File::exists($path))
            File::makeDirectory($path, $mode = 0777, true, true);
        
        $request->file->move($path, $fileName);
        $evidence->data = $fileName;
        $evidence->save();

        return Redirect::route('evidence.create', $evidence->post_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function edit(Evidence $evidence)
    {
        return view('evidences.edit')->with([
            'evidence' => $evidence,
            'post' => $evidence->post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evidence $evidence)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:30'],
            'mac' => ['required', 'string', 'min:6', 'max:191'],
            'post_id' => 'required|integer|exists:posts,id|min:1|max:10',
            'file' => ['required']
        ]);
        if ($request->mac != $evidence->mac)
            return back()->withStatus('Invalid Secrety key!');
        if ($request->post_id != $evidence->post_id)
            return back()->withStatus('Invalid funtion. Cannot change the parent post!');
        
        $path = public_path().'\\data\\posts\\'.$evidence->post_id;
        
        $evidence->title = $request->title;
        if ($request->file == null) {
            $evidence->save();
            return Redirect::route('post.show', $evidence->post_id)->withStatus('Successfully updated the evidence:'.$evidence->title.' with same file!');
        }

        $extention = $request->file->getClientOriginalExtension();
        if ($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png' || $extention == 'gif')
            $evidence->type = 'image';

        else if ($extention == 'mp3')
            $evidence->type = 'audio';

        else if ($extention == 'mp4' || $extention == 'mpeg')
            $evidence->type = 'video';
            
        else if ($extention == 'txt' || $extention == 'doc' || $extention == 'docx' || $extention == 'pdf')
            $evidence->type = 'text';
        else
            return back()->withStatus('Invalid file type. Upload a file of type jpg, jpeg, png, gif, mp3, mp4, mpeg, txt, doc, docx, pdf only.');
        
        if (File::exists($path.'\\'.$evidence->data))
            File::delete($path.'\\'.$evidence->data);
        else if (!File::exists($path))
            File::makeDirectory($path, $mode = 0777, true, true);
            
        $newFileName = $evidence->id.'.'.$extention;
        $request->file->move($path, $newFileName);
        $evidence->data = $newFileName;
        $evidence->save();

        return Redirect::route('post.show', $evidence->post_id)->withStatus('Successfully updated the evidence:'.$evidence->title.' !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Evidence $evidence)
    {
        $validatedData = $request->validate([
            'mac' => ['required', 'string', 'min:6', 'max:191']
        ]);
        if ($request->mac != $evidence->mac)
            return Redirect::back()->withStatus(__('Secret key invalid! Cannot delete the evidence.'));
        
        $path = public_path().'\\data\\posts\\'.$evidence->post_id;
        if (File::exists($path.'\\'.$evidence->file))
                File::delete($path.'\\'.$evidence->file);

        $evidence->delete();
        return Redirect::route('post.show', $evidence->post_id)->withStatus('Successfully deleted the evidence!');
    }
}
