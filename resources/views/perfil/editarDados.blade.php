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
        <section id="msform" class="my-3">
            <!-- progressbar -->
            <ul id="progressbar" class="d-none">
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            <section class="field">
                <form id="form_dados">
                    <input type="hidden" name="step" value="info_data">
                    <div class="row justify-content-center formulario">
                        <div class="col-12 text-center mb-3"><h2>Informações e Contatos</h2></div>

                        <div class="col-10 inputs mb-2">
                            <input type="text" name="nome" placeholder="Nome" value="{{$user->data->nome ?? $user->name}}" />
                        </div>
                        <div class="col-10 inputs mb-3">
                            <select name="idade">
                                <option value="">- Selecione a Idade -</option>
                                @for ($i = 0; $i <= 83; $i++)
                                    <option value="{{(18+$i)}}" @isset($user->data->idade) @if($user->data->idade == (18+$i)) selected @endif @endisset>{{(18+$i)}} Anos</option>
                                @endfor
                            </select>
                            {{-- <input type="password" name="pass" placeholder="Password" /> --}}
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="telefone" placeholder="Telefone" value="{{$user->contato->telefone ?? ''}}" />
                        </div>
                        <div class="col-10 checkbox justify-content-start mb-3">
                            <input class="me-2" type="checkbox" name="whats" value="true" @isset($user->contato->whats) @if($user->contato->whats == 1) checked @endif @endif />
                            <label for="">Whatsapp?</label>
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="twitter" placeholder="Link do Twitter" value="{{$user->data->twitter ?? ''}}" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="instagram" placeholder="Link do Instagram" value="{{$user->data->instagram ?? ''}}" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="titulo" placeholder="Titulo da publicação" value="{{$user->data->titulo ?? ''}}" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <textarea name="descricao" placeholder="Escreva um pouco sobre Você">{{$user->data->descricao ?? ''}}</textarea>
                        </div>

                        <div class="col-10">
                            <div class="row justify-content-end">
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" class="next d-none"></button>
                                    <button type="button" data-target="#form_dados" data-route="{{route('perfil.dados.atualizar')}}" class="btn btn-c-purple btn-save">Proximo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <section class="field">
                <form id="form_sobre">
                    <input type="hidden" name="step" value="sobre">
                    <div class="row justify-content-center formulario">
                        <div class="col-12 text-center mb-3"><h2>Sobre Você</h2></div>

                        <div class="col-10 inputs mb-2">
                            <input type="text" name="tamanho" placeholder="Seu Tamanho" value="{{$user->sobre->tamanho ?? ''}}" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <select name="etnia">
                                <option value="">- Selecione a Etnia -</option>
                                <option value="M" @isset($user->sobre->etnia) @if($user->sobre->etnia == 'M') selected @endif @endisset>Morena</option>
                                <option value="L" @isset($user->sobre->etnia) @if($user->sobre->etnia == 'L') selected @endif @endisset>Loira</option>
                                <option value="R" @isset($user->sobre->etnia) @if($user->sobre->etnia == 'R') selected @endif @endisset>Ruiva</option>
                                <option value="O" @isset($user->sobre->etnia) @if($user->sobre->etnia == 'O') selected @endif @endisset>Oriental</option>
                            </select>
                        </div>
                        <div class="col-10 inputs mb-3">
                            <input type="text" name="peso" placeholder="Peso Kg" value="{{$user->sobre->peso ?? ''}}" />
                        </div>
                        <div class="col-10 checkbox justify-content-start mb-3">
                            <input class="me-2" type="checkbox" name="tatuagem" value="true" @isset($user->sobre->tatuagem) @if($user->sobre->tatuagem == 'SIM') checked @endif @endisset />
                            <label for="">Tatuagem?</label>
                        </div>
                        <div class="col-10 inputs mb-2">
                            <select name="peitos">
                                <option value="">- Tamanho dos Peitos -</option>
                                <option value="P" @isset($user->sobre->peitos) @if($user->sobre->peitos == 'P') selected @endif @endisset>Pequeno</option>
                                <option value="M" @isset($user->sobre->peitos) @if($user->sobre->peitos == 'M') selected @endif @endisset>Medio</option>
                                <option value="G" @isset($user->sobre->peitos) @if($user->sobre->peitos == 'G') selected @endif @endisset>Grande</option>
                            </select>
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="olhos" placeholder="Seus Olhos" value="{{$user->sobre->olhos ?? ''}}" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="cabelo" placeholder="Seu Cabelo" value="{{$user->sobre->cabelo ?? ''}}" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <select name="pes">
                                <option value="">- Tamanho dos Pes -</option>
                                <option value="P" @isset($user->sobre->pes) @if($user->sobre->pes == 'P') selected @endif @endisset>Pequeno</option>
                                <option value="M" @isset($user->sobre->pes) @if($user->sobre->pes == 'M') selected @endif @endisset>Medio</option>
                                <option value="G" @isset($user->sobre->pes) @if($user->sobre->pes == 'G') selected @endif @endisset>Grande</option>
                            </select>
                        </div>

                        <div class="col-10">
                            <div class="row justify-content-between">
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" class="btn btn-c-purple previous">Voltar</button>
                                </div>
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" class="next d-none"></button>
                                    <button type="button" data-target="#form_sobre" data-route="{{route('perfil.dados.atualizar')}}" class="btn btn-c-purple btn-save">Proximo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <section class="field">
                <form id="form_local">
                    <input type="hidden" name="step" value="local">
                    <div class="row justify-content-center formulario">
                        <div class="col-12 text-center mb-3"><h2>Local de Atendimento</h2></div>

                        <div class="col-10 inputs mb-2">
                            <select name="estado" data-local={{$user->local->estado ?? ''}}>
                                <option value="">- Selecione o Estado -</option>
                            </select>
                        </div>
                        <div class="col-10 inputs mb-2">
                            <select name="cidade" data-local={{$user->local->cidade ?? ''}}>
                                <option value="">- Selecione a Cidade -</option>
                            </select>
                        </div>
                        <div class="col-10 inputs mb-2">
                            <select name="bairro" class="bairro_select" data-local={{isset($user->local->bairro) ? str_replace(' ', '__', $user->local->bairro) : ''}}>
                                <option value="">- Selecione o Bairro -</option>
                            </select>
                            <input type="text" class="bairro_input d-none" placeholder="Nome do bairro" value="{{$user->local->bairro ?? ''}}">
                        </div>

                        <div class="col-10">
                            <div class="row justify-content-between">
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" class="btn btn-c-purple previous">Voltar</button>
                                </div>
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" class="next d-none"></button>
                                    <button type="button" data-target="#form_local" data-route="{{route('perfil.dados.atualizar')}}" class="btn btn-c-purple btn-save">Proximo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <section class="field">
                <form id="form_servicos">
                    <input type="hidden" name="step" value="servicos">
                    <div class="row justify-content-center formulario">
                        <div class="col-12 text-center mb-3"><h2>Serviços</h2></div>

                        <div class="col-10 inputs mb-2">
                            <span class="info">Lugares onde se pode fazer o serviço</span>
                            <select name="lugar_id[]" multiple class="select2" data-placeholder="Selecione os Lugares">
                                @foreach ($tipo_lugares as $tipo_lugar)
                                    <option value="{{$tipo_lugar->id}}" @if(in_array($tipo_lugar->id, $lugares)) selected @endif>{{$tipo_lugar->lugar}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-10 inputs mb-2">
                            <span class="info">Tipo de serviços que faz</span>
                            <select name="servico_id[]" multiple class="select2" data-placeholder="Selecione os Serviços">
                                @foreach ($tipo_servicos as $tipo_servico)
                                    <option value="{{$tipo_servico->id}}" @if(in_array($tipo_servico->id, $servicos)) selected @endif>{{$tipo_servico->servico}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 text-center my-3"><h2>Horarios</h2></div>

                        <div class="col-10 inputs mb-3">
                            <span class="info">Dias de atendimento</span>
                            <select name="dias[]" multiple class="select2" data-placeholder="Selecione os dias">
                                @foreach ($dias as $dia)
                                    <option value="{{$dia}}" @isset($user->horario) @if(in_array($dia, $user->horario->dias)) selected @endif @endisset>{{$dia}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-10 checkbox justify-content-start mb-3">
                            <input class="me-2" type="checkbox" name="24horas" value="true" @isset($user->horario) @if($user->horario['24horas'] == 1) checked @endif @endisset />
                            <label for="">Trabalha 24hrs?</label>
                        </div>
                        <div class="col-10 inputs mb-2">
                            <span class="info">Horario de atendimento (Inicio e Fim)</span>
                            <div class="horario">
                                <input type="text" name="inicio" class="horas" value="{{isset($user->horario->inicio) ? date('H:i', strtotime($user->horario->inicio)) : ''}}" placeholder="00:00">
                                <input type="text" name="fim" class="horas" value="{{isset($user->horario->fim) ? date('H:i', strtotime($user->horario->fim)) : ''}}" placeholder="00:00">
                            </div>
                        </div>

                        <div class="col-12 text-center my-3"><h2>Valores dos Serviços</h2></div>

                        <div class="col-10 caches inputs mb-2">
                            <input type="hidden" class="cache_inputs" value="{{((4+$tipo_servicos->count()) - (isset($user->caches) ? $user->caches->count() : 0))}}">
                            @isset($user->caches)
                                @foreach ($user->caches as $key => $cache)
                                    <div class="cache border rounded my-1 py-2 px-1">
                                        <input type="hidden" name="cache[{{((3+$tipo_servicos->count())+$key)}}][cache_id]" value="{{$cache->id}}">
                                        <select name="cache[{{((3+$tipo_servicos->count())+$key)}}][nome]" class="select2" data-placeholder="Selecione o Serviço">
                                            <option value="15m" @if($cache->nome == '15m') selected @endif>15 Minutos</option>
                                            <option value="30m" @if($cache->nome == '30m') selected @endif>30 Minutos</option>
                                            <option value="1h" @if($cache->nome == '1h') selected @endif>1 Hora</option>
                                            <optgroup label="Serviços adcionais">
                                                @foreach ($tipo_servicos as $tipo_servico)
                                                    <option value="{{$tipo_servico->id}}" @if($cache->nome == $tipo_servico->id) selected @endif>{{$tipo_servico->servico}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        <input type="text" name="cache[{{((3+$tipo_servicos->count())+$key)}}][valor]" value="{{number_format($cache->valor, 2, '.', ',')}}" class="real mt-2" placeholder="Valor do Serviço">
                                    </div>
                                @endforeach
                            @endisset

                            @for ($i = 0; $i < ((4+$tipo_servicos->count()) - (isset($user->caches) ? $user->caches->count() : 0)); $i++)
                                <div class="cache border rounded my-1 py-2 px-1 @if($i >= 1) d-none @endif">
                                    <select name="cache[{{$i}}][nome]" class="select2" data-placeholder="Selecione o Serviço">
                                        <option value="15m">15 Minutos</option>
                                        <option value="30m">30 Minutos</option>
                                        <option value="1h">1 Hora</option>
                                        <optgroup label="Serviços adcionais">
                                            @foreach ($tipo_servicos as $tipo_servico)
                                                <option value="{{$tipo_servico->id}}">{{$tipo_servico->servico}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    <input type="text" name="cache[{{$i}}][valor]" class="real mt-2" placeholder="Valor do Serviço">
                                </div>
                            @endfor
                        </div>

                        <div class="col-10 mb-2 text-center">
                            <button type="button" class="btn btn-c-purple btn-new-chache">ADICIONAR CHACHE</button>
                        </div>

                        <div class="col-10">
                            <div class="row justify-content-between">
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" class="btn btn-c-purple previous">Voltar</button>
                                </div>
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" class="next d-none"></button>
                                    <button type="button" data-target="#form_servicos" data-route="{{route('perfil.dados.atualizar')}}" class="btn btn-c-purple btn-save">Proximo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <section class="field">
                <form id="form_fotos">
                    <input type="hidden" name="step" value="fotos">
                    <div class="row justify-content-center formulario">
                        <div class="col-12 text-center mb-3"><h2>Fotos</h2></div>

                        <div class="col-10 mb-2">
                            <div class="row">
                                @isset($user->fotos)
                                    @foreach ($user->fotos as $foto)
                                        <div class="col-6 col-md-3 mb-2">
                                            <div class="checkbox justify-content-start mb-3">
                                                <input class="me-2" type="checkbox" name="excluir_foto[]" value="{{$foto->id}}" />
                                                <label for="">Excluir Foto?</label>
                                            </div>
                                            <div class="foto">
                                                <img class="rounded img-fluid" src="{{asset('storage/user_'.auth()->user()->id.'/'.$foto->path)}}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset

                                <div class="col-6 col-md-3 mb-2">
                                    <button type="button" class="btn btn-c-purple btn-add-foto">+</button>
                                    <input type="file" name="foto[]" class="d-none add-foto">
                                    <div class="foto"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center my-3"><h2>Publicar?</h2></div>

                        <div class="col-10 checkbox justify-content-start mb-3">
                            <input class="me-2" type="checkbox" name="publish" value="true" @if($user->publish == 1) checked @endif />
                            <label for="">Publicar Perfil?</label>
                        </div>

                        <div class="col-10">
                            <div class="row justify-content-between">
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" class="btn btn-c-purple previous">Voltar</button>
                                </div>
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" class="next d-none"></button>
                                    <button type="button" data-target="#form_fotos" data-route="{{route('perfil.dados.atualizar')}}" class="btn btn-c-purple btn-save">Finalizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </section>
    </div>
@endsection
