@extends('layout.app')


@section('content')
    <h1>Users</h1>
    <ul>
        @foreach ($users as $data)
        <li>
            <ul>
                <li>Name: {{ $data->name }}</li>
                <li>Email: {{ $data->email }}</li>
                <li>Joined: {{ $data->date }}</li>
            </ul>
        </li>
        @endforeach
    </ul>
    {{ $users->links() }}
@endsection