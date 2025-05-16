<div class="container">
    <div class="left-side">
        <div class="left-content">
            <h1>Gerencie seu restaurante com facilidade!</h1>
            <p>Acesse o HubMenu para controlar cardápios, pedidos e clientes em uma única plataforma intuitiva e moderna. Simplifique a gestão do seu negócio e aumente seus resultados.</p>
        </div>
    </div>
    <div class="right-side">
        <div class="form-container">
            <?php @require_once __DIR__ . '/svg-logo.php'; ?>
            <h2>Acesso - Cadastro</h2>

            <!-- Formulário Pessoa Física -->
            <div class="form-section active" id="form-fisica">
                <div class="form-group">
                    <label for="nome"><i class="fas fa-user"></i> Nome Completo</label>
                    <input type="text" id="nome" placeholder="Digite seu nome completo">
                </div>

                <div class="form-group">
                    <label for="cpf"><i class="fas fa-id-card"></i> CPF</label>
                    <input type="text" id="cpf" placeholder="000.000.000-00">
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" placeholder="Seu email">
                </div>

                <div class="form-group">
                    <label for="telefone"><i class="fas fa-phone"></i> Telefone</label>
                    <input type="tel" id="telefone" placeholder="(00) 00000-0000">
                </div>

                <div class="form-group">
                    <label for="senha"><i class="fas fa-lock"></i> Senha</label>
                    <div class="password-container">
                        <input type="password" id="senha" placeholder="Sua senha">
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirmar-senha"><i class="fas fa-lock"></i> Confirmar Senha</label>
                    <div class="password-container">
                        <input type="password" id="confirmar-senha" placeholder="Confirme sua senha">
                    </div>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="aceito-termos">
                    <label class="form-check-label" for="aceito-termos">
                        Aceito os <a href="#" target="_blank">termos e condições</a>
                    </label>
        
                </div>

                <button type="button" onclick="cadastrar()">
                    <i class="fas fa-user-plus"></i> Cadastrar-se
                </button>
            </div>

            <div class="links">
                <a href="/Views/Empresarial/index.php"><i class="fas fa-arrow-left"></i> Voltar ao Início</a>
                <a href="./login"><i class="fas fa-sign-in-alt"></i> Já tem cadastro? Entrar</a>
            </div>
        </div>
    </div>
</div>

<script>
function cadastrar() {
    let isValid = true;

    // Validar campos obrigatórios
    const requiredFields = document.querySelectorAll('#form-fisica input');
    requiredFields.forEach(field => {
        if (field.value.trim() === '') {
            field.style.borderColor = '#dc3545';
            isValid = false;
        } else {
            field.style.borderColor = '';
        }
    });

    // Validar senhas iguais
    const senha = document.getElementById('senha');
    const confirmarSenha = document.getElementById('confirmar-senha');

    if (senha.value !== confirmarSenha.value) {
        confirmarSenha.style.borderColor = '#dc3545';
        alert('As senhas não conferem!');
        isValid = false;
    }

    if (isValid) {
        const submitBtn = document.querySelector('#form-fisica button');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processando...';
        submitBtn.disabled = true;

        setTimeout(() => {
            alert('Cadastro realizado com sucesso!');
            submitBtn.innerHTML = '<i class="fas fa-user-plus"></i> Cadastrar-se';
            submitBtn.disabled = false;
        }, 2000);
    }
}

window.onload = function () {
    // Máscara CPF
    const cpfInput = document.getElementById('cpf');
    cpfInput.addEventListener('input', function (e) {
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

    // Máscara Telefone
    const telefones = document.querySelectorAll('input[type="tel"]');
    telefones.forEach(tel => {
        tel.addEventListener('input', function (e) {
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
</script>
