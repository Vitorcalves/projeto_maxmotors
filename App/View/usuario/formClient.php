<?php

use App\Library\Session;

?>

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

<body>
  <theme-toggle></theme-toggle>
  <cabecario-pagina></cabecario-pagina>
  <comp-toast></comp-toast>
  <main class="flex-shrink-0">
    <div class="container">
      <h1 class="mt-5"><strong>Cadastro</strong></h1>
    </div>
    <div class="container">
      <form id="formCadastro" class="row g-3 needs-validation" novalidate>
        <div class="col-md-10">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" name="nome" class="form-control" id="nome" required>
        </div>
        <div class="col-md-2">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="modelo">
        </div>
        <div class="col-md-2">
          <label for="telefone" class="form-label">Telefone</label>
          <input type="text" class="form-control" name="telefone" id="telefone" required>
        </div>
        <div class="col-md-2">
          <label for="tipo" class="form-label">Tipo</label>
          <select id="tipo" name="tipo" class="form-select">
            <option selected>Selecione...</option>
            <option value="1">Pessoa Física</option>
            <option value="2">Pessoa Jurídica</option>
          </select>
        </div>
        <div class="col-md-2">
          <label for="cpf" class="form-label">CPF</label>
          <input type="text" class="form-control" name="cpf" id="cpf">
        </div>
        <div class="col-md-3">
          <label for="cnpj" class="form-label">CNPJ</label>
          <input type="text" class="form-control" name="cnpj" id="cnpj">
        </div>
        <div class="col-md-3">
          <label for="inscricao_estadual" class="form-label">Inscrição Estadual</label>
          <input type="text" class="form-control" name="inscricao_estadual" id="inscricao_estadual">
        </div>
        <div class="col-2">
          <label for="cep" class="form-label">CEP</label>
          <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP">
        </div>
        <div class="col-1">
          <button type="button" class="btn btn-secondary" onclick="enviarCep()">Buscar</button>
        </div>
        <div class="col-2">
          <comp-select></comp-select>
        </div>
        <div class="col-md-2">
          <comp-select></comp-select>
        </div>
        <div class="col-md-4">
          <label for="bairro" class="form-label">Bairro</label>
          <input type="text" class="form-control" name="bairro" id="bairro">
        </div>
        <div class="col-md-4">
          <label for="logradouro" class="form-label">Rua</label>
          <input type="text" class="form-control" name="logradouro" id="logradouro">
        </div>
        <div class="col-md-2">
          <label for="numero" class="form-label">Número da Casa</label>
          <input type="text" class="form-control" name="numero_casa" id="numero">
        </div>
        <div class="col-12">
          <button id="btnCadastrar" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
</body>

</html>
<script>
  const data = <?php echo json_encode($dados); ?>;



  document.getElementById('btnCadastrar').addEventListener('click', function(e) {
    e.preventDefault(); // Evita o comportamento padrão do formulário

    var form = document.getElementById('formCadastro');
    var telefoneInput = form.elements['telefone'];
    const validations = [{
        field: 'telefone',
        type: 'telefone'
      },
      {
        field: 'email',
        type: 'email'
      },
      // Adicione mais campos e tipos conforme necessário
    ];

    const formIsValid = validateForm(form, validations);

    if (!formIsValid) {
      return;
    }

    var formData = new FormData(form);

    var object = {};
    formData.forEach(function(value, key) {
      object[key] = value;
    });
    console.log(object);
    // var json = JSON.stringify(object);

    // // Enviar os dados
    // fetch('<?= baseUrl() ?>usuario/cadastrar', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json'
    //     },
    //     body: json
    // })
    // .then(response => response.json())
    // .then(data => {
    //     console.log('Sucesso:', data);
    //     showToast('Cadastro realizado com sucesso!', 'success');
    // })
    // .catch((error) => {
    //     console.error('Erro:', error);
    //     showToast('Erro no cadastro!', 'danger');
    // });
  });

  function enviarCep() {
    var cep = document.getElementById("cep").value;
    fetch("<?= baseUrl() ?>usuario/buscar", {
        method: "POST",
        headers: {
          'Content-Type': 'application/json', // Adicione este cabeçalho
        },
        body: JSON.stringify({
          cep: cep
        })
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Erro ao buscar dados');
        }
        return response.json();
      })
      .then(data => {
        atualizarDadosCep(data);
      })
      .catch(error => {
        console.error('Erro ao buscar dados:', error);
        showToast('Cep não encontrado', 'danger');
      });
  }

  function showToast(message, type) {
    const toast = document.createElement('comp-toast'); // Cria uma nova instância
    toast.toast = {
      message: message,
      type: type
    };
    document.body.appendChild(toast); // Anexa o novo toast ao body cada vez
  }

  function atualizarDadosCep(data) {
    const selectMunicipio = document.querySelectorAll("comp-select")[1];
    const selectEstado = document.querySelectorAll("comp-select")[0];
    selectMunicipio.select = {
      name: "Cidades",
      options: data.dados_municipio,
      idField: 'idMunicipio',
      textField: 'nome',
    };
    selectEstado.querySelector(`select option[value="${data.dados_cep.idEstado}"]`).selected = true;
    selectMunicipio.querySelector(`select option[value="${data.dados_cep.idMunicipio}"]`).selected = true;
    document.getElementById("bairro").value = data.dados_cep.bairro;
    document.getElementById("logradouro").value = data.dados_cep.logradouro;
  }

  document.addEventListener("DOMContentLoaded", () => {
    const btnBuscarCep = document.getElementById('btnBuscarCep');
    const cabecario = document.querySelector("cabecario-pagina");
    const selectEstado = document.querySelectorAll("comp-select")[0];
    const selectMunicipio = document.querySelectorAll("comp-select")[1];

    cabecario.menus = data.menu;

    selectEstado.select = {
      name: "Estados",
      options: data.estados,
      idField: 'idEstado',
      textField: 'nome',
      extra: {
        id: 0,
        name: 'Selecione um estado'
      }
    };

    selectMunicipio.select = {
      name: "Cidades",
      options: [{
        idCidade: 111111,
        nome: 'Selecione um estado'
      }],
      idField: 'idCidade',
      textField: 'nome'
    };

    selectEstado.addEventListener('change', (event) => {
      const idEstado = event.target.value;
      if (idEstado !== '0') {
        fetchCidades(idEstado);
      }
    });

    function fetchCidades(idEstado) {
      fetch(`<?= baseUrl() ?>usuario/cidades/${idEstado}`)
        .then(response => response.json())
        .then(cidades => {
          selectMunicipio.select = {
            name: "Cidades",
            options: cidades,
            idField: 'idCidade',
            textField: 'nome',
            extra: {
              id: 0,
              name: 'Selecione uma cidade'
            }
          };
        })
        .catch(error => console.error('Erro ao buscar cidades:', error));
    }


  });

  VMasker(document.querySelector("#cep")).maskPattern("99999-999");
  VMasker(document.querySelector("#telefone")).maskPattern("(99) 99999-9999");
</script>