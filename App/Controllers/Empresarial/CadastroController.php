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
                $usuarioInsert = $users->insert($nome, $senha, $email, null, $cep, $endereco, $telefone);
                $usuarioId = $usuarioInsert->last_id ?? null;

                if ($usuarioId) {
                    // Cria estabelecimento padrão e pega o ID
                    $estabelecimentosModel = new EstabelecimentosModel();
                    $estabInsert = $estabelecimentosModel->insert(
                        "Restaurante",
                        $cep,
                        "00.000.000/0000-00",
                        "Restaurante",
                        0,
                        $endereco,
                        null,
                        null,
                        "#000000",
                        "#000000",
                        "#000000"
                    );
                    $estabelecimentoId = $estabInsert->last_id ?? null;

                    if ($estabelecimentoId) {
                        $estabelecimentosUsuariosModel = new EstabelecimentosUsuariosModel();
                        $estabelecimentosUsuariosModel->insert(
                            $usuarioId,
                            '1',
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
