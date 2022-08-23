<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'created_at',
        'updated_at',
    ];

    // Morph?
    public function likes()
    {
        return $this->morphMany(Like::class, 'liked');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
