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

    /**
     * Show the form for editing an existing enrollment.
     */
    public function edit(Student $student)
    {
        // Load the courses associated with the student
        $student->load('courses');
        $allCourses = Course::all();

        // Get the IDs of courses the student is already enrolled in
        $enrolledCourseIds = $student->courses->pluck('id')->toArray();

        return view('enrollments.edit', compact('student', 'allCourses', 'enrolledCourseIds'));
    }

    /**
     * Update the specified enrollment in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'course_ids' => 'nullable|array', // Can be empty if all courses are unassigned
            'course_ids.*' => 'exists:courses,id',
        ]);

        // If course_ids is null (no courses selected), sync an empty array to detach all
        $student->courses()->sync($request->input('course_ids', []));

        return redirect()->route('enrollments.index')
                         ->with('success', 'Enrollment updated successfully.');
    }

}
