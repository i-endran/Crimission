<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'mac', 'priority', 'privacy', 'post_type', 'accused', 'accused_details', 'locality', 'status', 'body'
    ];
    
    public function evidences() {
        return $this->hasMany('App\Evidence');
    }

    public function casefile() {
        return $this->hasMany('App\Casefile');
    }
    //$post::find(1)->evidences;
    //$post = App\Post::all()[0];
    //first(), latest()
}