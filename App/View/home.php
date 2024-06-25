<?php

use App\Library\Session;

?>

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
                <form action="<?= baseUrl() ?>login/signIn" method="post">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Email</label>
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

<script>
</script>