-- PobreList Database Schema
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS pobrelist;
USE pobrelist;
CREATE TABLE `categoria` (
  `id` int NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `categoria_cor` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dados iniciais

INSERT INTO `categoria` (`id`, `nome`, `categoria_cor`) VALUES
(1, 'Limpeza', '#528bff'),
(2, 'Tecnologia', '#1E90FF'),
(4, 'Casa & Decoração', '#32CD32'),
(9, 'Lazer', '#ff004c'),
(7, 'Gatos', '#ff00d0'),
(8, 'Acessórios', '#9478d3');




CREATE TABLE `prioridade` (
  `id` int NOT NULL,
  `nivel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prioridade_cor` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `prioridade` (`id`, `nivel`, `prioridade_cor`) VALUES
(14, 'Muito alta', '#de1717'),
(5, 'Alta', '#FF4500'),
(13, 'Média', '#7cfe84'),
(8, 'Muito Baixa', '#66a8ff'),
(12, 'Baixo', '#65dde6');


CREATE TABLE `item` (
  `id` int NOT NULL,
  `nome` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `categoria_id` int NOT NULL,
  `prioridade_id` int NOT NULL,
  `preco_estimado` decimal(10,2) NOT NULL DEFAULT '0.00',
  `url_imagem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url_web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_desejo` date NOT NULL,
  `comprado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `item` (`id`, `nome`, `descricao`, `categoria_id`, `prioridade_id`, `preco_estimado`, `url_imagem`, `url_web`, `data_desejo`, `comprado`) VALUES
(22, 'Mop Fácil Dobrável', 'Para facilitar a limpeza diária', 1, 13, 32.30, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lr82zgztoqas5c.webp', 'https://s.shopee.com.br/Ldq3pv3IG', '2025-10-06', 0),
(23, 'Pintura da parede do quarto', 'mão de obra e produtos', 4, 14, 300.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTffrphqgwwpe7vbdzirrlcKhsp5ybxlizOVg&s', NULL, '2025-09-22', 1),
(24, 'Escova A Vapor Para Gatos', 'Os gatos soltam muito pelo mds', 7, 13, 11.89, 'https://down-br.img.susercontent.com/file/sg-11134201-7req9-m8m4i8ulopef66.webp', 'https://s.shopee.com.br/AUkcApwj7N', '2025-10-06', 1),
(17, 'Tapete Arranhador Para Gatos', 'Pros gatos pararem de destruir minha cama', 7, 5, 15.99, 'https://down-br.img.susercontent.com/file/sg-11134201-7rce3-m6czqqeb5lz4d9.webp', 'https://s.shopee.com.br/6fXtaDkqo3', '2025-09-30', 0),
(20, 'Kit 02 Travesseiros', 'Travesseiros', 4, 14, 33.90, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lqnrhbjpwkdj15.webp', 'https://s.shopee.com.br/8pcOB6tEdm', '2025-10-06', 0),
(18, 'Luminária Pendente', 'Para substituir a luminária que quebrou', 4, 12, 58.90, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-mcwmfm0ml5bmbb.webp', 'https://s.shopee.com.br/803HAzg9SN', '2025-10-06', 1),
(19, 'Rodo De Limpeza Dobrável', 'Necessário para facilitar a limpeza', 1, 13, 18.00, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lxtmgjoyxth2f4.webp', 'https://s.shopee.com.br/5ffMOrC8ns', '2025-10-05', 0),
(21, 'Breu Violino', 'Acabou o meu breu', 8, 14, 20.00, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lzflw8ruodglf2.webp', NULL, '2025-09-23', 1),
(25, 'Placa Display Completa Ar', 'Para o ar ligar', 4, 14, 225.00, 'https://http2.mlstatic.com/D_NQ_NP_2X_914020-MLB89124705283_082025-F-placa-display-completa-ar-condicionado-lg-inverter-9000.webp', NULL, '2025-09-21', 1),
(26, 'Limpeza e manutenção do ar', 'Precisa limpar e resolver o caninho', 4, 14, 150.00, 'https://lojaartech.cdn.magazord.com.br/img/2024/09/produto/17571/evaporadora-da-condensadora-eco-dream-inverter-wi-fi-9000-btus-quente-e-fria-elgin-r32-classe-a-inmetro-artech-climatizacao-hiqi09c2wa-01-1.png', NULL, '2025-10-05', 1),
(27, 'Show do Linkin Park', 'Show no Zepellin', 9, 13, 66.00, 'https://images.sympla.com.br/68a28014a96bf-lg.jpg', NULL, '2025-10-24', 1),
(28, 'Mesa 200x60cm', 'Mesa pro quarto', 4, 5, 500.00, 'https://http2.mlstatic.com/D_NQ_NP_2X_916838-MLB86018605870_062025-F-mesa-200x60-para-escritorio-escrivaninha-cnt30.webp', 'https://produto.mercadolivre.com.br/MLB-1481034639-mesa-200x60-para-escritorio-escrivaninha-cnt30-_JM?searchVariation=173992526984#polycard_client=bookmarks', '2025-10-31', 0),
(29, '2 Cadeiras de Escritório', 'Para a mesa', 4, 13, 800.00, 'https://abracasa.vteximg.com.br/arquivos/ids/181718/cadeira-de-escritorio-franca-preto-diagonal.jpg?v=637967860223230000', NULL, '2025-10-31', 0);



-- Índices e constraints
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `prioridade_id` (`prioridade_id`);


ALTER TABLE `prioridade`
  ADD PRIMARY KEY (`id`);

-- Auto increment
ALTER TABLE `categoria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `prioridade`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

-- Foreign Keys
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_prioridade` FOREIGN KEY (`prioridade_id`) REFERENCES `prioridade`(`id`),
  ADD CONSTRAINT `fk_item_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria`(`id`);
