<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaperScore extends Model
{
    protected $fillable = [
        'paper_id',
        'user_id',
        'admin_id',
        'score',
    ];
}