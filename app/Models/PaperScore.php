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

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}