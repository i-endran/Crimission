<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasefileEvidence extends Model
{
    protected $table = 'casefile_evidences';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'data', 'casefile_id', 'type'
    ];

    public function casefile() {
        return $this->belongsTo('App\Casefile');
    }
}
