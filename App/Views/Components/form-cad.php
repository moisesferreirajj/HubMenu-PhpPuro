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

            <form id="form-cadastro" action="/api/cadastrar/usuario" method="POST" onsubmit="return validarFormulario();">
                <div class="form-group">
                    <label for="nome"><i class="fas fa-user"></i> Nome Completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>
                </div>

                <div class="form-group">
                    <label for="cep"><i class="fas fa-id-card"></i> CEP</label>
                    <input type="text" id="cep" name="cep" placeholder="00000-000" required>
                </div>

                <div class="form-group">
                    <label for="endereco"><i class="fas fa-home"></i> Endereço</label>
                    <input type="text" id="endereco" name="endereco" placeholder="Rua Inexistente, 123" required>
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" name="email" placeholder="seuemail@email.com" required>
                </div>

                <div class="form-group">
                    <label for="telefone"><i class="fas fa-phone"></i> Telefone</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>
                </div>

                <div class="form-group">
                    <label for="senha"><i class="fas fa-lock"></i> Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Sua senha" required>
                </div>

                <div class="form-group">
                    <label for="confirmar-senha"><i class="fas fa-lock"></i> Confirmar Senha</label>
                    <input type="password" id="confirmar-senha" placeholder="Confirme a senha" required>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" id="aceito-termos" required>
                    <label for="aceito-termos">
                        Aceito os <a href="#" target="_blank">termos e condições</a>
                    </label>
                </div>

                <button type="submit">
                    <i class="fas fa-user-plus"></i> Cadastrar-se
                </button>
            </form>

            <div class="links">
                <a href="/empresarial"><i class="fas fa-arrow-left"></i> Voltar ao Início</a>
                <a href="./login"><i class="fas fa-sign-in-alt"></i> Já tem cadastro? Entrar</a>
            </div>
        </div>
    </div>
</div>

<script>
function validarFormulario() {
    const senha = document.getElementById('senha').value.trim();
    const confirmar = document.getElementById('confirmar-senha').value.trim();

    if (senha !== confirmar) {
        alert('As senhas não conferem!');
        document.getElementById('confirmar-senha').style.borderColor = '#dc3545';
        return false;
    }

    return true;
}

window.onload = function () {
    // Máscara CEP
    const cepInput = document.getElementById('cep');
    cepInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 8) value = value.slice(0, 8);
        if (value.length > 5) value = value.replace(/^(\d{5})(\d{0,3})/, '$1-$2');
        e.target.value = value;
    });

    // Máscara Telefone
    const telInput = document.getElementById('telefone');
    telInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 11) value = value.slice(0, 11);
        if (value.length > 6) {
            value = value.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, '($1) $2-$3');
        } else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d{0,5}).*/, '($1) $2');
        }
        e.target.value = value;
    });
};
</script>
