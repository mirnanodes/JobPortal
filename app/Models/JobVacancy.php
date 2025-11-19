<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'company',
        'salary',
        'job_type',
        'logo',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}
