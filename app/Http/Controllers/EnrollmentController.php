<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;

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

    /**
     * Store a newly created enrollment (assign courses to a student).
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $student = Student::find($request->student_id);

        $student->courses()->sync($request->course_ids);

        return redirect()->route('enrollments.index')
                         ->with('success', 'Enrollment updated successfully.');
    }

}
