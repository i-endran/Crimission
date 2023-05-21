<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    /**
     * Show settings page
     *
     * @return \Illuminate\Http\RedirectResponse
     * profile.settings
     */
    public function settings()
    {
        return view('profile.settings');
    }

    /**
     * Remove the user from storage
     *
     * @return \Illuminate\Http\RedirectResponse
     * profile.delete
     */
    public function deleteuser()
    {
        $user = User::find(Auth::user()->id);
        
        if ($user->delete()) {
            Auth::logout();
            return redirect()->route('landpage')->withStatus(__('Account successfully deleted.'));
        }
        else
            return back()->withStatus(__('Cannot delete try again later'));
    }
}