<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FacultyDepartment;
use Illuminate\Http\Request;

class FacultyDepartmentController extends Controller
{
    public function index()
    {
        return response()->json(
            FacultyDepartment::with(['users', 'courses', 'contactForms'])->get(),
            200
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'study_tracks' => 'required|string',
            'acquired_skills' => 'required|string',
            'introduction_paragraph' => 'required|string',
        ]);

        return response()->json(
            FacultyDepartment::create($validated),
            201
        );
    }

    public function show($id)
    {
        return response()->json(
            FacultyDepartment::with(['users', 'courses', 'contactForms'])->findOrFail($id),
            200
        );
    }

    public function update(Request $request, $id)
    {
        $faculty = FacultyDepartment::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'study_tracks' => 'sometimes|string',
            'acquired_skills' => 'sometimes|string',
            'introduction_paragraph' => 'sometimes|string',
        ]);

        $faculty->update($validated);
        return response()->json($faculty);
    }

    public function destroy($id)
    {
        $faculty = FacultyDepartment::findOrFail($id);
        $faculty->delete();

        return response()->json(null, 204);
    }
}
