<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Painel extends BaseController
{
    public function index()
    {
        // Carrega a view do painel administrativo
        return view('admin/admin');
    }

    public function logout()
    {
        // Encerra a sessão no CodeIgniter Shield
        auth()->logout();

        // Redireciona para a tela de login
        return redirect()->to('login');
    }
}