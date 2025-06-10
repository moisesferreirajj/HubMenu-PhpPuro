<?php
// Defina o tempo restante em segundos (do PHP para o JS)
$tempoRestante = isset($_SESSION['codigo_expira']) ? max(0, $_SESSION['codigo_expira'] - time()) : 0;
?>

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
        <form method="POST" action="/api/autenticar/code">
            <div class="form-group">
                <label for="codigo"><i class="fas fa-user"></i>Código</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Insira o código" required>
                </div>
                <p>informe o código enviado em seu gmail</p>
            </div>
            <button type="submit" class="btn">Verificar</button>
            <div id="timer" style="font-weight:bold; color:#d9534f; margin-top:10px; display:flex; justify-content:center;"></div>
            <div class="links">
                <a href="./login?from=metodo_envio"><i class="fas fa-arrow-left"></i> Voltar ao Login</a>
                <a href="./cadastro"><i class="fas fa-sign-in-alt"></i> Cadastrar-se</a>
            </div>
        </form>
        <div class="moving-light"></div>
    </div>
</div>
<script>
    let tempoRestante = <?= $tempoRestante ?>;

    function formatarTempo(segundos) {
        const min = String(Math.floor(segundos / 60)).padStart(2, '0');
        const sec = String(segundos % 60).padStart(2, '0');
        return `${min}:${sec}`;
    }

    function atualizarTimer() {
        const timerDiv = document.getElementById('timer');
        const btn = document.querySelector('button[type="submit"]');
        if (tempoRestante <= 0) {
            timerDiv.textContent = "O código expirou. Solicite um novo código.";
            btn.textContent = "Reenviar email";
            btn.type = "button";
            btn.onclick = function() {
                window.location.href = "/empresarial/esqueceuSenha";
            };
            document.getElementById('codigo').disabled = true;
            clearInterval(interval);
            return;
        }
        timerDiv.textContent = "Código: " + formatarTempo(tempoRestante);
        tempoRestante--;
    }

    atualizarTimer();
    let interval = setInterval(atualizarTimer, 1000);
</script>