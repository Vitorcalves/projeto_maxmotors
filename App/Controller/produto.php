<?php

use App\Library\ControllerMain;
use App\Library\Redirect;
use App\Library\UploadImages;
use App\Library\Validator;
use App\Library\Session;

class Produto extends ControllerMain
{
    /**
     * construct
     *
     * @param array $dados 
     */
    // public function __construct($dados)
    // {
    //     $this->auxiliarConstruct($dados);

    //     // Somente pode ser acessado por usuários adminsitradores
    //     if (!$this->getAdministrador()) {
    //         return Redirect::page("Home");
    //     }
    // }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $marca = $this->model->getMarcaCombobox();

        $menu = [
            [
                'nome' => 'Home',
                'url' => "#",
                'ativo' => true
            ],
            [
                'nome' => 'Carros',
                'url' => "#",
                'ativo' => true
            ],
            [
                'nome' => 'Venda',
                'url' => "#",
                'ativo' => true
            ],
            [
                'nome' => 'Clientes',
                'url' => "#",
                'ativo' => true
            ],
            [
                'nome' => 'Usuários',
                'url' => "#",
                'ativo' => true
            ],
        ];

        $this->loadView("carro/creat", ['menu' => $menu, 'marca' => $marca]);
    }

    /**
     * form
     *
     * @return void
     */
    public function form()
    {
        $CategoriaModel = $this->loadModel("Categoria");

        $DbDados = [];

        if ($this->getAcao() != 'new') {
            $DbDados = $this->model->getById($this->getId());
        }

        $DbDados['aCategoria'] = $CategoriaModel->lista('descricao');

        return $this->loadView(
            "restrita/formProduto",
            $DbDados
        );
    }

    /**
     * insert
     *
     * @return void
     */
    public function insert()
    {
        $post = $this->getPost();

        if (Validator::make($post, $this->model->validationRules)) {
            // error
            return Redirect::page("produto/form/insert");
        } else {

            if (!empty($_FILES['imagem']['name'])) {

                // Faz uploado da imagem
                $nomeRetornado = UploadImages::upload($_FILES, 'imagem');

                // se for boolean, significa que o upload falhou
                if (is_bool($nomeRetornado)) {
                    Session::set('inputs', $post);
                    return Redirect::page("Produto/form/update/" . $post['id']);
                }
            } else {
                $nomeRetornado = $post['imagem'];
            }

            if ($this->model->insert([
                "modelo"            => $post['modelo'],
                "descricao"         => $post['descricao'],
                "cor"               => $post['cor'],
                "marca"             => $post['id'],
                "preco"             => strNumber($post['preco']),
                "quantidade"        => strNumber($post['quantidade']),
                "imagem"            => $nomeRetornado
            ])) {
                Session::set("msgSuccess", "Produto adicionado com sucesso.");
            } else {
                Session::set("msgError", "Falha tentar inserir um novo Produto.");
            }

            Redirect::page("produto");
        }
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $post = $this->getPost();

        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page("Produto/form/update/" . $post['id']);    // error
        } else {

            if (!empty($_FILES['imagem']['name'])) {

                // Faz uploado da imagem
                $nomeRetornado = UploadImages::upload($_FILES, 'produto');

                // se for boolean, significa que o upload falhou
                if (is_bool($nomeRetornado)) {
                    Session::set('inputs', $post);
                    return Redirect::page("Produto/form/update/" . $post['id']);
                }

                UploadImages::delete($post['nomeImagem'], 'produto');
            } else {
                $nomeRetornado = $post['nomeImagem'];
            }

            if ($this->model->update(
                [
                    "id" => $post['id']
                ],
                [
                    "descricao"         => $post['descricao'],
                    "caracteristicas"   => $post['caracteristicas'],
                    "statusRegistro"    => $post['statusRegistro'],
                    "categoria_id"      => $post['categoria_id'],
                    "saldoEmEstoque"    => strNumber($post['saldoEmEstoque']),
                    "precoVenda"        => strNumber($post['precoVenda']),
                    "precoPromocao"     => strNumber($post['precoPromocao']),
                    "custoTotal"        => strNumber($post['custoTotal']),
                    'imagem'            => $nomeRetornado
                ]
            )) {
                Session::set("msgSuccess", "Produto alterada com sucesso.");
            } else {
                Session::set("msgError", "Falha tentar alterar a Produto.");
            }

            return Redirect::page("Produto");
        }
    }
    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        if ($this->model->delete(["id" => $this->getPost('id')])) {
            Session::set("msgSuccess", "Produto excluída com sucesso.");
        } else {
            Session::set("msgError", "Falha tentar excluir a Produto.");
        }

        Redirect::page("Produto");
    }

    /**
     * getProdutoCombo
     *
     * @return string
     */
    public function getProdutoComboBox()
    {
        $dados = $this->model->getProdutoComboBox($this->getId());

        if (count($dados) == 0) {
            $dados[] = [
                "id" => "",
                "descricao" => "... Selecione uma Categoria ..."
            ];
        }

        echo json_encode($dados);
    }
}