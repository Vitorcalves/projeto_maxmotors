<?php

use App\Library\Session;

?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= baseUrl() ?>assets/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="<?= baseUrl() ?>assets/vendors/fontawesome/css/all.min.css">
    <script src="<?= baseUrl() ?>assets/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="<?= baseUrl() ?>assets/js/jquery-3.3.1.js"></script>
    <script src="<?= baseUrl() ?>assets/js/jqueryMask.js"></script>
    <script src="<?= baseUrl() ?>assets/bootstrap/js/bootstrap.js"></script>
    <script src="<?= baseUrl() ?>componentes/componentes.js" defer></script>
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
            <h1 class="mt-5">
                Bem vindo a <strong class="nome-empresa">Max Motors</strong> o lugar
                do seu carro novo
            </h1>
            <p class="lead">
                Aqui você encontra os melhores carros com os melhores preços. Desde
                usado, seminovo e novo. Venha conferir nosso showroom.
            </p>
            <div class="row">
                <div class="col-md-6">
                    <form action="#" method="post">
                        <div class="mb-3">
                            <label for="userName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="user" name="email" required />
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                        <a href="#" class="btn btn-link">Esqueci a senha</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
<script>
    const data = <?php echo json_encode($dados); ?>;
    document.addEventListener("DOMContentLoaded", () => {
        const cabecario = document.querySelector("cabecario-pagina");
        cabecario.menus = data.menu;
    });
</script>