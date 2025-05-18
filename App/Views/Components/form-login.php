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
            <form>
                <div class="form-group">
                        <label for="Email"><i class="fas fa-user"></i> Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="email" placeholder="Seu email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Senha</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" placeholder="Sua senha">
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye-slash" id="eye-icon"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn">Entrar</button>
                <div class="links">
                    <a href="./"><i class="fas fa-arrow-left"></i> Voltar ao Início</a>
                    <a href="./cadastro"><i class="fas fa-sign-in-alt"></i> Cadastrar-se</a>
                </div>
                <!--
                <div class="social-login">
                    <p>Ou acesse com</p>
                    <div class="social-icons">
                        <div class="social-icon">
                            <i class="fab fa-google"></i>
                        </div>
                        <div class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <div class="social-icon">
                            <i class="fab fa-apple"></i>
                        </div>
                    </div>
                </div>
                -->
            </form>
            <div class="moving-light"></div>
        </div>
    </div>
    <script src="Assets/Js/password.js"></script>