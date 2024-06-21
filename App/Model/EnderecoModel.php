<?php

use App\Library\ModelMain;
use App\Library\Session;

class EnderecoModel extends ModelMain
{
  public function buscaCep($data)
  {
    if (!isset($data['cep'])) {
      throw new Exception('CEP invalido. Por favor, forneça um CEP válido.', 400);
    }
    $cep = $data['cep'];

    $rsc = $this->db->dbSelect("
            SELECT 
                c.logradouro, 
                c.bairro, 
                m.nome,
                m.idMunicipio,
                e.nome,
                e.idEstado 
            FROM 
                cep AS c
            INNER JOIN 
                municipios AS m ON m.idMunicipio = c.idMunicipio
            INNER JOIN 
                estados AS e ON e.idEstado = m.idEstado
            WHERE 
                c.cep = ?
            LIMIT 1", [$cep]);

    if ($this->db->dbNumeroLinhas($rsc) > 0) {
      $dataCep = $this->db->dbBuscaArrayAll($rsc)[0];
      $dataMunicipio = $this->getMunicipios($dataCep['idEstado']);
      return [
        'dados_cep' => $dataCep,
        'dados_municipio' => $dataMunicipio
      ];
    } else {
      throw new Exception('CEP não encontrado. Por favor, forneça um CEP válido.', 404);;
    }
  }

  public function getEstados()
  {
    $this->table = "estados";
    $query = $this->lista(['nome']);
    return $query;
  }

  public function getMunicipios($idEstado)
  {
    $this->table = "municipios";
    $rsc = $this->getByField('idEstado', $idEstado, 'nome');
    return $this->db->dbBuscaArrayAll($rsc);
  }
}
