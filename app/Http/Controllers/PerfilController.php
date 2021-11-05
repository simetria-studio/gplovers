<?php

namespace App\Http\Controllers;

use App\Models\User;
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
use App\Models\Plan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public $dias = [
        'Domingo',
        'Segunda',
        'Terça',
        'Quarta',
        'Quinta',
        'Sexta',
        'Sábado',
    ];

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

    public $pes = [
        '34',
        '35',
        '36',
        '37',
        '38',
        '39',
        '40',
        '41',
        '42',
        '43',
        '44',
    ];

    public function conta()
    {
        $plan = Plan::where('user_id', auth()->user()->id)->where('status', 1)->get();
        return view('perfil.conta', get_defined_vars());
    }

    public function editarConta()
    {
        return view('perfil.editarConta', get_defined_vars());
    }

    public function updateConta(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,'.auth()->user()->id,
            'password' => (isset($request->password) ? 'string|min:8|confirmed' : ''),
        ];

        $customMessages = [
            'name.required' => 'O campo Nome é obrigatório!',
            'email.required' => 'O campo Email é obrigatório!',
            'email.unique' => 'Já existe um Email desse registrado!',
            'password.confirmed' => 'O campo Senha não confere!',
            'password.min' => 'A senha deve ter pelo menos 8 Caracteres!',
        ];

        $this->validate($request, $rules, $customMessages);

        $user['name'] = $request->name;
        $user['email'] = $request->email;
        if(isset($request->password)) $user['password'] = $Hash::make($request->password);

        User::find(auth()->user()->id)->update($user);

        return response()->json(['success', 'redirect', route('perfil.conta')], 200);
    }

    // Dados do perfil
    public function dados()
    {
        $user = auth()->user();
        return view('perfil.dados', get_defined_vars());
    }

    public function editarDados()
    {
        $dias = $this->dias;
        $olhos = $this->olhos;
        $cabelos = $this->cabelos;
        $pes = $this->pes;

        $user = auth()->user();
        $tipo_lugares = TipoLugar::all();
        $tipo_servicos = TipoServico::all();
        $lugares = [];
        if(isset($user->lugares)){
            foreach($user->lugares as $lugar){
                $lugares[] = $lugar->lugar_id;
            }
        }
        $servicos = [];
        if(isset($user->servicos)){
            foreach($user->servicos as $servico){
                $servicos[] = $servico->servico_id;
            }
        }

        return view('perfil.editarDados', get_defined_vars());
    }

    public function atualizarDados(Request $request)
    {
        switch($request->step){
            case 'info_data':
                $dado = Dado::where('user_id', auth()->user()->id);
                $dados['user_id']   = auth()->user()->id;
                $dados['titulo']    = $request->titulo;
                $dados['descricao'] = $request->descricao;
                $dados['nome']      = $request->nome;
                $dados['idade']     = $request->idade;
                $dados['twitter']   = $request->twitter;
                $dados['instagram'] = $request->instagram;

                if($dado->first()){
                    $dado->update($dados);
                }else{
                    Dado::create($dados);
                }

                $contato = Contato::where('user_id', auth()->user()->id);
                $contatos['user_id']    = auth()->user()->id;
                $contatos['telefone']   = $request->telefone;
                $contatos['whats']      = isset($request->whats) ? 1 : 0;

                if($contato->first()){
                    $contato->update($contatos);
                }else{
                    Contato::create($contatos);
                }

                return response()->json(['success', 'step', 'next'], 200);
            break;
            case 'sobre':
                $sobre = Sobre::where('user_id', auth()->user()->id);
                $sobres['user_id']   = auth()->user()->id;
                $sobres['tamanho']   = str_replace(',','.', $request->tamanho);
                $sobres['etnia']     = $request->etnia;
                $sobres['peso']      = str_replace(',','.', $request->peso);
                $sobres['tatuagem']  = isset($request->tatuagem) ? 'SIM' : 'NÃO';
                $sobres['peitos']    = $request->peitos;
                $sobres['olhos']     = $request->olhos;
                $sobres['cabelo']    = $request->cabelo;
                $sobres['pes']       = $request->pes;

                if($sobre->first()){
                    $sobre->update($sobres);
                }else{
                    Sobre::create($sobres);
                }

                return response()->json(['success', 'step', 'next'], 200);
            break;
            case 'local':
                $local = Local::where('user_id', auth()->user()->id);
                $locals['user_id']   = auth()->user()->id;
                $locals['estado']    = $request->estado;
                $locals['cidade']    = $request->cidade;
                $locals['bairro']    = $request->bairro;

                if($local->first()){
                    $local->update($locals);
                }else{
                    Local::create($locals);
                }

                return response()->json(['success', 'step', 'next'], 200);
            break;
            case 'servicos':
                $lugar = Lugar::where('user_id', auth()->user()->id)->delete();
                $servico = Servico::where('user_id', auth()->user()->id)->delete();

                foreach($request->lugar_id as $lid) {
                    $lugares['user_id']     = auth()->user()->id;
                    $lugares['lugar_id']    = $lid;

                    Lugar::create($lugares);
                }

                foreach($request->servico_id as $sid) {
                    $servicos['user_id']     = auth()->user()->id;
                    $servicos['servico_id']    = $sid;

                    Servico::create($servicos);
                }

                $horario = Horario::where('user_id', auth()->user()->id);

                $horarios['user_id']    = auth()->user()->id;
                $horarios['dias']       = $request->dias;
                $horarios['inicio']     = isset($request['24horas']) ? '00:00' : date('H:i:s', strtotime($request->inicio));
                $horarios['fim']        = isset($request['24horas']) ? '00:00' : date('H:i:s', strtotime($request->fim));
                $horarios['24horas']    = isset($request['24horas']) ? 1 : 0;

                if($horario->get()->count() > 0){
                    $horario->update($horarios);
                }else{
                    Horario::create($horarios);
                }

                foreach($request->cache as $cache){
                    $caches = [];
                    if($cache['valor']) {
                        $caches['user_id'] = auth()->user()->id;
                        $caches['nome'] = $cache['nome'];
                        $caches['valor'] = str_replace(['.',','], ['','.'], $cache['valor']);
                    }

                    if(isset($cache['cache_id'])){
                        if($cache['valor'] == null){
                            Cache::find($cache['cache_id'])->delete();
                        }else {
                            Cache::find($cache['cache_id'])->update($caches);
                        }
                    }else{
                        if($cache['valor']){
                            Cache::create($caches);
                        }
                    }
                }

                return response()->json(['success', 'step', 'next'], 200);
            break;
            case 'fotos':
                $originalPath = storage_path('app/public/user_'.auth()->user()->id.'/');
                if (!file_exists($originalPath)) {
                    mkdir($originalPath, 0777, true);
                }

                if(isset($request->foto)){
                    foreach ($request->foto as $foto){
                        $img = Image::make($foto);

                        $name = Str::random() . '.jpg';

                        $img->save($originalPath . $name);

                        Foto::create([
                            'user_id' => auth()->user()->id,
                            'path' => $name
                        ]);
                    }
                }

                if(isset($request->excluir_foto)) {
                    foreach($request->excluir_foto as $excluir_foto){
                        $foto = Foto::find($excluir_foto);
                        Storage::delete('public/user_'.auth()->user()->id.'/'.$foto->path);

                        $foto->delete();
                    }
                }

                if(isset($request->publish)) {
                    User::find(auth()->user()->id)->update(['publish' => 1]);
                }else{
                    User::find(auth()->user()->id)->update(['publish' => 0]);
                }

                return response()->json(['success', 'step', 'finish', route('perfil.dados')], 200);
            break;
        }
    }
}
