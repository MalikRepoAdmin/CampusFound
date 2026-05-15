<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show register page
     */
    public function showRegister()
    {
        // TODO: define the view route according to frontend inside views/
        return view('auth.register');
    }

    /**
     * Process Register
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users', // email must be unique, 'users' is the table name
            'nama' => 'required',

            // 'confirmed' option is required so user can confirm their password to ensure they remember their password
            // TODO: 'confirmed' option needs 'password_confirmation' on frontend. for example <input type="password" name="password_confirmation">
            'password' => 'required|min:6|confirmed', 
            'no_hp' => 'required'
        ]);

        // Store  the user to database
        $user = User::create([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => $request->password,
            'no_hp' => $request->no_hp,
        ]);

        // Automatically call login method after successfully register
        Auth::login($user);

        // TODO: define the redirect route according to frontend inside views/
        return redirect()->route('items.beranda');
    }

    /**
     * Show login page
     */
    public function showLogin()
    {
        // TODO: define the view route according to frontend inside views/
        return view('auth.login');
    }

    /**
     * Process Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Laravel automatically check the email and password
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // TODO: define the redirect route according to frontend inside views/
            return redirect()->route('items.beranda'); 
        } 
        else {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }
    }

    /**
     * Process Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // destroy session
        $request->session()->invalidate();

        // regenerate token to avoid CSRF attack
        $request->session()->regenerateToken();

        // TODO: define the redirect route according to frontend inside views/
        return redirect('/login')->with('status', 'Anda telah berhasil Logout.');
    }
}
