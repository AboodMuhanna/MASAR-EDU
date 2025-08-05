<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(
            User::with('facultyDepartment')->get(),
            200
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'email' => 'required|email|unique:users',
            'gender' => 'required|in:male,female',
            'password' => 'required|min:6',
            'faculty_department_id' => 'required|exists:faculty_departments,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        return response()->json(User::create($validated), 201);
    }

    public function show($id)
    {
        $user = User::with('facultyDepartment')->findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'gender' => 'sometimes|in:male,female',
            'password' => 'sometimes|min:6',
            'faculty_department_id' => 'sometimes|exists:faculty_departments,id',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);
        return response()->json($user->load('facultyDepartment'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
