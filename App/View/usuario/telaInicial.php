<?php

use App\Library\Session;
use App\Library\Formulario;

?>


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