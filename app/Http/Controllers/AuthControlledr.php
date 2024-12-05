<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthControlledr extends Controller
{
    public function authPage()
    {
        return view('pages.auth');
    }

    public function auth(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required',
            'password' => 'required'
        ],[
            'required' => 'Заполните поле!'
        ]);

        if(auth()->attempt($validated)){
            return redirect()->route('admin')->withErrors(['success' => 'Добро пожаловать!']);
        }else{
            return redirect()->back()->withErrors(['auth' => 'Неверный логин или пароль!']);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('index');
    }
}
