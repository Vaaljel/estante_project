-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2025 at 07:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estantedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `apontamento`
--

CREATE TABLE `apontamento` (
  `id_apo` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `caminho_arquivo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `estado_apo` enum('aprovado','pendente','negado') NOT NULL DEFAULT 'pendente',
  `data_submissao` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `avalicao`
--

CREATE TABLE `avalicao` (
  `id_avalicao` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `avalicao` text NOT NULL,
  `data_avaliacao` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `cometario` text DEFAULT NULL,
  `data_comentario` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disciplina`
--

CREATE TABLE `disciplina` (
  `id_disciplina` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codigo` int(11) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sugestao`
--

CREATE TABLE `sugestao` (
  `id_sugestao` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `sugestao` text DEFAULT NULL,
  `data_sugestao` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id_utilizador` int(11) NOT NULL,
  `nome` varchar(12) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `secretpass` varchar(20) NOT NULL,
  `cargo` enum('cliente','moderador','administrador') NOT NULL DEFAULT 'cliente',
  `estado` enum('registado','pendente','negado') NOT NULL DEFAULT 'pendente',
  `data_registo` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apontamento`
--
ALTER TABLE `apontamento`
  ADD PRIMARY KEY (`id_apo`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `fk_utilizador` (`id_utilizador`);

--
-- Indexes for table `avalicao`
--
ALTER TABLE `avalicao`
  ADD PRIMARY KEY (`id_avalicao`),
  ADD KEY `fk_avaliacao_utilizador` (`id_utilizador`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_comentario_utilizador` (`id_utilizador`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disciplina`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indexes for table `sugestao`
--
ALTER TABLE `sugestao`
  ADD PRIMARY KEY (`id_sugestao`),
  ADD KEY `fk_sugestao_utilizador` (`id_utilizador`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id_utilizador`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apontamento`
--
ALTER TABLE `apontamento`
  MODIFY `id_apo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `avalicao`
--
ALTER TABLE `avalicao`
  MODIFY `id_avalicao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id_disciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sugestao`
--
ALTER TABLE `sugestao`
  MODIFY `id_sugestao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id_utilizador` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apontamento`
--
ALTER TABLE `apontamento`
  ADD CONSTRAINT `apontamento_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`),
  ADD CONSTRAINT `apontamento_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  ADD CONSTRAINT `fk_utilizador` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`);

--
-- Constraints for table `avalicao`
--
ALTER TABLE `avalicao`
  ADD CONSTRAINT `avalicao_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`),
  ADD CONSTRAINT `fk_avaliacao_utilizador` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`);

--
-- Constraints for table `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`),
  ADD CONSTRAINT `fk_comentario_utilizador` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`);

--
-- Constraints for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Constraints for table `sugestao`
--
ALTER TABLE `sugestao`
  ADD CONSTRAINT `fk_sugestao_utilizador` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`),
  ADD CONSTRAINT `sugestao_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
