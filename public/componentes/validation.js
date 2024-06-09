function validateForm(form, validations) {
  let isValid = true;

  validations.forEach(validation => {
    const { field, type } = validation;
    const input = form.elements[field];

    if (!input) {
      console.error(`Campo ${field} não encontrado.`);
      return;
    }

    switch (type) {
      case 'telefone':
        if (!validatePhone(input.value)) {
          invalidFeedback(input, 'Telefone inválido!');
          isValid = false;
          return;
        }
        break;
      case 'email':
        if (!validateEmail(input.value)) {
          invalidFeedback(input, 'E-mail inválido!');
          isValid = false;
          return;
        }
        break;
      case 'cpf':
        if (!validateCpf(input.value)) {
          invalidFeedback(input, 'CPF inválido!');
          isValid = false;
          return;
        }
        break;
      case 'required':
        if (!input.value) {
          invalidFeedback(input, 'Campo obrigatório!');
          isValid = false;
          return;
        }
        return;
      case 'integer':
        if (!Number.isInteger(Number(input.value))) {
          invalidFeedback(input, 'Deve ser um número inteiro!');
          isValid = false;
          return;
        }
        break;
      case 'cnpj':
        if (!validateCnpj(input.value)) {
          invalidFeedback(input, 'CNPJ inválido!');
          isValid = false;
          return;
        }
        break;
      // Adicione mais casos conforme necessário
      default:
        console.error(`Tipo de validação '${type}' não suportado.`);
        return;
      
      }
      validFeedback(input)


  });

  return isValid;
}

function invalidFeedback(input, message) {
  input.classList.add('is-invalid');
  input.classList.remove('is-valid');
  showToast(message, 'danger');
}

function validFeedback(input) {
  input.classList.remove('is-invalid');
  input.classList.add('is-valid');
}

function validateCpf(cpf) {
  if (cpf.length !== 14) {
    return false;
  }

  const cpfNumbers = cpf.match(/\d/g).join('');
  if (cpfNumbers.length !== 11) {
    return false;
  }

  const [cpfSemDigito, digito] = cpfNumbers.match(/(\d{9})(\d{2})/).slice(1);
  const cpfSemDigitoArray = cpfSemDigito.split('').map(Number);

  const firstDigit = cpfSemDigitoArray.reduce((total, value, index) => {
    return total + value * (10 - index);
  }, 0) * 10 % 11;

  const secondDigit = cpfSemDigitoArray.reduce((total, value, index) => {
    return total + value * (11 - index);
  }, 0) * 10 % 11;

  return firstDigit === Number(digito[0]) && secondDigit === Number(digito[1]);
}

function validateEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validatePhone(phone) {
  return /^(\d{2})\s(\d{4,5}-\d{4})$/.test(phone);
}

function validateCnpj(cnpj) {
  if (cnpj.length !== 18) {
    return false;
  }

  const cnpjNumbers = cnpj.match(/\d/g).join('');
  if (cnpjNumbers.length !== 14) {
    return false;
  }

  const [cnpjSemDigito, digito] = cnpjNumbers.match(/(\d{12})(\d{2})/).slice(1);
  const cnpjSemDigitoArray = cnpjSemDigito.split('').map(Number);

  const firstDigit = cnpjSemDigitoArray.reduce((total, value, index) => {
    return total + value * (5 - index % 4);
  }, 0) % 11;

  const secondDigit = cnpjSemDigitoArray.reduce((total, value, index) => {
    return total + value * (6 - index % 5);
  }, 0) % 11;

  return firstDigit === Number(digito[0]) && secondDigit === Number(digito[1]);
}