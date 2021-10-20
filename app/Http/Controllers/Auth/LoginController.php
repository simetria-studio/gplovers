<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $cookie_maior18 = !empty($_COOKIE['cookie_maior18']) ? $_COOKIE['cookie_maior18'] : null;

        $remember = $request->remember ? true : false;

        $authValid = Auth::guard('web')->validate(['email' => $request->email, 'password' => $request->password]);
        
        if($authValid){
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password],$remember)) {

                if($cookie_maior18) setcookie('cookie_maior18', $cookie_maior18, null, '/');
                return response()->json(route('perfil'), 200);
            }
        }else{
            return response()->json(['invalid' => 'CPF ou Senha invalidos'], 422);
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        return redirect()->route('login');
    }
}
