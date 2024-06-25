<?php

use App\Library\Session;

?>

<div class="container">
  <h1 class="mt-5"><strong>Cadastro</strong></h1>
</div>
<div class="container">
  <form id="formCadastro" class="row g-3 needs-validation" novalidate>
    <div class="col-md-10">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" name="nome" value="<?= setSubValor(['usuario', 'nome']) ?>" class="form-control" id="nome" required>
    </div>
    <div class="col-md-2">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" value="<?= setSubValor(['usuario', 'email']) ?>" class="form-control" id="modelo">
    </div>
    <div class="col-md-2">
      <label for="telefone" class="form-label">Telefone</label>
      <input type="text" class="form-control" value="<?= setSubValor(['usuario', 'telefone']) ?>" name="telefone" id="telefone" required>
    </div>
    <div class="col-md-2">
      <label for="tipo" class="form-label">Tipo</label>
      <select id="tipo" name="tipo" class="form-select">
        <option value="0" <?= setSubValor(['usuario', 'cpf']) == "" and setSubValor(['usuario', 'cnpj']) == "" ? "selected" : ""  ?>>Selecione...</option>
        <option value="1" <?= setSubValor(['usuario', 'cpf']) != ""   ? "selected" : ""  ?>>Pessoa Física</option>
        <option value="2" <?= setSubValor(['usuario', 'cnpj']) != ""   ? "selected" : ""  ?>>Pessoa Jurídica</option>
      </select>
    </div>
    <div class="col-md-2">
      <label for="cpf" class="form-label">CPF</label>
      <input type="text" value="<?= setSubValor(['usuario', 'cpf']) ?>" class=" form-control" name="cpf" id="cpf">
    </div>
    <div class="col-md-3">
      <label for="cnpj" class="form-label">CNPJ</label>
      <input type="text" value="<?= setSubValor(['usuario', 'cnpj']) ?>" class=" form-control" name="cnpj" id="cnpj">
    </div>

    <div class="col-2">
      <label for="cep" class="form-label">CEP</label>
      <input type="text" value="<?= setSubValor(['usuario', 'cep']) ?>" class=" form-control" name="cep" id="cep" placeholder="CEP">
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
      <input type="text" value="<?= setSubValor(['usuario', 'bairro']) ?>" class=" form-control" name="bairro" id="bairro">
    </div>
    <div class="col-md-4">
      <label for="logradouro" class="form-label">Rua</label>
      <input type="text" value="<?= setSubValor(['usuario', 'logradouro']) ?>" class=" form-control" name="logradouro" id="logradouro">
    </div>
    <div class="col-md-2">
      <label for="complemento" class="form-label">Complemento</label>
      <input type="text" value="<?= setSubValor(['usuario', 'complemento']) ?>" class=" form-control" name="complemento" id="complemento">
    </div>
    <div class="col-md-2">
      <label for="numero" class="form-label">Número da Casa</label>
      <input type="text" value="<?= setSubValor(['usuario', 'numero']) ?>" class=" form-control" name="numero_casa" id="numero">
    </div>
    <div class="col-12">
      <button id="btnCadastrar" class="btn btn-primary">Cadastrar</button>
    </div>
  </form>
</div>

<script>
  const data = <?php echo json_encode($dados); ?>;
  var id = '';
  console.log(data);



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
        field: 'telefone',
        type: 'telefone'
      },
      {
        field: 'tipo',
        type: 'notZero'
      },
      {
        field: 'cep',
        type: 'required'
      },
      {
        field: 'Estados',
        type: 'notZero'
      },
      {
        field: 'Cidades',
        type: 'notZero'
      },
      {
        field: 'logradouro',
        type: 'required'
      },
      {
        field: 'bairro',
        type: 'required'
      },
      {
        field: 'numero_casa',
        type: 'required'
      },
    ];
    if (form.elements['tipo'].value == '1') {
      validations.push({
        field: 'cpf',
        type: 'cpf'
      });
    } else if (form.elements['tipo'].value == '2') {
      validations.push({
        field: 'cnpj',
        type: 'cnpj'
      });
    }

    const formIsValid = validation.validar(form, validations);

    if (!formIsValid) {
      return;
    }

    var formData = new FormData(form);

    var object = {};
    formData.forEach(function(value, key) {
      object[key] = value;
    });
    console.log(object);
    object['id'] = id || funcoes.generateUUID();
    var json = JSON.stringify(object);

    // // Enviar os dados
    fetch('<?= baseUrl() ?>cliente/<?= $this->getAcao() ?>', {
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
        window.location.href = '<?= baseUrl() ?>cliente';
      })
      .catch((error) => {
        console.error('Erro:', error);
        funcoes.showToast(error.message, 'danger');
      });
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
        funcoes.showToast('Cep não encontrado', 'danger');
      });
  }

  function showToast(message, type) {
    const toast = document.createElement('comp-toast');
    toast.toast = {
      message: message,
      type: type
    };
    document.body.appendChild(toast);
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
    const selectEstado = document.querySelectorAll("comp-select")[0];
    const selectMunicipio = document.querySelectorAll("comp-select")[1];
    const cpfInput = document.getElementById('cpf');
    const cnpjInput = document.getElementById('cnpj');
    const tipoSelect = document.getElementById('tipo');

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
    if (data.usuario) {
      selectMunicipio.select = {
        name: "Cidades",
        options: data.dados_municipio,
        idField: 'idMunicipio',
        textField: 'nome'
      };
      selectEstado.querySelector(`select option[value="${data.usuario.estado}"]`).selected = true;
      selectMunicipio.querySelector(`select option[value="${data.usuario.municipio}"]`).selected = true;
      tipoSelect.disabled = true;
      id = data.usuario.id;
    } else {
      selectMunicipio.select = {
        name: "Cidades",
        options: [{
          idCidade: 0,
          nome: 'Selecione um estado'
        }],
        idField: 'idCidade',
        textField: 'nome'
      };
    }

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
            idField: 'idMunicipio',
            textField: 'nome',
            extra: {
              id: 0,
              name: 'Selecione uma cidade'
            }
          };
        })
        .catch(error => console.error('Erro ao buscar cidades:', error));
    }

    function toggleFields() {
      var tipo = tipoSelect.value;
      if (tipo == '1') { // Pessoa Física
        cpfInput.disabled = false;
        cnpjInput.disabled = true;
        cnpjInput.value = ''; // Limpa o valor
      } else if (tipo == '2') { // Pessoa Jurídica
        cpfInput.disabled = true;
        cnpjInput.disabled = false;
        cpfInput.value = ''; // Limpa o valor
      } else {
        cpfInput.disabled = false;
        cnpjInput.disabled = false;
      }
    }

    function preencherFormulario(dados) {
      // Define os valores dos inputs
      selectEstado.value = dados.estado || '0';
      selectMunicipio.value = dados.municipio || '0';
      cpfInput.value = dados.cpf || '';
      cnpjInput.value = dados.cnpj || '';
      tipoSelect.value = dados.tipo || '0';
      document.getElementById('nome').value = dados.nome || '';
      document.getElementById('email').value = dados.email || '';
      document.getElementById('telefone').value = dados.telefone || ''; // Certifique-se de adicionar o telefone ao objeto se necessário
      document.getElementById('cep').value = dados.cep || '';
      document.getElementById('bairro').value = dados.bairro || '';
      document.getElementById('logradouro').value = dados.logradouro || '';
      document.getElementById('numero').value = dados.numero || '';
      // Campos adicionais podem ser preenchidos aqui da mesma maneira
    }

    tipoSelect.addEventListener('change', toggleFields);
    toggleFields();


  });

  VMasker(document.querySelector("#cep")).maskPattern("99999-999");
  VMasker(document.querySelector("#telefone")).maskPattern("(99) 99999-9999");
  VMasker(document.querySelector("#cpf")).maskPattern("999.999.999-99");
  VMasker(document.querySelector("#cnpj")).maskPattern("99.999.999/9999-99");
</script>