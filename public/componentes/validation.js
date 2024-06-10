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
        if (!input.value.trim()) {
          input.value = '';
          invalidFeedback(input, 'Campo obrigatório!');
          isValid = false;
          return;
        }
        break;
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
      case 'notZero':
        if (input.value === '0') {
          invalidFeedback(input, 'Deve ser diferente de zero!');
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
  if (cpf.length !== 14) return false;

  const cpfNumbers = cpf.match(/\d/g).join('');
  if (cpfNumbers.length !== 11) return false;

  if (/^(\d)\1+$/.test(cpfNumbers)) return false;

  const cpfBase = cpfNumbers.slice(0, 9);
  const cpfDigits = cpfNumbers.slice(9);

  function calculateDigit(base, position) {
    let total = base.split('').reduce((acc, num, idx) => {
      return acc + Number(num) * (position - idx);
    }, 0);
    const remainder = (total * 10) % 11;
    return remainder === 10 ? 0 : remainder;
  }

  const firstDigit = calculateDigit(cpfBase, 10);
  const secondDigit = calculateDigit(cpfBase + firstDigit, 11);

  return firstDigit === Number(cpfDigits[0]) && secondDigit === Number(cpfDigits[1]);
}

function validateEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validatePhone(phone) {
  return /^\(\d{2}\)\s(\d{4,5}-\d{4})$/.test(phone);
}

function validateCnpj(cnpj) {
  if (cnpj.length !== 18) return false;

  // Extrai somente os números
  const cnpjNumbers = cnpj.match(/\d/g).join('');
  if (cnpjNumbers.length !== 14) return false;

  // Separa base e dígitos verificadores
  const cnpjBase = cnpjNumbers.slice(0, 12);
  const cnpjDigits = cnpjNumbers.slice(12);

  // Função para calcular cada dígito
  function calculateDigit(base, pos) {
    const weights = pos === 1 ? [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2] : [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    const sum = base.split('').reduce((total, value, index) => {
      return total + (value * weights[index]);
    }, 0);
    const remainder = sum % 11;
    return remainder < 2 ? 0 : 11 - remainder;
  }

  // Verifica os dígitos
  const calculatedFirstDigit = calculateDigit(cnpjBase, 1);
  const calculatedSecondDigit = calculateDigit(cnpjBase + calculatedFirstDigit, 2);

  return calculatedFirstDigit === Number(cnpjDigits[0]) && calculatedSecondDigit === Number(cnpjDigits[1]);
}