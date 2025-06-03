<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\view\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @desc Show login form
     * @route GET /login
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * @desc    Authenticate
     * @route   POST /login
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|email:filter|max:100',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate user
        if(Auth::attempt($credentials))
        {
            // Regenerate the session to prevent fixation attack
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('success', 'You are now logged in');
        }

        // If auth fails, redirect back with errors
        return back()->withErrors([
            'email' => 'The provided credentials does not match our records.',
        ])->onlyInput('email');
    }
}
