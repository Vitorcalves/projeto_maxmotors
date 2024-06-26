<?php

use App\Library\Formulario;

?>

<div class="container">
    
    <?= Formulario::titulo('Categoria', false, true) ?>

    <form method="POST" action="<?= baseUrl() ?>Categoria/<?= $this->getAcao() ?>">

        <div class="row">

            <div class="mb-3 col-8">
                <label for="nome" class="form-label">Marca</label>
                <input type="text" class="form-control" name="nome" id="nome" 
                    maxlength="50" placeholder="Informe o nome da marca"
                    value="<?= setValor('nome') ?>"
                    autofocus>
            </div>

            <!-- <div class="mb-3 col-4">
                <label for="statusRegistro" class="form-label">Status</label>
                <select class="form-control" name="statusRegistro" id="statusRegistro" required>
                    <option value=""  <?= setValor('statusRegistro') == ""  ? "SELECTED": "" ?>>...</option>
                    <option value="1" <?= setValor('statusRegistro') == "1" ? "SELECTED": "" ?>>Ativo</option>
                    <option value="2" <?= setValor('statusRegistro') == "2" ? "SELECTED": "" ?>>Inativo</option>
                </select>
            </div> -->


            <div class="mb-3">
                <button type="submit" class="btn btn-outline-primary">Gravar</button>&nbsp;&nbsp;
                <?= Formulario::botao('voltar') ?>
            </div>
            
        </div>

    </form>

</div>