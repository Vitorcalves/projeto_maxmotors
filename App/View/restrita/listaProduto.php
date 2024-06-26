<?php

use App\Library\Formulario;

echo Formulario::titulo('Produtos');

?>

<table class="table table-bordered table-striped table-hover table-sm" id="listaProdutos">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Cor</th>
            <th>Marca</th>
            <th>Preco</th>
            <th>Quantidade</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($aDados as $value) : ?>
            <tr>
                <td class="text-center"><?= $value['id'] ?></td>
                <td><?= $value['nome'] ?></td>
                <td><?= $value['descricao'] ?></td>
                <td class="text-end"><?= $value['cor']?></td>
                <td class="text-end"><?= $value['marca']?></td>
                <td class="text-end"><?= formataValor($value['preco'], 2) ?></td>
                <td class="text-end"><?= formataValor($value['quantidade'], 2) ?></td>
                <td>
                    <?= Formulario::botao("view", $value['id']) ?>
                    <?= Formulario::botao("update", $value['id']) ?>
                    <?= Formulario::botao("delete", $value['id']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= Formulario::getDataTables('listaProdutos'); ?>