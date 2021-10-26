<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Bairro;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function buscaEstado()
    {
        $estados = Estado::get();
        return response()->json($estados);
    }
    public function buscaCidade($id)
    {
        $cidades = Cidade::where('localidade_estado_id', $id)->get();
        return response()->json($cidades);
    }
    public function buscaBairro($id)
    {
        $bairros = Bairro::where('localidade_municipio_id', $id)->get();
        return response()->json($bairros);
    }

    public function home()
    {
        $perfis = User::where('publish', 1)->get();
        return view('home', get_defined_vars());
    }

    public function anuncio($slug)
    {
        $slug = explode('-', $slug);
        $id = $slug[count($slug)-1];
        $perfil = User::find($id);

        $servicos_adicional = [];
        foreach ($perfil->caches as $caches_add){
            if(!in_array($caches_add->nome, ['15m', '30m', '1h'])){
                $servicos_adicional[$caches_add->nome] = $caches_add->valor;
            }
        }

        return view('perfil', get_defined_vars());
    }
}
