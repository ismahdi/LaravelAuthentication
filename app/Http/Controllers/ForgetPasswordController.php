<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ForgetPasswordController extends Controller
{
    /**
     * Display the forget password form
     *
     * @return view
     */
    public function showForgetPasswordForm()
    {
        return view('passwords.forget');
    }

    /**
     * Process the forget password request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        PasswordReset::query()->create([
            'email' => $request->email,
            'token' => $token,
            'expires_at' => now()->addHours(24),
        ]);

        Mail::send('email.forgetPassword', [
            'token' => $token
        ], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->withSuccess('The Password reset link has been sent to your Email!');
    }

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
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $passwordReset = PasswordReset::where('token', $request->token)->firstOrFail();

        if (now() > $passwordReset->expires_at) {
            return back()->withInput()->with('error', 'The password reset link has expired!');
        }

        $user = User::where('email', $passwordReset->email)->firstOrFail();

        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where('email', $passwordReset->email)->delete();

        return redirect()->route('login')
            ->withSuccess('Your password has been successfully changed.');
    }
}
