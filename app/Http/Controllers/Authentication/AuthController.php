<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('authentication.login');
    }

    public function login(LoginRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if (isset($admin) && $admin->email_verified_at  === null) {
            return back()->withErrors([
                'username' =>'Your account is disabled'
            ]);
        }

        if (auth('admin')->attempt(['email' => $request->username,'password' => $request->password],$request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        return back()->withErrors([
            'username' => 'The username/password is not correct',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
