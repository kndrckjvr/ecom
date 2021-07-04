<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function index()
    {
        $data['users'] = User::paginate(5);
        
        return view('user.index', $data);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return redirect(route('home'))->withErrors('Username/Password was incorrect.');
        }

        if (Auth::user()->status == 0) {
            Auth::logout();
            return redirect(route('home'))->withErrors('User Account Unavailable.');
        }

        return redirect(route('home'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect(route('home'));
    }
}
