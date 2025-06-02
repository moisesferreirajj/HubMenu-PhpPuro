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

-- Copiando estrutura para tabela db_hubmenu.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `data_criacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnpj` (`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando estrutura para tabela db_hubmenu.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando estrutura para tabela db_hubmenu.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando estrutura para tabela db_hubmenu.estabelecimentos_usuarios
CREATE TABLE IF NOT EXISTS `estabelecimentos_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `data_vinculo` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_estabelecimento` (`usuario_id`, `estabelecimento_id`),
  KEY `cargo_id` (`cargo_id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  CONSTRAINT `estabelecimentos_usuarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `estabelecimentos_usuarios_ibfk_2` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `estabelecimentos_usuarios_ibfk_3` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando estrutura para tabela db_hubmenu.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `data_criacao` datetime DEFAULT current_timestamp(),
  `data_atualizacao` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `idx_produto_ativo` (`ativo`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL,
  CONSTRAINT `chk_valor_positivo` CHECK (`valor` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando estrutura para tabela db_hubmenu.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `observacao` text DEFAULT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `status` enum('pendente', 'confirmado', 'preparando', 'pronto', 'entregue', 'cancelado') DEFAULT 'pendente',
  `data_pedido` datetime DEFAULT current_timestamp(),
  `data_atualizacao` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `idx_status` (`status`),
  KEY `idx_data_pedido` (`data_pedido`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `chk_valor_total_positivo` CHECK (`valor_total` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando estrutura para tabela db_hubmenu.pedidos_produtos
CREATE TABLE IF NOT EXISTS `pedidos_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `preco_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`quantidade` * `preco_unitario`) STORED,
  PRIMARY KEY (`id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `pedidos_produtos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pedidos_produtos_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `chk_quantidade_positiva` CHECK (`quantidade` > 0),
  CONSTRAINT `chk_preco_unitario_positivo` CHECK (`preco_unitario` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando estrutura para tabela db_hubmenu.avaliacoes
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `avaliacao` int(1) NOT NULL,
  `comentario` text DEFAULT NULL,
  `data_avaliacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_pedido` (`usuario_id`, `pedido_id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `idx_avaliacao` (`avaliacao`),
  CONSTRAINT `avaliacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avaliacoes_ibfk_2` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avaliacoes_ibfk_3` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `chk_avaliacao_range` CHECK (`avaliacao` >= 1 AND `avaliacao` <= 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela para avaliações do sistema HubMenu
CREATE TABLE IF NOT EXISTS `avaliacoes_sistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `avaliacao` int(1) NOT NULL,
  `comentario` text DEFAULT NULL,
  `data_avaliacao` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_id` (`usuario_id`),
  KEY `idx_avaliacao` (`avaliacao`),
  CONSTRAINT `avaliacoes_sistema_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chk_avaliacao_sistema_range` CHECK (`avaliacao` >= 1 AND `avaliacao` <= 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando estrutura para tabela db_hubmenu.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `transacao_id` varchar(100) DEFAULT NULL,
  `status_pagamento` enum('pendente', 'aprovado', 'cancelado', 'estornado') DEFAULT 'pendente',
  `estabelecimento_id` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_venda` datetime DEFAULT current_timestamp(),
  `data_atualizacao` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `referencia` (`referencia`),
  UNIQUE KEY `transacao_id` (`transacao_id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `idx_status_pagamento` (`status_pagamento`),
  KEY `idx_data_venda` (`data_venda`),
  CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimentos` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `vendas_ibfk_2` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `chk_valor_venda_positivo` CHECK (`valor_total` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;