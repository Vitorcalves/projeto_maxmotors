<?php

use App\Library\Session;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VelocityPHP</title>

    <link rel="stylesheet" href="<?= baseUrl() ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= baseUrl() ?>assets/vendors/fontawesome/css/all.min.css">

    <script src="<?= baseUrl() ?>assets/js/jquery-3.3.1.js"></script>
    <script src="<?= baseUrl() ?>assets/js/jqueryMask.js"></script>
    <script src="<?= baseUrl() ?>assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= baseUrl() ?>">
                <img src="<?= baseUrl() ?>assets/img/velocityPHP.png" title="VelocityPHP" height="80" width="80">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= baseUrl() ?>Home/homeAdmin">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= baseUrl() ?>Home/produto">Produto</a>
                    </li>

                    <?php if (Session::get('usuarioId') != false) : ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Area Administrativa
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <li><a class="dropdown-item" href="<?= baseUrl() ?>Login/signOut">Sair</a></li>
                                <li><a class="dropdown-item" href="<?= baseUrl() ?>Usuario/trocaSenha">Trocar a Senha</a></li>

                                <?php if (Session::get('usuarioNivel') == 1) : ?>
                                    <li><a class="dropdown-item" href="<?= baseUrl() ?>Usuario">Usuário</a></li>
                                <?php endif; ?>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= baseUrl() ?>Categoria">Categoria</a></li>
                                <li><a class="dropdown-item" href="<?= baseUrl() ?>Produto">Produto</a></li>

                            </ul>
                        </li>

                    <?php else : ?>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= baseUrl() ?>Home/Login">Login</a>
                        </li>

                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main>