INSERT INTO cargos (nome) VALUES
('Administrador'),
('Gerente'),
('Atendente'),
('Cozinheiro'),
('Entregador'),
('Caixa'),
('Garçom'),
('Supervisor'),
('Auxiliar de Limpeza'),
('Segurança');

INSERT INTO estabelecimentos (nome, cep, endereco, cnpj, imagem, cor1, cor2, cor3, tipo, media_avaliacao) VALUES
('Pizzaria Saborosa', '89200-000', 'Rua das Flores, 123', '12.345.678/0001-00', 'pizzaria.jpg', '#FF5733', '#33FF57', '#3357FF', 'Pizzaria', 4.5),
('Churrascaria Boi na Brasa', '89200-001', 'Avenida Central, 456', '23.456.789/0001-11', 'churrascaria.jpg', '#FF5733', '#33FF57', '#3357FF', 'Churrascaria', 4.7),
('Sushi Place', '89200-002', 'Rua Japão, 789', '34.567.890/0001-22', 'sushi.jpg', '#FF5733', '#33FF57', '#3357FF', 'Restaurante Japonês', 4.8),
('Lanchonete Rápida', '89200-003', 'Rua das Laranjeiras, 321', '45.678.901/0001-33', 'lanchonete.jpg', '#FF5733', '#33FF57', '#3357FF', 'Lanchonete', 4.2),
('Padaria Pão Quente', '89200-004', 'Avenida das Rosas, 654', '56.789.012/0001-44', 'padaria.jpg', '#FF5733', '#33FF57', '#3357FF', 'Padaria', 4.6),
('Café com Leite', '89200-005', 'Rua do Café, 987', '67.890.123/0001-55', 'cafe.jpg', '#FF5733', '#33FF57', '#3357FF', 'Cafeteria', 4.3),
('Restaurante Italiano Bella', '89200-006', 'Rua Itália, 159', '78.901.234/0001-66', 'restaurante_italiano.jpg', '#FF5733', '#33FF57', '#3357FF', 'Restaurante Italiano', 4.9),
('Hamburgueria Top Burger', '89200-007', 'Avenida dos Burgers, 753', '89.012.345/0001-77', 'hamburgueria.jpg', '#FF5733', '#33FF57', '#3357FF', 'Hamburgueria', 4.4),
('Sorveteria Gelato', '89200-008', 'Rua do Sorvete, 852', '90.123.456/0001-88', 'sorveteria.jpg', '#FF5733', '#33FF57', '#3357FF', 'Sorveteria', 4.1),
('Bar do Zé', '89200-009', 'Rua da Alegria, 963', '01.234.567/0001-99', 'bar.jpg', '#FF5733', '#33FF57', '#3357FF', 'Bar', 4.0);

INSERT INTO usuarios (nome, email, senha, cep, endereco, telefone) VALUES
('João Silva', 'joao@example.com', 'senha123', '89200-010', 'Rua A, 100', '(47) 99999-0001'),
('Maria Oliveira', 'maria@example.com', 'senha123', '89200-011', 'Rua B, 200', '(47) 99999-0002'),
('Pedro Santos', 'pedro@example.com', 'senha123', '89200-012', 'Rua C, 300', '(47) 99999-0003'),
('Ana Souza', 'ana@example.com', 'senha123', '89200-013', 'Rua D, 400', '(47) 99999-0004'),
('Lucas Lima', 'lucas@example.com', 'senha123', '89200-014', 'Rua E, 500', '(47) 99999-0005'),
('Carla Pereira', 'carla@example.com', 'senha123', '89200-015', 'Rua F, 600', '(47) 99999-0006'),
('Marcos Almeida', 'marcos@example.com', 'senha123', '89200-016', 'Rua G, 700', '(47) 99999-0007'),
('Fernanda Costa', 'fernanda@example.com', 'senha123', '89200-017', 'Rua H, 800', '(47) 99999-0008'),
('Rafael Rodrigues', 'rafael@example.com', 'senha123', '89200-018', 'Rua I, 900', '(47) 99999-0009'),
('Juliana Martins', 'juliana@example.com', 'senha123', '89200-019', 'Rua J, 1000', '(47) 99999-0010');

INSERT INTO estabelecimentos_usuarios (usuario_id, cargo_id, estabelecimento_id) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10);

INSERT INTO categorias (nome) VALUES
('Pizzas'),
('Carnes'),
('Sushi'),
('Lanches'),
('Pães'),
('Cafés'),
('Massas'),
('Hambúrgueres'),
('Sobremesas'),
('Bebidas');

INSERT INTO produtos (nome, descricao, valor, imagem, estabelecimento_id, categoria_id) VALUES
('Pizza Margherita', 'Molho de tomate, mussarela e manjericão', 29.90, 'margherita.jpg', 1, 1),
('Picanha na Brasa', 'Picanha grelhada com acompanhamentos', 59.90, 'picanha.jpg', 2, 2),
('Sushi Combo', '10 unidades de sushi variados', 39.90, 'sushi_combo.jpg', 3, 3),
('X-Burguer', 'Hambúrguer com queijo, alface e tomate', 19.90, 'xburguer.jpg', 4, 4),
('Pão Francês', 'Pão crocante e fresquinho', 0.90, 'pao_frances.jpg', 5, 5),
('Café Expresso', 'Café forte e encorpado', 4.50, 'cafe_expresso.jpg', 6, 6),
('Lasanha à Bolonhesa', 'Lasanha com molho bolonhesa e queijo', 24.90, 'lasanha.jpg', 7, 7),
('Hambúrguer Duplo', 'Dois hambúrgueres com queijo e bacon', 25.90, 'hamburguer_duplo.jpg', 8, 8),
('Sorvete de Chocolate', 'Sorvete cremoso de chocolate', 9.90, 'sorvete_chocolate.jpg', 9, 9),
('Cerveja Artesanal', 'Cerveja local artesanal', 12.90, 'cerveja_artesanal.jpg', 10, 10);

INSERT INTO pedidos (usuario_id, estabelecimento_id, observacao, avaliacao, valor_total, data_pedido) VALUES
(1, 1, 'Sem cebola', 5, 29.90, NOW()),
(2, 2, 'Ponto da carne: mal passada', 4, 59.90, NOW()),
(3, 3, 'Sem wasabi', 5, 39.90, NOW()),
(4, 4, 'Adicionar maionese', 4, 19.90, NOW()),
(5, 5, 'Pão bem assado', 5, 4.50, NOW()),
(6, 6, 'Café sem açúcar', 4, 4.50, NOW()),
(7, 7, 'Sem queijo', 3, 24.90, NOW()),
(8, 8, 'Adicionar picles', 5, 25.90, NOW()),
(9, 9, 'Sorvete com calda de chocolate', 5, 9.90, NOW()),
(10, 10, 'Cerveja bem gelada', 4, 12.90, NOW());

INSERT INTO vendas (referencia, transacao_id, status_pagamento, estabelecimento_id, valor_total) 
VALUES 
('VEND001', 'TXN001', 'Pendente', 1, 150.00),
('VEND002', 'TXN002', 'Aprovado', 2, 230.50),
('VEND003', 'TXN003', 'Pendente', 3, 120.75),
('VEND004', 'TXN004', 'Aprovado', 1, 400.00),
('VEND005', 'TXN005', 'Cancelado', 2, 50.00),
('VEND006', 'TXN006', 'Aprovado', 3, 180.30),
('VEND007', 'TXN007', 'Pendente', 1, 275.40),
('VEND008', 'TXN008', 'Aprovado', 2, 325.80),
('VEND009', 'TXN009', 'Cancelado', 3, 95.00),
('VEND010', 'TXN010', 'Aprovado', 1, 150.20);