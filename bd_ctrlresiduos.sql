-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 29-Out-2021 às 21:47
-- Versão do servidor: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.1.33-34+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_ctrlresiduos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aterro`
--

CREATE TABLE `aterro` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aterro`
--

INSERT INTO `aterro` (`id`, `nome`) VALUES
(1, 'Brusque'),
(2, 'Canoinhas'),
(3, 'Blumenau');

-- --------------------------------------------------------

--
-- Estrutura da tabela `caminhao`
--

CREATE TABLE `caminhao` (
  `id` int(11) NOT NULL,
  `proprietario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caminhao`
--

INSERT INTO `caminhao` (`id`, `proprietario`) VALUES
(1, 'Sergio'),
(2, 'Hector'),
(3, 'Davi'),
(4, 'Diego'),
(5, 'Olivia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `devedor`
--

CREATE TABLE `devedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `devedor`
--

INSERT INTO `devedor` (`id`, `nome`) VALUES
(1, 'Conti'),
(2, 'Omar'),
(3, 'Jose'),
(4, 'Marcos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacao`
--

CREATE TABLE `movimentacao` (
  `id` int(11) NOT NULL,
  `aterro_id` int(11) NOT NULL,
  `caminhao_id` int(11) NOT NULL,
  `devedor_id` int(11) NOT NULL,
  `tipo_residuo_id` int(11) NOT NULL,
  `volume` float(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `movimentacao`
--

INSERT INTO `movimentacao` (`id`, `aterro_id`, `caminhao_id`, `devedor_id`, `tipo_residuo_id`, `volume`) VALUES
(1, 1, 1, 1, 1, 10.00),
(2, 2, 2, 2, 2, 14.00),
(4, 1, 3, 3, 1, 14.00),
(5, 1, 1, 1, 3, 22.00),
(6, 3, 4, 4, 4, 15.00),
(7, 2, 5, 1, 1, 17.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_residuo`
--

CREATE TABLE `tipo_residuo` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_residuo`
--

INSERT INTO `tipo_residuo` (`id`, `nome`) VALUES
(1, 'Lixo'),
(2, 'Construção'),
(3, 'Estrume'),
(4, 'Detergentes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aterro`
--
ALTER TABLE `aterro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `caminhao`
--
ALTER TABLE `caminhao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devedor`
--
ALTER TABLE `devedor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_movimentacao_aterro_id` (`aterro_id`) USING BTREE,
  ADD KEY `idx_movimentacao_devedor_id` (`devedor_id`) USING BTREE,
  ADD KEY `idx_movimentacao_caminhao_id` (`caminhao_id`) USING BTREE,
  ADD KEY `idx_movimentacao_tipo_residuo_id` (`tipo_residuo_id`) USING BTREE;

--
-- Indexes for table `tipo_residuo`
--
ALTER TABLE `tipo_residuo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aterro`
--
ALTER TABLE `aterro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `caminhao`
--
ALTER TABLE `caminhao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `devedor`
--
ALTER TABLE `devedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tipo_residuo`
--
ALTER TABLE `tipo_residuo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD CONSTRAINT `fk_movimentacao_aterro_id` FOREIGN KEY (`aterro_id`) REFERENCES `aterro` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_movimentacao_caminhao_id` FOREIGN KEY (`caminhao_id`) REFERENCES `caminhao` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_movimentacao_devedor_id` FOREIGN KEY (`devedor_id`) REFERENCES `devedor` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_movimentacao_tipo_residuo_id` FOREIGN KEY (`tipo_residuo_id`) REFERENCES `tipo_residuo` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
