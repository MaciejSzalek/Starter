<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class ApiController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required' , 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:255']
        ]);

        return User::create($attributes);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required' , 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:255']
        ]);

        $success = $user->updated($attributes);

        return ['success' => $success];
    }

    public function destroy(User $user)
    {
        $success = $user->delete();
        return ['success' => $success];
    }
}
