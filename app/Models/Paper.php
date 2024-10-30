<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = [
        'code',
        'title',
        'max_score',
    ];

    public function scores()
    {
        return $this->hasMany(PaperScore::class);
    }
}