<?php

use App\Library\ControllerMain;

class Home extends ControllerMain
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // $categoria = $this->loadModel("Categoria");
        // $this->dados['aCategoria'] = $categoria->lista();

        $menu = [
            [
                'nome' => 'Home',
                'url' => "#",
                'ativo' => true
            ],
            [
                'nome' => 'Carros',
                'url' => "#",
                'ativo' => false
            ],
            [
                'nome' => 'Venda',
                'url' => "#",
                'ativo' => false
            ],
            [
                'nome' => 'Clientes',
                'url' => "#",
                'ativo' => false
            ],
            [
                'nome' => 'Usuários',
                'url' => "#",
                'ativo' => false
            ],
        ];

        $this->loadView("home", ['menu' => $menu]);
    }

    /**
     * produto
     *
     * @return void
     */
    public function produto()
    {
        $CategoriaModel = $this->loadModel("categoria");

        $aCategoria = $CategoriaModel->lista();

        return $this->loadView("produto", $aCategoria);
    }

    /**
     * contato
     *
     * @return void
     */
    public function contato()
    {
        $this->loadView("contato");
    }

    /**
     * login
     *
     * @return void
     */
    public function login()
    {
        return $this->loadView('usuario/login');
    }

    /**
     * homeAdmin
     *
     * @return void
     */
    public function homeAdmin()
    {
        return $this->loadView("restrita/homeAdmin");
    }

    /**
     * criarConta
     *
     * @return void
     */
    public function criarConta()
    {
        $this->loadHelper('Formulario');

        return $this->loadView("usuario/formCriarConta", []);
    }
}
