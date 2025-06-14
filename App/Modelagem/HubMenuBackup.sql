-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para db_hubmenu
CREATE DATABASE IF NOT EXISTS `db_hubmenu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_hubmenu`;

-- Copiando estrutura para tabela db_hubmenu.avaliacoes
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `avaliacao` int(1) NOT NULL,
  `comentario` text DEFAULT NULL,
  `data_avaliacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  CONSTRAINT `avaliacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avaliacoes_ibfk_2` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.avaliacoes: ~10 rows (aproximadamente)
INSERT INTO `avaliacoes` (`id`, `usuario_id`, `estabelecimento_id`, `avaliacao`, `comentario`, `data_avaliacao`) VALUES
	(1, 1, 1, 5, 'Excelente atendimento e comida!', '2025-05-23 16:49:29'),
	(2, 2, 2, 4, 'Muito bom, mas poderia ser mais rápido.', '2025-05-23 16:49:29'),
	(3, 3, 3, 5, 'Sabor incrível!', '2025-05-23 16:49:29'),
	(4, 4, 4, 3, 'Ok, mas esperava mais.', '2025-05-23 16:49:29'),
	(5, 5, 5, 4, 'Boa padaria, voltarei com certeza.', '2025-05-23 16:49:29'),
	(6, 6, 6, 5, 'Melhor lanche da cidade!', '2025-05-23 16:49:29'),
	(7, 7, 7, 5, 'Comida deliciosa e ambiente agradável.', '2025-05-23 16:49:29'),
	(8, 8, 8, 4, 'Bom hambúrguer, mas atendimento demorado.', '2025-05-23 16:49:29'),
	(9, 9, 9, 5, 'Sorvete maravilhoso!', '2025-05-23 16:49:29'),
	(10, 10, 10, 3, 'Ambiente legal, mas atendimento deixou a desejar.', '2025-05-23 16:49:29');

-- Copiando estrutura para tabela db_hubmenu.avaliacoes_sistema
CREATE TABLE IF NOT EXISTS `avaliacoes_sistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `avaliacao` int(1) NOT NULL,
  `comentario` text DEFAULT NULL,
  `data_avaliacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `avaliacoes_sistema_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.avaliacoes_sistema: ~10 rows (aproximadamente)
INSERT INTO `avaliacoes_sistema` (`id`, `usuario_id`, `avaliacao`, `comentario`, `data_avaliacao`) VALUES
	(1, 1, 5, 'Sistema muito intuitivo e rápido, facilitou o controle dos pedidos.', '2025-05-23 16:56:43'),
	(2, 2, 4, 'Gostei da interface, mas poderia ter mais opções de filtros nas vendas.', '2025-05-23 16:56:43'),
	(3, 3, 5, 'Excelente! Melhorou muito a organização do meu estabelecimento.', '2025-05-23 16:56:43'),
	(4, 4, 3, 'Funciona bem, mas encontrei lentidão ao gerar relatórios.', '2025-05-23 16:56:43'),
	(5, 5, 4, 'Sistema prático, mas a tela de cadastro poderia ser mais simples.', '2025-05-23 16:56:43'),
	(6, 6, 5, 'Tudo funcionando perfeitamente. Recomendo!', '2025-05-23 16:56:43'),
	(7, 7, 5, 'Atendeu todas as necessidades do meu negócio. Parabéns à equipe.', '2025-05-23 16:56:43'),
	(8, 8, 4, 'Fácil de usar, só senti falta de um tutorial inicial.', '2025-05-23 16:56:43'),
	(9, 9, 5, 'Fluxo de pedidos ficou muito mais eficiente com o Hub Menu.', '2025-05-23 16:56:43'),
	(10, 10, 3, 'Alguns bugs ao salvar produtos, mas no geral é bom.', '2025-05-23 16:56:43');

-- Copiando estrutura para tabela db_hubmenu.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.cargos: ~10 rows (aproximadamente)
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

-- Copiando estrutura para tabela db_hubmenu.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- Copiando estrutura para tabela db_hubmenu.estabelecimentos
CREATE TABLE IF NOT EXISTS `estabelecimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `cor1` varchar(20) DEFAULT NULL,
  `cor2` varchar(20) DEFAULT NULL,
  `cor3` varchar(20) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `media_avaliacao` decimal(3,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- Copiando estrutura para tabela db_hubmenu.estabelecimentos_usuarios
CREATE TABLE IF NOT EXISTS `estabelecimentos_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `cargo_id` (`cargo_id`),
  CONSTRAINT `estabelecimentos_usuarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `estabelecimentos_usuarios_ibfk_2` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`),
  CONSTRAINT `estabelecimentos_usuarios_ibfk_3` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- Copiando estrutura para tabela db_hubmenu.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `observacao` text DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_pedido` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- Copiando estrutura para tabela db_hubmenu.pedidos_produtos
CREATE TABLE IF NOT EXISTS `pedidos_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `preco_unitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `pedidos_produtos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `pedidos_produtos_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.pedidos_produtos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela db_hubmenu.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`),
  CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.produtos: ~19 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `nome`, `descricao`, `valor`, `imagem`, `estabelecimento_id`, `categoria_id`) VALUES
	(1, 'Pizza Margherita', 'Molho de tomate, mussarela e manjericão', 29.90, '/Views/Assets/Images/Produtos/6830ce694ee14.webp', 1, 1),
	(2, 'Picanha na Brasa', 'Picanha grelhada com acompanhamentos', 59.90, 'picanha.jpg', 2, 2),
	(3, 'Sushi Combo', '10 unidades de sushi variados', 39.90, 'sushi_combo.jpg', 3, 3),
	(4, 'X-Burguer', 'Hambúrguer com queijo, alface e tomate', 19.90, 'xburguer.jpg', 4, 4),
	(5, 'Pão Francês', 'Pão crocante e fresquinho', 0.90, 'pao_frances.jpg', 5, 5),
	(6, 'Pizza Mortadelao', 'Pizza preparada especialmente com mortadela!', 30.00, '/Views/Assets/Images/Produtos/6830c72d6864e.webp', 6, 1),
	(7, 'Lasanha à Bolonhesa', 'Lasanha com molho bolonhesa e queijo', 24.90, '/Views/Assets/Images/Produtos/6834b6d92194f.png', 7, 7),
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
	(22, 'Filho do Yohan', 'como ele fez essa coisa?????', 555.00, '/Views/Assets/Images/Produtos/6830cd0631107.png', 6, 2);

-- Copiando estrutura para tabela db_hubmenu.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- Copiando estrutura para tabela db_hubmenu.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(100) DEFAULT NULL,
  `transacao_id` varchar(100) DEFAULT NULL,
  `status_pagamento` varchar(50) DEFAULT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_venda` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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


-- Adicioando campo status na tabela db_hubmenu.produtos
ALTER TABLE produtos
ADD `status_produtos` boolean AFTER `imagem`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
