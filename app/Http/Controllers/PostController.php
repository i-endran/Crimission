<?php

namespace App\Http\Controllers;

use App\Post;
use App\Evidence;
use Illuminate\Http\Request;
use Redirect;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  GET:post/create
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // POST:post
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:2', 'max:30'],
            'mac' => ['required', 'string', 'min:6', 'max:191'],
            'priority' => ['required', 'in:simple,moderate,high,extreme'],
            'privacy' => ['required', 'in:private,local,public'],
            'post_type' => ['required', 'string', 'max:25'],
            'accused' => ['required', 'string', 'min:2', 'max:30'],
            'accused_details' => ['required', 'string', 'min:3', 'max:30'],
            'locality' => ['required', 'string', 'min:3', 'max:20'],
            'status' => ['required', 'in:pending,validated,pushed,completed,rejected'],
            'body' => ['required', 'string', 'min:5']
        ]);
        $post = new Post();
        $post->fill($request->only($post->getFillable()))->save();
        return Redirect::route('post.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    //  GET:post/{post}
    public function show(Post $post)
    {
        $evidences = Evidence::select('id','data','type')->where('post_id', $post->id)->get();

        return view('posts.postdetails')->with([
            'post' => $post,
            'images' => $evidences->where('type', 'image'),
            'audios'  => $evidences->where('type', 'audio'),
            'videos' => $evidences->where('type', 'video'),
            'texts'   => $evidences->where('type', 'text'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit')->with([
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:2', 'max:30'],
            'mac' => ['required', 'string', 'min:6', 'max:191'],
            'priority' => ['required', 'in:simple,moderate,high,extreme'],
            'privacy' => ['required', 'in:private,local,public'],
            'post_type' => ['required', 'string', 'max:25'],
            'accused' => ['required', 'string', 'min:2', 'max:30'],
            'accused_details' => ['required', 'string', 'min:3', 'max:50'],
            'locality' => ['required', 'string', 'min:3', 'max:20'],
            'status' => ['required', 'in:pending,validated,pushed,completed,rejected'],
            'body' => ['required', 'string', 'min:5']
        ]);
        if ($post->mac != $request->mac)
            return back()->withStatus(__('Secret key invalid!'));

        $post->fill($request->only($post->getFillable()))->save();
        return Redirect::route('post.show', $post->id)->withStatus(__('Successfully updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'mac' => ['required', 'string', 'min:6', 'max:191']
        ]);
        if ($request->mac != $post->mac)
            return back()->withStatus(__('Secret key invalid! Cannot delete the post.'));
        if ($post->evidences->count() != 0)
            return back()->withStatus(__('Your post has atleast one evidence so it cannot be deleted!'));
        
        $post->delete();
        File::deleteDirectory(public_path().'\\data\\posts\\'.$post->id);
        return redirect()->route('home')->withStatus(__('Post successfully deleted.'));
    }

    public function search(Request $request)
    {
        if ($request->post_id == null)
            return back();
        
        $post = Post::find($request->post_id);
        if ($post == null)
            return abort(404);
        return redirect()->route('post.show', $post);
    }
}
