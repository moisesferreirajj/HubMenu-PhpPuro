<?php

class CadastroController extends RenderView
{
    public function index()
    {
        $users = new UsuariosModel();
        $this->loadView('empresarial/cadastro', [
            'Title' => 'HubMenu |',
            'users' => $users->findAll(),
        ]);
    }

    //CADASTRO DE USUÁRIOS BY MOISES
    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome']);
            $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT);
            $email = trim($_POST['email']);
            $cep = trim($_POST['cep']);
            $endereco = trim($_POST['endereco']);
            $telefone = trim($_POST['telefone']);

            $users = new UsuariosModel();

            if ($users->insert($nome, $senha, $email, $cep, $endereco, $telefone)) {
                echo "<script>
                        alert('Cadastro realizado com sucesso!');
                        window.location.href = '/empresarial/login';
                    </script>";
                exit;
            } else {
                echo "<script>
                        alert('Erro ao cadastrar usuário.');
                    </script>";
                exit;
            }
        } else {
            echo "<script>
                    alert('Método não permitido.');
                </script>";
            exit;
        }
    }
    
}
