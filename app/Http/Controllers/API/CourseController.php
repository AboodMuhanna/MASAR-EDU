<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return response()->json(
        Course::with('facultyDepartment')->take(50)->get(),
            200
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description_paragraph' => 'required|string',
            'duration' => 'required|string',
            'number_of_lessons' => 'required|integer',
            'instructor_name' => 'required|string',
            #'faculty_department_id' => 'required|exists:faculty_departments,id'
            'faculty_department_id' => 'required|exists:faculty_departments,id',

        ]);

        return response()->json(
            Course::create($validated),
            201
        );
    }

    public function show($id)
    {
        return response()->json(
            Course::with('facultyDepartment')->findOrFail($id),
            200
        );
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string',
            'description_paragraph' => 'sometimes|string',
            'duration' => 'sometimes|string',
            'number_of_lessons' => 'sometimes|integer',
            'instructor_name' => 'sometimes|string',
            'faculty_department_id' => 'sometimes|exists:faculty_departments,id'
        ]);

        $course->update($validated);
        return response()->json($course->load('facultyDepartment'));
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json(null, 204);
    }
}
