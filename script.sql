-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 14/09/2025 às 17:14
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pobrelist`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--
CREATE database pobrelist;
use pobrelist;
CREATE TABLE `categoria` (
  `id` int NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `categoria_cor` varchar(7) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `categoria_cor`) VALUES
(1, 'Limpeza', '#528bff'),
(2, 'Tecnologia', '#1E90FF'),
(4, 'Casa & Decoração', '#32CD32'),
(6, 'Livros', '#8A2BE2'),
(7, 'Gatos', '#ff00d0'),
(8, 'Acessórios', '#9478d3');

-- --------------------------------------------------------

--
-- Estrutura para tabela `item`
--

CREATE TABLE `item` (
  `id` int NOT NULL,
  `nome` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci NOT NULL,
  `categoria_id` int NOT NULL,
  `prioridade_id` int NOT NULL,
  `preco_estimado` decimal(10,2) NOT NULL DEFAULT '0.00',
  `url_imagem` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url_web` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_desejo` date NOT NULL,
  `comprado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `item`
--

INSERT INTO `item` (`id`, `nome`, `descricao`, `categoria_id`, `prioridade_id`, `preco_estimado`, `url_imagem`, `url_web`, `data_desejo`, `comprado`) VALUES
(22, 'Mop Fácil Dobrável', 'Para facilitar a limpeza diária', 1, 13, 32.30, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lr82zgztoqas5c.webp', 'https://s.shopee.com.br/Ldq3pv3IG', '2025-10-06', 0),
(23, 'Pintura da parede do quarto', 'mão de obra e produtos', 4, 14, 400.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTffrphqgwwpe7vbdzirrlcKhsp5ybxlizOVg&s', NULL, '2025-09-22', 0),
(24, 'Escova A Vapor Para Gatos', 'Os gatos soltam muito pelo mds', 7, 13, 11.89, 'https://down-br.img.susercontent.com/file/sg-11134201-7req9-m8m4i8ulopef66.webp', 'https://s.shopee.com.br/AUkcApwj7N', '2025-10-06', 0),
(17, 'Tapete Arranhador Para Gatos', 'Pros gatos pararem de destruir minha cama', 7, 5, 15.99, 'https://down-br.img.susercontent.com/file/sg-11134201-7rce3-m6czqqeb5lz4d9.webp', 'https://s.shopee.com.br/6fXtaDkqo3', '2025-09-30', 0),
(20, 'Kit 02 Travesseiros', 'Travesseiros', 4, 14, 33.90, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lqnrhbjpwkdj15.webp', 'https://s.shopee.com.br/8pcOB6tEdm', '2025-10-06', 0),
(18, 'Luminária Pendente', 'Para substituir a luminária que quebrou', 4, 12, 49.90, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-mcwmfm0ml5bmbb.webp', 'https://s.shopee.com.br/803HAzg9SN', '2025-10-06', 0),
(19, 'Rodo De Limpeza Dobrável', 'Necessário para facilitar a limpeza', 1, 13, 18.00, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lxtmgjoyxth2f4.webp', 'https://s.shopee.com.br/5ffMOrC8ns', '2025-10-05', 0),
(21, 'Breu Violino', 'Acabou o meu breu', 8, 14, 20.00, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lzflw8ruodglf2.webp', NULL, '2025-09-23', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `prioridade`
--

CREATE TABLE `prioridade` (
  `id` int NOT NULL,
  `nivel` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prioridade_cor` varchar(7) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `prioridade`
--

INSERT INTO `prioridade` (`id`, `nivel`, `prioridade_cor`) VALUES
(14, 'Muito alta', '#de1717'),
(5, 'Alta', '#FF4500'),
(13, 'Média', '#7cfe84'),
(8, 'Muito Baixa', '#66a8ff'),
(12, 'Baixo', '#65dde6');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `prioridade_id` (`prioridade_id`);

--
-- Índices de tabela `prioridade`
--
ALTER TABLE `prioridade`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `prioridade`
--
ALTER TABLE `prioridade`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
