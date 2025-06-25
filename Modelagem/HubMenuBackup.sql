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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
	(10, 10, 10, 3, 'Ambiente legal, mas atendimento deixou a desejar.', '2025-05-23 16:49:29'),
	(12, 7, 1, 4, 'Muuuuito bom, ambiente acolhedor!', '2025-06-25 14:30:11');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `banner` varchar(255) DEFAULT NULL,
  `cor1` varchar(20) DEFAULT NULL,
  `cor2` varchar(20) DEFAULT NULL,
  `cor3` varchar(20) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `media_avaliacao` decimal(3,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.estabelecimentos: ~10 rows (aproximadamente)
INSERT INTO `estabelecimentos` (`id`, `nome`, `cep`, `endereco`, `cnpj`, `imagem`, `banner`, `cor1`, `cor2`, `cor3`, `tipo`, `media_avaliacao`) VALUES
	(1, 'Pizzaria Saborosa', '89200-000', 'Rua das Flores, 123', '12.345.678/0001-00', '/Views/Assets/Images/Estabelecimentos/685b03dd3e30e.jpg', '/Views/Assets/Images/Estabelecimentos/685afa0a1615a.png', '#28a745', '#20c997', '#17a2b8', 'Pizzaria', 5.00),
	(2, 'Mago lanches', '01234-567', 'Rua das Flores, 123, Centro, São Paulo - SP', '12.345.678/0001-90', '/Views/Assets/Images/Estabelecimentos/685b05dbd2495.png', '/Views/Assets/Images/Estabelecimentos/685b05dbd2731.png', '#000000', '#000000', '#17a2b8', 'Lanchonete e barbearia', NULL),
	(3, 'Sushi Bananas', '89200-002', 'Rua Japão, 789', '34.567.890/0001-22', '/Views/Assets/Images/Estabelecimentos/SushiPlace.png', NULL, '#FF5733', '#33FF57', '#3357FF', 'Restaurante Japonês', 4.80),
	(4, 'Lanchonete Gilson', '89200-003', 'Rua das Laranjeiras, 321', '45.678.901/0001-33', '/Views/Assets/Images/Estabelecimentos/gilson.jpg', NULL, '#FF5733', '#33FF57', '#3357FF', 'Lanchonete', 4.20),
	(5, 'Padaria Pão Quente', '89200-004', 'Avenida das Rosas, 654', '56.789.012/0001-44', '/Views/Assets/Images/Estabelecimentos/padariaPaoQuente.png', NULL, '#FF5733', '#33FF57', '#3357FF', 'Padaria', 4.60),
	(6, 'Pará Lanches', '89200-005', 'Rua do Café, 987', '67.890.123/0001-55', '/Views/Assets/Images/Estabelecimentos/paralanches.jpg', NULL, '#FF5733', '#33FF57', '#3357FF', 'Lanchonete', 5.00),
	(7, 'Restaurante Italiano Bella', '89200-006', 'Rua Itália, 159', '78.901.234/0001-66', '/Views/Assets/Images/Estabelecimentos/LaBellaItalia.jpg', NULL, '#FF5733', '#33FF57', '#3357FF', 'Restaurante Italiano', 4.90),
	(8, 'Hamburgueria Top Burger', '89200-007', 'Avenida dos Burgers, 753', '89.012.345/0001-77', '/Views/Assets/Images/Estabelecimentos/LaBellaItalia.jpg', NULL, '#FF5733', '#33FF57', '#3357FF', 'Hamburgueria', 4.40),
	(9, 'Sorveteria Gelato', '89200-008', 'Rua do Sorvete, 852', '90.123.456/0001-88', '/Views/Assets/Images/Estabelecimentos/LaBellaItalia.jpg', NULL, '#FF5733', '#33FF57', '#3357FF', 'Sorveteria', 4.10),
	(10, 'Bar do Zé', '89200-009', 'Rua da Alegria, 963', '01.234.567/0001-99', '/Views/Assets/Images/Estabelecimentos/BoiNaBrasa.png', NULL, '#FF5733', '#33FF57', '#3357FF', 'Bar', 4.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.estabelecimentos_usuarios: ~11 rows (aproximadamente)
INSERT INTO `estabelecimentos_usuarios` (`id`, `usuario_id`, `cargo_id`, `estabelecimento_id`) VALUES
	(1, 1, 1, 2),
	(2, 2, 2, 2),
	(3, 3, 3, 3),
	(4, 4, 4, 4),
	(5, 5, 5, 5),
	(6, 6, 6, 6),
	(7, 7, 7, 7),
	(8, 8, 8, 8),
	(9, 9, 9, 9),
	(10, 11, 1, 2),
	(11, 12, 1, 1),
	(12, 16, 7, 1);

-- Copiando estrutura para tabela db_hubmenu.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `observacao` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_pedido` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.pedidos: ~28 rows (aproximadamente)
INSERT INTO `pedidos` (`id`, `usuario_id`, `estabelecimento_id`, `observacao`, `status`, `avaliacao`, `valor_total`, `data_pedido`) VALUES
	(1, 1, 1, 'Sem cebola', 'cancelado', 5, 29.90, '2025-05-14 15:41:03'),
	(2, 2, 1, 'Ponto da carne: mal passada', 'entregue', 4, 59.90, '2025-05-14 15:41:03'),
	(3, 3, 3, 'Sem wasabi', 'entregue', 5, 39.90, '2025-05-14 15:41:03'),
	(4, 4, 4, 'Adicionar maionese', 'preparando', 4, 19.90, '2025-05-14 15:41:03'),
	(5, 5, 5, 'Pão bem assado', 'preparando', 5, 4.50, '2025-05-14 15:41:03'),
	(6, 6, 6, 'Café sem açúcar', 'preparando', 4, 4.50, '2025-05-14 15:41:03'),
	(7, 7, 7, 'Sem queijo', 'preparando', 3, 24.90, '2025-05-14 15:41:03'),
	(8, 8, 8, 'Adicionar picles', 'preparando', 5, 25.90, '2025-05-14 15:41:03'),
	(9, 9, 9, 'Sorvete com calda de chocolate', 'preparando', 5, 9.90, '2025-05-14 15:41:03'),
	(10, 11, 1, 'Cerveja bem gelada', 'preparando', 4, 12.90, '2025-05-14 15:41:03'),
	(11, 11, 2, NULL, 'cancelado', NULL, 59.90, '2025-06-24 14:37:05'),
	(12, 11, 2, NULL, 'cancelado', NULL, 59.90, '2025-06-24 14:37:34'),
	(13, 11, 2, NULL, 'cancelado', NULL, 59.90, '2025-06-24 14:38:05'),
	(14, 11, 2, NULL, 'cancelado', NULL, 59.90, '2025-06-24 14:40:27'),
	(15, 11, 2, NULL, 'cancelado', NULL, 59.90, '2025-06-24 14:40:42'),
	(16, 11, 2, 'Array', 'cancelado', NULL, 59.90, '2025-06-24 14:43:01'),
	(17, 11, 2, '', 'entregue', NULL, 59.90, '2025-06-24 14:44:39'),
	(18, 11, 2, '', 'pendente', NULL, 59.90, '2025-06-24 14:45:00'),
	(19, 11, 2, '', 'pendente', NULL, 59.90, '2025-06-24 14:47:31'),
	(20, 11, 2, '', 'pendente', NULL, 59.90, '2025-06-24 14:48:13'),
	(21, 11, 2, '', 'pendente', NULL, 59.90, '2025-06-24 14:50:01'),
	(22, 11, 2, '', 'pendente', NULL, 59.90, '2025-06-24 14:51:16'),
	(23, 11, 2, NULL, 'pendente', NULL, 59.90, '2025-06-24 14:53:36'),
	(24, 11, 2, NULL, 'pendente', NULL, 59.90, '2025-06-24 14:53:54'),
	(25, 11, 2, NULL, 'pendente', NULL, 59.90, '2025-06-24 14:54:49'),
	(26, 12, 1, NULL, 'entregue', NULL, 29.90, '2025-06-24 14:59:48'),
	(27, 12, 1, NULL, 'pendente', NULL, 314.90, '2025-06-24 16:03:17'),
	(28, 12, 1, NULL, 'cancelado', NULL, 188.00, '2025-06-25 14:16:45');

-- Copiando estrutura para tabela db_hubmenu.pedidos_produtos
CREATE TABLE IF NOT EXISTS `pedidos_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `preco_unitario` decimal(10,2) NOT NULL,
  `observacao` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `pedidos_produtos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `pedidos_produtos_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.pedidos_produtos: ~19 rows (aproximadamente)
INSERT INTO `pedidos_produtos` (`id`, `pedido_id`, `produto_id`, `quantidade`, `preco_unitario`, `observacao`) VALUES
	(5, 1, 2, 2, 19.99, NULL),
	(6, 1, 1, 1, 29.90, NULL),
	(7, 2, 4, 3, 9.50, NULL),
	(8, 3, 5, 1, 49.99, NULL),
	(9, 16, 2, 1, 59.90, NULL),
	(10, 17, 2, 1, 59.90, NULL),
	(11, 18, 2, 1, 59.90, NULL),
	(12, 19, 2, 1, 59.90, NULL),
	(13, 20, 2, 1, 59.90, NULL),
	(14, 21, 2, 1, 59.90, NULL),
	(15, 22, 2, 1, 59.90, NULL),
	(16, 23, 2, 1, 59.90, NULL),
	(17, 24, 2, 1, 59.90, '1321321321'),
	(18, 25, 2, 1, 59.90, '3213213'),
	(19, 26, 1, 1, 29.90, 'sem massa'),
	(20, 27, 1, 1, 29.90, 'sem massa'),
	(21, 27, 23, 1, 100.00, ''),
	(22, 27, 24, 1, 25.00, ''),
	(23, 27, 25, 1, 88.00, ''),
	(24, 27, 26, 1, 72.00, ''),
	(25, 28, 25, 1, 88.00, 'ao ponto pra menos, quentinha paizao'),
	(26, 28, 23, 1, 100.00, 'Quentinha, no ponto paizao');

-- Copiando estrutura para tabela db_hubmenu.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `status_produtos` tinyint(1) DEFAULT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`),
  CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.produtos: ~28 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `nome`, `descricao`, `valor`, `imagem`, `status_produtos`, `estabelecimento_id`, `categoria_id`) VALUES
	(1, 'Pizza Margherita Queijo', 'Molho de tomate, mussarela e manjericão e muito queijo', 30.00, '/Views/Assets/Images/Produtos/6830ce694ee14.webp', 1, 1, 1),
	(2, 'Picanha na Brasa', 'Picanha grelhada com acompanhamentos', 59.90, '/Views/Assets/Images/Produtos/68432c01e5ea5.jpg', 1, 2, 2),
	(3, 'Sushi Combo', '10 unidades de sushi variados', 39.90, 'sushi_combo.jpg', 1, 3, 3),
	(4, 'X-Burguer', 'Hambúrguer com queijo, alface e tomate', 19.90, 'xburguer.jpg', 1, 4, 4),
	(5, 'Pão Francês', 'Pão crocante e fresquinho', 0.90, 'pao_frances.jpg', 1, 5, 5),
	(6, 'Pizza Mortadelao', 'Pizza preparada especialmente com mortadela!', 30.00, '/Views/Assets/Images/Produtos/6830c72d6864e.webp', 1, 6, 1),
	(7, 'Lasanha à Bolonhesa', 'Lasanha com molho bolonhesa e queijo', 24.90, '/Views/Assets/Images/Produtos/6834b6d92194f.png', 1, 7, 7),
	(8, 'Hambúrguer Duplo', 'Dois hambúrgueres com queijo e bacon', 25.90, 'hamburguer_duplo.jpg', 1, 8, 8),
	(9, 'Sorvete de Chocolate', 'Sorvete cremoso de chocolate', 9.90, 'sorvete_chocolate.jpg', 1, 9, 9),
	(10, 'Cerveja Artesanal', 'Cerveja local artesanal', 12.90, 'cerveja_artesanal.jpg', 1, 10, 10),
	(14, 'Pizza Feijoada', 'Pizza Feijoada, boa pra quando a fome bater forte.', 30.00, '/Views/Assets/Images/Produtos/6830c94fdd3b2.png', 1, 6, 1),
	(15, 'Peixe (Bem passado)', 'Delicioso e suculento', 20.50, '/Views/Assets/Images/Produtos/6830ca1285b15.png', 1, 6, 4),
	(16, 'La Moda Del Chief', 'La pizza hermosa del Pará Lanches!', 80.00, '/Views/Assets/Images/Produtos/6830ca061a595.webp', 1, 6, 1),
	(17, 'Cuzcuz Paulista', 'esse e rui', 15.00, '/Views/Assets/Images/Produtos/6830ca7596755.png', 1, 6, 1),
	(18, 'Pizza de Chocolate', 'Pizza de chocolate bem molhadinha', 30.00, '/Views/Assets/Images/Produtos/6830cac75a3d4.png', 1, 6, 1),
	(19, 'Pizza Vegetariana', 'Pizza vegetariana caprichada!', 45.00, '/Views/Assets/Images/Produtos/6830caca5e37a.webp', 1, 6, 1),
	(20, 'Cuzcuz c/ Ovo', 'essa e bom', 12.00, '/Views/Assets/Images/Produtos/6830cb1e44ddc.png', 1, 6, 1),
	(22, 'Bebe Reborn do Yohan', 'como ele fez essa coisa?????', 555.00, '/Views/Assets/Images/Produtos/6830cd0631107.png', 1, 6, 2),
	(23, 'Pizza de Banana', 'Pizza de banana com muito carinho', 100.00, '/Views/Assets/Images/Produtos/68432372dc5f6.jpg', 1, 1, 1),
	(24, 'mini Sonho', 'Malasadas são donuts feitos com fermento e enriquecidos com ovos, manteiga e, às vezes, leite evaporado ou fresco. Depois de fritos, são passados ​​em açúcar. (OBS.: é um sonho de padaria)', 25.00, '/Views/Assets/Images/Produtos/6843306ba2d0d.jpg', 1, 1, 5),
	(25, 'Picanha defumada', 'peça de carne', 88.00, '/Views/Assets/Images/Produtos/68433807f3199.jpg', 1, 1, 2),
	(26, 'Costela 2.0', 'Fogo de chão', 72.00, '/Views/Assets/Images/Produtos/68432dc9e8e18.jpg', 1, 1, 2),
	(27, 'Big Malassada', 'Malasadas são donuts feitos com fermento e enriquecidos com ovos, manteiga e, às vezes, leite evaporado ou fresco. Depois de fritos, são passados ​​em açúcar. (OBS.: é um sonho de padaria)', 25.00, '/Views/Assets/Images/Produtos/6843318c5ad45.jpg', 1, 3, 5),
	(28, 'Guaraná Jesus 2.0', 'refri doce', 3.00, '/Views/Assets/Images/Produtos/68433edbceb34.jpg', 1, 10, 1),
	(29, 'Petit Gateau Branco', 'Bolo e sorvete', 23.00, '/Views/Assets/Images/Produtos/68433b1b7fd40.jpg', 1, 9, 1),
	(33, 'Pizza Margherita', 'sim', 100.00, '/Views/Assets/Images/Produtos/6859a1d9f34e0.png', 0, 2, 1),
	(38, 'Pizza Margherita', 'ss', 22.00, '/Views/Assets/Images/Produtos/6859b45059c38.jpg', 1, 2, 1),
	(39, 'Pizza Margherita', 'aaa', 22.00, '/Views/Assets/Images/Produtos/6859b4bddc67f.jpg', 0, 2, 1);

-- Copiando estrutura para tabela db_hubmenu.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_usuarios_cargo` (`cargo_id`),
  CONSTRAINT `fk_usuarios_cargo` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.usuarios: ~12 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `cargo_id`, `cep`, `endereco`, `telefone`) VALUES
	(1, 'João Silva', 'joao@example.com', '$2y$2y$10$PlZAEZtmmsh7zQcuN4P1Z.5l2sDCWLcb7k2k7hyCxf0bT0uk3i1NO', 1, '89200-010', 'Rua A, 100', '(47) 99999-0001'),
	(2, 'Maria Oliveira', 'maria@example.com', '$2y$2y$10$PlZAEZtmmsh7zQcuN4P1Z.5l2sDCWLcb7k2k7hyCxf0bT0uk3i1NO', NULL, '89200-011', 'Rua B, 200', '(47) 99999-0002'),
	(3, 'Pedro Santos', 'pedro@example.com', '$2y$2y$10$PlZAEZtmmsh7zQcuN4P1Z.5l2sDCWLcb7k2k7hyCxf0bT0uk3i1NO', NULL, '89200-012', 'Rua C, 300', '(47) 99999-0003'),
	(4, 'Ana Souza', 'ana@example.com', '$2y$2y$10$PlZAEZtmmsh7zQcuN4P1Z.5l2sDCWLcb7k2k7hyCxf0bT0uk3i1NO', NULL, '89200-013', 'Rua D, 400', '(47) 99999-0004'),
	(5, 'Lucas Lima', 'lucas@example.com', '$2y$2y$10$PlZAEZtmmsh7zQcuN4P1Z.5l2sDCWLcb7k2k7hyCxf0bT0uk3i1NO', NULL, '89200-014', 'Rua E, 500', '(47) 99999-0005'),
	(6, 'Carla Pereira', 'carla@example.com', '$2y$2y$10$PlZAEZtmmsh7zQcuN4P1Z.5l2sDCWLcb7k2k7hyCxf0bT0uk3i1NO', NULL, '89200-015', 'Rua F, 600', '(47) 99999-0006'),
	(7, 'Marcos Almeida', 'marcos@example.com', '$2y$2y$10$PlZAEZtmmsh7zQcuN4P1Z.5l2sDCWLcb7k2k7hyCxf0bT0uk3i1NO', NULL, '89200-016', 'Rua G, 700', '(47) 99999-0007'),
	(8, 'Fernanda Costa', 'fernanda@example.com', '$2y$2y$10$PlZAEZtmmsh7zQcuN4P1Z.5l2sDCWLcb7k2k7hyCxf0bT0uk3i1NO', NULL, '89200-017', 'Rua H, 800', '(47) 99999-0008'),
	(9, 'Rafael Rodrigues', 'rafael@example.com', '$2y$2y$10$PlZAEZtmmsh7zQcuN4P1Z.5l2sDCWLcb7k2k7hyCxf0bT0uk3i1NO', NULL, '89200-018', 'Rua I, 900', '(47) 99999-0009'),
	(10, 'Juliana Martins', 'juliana@example.com', '$2y$2y$10$PlZAEZtmmsh7zQcuN4P1Z.5l2sDCWLcb7k2k7hyCxf0bT0uk3i1NO', NULL, '89200-019', 'Rua J, 1000', '(47) 99999-0010'),
	(11, 'Moises Joao Ferreira', 'benimaru@gmail.com', '$2y$10$zbowC/fIsqDg4/kI.wwleeJxFZ151PY6rClAwJzLI9/Wc3uzV1kwK', 1, '89223-110', 'Rua Inexiste, 801', '(47) 99127-0120'),
	(12, 'Yohan Siedschlag', 'cautios2.0@gmail.com', '$2y$10$VdPiKi4c.GfqCM5eWR3T/uQSoMLrJ9oQB20b8WWH6yMAIgZGvh/pC', 1, '21543-677', 'Rua do God War, 111', '(14) 23156-3464'),
	(16, 'Mark', 'mark@gmail.com', '$2y$10$QvLh8nEbgBDATFlOFO2iz.PK3TowomxMjcSBrs.iihQrvlFKEQa/q', 7, NULL, NULL, '(23) 94343-2536');

-- Copiando estrutura para tabela db_hubmenu.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(100) DEFAULT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `transacao_id` varchar(100) DEFAULT NULL,
  `status_pagamento` varchar(50) DEFAULT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_venda` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `fk_vendas_pedido` (`pedido_id`),
  CONSTRAINT `fk_vendas_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_hubmenu.vendas: ~10 rows (aproximadamente)
INSERT INTO `vendas` (`id`, `referencia`, `pedido_id`, `transacao_id`, `status_pagamento`, `estabelecimento_id`, `valor_total`, `data_venda`) VALUES
	(1, 'VEND001', 11, 'TXN001', 'Pendente', 1, 150.00, '2025-05-14 15:41:03'),
	(2, 'VEND002', 5, 'TXN002', 'Aprovado', 2, 230.50, '2025-05-14 15:41:03'),
	(3, 'VEND003', 23, 'TXN003', 'Pendente', 3, 120.75, '2025-05-14 15:41:03'),
	(4, 'VEND004', 6, 'TXN004', 'Aprovado', 1, 400.00, '2025-05-14 15:41:03'),
	(5, 'VEND005', 7, 'TXN005', 'Cancelado', 2, 50.00, '2025-05-14 15:41:03'),
	(6, 'VEND006', 8, 'TXN006', 'Aprovado', 3, 180.30, '2025-05-14 15:41:03'),
	(7, 'VEND007', 9, 'TXN007', 'Pendente', 1, 275.40, '2025-05-14 15:41:03'),
	(8, 'VEND008', 16, 'TXN008', 'Aprovado', 2, 325.80, '2025-05-14 15:41:03'),
	(9, 'VEND009', 2, 'TXN009', 'Cancelado', 3, 95.00, '2025-05-14 15:41:03'),
	(10, 'VEND010', 4, 'TXN010', 'Aprovado', 1, 150.20, '2025-05-14 15:41:03');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
