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
                            <input class="me-2" type="checkbox" name="tatuagem" value="true" @isset($user->sobre->tatuagem) @if($user->sobre->tatuagem == 'SIM') selected @endif @endisset />
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
                            <input type="text" name="olhos" placeholder="Seus Olhos" value="{{$user->sobre->olhos}}" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="cabelo" placeholder="Seu Cabelo" value="{{$user->sobre->cabelo}}" />
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
                            <select name="lugar_id" class="select2">
                                <option value="">- Selecione os Lugares -</option>
                                @foreach ($tipo_lugares as $tipo_lugar)
                                    <option value="{{$tipo_lugar->id}}">{{$tipo_lugar->lugar}}</option>
                                @endforeach
                            </select>
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

            {{-- <section>
                <form action="">
                    <h2 class="fs-title">Personal Details</h2>
                    <input type="text" name="fname" placeholder="First Name" />
                    <input type="text" name="lname" placeholder="Last Name" />
                    <input type="text" name="phone" placeholder="Phone" />
                    <textarea name="address" placeholder="Address"></textarea>
                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                    <input type="submit" name="submit" class="submit action-button" value="Submit" />
                </form>
            </section> --}}
        </section>
        {{-- <form id="form_atualizarConta" method="POST">
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
        </form> --}}
    </div>
@endsection
