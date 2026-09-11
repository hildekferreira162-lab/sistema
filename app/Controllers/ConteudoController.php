<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ConteudoModel;
class ConteudoController extends BaseController
{
    public function index()
    {
        $ConteudoModel = new ConteudoModel();
        $dados['Conteudo'] = $ConteudoModel->find(1);
        return view('home', $dados);
    }

    public function contatos(): string
    {
        $ConteudoModel = new ConteudoModel();
        $dados['Conteudo'] = $ConteudoModel->find(3);
        return view('contatos',  $dados);

    }
}
