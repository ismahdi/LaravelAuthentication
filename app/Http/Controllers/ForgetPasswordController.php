<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use Illuminate\Http\Request;
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
}
