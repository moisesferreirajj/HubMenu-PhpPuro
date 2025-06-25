<?php

class RelatorioController extends RenderView
{

    public function gerarPdfRelatorio($id)
    {
        // 1. Puxe os dados dos models (igual ao criarRelatorio)
        $produtoModel = new ProdutosModel();
        $estabelecimentosModel = new EstabelecimentosModel();
        $pedidosModel = new PedidosModel();
        $usuariosModel = new UsuariosModel();
        $vendasModel = new VendasModel();
        $avaliacoesModel = new AvaliacoesModel();

        $estabelecimento = $estabelecimentosModel->findById($id)->results[0] ?? null;
        $produtosObj = $produtoModel->findByEstabelecimentoId($id);
        $produtos = $produtosObj->results ?? [];
        $pedidos = $pedidosModel->getOrderByCompanyId($id) ?? [];
        $usuarios = $usuariosModel->findByEstabelecimentoId($id) ?? [];
        $vendas = $vendasModel->findByEstabelecimentoId($id) ?? [];
        $avaliacoes = $avaliacoesModel->getByEstabelecimento($id, 10);

        require_once __DIR__ . '/../../../vendor/autoload.php';
        $pdf = new \FPDF();

        $pdf->SetTitle(utf8_decode('Relatório do Estabelecimento'));

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Título
        $pdf->Cell(0, 10, utf8_decode('Relatório do Estabelecimento: ' . ($estabelecimento->nome ?? 'N/A')), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);

        // Dados Gerais
        $pdf->Cell(0, 10, utf8_decode('Endereço: ' . ($estabelecimento->endereco ?? 'N/A')), 0, 1);
        $pdf->Cell(0, 10, utf8_decode('Telefone: ' . ($estabelecimento->telefone ?? 'N/A')), 0, 1);
        $pdf->Cell(0, 10, utf8_decode('CNPJ: ' . ($estabelecimento->cnpj ?? 'N/A')), 0, 1);

        // Carregar cargos em array associativo para lookup rápido
        $cargosObj = (new CargosModel())->findAll();
        $cargosArr = [];
        if (isset($cargosObj->results)) {
            foreach ($cargosObj->results as $cargo) {
                $cargosArr[$cargo->id] = $cargo->nome;
            }
        }

        // Produtos
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, utf8_decode('Produtos'), 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 7, utf8_decode('Nome'), 1);
        $pdf->Cell(30, 7, utf8_decode('Preço'), 1);
        $pdf->Cell(30, 7, utf8_decode('Categoria'), 1);
        $pdf->Cell(30, 7, utf8_decode('Status'), 1);
        $pdf->Ln();
        foreach ($produtos as $produto) {
            // Corrige nome do produto se não vier
            $nomeProduto = $produto->nome ?? '';
            if (empty($nomeProduto) && isset($produto->id)) {
                $produtoBusca = $produtoModel->findById($produto->id);
                $nomeProduto = $produtoBusca->nome ?? '';
            }
            // Status amigável
            $status = '';
            if (isset($produto->status_produtos)) {
                $status = $produto->status_produtos == 1 ? 'Em estoque' : 'Fora de estoque';
            }
            $pdf->Cell(60, 6, utf8_decode($nomeProduto), 1);
            $pdf->Cell(30, 6, 'R$ ' . number_format($produto->valor ?? 0, 2, ',', '.'), 1);
            $pdf->Cell(30, 6, utf8_decode($produto->categoria_nome ?? ''), 1);
            $pdf->Cell(30, 6, utf8_decode($status), 1);
            $pdf->Ln();
        }

        // Usuários
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, utf8_decode('Usuários'), 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 7, utf8_decode('Nome'), 1);
        $pdf->Cell(40, 7, utf8_decode('Email'), 1);
        $pdf->Cell(30, 7, utf8_decode('Cargo'), 1);
        $pdf->Ln();
        foreach ($usuarios as $usuario) {
            $cargoNome = '';
            if (isset($usuario->cargo_id) && isset($cargosArr[$usuario->cargo_id])) {
                $cargoNome = $cargosArr[$usuario->cargo_id];
            }
            $pdf->Cell(60, 6, utf8_decode($usuario->nome ?? ''), 1);
            $pdf->Cell(40, 6, utf8_decode($usuario->email ?? ''), 1);
            $pdf->Cell(30, 6, utf8_decode($cargoNome), 1);
            $pdf->Ln();
        }

        // Vendas
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, utf8_decode('Vendas'), 0, 1);
        $pdf->SetFont('Arial', '', 10);
        // Ajuste das larguras: ID Venda (18), ID Pedido (22), Produtos Vendidos (70), Valor (25), Data (45)
        $pdf->Cell(18, 7, utf8_decode('ID Venda'), 1);
        $pdf->Cell(22, 7, utf8_decode('ID Pedido'), 1);
        $pdf->Cell(70, 7, utf8_decode('Produtos Vendidos'), 1);
        $pdf->Cell(25, 7, utf8_decode('Valor'), 1);
        $pdf->Cell(45, 7, utf8_decode('Data'), 1);
        $pdf->Ln();
        $valorTotalVendas = 0;
        foreach ($vendas as $venda) {
            // Buscar produtos do pedido vinculado à venda
            $produtosVendidos = [];
            if (isset($venda->pedido_id)) {
                $produtosPedido = $pedidosModel->findOrderProdById($venda->pedido_id);
                if (is_array($produtosPedido)) {
                    foreach ($produtosPedido as $prod) {
                        $nome = $prod->nome ?? '';
                        $qtd = $prod->quantidade ?? 1;
                        $produtosVendidos[] = utf8_decode($nome) . ' (x' . $qtd . ')';
                    }
                }
            }
            $produtosVendidosStr = implode(', ', $produtosVendidos);

            $pdf->Cell(18, 6, $venda->id ?? '', 1);
            $pdf->Cell(22, 6, $venda->pedido_id ?? '', 1);
            $pdf->Cell(70, 6, $produtosVendidosStr, 1);
            $pdf->Cell(25, 6, 'R$ ' . number_format($venda->valor ?? $venda->valor_total ?? 0, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(45, 6, utf8_decode($venda->data ?? $venda->data_venda ?? ''), 1);
            $pdf->Ln();
            $valorTotalVendas += $venda->valor ?? $venda->valor_total ?? 0;
        }
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(110, 8, utf8_decode('Valor Total Recebido:'), 1);
        $pdf->Cell(70, 8, 'R$ ' . number_format($valorTotalVendas, 2, ',', '.'), 1, 0, 'R');
        $pdf->Ln(12);

        // Avaliações
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, utf8_decode('Avaliações Recentes'), 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 7, utf8_decode('Usuário'), 1);
        $pdf->Cell(30, 7, utf8_decode('Nota'), 1);
        $pdf->Cell(80, 7, utf8_decode('Comentário'), 1);
        $pdf->Ln();
        foreach ($avaliacoes as $avaliacao) {
            $pdf->Cell(60, 6, utf8_decode($avaliacao->usuario_nome ?? ''), 1);
            $pdf->Cell(30, 6, $avaliacao->nota ?? $avaliacao->avaliacao ?? '', 1);
            $pdf->Cell(80, 6, utf8_decode($avaliacao->comentario ?? ''), 1);
            $pdf->Ln();
        }

        // 3. Baixe o PDF
        $pdf->Output('I', 'relatorio_estabelecimento_' . $id . '.pdf');
        exit;
    }

}