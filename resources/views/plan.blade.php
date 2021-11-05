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
                            <div class="col-12"><h3 class="text-center">Plano 14 Subidas</h3></div>
                            <div class="col-12">Durante sete dias o anuncio irá ter 2 subidas por dia.</div>
                            <div class="col-12 mt-3 text-center">Valor do Plano - R$ 15,00</div>

                            <div class="col-12 mt-3 text-center">
                                <a href="{{route('checkout', 1)}}" class="btn btn-c-purple">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 my-2">
                <div class="card-c">
                    <div class="card-c-body">
                        <div class="row">
                            <div class="col-12"><h3 class="text-center">Plano 21 Subidas</h3></div>
                            <div class="col-12">Durante sete dias o anuncio irá ter 3 subidas por dia.</div>
                            <div class="col-12 mt-3 text-center">Valor do Plano - R$ 19,99</div>

                            <div class="col-12 mt-3 text-center">
                                <a href="{{route('checkout', 2)}}" class="btn btn-c-purple">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 my-2">
                <div class="card-c">
                    <div class="card-c-body">
                        <div class="row">
                            <div class="col-12"><h3 class="text-center">Plano 28 Subidas</h3></div>
                            <div class="col-12">Durante sete dias o anuncio irá ter 4 subidas por dia.</div>
                            <div class="col-12 mt-3 text-center">Valor do Plano - R$ 30,00</div>

                            <div class="col-12 mt-3 text-center">
                                <a href="{{route('checkout', 3)}}" class="btn btn-c-purple">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
