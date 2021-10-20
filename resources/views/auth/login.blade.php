@extends('layouts.main')
@section('content')
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="w-75">
            <div class="text-center mt-5 mb-4">
                <img class="img-fluid" src="{{ asset('assets/img/logo.png')}}" alt="">
            </div>
            <div class="mt-5">
                <form id="form-login" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="formulario">
                        <div class="inputs mt-3">
                            <input type="email" name="email" placeholder="Email">
                        </div>
                        <div class="inputs mt-3">
                            <input type="password" name="password" placeholder="Senha">
                        </div>

                        <div class="checkbox mt-3">
                            <input name="remember" type="checkbox">
                            <label for="remember">LEMBRAR ACESSO</label>
                        </div>

                        <div class="d-grid mt-3">
                            <button type="button" id="btn-login" class="btn btn-c-purple">ENTRAR</button>
                        </div>
                        <div class="text-center text-white mt-5">
                            NÃO POSSUI CADASTRO? <br>
                            <h4><a class="text-orange" href="{{ route('register') }}"> CLIQUE AQUI </a></h4>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection