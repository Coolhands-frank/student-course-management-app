<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_code',
        'course_name',
        'description',
        'unit',
    ];

    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;
}
