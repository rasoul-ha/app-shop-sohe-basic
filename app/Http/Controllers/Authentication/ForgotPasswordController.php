<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\FindUseranameRequest;
use App\Http\Requests\Auth\PasswordUpdateRequest;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('authentication.forgot-password');
    }
    public function passwordRequest(FindUseranameRequest $request)
    {
        try {
            $user = Admin::where('username', $request->username)->first();
            if (!$user) {
                return back()->withErrors([
                    'username' => 'There is no such user!'
                ]);
            }
            session()->push('username', $request->username);
            $this->generatePassword($request->username);
            return redirect()->route('resetpasswordform')->with('status', __('The password change code has been sent successfully'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function showResetPasswordForm()
    {
        $username =  session()->has('username') ? session()->get('username')[0] : null;
        if (!$username) {
            return redirect()->route('forgotpasswordform');
        }
        return view('authentication.reset-password', compact('username'));
    }

    public function passwordUpdate(PasswordUpdateRequest $request)
    {
        $username =  session()->has('username') ? session()->get('username')[0] : null;
        try {
            $user = Admin::where('username', $username)->first();
            if (!$user) {
                return back()->withErrors([
                    'username' => 'There is no such user!'
                ]);
            }

            $data = DB::table('password_resets')
                ->where('code', $request->get('code'))
                ->where('username', $username)
                ->first();
            if (!$data) {
                return back()->withErrors([
                    'code' => 'The verification code is invalid.'
                ]);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            DB::table('password_resets')->where('username', $username)->delete();

            if (auth('admin')->attempt(['username' => $username, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
    public function generatePassword($mobile)
    {
        $code = random_int(111111, 999999);
        try {
            DB::table('password_resets')
                ->updateOrInsert(
                    ['username' => $mobile],
                    ['code' => $code]
                );
            if (env('DEMO') === false) {
            }
            return $code;
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());
        }
    }
}
