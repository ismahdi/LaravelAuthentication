<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    /**
     * Display the reset password form
     *
     * @param string $token
     * @return view
     */
    public function showResetPasswordForm($token)
    {
        PasswordReset::where('token', $token)->firstOrFail();

        return view('passwords.reset', [
            'token' => $token,
        ]);
    }

    /**
     * Process the reset password request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|max:20|confirmed',
            'password_confirmation' => 'required'
        ]);

        $passwordReset = PasswordReset::where('token', $request->token)->firstOrFail();

        if (now() > $passwordReset->expires_at) {
            return back()->withInput()->withErrors(['error' => 'The password reset link has expired!']);
        }

        $user = User::where('email', $passwordReset->email)->firstOrFail();

        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where('email', $passwordReset->email)->delete();

        Auth::loginUsingId($user->id);

        return redirect()->route('dashboard')
            ->withSuccess('Your password has been successfully changed.');
    }

    protected $redirectTo = RouteServiceProvider::HOME;
}
