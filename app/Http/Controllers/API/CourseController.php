<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CourseController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        $courses = Cache::remember('courses_page_' . $page, 60, function () {
            return Course::with(['facultyDepartment', 'videos'])->paginate(10);
        });
        return response()->json($courses, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description_paragraph' => 'required|string',
            'duration' => 'required|string',
            'number_of_lessons' => 'required|integer',
            'instructor_name' => 'required|string',
            'faculty_department_id' => 'required|exists:faculty_departments,id',
            'image' => 'nullable|image|max:2048',
            'videos.*' => 'nullable|file|mimetypes:video/mp4,video/x-msvideo,video/quicktime|max:50000'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('courses', 'public');
            $validated['image'] = $path;
        }

        $course = Course::create($validated);

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $videoFile) {
                $videoPath = $videoFile->store('course_videos', 'public');
                $course->videos()->create(['video_path' => $videoPath]);
            }
        }

        return response()->json($course->load(['facultyDepartment', 'videos']), 201);
    }

    public function show($id)
    {
        return response()->json(Course::with(['facultyDepartment', 'videos'])->findOrFail($id), 200);
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
            'faculty_department_id' => 'sometimes|exists:faculty_departments,id',
            'image' => 'nullable|image|max:2048',
            'videos.*' => 'nullable|file|mimetypes:video/mp4,video/x-msvideo,video/quicktime|max:50000'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('courses', 'public');
            $validated['image'] = $path;
        }

        $course->update($validated);

        // حذف الفيديوهات القديمة (اختياري)
        $course->videos()->delete();

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $videoFile) {
                $videoPath = $videoFile->store('course_videos', 'public');
                $course->videos()->create(['video_path' => $videoPath]);
            }
        }

        return response()->json($course->load(['facultyDepartment', 'videos']));
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return response()->json(null, 204);
    }
}
