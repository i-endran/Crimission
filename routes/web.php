<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('landpage');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('about', ['as' => 'about', 'uses' => 'CommunityController@about']);

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);

	Route::get('activity', ['as' => 'user.activity', 'uses' => 'UserController@activity']);
	
	Route::resource('post', 'PostController', ['except' => ['index']]);
	Route::get('search', ['as' => 'post.search', 'uses' => 'PostController@search']);

	Route::resource('casefile', 'CasefileController', ['except' => ['create']]);
	Route::get('casefile/{post}/create', ['as' => 'casefile.create', 'uses' => 'CasefileController@create']);
	
	Route::get('filedcases', ['as' => 'filedcases', 'uses' => 'CasefileController@filedcases']);
	
	Route::get('casefileevidence/{casefile}/create', ['as' => 'casefileevidence.create', 'uses' => 'CasefileEvidenceController@create']);
	Route::post('casefileevidence', ['as' => 'casefileevidence.store', 'uses' => 'CasefileEvidenceController@store']);
	Route::get('casefileevidence/{casefileEvidence}/edit', ['as' => 'casefileevidence.edit', 'uses' => 'CasefileEvidenceController@edit']);
	Route::put('casefileevidence/{casefileEvidence}', ['as' => 'casefileevidence.update', 'uses' => 'CasefileEvidenceController@update']);
	Route::delete('casefileevidence/{casefileEvidence}', ['as' => 'casefileevidence.destroy', 'uses' => 'CasefileEvidenceController@destroy']);
	
	Route::resource('evidence', 'EvidenceController', ['except' => ['create', 'index', 'show']]);
	Route::get('evidence/{post}', ['as' => 'evidence.create', 'uses' => 'EvidenceController@create']);
	
	Route::get('feedback', ['as' => 'feedback.create', 'uses' => 'CommunityController@create']);
	Route::post('feedback', ['as' => 'feedback.store', 'uses' => 'CommunityController@store']);
	
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	
	Route::get('settings', ['as' => 'profile.settings', 'uses' => 'ProfileController@settings']);
	Route::delete('settings/delete', ['as' => 'profile.delete', 'uses' => 'ProfileController@deleteuser']);
});

