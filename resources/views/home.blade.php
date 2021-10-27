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
                {{-- <div class="menu mt-5">
                    <a href="">
                        <img src="{{ url('/assets/img/menu.png') }}" alt="menu" />
                    </a>
                </div> --}}
                <div class="search col-8">
                    <input type="search" class="pesquisa" name="cidade" data-autocomplete="true" data-tabela="cidade" placeholder="ONDE VOCÊ ESTA?" />
                    <div class="lupa">
                        <button type="button" class="btn-pesquisa">
                            <img src="{{ url('/assets/img/lupa.png') }}" alt="pesquisa" />
                        </button>
                    </div>
                </div>
                <div class="funil col-4">
                    <a href="#" class="btn-filtro">
                        <img src="{{ url('/assets/img/funil.png') }}" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="nav-filtro">
        <div class="nav-filtro-selecao">
            <div class="container">
                <div class="row formulario mt-5">
                    <div class="col-12 text-center mb-3"><h5>Filtrar Pesquisa</h5></div>
                    <div class="col-6 inputs mb-2">
                        <label for="">Menor valor R$</label>
                        <input name="menor_valor" class="color-2 real pesquisa" type="text" value="0,00">
                    </div>
                    <div class="col-6 inputs mb-2">
                        <label for="">Maior valor R$</label>
                        <input name="maior_valor" class="color-2 real pesquisa" type="text" value="999,99">
                    </div>

                    <div class="col-12 inputs color-select-2 mb-2">
                        <label for="">Tipos de Serviços</label>
                        <select name="tipo_servico[]" multiple class="select2 pesquisa" data-placeholder="Selecione os Serviços">
                            @foreach ($tipo_servicos as $tipo_servico)
                                <option value="{{$tipo_servico->id}}">{{$tipo_servico->servico}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 inputs color-select-2 mb-2">
                        <label for="">Tipo de Lugares</label>
                        <select name="tipo_lugar[]" multiple class="select2 pesquisa" data-placeholder="Selecione os Lugares">
                            @foreach ($tipo_lugares as $tipo_lugar)
                                <option value="{{$tipo_lugar->id}}">{{$tipo_lugar->lugar}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 inputs color-select-2 mb-2">
                        <label for="">Selecione a Etnia</label>
                        <select name="etnias[]" multiple class="select2 pesquisa" data-placeholder="Selecione a Etnia">
                            <option value="">- Selecione a Etnia -</option>
                            <option value="M">Morena</option>
                            <option value="L">Loira</option>
                            <option value="R">Ruiva</option>
                            <option value="O">Oriental</option>
                        </select>
                    </div>

                    <div class="col-12 inputs color-select-2 mb-2">
                        <label for="">Selecione o Tamanho dos Peitos</label>
                        <select name="peitos[]" multiple class="select2 pesquisa" data-placeholder="Selecione o Tamanho dos Peitos">
                            <option value="">- Tamanho dos Peitos -</option>
                            <option value="P">Pequeno</option>
                            <option value="M">Medio</option>
                            <option value="G">Grande</option>
                        </select>
                    </div>

                    <div class="col-12 inputs color-select-2 mb-2">
                        <label for="">Selecione a Cor dos Olhos</label>
                        <select name="olhos[]" multiple class="select2 pesquisa" data-placeholder="Selecione Cor dos Olhos">
                            <option value="">- Selecione a Cor dos Olhos -</option>
                            @foreach ($olhos as $olho)
                                <option value="{{$olho}}">{{$olho}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 inputs color-select-2 mb-2">
                        <label for="">Selecione a Cor do Cabelo</label>
                        <select name="cabelo[]" multiple class="select2 pesquisa" data-placeholder="Selecione Cor do Cabelo">
                            <option value="">- Selecione a Cor do Cabelo -</option>
                            @foreach ($cabelos as $cabelo)
                                <option value="{{$cabelo}}">{{$cabelo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="clientes mt-5">
            @forelse ($perfis as $perfil)
                @if ($perfil->fotos->count() > 0)
                    @php
                        $slug = Illuminate\Support\Str::slug($perfil->data->nome).'-'.$perfil->id;
                    @endphp
                    <div class="card mb-5">
                        <div class="imagem">
                            <a href="{{route('perfil.anuncio', $slug)}}">
                                <img src="{{ asset('storage/user_'.$perfil->id.'/'.$perfil->fotos->random(1)[0]->path) }}" />
                            </a>
                        </div>
                        <div class="descricao">
                            <div>
                                <p>{{$perfil->local->cidade}}, {{$perfil->data->idade}}</p>
                                @foreach ($perfil->caches as $cache)
                                    @if ($cache->nome == '15m' || $cache->nome == '30m' || $cache->nome == '1h')
                                        <p>R$ {{number_format($cache->valor, 2, ',', '.')}}</p>
                                        @php
                                            break;
                                        @endphp
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                
            @endforelse
        </div>
        {{-- <div class="clientes mt-5">
            <div class="card mb-5">
                <div class="imagem">
                    <a href="/perfil">
                        <img src="{{ url('/assets/img/mulher1.png') }}" alt="" />
                    </a>
                </div>
                <div class="descricao">
                    <div>
                        <p>Curitiba, 39</p>
                        <p>R$ 150,00</p>
                    </div>
                </div>
            </div>
            <div class="card mt-4 mb-5">
                <div class="imagem">
                    <a href="">
                        <img src="{{ url('/assets/img/mulher2.png') }}" alt="" />
                    </a>
                </div>
                <div class="descricao">
                    <div>
                        <p>Araucária, 25</p>
                        <p>R$ 100,00</p>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="imagem">
                    <a href="">
                        <img src="{{ url('/assets/img/mulher3.png') }}" alt="" />
                    </a>
                </div>
                <div class="descricao">
                    <div>
                        <p>Curitiba, 39</p>
                        <p>R$ 150,00</p>
                    </div>
                </div>
            </div>
            <div class="card mt-4 mb-5">
                <div class="imagem">
                    <a href="">
                        <img src="{{ url('/assets/img/mulher4.png') }}" alt="" />
                    </a>
                </div>
                <div class="descricao">
                    <div>
                        <p>Curitiba, 25</p>
                        <p>R$ 100,00</p>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="imagem">
                    <a href="">
                        <img src="{{ url('/assets/img/mulher5.png') }}" alt="" />
                    </a>
                </div>
                <div class="descricao">
                    <div>
                        <p>Curitiba, 39</p>
                        <p>R$ 150,00</p>
                    </div>
                </div>
            </div>
            <div class="card mt-4 mb-5">
                <div class="imagem">
                    <a href="">
                        <img src="{{ url('/assets/img/mulher6.png') }}" alt="" />
                    </a>
                </div>
                <div class="descricao">
                    <div>
                        <p>Curitiba, 25</p>
                        <p>R$ 100,00</p>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
