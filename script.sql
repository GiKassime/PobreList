-- Criação do banco de dados
CREATE DATABASE pobrelist CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE pobrelist;

-- Tabela de Categorias
CREATE TABLE categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Tabela de Prioridades
CREATE TABLE prioridade (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nivel VARCHAR(50) NOT NULL
);

-- Tabela de Itens (CRUD principal)
CREATE TABLE item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT NOT NULL,
    categoria_id INT NOT NULL,
    prioridade_id INT NOT NULL,
    preco_estimado DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    data_desejo DATE NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categoria(id),
    FOREIGN KEY (prioridade_id) REFERENCES prioridade(id)
);

