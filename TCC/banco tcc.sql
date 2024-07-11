-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Nov-2022 às 13:16
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc_barbearia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_agendamentos`
--

CREATE TABLE `tb_agendamentos` (
  `ag_cod` int(4) NOT NULL,
  `ag_data` date NOT NULL,
  `ag_hora` time NOT NULL,
  `ag_cort_cabelo` int(4) NOT NULL,
  `ag_cort_barba` int(4) NOT NULL,
  `ag_tp_pag` varchar(8) NOT NULL,
  `ag_obs` varchar(50) DEFAULT NULL,
  `log_cod_ag` bigint(11) UNSIGNED ZEROFILL NOT NULL,
  `func_cod_ag` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_agendamentos`
--

INSERT INTO `tb_agendamentos` (`ag_cod`, `ag_data`, `ag_hora`, `ag_cort_cabelo`, `ag_cort_barba`, `ag_tp_pag`, `ag_obs`, `log_cod_ag`, `func_cod_ag`) VALUES
(83, '2022-07-30', '10:30:00', 1, 5, 'Cartao', '', 06433193951, 66666666666),
(84, '2022-07-30', '11:20:00', 5, 5, 'Pix', '', 76138780906, 77777777777),
(91, '2022-07-30', '13:50:00', 5, 1, 'Dinheiro', 'cortar na 3', 11111111111, 66666666666),
(99, '2022-08-06', '13:30:00', 15, 10, 'Pix', '', 11111111111, 77777777777),
(134, '2022-08-07', '08:20:00', 1, 5, 'Dinheiro', '', 06433193951, 99999999999),
(135, '2022-08-07', '10:00:00', 2, 4, 'Pix', '', 11111111111, 66666666666),
(136, '2022-08-10', '13:30:00', 13, 10, 'Dinheiro', ' Sem  máquina ', 12658569904, 99999999999),
(141, '2022-08-10', '09:00:00', 13, 0, 'Dinheiro', '', 06433193951, 99999999999),
(143, '2022-08-16', '08:20:00', 2, 0, 'Pix', 'cortar na 3', 55555555555, 66666666666),
(145, '2022-08-17', '09:00:00', 2, 0, 'Dinheiro', '', 06433193951, 99999999999),
(146, '2022-08-19', '08:40:00', 2, 0, 'Dinheiro', '', 11111111111, 99999999999),
(147, '2022-08-18', '08:00:00', 2, 0, 'Pix', '', 06433193951, 66666666666),
(148, '2022-08-18', '08:40:00', 1, 1, 'Dinheiro', '', 11111111111, 77777777777),
(150, '2022-08-24', '10:00:00', 15, 5, 'Pix', '', 11111111111, 66666666666),
(151, '2022-08-24', '12:00:00', 2, 4, 'Dinheiro', '', 11111111111, 77777777777);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_corte_barba`
--

CREATE TABLE `tb_corte_barba` (
  `tp_barba_cod` int(4) NOT NULL,
  `tp_barba_nome` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_corte_barba`
--

INSERT INTO `tb_corte_barba` (`tp_barba_cod`, `tp_barba_nome`) VALUES
(0, 'Não selecionado'),
(1, 'Personalizado'),
(4, 'Cheia'),
(5, 'Degrade'),
(10, 'Curta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_corte_cabelo`
--

CREATE TABLE `tb_corte_cabelo` (
  `tp_cabelo_cod` int(4) NOT NULL,
  `tp_cabelo_nome` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_corte_cabelo`
--

INSERT INTO `tb_corte_cabelo` (`tp_cabelo_cod`, `tp_cabelo_nome`) VALUES
(0, 'Não selecionado'),
(1, 'Personalizado'),
(2, 'Militar'),
(3, 'Pompadour'),
(5, 'Razor'),
(13, 'coque samurai'),
(15, 'Social');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_horarios`
--

CREATE TABLE `tb_horarios` (
  `hr_cod` int(4) NOT NULL,
  `hr_func_cod` bigint(11) UNSIGNED ZEROFILL NOT NULL,
  `hr_hora` time NOT NULL,
  `hr_disponivel` varchar(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_horarios`
--

INSERT INTO `tb_horarios` (`hr_cod`, `hr_func_cod`, `hr_hora`, `hr_disponivel`) VALUES
(7, 77777777777, '08:20:00', 'f'),
(10, 99999999999, '10:00:00', 'f'),
(11, 99999999999, '08:20:00', 'f'),
(12, 99999999999, '08:40:00', 'f'),
(13, 99999999999, '09:00:00', 'f'),
(14, 77777777777, '08:40:00', 'f'),
(15, 77777777777, '12:00:00', 'f'),
(16, 77777777777, '13:30:00', 'f'),
(18, 77777777777, '09:00:00', 'v'),
(19, 77777777777, '08:00:00', 'f'),
(21, 66666666666, '08:00:00', 'f'),
(22, 66666666666, '09:00:00', 'f'),
(24, 66666666666, '10:00:00', 'f'),
(25, 99999999999, '10:40:00', 'v'),
(26, 33333333333, '18:30:00', 'v');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `us_cpf` bigint(11) UNSIGNED ZEROFILL NOT NULL,
  `us_nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `us_tell` bigint(11) NOT NULL,
  `us_dat_nasc` date NOT NULL,
  `us_sexo` varchar(1) COLLATE utf8_unicode_ci NOT NULL CHECK (us_sexo = 'f' OR us_sexo = 'm'),
  `us_senha` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `us_situacao` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL CHECK (us_situacao = 'atv' OR us_situacao = 'blk'),
  `us_tipo` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL CHECK (us_tipo = 'func' OR us_tipo = 'adm' OR us_tipo = 'cli')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`us_cpf`, `us_nome`, `us_tell`, `us_dat_nasc`, `us_sexo`, `us_senha`, `us_situacao`, `us_tipo`) VALUES
(06433193951, 'Guilherme H. P. Cravo', 45999677290, '2004-08-23', 'm', '8eb53d8b6d23b6c96a6d8cf6845420ff', 'atv', 'adm'),
(11111111111, 'Paulo', 45999999999, '2000-01-10', 'm', 'aa1bf4646de67fd9086cf6c79007026c', 'atv', 'cli'),
(12658569904, 'João dos santos', 45999933585, '2004-07-18', 'm', '08c390c26796253169488e3b3433b107', 'atv', 'cli'),
(13891360940, 'Karen Cristina dos Santos Silva', 45998323113, '2004-01-23', 'f', '13f44293273c220b156f36546d84695d', 'atv', 'cli'),
(22222222222, 'mara', 99999999991, '2000-02-01', 'f', '0c8d209966c8154c43ef97bb1ba5e5e0', 'atv', 'cli'),
(33333333333, 'luiza', 89498464698, '1980-02-10', 'f', '46d045ff5190f6ea93739da6c0aa19bc', 'atv', 'func'),
(44444444444, 'Jurandir', 45998648120, '1990-02-01', 'm', 'c33367701511b4f6020ec61ded352059', 'atv', 'atd'),
(55555555555, 'Luiz', 99999999993, '2000-02-08', 'm', '698dc19d489c4e4db73e28a713eab07b', 'atv', 'cli'),
(66666666666, 'marcos', 77777777777, '1994-02-16', 'm', '6562c5c1f33db6e05a082a88cddab5ea', 'atv', 'func'),
(76138780906, 'Aparecida Ferreira', 45999003009, '2022-02-14', 'f', 'b172e83da9efee1b8ff65728cf0a7754', 'atv', 'cli'),
(77777777777, 'João', 45999999919, '2000-01-23', 'm', 'e10adc3949ba59abbe56e057f20f883e', 'atv', 'func'),
(88132617991, 'Zildo Pimentel Cravo', 45999819831, '1980-02-01', 'm', '22d1e5617698887abf5e53aac439cd6e', 'atv', 'func'),
(88888888888, 'Ana', 88888888888, '2000-01-01', 'f', 'cd762ef822be9c0c8b1d8b2c3633eddf', 'atv', 'cli'),
(99999999999, 'Lucas', 99999999992, '2000-02-05', 'm', 'd964173dc44da83eeafa3aebbee9a1a0', 'atv', 'func');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_agendamentos`
--
ALTER TABLE `tb_agendamentos`
  ADD PRIMARY KEY (`ag_cod`),
  ADD KEY `log_cod_ag` (`log_cod_ag`);

--
-- Índices para tabela `tb_corte_barba`
--
ALTER TABLE `tb_corte_barba`
  ADD PRIMARY KEY (`tp_barba_cod`);

--
-- Índices para tabela `tb_corte_cabelo`
--
ALTER TABLE `tb_corte_cabelo`
  ADD PRIMARY KEY (`tp_cabelo_cod`);

--
-- Índices para tabela `tb_horarios`
--
ALTER TABLE `tb_horarios`
  ADD PRIMARY KEY (`hr_cod`),
  ADD KEY `hr_func_cod` (`hr_func_cod`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`us_cpf`),
  ADD UNIQUE KEY `us_nome` (`us_nome`),
  ADD UNIQUE KEY `us_tell` (`us_tell`),
  ADD UNIQUE KEY `its_unicos_us` (`us_cpf`,`us_nome`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_agendamentos`
--
ALTER TABLE `tb_agendamentos`
  MODIFY `ag_cod` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT de tabela `tb_corte_barba`
--
ALTER TABLE `tb_corte_barba`
  MODIFY `tp_barba_cod` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tb_corte_cabelo`
--
ALTER TABLE `tb_corte_cabelo`
  MODIFY `tp_cabelo_cod` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_horarios`
--
ALTER TABLE `tb_horarios`
  MODIFY `hr_cod` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_agendamentos`
--
ALTER TABLE `tb_agendamentos`
  ADD CONSTRAINT `tb_agendamentos_ibfk_1` FOREIGN KEY (`log_cod_ag`) REFERENCES `tb_usuarios` (`us_cpf`);

--
-- Limitadores para a tabela `tb_horarios`
--
ALTER TABLE `tb_horarios`
  ADD CONSTRAINT `tb_horarios_ibfk_1` FOREIGN KEY (`hr_func_cod`) REFERENCES `tb_usuarios` (`us_cpf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

