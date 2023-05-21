<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Feedback;

class CommunityController extends Controller
{
    public function __constructor()
    {
        $this->middleware('auth', ['except' => ['about']]);
    }

    /**
     * Showing the about page.
     *
     * @return \Illuminate\Http\Response
     */
    //  GET:about
    public function about()
    {
        return view('community.about');
    }

    /**
     * Showing the Feedback form.
     *
     * @return \Illuminate\Http\Response
     */
    //  GET:feedback.create
    public function create()
    {
        return view('community.feedback');
    }

    /**
     * Saving the Feedback form.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //  POST:feedback.store
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:2|max:30',
            'body' => 'required|min:10'
        ]);
        $feedback = new Feedback();
        $feedback->title = $request->title;
        $feedback->body = $request->body;
        $feedback->user_id = auth()->user()->id;
        $feedback->save();
        return back()->withStatus(__('Feedback submitted successfully. You will be notified about this. Thanks for using Crimission!'));
    }
}
