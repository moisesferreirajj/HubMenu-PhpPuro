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
	(1, 'Pizzaria Saborosa', '89200-000', 'Rua das Flores, 123', '12.345.678/0001-00', 'pizzaria.jpg', '#FF5733', '#33FF57', '#3357FF', 'Pizzaria', 4.50),
	(2, 'Churrascaria Boi na Brasa', '89200-001', 'Avenida Central, 456', '23.456.789/0001-11', 'churrascaria.jpg', '#FF5733', '#33FF57', '#3357FF', 'Churrascaria', 4.70),
	(3, 'Sushi Place', '89200-002', 'Rua Japão, 789', '34.567.890/0001-22', 'sushi.jpg', '#FF5733', '#33FF57', '#3357FF', 'Restaurante Japonês', 4.80),
	(4, 'Lanchonete Rápida', '89200-003', 'Rua das Laranjeiras, 321', '45.678.901/0001-33', 'lanchonete.jpg', '#FF5733', '#33FF57', '#3357FF', 'Lanchonete', 4.20),
	(5, 'Padaria Pão Quente', '89200-004', 'Avenida das Rosas, 654', '56.789.012/0001-44', 'padaria.jpg', '#FF5733', '#33FF57', '#3357FF', 'Padaria', 4.60),
	(6, 'Café com Leite', '89200-005', 'Rua do Café, 987', '67.890.123/0001-55', 'cafe.jpg', '#FF5733', '#33FF57', '#3357FF', 'Cafeteria', 4.30),
	(7, 'Restaurante Italiano Bella', '89200-006', 'Rua Itália, 159', '78.901.234/0001-66', 'restaurante_italiano.jpg', '#FF5733', '#33FF57', '#3357FF', 'Restaurante Italiano', 4.90),
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.produtos: ~10 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `nome`, `descricao`, `valor`, `imagem`, `estabelecimento_id`, `categoria_id`) VALUES
	(1, 'Pizza Margherita', 'Molho de tomate, mussarela e manjericão', 29.90, 'margherita.jpg', 1, 1),
	(2, 'Picanha na Brasa', 'Picanha grelhada com acompanhamentos', 59.90, 'picanha.jpg', 2, 2),
	(3, 'Sushi Combo', '10 unidades de sushi variados', 39.90, 'sushi_combo.jpg', 3, 3),
	(4, 'X-Burguer', 'Hambúrguer com queijo, alface e tomate', 19.90, 'xburguer.jpg', 4, 4),
	(5, 'Pão Francês', 'Pão crocante e fresquinho', 0.90, 'pao_frances.jpg', 5, 5),
	(6, 'Café Expresso', 'Café forte e encorpado', 4.50, 'cafe_expresso.jpg', 6, 6),
	(7, 'Lasanha à Bolonhesa', 'Lasanha com molho bolonhesa e queijo', 24.90, 'lasanha.jpg', 7, 7),
	(8, 'Hambúrguer Duplo', 'Dois hambúrgueres com queijo e bacon', 25.90, 'hamburguer_duplo.jpg', 8, 8),
	(9, 'Sorvete de Chocolate', 'Sorvete cremoso de chocolate', 9.90, 'sorvete_chocolate.jpg', 9, 9),
	(10, 'Cerveja Artesanal', 'Cerveja local artesanal', 12.90, 'cerveja_artesanal.jpg', 10, 10),
	(11, 'Yohan', 'Cabeça do Yohan', 1000.00, '/Views/Assets/Images/Produtos/68277309036ea.png', 1, 1);

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

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
