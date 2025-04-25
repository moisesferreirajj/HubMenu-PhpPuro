CREATE DATABASE IF NOT EXISTS Db_HubMenu;
USE Db_HubMenu;

-- Cargos
CREATE TABLE cargos (
    id_cargo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

-- Estabelecimentos
CREATE TABLE estabelecimentos (
    id_estabelecimento INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    cep VARCHAR(20),
    endereco VARCHAR(255),
    cnpj VARCHAR(20),
    tipo VARCHAR(100)
);

-- Usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    cep VARCHAR(20),
    endereco VARCHAR(255),
    telefone VARCHAR(20)
);

-- Produtos
CREATE TABLE produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    valor DECIMAL(10,2) NOT NULL,
    id_estabelecimento INT NOT NULL,
    FOREIGN KEY (id_estabelecimento) REFERENCES estabelecimentos(id_estabelecimento)
);

-- Pedidos
CREATE TABLE pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    observacao TEXT,
    id_produto INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
);

-- Vendas
CREATE TABLE vendas (
    id_venda INT AUTO_INCREMENT PRIMARY KEY,
    reference VARCHAR(255),
    payment_id VARCHAR(255),
    status VARCHAR(50),
    id_estabelecimento INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_estabelecimento) REFERENCES estabelecimentos(id_estabelecimento)
);