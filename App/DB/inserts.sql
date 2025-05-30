INSERT INTO `avaliacoes` (`usuario_id`, `estabelecimento_id`, `avaliacao`, `comentario`)
VALUES
(1, 1, 5, 'Excelente atendimento e comida!'),
(2, 2, 4, 'Muito bom, mas poderia ser mais rápido.'),
(3, 3, 5, 'Sabor incrível!'),
(4, 4, 3, 'Ok, mas esperava mais.'),
(5, 5, 4, 'Boa padaria, voltarei com certeza.'),
(6, 6, 5, 'Melhor lanche da cidade!'),
(7, 7, 5, 'Comida deliciosa e ambiente agradável.'),
(8, 8, 4, 'Bom hambúrguer, mas atendimento demorado.'),
(9, 9, 5, 'Sorvete maravilhoso!'),
(10, 10, 3, 'Ambiente legal, mas atendimento deixou a desejar.');


INSERT INTO `avaliacoes_sistema` (`usuario_id`, `avaliacao`, `comentario`)
VALUES
(1, 5, 'Sistema muito intuitivo e rápido, facilitou o controle dos pedidos.'),
(2, 4, 'Gostei da interface, mas poderia ter mais opções de filtros nas vendas.'),
(3, 5, 'Excelente! Melhorou muito a organização do meu estabelecimento.'),
(4, 3, 'Funciona bem, mas encontrei lentidão ao gerar relatórios.'),
(5, 4, 'Sistema prático, mas a tela de cadastro poderia ser mais simples.'),
(6, 5, 'Tudo funcionando perfeitamente. Recomendo!'),
(7, 5, 'Atendeu todas as necessidades do meu negócio. Parabéns à equipe.'),
(8, 4, 'Fácil de usar, só senti falta de um tutorial inicial.'),
(9, 5, 'Fluxo de pedidos ficou muito mais eficiente com o Hub Menu.'),
(10, 3, 'Alguns bugs ao salvar produtos, mas no geral é bom.');
  
-- Copiando dados para a tabela db_hubmenu.categorias: ~10 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `nome`) VALUES
	(1, 'Pizzas'),
	(2, 'Carnes'),
	(3, 'Sushi'),
	(4, 'Lanches'),
	(5, 'Pães'),
	(6, 'Cafés'),
	(7, 'Massas'),
	(8, 'Hambúrgueres'),
	(9, 'Sobremesas'),
	(10, 'Bebidas');

-- Inserindo dados para a tabela cargos
INSERT INTO `cargos` (`id`, `nome`) VALUES
(1, 'Administrador'),
(2, 'Gerente'),
(3, 'Atendente'),
(4, 'Cozinheiro'),
(5, 'Entregador'),
(6, 'Caixa'),
(7, 'Garçom'),
(8, 'Supervisor'),
(9, 'Auxiliar de Limpeza'),
(10, 'Segurança');

-- Copiando dados para a tabela db_hubmenu.estabelecimentos: ~10 rows (aproximadamente)
INSERT INTO `estabelecimentos` (`id`, `nome`, `cep`, `endereco`, `cnpj`, `imagem`, `cor1`, `cor2`, `cor3`, `tipo`, `media_avaliacao`) VALUES
	(1, 'Pizzaria Saborosa', '89200-000', 'Rua das Flores, 123', '12.345.678/0001-00', '/Views/Assets/Images/Estabelecimentos/LaBellaItalia.jpg', '#FF5733', '#33FF57', '#3357FF', 'Pizzaria', 4.50),
	(2, 'Churrascaria Boi na Brasa', '89200-001', 'Avenida Central, 456', '23.456.789/0001-11', '/Views/Assets/Images/Estabelecimentos/BoiNaBrasa.png', '#FF5733', '#33FF57', '#3357FF', 'Churrascaria', 4.70),
	(3, 'Sushi Bananas', '89200-002', 'Rua Japão, 789', '34.567.890/0001-22', '/Views/Assets/Images/Estabelecimentos/SushiPlace.png', '#FF5733', '#33FF57', '#3357FF', 'Restaurante Japonês', 4.80),
	(4, 'Lanchonete Gilson', '89200-003', 'Rua das Laranjeiras, 321', '45.678.901/0001-33', '/Views/Assets/Images/Estabelecimentos/gilson.jpg', '#FF5733', '#33FF57', '#3357FF', 'Lanchonete', 4.20),
	(5, 'Padaria Pão Quente', '89200-004', 'Avenida das Rosas, 654', '56.789.012/0001-44', '/Views/Assets/Images/Estabelecimentos/padariaPaoQuente.png', '#FF5733', '#33FF57', '#3357FF', 'Padaria', 4.60),
	(6, 'Pará Lanches', '89200-005', 'Rua do Café, 987', '67.890.123/0001-55', '/Views/Assets/Images/Estabelecimentos/paralanches.jpg', '#FF5733', '#33FF57', '#3357FF', 'Lanchonete', 5.00),
	(7, 'Restaurante Italiano Bella', '89200-006', 'Rua Itália, 159', '78.901.234/0001-66', '/Views/Assets/Images/Estabelecimentos/LaBellaItalia.jpg', '#FF5733', '#33FF57', '#3357FF', 'Restaurante Italiano', 4.90),
	(8, 'Hamburgueria Top Burger', '89200-007', 'Avenida dos Burgers, 753', '89.012.345/0001-77', 'hamburgueria.jpg', '#FF5733', '#33FF57', '#3357FF', 'Hamburgueria', 4.40),
	(9, 'Sorveteria Gelato', '89200-008', 'Rua do Sorvete, 852', '90.123.456/0001-88', 'sorveteria.jpg', '#FF5733', '#33FF57', '#3357FF', 'Sorveteria', 4.10),
	(10, 'Bar do Zé', '89200-009', 'Rua da Alegria, 963', '01.234.567/0001-99', 'bar.jpg', '#FF5733', '#33FF57', '#3357FF', 'Bar', 4.00);

-- Copiando dados para a tabela db_hubmenu.estabelecimentos_usuarios: ~10 rows (aproximadamente)
INSERT INTO `estabelecimentos_usuarios` (`id`, `usuario_id`, `cargo_id`, `estabelecimento_id`) VALUES
	(1, 1, 1, 1),
	(2, 2, 2, 2),
	(3, 3, 3, 3),
	(4, 4, 4, 4),
	(5, 5, 5, 5),
	(6, 6, 6, 6),
	(7, 7, 7, 7),
	(8, 8, 8, 8),
	(9, 9, 9, 9),
	(10, 10, 10, 10);

-- Copiando dados para a tabela db_hubmenu.pedidos: ~10 rows (aproximadamente)
INSERT INTO `pedidos` (`id`, `usuario_id`, `estabelecimento_id`, `observacao`, `avaliacao`, `valor_total`, `data_pedido`) VALUES
	(1, 1, 1, 'Sem cebola', 5, 29.90, '2025-05-14 15:41:03'),
	(2, 2, 2, 'Ponto da carne: mal passada', 4, 59.90, '2025-05-14 15:41:03'),
	(3, 3, 3, 'Sem wasabi', 5, 39.90, '2025-05-14 15:41:03'),
	(4, 4, 4, 'Adicionar maionese', 4, 19.90, '2025-05-14 15:41:03'),
	(5, 5, 5, 'Pão bem assado', 5, 4.50, '2025-05-14 15:41:03'),
	(6, 6, 6, 'Café sem açúcar', 4, 4.50, '2025-05-14 15:41:03'),
	(7, 7, 7, 'Sem queijo', 3, 24.90, '2025-05-14 15:41:03'),
	(8, 8, 8, 'Adicionar picles', 5, 25.90, '2025-05-14 15:41:03'),
	(9, 9, 9, 'Sorvete com calda de chocolate', 5, 9.90, '2025-05-14 15:41:03'),
	(10, 10, 10, 'Cerveja bem gelada', 4, 12.90, '2025-05-14 15:41:03');

-- Copiando dados para a tabela db_hubmenu.produtos: ~11 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `nome`, `descricao`, `valor`, `imagem`, `estabelecimento_id`, `categoria_id`) VALUES
	(1, 'Pizza Margherita', 'Molho de tomate, mussarela e manjericão', 29.90, '/Views/Assets/Images/Produtos/6830ce694ee14.webp', 1, 1),
	(2, 'Picanha na Brasa', 'Picanha grelhada com acompanhamentos', 59.90, 'picanha.jpg', 2, 2),
	(3, 'Sushi Combo', '10 unidades de sushi variados', 39.90, 'sushi_combo.jpg', 3, 3),
	(4, 'X-Burguer', 'Hambúrguer com queijo, alface e tomate', 19.90, 'xburguer.jpg', 4, 4),
	(5, 'Pão Francês', 'Pão crocante e fresquinho', 0.90, 'pao_frances.jpg', 5, 5),
	(6, 'Pizza Mortadelao', 'Pizza preparada especialmente com mortadela!', 30.00, '/Views/Assets/Images/Produtos/6830c72d6864e.webp', 6, 1),
	(7, 'Lasanha à Bolonhesa', 'Lasanha com molho bolonhesa e queijo', 24.90, 'lasanha.jpg', 7, 7),
	(8, 'Hambúrguer Duplo', 'Dois hambúrgueres com queijo e bacon', 25.90, 'hamburguer_duplo.jpg', 8, 8),
	(9, 'Sorvete de Chocolate', 'Sorvete cremoso de chocolate', 9.90, 'sorvete_chocolate.jpg', 9, 9),
	(10, 'Cerveja Artesanal', 'Cerveja local artesanal', 12.90, 'cerveja_artesanal.jpg', 10, 10),
	(11, 'Pizza de Frango Catupiry', 'Catupiry com Frango', 39.90, '/Views/Assets/Images/Produtos/6830ce927a174.webp', 1, 1),
	(13, 'Rato Empanado', 'Delicioso rato empanado, receita original da casa.', 25.00, '/Views/Assets/Images/Produtos/6830c89dad57d.png', 6, 4),
	(14, 'Pizza Feijoada', 'Pizza Feijoada, boa pra quando a fome bater forte.', 30.00, '/Views/Assets/Images/Produtos/6830c94fdd3b2.png', 6, 1),
	(15, 'Peixe (Bem passado)', 'Delicioso e suculento', 20.50, '/Views/Assets/Images/Produtos/6830ca1285b15.png', 6, 4),
	(16, 'La Moda Del Chief', 'La pizza hermosa del Pará Lanches!', 80.00, '/Views/Assets/Images/Produtos/6830ca061a595.webp', 6, 1),
	(17, 'Cuzcuz Paulista', 'esse e rui', 15.00, '/Views/Assets/Images/Produtos/6830ca7596755.png', 6, 1),
	(18, 'Pizza de Chocolate', 'Pizza de chocolate bem molhadinha', 30.00, '/Views/Assets/Images/Produtos/6830cac75a3d4.png', 6, 1),
	(19, 'Pizza Vegetariana', 'Pizza vegetariana caprichada!', 45.00, '/Views/Assets/Images/Produtos/6830caca5e37a.webp', 6, 1),
	(20, 'Cuzcuz c/ Ovo', 'essa e bom', 12.00, '/Views/Assets/Images/Produtos/6830cb1e44ddc.png', 6, 1),
	(21, 'Pizza de 4 Queijos - Família', 'Pizza de 4 queijos tamanho família caprichada com 16 fatias.', 80.00, '/Views/Assets/Images/Produtos/6830cc552e633.jpg', 1, 1),
	(22, 'Filho do Yohan', 'HUMMMMMMM', 555.00, '/Views/Assets/Images/Produtos/6830cd0631107.png', 6, 2);

-- Copiando dados para a tabela db_hubmenu.usuarios: ~10 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `cep`, `endereco`, `telefone`) VALUES
	(1, 'João Silva', 'joao@example.com', 'senha123', '89200-010', 'Rua A, 100', '(47) 99999-0001'),
	(2, 'Maria Oliveira', 'maria@example.com', 'senha123', '89200-011', 'Rua B, 200', '(47) 99999-0002'),
	(3, 'Pedro Santos', 'pedro@example.com', 'senha123', '89200-012', 'Rua C, 300', '(47) 99999-0003'),
	(4, 'Ana Souza', 'ana@example.com', 'senha123', '89200-013', 'Rua D, 400', '(47) 99999-0004'),
	(5, 'Lucas Lima', 'lucas@example.com', 'senha123', '89200-014', 'Rua E, 500', '(47) 99999-0005'),
	(6, 'Carla Pereira', 'carla@example.com', 'senha123', '89200-015', 'Rua F, 600', '(47) 99999-0006'),
	(7, 'Marcos Almeida', 'marcos@example.com', 'senha123', '89200-016', 'Rua G, 700', '(47) 99999-0007'),
	(8, 'Fernanda Costa', 'fernanda@example.com', 'senha123', '89200-017', 'Rua H, 800', '(47) 99999-0008'),
	(9, 'Rafael Rodrigues', 'rafael@example.com', 'senha123', '89200-018', 'Rua I, 900', '(47) 99999-0009'),
	(10, 'Juliana Martins', 'juliana@example.com', 'senha123', '89200-019', 'Rua J, 1000', '(47) 99999-0010');

-- Copiando dados para a tabela db_hubmenu.vendas: ~10 rows (aproximadamente)
INSERT INTO `vendas` (`id`, `referencia`, `transacao_id`, `status_pagamento`, `estabelecimento_id`, `valor_total`, `data_venda`) VALUES
	(1, 'VEND001', 'TXN001', 'Pendente', 1, 150.00, '2025-05-14 15:41:03'),
	(2, 'VEND002', 'TXN002', 'Aprovado', 2, 230.50, '2025-05-14 15:41:03'),
	(3, 'VEND003', 'TXN003', 'Pendente', 3, 120.75, '2025-05-14 15:41:03'),
	(4, 'VEND004', 'TXN004', 'Aprovado', 1, 400.00, '2025-05-14 15:41:03'),
	(5, 'VEND005', 'TXN005', 'Cancelado', 2, 50.00, '2025-05-14 15:41:03'),
	(6, 'VEND006', 'TXN006', 'Aprovado', 3, 180.30, '2025-05-14 15:41:03'),
	(7, 'VEND007', 'TXN007', 'Pendente', 1, 275.40, '2025-05-14 15:41:03'),
	(8, 'VEND008', 'TXN008', 'Aprovado', 2, 325.80, '2025-05-14 15:41:03'),
	(9, 'VEND009', 'TXN009', 'Cancelado', 3, 95.00, '2025-05-14 15:41:03'),
	(10, 'VEND010', 'TXN010', 'Aprovado', 1, 150.20, '2025-05-14 15:41:03');
