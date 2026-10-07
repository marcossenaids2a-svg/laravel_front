<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

  public function login(Request $request)
{
    $email = $request->input('email');
    $senha = $request->input('senha');

    if ($email == 'admin@sesi.com' && $senha == '123456') {
        return redirect('/dashboard');
    }

    return back()->with('erro', 'E-mail ou senha incorretos!');
}
    public function logout()
    {
        return redirect()->route('login');
    }
}