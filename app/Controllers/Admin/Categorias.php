<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CatModel;

class Categorias extends BaseController
{
    public function index()
    {
        $model = new CatModel();
        $data =
            [
                'title' => 'Categorias',
                'categorias' => $model->paginate(10),
                'pager' => $model->pager,
                'msg' => '',
            ];

        echo view('backend/templates/html-header', $data);
        echo view('backend/templates/header');
        echo view('backend/pages/categorias');
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }

    public function editar($id = null)
    {
        $model = new CatModel();
        $data =
            [
                'title' => 'Editar Categorias',
                'categorias' => $model->getCat($id),
                'msg' => '',
            ];

        if (empty($data['categorias'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Página não encontrada. ID da página :' . $id);
        }

        echo view('backend/templates/html-header', $data);
        echo view('backend/templates/header');
        echo view('backend/pages/categorias_editar');
        echo view('backend/templates/footer');
        echo view('backend/templates/html-footer');
    }

    public function gravar()
    {

        $model = new CatModel();
        helper('form');

        if ($this->validate(
            [
                'titulo' => ['label' => 'Titulo', 'rules' => 'required|min_length[3]'],
                'resumo' => ['label' => 'Resumo',  'rules' => 'required|min_length[3]'],
            ]
        )) {

            $id = $this->request->getVar('id');
            $titulo = $this->request->getVar('titulo');
            $resumo = $this->request->getVar('resumo');

            $model->save([
                'id' => $id,
                'titulo' => $titulo,
                'resumo' => $resumo,
            ]);

            $data =
                [
                    'title' => 'Categorias',
                    'categorias' => $model->paginate(10),
                    'pager' => $model->pager,
                    'msg' => 'Categoria cadastrada com sucesso!',
                ];

            echo view('backend/templates/html-header', $data);
            echo view('backend/templates/header');
            echo view('backend/pages/categorias', $data);
            echo view('backend/templates/footer');
            echo view('backend/templates/html-footer');
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
            echo view('backend/pages/categorias', $data);
            echo view('backend/templates/footer');
            echo view('backend/templates/html-footer');
        }
    }
    public function excluir($id = null)
    {
        $model = new CatModel();
        $model->delete($id);
        return redirect()->to(base_url('admin/categorias'));
    }
}
