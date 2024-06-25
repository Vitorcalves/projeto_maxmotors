<?php

use App\Library\ModelMain;
use App\Library\Session;

class UsuarioModel extends ModelMain
{
    public $table = "user";

    public $validationRules = [
        "nome"  => [
            "label" => 'Nome',
            "rules" => 'required|min:3|max:50'
        ],
        "email"  => [
            "label" => 'E-mail',
            "rules" => 'required|email|max:100'
        ],
    ];


    /**
     * getLista
     *
     * @return void
     */
    public function getLista()
    {
        $rsc = $this->db->dbSelect("
            SELECT 
                u.id,
                u.nome,
                u.email,
                u.nivel AS id_nivel,
                n.nome AS nome_nivel
            FROM 
                user AS u
            INNER JOIN 
                nivel AS n ON n.id = u.nivel
            where 
                u.deleted IS NULL
            ORDER BY
                u.nome
        ");

        if ($this->db->dbNumeroLinhas($rsc) > 0) {
            return $this->db->dbBuscaArrayAll($rsc);
        } else {
            return [];
        }
    }

    /**
     * getNiveis
     *
     * @return void
     */
    public function getNivel()
    {
        $rsc = $this->db->dbSelect("
            SELECT 
                id,
                nome
            FROM 
                nivel
            ORDER BY
                nome
        ");

        if ($this->db->dbNumeroLinhas($rsc) > 0) {
            return $this->db->dbBuscaArrayAll($rsc);
        } else {
            return [];
        }
    }

    /**
     * getUserEmail
     *
     * @param string $email 
     * @return array
     */
    public function getUserEmail($email)
    {
        $user = $this->db->select(
            $this->table,
            "first",
            ["where" => ['email' => $email]]
        );

        if ($user == false) {
            return [];
        } else {
            return $user;
        }
    }

    /**
     * criaSuperUser
     *
     * @return void
     */
    public function criaSuperUser()
    {
        $qtd = $this->db->select($this->table, "count");

        if ($qtd == 0) {

            // criando o super usuário

            $rsUsuario = $this->db->insert(
                $this->table,
                [
                    "nome" => "administrador",
                    "email" => "administrador@velocityphp.com.br",
                    "senha" => password_hash("fasm@2024", PASSWORD_DEFAULT),
                    "nivel" => 1
                ]
            );

            if ($rsUsuario > 0) {
                Session::set('msgSuccess', "Super usuário criado com sucesso.");
                return 2;
            } else {
                Session::set('msgError', "Falha na inclusão do super usuário, não é possivel prosseguir.");
                return 1;
            }
        }

        return 0;
    }

    public function getUsuario($id)
    {
        $sql = "SELECT 
                    *
                FROM 
                    user
                WHERE 
                    id = ?
                LIMIT 1";

        $rs = $this->db->dbSelect($sql, [$id]);

        if ($this->db->dbNumeroLinhas($rs) > 0) {
            return $this->db->dbBuscaArrayAll($rs)[0];
        } else {
            return null;
        }
    }

    public function criatUsuario($data)
    {
        try {
            if ($this->buscarEmail($data['email'], 'user')) {
                throw new Exception('E-mail já cadastrado');
            }

            if ($this->insert([
                "nivel"             => $data['Nivel'],
                "nome"              => $data['nome'],
                "email"             => $data['email'],
                "pasword"             => password_hash($data['password'], PASSWORD_DEFAULT)
            ])) {
                return true;
            } else {
                throw new Exception('Erro ao inserir usuário');
            }
        } catch (Exception $e) {
            error_log($e);
            throw $e;
        }
    }
}
