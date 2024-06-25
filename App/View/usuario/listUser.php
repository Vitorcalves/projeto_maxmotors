<?php

use App\Library\Formulario;

?>

<script type="text/javascript" src="<?= baseUrl() ?>assets/DataTables/datatables.min.js"></script>

<?= Formulario::titulo("Usuários") ?>

<table id="tbListaUsuario" class="table table-hover table-bordered table-striped table-sm">
  <thead>
    <tr class="text-weigth-bold">
      <th>Nome</th>
      <th>E-mail</th>
      <th>Nivel</th>
      <th>Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($dados['usuarios'] as $value) : ?>
      <tr>
        <td><?= $value['nome'] ?></td>
        <td><?= $value['email'] ?></td>
        <td><?= $value['nome_nivel'] ?></td>
        <td>
          <?= Formulario::botao("update", $value['id']) ?>
          <?= Formulario::botao("delete", $value['id']) ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= Formulario::getDataTables("tbListaUsuario") ?>