<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    @if (Request::routeIs('login') == false && Request::routeIs('register') == false)
        <div class="nav-trigger js_navbar">
            <span></span><span></span><span></span>
        </div>
    @endif
    <div class="nav-menu">
        <ul>
            @if (auth()->check())
                <a href="#" onclick="event.preventDefault();"><li><h2 class="mb">Olá {{explode(' ', auth()->user()->name)[0]}}</h2></li></a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><li><h2 class="mb">Sair</h2></li></a>
            @else
                <a href="{{route('login')}}"><li><h2 class="mb">Login</h2></li></a>
                <a href="{{route('register')}}"><li><h2 class="mt">Registrar-se</h2></li></a>
            @endif
            @if(Request::routeIs('home') == false) <a href="{{route('home')}}"> <li><h2 class="mt">Home</h2></li></a> @endif
            @if(Request::routeIs('perfil.conta') ==  false) <a href="{{route('perfil.conta')}}"><li><h2 class="mb">Conta</h2></li></a> @endif
            @if(Request::routeIs('perfil.dados') ==  false) <a href="{{route('perfil.dados')}}"><li><h2 class="mb">Perfil</h2></li></a> @endif
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
