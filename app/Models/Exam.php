<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['title', 'exam_day'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}