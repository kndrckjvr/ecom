@extends('layout.app')


@section('content')
    <h1>Booking</h1>
    <ul>
        @foreach ($bookings as $data)
        <li>
            <ul>
                <li>Service: {{ $data->service->name }}</li>
                <li>Service Name: {{ $data->service->user->name }}</li>
                <li>Booking Name: {{ $data->user->name }}</li>
                <li>Date: {{ date('F j, Y, h:i l', strtotime($data->date)) }}</li>
            </ul>
        </li>
        @endforeach
    </ul>
    {{ $bookings->links() }}
@endsection