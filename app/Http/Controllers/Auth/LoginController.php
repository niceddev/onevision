<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('modules.auth.login');
    }

    public function login(LoginRequest $loginRequest)
    {
        $validatedData = $loginRequest->validated();

        if (!Auth::attempt($validatedData)) {
            return redirect()->back()->withErrors(['message' => __('Пользователь не найден')]);
        }

        return redirect()->route('posts.index');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

}
