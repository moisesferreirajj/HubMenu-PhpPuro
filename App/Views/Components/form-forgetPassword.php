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
        <form method="POST" action="#">
            <div class="form-group">
                <label for="email"><i class="fas fa-user"></i> Email</label>
                <div class="input-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Seu email" required>
                </div>
                <p>Enviaremos um código por gmail</p>
            </div>
            <button type="submit" class="btn">Entrar</button>
            <div class="links">
                <a href="./"><i class="fas fa-arrow-left"></i> Voltar ao Início</a>
                <a href="./cadastro"><i class="fas fa-sign-in-alt"></i> Cadastrar-se</a>
            </div>
        </form>
        <div class="moving-light"></div>
    </div>
</div>