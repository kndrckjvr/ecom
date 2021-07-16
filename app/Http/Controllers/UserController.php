<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        $data['services'] = Service::orderBy('created_at', 'DESC')->paginate(5, ['*'], 'services');
        
        $data['users'] = User::orderBy('created_at', 'DESC')->paginate(5, ['*'], 'users');
        
        $data['bookings'] = Booking::orderBy('date', 'DESC')->paginate(5, ['*'], 'bookings');
        
        return view('welcome', $data);
    }

    public function bookService(Request $request)
    {
        $data = $request->only(['user_id', 'service_id', 'location', 'date']);

        $validator = Validator::make($data,[
            'user_id' => 'exists:App\Models\User,id',
            'service_id' => 'exists:App\Models\Service,id',
            'location' => 'required',
            'date' => ['required', 'date', 'after:now']
        ]);

        if ($validator->fails()) {
            return redirect(route('home'))
                ->withErrors($validator);
        }

        $data['user_id'] = auth()->user()->id;
        $data['date'] = date('Y-m-d H:i:s', strtotime($data['date']));
        $data['status'] = 0;

        Booking::create($data);

        return redirect(route('home'));
    }

    public function index()
    {
        $data['users'] = User::paginate(5);
        
        $data['services'] = Auth::user()->status == 2 ? Service::paginate(5) : Auth::user()->services()->paginate(5);
        
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
