<?php

use App\Library\ModelMain;
use App\Library\Session;

class EnderecoModel extends ModelMain
{
  public function buscaCep($cep)
  {
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
      return [];
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
