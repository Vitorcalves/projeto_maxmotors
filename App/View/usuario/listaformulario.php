<?php

use App\Library\Formulario;
use App\Library\Session;

?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="<?= baseUrl() ?>assets/bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="<?= baseUrl() ?>assets/vendors/fontawesome/css/all.min.css">
  <script src="<?= baseUrl() ?>assets/@popperjs/core/dist/umd/popper.min.js"></script>
  <script src="<?= baseUrl() ?>assets/js/jquery-3.3.1.js"></script>
  <script src="<?= baseUrl() ?>assets/vanilla-masker/lib/vanilla-masker.js"></script>
  <script src="<?= baseUrl() ?>assets/bootstrap/js/bootstrap.js"></script>
  <script src="<?= baseUrl() ?>componentes/componentes.js" defer></script>
  <script src="<?= baseUrl() ?>componentes/funcoes.js" defer></script>
  <title>Max Motors</title>

  <style>
    .nome-empresa {
      font-family: "Uni Sans Heavy", sans-serif;
      text-transform: uppercase;
    }
  </style>
  <script type="text/javascript" src="<?= baseUrl() ?>assets/DataTables/datatables.min.js"></script>
</head>

<body>
  <theme-toggle></theme-toggle>
  <cabecario-pagina></cabecario-pagina>
  <comp-toast></comp-toast>


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

</html>