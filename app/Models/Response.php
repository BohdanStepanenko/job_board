<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
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
}
