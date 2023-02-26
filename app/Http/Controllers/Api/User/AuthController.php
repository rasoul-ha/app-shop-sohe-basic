<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\FindUsernameRequest;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Http\Requests\User\Auth\ResetPasswordRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\UserRegistered;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $adminUser = Admin::first();
            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->email_verified_at = now();
            $user->save();

            Notification::send($adminUser, new UserRegistered($user));

            return response()->json(['status' => "ok"], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => __('These credentials do not match our records')
                ], 401);
            }

            return response()->json([
                'token' => $user->createToken('my-token')->plainTextToken,
                'user' => new UserResource($user),
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function forgotPassword(FindUsernameRequest $request) {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'message' => __('These credentials do not match our records')
                ], 401);
            }

            return response()->json([
                'user' => new UserResource($user),
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function resetPassword(ResetPasswordRequest $request,User $user) {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->password = Hash::make($request->get('password'));
                $user->save();
            }
            return response()->json([
                'token' => $user->createToken('my-token')->plainTextToken,
                'user' => new UserResource($user),
            ], 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }



    public function me()
    {
        try {
            $user = auth()->user();
            return response()->json(new UserResource($user));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response(["message" => "Logout was successful"], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
