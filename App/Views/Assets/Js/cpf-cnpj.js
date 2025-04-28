function selectType(type) {
    // Remover classe 'selected' de todos os botões
    document.querySelectorAll('.type-button').forEach(btn => {
        btn.classList.remove('selected');
    });
    
    // Remover classe 'active' de todos os formulários
    document.querySelectorAll('.form-section').forEach(form => {
        form.classList.remove('active');
    });
    
    // Adicionar classe 'selected' ao botão clicado
    document.getElementById('btn-pessoa-' + type).classList.add('selected');
    
    // Mostrar o formulário correspondente
    document.getElementById('form-' + type).classList.add('active');
}

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function cadastrar(type) {
    // Formulário de validação básica
    let isValid = true;
    let formPrefix = type === 'fisica' ? '-pf' : '-pj';
    
    // Validar campos obrigatórios
    const requiredFields = document.querySelectorAll(`#form-${type} input`);
    requiredFields.forEach(field => {
        if (field.value.trim() === '') {
            field.style.borderColor = '#dc3545';
            isValid = false;
        } else {
            field.style.borderColor = '';
        }
    });
    
    // Validar senhas iguais
    const senha = document.getElementById(`senha${formPrefix}`);
    const confirmarSenha = document.getElementById(`confirmar-senha${formPrefix}`);
    
    if (senha.value !== confirmarSenha.value) {
        confirmarSenha.style.borderColor = '#dc3545';
        alert('As senhas não conferem!');
        isValid = false;
    }
    
    if (isValid) {
        // Simulação de envio
        const submitBtn = document.querySelector(`#form-${type} button`);
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processando...';
        submitBtn.disabled = true;
        
        setTimeout(() => {
            alert(`Cadastro de ${type === 'fisica' ? 'Pessoa Física' : 'Pessoa Jurídica'} realizado com sucesso!`);
            submitBtn.innerHTML = `<i class="fas fa-${type === 'fisica' ? 'user' : 'building'}-plus"></i> Cadastrar-se`;
            submitBtn.disabled = false;
        }, 2000);
    }
}

// Iniciar com Pessoa Física selecionada por padrão
window.onload = function() {
    selectType('fisica');
    
    // Adicionando máscaras para CPF e CNPJ (simulado)
    const cpfInput = document.getElementById('cpf');
    cpfInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 11) value = value.slice(0, 11);
        
        if (value.length > 9) {
            value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2}).*/, '$1.$2.$3-$4');
        } else if (value.length > 6) {
            value = value.replace(/^(\d{3})(\d{3})(\d{0,3}).*/, '$1.$2.$3');
        } else if (value.length > 3) {
            value = value.replace(/^(\d{3})(\d{0,3}).*/, '$1.$2');
        }
        e.target.value = value;
    });
    
    const cnpjInput = document.getElementById('cnpj');
    cnpjInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 14) value = value.slice(0, 14);
        
        if (value.length > 12) {
            value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2}).*/, '$1.$2.$3/$4-$5');
        } else if (value.length > 8) {
            value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{0,4}).*/, '$1.$2.$3/$4');
        } else if (value.length > 5) {
            value = value.replace(/^(\d{2})(\d{3})(\d{0,3}).*/, '$1.$2.$3');
        } else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d{0,3}).*/, '$1.$2');
        }
        e.target.value = value;
    });
    
    // Formatação telefone
    const telefones = document.querySelectorAll('input[type="tel"]');
    telefones.forEach(tel => {
        tel.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);
            
            if (value.length > 6) {
                value = value.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, '($1) $2-$3');
            } else if (value.length > 2) {
                value = value.replace(/^(\d{2})(\d{0,5}).*/, '($1) $2');
            }
            e.target.value = value;
        });
    });
};