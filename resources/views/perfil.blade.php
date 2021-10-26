@extends('layouts.main')
@section('content')
<div class="voltar">
    <a href="{{url()->previous()}}">VOLTAR</a>
  </div>
  <div class="container">
    <div class="nome text-center mt-3">
      <p>{{mb_convert_case($perfil->data->nome, MB_CASE_UPPER)}}</p>
    </div>
    <div class="tags">
      <div class="tag">
        <div class="cidade">
          <p>{{$perfil->local->cidade}}</p>
        </div>
      </div>
      <div class="tag">
        <div class="anos">
          <p>{{$perfil->data->idade}} anos</p>
        </div>
      </div>
    </div>
    
    <div class="cliente-descricao mt-3">
      <p>
        {{$perfil->data->descricao}}
      </p>
      {{-- <div class="btn-mais">
        <a class="btn" href="">mais</a>
      </div> --}}
    </div>
    <div class="galeria mt-3 mb-5 row">
      @foreach ($perfil->fotos as $foto)
        <div class="foto col-6 col-md-3 py-2">
          <a href="{{ asset('storage/user_'.$perfil->id.'/'.$foto->path) }}" class="btn-lightbox-image" rel="lightbox-cats">
            <img class="" src="{{ asset('storage/user_'.$perfil->id.'/'.$foto->path) }}" alt="" />
          </a>
        </div>
      @endforeach
      {{-- <div class="foto">
        <img src="{{ url("/assets/img/mulher1.png") }}" alt="" />
      </div>
      <div class="foto">
        <img src="{{ url("/assets/img/mulher4.png") }}" alt="" />
      </div>
      <div class="foto">
        <img src="{{ url("/assets/img/mulher.png") }}" alt="" />
      </div> --}}
    </div>

    <div class="caches mb-3">
      <div>
        <p>MEU CHACHê</p>
      </div>
      <div class="meu-cache">
        @foreach ($perfil->caches as $cache)
          @php
              $horas = [
                '15m' => '15 Minutos',
                '30m' => '30 Minutos',
                '1h' => '1 Hora',
            ];
          @endphp
            @if (in_array($cache->nome, ['15m', '30m', '1h']))
              <span class="cache-bg">R$ {{number_format($cache->valor, 2, ',', '.')}}</span>
              <span class="cache-bg">{{$horas[$cache->nome]}}</span>
            @endif
        @endforeach
        {{-- <span class="cache-bg">R$ 125,00</span>
        <span class="cache-bg">30 minutos</span>
        <span class="cache-bg">R$ 200,00</span>
        <span class="cache-bg">1 hora incluso anal</span>
        <span class="cache-bg">R$ 50,00</span>
        <span class="cache-bg">videochamada</span> --}}
      </div>
    </div>

    <div class="servicos mt-3 mb-3">
      <div>
        <p>meus serviços</p>
      </div>
      <div class="meu-servicos">
        @foreach ($perfil->servicos as $servico)
          <span class="cache-bg">
            {{$servico->servico->servico}}
            @isset ($servicos_adicional[$servico->servico_id])
                (custo adicional R$ {{$servicos_adicional[$servico->servico_id]}})
            @endisset
          </span>
        @endforeach
        {{-- <span class="cache-bg">Oral</span>
        <span class="cache-bg">Massagem erótica</span>
        <span class="cache-bg">Sexo anal</span> --}}
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
