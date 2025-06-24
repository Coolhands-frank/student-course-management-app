<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = ['name', 'email', 'gender', 'date_of_birth', 'address'];

    /**
     * Get the courses that the student is enrolled in.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student');
    }
}
