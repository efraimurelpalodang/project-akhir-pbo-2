<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
            'peran' => Role::all()
        ]);
    }
}
