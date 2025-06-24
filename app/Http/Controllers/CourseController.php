<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::latest()->paginate(6);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string|max:255|unique:courses',
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'unit' => 'required|integer|min:1|max:15',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')
                         ->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        // Load students for the course show page if needed
        $course->load('students');
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('courses')->ignore($course->id),
            ],
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'unit' => 'required|integer|min:1',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')
                         ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
                         ->with('success', 'Course deleted successfully.');
    }
}
