<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.images.index');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas são inválidas.',
        ]);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
