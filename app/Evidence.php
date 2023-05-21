<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    protected $table = 'evidences';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'mac', 'data', 'post_id', 'type'
    ];

    public function post() {
        return $this->belongsTo('App\Post');
    }
}
