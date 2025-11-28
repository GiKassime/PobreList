SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- 1. Criação e Seleção do Banco
CREATE DATABASE IF NOT EXISTS `pobrelist`;
USE `pobrelist`;

-- --------------------------------------------------------

-- 2. Estrutura da tabela `categoria`
CREATE TABLE `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `categoria_cor` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dados da tabela `categoria`
INSERT INTO `categoria` (`id`, `nome`, `categoria_cor`) VALUES
(1, 'Limpeza', '#528bff'),
(2, 'Tecnologia', '#1E90FF'),
(4, 'Casa & Decoração', '#32CD32'),
(7, 'Gatos', '#ff00d0'),
(8, 'Acessórios', '#9478d3'),
(9, 'Lazer', '#ff004c');

-- --------------------------------------------------------

-- 3. Estrutura da tabela `prioridade`
CREATE TABLE `prioridade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nivel` varchar(50) NOT NULL,
  `prioridade_cor` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dados da tabela `prioridade`
INSERT INTO `prioridade` (`id`, `nivel`, `prioridade_cor`) VALUES
(5, 'Alta', '#FF4500'),
(8, 'Muito Baixa', '#66a8ff'),
(12, 'Baixo', '#65dde6'),
(13, 'Média', '#7cfe84'),
(14, 'Muito alta', '#de1717');

-- --------------------------------------------------------

-- 4. Estrutura da tabela `item`
CREATE TABLE `item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `categoria_id` int NOT NULL,
  `prioridade_id` int NOT NULL,
  `preco_estimado` decimal(10,2) NOT NULL DEFAULT '0.00',
  `url_imagem` varchar(255) DEFAULT NULL,
  `url_web` varchar(255) DEFAULT NULL,
  `data_desejo` date NOT NULL,
  `comprado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `prioridade_id` (`prioridade_id`),
  CONSTRAINT `fk_item_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  CONSTRAINT `fk_item_prioridade` FOREIGN KEY (`prioridade_id`) REFERENCES `prioridade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dados da tabela `item`
INSERT INTO `item` (`id`, `nome`, `descricao`, `categoria_id`, `prioridade_id`, `preco_estimado`, `url_imagem`, `url_web`, `data_desejo`, `comprado`) VALUES
(17, 'Tapete Arranhador Para Gatos', 'Pros gatos pararem de destruir minha cama', 7, 5, 15.99, 'https://down-br.img.susercontent.com/file/sg-11134201-7rce3-m6czqqeb5lz4d9.webp', 'https://s.shopee.com.br/6fXtaDkqo3', '2025-09-30', 0),
(18, 'Luminária Pendente', 'Para substituir a luminária que quebrou', 4, 12, 58.90, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-mcwmfm0ml5bmbb.webp', 'https://s.shopee.com.br/803HAzg9SN', '2025-10-06', 1),
(19, 'Rodo De Limpeza Dobrável', 'Necessário para facilitar a limpeza', 1, 13, 18.00, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lxtmgjoyxth2f4.webp', 'https://s.shopee.com.br/5ffMOrC8ns', '2025-10-05', 0),
(20, 'Kit 02 Travesseiros', 'Travesseiros', 4, 14, 33.90, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lqnrhbjpwkdj15.webp', 'https://s.shopee.com.br/8pcOB6tEdm', '2025-10-06', 0),
(21, 'Breu Violino', 'Acabou o meu breu', 8, 14, 20.00, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lzflw8ruodglf2.webp', NULL, '2025-09-23', 1),
(22, 'Mop Fácil Dobrável', 'Para facilitar a limpeza diária', 1, 13, 50.00, 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-lr82zgztoqas5c.webp', 'https://s.shopee.com.br/Ldq3pv3IG', '2025-10-10', 1),
(23, 'Pintura da parede do quarto', 'mão de obra e produtos', 4, 14, 300.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTffrphqgwwpe7vbdzirrlcKhsp5ybxlizOVg&s', NULL, '2025-09-22', 1),
(24, 'Escova A Vapor Para Gatos', 'Os gatos soltam muito pelo mds', 7, 13, 11.89, 'https://down-br.img.susercontent.com/file/sg-11134201-7req9-m8m4i8ulopef66.webp', 'https://s.shopee.com.br/AUkcApwj7N', '2025-10-06', 1),
(25, 'Placa Display Completa Ar', 'Para o ar ligar', 4, 14, 225.00, 'https://http2.mlstatic.com/D_NQ_NP_2X_914020-MLB89124705283_082025-F-placa-display-completa-ar-condicionado-lg-inverter-9000.webp', NULL, '2025-09-21', 1),
(26, 'Limpeza e manutenção do ar', 'Precisa limpar e resolver o caninho', 4, 14, 150.00, 'https://lojaartech.cdn.magazord.com.br/img/2024/09/produto/17571/evaporadora-da-condensadora-eco-dream-inverter-wi-fi-9000-btus-quente-e-fria-elgin-r32-classe-a-inmetro-artech-climatizacao-hiqi09c2wa-01-1.png', NULL, '2025-10-05', 1),
(27, 'Show do Linkin Park', 'Show no Zepellin', 9, 13, 66.00, 'https://images.sympla.com.br/68a28014a96bf-lg.jpg', NULL, '2025-10-24', 1),
(28, 'Mesa 200x60cm', 'Mesa pro quarto', 4, 5, 588.00, 'https://http2.mlstatic.com/D_NQ_NP_2X_867556-MLB83755034400_042025-F.webp', 'https://www.mercadolivre.com.br/mesa-diretor-frame-munique-190m/up/MLBU1099172905?pdp_filters=item_id:MLB2094919904', '2025-10-31', 1),
(29, '2 Cadeiras de Escritório', 'Para a mesa', 4, 13, 800.00, 'https://abracasa.vteximg.com.br/arquivos/ids/181718/cadeira-de-escritorio-franca-preto-diagonal.jpg?v=637967860223230000', NULL, '2025-10-31', 0),
(30, 'Lampadas inteligentes', '5 Lampadas para casa', 4, 5, 85.00, 'https://m.media-amazon.com/images/I/614jUSNv2NL._AC_SL1200_.jpg', 'https://www.amazon.com.br/Lampada-Smart-Inteligente-Alexa-google/dp/B0FFH7TBJY/ref=sr_1_2_sspa?__mk_pt_BR=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=27ILGIGBYNSGU&dib=eyJ2IjoiMSJ9.Yv7Sp-0eJnDhnFPH7ycP29qabOsRS5faZ6kzyi7gVAziFO1rIWBWh7q615tDIp6Ddu0aAAB-RDWhf2Y3v', '2025-10-25', 1),
(31, 'Balde Dobrável Retangular de Silicone', 'Balde retrátil', 1, 13, 33.96, 'https://down-br.img.susercontent.com/file/br-11134207-81z1k-metg72krzls1dc.webp', 'https://shopee.com.br/Balde-Dobr%C3%A1vel-Retangular-de-Silicone-com-Al%C3%A7a-Pratico-Retr%C3%A1til-i.974001830.23793797803', '2025-10-15', 1);

COMMIT;
