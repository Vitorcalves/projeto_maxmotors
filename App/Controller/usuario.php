<?php

use App\Library\ControllerMain;
use App\Library\Session;
use App\Library\Redirect;
use App\Library\Validator;

class Usuario extends ControllerMain
{
    /**
     * lista
     *
     * @return void
     */
    public function index()
    {
        // Somente pode ser acessado por usuários adminsitradores
        // if (!$this->getAdministrador()) {
        //     return Redirect::page("Home");
        // }
        $usuarios = $this->model->getLista();
        $menu = [
            [
                'nome' => 'Home',
                'url' => "#",
                'ativo' => false
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
                'ativo' => true
            ],
        ];

        $this->loadView("usuario/listUser", ['menu' => $menu, 'usuarios' => $usuarios]);
    }

    /**
     * form
     *
     * @return void
     */
    public function form()
    {
        $nivel = $this->model->getNivel();
        $usuario = null;
        $menu = [
            [
              'nome' => 'Home',
              'url' => baseurl(). "home",
              'ativo' => false
            ],
            [
              'nome' => 'Carros',
              'url' => baseUrl(). "produto",
              'ativo' => false
            ],
            [
              'nome' => 'Venda',
              'url' => "#",
              'ativo' => false
            ],
            [
              'nome' => 'Clientes',
              'url' => baseUrl(). "cliente",
              'ativo' => false
            ],
            [
              'nome' => 'Usuários',
              'url' => baseUrl(). "Usuario",
              'ativo' => true
            ],
          ];



        if ($this->getAcao() != 'new') {
            // buscar o usuário pelo $id no banco de dados
            $getId = $this->getId();
            $usuario = $this->model->getById($getId);
        }
        $this->loadView("usuario/formUser", ['menu' => $menu, 'nivel' => $nivel, 'usuario' => $usuario]);
    }

    /**
     * new - insere um novo usuário
     *
     * @return void
     */
    public function insert()
    {
        try {
            $post = $this->recebeJson();
            $return = $this->model->criatUsuario($post);
            return $this->toJson($return, 200);
        } catch (\Throwable $th) {
            return $this->toJson(['error' => $th->getMessage()], 400);
        }
    }


    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $post = $this->recebeJson();
        if (Validator::make($post, $this->model->validationRules)) {
            return Redirect::page("usuario/form/update");
        } else {

            if ($this->model->update(['id' => $post['id']], [
                "nome" => $post['nome'],
                "nivel" => $post['Nivel'],
                "email" => $post['email']
            ])) {
                return $this->toJson(['msgSuccess' => 'Usuário atualizado com sucesso !'], 200);
            }
        }
    }

    /**
     * delete -   Exclui um usuário no banco de dados
     *
     * @return void
     */
    public function delete()
    {
        $post = $this->getPost();

        if ($this->model->delete(["id" => $post['id']])) {
            return Redirect::page("Usuario", ["msgSuccess" => "Usuário excluído com sucesso !"]);
        } else {
            return Redirect::page("Usuario", ["msgError" => "Falha na exclusão do Usuário !"]);
        }
    }

    /**
     * trocaSenha - Chama a view Trocar a senha
     *
     * @return void
     */
    public function trocaSenha()
    {
        $this->loadView("usuario/formTrocaSenha");
    }

    /**
     * atualizaSenha - Atualiza a senha do usuário
     *
     * @return void
     */
    public function atualizaTrocaSenha()
    {
        $post = $this->getPost();
        $userAtual = $this->model->getById($post["id"]);

        if ($userAtual) {

            if (password_verify(trim($post["senhaAtual"]), $userAtual['senha'])) {

                if (trim($post["novaSenha"]) == trim($post["novaSenha2"])) {

                    $lUpdate = $this->model->update(['id' => $post['id']], ['senha' => password_hash($post["novaSenha"], PASSWORD_DEFAULT)]);

                    if ($lUpdate) {
                        return Redirect::page("Usuario/trocaSenha", [
                            "msgSuccess"    => "Senha alterada com sucesso !"
                        ]);
                    } else {
                        return Redirect::page("Usuario/trocaSenha", [
                            "msgError"    => "Falha na atualização da nova senha !"
                        ]);
                    }
                } else {
                    return Redirect::page("Usuario/trocaSenha", [
                        "msgError"    => "Nova senha e conferência da senha estão divergentes !"
                    ]);
                }
            } else {
                return Redirect::page("Usuario/trocaSenha", [
                    "msgError"    => "Senha atual informada não confere!"
                ]);
            }
        } else {
            return Redirect::page("Usuario/trocaSenha", [
                "msgError"    => "Usuário inválido !"
            ]);
        }
    }

    /**
     * perfil
     *
     * @return void
     */
    public function perfil()
    {
        $this->loadHelper("formulario");
        $this->loadView("admin/formPerfil", $this->model->getById(Session::get('userCodigo')));
    }

    /**
     * atualizaPerfil
     *
     * @return void
     */
    public function atualizaPerfil()
    {
        $post = $this->getPost();

        if ($this->model->update($post['id'], ['nome' => $post['nome'], 'email' => $post['email']])) {

            Session::set("usuarioLogin", $post['nome']);
            Session::set("usuarioEmail", $post['email']);

            return Redirect::page("Usuario/perfil", [
                "msgSuccess"    => "Perfil atualizado com sucesso!"
            ]);
        } else {
            return Redirect::page("Usuario/perfil", [
                "msgError"    => "Falha na atualização do se perfil, favor tentar novamente mais tarde!"
            ]);
        }
    }
}
