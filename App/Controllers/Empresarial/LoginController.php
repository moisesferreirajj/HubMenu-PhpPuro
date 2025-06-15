<?php

class LoginController extends RenderView
{
    public function index()
    {
        // Se já está logado, redireciona direto
        if (!empty($_SESSION['usuario_id'])) {
            header('Location: /gerenciar/cardapio/1');
            exit();
        }

        $this->loadView(
            'empresarial/login',
            [
                'Title' => 'HubMenu |'
            ],
        );

        if (isset($_GET['from']) && $_GET['from'] === 'metodo_envio') {
            unset($_SESSION['metodo_envio']);
        }
    }

    public function autenticar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /empresarial/login');
            exit();
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            echo "<script>alert('Preencha todos os campos.'); window.location.href = '/empresarial/login';</script>";
            exit();
        }

        $users = new UsuariosModel();
        $usuarioBusca = $users->buscarPorEmail($email);
        $usuario = $usuarioBusca->results[0]; // apenas o primeiro

        if (!$usuario || !password_verify($password, $usuario->senha)) {
            echo "<script>alert('Email ou senha inválido.'); window.location.href = '/empresarial/login';</script>";
            exit();
        }

        //SE A AUTENTICAÇÃO FOR BEM SUCEDIDA, ARMAZENA AS INFORMAÇÕES DO USUÁRIO NA SESSÃO
        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['usuario_nome'] = $usuario->nome;
        $_SESSION['usuario_email'] = $usuario->email;

        echo "<script>alert('Login realizado com sucesso!'); window.location.href = '/gerenciar/cardapio/1';</script>";
        exit();
    }

    public function autenticarAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/login');
            exit();
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            echo "<script>alert('Preencha todos os campos.'); window.location.href = '/admin/login';</script>";
            exit();
        }

        $users = new UsuariosModel();
        $usuarioBusca = $users->buscarPorEmail($email);
        $usuario = $usuarioBusca->results[0] ?? null;

        if (!$usuario || !password_verify($password, $usuario->senha)) {
            echo "<script>alert('Email ou senha inválido.'); window.location.href = '/admin/login';</script>";
            exit();
        }

        // VERIFICAÇÃO DE CARGOS DENTRO DO ARRAY
        if (!in_array((int)$usuario->cargo_id, [1, 2, 3])) {
            echo "<script>alert('Acesso restrito ao painel administrativo.'); window.location.href = '/';</script>";
            exit();
        }

        // Armazena na sessão
        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['cargo_id'] = $usuario->cargo_id;
        $_SESSION['usuario_nome'] = $usuario->nome;
        $_SESSION['usuario_email'] = $usuario->email;

        echo "<script>alert('Login realizado com sucesso!'); window.location.href = '/admin/dashboard';</script>";
        exit();
    }
}