@extends('layouts.main')
@section('content')
<div class="voltar">
    <a href="/home">VOLTAR</a>
  </div>
  <div class="container">
    <div class="nome text-center mt-3">
      <p>DANIELE MATTOS</p>
    </div>
    <div class="tags">
      <div class="tag">
        <div class="cidade">
          <p>curitiba</p>
        </div>
      </div>
      <div class="tag">
        <div class="anos">
          <p>27 anos</p>
        </div>
      </div>
      <div class="tag">
        <div class="cache">
          <p>R$ 150,00</p>
        </div>
      </div>
    </div>
    
    <div class="cliente-descricao mt-3">
      <p>
        Olá meu safado, me chamo Danille Mattos, sou uma massagista carioca e
        pela primeira vez na capital mineira. Sou estilo paniquet de seios
        fartos, cintura fina e bumbum extra grande durinho e delicioso que
        encaixam perfeitamente na minha altura.
      </p>
      <div class="btn-mais">
        <a class="btn" href="">mais</a>
      </div>
    </div>
    <div class="galeria mt-3 mb-5">
      <div class="foto">
        <img src="{{ url("/assets/img/mulher1.png") }}" alt="" />
      </div>
      <div class="foto-1">
        <img src="{{ url("/assets/img/mulher4.png") }}" alt="" />
      </div>
      <div class="foto-2">
        <img src="{{ url("/assets/img/mulher.png") }}" alt="" />
      </div>
    </div>

    <div class="caches mb-3">
      <div>
        <p>MEU CHACHê</p>
      </div>
      <div class="meu-cache">
        <span class="cache-bg">R$ 150,00</span>
        <span class="cache-bg">1 hora</span>
        <span class="cache-bg">R$ 125,00</span>
        <span class="cache-bg">30 minutos</span>
        <span class="cache-bg">R$ 200,00</span>
        <span class="cache-bg">1 hora incluso anal</span>
        <span class="cache-bg">R$ 50,00</span>
        <span class="cache-bg">videochamada</span>
      </div>
    </div>

    <div class="servicos mt-3 mb-3">
      <div>
        <p>meus serviços</p>
      </div>
      <div class="meu-servicos">
        <span class="cache-bg">Beijos na boca</span>
        <span class="cache-bg">Duplas</span>
        <span class="cache-bg">Oral</span>
        <span class="cache-bg">Massagem erótica</span>
        <span class="cache-bg">Sexo anal</span>
      </div>
    </div>

    <div class="lugar mt-3 mb-3">
      <div>
        <p>lugar de encontro</p>
      </div>
      <div class="encontro">
        <span class="cache-bg">A domicilio</span>
        <span class="cache-bg">Com local</span>
        <span class="cache-bg">Em Hotel</span>
      </div>
    </div>
  </div>
  <div class="rodape">
      <div class="whatsapp">
          <a href="">
              <span>whatsapp</span>
          </a>
      </div>
      <div class="mapa">
          <a href="">
              <span>mapa</span>
          </a>
      </div>
      <div class="fone">
          <a href="">
              <span>fone</span>
          </a>
      </div>
  </div>
@endsection
