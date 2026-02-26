<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{

    use SoftDeletes;

    public $fillable = [
        'name',
        'party',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
