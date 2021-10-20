<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required',
        ];

        $customMessages = [
            'name.required' => 'O campo Nome é obrigatório!',
            'email.required' => 'O campo Email é obrigatório!',
            'email.unique' => 'Já existe um Email desse registrado!',
            'password.required' => 'O campo Senha é Obrigatório!',
            'password.confirmed' => 'O campo Senha não confere!',
            'terms.required' => 'O campo Termos e Condições deve ser aceito!',
        ];

        $this->validate($request, $rules, $customMessages);

        $save = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return response()->json(route('perfil.conta'), 200);
        }
    }
}
