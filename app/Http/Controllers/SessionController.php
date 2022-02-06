<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('session.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(! auth()->attempt($attributes)) {
            throw ValidationException::withMessages(['email' => 'Incorrect password or email address']);
        }

        session()->regenerate();
        return redirect('/')->with('success', 'User login successfully');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'User logout successfully');
    }
}
