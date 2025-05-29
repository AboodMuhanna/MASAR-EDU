<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Login;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function index()
    {
        return response()->json(
            Login::with('user')->get(),
            200
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ip_address' => 'nullable|ip',
            'user_agent' => 'nullable|string',
            'logged_in_at' => 'required|date',
        ]);

        //تحويل التاريخ إلى تنسيق تقبله MySQL
        $validated['logged_in_at'] = Carbon::parse($validated['logged_in_at'])->format('Y-m-d H:i:s');

        return response()->json(
            Login::create($validated),
            201
        );
    }

    public function show($id)
    {
        return response()->json(
            Login::with('user')->findOrFail($id),
            200
        );
    }

    public function update(Request $request, $id)
    {
        $login = Login::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'ip_address' => 'sometimes|ip',
            'user_agent' => 'sometimes|string',
            'logged_in_at' => 'sometimes|date',
        ]);

        // إذا تم إرسال logged_in_at، حوله
        if (isset($validated['logged_in_at'])) {
            $validated['logged_in_at'] = Carbon::parse($validated['logged_in_at'])->format('Y-m-d H:i:s');
        }

        $login->update($validated);
        return response()->json($login->load('user'));
    }

    public function destroy($id)
    {
        $login = Login::findOrFail($id);
        $login->delete();

        return response()->json(null, 204);
    }
}
