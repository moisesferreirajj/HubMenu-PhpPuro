<div class="container">
    <div class="image-section">
        <div class="image-overlay">
            <h2>Gerencie seu restaurante com facilidade!</h2>
            <p>Acesse o HubMenu para controlar cardápios, pedidos e clientes em uma única plataforma intuitiva</p>
        </div>
    </div>
    <div class="login-section">
        <div class="logo">
            <?php @require_once __DIR__ . '/svg-logo.php'; ?>
        </div>
        <h1>Acesso - Login</h1>
        <form method="POST" action="/api/autenticar/usuario">
            <div class="form-group">
                <label for="email"><i class="fas fa-user"></i> Email</label>
                <div class="input-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Seu email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Sua senha" required>
                    <span class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye-slash" id="eye-icon"></i>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn" id="logar">Entrar</button>
            <div class="links">
                <a href="./"><i class="fas fa-arrow-left"></i> Voltar ao Início</a>
                <a href="./esqueceuSenha"><i class="fa-solid fa-lock"></i> Esqueceu a Senha</a>
                <a href="./cadastro"><i class="fas fa-sign-in-alt"></i> Cadastrar-se</a>
            </div>
        </form>
        <div class="moving-light"></div>
    </div>
</div>
<script src="/Views/Assets/Js/password.js"></script>