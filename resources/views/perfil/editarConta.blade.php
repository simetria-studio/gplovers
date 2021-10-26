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
        <form id="form_atualizarConta" method="POST">
            @csrf
            <div class="row mt-3 justify-content-center formulario">
                <div class="col-10 inputs mb-2">
                    <input type="text" name="name" value="{{auth()->user()->name}}">
                </div>
                <div class="col-10 inputs mb-4">
                    <input type="email" name="email" value="{{auth()->user()->email}}">
                </div>

                <div class="col-10 inputs mb-2">
                    <span class="info">Para não alterar a senha deixar campo vazio</span>
                    <input type="password" name="password" placeholder="Nova Senha">
                </div>
                <div class="col-10 inputs mb-2">
                    <input type="password" name="password_confirmation" placeholder="Confirmar Nova Senha">
                </div>

                <div class="col-10 mt-5 d-grid">
                    <button type="button" class="btn btn-c-purple btn-save" data-target="#form_atualizarConta" data-route="{{route('perfil.conta.editar')}}">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
