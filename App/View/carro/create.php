<?php

use App\Library\Session;
use App\Library\Formulario;

?>
<script src="<?= baseUrl() ?>assets/ckeditor5/ckeditor.js"></script>

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
      <div class="mb-3 col-6">
        <label for="descricao" class="form-label">Características</label>
        <textarea class="form-control" name="descricao" id="descricao"><?= setValor('descricao') ?></textarea>
      </div>
      <div class="col-6 mb-3">
        <label for="anexos" class="form-label">Imagem</label>
        <input class="form-control" type="file" id="imagem" name="imagem">
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

  ClassicEditor
    .create(document.querySelector('#descricao'))
    .catch(error => {
      console.error(error);
    });

  VMasker(document.querySelector("#ano")).maskPattern("9999");

  document.addEventListener("DOMContentLoaded", () => {
    const selectMarca = document.querySelector("comp-select");

    selectMarca.select = {
      name: "Marca",
      options: data.marca,
      idField: 'id',
      textField: 'nome',
      extra: {
        id: 0,
        name: 'Selecione uma marca'
      }
    };
  })
</script>