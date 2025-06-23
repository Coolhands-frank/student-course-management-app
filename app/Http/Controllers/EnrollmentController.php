<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class EnrollmentController extends Controller
{
     /**
     * Display a listing of enrollments (students with their enrolled courses).
     */
    public function index()
    {
        $students = Student::with('courses')->latest()->paginate(6);
        return view('enrollments.index', compact('students'));
    }

    /**
     * Show the form for creating a new enrollment.
     */
    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('enrollments.create', compact('students', 'courses'));
    }
}
