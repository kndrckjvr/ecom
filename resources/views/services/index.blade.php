@extends('layout.app')


@section('content')
    <h1>Services</h1>
    <ul>
        @foreach ($services as $data)
        <li>
            <ul>
                <li>Service: {{ $data->name }}</li>
                <li>Service Name: {{ $data->user->name }}</li>
                <li>Location Name: {{ $data->location }}</li>
            </ul>
        </li>
        @endforeach
    </ul>
    {{ $services->links() }}
@endsection