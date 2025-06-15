<div class="container">
    <div class="image-section">
        <div class="image-overlay">
            <h2>Esqueceu a Senha?</h2>
            <p>Coloque seu email que enviaremos um código para a redefinição da senha</p>
        </div>
    </div>
    <div class="login-section">
        <div class="logo">
            <?php @require_once __DIR__ . '/svg-logo.php'; ?>
        </div>
        <h1>Esqueceu Senha</h1>
        <form method="POST" action="/api/autenticar/senha">
            <div class="form-group">
                <label for="telefone"><i class="fas fa-user"></i> Telefone</label>
                <div class="input-group">
                    <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>
                </div>
                <p>Enviaremos um código por SMS</p>
            </div>
            <button type="submit" class="btn">Entrar</button>
            <div class="links">
                <a href="./login?from=metodo_envio"><i class="fas fa-arrow-left"></i> Voltar ao Login</a>
                <a href="./cadastro"><i class="fas fa-sign-in-alt"></i> Cadastrar-se</a>
            </div>
        </form>
        <div class="moving-light"></div>
    </div>
</div>

<script>
    // Máscara e validação de telefone em tempo real
    document.getElementById('telefone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito

        // Aplica a máscara
        if (value.length <= 10) {
            // Formato para telefone fixo: (00) 0000-0000
            value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
        } else {
            // Formato para celular: (00) 00000-0000
            value = value.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, '($1) $2-$3');
        }

        e.target.value = value;
    });

    // Remove formatação visual ao focar no campo (opcional)
    document.getElementById('telefone').addEventListener('focus', function(e) {
        if (e.target.value === '') {
            e.target.placeholder = '(00) 00000-0000';
        }
    });
</script>