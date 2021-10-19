@extends('layouts.main')
@section('content')
    <header>
        <div class="container-fluid">
            <div class="layout-grid">
                <div class="logo">
                    <div class="logotipo">
                        <a href="/home">
                            <img src="{{ url('/assets/img/logo.png') }}" alt="logotipo" />
                        </a>
                    </div>
                </div>
                <div class="menu mt-5">
                    <a href="">
                        <img src="{{ url('/assets/img/menu.png') }}" alt="menu" />
                    </a>
                </div>
                <div class="search">
                    <input type="search" name="" id="" placeholder="  ONDE VOCÊ ESTA?" />
                    <div class="lupa">
                        <button>
                            <img src="{{ url('/assets/img/lupa.png') }}" alt="pesquisa" />
                        </button>
                    </div>
                </div>
                <div class="funil">
                    <a href="">
                        <img src="{{ url('/assets/img/funil.png') }}" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="clientes mt-5">
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
        </div>
    </div>
@endsection
