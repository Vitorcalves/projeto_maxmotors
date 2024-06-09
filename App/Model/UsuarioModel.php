<?php

use App\Library\ModelMain;
use App\Library\Session;

class UsuarioModel extends ModelMain
{
    public $table = "usuario";

    public $validationRules = [
        "nome"  => [
            "label" => 'Nome',
            "rules" => 'required|min:3|max:50'
        ],
        "email"  => [
            "label" => 'E-mail',
            "rules" => 'required|email|max:100'
        ],
        "nivel"  => [
            "label" => 'Nível',
            "rules" => 'required|integer'
        ],
        "statusRegistro"  => [
            "label" => 'Status',
            "rules" => 'required|integer'
        ]
    ];


    /**
     * getLista
     *
     * @return void
     */
    public function getLista()
    {
        return $this->db->select($this->table, "all", ["orderby", ["nome"]]);
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

    public function buscaCep($cep)
    {
        $rsc = $this->db->dbSelect("
            SELECT 
                c.logradouro, 
                c.bairro, 
                m.nome AS nome_municipio, 
                e.nome AS nome_estado 
            FROM 
                cep AS c
            INNER JOIN 
                municipios AS m ON m.idMunicipio = c.idMunicipio
            INNER JOIN 
                estados AS e ON e.idEstado = m.idEstado
            WHERE 
                c.cep = ?", [$cep]);

        if ($this->db->dbNumeroLinhas($rsc) > 0) {
            return $this->db->dbBuscaArrayAll($rsc[0]);
        } else {
            return [];
        }
    }
}
