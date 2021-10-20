<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function conta()
    {
        return view('perfil.conta', get_defined_vars());
    }
}
