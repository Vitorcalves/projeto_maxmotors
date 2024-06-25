<?php

use App\Library\ModelMain;
use App\Library\Session;

class ClienteModel extends ModelMain
{
  public $table = "cliente";

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

    return $this->db->listNull($this->table, "deleted");
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

  public function getCliente($id)
  {
    $sql = "SELECT 
                    u.id, 
                    u.email, 
                    u.cpf, 
                    u.nome, 
                    u.cnpj, 
                    e.cep, 
                    e.logradouro, 
                    e.numero, 
                    e.complemento, 
                    e.municipio, 
                    e.estado, 
                    e.bairro 
                FROM 
                    cliente AS u
                LEFT JOIN 
                    endereco AS e ON e.idPessoa = u.id
                WHERE 
                    u.id = ?";

    $rs = $this->db->dbSelect($sql, [$id]);


    if ($this->db->dbNumeroLinhas($rs) > 0) {
      return $this->db->dbBuscaArrayAll($rs)[0];
    } else {
      return null;
    }
  }

  public function criarCliente($data)
  {
    if ($this->buscarEmail($data['email'], 'cliente')) {
      throw new Exception('E-mail já cadastrado');
    }
    $this->db->beginTransaction();

    try {


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
      return ['status' => 'success', 'message' => 'Cliente cadastrado com sucesso'];
    } catch (Exception $e) {
      $this->db->rollBack();
      error_log($e);
      throw $e;
    }
  }

  private function inserirFisica($data)
  {
    return $this->db->insertTransactional('cliente', [
      "id" => $data['id'],
      "email" => $data['email'],
      "nome" => $data['nome'],
      "cpf" => $data['cpf'],
    ]);
  }

  private function inserirJuridica($data)
  {
    return $this->db->insertTransactional('cliente', [
      "id" => $data['id'],
      "email" => $data['email'],
      "nome" => $data['nome'],
      "cnpj" => $data['cnpj'],
    ]);
  }

  private function inserirEndereco($data)
  {
    return $this->db->insertTransactional('endereco', [
      "cep" => $data['cep'],
      "logradouro" => $data['logradouro'],
      "numero" => $data['numero_casa'],
      "complemento" => $data['complemento'] ?? '',
      "municipio" => $data['Cidades'],
      "estado" => $data['Estados'],
      "bairro" => $data['bairro'],
      "idPessoa" => $data['id']
    ]);
  }
}
