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
        <form method="POST" action="/api/autenticar/changepassword">
            <div class="form-group">
                <label for="nova_senha"><i class="fas fa-user"></i> Nova Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="nova_senha" name="nova_senha" placeholder="Sua nova senha" required>
                </div>
                <label for="confirmar_nova_senha" style="margin-top: 20px; gap:20px"><i class="fas fa-user"></i> Nova Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirmar_nova_senha" name="confirmar_nova_senha" placeholder="Confirme a nova senha" required>
                </div>
                <p>Enviaremos um código por Gmail</p>
            </div>
            <button type="submit" class="btn">Trocar senha</button>
            <div class="links">
                <a href="./login?from=metodo_envio"><i class="fas fa-arrow-left"></i> Voltar ao Login</a>
                <a href="./cadastro"><i class="fas fa-sign-in-alt"></i> Cadastrar-se</a>
            </div>
        </form>
        <div class="moving-light"></div>
    </div>
</div>