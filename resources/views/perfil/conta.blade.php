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
                <div class="card-c">
                    <div class="card-c-body">
                        <div class="row">
                            <div class="col-12">Nome: {{auth()->user()->name}}</div>
                            <div class="col-12">Email: {{auth()->user()->email}}</div>

                            <div class="col-12 mt-3 text-center">
                                <a href="{{route('perfil.conta.editar')}}" class="btn btn-c-purple">Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 my-2 d-grid"><a href="{{route('perfil.dados')}}" class="btn btn-c-purple">ANUNCIAR</a></div>

            @if ($plan->count() < 1)
                <div class="col-12 my-2 d-grid"><a href="{{route('plan')}}" class="btn btn-c-purple">PLANOS</a></div>
            @else
                <div class="col-12 my-2">
                    <div class="card-c">
                        <div class="card-c-body">
                            <div class="row">
                                <div class="col-12">Plano: {{$plan[0]->plan_name}}</div>
                                <div class="col-12">Subidas por Dia: {{explode(' ', $plan[0]->plan_name)[0] / 7}}</div>
                                <div class="col-12">Valor Pago: R$ {{number_format($plan[0]->value, 2, ',', '.')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
