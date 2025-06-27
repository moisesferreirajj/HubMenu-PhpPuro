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
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $cep = trim($_POST['cep']);
            $endereco = trim($_POST['endereco']);
            $telefone = trim($_POST['telefone']);

            $users = new UsuariosModel();
            $usuario = $users->buscarPorEmail($email);
            $usuarioExistente = $usuario->results[0] ?? null;

            if (!$usuarioExistente || ($usuarioExistente->email == '' && $usuarioExistente->telefone == '')) {
                // Insere usuário e pega o ID
                $usuarioId = $users->insert(
                    $nome,
                    $senha,
                    $email,
                    null,
                    $cep,
                    $endereco,
                    $telefone
                );

                if ($usuarioId) {
                    // Cria estabelecimento padrão e pega o ID
                    $estabelecimentosModel = new EstabelecimentosModel();
                    $estabelecimentoId = $estabelecimentosModel->insert(
                        "Restaurante",        // nome
                        $cep,                 // cep
                        "00.000.000/0000-00", // cnpj
                        "Restaurante",        // tipo
                        0,                    // media_avaliacao
                        $endereco,            // endereco
                        null,                 // imagem
                        null,                 // banner
                        "#000000",            // cor1
                        "#000000",            // cor2
                        "#000000"             // cor3
                    );

                    if ($estabelecimentoId) {
                        $estabelecimentosUsuariosModel = new EstabelecimentosUsuariosModel();
                        $estabelecimentosUsuariosModel->insert(
                            $usuarioId,
                            1, // cargo_id padrão (Administrador)
                            $estabelecimentoId
                        );
                    }

                    echo "<script>
                        alert('Cadastro realizado com sucesso!');
                        window.location.href = '/empresarial/login';
                    </script>";
                    exit;
                } else {
                    echo "<script>
                        alert('Erro ao cadastrar usuário.');
                        window.location.href = '/empresarial/cadastro';
                    </script>";
                    exit;
                }
            } else {
                echo "<script>
                    alert('Usuário já cadastrado');
                    window.location.href = '/empresarial/login';
                </script>";
            }
        } else {
            echo "<script>
                    alert('Método não permitido.');
                </script>";
            exit;
        }
    }

}
