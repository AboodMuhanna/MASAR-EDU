<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function index()
    {
        return response()->json(
            ContactForm::with('facultyDepartment')->get(),
            200
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message_title' => 'required|string',
            'message' => 'required|string',
            'faculty_department_id' => 'required|exists:faculty_departments,id',
        ]);

        return response()->json(
            ContactForm::create($validated),
            201
        );
    }

    public function show($id)
    {
        return response()->json(
            ContactForm::with('facultyDepartment')->findOrFail($id),
            200
        );
    }

    public function update(Request $request, $id)
    {
        $form = ContactForm::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email',
            'message_title' => 'sometimes|string',
            'message' => 'sometimes|string',
            'faculty_department_id' => 'sometimes|exists:faculty_departments,id',
        ]);

        $form->update($validated);
        return response()->json($form->load('facultyDepartment'));
    }

    public function destroy($id)
    {
        $form = ContactForm::findOrFail($id);
        $form->delete();

        return response()->json(null, 204);
    }
}
