<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
            'peran' => Role::all()
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|alpha_num',
            'password' => 'required',
            'peran'    => 'required',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'role_id'  => $request->peran,
        ];

        if (!Auth::attempt($credentials)) {
            return back()
                ->withInput()
                ->with('login_error', 'Username, password atau peran salah.');
        }

        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
