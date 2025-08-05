<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCourse;

class UserCourseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json(['message' => 'غير مصرح'], 401);
        }

        $alreadyExists = UserCourse::where('user_id', $user->id)
                                   ->where('course_id', $request->course_id)
                                   ->exists();

        if ($alreadyExists) {
            return response()->json(['message' => 'الدورة مضافة مسبقاً'], 409);
        }

        UserCourse::create([
            'user_id' => $user->id,
            'course_id' => $request->course_id,
        ]);

        return response()->json(['message' => 'تمت إضافة الدورة بنجاح']);
    }
}
