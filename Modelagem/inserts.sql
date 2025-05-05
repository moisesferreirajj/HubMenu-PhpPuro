-- CARGOS
INSERT INTO cargos (nome) VALUES
('Atendente'), ('Gerente'), ('Entregador'), ('Cozinheiro'),
('Caixa'), ('Supervisor'), ('Analista'), ('Auxiliar'),
('Recepcionista'), ('Motoboy'), ('Desenvolvedor'), ('Zelador'),
('Aux. Limpeza'), ('Estoquista'), ('Administrativo'), ('TI'),
('RH'), ('Compras'), ('Segurança'), ('Financeiro');

-- ESTABELECIMENTOS
INSERT INTO estabelecimentos (nome, senha, cep, endereco, cnpj, tipo, media_avaliacao) VALUES
('Pizza Max', '123456', '12345-000', 'Rua das Flores, 100', '12345678000101', 'Pizzaria', '5'),
('Burger Point', 'abc123', '54321-000', 'Av. Brasil, 200', '23456789000102', 'Lanchonete', '5'),
('Doces da Vó', 'doces321', '00000-000', 'Rua Açúcar, 123', '34567890000103', 'Doceria', '5'),
('Natural Fit', 'fit456', '13579-000', 'Rua Verde, 456', '45678901000104', 'Restaurante', '5'),
('Churras House', 'churras789', '24680-000', 'Rua Brasa, 789', '56789012000105', 'Churrascaria', '5'),
('Sushi Leste', 'sushi999', '11223-000', 'Av. Japão, 88', '67890123000106', 'Sushi Bar', '5'),
('Pastel Bom', 'pastel22', '22334-000', 'Rua Feira, 21', '78901234000107', 'Pastelaria', '5'),
('Mega Burguer', 'mega123', '33445-000', 'Av. Fast, 10', '89012345000108', 'Lanchonete', '5'),
('Açaí Mix', 'acai2023', '44556-000', 'Rua Roxa, 22', '90123456000109', 'Açaiteria', '5'),
('Veggie Life', 'veggie789', '55667-000', 'Rua Vegan, 11', '01234567000110', 'Vegano', '5'),
('Espetinho Show', 'show456', '66778-000', 'Rua Churras, 33', '11234568000111', 'Espetinho', '5'),
('Café Urbano', 'cafe555', '77889-000', 'Av. Centro, 999', '12234569000112', 'Cafeteria', '5'),
('Panela Quente', 'panela2022', '88990-000', 'Rua Fogo, 202', '13234560000113', 'Restaurante', '5'),
('Lanche da Tarde', 'lanche22', '99001-000', 'Rua Lanche, 45', '14234561000114', 'Lanchonete', '5'),
('Sabor Goiano', 'goianao', '11112-000', 'Rua Goiás, 76', '15234562000115', 'Restaurante', '5'),
('Tempero Caseiro', 'caseiro33', '22223-000', 'Rua Família, 98', '16234563000116', 'Comida Caseira', '5'),
('Pão de Ouro', 'pao123', '33334-000', 'Rua Padaria, 12', '17234564000117', 'Padaria', '5'),
('Delícia Gelada', 'gelado', '44445-000', 'Rua Sorvete, 50', '18234565000118', 'Sorveteria', '5'),
('Bolo de Festa', 'bolo555', '55556-000', 'Rua Festa, 77', '19234566000119', 'Confeitaria', '5'),
('Tapioca Mania', 'tapioca', '66667-000', 'Rua Nordestina, 13', '20234567000120', 'Tapiocaria', '5');

-- USUÁRIOS
INSERT INTO usuarios (nome, senha, email, cep, endereco, telefone) VALUES
('João Silva', '123', 'joao@gmail.com', '12345-678', 'Rua A, 1', '11999999991'),
('Maria Oliveira', '456', 'maria@gmail.com', '23456-789', 'Rua B, 2', '11999999992'),
('Carlos Souza', '789', 'carlos@gmail.com', '34567-890', 'Rua C, 3', '11999999993'),
('Ana Lima', 'abc', 'ana@gmail.com', '45678-901', 'Rua D, 4', '11999999994'),
('Pedro Rocha', 'def', 'pedro@gmail.com', '56789-012', 'Rua E, 5', '11999999995'),
('Juliana Reis', 'ghi', 'juliana@gmail.com', '67890-123', 'Rua F, 6', '11999999996'),
('Lucas Martins', 'jkl', 'lucas@gmail.com', '78901-234', 'Rua G, 7', '11999999997'),
('Fernanda Melo', 'mno', 'fernanda@gmail.com', '89012-345', 'Rua H, 8', '11999999998'),
('Rafael Dias', 'pqr', 'rafael@gmail.com', '90123-456', 'Rua I, 9', '11999999999'),
('Bianca Faria', 'stu', 'bianca@gmail.com', '01234-567', 'Rua J, 10', '11999999990'),
('Gustavo Cunha', 'vwx', 'gustavo@gmail.com', '11111-111', 'Rua K, 11', '11888888881'),
('Lara Torres', 'yz1', 'lara@gmail.com', '22222-222', 'Rua L, 12', '11888888882'),
('Marcelo Braga', '234', 'marcelo@gmail.com', '33333-333', 'Rua M, 13', '11888888883'),
('Aline Nunes', '567', 'aline@gmail.com', '44444-444', 'Rua N, 14', '11888888884'),
('Rodrigo Maia', '890', 'rodrigo@gmail.com', '55555-555', 'Rua O, 15', '11888888885'),
('Camila Fontes', 'abc', 'camila@gmail.com', '66666-666', 'Rua P, 16', '11888888886'),
('Thiago Neves', 'def', 'thiago@gmail.com', '77777-777', 'Rua Q, 17', '11888888887'),
('Helena Silva', 'ghi', 'helena@gmail.com', '88888-888', 'Rua R, 18', '11888888888'),
('Murilo Campos', 'jkl', 'murilo@gmail.com', '99999-999', 'Rua S, 19', '11888888889'),
('Isabela Pinto', 'mno', 'isabela@gmail.com', '00000-000', 'Rua T, 20', '11888888880');

-- PRODUTOS (ligados a estabelecimentos variados)
INSERT INTO produtos (nome, descricao, valor, id_estabelecimento) VALUES
('Pizza Calabresa', 'Pizza com calabresa e cebola', 35.90, 1),
('Hamburguer Duplo', 'Hamburguer com queijo e bacon', 29.90, 2),
('Brigadeiro Gourmet', 'Doce tradicional', 5.00, 3),
('Salada Fit', 'Salada com frango e mix de folhas', 22.50, 4),
('Picanha', 'Carne grelhada com acompanhamentos', 49.90, 5),
('Temaki', 'Temaki de salmão com cream cheese', 19.90, 6),
('Pastel de Queijo', 'Pastel frito com queijo', 7.00, 7),
('Mega X-Burger', 'X-burger grande com batata', 32.90, 8),
('Açaí 500ml', 'Açaí com granola e banana', 15.00, 9),
('Prato Vegano', 'Mix de legumes grelhados', 24.90, 10),
-- (mais 10 para completar 20)
('Espetinho de Frango', 'Frango grelhado no espeto', 8.00, 11),
('Café Expresso', 'Café preto curto', 4.50, 12),
('Feijoada', 'Tradicional feijoada brasileira', 34.90, 13),
('Misto Quente', 'Pão com presunto e queijo', 6.00, 14),
('Arroz com Pequi', 'Típico de Goiás', 20.00, 15),
('Bife Acebolado', 'Carne com cebola', 25.00, 16),
('Pão Francês', 'Unidade de pão francês', 0.80, 17),
('Sorvete de Chocolate', 'Sorvete artesanal', 12.00, 18),
('Bolo de Aniversário', 'Bolo recheado com chantilly', 45.00, 19),
('Tapioca de Coco', 'Tapioca doce com coco', 10.00, 20);

-- PEDIDOS (vários produtos por usuário)
INSERT INTO pedidos (id_usuario, observacao, avaliacao, id_produto, valor_total) VALUES
(1, 'Pedido noturno', 5, 1, 35.90),
(1, 'Repetir semanal', 5, 3, 5.00),
(2, 'Sem cebola', 5, 2, 29.90),
(2, 'Para viagem', 5, 4, 22.50),
(3, 'Comida para dois', 5, 5, 49.90),
(3, 'Pedido vegano', 5, 10, 24.90),
(4, 'Pedido rápido', 5, 6, 19.90),
(5, 'Promoção do dia', 5, 8, 32.90),
(5, 'Pedido leve', 5, 9, 15.00),
(6, 'Almoço completo', 5, 13, 34.90),
(7, 'Café da manhã', 5, 12, 4.50),
(8, 'Pedido light', 5, 4, 22.50),
(9, 'Pedido rápido', 5, 14, 6.00),
(10, 'Encomenda', 5, 19, 45.00),
(10, 'Doces extras', 5, 3, 5.00),
(11, 'Pedido de festa', 5, 20, 10.00),
(12, 'Final de semana', 5, 5, 49.90),
(13, 'Refeição rápida', 5, 7, 7.00),
(14, 'Bebida quente', 5, 12, 4.50),
(15, 'Lanche rápido', 5, 2, 29.90);

-- VENDAS
INSERT INTO vendas (reference, payment_id, status, id_estabelecimento, valor_total) VALUES
('REF123', 'PAY123', 'Aprovado', 1, 70.90),
('REF124', 'PAY124', 'Aguardando', 2, 29.90),
('REF125', 'PAY125', 'Cancelado', 3, 10.00),
('REF126', 'PAY126', 'Aprovado', 4, 22.50),
('REF127', 'PAY127', 'Reembolsado', 5, 49.90),
('REF128', 'PAY128', 'Aprovado', 6, 19.90),
('REF129', 'PAY129', 'Aguardando', 7, 14.00),
('REF130', 'PAY130', 'Aprovado', 8, 32.90),
('REF131', 'PAY131', 'Aprovado', 9, 15.00),
('REF132', 'PAY132', 'Cancelado', 10, 24.90),
('REF133', 'PAY133', 'Aprovado', 11, 8.00),
('REF134', 'PAY134', 'Reembolsado', 12, 4.50),
('REF135', 'PAY135', 'Aprovado', 13, 34.90),
('REF136', 'PAY136', 'Aprovado', 14, 6.00),
('REF137', 'PAY137', 'Aprovado', 15, 20.00),
('REF138', 'PAY138', 'Aguardando', 16, 25.00),
('REF139', 'PAY139', 'Cancelado', 17, 0.80),
('REF140', 'PAY140', 'Aprovado', 18, 12.00),
('REF141', 'PAY141', 'Reembolsado', 19, 45.00),
('REF142', 'PAY142', 'Aprovado', 20, 10.00);