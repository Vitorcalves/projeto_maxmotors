<?php

use App\Library\Session;
use App\Library\Formulario;

?>

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