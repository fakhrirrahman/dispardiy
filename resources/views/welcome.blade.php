<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset ('css/app.css')}}">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Welcome to the Laravel Application</h1>
        <p>This is a simple welcome page.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>

        @if (Auth::check())
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
    @else
    <p>Please log in or register to continue.</p>
    @endif

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>