<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Bairro;
use App\Models\Dado;
use App\Models\Contato;
use App\Models\Sobre;
use App\Models\Local;
use App\Models\TipoLugar;
use App\Models\TipoServico;
use App\Models\Lugar;
use App\Models\Servico;
use App\Models\Horario;
use App\Models\Cache;
use App\Models\Foto;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public $olhos = [
        'Azul',
        'Castanho',
        'Verde',
        'Outros',
    ];

    public $cabelos = [
        'Ruivo',
        'Castanho',
        'Branco',
        'Outros',
    ];

    public function buscaAutocomplete(Request $request)
    {
        $dados = [];
        switch ($request->tabela){
            case 'cidade':
                $cidades = Cidade::where('titulo', 'LIKE', '%'.$request->nome.'%')->limit(100)->get();
                foreach($cidades as $cidade){
                    $dados[] = $cidade->titulo;
                }
            break;
            default:
                return response()->json('Infome uma tabela valida', 412);
            break;
        }

        return response()->json($dados, 200);
    }

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

    public function buscaAnuncios(Request $request)
    {
        // \Log::info($request->all());
        $perfis = User::with('fotos','local','data','caches')->where('publish', 1)
        ->whereHas('caches', function ($query) use ($request) {
            return $query->where('valor', '>=', (str_replace(['.',','],['','.'],$request->menor_valor)))->where('valor', '<=', (str_replace(['.',','],['','.'],$request->maior_valor)));
        })
        ->whereHas('servicos', function ($query) use ($request) {
            if(isset($request->tipo_servico)){
                return $query->whereIn('servico_id', $request->tipo_servico);
            }
        })
        ->whereHas('lugares', function ($query) use ($request) {
            if(isset($request->tipo_lugar)){
                return $query->whereIn('lugar_id', $request->tipo_lugar);
            }
        })
        ->whereHas('sobre', function ($query) use ($request) {
            $query_return = null;
            if(isset($request->etnias)){
                $query_return = $query->whereIn('etnia', $request->etnias);
            }
            if(isset($request->peitos)){
                $query_return = $query->whereIn('peitos', $request->peitos);
            }
            if(isset($request->olhos)){
                $query_return = $query->whereIn('olhos', $request->olhos);
            }
            if(isset($request->cabelo)){
                $query_return = $query->whereIn('cabelo', $request->cabelo);
            }

            if($query_return) return $query_return;
        })
        ->whereHas('local', function ($query) use ($request) {
            return $query->where('cidade', 'LIKE', '%'.$request->cidade.'%');
        })->orderBy('updated_at', 'DESC')->get();

        return response()->json($perfis, 200);
    }

    public function geraSlug(Request $request)
    {
        $slug = Str::slug($request->nome).'-'.$request->id;
        return response()->json(['route' => route('perfil.anuncio', $slug), 'slug' => $slug]);
    }

    public function home()
    {
        $olhos = $this->olhos;
        $cabelos = $this->cabelos;
        $tipo_lugares = TipoLugar::all();
        $tipo_servicos = TipoServico::all();

        $perfis = User::where('publish', 1)->orderBy('updated_at', 'DESC')->get();

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
