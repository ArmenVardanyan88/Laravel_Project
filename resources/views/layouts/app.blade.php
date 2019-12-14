<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        window.auth = '{!!auth()->user()!!}'
    </script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />--}}


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- This makes the current user's id available in javascript -->
    @if(!auth()->guest())
        <script>
            window.Laravel.userId = <?php echo auth()->user()->id; ?>
        </script>
    @endif

</head>
<body>

    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">



                <a class="dropdown-toggle" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fas fa-bell"></i>
                    <span class="glyphicon glyphicon-user"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="notificationsMenu" id="notificationsMenu">
                    <li class="dropdown-header">No notifications</li>
                </ul>



            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                    <i class="fab fa-laravel"></i>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}
                                <i class="fas fa-sign-in-alt"></i>
                                </a>
                            </li>



                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}
                                    <i class="fas fa-registered"></i>
                                    </a>
                                @endif
                            </li>

                        @else

                            <form action="/search" method="POST" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q"
                                           placeholder="Search users"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-dark">
                                        <span class="glyphicon glyphicon-search"></span>Search
                                        <i class="fas fa-search"></i>
                                    </button>
                                        </span>
                                </div>
                            </form>

                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
                                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <li class="nav-item dropdown">
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        <i class="fas fa-sign-out-alt"></i>
                                    </a>

                                    <a class="dropdown-item" href="{{ action('HomeController@profile',Auth::user()->id)}}">
                                        {{ __('Profile') }}
                                        <i class="fas fa-users"></i>
                                    </a>

                                    <a class="dropdown-item" href="{{action('HomeController@edit',Auth::user()->id)}}">
                                        {{ __('Edit Profile') }}
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a class="dropdown-item" href="{{action('ChatController@index')}}">
                                        {{ __('Message') }}
                                        <i class="fas fa-envelope"></i>
                                    </a>

                                    <a class="dropdown-item" href="{{action('PostsController@create')}}">
                                        {{ __('Post Create') }}
                                        <i class="fab fa-creative-commons-remix"></i>
                                    </a>


                                    <a class="dropdown-item" href="{{action('PostsController@index')}}">
                                        {{ __('Post show') }}
                                        <i class="far fa-eye"></i>
                                    </a>


                                    <a class="dropdown-item" href="{{url('users')}}">
                                        {{ __('Users') }}
                                        <i class="fas fa-user-friends"></i>
                                    </a>


                                    <a class="dropdown-item" href="{{url('image-gallery')}}">
                                        {{ __('Gallery') }}
                                        <i class="fab fa-envira"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
