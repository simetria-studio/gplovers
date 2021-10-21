<?php

namespace App\Http\Controllers;

use App\Models\User;

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
        return view('perfil.editarDados', get_defined_vars());
    }

    public function atualizarDados(Request $request)
    {
        switch($request->step){
            case 'info_data':
                return response()->json(['success', 'step', 'next'], 200);
            break;
        }
    }
}
