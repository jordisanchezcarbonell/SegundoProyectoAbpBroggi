<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('titol')
    </title>

    {{-- Vinculem el bootstrap --}}
    <link rel="stylesheet" href=" {{ asset('css/app.css') }}">
    {{-- Vinculem el bootstrap --}}
    <link rel="stylesheet" href=" {{ asset('css/our_css.css') }}">
</head>
<body>
    <div id="template">

        <nav class="navbar sticky-top navbar-expand-lg navbar-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="navbar-toggler-icon"></span>
            </button>

        <a class="navbar-brand btn text_titol" href="/home">
            <img src="assets/images/broggivec.PNG" style="width: 20%; float: left">
        </a>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="navbar-nav ml-md-auto">

                    @if(Auth::check())                        

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown toggle text-white btn boto-primari text_titol" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->codi}}
                        </a>
                        <div class="dropdown-menu">
                            
                            <a class="dropdown-item " href="#">Formacio <span class="sr-only"></span></a>
                            <a class="dropdown-item" href="{{ route('logout')}}">Logout</a>

                        </div>
                    </li>
                        
                    @else
                        <li class="nav-item">
                            <a href="{{ url('/login')}}" class="nav-link btn boto-primari text_titol">LOGIN</a>
                        </li>
                    @endif


                </ul>
            </div>
        </nav>

        <div class="container-fluid mt-5 mb-5 pb-4">
            @yield('main')
        </div>


        <footer class="footer">


        </footer>


    </div>

    <script src=" {{ asset('js/app.js') }} " ></script>
</body>
</html>
