-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Ago-2019 às 23:18
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cena`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `id_company` int(11) DEFAULT NULL,
  `cliente_nome` varchar(200) DEFAULT NULL,
  `cliente_email` varchar(45) DEFAULT NULL,
  `cliente_rg` varchar(10) DEFAULT NULL COMMENT '530831090',
  `cliente_cpf` varchar(11) DEFAULT NULL,
  `clend_id` int(11) DEFAULT NULL,
  `cliente_responsavel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `id_company`, `cliente_nome`, `cliente_email`, `cliente_rg`, `cliente_cpf`, `clend_id`, `cliente_responsavel`) VALUES
(40, 1, 'Marcos Varella', 'marcos@marcos', NULL, NULL, NULL, 'josé'),
(41, 1, 'Gabriel', '', '', '', NULL, NULL),
(42, 1, 'Gabriel2', '', '', '', NULL, NULL),
(43, 1, 'Gabriel3', '', '', '', NULL, NULL),
(44, 1, 'Luana', '', '', '', NULL, NULL),
(45, 1, 'Nelly', '', '', '', NULL, NULL),
(46, 1, 'Thiago', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente_endereco`
--

CREATE TABLE `cliente_endereco` (
  `id_endereco` int(11) NOT NULL,
  `clc_id` int(11) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `complemento` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente_endereco`
--

INSERT INTO `cliente_endereco` (`id_endereco`, `clc_id`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `complemento`) VALUES
(12, NULL, 'Alameda das Margaridas', '123', 'Alphaville', 'Santana de Parnaíba', 'SP', '06539270', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `companies`
--

INSERT INTO `companies` (`id`, `name`) VALUES
(1, 'Cena');

-- --------------------------------------------------------

--
-- Estrutura da tabela `concessionaria`
--

CREATE TABLE `concessionaria` (
  `id` int(11) NOT NULL,
  `razao_social` varchar(255) DEFAULT NULL,
  `id_company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `concessionaria`
--

INSERT INTO `concessionaria` (`id`, `razao_social`, `id_company`) VALUES
(55, 'Enel', 1),
(56, 'Concessionaria 2', 1),
(57, 'Eson', 1),
(58, 'Eson', 1),
(60, 'Enelson', 1),
(61, 'Friboi', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `concessionaria_servico`
--

CREATE TABLE `concessionaria_servico` (
  `id` int(11) NOT NULL,
  `id_concessionaria` int(11) DEFAULT NULL,
  `id_servico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `concessionaria_servico`
--

INSERT INTO `concessionaria_servico` (`id`, `id_concessionaria`, `id_servico`) VALUES
(75, 55, 6),
(76, 55, 7),
(77, 56, 8),
(78, 56, 7),
(79, 57, 6),
(80, 58, 6),
(81, 59, 6),
(82, 60, 6),
(83, 61, 7),
(84, 61, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `docs_nome` varchar(255) DEFAULT NULL,
  `id_company` int(11) DEFAULT NULL,
  `docs_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`id`, `docs_nome`, `id_company`, `docs_link`) VALUES
(60, 'Detalhamento_do_Agendamento.pdf', 1, NULL),
(61, 'AGENDAMENTO GABRIEL.pdf', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos_concessionaria`
--

CREATE TABLE `documentos_concessionaria` (
  `id` int(11) NOT NULL,
  `id_documento` int(11) DEFAULT NULL,
  `id_concessionaria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `documentos_concessionaria`
--

INSERT INTO `documentos_concessionaria` (`id`, `id_documento`, `id_concessionaria`) VALUES
(54, 60, 50),
(55, 61, 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `etapa`
--

CREATE TABLE `etapa` (
  `id` int(11) NOT NULL,
  `etp_nome` varchar(255) DEFAULT NULL,
  `prazo_etapa` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `etapa`
--

INSERT INTO `etapa` (`id`, `etp_nome`, `prazo_etapa`) VALUES
(40, 'Pintura Enel 1', NULL),
(41, 'Pintura Enel 2', NULL),
(42, 'Pintura Enel 3', NULL),
(43, 'Pintura Enel 4', NULL),
(44, 'Pintura Enel 5', NULL),
(45, 'Projeção Enel 1', NULL),
(46, 'Projeção Enel 2', NULL),
(47, 'Projeção Enel 3', NULL),
(48, 'Projeção Enel 4', NULL),
(49, 'Projeção Enel 5', NULL),
(50, 'Construção 1', NULL),
(51, 'Construção 2', NULL),
(52, 'Construção 3', NULL),
(53, 'Projeção 1', NULL),
(54, 'Projeção 2', NULL),
(55, 'Projeção 3', NULL),
(56, 'Pintura Eson 1', NULL),
(57, 'Pintura 4', NULL),
(58, 'Projeto friboi 1', '1'),
(59, 'Projeto friboi 2', '2'),
(60, 'Projeto friboi 3', '3'),
(61, 'Construção Friboi 1', '4'),
(62, 'Construção Friboi 2', '4'),
(63, 'Construção Friboi 3', '5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `etapas_servico_concessionaria`
--

CREATE TABLE `etapas_servico_concessionaria` (
  `id` int(11) NOT NULL,
  `id_concessionaria` int(11) DEFAULT NULL,
  `id_servico` int(11) DEFAULT NULL,
  `id_etapa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `etapas_servico_concessionaria`
--

INSERT INTO `etapas_servico_concessionaria` (`id`, `id_concessionaria`, `id_servico`, `id_etapa`) VALUES
(37, 55, 6, 40),
(38, 55, 6, 41),
(39, 55, 6, 42),
(40, 55, 6, 43),
(41, 55, 6, 44),
(42, 55, 7, 45),
(43, 55, 7, 46),
(44, 55, 7, 47),
(45, 55, 7, 48),
(46, 55, 7, 49),
(47, 56, 8, 50),
(48, 56, 8, 51),
(49, 56, 8, 52),
(50, 56, 7, 53),
(51, 56, 7, 54),
(52, 56, 7, 55),
(53, 58, 6, 56),
(54, 60, 6, 57),
(55, 61, 7, 58),
(56, 61, 7, 59),
(57, 61, 7, 60),
(58, 61, 8, 61),
(59, 61, 8, 62),
(60, 61, 8, 63);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `data_notificacao` datetime DEFAULT NULL,
  `notificacao_tipo` varchar(50) DEFAULT NULL,
  `propriedades` text,
  `lido` tinyint(1) DEFAULT '0',
  `link` varchar(100) DEFAULT NULL,
  `id_company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id`, `id_user`, `data_notificacao`, `notificacao_tipo`, `propriedades`, `lido`, `link`, `id_company`) VALUES
(2, 1, NULL, 'PENDENÇA', '{\"msg\":\"Notificacao de teste\"}', 1, 'laskjrlkajsr', 1),
(3, 1, NULL, 'URGENCIA', '{\"msg\":\"Obra 55 do cliente: Marcos, pendente\"}', 1, 'alsrjklasjrljasr', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `obra`
--

CREATE TABLE `obra` (
  `id` int(11) NOT NULL,
  `id_company` int(11) DEFAULT NULL,
  `id_servico` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_concessionaria` int(11) DEFAULT NULL,
  `obr_razao_social` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `obra`
--

INSERT INTO `obra` (`id`, `id_company`, `id_servico`, `id_cliente`, `id_concessionaria`, `obr_razao_social`) VALUES
(1, 1, 6, 40, 52, 'Casa Marcos'),
(2, 1, 6, 40, 55, 'Casa Marcos'),
(3, 1, 6, 0, 55, 'Casa Gabriel'),
(4, 1, 6, 41, 55, 'Casa Gabriel'),
(5, 1, 6, 44, 60, 'Casa Luana'),
(6, 1, 7, 45, 61, 'Casa Nelly');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `params` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `id_company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `id_usuario`, `params`, `id_company`) VALUES
(1, 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25', 1),
(2, 11, '1,2,3,4', 1),
(3, 19, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_params`
--

CREATE TABLE `permission_params` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `permission_params`
--

INSERT INTO `permission_params` (`id`, `name`, `id_company`) VALUES
(1, 'dashboard_view', 1),
(2, 'user_view', 1),
(3, 'user_edit', 1),
(4, 'user_delet', 1),
(5, 'user_add', 1),
(6, 'cliente_view', 1),
(7, 'cliente_edit', 1),
(8, 'cliente_delet', 1),
(9, 'cliente_add', 1),
(10, 'concessionaria_view', 1),
(11, 'concessionaria_delete', 1),
(12, 'concessionaria_add', 1),
(13, 'concessionaria_edit', 1),
(14, 'servico_add', 1),
(15, 'servico_view', 1),
(16, 'servico_edit', 1),
(17, 'servico_delete', 1),
(18, 'obra_view', 1),
(19, 'obra_add', 1),
(20, 'obra_edit', 1),
(21, 'obra_delete', 1),
(22, 'documento_view', 1),
(23, 'documento_delete', 1),
(24, 'documento_edit', 1),
(25, 'documento_add', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `sev_nome` varchar(255) DEFAULT NULL,
  `id_company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id`, `sev_nome`, `id_company`) VALUES
(6, 'Pintura', 1),
(7, 'Projeção', 1),
(8, 'Construção', 1),
(9, 'Manutenção', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `usr_info` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `user_photo_url` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `id_group` int(11) NOT NULL,
  `id_company` int(11) DEFAULT NULL,
  `usu_ativo` varchar(45) COLLATE utf8_bin DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `password`, `usr_info`, `user_photo_url`, `id_group`, `id_company`, `usu_ativo`) VALUES
(1, 'gabriel@gabriel', 'gabriel', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 0, 1, '1'),
(11, 'luana@luana.com.br', 'luana', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 0, 1, '1'),
(16, 'Abel@Abel', 'abel', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 0, 1, '1'),
(18, '123', '123', '123', NULL, NULL, 0, 1, '1'),
(19, 'leo@leo', 'Leo', '123', NULL, NULL, 0, 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cliente_endereco`
--
ALTER TABLE `cliente_endereco`
  ADD PRIMARY KEY (`id_endereco`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concessionaria`
--
ALTER TABLE `concessionaria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concessionaria_servico`
--
ALTER TABLE `concessionaria_servico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentos_concessionaria`
--
ALTER TABLE `documentos_concessionaria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etapa`
--
ALTER TABLE `etapa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etapas_servico_concessionaria`
--
ALTER TABLE `etapas_servico_concessionaria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obra`
--
ALTER TABLE `obra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `params_idx` (`params`);

--
-- Indexes for table `permission_params`
--
ALTER TABLE `permission_params`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_idx` (`id_company`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `cliente_endereco`
--
ALTER TABLE `cliente_endereco`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `concessionaria`
--
ALTER TABLE `concessionaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `concessionaria_servico`
--
ALTER TABLE `concessionaria_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `documentos_concessionaria`
--
ALTER TABLE `documentos_concessionaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `etapa`
--
ALTER TABLE `etapa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `etapas_servico_concessionaria`
--
ALTER TABLE `etapas_servico_concessionaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `obra`
--
ALTER TABLE `obra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permission_params`
--
ALTER TABLE `permission_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `company` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
