<?php

use App\Library\ModelMain;

Class CategoriaModel extends ModelMain
{
    public $table = "categoria";

    public $validationRules = [
        'nome' => [
            'label' => 'nome',
            'rules' => 'required|min:0|max:50'
        ],
    ];
}