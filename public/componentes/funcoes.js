class validation {

  static validar(form, validations) {
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
          if (!this.validatePhone(input.value)) {
            this.invalidFeedback(input, 'Telefone inválido!');
            isValid = false;
            return;
          }
          break;
        case 'email':
          if (!this.validateEmail(input.value)) {
            this.invalidFeedback(input, 'E-mail inválido!');
            isValid = false;
            return;
          }
          break;
        case 'cpf':
          if (!this.validateCpf(input.value)) {
            this.invalidFeedback(input, 'CPF inválido!');
            isValid = false;
            return;
          }
          break;
        case 'required':
          if (!input.value.trim()) {
            input.value = '';
            this.invalidFeedback(input, 'Campo obrigatório!');
            isValid = false;
            return;
          }
          break;
        case 'integer':
          if (!Number.isInteger(Number(input.value))) {
            this.invalidFeedback(input, 'Deve ser um número inteiro!');
            isValid = false;
            return;
          }
          break;
        case 'cnpj':
          if (!this.validateCnpj(input.value)) {
            this.invalidFeedback(input, 'CNPJ inválido!');
            isValid = false;
            return;
          }
          break;
        case 'notZero':
          if (input.value === '0') {
            this.invalidFeedback(input, 'Deve ser diferente de zero!');
            isValid = false;
            return;
          }
          break;
        // Adicione mais casos conforme necessário
        default:
          console.error(`Tipo de validação '${type}' não suportado.`);
          return;
        
        }
        this.validFeedback(input)
  
  
    });
  
    return isValid;
  }

  static invalidFeedback(input, message) {
    input.classList.add('is-invalid');
    input.classList.remove('is-valid');
    funcoes.showToast(message, 'danger');
  }

  static validFeedback(input) {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }

  static validateCpf(cpf) {
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

  static validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  static validatePhone(phone) {
    return /^\(\d{2}\)\s(\d{4,5}-\d{4})$/.test(phone);
  }

  static validateCnpj(cnpj) {
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
}

class funcoes {
  static generateUUID() {
    let d = new Date().getTime(); // Timestamp atual
    let d2 = (performance && performance.now && (performance.now()*1000)) || 0; // Timestamp de alta precisão se disponível
  
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        let r = Math.random() * 16; // Número aleatório de 0 a 15
        if(d > 0) { // Usa o timestamp para manter a entropia
            r = (d + r)%16 | 0;
            d = Math.floor(d/16);
        } else { // Usa o timestamp de alta precisão se disponível
            r = (d2 + r)%16 | 0;
            d2 = Math.floor(d2/16);
        }
        return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
  }

  static showToast(message, type) {
    const toast = document.createElement('comp-toast');
    toast.toast = {
      message: message,
      type: type
    };
    document.body.appendChild(toast);
  }
}  
  
