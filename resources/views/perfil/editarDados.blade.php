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
            </ul>
            <section class="field">
                <form id="form_dados">
                    <input type="hidden" name="step" value="info_data">
                    <div class="row justify-content-center formulario">
                        <div class="col-12 text-center mb-3"><h2>Informações e Contatos</h2></div>

                        <div class="col-10 inputs mb-2">
                            <input type="text" name="nome" placeholder="Nome" value="{{auth()->user()->name}}" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <select name="idade">
                                <option value="">- Selecione a Idade -</option>
                                @for ($i = 0; $i <= 83; $i++)
                                    <option value="{{(18+$i)}}">{{(18+$i)}} Anos</option>
                                @endfor
                            </select>
                            {{-- <input type="password" name="pass" placeholder="Password" /> --}}
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="telefone" placeholder="Telefone" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="whats" placeholder="Whatsapp" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="twitter" placeholder="Link do Twitter" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="instagram" placeholder="Link do Instagram" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="titulo" placeholder="Titulo da publicação" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <textarea name="descricao" placeholder="Escreva um pouco sobre Você"></textarea>
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
                    <input type="hidden" name="step" value="info_data">
                    <div class="row justify-content-center formulario">
                        <div class="col-12 text-center mb-3"><h2>Sobre Você</h2></div>

                        <div class="col-10 inputs mb-2">
                            <input type="text" name="nome" placeholder="Nome" value="{{auth()->user()->name}}" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <select name="idade">
                                <option value="">- Selecione a Idade -</option>
                                @for ($i = 0; $i <= 83; $i++)
                                    <option value="{{(18+$i)}}">{{(18+$i)}} Anos</option>
                                @endfor
                            </select>
                            {{-- <input type="password" name="pass" placeholder="Password" /> --}}
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="twitter" placeholder="Link do Twitter" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="instagram" placeholder="Link do Instagram" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="text" name="titulo" placeholder="Titulo da publicação" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <textarea name="descricao" placeholder="Escreva um pouco sobre Você"></textarea>
                        </div>

                        <div class="col-10">
                            <div class="row justify-content-between">
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" class="btn btn-c-purple previous">Voltar</button>
                                </div>
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" class="next d-none"></button>
                                    <button type="button" class="btn btn-c-purple next">Proximo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <section class="field">
                <form id="form_dados3">
                    <div class="row justify-content-center formulario">
                        <div class="col-12 text-center mb-3"><h2>Dados de contato</h2></div>

                        <div class="col-10 inputs mb-2">
                            <input type="text" name="email" placeholder="Email" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="password" name="pass" placeholder="Password" />
                        </div>
                        <div class="col-10 inputs mb-2">
                            <input type="password" name="cpass" placeholder="Confirm Password" />
                        </div>

                        <div class="col-10">
                            <div class="row justify-content-end">
                                <div class="col-5 d-grid mt-2">
                                    <button type="button" name="next" class="btn btn-c-purple next">Proximo</button>
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
