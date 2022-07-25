<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CatModel;
use App\Models\NotModel;

class Noticias extends BaseController
{
    public function index()
    {
        $model = new NotModel();
        $model2 = new CatModel();
        $data =
            [
                'title' => 'Notícias',
                'noticias' => $model->paginate(10),
                'categorias' => $model2->getCat(),
                'pager' => $model->pager,
                'msg' => '',
            ];

        echo view('backend/templates/html-header', $data);
        echo view('backend/templates/header');
        echo view('backend/pages/noticias');
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }

    public function editar($id = null)
    {
        $model = new NotModel();
        $model2 = new CatModel();

        $data =
            [
                'title' => 'Notícias',
                'noticias' => $model->getNoticias($id),
                'categorias' => $model2->getCat(),
                'msg' => '',
            ];

        if (empty($data['noticias'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Notícia não encontrada. ID da notícia :' . $id);
        }

        echo view('backend/templates/html-header', $data);
        echo view('backend/templates/header');
        echo view('backend/pages/noticia_editar');
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }

    //  Método gravar do controlador Notícias
    public function gravar()
    {
        //  Carrega as models a serem gravadas
        $model = new NotModel();
        $model2 = new CatModel();
        helper('form');

        /*  
        Verifica se os campos são válidos para edição seguindo as regras estabelecidas, caso seja válido,
        então o método save() será executado, caso contrário, o método errors() será executado. Vale ressaltar
        que os atributos da tabela estão sendo atribuitos a variáveis de mesmo nome ou nome similar.
        */

        if ($this->validate(
            [
                'titulo'    => ['label' => 'Titulo', 'rules' => 'required|min_length[3]'],
                'resumo'    => ['label' => 'Resumo',  'rules' => 'required|min_length[3]'],
                'conteudo'  => ['label' => 'conteudo',  'rules' => 'required|min_length[3]'],
                'categoria' => ['label' => 'categoria', 'rules' => 'required'],
            ]
        )) {

            $id        = $this->request->getVar('id');
            $categoria = $this->request->getVar('categoria');
            $destaque  = $this->request->getVar('destaque');
            $titulo    = $this->request->getVar('titulo');
            $resumo    = $this->request->getVar('resumo');
            $conteudo  = $this->request->getVar('conteudo');
            $resumo    = $this->request->getVar('resumo');
            $img       = $this->request->getFile('img');

            /*
            Verifica se a foto foi enviada e se é válida. Está utilizando o sinal de negação ! 
            para caso não tenha sido enviada, a variável img será armazenada como null na tabela
            e o sistema irá salvar a notícia sem a imagem, retornando a tela noticias.
            */
            if (!$img->isValid()) {
                $model->save(
                    [
                        'id'        => $id,
                        'cat'       => $categoria,
                        'destaque'  => $destaque,
                        'titulo'    => $titulo,
                        'resumo'    => $resumo,
                        'conteudo'  => $conteudo,
                    ]
                );

                $data =
                    [
                        'title' => 'Notícias',
                        'noticias' => $model->paginate(10),
                        'categorias' => $model2->getCat(),
                        'pager' => $model->pager,
                        'msg' => 'Notícia cadastrada!',
                    ];

                echo view('backend/templates/html-header', $data);
                echo view('backend/templates/header');
                echo view('backend/pages/noticias');
                echo view('backend/templates/footer');
                echo view('backend/templates/html-footer');
            } else {

                $validacaoIMG = $this->validate([
                    'img' =>
                    [
                        'uploaded[img]',
                        'mime_in[img,image/png,image/jpg,image/jpeg]',
                        'max_size[img,4096]'
                    ],
                ]);

                /*
                Caso a imagem tenha passado a validação acima, o if abaixo atribui         
                um nome aleatório a imagem e retorna a página noticias.
                */
                if ($validacaoIMG) {
                    $novoNome = $img->getRandomName();
                    $img->move('img/noticias', $novoNome);

                    $model->save(
                        [
                            'id'        => $id,
                            'cat'       => $categoria,
                            'destaque'  => $destaque,
                            'titulo'    => $titulo,
                            'resumo'    => $resumo,
                            'conteudo'  => $conteudo,
                        ]
                    );
                    $data =
                        [
                            'title' => 'Notícias',
                            'noticias' => $model->paginate(10),
                            'categorias' => $model2->getCat(),
                            'pager' => $model->pager,
                            'msg' => 'Notícia cadastrada!',
                        ];
                    echo view('backend/templates/html-header', $data);
                    echo view('backend/templates/header');
                    echo view('backend/pages/noticias');
                    echo view('backend/templates/footer');
                    echo view('backend/templates/html-footer');
                }
            }

            $model->save(
                [
                    'id'        => $id,
                    'cat'       => $categoria,
                    'destaque'  => $destaque,
                    'titulo'    => $titulo,
                    'resumo'    => $resumo,
                    'conteudo'  => $conteudo,
                ]
            );
            $data =
                [
                    'title' => 'Notícias',
                    'noticias' => $model->paginate(10),
                    'categorias' => $model2->getCat(),
                    'pager' => $model->pager,
                    'msg' => 'Notícia cadastrada!',
                ];
        //Erro ao cadastrar a notícia
        } else {
            $data =
                [
                    'title' => 'Categorias',
                    'categorias' => $model->paginate(10),
                    'pager' => $model->pager,
                    'msg' => 'Erro ao cadastrar categoria',
                ];

            echo view('backend/templates/html-header', $data);
            echo view('backend/templates/header');
            echo view('backend/pages/noticias', $data);
            echo view('backend/templates/footer');
            echo view('backend/templates/html-footer');
        }
    }

    //Função para deletar uma notícia
    public function excluir($id = null)
    {
        $model = new NotModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/noticias'));
    }
}
