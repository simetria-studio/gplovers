<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dado;
use App\Models\Contato;
use App\Models\Sobre;
use App\Models\Local;
use App\Models\TipoLugar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PerfilController extends Controller
{
    public function conta()
    {
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
        return view('perfil.dados', get_defined_vars());
    }

    public function editarDados()
    {
        $user = auth()->user();
        $tipo_lugares = TipoLugar::all();
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
        }
    }
}
