@extends('layouts.main')
@section('content')
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="logo d-flex justify-content-center col-12">
                    <div class="logotipo">
                        <a href="/home">
                            <img src="{{ url('/assets/img/logo.png') }}" alt="logotipo" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 mb-3 d-grid"><a href="{{route('perfil.dados.editar')}}" class="btn btn-c-purple">Atualizar Dados</a></div>

            <div class="col-10 mb-3 text-center"><h3>PUBLICADO - {{$user->publish == 1 ? 'SIM' : 'NÃO'}}</h3></div>

            @if (isset($user->data))
                <div class="col-12 my-2">
                    <div class="card-c">
                        <div class="card-c-body">
                            <div class="row">
                                <div class="col-12">Titulo: {{$user->data->titulo}}</div>
                                <div class="col-12">Nome: {{$user->data->nome}}</div>
                                <div class="col-12">Idade: {{$user->data->idade}} anos</div>
                                <div class="col-12">Contato: {{$user->contato->telefone}}</div>
                                <div class="col-12">Whatsapp?: {{$user->contato->whats == 1 ? 'SIM' : 'NÃO'}}</div>
                                <div class="col-12">Twitter: {{$user->data->twitter}}</div>
                                <div class="col-12">Instagram: {{$user->data->instagram}}</div>
                                <div class="col-12">Descricao: {{$user->data->descricao}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (isset($user->sobre))
                <div class="col-12 my-2">
                    <div class="card-c">
                        <div class="card-c-body">
                            <div class="row">
                                <div class="col-12">Tamanho: {{$user->sobre->tamanho}}</div>
                                <div class="col-12">Etnia: {{$user->sobre->etnia}}</div>
                                <div class="col-12">Peso: {{$user->sobre->peso}} Kg</div>
                                <div class="col-12">Tatuagem: {{$user->sobre->tatuagem}}</div>
                                <div class="col-12">Peitos: {{$user->sobre->peitos}}</div>
                                <div class="col-12">Olhos: {{$user->sobre->olhos}}</div>
                                <div class="col-12">Cabelo: {{$user->sobre->cabelo}}</div>
                                <div class="col-12">Pes: {{$user->sobre->pes}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (isset($user->local))
                <div class="col-12 my-2">
                    <div class="card-c">
                        <div class="card-c-body">
                            <div class="row">
                                <div class="col-12">Estado: {{$user->local->estado}}</div>
                                <div class="col-12">Cidade: {{$user->local->cidade}}</div>
                                <div class="col-12">Bairro: {{$user->local->bairro}} Kg</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($user->lugares->count() > 0)
                <div class="col-12 my-2">
                    <div class="card-c">
                        <div class="card-c-body">
                            <div class="row">
                                <div class="col-12">Lugares: <br>
                                    @if (isset($user->lugares))
                                        @foreach ($user->lugares as $lugar)
                                            <span>{{$lugar->lugar_id}}</span>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12">Serviços: <br>
                                    @if ($user->servicos)
                                        @foreach ($user->servicos as $servico)
                                            <span>{{$servico->servico_id}}</span>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12">Dias: <br>
                                    @if (isset($user->horario))
                                        @foreach ($user->horario->dias as $dia)
                                            <span>{{$dia}}</span>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12">24 Horas?: @isset($user->horario['24horas']) {{$user->horario['24horas'] == 1 ? 'SIM' : 'NÃO'}} @endif</div>
                                <div class="col-12">Horario: <br>
                                    <span>Inicio {{$user->horario->inicio ?? ''}}</span>
                                    <span>Fim {{$user->horario->fim ?? ''}}</span>
                                </div>
                                <div class="col-12">Caches: <br>
                                    @if ($user->caches)
                                        @foreach ($user->caches as $cache)
                                            <span>{{$cache->nome ?? ''}} - R$ {{$cache->valor ?? ''}}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (isset($user->fotos))
            <div class="col-12 my-2">
                <div class="card-c">
                    <div class="card-c-body">
                        <div class="row">
                            @foreach ($user->fotos as $foto)
                                <div class="col-6 col-md-3"><img src="{{asset('storage/user_'.auth()->user()->id.'/'.$foto->path)}}" class="rounded img-fluid"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        </div>
    </div>
@endsection
