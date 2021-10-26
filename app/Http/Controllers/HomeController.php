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
}
