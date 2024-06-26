<?php

use App\Library\ModelMain;

class produtoModel extends ModelMain
{
    public $table = "produto";

    public $validationRules = [
        'modelo' => [
            'label' => 'Modelo',
            'rules' => 'required|min:3|max:50'
        ],
        'descricao' => [
            'label' => 'Descrição',
            'rules' => 'required|min:1'
        ],
    ];

    /**
     * lista
     *
     * @param string $orderBy 
     * @return void
     */
    public function lista($orderBy = 'descricao')
    {
        $rsc = $this->db->dbSelect(
            "SELECT p.*, c.descricao as descricaoCategoria 
            FROM {$this->table} AS p
            INNER JOIN categoria as c ON c.id = p.categoria_id
            ORDER BY p.{$orderBy}"
        );

        if ($this->db->dbNumeroLinhas($rsc) > 0) {
            return $this->db->dbBuscaArrayAll($rsc);
        } else {
            return [];
        }
    }

    /**
     * getProdutoCombobox
     *
     * @param int $categoria_id 
     * @return array
     */
    public function getProdutoCombobox($categoria_id)
    {
        $rsc = $this->db->dbSelect(
            "SELECT p.id, p.descricao 
                                    FROM {$this->table} as p
                                    INNER JOIN categoria as c ON c.id = p.categoria_id
                                    WHERE c.id = ?
                                    ORDER BY p.descricao",
            [$categoria_id]
        );

        if ($this->db->dbNumeroLinhas($rsc) > 0) {
            return $this->db->dbBuscaArrayAll($rsc);
        } else {
            return [];
        }
    }

    public function getMarcaCombobox()
    {
        $this->table = "marca";
        $rsc = $this->db->dbSelect("SELECT id, nome 
                                    FROM {$this->table}
                                  ");

        if ($this->db->dbNumeroLinhas($rsc) > 0) {
            return $this->db->dbBuscaArrayAll($rsc);
        } else {
            return [];
        }
    }
}
