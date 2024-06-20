<?php

use App\Library\ModelMain;
use App\Library\Session;

class UsuarioModel extends ModelMain
{
    public $table = "usuario";

    public $validationRules = [
        "idPessoa" => [],

        "nome"  => [
            "label" => 'Nome',
            "rules" => 'required|min:3|max:50'
        ],
        "email"  => [
            "label" => 'E-mail',
            "rules" => 'required|email|max:100'
        ],
        "bairro"  => [
            "label" => 'Bairro',
            "rules" => 'required|min:3|max:50'
        ],
        "cep"  => [
            "label" => 'CEP',
            "rules" => 'required'
        ],
        "cnpj"  => [
            "label" => 'CNPJ',
            "rules" => 'required'
        ],
        "cpf"  => [
            "label" => 'CPF',
            "rules" => 'required'
        ],
        "logradouro"  => [
            "label" => 'Logradouro',
            "rules" => 'required|min:3|max:100'
        ],
        "numero_casa"  => [
            "label" => 'Número',
            "rules" => 'required|min:1|max:10'
        ],
        "telefone"  => [
            "label" => 'Telefone',
            "rules" => 'required'
        ],
        "tipo"  => [
            "label" => 'Tipo',
            "rules" => 'required|integer'
        ],
        "Estados"  => [
            "label" => 'Estado',
            "rules" => 'required|integer'
        ],
        "Cidades"  => [
            "label" => 'Cidade',
            "rules" => 'required|integer'
        ]


        // "nivel"  => [
        //     "label" => 'Nível',
        //     "rules" => 'required|integer'
        // ],
        // "statusRegistro"  => [
        //     "label" => 'Status',
        //     "rules" => 'required|integer'
        // ]
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

    public function criarCliente($data)
    {
        $this->db->beginTransaction();

        try {
            if (!$this->inserirPessoa($data)) {
                throw new Exception('Erro ao inserir pessoa');
            }

            if ($data['tipo'] == 1) {
                if (!$this->inserirFisica($data)) {
                    throw new Exception('Erro ao inserir pessoa física');
                }
            } else {
                if (!$this->inserirJuridica($data)) {
                    throw new Exception('Erro ao inserir pessoa jurídica');
                }
            }

            if (!$this->inserirEndereco($data)) {
                throw new Exception('Erro ao inserir endereço');
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {

            $this->db->rollBack();
            error_log($e);
            throw $e;
        }
    }

    private function inserirPessoa($data)
    {
        return $this->db->insertTransactional('pessoa', [
            "id" => $data['id'],
            "email" => $data['email'],
            "tipo" => 1,
        ]);
    }

    private function inserirFisica($data)
    {
        return $this->db->insertTransactional('fisica', [
            "idPessoa" => $data['id'],
            "cpf" => $data['cpf'],
            "nome" => $data['nome'],
        ]);
    }

    private function inserirJuridica($data)
    {
        return $this->db->insertTransactional('juridica', [
            "idPessoa" => $data['id'],
            "cnpj" => $data['cnpj'],
            "rasaoSocial" => $data['nome'],
        ]);
    }

    private function inserirEndereco($data)
    {
        return $this->db->insertTransactional('endereco', [
            "cep" => $data['cep'],
            "logradouro" => $data['logradouro'],
            "numero" => $data['numero_casa'],
            "complemento" => $data['complemento'],
            "municipio" => $data['Cidades'],
            "estado" => $data['Estados'],
            "bairro" => $data['bairro'],
            "idPessoa" => $data['id']
        ]);
    }
}
