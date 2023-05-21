<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casefile extends Model
{
    protected $table = 'casefiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'post_id', 'user_id', 'status', 'body', 'file_url', 'case_id', 'court_name'
    ];

    public function post() {
        return $this->belongsTo('App\Post');
    }

    public function evidences() {
        return $this->hasMany('App\CasefileEvidence');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
