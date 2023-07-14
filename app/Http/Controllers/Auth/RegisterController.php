<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('modules.auth.register');
    }

    public function register(RegisterRequest $registerRequest)
    {
        $user = User::create([
            'email' => $registerRequest->input('email'),
            'password' => bcrypt($registerRequest->input('password')),
        ]);

        Auth::login($user);

        return redirect()->route('posts.index');
    }

}
