@extends('layout.app')

@section('content')
    @auth
        <h1>Hello, {{ auth()->user()->currentUserType() }}</h1>
    @else
        <h1>Home</h1>
    @endauth
@endsection