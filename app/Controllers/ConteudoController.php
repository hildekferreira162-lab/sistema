<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConteudoModel;
use CodeIgniter\Exceptions\PageNotFoundException; // Importação que estava faltando

class ConteudoController extends BaseController
{
    protected $helpers = ['url', 'form']; // Adicionado 'form' caso use set_value() na view

    public function index(): string
    {
        $ConteudoModel = new ConteudoModel();
        $dados['conteudo'] = $ConteudoModel->find(1);

        return view('home', $dados);
    }

    public function contatos(): string
    {
        $ConteudoModel = new ConteudoModel();
        $dados['conteudo'] = $ConteudoModel->find(3);

        return view('contatos', $dados);
    }

    public function listar(): string
    {
        $model = new ConteudoModel();

        return view('conteudo/listar', [
            'conteudos' => $model->findAll(),
        ]);
    }

    public function editar($id): string
    {
        $model = new ConteudoModel();
        $conteudo = $model->find($id);

        if ($conteudo === null) {
            throw PageNotFoundException::forPageNotFound(
                'O conteúdo solicitado não foi encontrado.'
            );
        }

        // Corrigido: primeiro parâmetro é string, o segundo é o array de dados
        return view('conteudo/editar', [
            'conteudo' => $conteudo,
            'erros' => [],
        ]);
    }

    public function atualizar($id)
    {
        $model = new ConteudoModel();
        $conteudo = $model->find($id);

        if ($conteudo === null) {
            throw PageNotFoundException::forPageNotFound(
                'O conteúdo solicitado não foi encontrado.'
            );
        }

        $dadosPost = [
            'Titulo' => $this->request->getPost('Titulo'),
            'Texto'  => $this->request->getPost('Texto'),
        ];

        $regras = [
            'Titulo' => 'required|max_length[255]',
            'Texto'  => 'required',
        ];

        if (! $this->validate($regras)) {
            $conteudo['Titulo'] = $dadosPost['Titulo'] ?? '';
            $conteudo['Texto']  = $dadosPost['Texto'] ?? '';

            return view('conteudo/editar', [
                'conteudo' => $conteudo,
                'erros'    => $this->validator->getErrors(),
            ]);
        }

        $model->update($id, $dadosPost);

        return redirect()
            ->to(site_url('conteudos'))
            ->with('mensagem', 'Conteúdo atualizado com sucesso.');
    }
}