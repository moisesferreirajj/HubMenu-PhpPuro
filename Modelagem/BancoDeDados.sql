-- Recriação moderna do schema completo do banco Db_HubMenu
-- Inclui melhorias estruturais, nomes mais consistentes e boas práticas

CREATE DATABASE IF NOT EXISTS Db_HubMenu;
USE Db_HubMenu;

-- Tabela de Cargos
CREATE TABLE cargos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Tabela de Estabelecimentos
CREATE TABLE estabelecimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cep VARCHAR(20),
    endereco VARCHAR(255),
    cnpj VARCHAR(20),
    imagem VARCHAR(255),
    cor1 VARCHAR(20),
    cor2 VARCHAR(20),
    cor3 VARCHAR(20),
    tipo VARCHAR(100),
    media_avaliacao DECIMAL(3,2) DEFAULT 0.00
);

-- Tabela de Usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    cep VARCHAR(20),
    endereco VARCHAR(255),
    telefone VARCHAR(20)
);

-- Relação N:N entre usuários e cargos
CREATE TABLE usuarios_cargos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    cargo_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (cargo_id) REFERENCES cargos(id)
);

-- Relação N:N entre usuários e estabelecimentos
CREATE TABLE usuarios_estabelecimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    estabelecimento_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimentos(id)
);

-- Tabela de Categorias de Produto
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Tabela de Produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    valor DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255),
    estabelecimento_id INT NOT NULL,
    categoria_id INT,
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimentos(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Tabela de Pedidos
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    estabelecimento_id INT NOT NULL,
    observacao TEXT,
    avaliacao INT DEFAULT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimentos(id)
);

-- Relação N:N entre pedidos e produtos
CREATE TABLE pedidos_produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    preco_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- Tabela de Vendas
CREATE TABLE vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    referencia VARCHAR(100),
    transacao_id VARCHAR(100),
    status_pagamento VARCHAR(50),
    estabelecimento_id INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_venda DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimentos(id)
);
