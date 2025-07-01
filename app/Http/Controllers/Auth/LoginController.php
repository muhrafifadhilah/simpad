<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{   
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Attempt to find and validate user
        $user = User::validateCredentials(
            $request->input('userid'), 
            $request->input('password')
        );

        if ($user) {
            Auth::login($user, $request->boolean('remember'));
            return $this->authenticated($request, $user);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'userid' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        Log::info('User logged in', ['userid' => $user->userid]);
        $role = optional($user->role)->name;

        // Perbaiki mapping role ke route
        return match($role) {
            'psi' => redirect()->route('admin.dashboard'),
            'wp' => redirect()->route('user.dashboard'),
            default => redirect('/'),
        };
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'userid' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('status', 'You have been logged out.');
    }
}