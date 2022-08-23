<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_liked',
        'created_at',
        'updated_at',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function jobVacancies()
    {
        return $this->belongsTo(JobVacancy::class);
    }

    public function liked()
    {
        return $this->morphTo();
    }
}
