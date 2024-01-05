<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /**
     * Integrate a new LoginRegisterController instance.
    */
     public function __construct()
     {
         $this->middleware('guest')->except([
             'logout', 'dashboard'
         ]);
     }

    /**
     * Display the registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * register a new user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:250',
            'email' => 'required|string|max:100',
            'password' => 'required|min:8|confirmed'
        ]);

        User::query()->create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
            ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display the login form.
     *
     * @return \Illuminate\Http\Response
    */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authentication the user
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'The entered email is incorrect!',
            'password' => 'The entered password is incorrect!'
        ])->onlyInput(['email', 'password']);
    }

    /**
     * Display the dashboard to authenticated users.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dashboard()
    {
        if (Auth::check())
            {
                return view('dashboard');
            }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.'
            ])->onlyInput('email');
    }

    /**
     * Log out the user from application
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Http\Response
    */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }

}
