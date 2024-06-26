<?php

use App\Library\Formulario;
use App\Library\Session;

?>
<?= Formulario::titulo("Usuários") ?>

<table id="tbListaUsuario" class="table table-hover table-bordered table-striped table-sm">
  <thead>
    <tr class="text-weigth-bold">
      <th>Nome</th>
      <th>E-mail</th>
      <th>CPF</th>
      <th>CNPJ</th>
      <th>Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($dados['clientes'] as $value) : ?>
      <tr>
        <td><?= $value['nome'] ?></td>
        <td><?= $value['email'] ?></td>
        <td><?= isset($value['cpf']) ? $value['cpf'] : ''  ?></td>
        <td><?= isset($value['cnpj']) ? $value['cnpj'] : '' ?></td>
        <td>
          <?= Formulario::botao("update", $value['id']) ?>
          <?= Formulario::botao("delete", $value['id']) ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</body>


<?= Formulario::getDataTables("tbListaUsuario") ?>