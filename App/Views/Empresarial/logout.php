<?php 

$usuarioLogout = new UsuariosModel();
$usuarioLog = $usuarioLogout->findById($_SESSION['usuario_id']);
$user = $usuarioLog->results[0] ?? null;

if (isset($_POST['confirmar'])) {
    session_destroy();
    header('Location: /empresarial/login');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HubMenu - Clean Interface</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background:rgb(228, 228, 228);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal {
            background: white;
            border-radius: 12px;
            padding: 32px;
            width: 90%;
            max-width: 380px;
            text-align: center;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.68);
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #333;
        }

        .logo .hub {
            color: #e74c3c;
        }

        .logo .menu {
            color: #27ae60;
        }

        .logout-icon {
            width: 40px;
            height: 40px;
            background: #e74c3c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .logout-icon svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        .title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            line-height: 1.4;
            margin-bottom: 24px;
        }

        .user-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            border-left: 3px solid #27ae60;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #27ae60;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
        }

        .user-avatar svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        .user-name {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
        }

        .user-email {
            font-size: 13px;
            color: #666;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #e74c3c;
            width: 60%;
            color: white;
        }

        .btn-primary:hover {
            background: #c0392b;
        }

        .btn-secondary {
            background: transparent;
            margin: auto;
            width: 60%;
            color: #666;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background: #f8f9fa;
        }

        .footer {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #eee;
        }

        .footer-link {
            color: #999;
            text-decoration: none;
            font-size: 12px;
        }

        .footer-link:hover {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="modal">
        <div class="logo">
            <span class="hub">Hub</span><span class="menu">Menu</span>
        </div>
        
        <div class="logout-icon">
            <svg viewBox="0 0 20 24">
                <path d="M16 17v-3H9v-4h7V7l5 5-5 5M14 2a2 2 0 0 1 2 2v2h-2V4H4v16h10v-2h2v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h10z"/>
            </svg>
        </div>

        <h2 class="title">Sair da conta</h2>
        <p class="subtitle">Tem certeza que deseja encerrar sua sessão? Você precisará fazer login novamente para acessar sua conta.</p>

        <div class="user-info">
            <div class="user-avatar">
                <svg viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <div class="user-name"><?= htmlspecialchars($user->nome); ?></div>
            <div class="user-email"><?= htmlspecialchars($user->email); ?></div>
        </div>

        <div class="buttons">
            <form method="post">
                <button type="submit" name="confirmar" class="btn btn-primary">Confirmar Logout</button>
            </form>
            <button class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
        </div>
    </div>
</body>
</html>