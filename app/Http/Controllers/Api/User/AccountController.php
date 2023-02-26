<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function updateName(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'max:191']
        ], [
            'name.required' =>'Enter the name',
            'name.max' => 'The name is invalid'
        ]);
        try {
            $user = auth()->user();
            $user->name = $request->name;
            $user->save();
            return response()->json([
                'user' => new UserResource(auth()->user()),
                'message' => __('Account successfully updated')
            ], 200);
        } catch (\Throwable $e) {
            report($e);
            Log::error($e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        if ($request->current_password !== null) {
            if (!$user || !Hash::check($request->current_password, $user->password)) {
                return response()->json(['message' => __('The current password is incorrect')], 401);
            }
            if (strcmp($request->current_password, $request->new_password) == 0) {
                return response()->json(['message' => __("The new password cannot be the same as the previous password")], 401);
            }
            if ($request->new_password === null) {
                return response()->json(['message' => __('Enter new password')], 401);
            }
            if (strlen($request->new_password) < 7) {
                return response()->json(['message' => __("The new password must have at least 6 characters")], 401);
            }
            $user->password = Hash::make($request->new_password);
        }

        try {
            $user->save();
            return response()->json([
                'user' => new UserResource(auth()->user()),
                'message' => __('Password successfully updated')
            ], 200);
        } catch (\Throwable $e) {
            report($e);
            Log::error($e->getMessage());
        }
    }
}
