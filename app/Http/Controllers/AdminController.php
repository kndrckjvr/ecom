<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

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

        Service::where('id', $data['id'])->update($data);

        return redirect(route('home'));
    }

    public function addService(Request $request)
    {
        $data = $request->only(['name', 'description', 'location', 'user_id']);

        Service::create($data);

        return redirect(route('home'));
    }
}
