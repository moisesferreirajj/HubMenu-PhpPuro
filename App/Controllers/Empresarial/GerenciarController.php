<?php

class GerenciarController extends RenderView
{
    public function index($id)
    {
        // Verifica acesso (ajuste conforme sua lógica de permissão)
        AcessoController::verificarAcesso('/empresarial/gerenciar/{id}', $_SESSION['usuario_cargo'], $id);

        // Models
        $estabelecimentosModel = new EstabelecimentosModel();
        $usuariosModel = new UsuariosModel();
        $avaliacoesModel = new AvaliacoesModel();

        // Dados principais
        $estabelecimento = $estabelecimentosModel->findById($id)->results[0] ?? null;
        $usuarios = $usuariosModel->findByEstabelecimentoId($id) ?? [];
        $avaliacoes = $avaliacoesModel->getByEstabelecimento($id, 10); // últimas 10 avaliações

        $this->loadView(
            'empresarial/gerenciar',
            [
                'Title' => 'HubMenu | Gerenciar Conta',
                'EstabelecimentoID' => $id,
                'Estabelecimento' => $estabelecimento,
                'Usuarios' => $usuarios,
                'Avaliacoes' => $avaliacoes
            ]
        );
    }

    public function editarEstabelecimento()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log(print_r($_FILES, true)); // <-- Adicione esta linha para depurar
            $id = $_POST['id'] ?? null;
            if (!$id) {
                echo json_encode(['status' => 'error', 'message' => 'ID não informado']);
                return;
            }

            $nome = $_POST['nome'] ?? '';
            $tipo = $_POST['tipo'] ?? '';
            $cnpj = $_POST['cnpj'] ?? '';
            $cep = $_POST['cep'] ?? '';
            $endereco = $_POST['endereco'] ?? '';
            $cor1 = $_POST['cor1'] ?? '#28a745';
            $cor2 = $_POST['cor2'] ?? '#20c997';
            $cor3 = $_POST['cor3'] ?? '#17a2b8';

            // Upload de imagem de perfil
            $imagem = $_POST['imagem_atual'] ?? null;
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
                $permitidas = ['png', 'jpg', 'jpeg', 'webp'];
                if (in_array($ext, $permitidas)) {
                    $nomeImagem = uniqid() . '.' . $ext;
                    $destino = __DIR__ . '/../../Views/Assets/Images/Estabelecimentos/' . $nomeImagem;
                    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
                        $imagem = '/Views/Assets/Images/Estabelecimentos/' . $nomeImagem;
                    }
                }
            }
            
            // Upload de banner (opcional, se existir no banco)
            $banner = $_POST['banner_atual'] ?? null;
            if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION));
                $permitidas = ['png', 'jpg', 'jpeg', 'webp'];
                if (in_array($ext, $permitidas)) {
                    $nomeBanner = uniqid() . '.' . $ext;
                    $destino = __DIR__ . '/../../Views/Assets/Images/Estabelecimentos/' . $nomeBanner;
                    if (move_uploaded_file($_FILES['banner']['tmp_name'], $destino)) {
                        $banner = '/Views/Assets/Images/Estabelecimentos/' . $nomeBanner;
                    }
                }
            }

            $model = new EstabelecimentosModel();
            $result = $model->updateGerenciar(
                $id, $nome, $cep, $cnpj, $tipo, $endereco, $imagem, $banner, $cor1, $cor2, $cor3
            );

            // Se você tiver o campo banner no banco, adicione no update do model também!

            if ($result->status === 'success') {
                echo json_encode(['status' => 'success', 'message' => 'Estabelecimento atualizado com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar.']);
            }
        }
    }
}   