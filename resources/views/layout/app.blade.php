<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ env('APP_NAME', 'ecom') }}</title>
  </head>
  <body>
    <div class="container">
        <a href="{{ url(route('home')) }}">Home</a>
        @auth
            <a href="#">{{ auth()->user()->name }}'s Profile</a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form action="{{ url(route('logout')); }}" method="post" id="logout-form"> @csrf </form>
            @if(auth()->user()->isBookingUser())
                <ul>
                    <li>Booking Users</li>
                    <li><a href="{{ url(route('booking.index')) }}">Bookings</a></li>
                    <li><a href="{{ url(route('service.index')) }}">Services</a></li>
                </ul>
            @elseif(auth()->user()->isServiceUser())
                <ul>
                    <li>Service Users</li>
                    <li><a href="{{ url(route('booking.index')) }}">Bookings</a></li>
                    <li><a href="{{ url(route('service.index')) }}">Services</a></li>
                </ul>
            @elseif(auth()->user()->isAdmin())
                <ul>
                    <li>Admin</li>
                    <li><a href="{{ url(route('user.index')) }}">Users</a></li>
                    <li><a href="{{ url(route('booking.index')) }}">Bookings</a></li>
                    <li><a href="{{ url(route('service.index')) }}">Services</a></li>
                </ul>
            @endif
        @else
            <a href="{{ url(route('home')) }}">Login</a>
            <a href="{{ url(route('home')) }}">Register</a>
            <form action="{{ url(route('login')) }}" method="post">
                @if(Session::get('errors'))
                    <div class="alert alert-danger">
                        {{ Session::get('errors')->first() }}
                    </div>
                @endif
                @csrf
                <input type="text" name="email">
                <input type="password" name="password">
                <button type="submit">Login</button>
            </form>
        @endauth
        @yield('content')
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>