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
                <h1 class="text-center">EFETUAR PAGAMENTO</h1>
            </div>

            <div class="col-12 my-2">
                <form id="form-checkout">
                    <input type="hidden" name="plan_id" value="{{$id}}">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <label class="form-check-label" for="primeiro">
                                Pagar com cartão
                                <input class="d-none" name="metodo" value="card" id="primeiro" type="radio">
                            </label>

                            <div id="card" class="d-none">
                                <div class="row my-4 justify-content-center">
                                    <div class="form-group col-10">
                                        <label class="text-white" for="">Numero do Cartão</label>

                                        <input type="text" name="numero" id="numero" class="form-control req">
                                    </div>
                                    <div class="form-group col-10">
                                        <label class="text-white" for="">Nome do Titular</label>
                                        <input type="text" name="name" class="form-control req">
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="text-white" for="">Mês</label>
                                        <select name="mes" class="form-control" id="">
                                            @for ($i = 1; $i < 13; $i++)
                                            <option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="text-white" for="">Ano</label>
                                        <select name="ano" class="form-control" id="">
                                            @for ($i = 0; $i < 11; $i++)
                                                <option value="{{date('Y', strtotime('+ '.$i.'years'))}}">{{date('Y', strtotime('+ '.$i.'years'))}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label class="text-white" for="">CVV</label>
                                        <input type="text" name="cvv" id="cvv" class="form-control req">
                                    </div>
        
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3 text-center">
                            <label class="form-check-label" for="segundo">
                                Pagar com Pix
                                <input class="d-none" value="pix" name="metodo" id="segundo" type="radio">
                            </label>
                        </div>
                    </div>
                <form>
            </div>

            <div class="col-12 mt-4 mb-2 text-center">
                <button type="button" data-route="{{route('checkout.finalizar')}}" id="btnCheckout" class="btn btn-block btn-c-purple">PAGAR E FINALIZAR</button>
            </div>
        </div>
    </div>
@endsection
