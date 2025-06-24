<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    protected $fillable = [
        'course_code',
        'course_name',
        'description',
        'unit',
    ];

    /**
     * Get the students enrolled in this course.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student');
    }

}
