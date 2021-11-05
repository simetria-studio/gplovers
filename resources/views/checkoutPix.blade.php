@extends('layouts.main')
@section('content')
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="logo d-flex justify-content-center col-12">
                    <div class="logotipo">
                        <a href="{{route('home')}}">
                            <img src="{{ url('/assets/img/logo.png') }}" alt="logotipo" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-12 my-2">
                <h1 class="text-center">PAGAMENTO FOI EFETUADO COM SUCESSO!</h1>
            </div>
            <div class="col-12 my-2 text-center">
                <img id="code" src="{{ $code }}" alt="">
                <div class="mt-3">
                    <div class="text-center">
                        <button id="copia" class="btn btn-c-purple">Copia e Cola</button>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4 mb-2 text-center">
                <a href="{{route('perfil.conta')}}" class="btn btn-block btn-c-purple">VOLTAR</a>
            </div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            window.location.reload();
        }, 60000)
    </script>
@endsection
