<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/menu.min.css')}}" />
    <title>GP Lovers</title>
</head>

<body>
    <div class="cookie-idade d-flex align-items-center">
        <div class="container d-flex flex-column align-items-center">
            <div><img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt=""></div>
            <div class="cookie-title my-3 text-center">
                <h4 class="text-white">VOCÊ É MAIOR DE</h4>
                <h3 class="text-orange">18 ANOS?</h3>
            </div>
            <div class="btns">
                <button type="button" class="btn btn-c-red btn-no-cookie-idade">NÃO</button>
                <button type="button" class="btn btn-c-purple btn-yes-cookie-idade">SIM</button>
            </div>
        </div>
    </div>

    {{-- <div class="nav-menu">
        <nav id="nav" class="nav" role="navigation">
            <!-- ACTUAL NAVIGATION MENU -->
            <ul class="nav__menu" id="menu" tabindex="-1" aria-label="main navigation" hidden>
                <li class="nav__item"><a href="{{route('login')}}" class="nav__link">Login</a></li>
                <li class="nav__item"><a href="{{route('register')}}" class="nav__link">Registrar-se</a></li>
                @if(Request::routeIs('home') == false) <li class="nav__item"><a href="{{route('home')}}" class="nav__link">Home</a></li> @endif
            </ul>
            
            <!-- MENU TOGGLE BUTTON -->
            <a href="#nav" class="nav__toggle" role="button" aria-expanded="false" aria-controls="menu">
                <svg class="menuicon" xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 50 50">
                    <title>Toggle Menu</title>
                    <g>
                        <line class="menuicon__bar" x1="13" y1="16.5" x2="37" y2="16.5"/>
                        <line class="menuicon__bar" x1="13" y1="24.5" x2="37" y2="24.5"/>
                        <line class="menuicon__bar" x1="13" y1="24.5" x2="37" y2="24.5"/>
                        <line class="menuicon__bar" x1="13" y1="32.5" x2="37" y2="32.5"/>
                        <circle class="menuicon__circle" r="23" cx="25" cy="25" />
                    </g>
                </svg>
            </a>
            
            <!-- ANIMATED BACKGROUND ELEMENT -->
            <div class="splash"></div>
        </nav>
    </div> --}}

    <div class="nav-trigger js_navbar">
        <span></span><span></span><span></span>
    </div>
    <div class="nav-menu">
        <ul>
            <a href="#"> <li><h2 class="mt">Home</h2><i>Go to</i></li></a>
            <a href="#"><li><h2 class="mb">About</h2><i>Me</i></li></a>
            <a href="#"><li><h2 class="mt">Work</h2><i>My</i></li></a>
            <a href="#"><li><h2 class="mb">Contact</h2><i>Me</i></li></a>
        </ul>
    </div>

    @yield('content')

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <script src="{{asset('assets/js/menu.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>
