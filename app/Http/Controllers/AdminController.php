<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function getBooking(Request $request)
    {
        $booking = Booking::find($request->get('booking_id'));

        return response()->json([
            'booking' => [
                'name' => $booking->user->name,
                'service_type' => $booking->service->name,
                'company' => $booking->service->user->name,
                'current_status' => $booking->status,
                'date' => date('F j, Y, h:i A l', strtotime($booking->date)),
            ]
        ]);
    }

    public function updateBookingStatus(Request $request)
    {
        $validator = Validator::make(['id' => $request->get('booking_id')], [
            'id' => 'exists:App\Models\Booking,id',
        ]);

        if ($validator->fails()) {
            return redirect(route('home'))
                ->withErrors($validator);
        }

        $booking = Booking::find($request->get('booking_id'));

        $booking->status = $request->get('status');
        $booking->save();

        return response()->json([
            'message' => 'Success'
        ]);
    }

    public function addBooking(Request $request)
    {
        $data = $request->only(['user_id', 'service_id', 'location', 'date']);

        $data['date'] = date('Y-m-d H:i:s', strtotime($data['date']));
        $data['status'] = 0;

        $validator = Validator::make($data, [
            'user_id' => 'exists:App\Models\User,id',
            'service_id' => 'exists:App\Models\Service,id',
            'location' => 'required',
            'date' => ['required', 'date', 'after:now']
        ]);

        if ($validator->fails()) {
            return redirect(route('home'))
                ->withErrors($validator);
        }

        Booking::create($data);

        return redirect(route('home'));
    }

    public function getUser(Request $request)
    {
        $service = User::find($request->get('user_id'));

        return response()->json([
            'user' => [
                'id' => $service->id,
                'name' => $service->name,
                'email' => $service->email,
                'status' => $service->status,
            ]
        ]);
    }

    public function updateUser(Request $request)
    {
        $data = $request->only(['name', 'email', 'password', 'status', 'id']);

        $validator = Validator::make($data, [
            'id' => 'exists:App\Models\User,id',
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'status' => ['required', 'in:0,1,2,3'],
        ]);

        if ($validator->fails()) {
            return redirect(route('home'))
                ->withErrors($validator);
        }

        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        User::where('id', $data['id'])->update($data);

        return redirect(route('home'));
    }

    public function addUser(Request $request)
    {
        $data = $request->only(['name', 'email', 'password', 'status']);

        $validator = Validator::make($data, [
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'status' => ['required', 'in:0,1,2,3'],
        ]);

        if ($validator->fails()) {
            return redirect(route('home'))
                ->withErrors($validator);
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        User::create($data);

        return redirect(route('home'));
    }

    public function getService(Request $request)
    {
        $service = Service::find($request->get('service_id'));

        return response()->json([
            'service' => [
                'id' => $service->id,
                'name' => $service->name,
                'location' => $service->location,
                'description' => $service->description,
                'user_id' => $service->user_id,
            ]
        ]);
    }

    public function updateService(Request $request)
    {
        $data = $request->only(['name', 'description', 'location', 'user_id', 'id']);

        $validator = Validator::make($data, [
            'name' => ['required'],
            'description' => ['required'],
            'location' => ['required'],
            'user_id' => 'exists:App\Models\User,id',
            'id' => 'exists:App\Models\Service,id',
        ]);

        if ($validator->fails()) {
            return redirect(route('home'))
                ->withErrors($validator);
        }

        Service::where('id', $data['id'])->update($data);

        return redirect(route('home'));
    }

    public function addService(Request $request)
    {
        $data = $request->only(['name', 'description', 'location', 'user_id']);

        $validator = Validator::make($data, [
            'name' => ['required'],
            'description' => ['required'],
            'location' => ['required'],
            'user_id' => 'exists:App\Models\User,id'
        ]);

        if ($validator->fails()) {
            return redirect(route('home'))
                ->withErrors($validator);
        }

        Service::create($data);

        return redirect(route('home'));
    }
}
