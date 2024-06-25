<?php

  use App\Library\Session;
  use App\Library\Formulario;

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
  <script src="<?= baseUrl() ?>componentes/validation.js" defer></script>
  
  <script type="text/javascript" src="<?= baseUrl() ?>assets/DataTables/datatables.min.js"></script>

  <?= Formulario::titulo("produtos") ?>
  <title>Max Motors</title>

  <style>
    .nome-empresa {
      font-family: "Uni Sans Heavy", sans-serif;
      text-transform: uppercase;
    }
  </style>
</head>

<body>
  <theme-toggle></theme-toggle>
  <cabecario-pagina></cabecario-pagina>
  <div>
    <?php foreach ($aDados as $value) : ?>
      <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="..."><?= $value['id'] ?></img>
        <div class="card-body">
          <h5 class="card-title"><?= $value['nome'] ?></h5>
          <p class="card-text"><?= $value['nome'] ?></p>
          <p class="card-text"><?= $value['nome'] ?></p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?= Formulario::getDataTables('listaProdutos'); ?>
</body>