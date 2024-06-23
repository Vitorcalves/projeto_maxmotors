<?php

use App\Library\Formulario;

?>

<script src="<?= baseUrl() ?>assets/ckeditor5/ckeditor.js"></script>

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

<div class="container">

    <?= Formulario::titulo('Produto', false, true) ?>

    <form method="POST" action="<?= baseUrl() ?>Produto/<?= $this->getAcao() ?>" enctype="multipart/form-data" class="row g-3">

        <div class="col-md-8">
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
        <div class="mb-3 col-sm-6 col-md-3">
            <label for="preco" class="form-label">Preço de Venda</label>
            <input type="text" class="form-control" name="preco" id="preco" value="<?= formataValor(setValor('precoVenda', 0)) ?>" dir="rtl">
        </div>
        <div class="mb-3 col-sm-6 col-md-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="text" class="form-control" name="quantidade" id="quantidade" value="<?= formataValor(setValor('saldoEmEstoque', 0), 3) ?>" dir="rtl">
        </div>
        <div class="col-md-8    ">
            <label for="descricao" class="form-label">Descrição</label>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Informe uma descricãp" id="descricao" style="height: 100px; resize: none"></textarea>
                <label for="floatingTextarea2">Descrição</label>
            </div>
            <!-- <input type="text" class="form-control" id="descricao" name="descricao"> -->
        </div>

        <?php if (in_array($this->getAcao(), ['insert', 'update'])) : ?>

            <div class="col-12 mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input class="form-control" type="file" id="imagem" name="imagem">
            </div>

        <?php endif; ?>

        <?php if (!empty(setValor('imagem'))) : ?>

            <div class="mb-3 col-12">
                <h5>Imagem</h5>
                <img src="<?= baseUrl() ?>uploads/produto/<?= setValor('imagem') ?>" class="img-thumbnail" height="120" width="120" />
            </div>

        <?php endif; ?>

        <input type="hidden" name="id" id="id" value="<?= setValor('id') ?>">
        <input type="hidden" name="nomeImagem" value="<?= setValor('imagem') ?>">

        <div class="mb-3">
            <button type="submit" class="btn btn-outline-primary">Gravar</button>&nbsp;&nbsp;
            <?= Formulario::botao('voltar') ?>
        </div>

</div>

</form>

</div>

<script type="text/javascript">
    const data = <?php echo json_encode($dados); ?>;

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

    ClassicEditor
        .create(document.querySelector('#caracteristicas'))
        .catch(error => {
            console.error(error);
        })

    $(document).ready(function() {
        $('#saldoEmEstoque').mask('#.###.###.##0,000', {
            reverse: true
        });
        $('#precoVenda').mask('##.###.###.##0,00', {
            reverse: true
        });
        $('#precoPromocao').mask('##.###.###.##0,00', {
            reverse: true
        });
    })
    VMasker(document.querySelector("#ano")).maskPattern("9999");
</script>