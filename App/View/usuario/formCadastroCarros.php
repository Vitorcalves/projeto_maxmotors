<?php

use App\Library\Session;
use App\Library\Formulario;
use App\

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
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5"><strong>Cadastro</strong></h1>
        </div>
        <div class="container">
            <form class="row g-3">
                <div class="col-md-10">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo">
                </div>
                <div class="col-md-2">
                    <label for="cor" class="form-label">Cor</label>
                    <input type="text" class="form-control" id="cor" name="cor">
                </div>
                <div class="col-2">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="text" class="form-control" id="ano">
                </div>
                <div class="col-md-4">
                    <comp-select></comp-select>
                </div>
                <div class="col-md-4">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="text" class="form-control" id="preco">
                </div>
                <div class="col-md-2">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="text" class="form-control" id="quantidade" name="quantidade">
                </div>
                <div class="col-md-2">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea></textarea>
                    <!-- <input type="text" class="form-control" id="descricao" name="descricao"> -->
                </div>
                <div class="col-md-4">
                    <label for="imagem" class="form-label">Selecione uma imagem</label>
                    <input type="file" class="form-control" id="imagem">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-secondary">Gravar</button>
                </div>
            </form>
        </div>
    </main>
  </body>

  <script>
     const data = <?php echo json_encode($dados); ?>;

    VMasker(document.querySelector("#ano")).maskPattern("9999");

    document.addEventListener("DOMContentLoaded", () => {
        const selectMarca = document.querySelector("comp-select");

        selectMarca.select = {
        name: "Marca",
        options: data.marca,
        idField: 'id',
        textField: 'marca',
        extra: {
            id: 0,
            name: 'Selecione uma marca'
        }
        };
    })
  </script>