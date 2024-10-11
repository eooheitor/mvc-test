document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const cpfInput = form.querySelector('input[name="cpf"]');

    form.addEventListener('submit', function (event) {
        let valid = true;
        const inputs = form.querySelectorAll('input[type="text"]');
        
        inputs.forEach(function (input) {
            if (input.value.trim() === '') {
                valid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
            if (input.name.toLowerCase() === 'cpf' && !isValidCPF(input.value.replace(/\D/g, ''))) {
                valid = false;
                input.classList.add('is-invalid');
                alert('CPF inválido. Por favor, insira um CPF válido.');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!valid) {
            event.preventDefault();
            alert('Por favor, preencha todos os campos corretamente.');
        }
    });
    cpfInput.addEventListener('input', function () {
        this.value = maskCPF(this.value);
    });
});

function isValidCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
        return false; 
    }
    let sum = 0;
    let remainder;
    for (let i = 1; i <= 9; i++) {
        sum += parseInt(cpf[i - 1]) * (11 - i);
    }
    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) {
        remainder = 0;
    }
    if (remainder !== parseInt(cpf[9])) {
        return false;
    }
    sum = 0;
    for (let i = 1; i <= 10; i++) {
        sum += parseInt(cpf[i - 1]) * (12 - i);
    }
    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) {
        remainder = 0;
    }
    return remainder === parseInt(cpf[10]);
}

function maskCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); 
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    return cpf;
}
