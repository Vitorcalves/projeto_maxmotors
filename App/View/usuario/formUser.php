<?php

use App\Library\Session;

?>

<div class="container">
  <h1 class="mt-5"><strong>Cadastro</strong></h1>
</div>
<div class="container">
  <form id="formCadastro" class="row g-3 needs-validation" novalidate>
    <div class="col-md-8">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" name="nome" value="<?= setSubValor(['usuario', 'nome']) ?>" class="form-control" id="nome" required>
    </div>
    <div class="col-md-4">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" value="<?= setSubValor(['usuario', 'email']) ?>" class="form-control" id="email">
    </div>
    <div class="col-md-4">
      <comp-select></comp-select>
    </div>
    <div class="col-md-4">
      <comp-password></comp-password>
    </div>
    <div class="col-md-4">
      <p>Sua senha deve ter pelo menos 8 caracteres,</p>
      <p>incluir letras maiúsculas,</p>
      <p>incluir letras minúsculas,</p>
      <p>números e caracteres especiais.</p>
    </div>
    <div class="col-12">
      <button id="btnCadastrar" class="btn btn-primary">Cadastrar</button>
    </div>
  </form>
</div>

<script>
  const data = <?php echo json_encode($dados); ?>;


  document.getElementById('btnCadastrar').addEventListener('click', function(e) {
    e.preventDefault();

    const form = document.getElementById('formCadastro');
    const validations = [{
        field: 'nome',
        type: 'required'
      },
      {
        field: 'email',
        type: 'email'
      },
      {
        field: 'password',
        type: 'password',
        extra: 'confirm_password'
      },
      {
        field: 'Nivel',
        type: 'notZero'
      }
    ];

    const formIsValid = validation.validar(form, validations);

    if (!formIsValid) {
      return;
    }

    var formData = new FormData(form);

    var object = {};
    formData.forEach(function(value, key) {
      object[key] = value;
    });
    var json = JSON.stringify(object);

    // // Enviar os dados
    fetch('<?= baseUrl() ?>usuario/insert/', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: json
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(data => {
            throw new Error(data.error || 'Erro desconhecido');
          });
        }
        return response.json();
      })
      .then(data => {
        console.log('Sucesso:', data);
        funcoes.showToast('Cadastro realizado com sucesso!', 'success');
        window.location.href = '<?= baseUrl() ?>usuario/';
      })
      .catch((error) => {
        console.error('Erro:', error);
        funcoes.showToast(error.message, 'danger');
      });
  });

  document.addEventListener("DOMContentLoaded", () => {
    const selectNivel = document.querySelector("comp-select");

    selectNivel.select = {
      name: "Nivel",
      options: data.nivel,
      idField: 'id',
      textField: 'nome',
      extra: {
        id: 0,
        name: 'Selecione um nivel'
      }
    };
    console.log(data.usuario);
    if (data.usuario) {
      selectNivel.querySelector(`select option[value="${data.usuario.nivel}"]`).selected = true;
      id = data.usuario.id;
    }
  });
</script>