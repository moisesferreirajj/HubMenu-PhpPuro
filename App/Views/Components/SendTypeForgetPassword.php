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
        <form method="POST" action="/api/autenticar/sendtype">
            <div class="form-group">
                <div class="select-method-btns">
                    <input type="radio" class="btn-check" name="metodo_envio" id="btn-email" value="email">
                    <label for="btn-email" class="btn-select">E-mail</label>
                    <input type="radio" class="btn-check" name="metodo_envio" id="btn-sms" value="sms">
                    <label for="btn-sms" class="btn-select">Mensagem SMS</label>
                </div>
                <p>Selecione a forma de envio do código</p>
            </div>
            <button type="submit" class="btn">Confirmar</button>
            <div class="links">
                <a href="./login"><i class="fas fa-arrow-left"></i> Voltar ao Início</a>
                <a href="./cadastro"><i class="fas fa-sign-in-alt"></i> Cadastrar-se</a>
            </div>
        </form>
        <div class="moving-light"></div>
    </div>
</div>