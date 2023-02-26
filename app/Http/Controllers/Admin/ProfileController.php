<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdatePassword;
use App\Http\Requests\Admin\Profile\UpdateProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('dashboard.profile');
    }
    public function updateProfile(UpdateProfile $request)
    {
        try {
            $user =  auth()->user();
            $user->name   = $request->name;
            $user->email   = $request->email;
            $user->save();
            if ($user) {
                toastr()->success('', 'Account has been updated successfully');
                return redirect()->route('dashboard');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
    public function updatePassword(UpdatePassword $request)
    {
        try {
            $user = auth()->user();

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error_message', __('The current password is not correct'));
            }
            if (strcmp($request->current_password, $request->password) == 0) {
                return back()->with('error_message', __('The new password cannot be the same as the previous password'));
            }
            $user->password   = Hash::make($request->password);
            $user->save();
            if ($user) {
                toastr()->success('', 'Password successfully updated');
                return redirect()->route('dashboard');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
}
