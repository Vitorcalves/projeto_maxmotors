<?php

use App\Library\Session;

?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VelocityPHP</title>

    <link rel="stylesheet" href="<?= baseUrl() ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= baseUrl() ?>assets/vendors/fontawesome/css/all.min.css">

    <script src="<?= baseUrl() ?>assets/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="<?= baseUrl() ?>assets/js/jquery-3.3.1.js"></script>
    <script src="<?= baseUrl() ?>assets/vanilla-masker/lib/vanilla-masker.js"></script>
    <script src="<?= baseUrl() ?>assets/bootstrap/js/bootstrap.js"></script>
    <script src="<?= baseUrl() ?>componentes/componentes.js" defer></script>
    <script src="<?= baseUrl() ?>componentes/funcoes.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Max Motors</title>
</head>

<body>
    <theme-toggle></theme-toggle>
    <cabecario-pagina></cabecario-pagina>
    <comp-toast></comp-toast>



    <main class="flex-shrink-0">