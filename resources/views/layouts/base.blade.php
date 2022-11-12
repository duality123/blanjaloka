<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
@vite('resources/css/app.scss')
    <!--<script src="{{mix('css/app.scss')}}"></script>-->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-light  bg-light" style="padding-left:100px;padding-right:100px;">
            <div class="container-fluid">
                <div class="d-flex bd-highlight">
                    <div class="p-2 bd-highlight"><a class="navbar-brand" href="#">Blanjaloka</a></div>
                    <div class="p-2 bd-highlight"><a href="{{route('authenticated_page')}}">AuthenticatedPage</a></div>
                </div>
                <div class="d-flex bd-highlight">
                    @guest
                    <div class="p-2 bd-highlight"><a href="{{url('/login')}}">Login</a></div>
                    <div class="p-2 bd-highlight"><a href="{{url('/register')}}">Register</a></div>
                    @endguest
                    @auth
                    @if(!auth()->user()->is_verified)
                    @endif
                    <form class="form-control" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                    @endauth
                </div>
            </div>
        </nav>
    </header>
    <main class="my-5">
        @yield('content')
    </main>


</body>

</html>