<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>GP Lovers - Acompanhantes</title>
    <meta name="title" content="GP Lovers - Acompanhantes">
    <link rel="shortcut icon" href="{{ url('assets/img/favicon.ico') }}" />
    <meta name="description"
        content="Encontre acompanhantes em Curitiba, homens e mulheres, massagistas e profissionais do sexo. Procure e publique anúncios CLASSIFICADOS eróticos GRÁTIS">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://metatags.io/">
    <meta property="og:title" content="GP Lovers - Acompanhantes">
    <meta property="og:description"
        content="Encontre acompanhantes em Curitiba, homens e mulheres, massagistas e profissionais do sexo. Procure e publique anúncios CLASSIFICADOS eróticos GRÁTIS">
    <meta property="og:image"
        content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://metatags.io/">
    <meta property="twitter:title" content="GP Lovers - Acompanhantes">
    <meta property="twitter:description"
        content="Encontre acompanhantes em Curitiba, homens e mulheres, massagistas e profissionais do sexo. Procure e publique anúncios CLASSIFICADOS eróticos GRÁTIS">
    <meta property="twitter:image"
        content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui-1.13.0/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/slimbox-2.05/css/slimbox2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/form.multstep.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/menu.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" />

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
                <a href="#" onclick="event.preventDefault();">
                    <li>
                        <h2 class="mb">Olá {{ explode(' ', auth()->user()->name)[0] }}</h2>
                    </li>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <li>
                        <h2 class="mb">Sair</h2>
                    </li>
                </a>
            @else
                <a href="{{ route('login') }}">
                    <li>
                        <h2 class="mb">Login</h2>
                    </li>
                </a>
                <a href="{{ route('register') }}">
                    <li>
                        <h2 class="mt">Registrar-se</h2>
                    </li>
                </a>
            @endif
            @if (Request::routeIs('home') == false) <a href="{{ route('home') }}"> <li><h2 class="mt">Home</h2></li></a> @endif
            @if (Request::routeIs('perfil.conta') == false) <a href="{{ route('perfil.conta') }}"><li><h2 class="mb">Conta</h2></li></a> @endif
            @if (Request::routeIs('perfil.dados') == false) <a href="{{ route('perfil.dados') }}"><li><h2 class="mb">Anunciar</h2></li></a> @endif
            <a href="{{ route('plan') }}"> <li><h2 class="mb">Planos</h2></li></a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('plugins/jquery-ui-1.13.0/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/slimbox-2.05/js/slimbox2.js') }}"></script>
    <script src="{{ asset('assets/js/form.multstep.js') }}"></script>
    <script src="{{ asset('assets/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script type="module" src="{{ url('plugins/code.js') }}"></script>
</body>

</html>
