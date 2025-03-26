-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Mar-2025 às 10:53
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estantedb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `apontamentos`
--

CREATE TABLE `apontamentos` (
  `id_apo` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `caminho_arquivo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `estado_apo` enum('aprovado','pendente','negado') NOT NULL DEFAULT 'pendente',
  `data_submissao` date NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avalicao`
--

CREATE TABLE `avalicao` (
  `id_avalicao` int(11) NOT NULL,
  `id_apo` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `avalicao` text NOT NULL,
  `data_avaliacao` date NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `id_apo` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `cometario` text DEFAULT NULL,
  `data_comentario` date NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
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
-- Estrutura da tabela `sugestao`
--

CREATE TABLE `sugestao` (
  `id_sugestao` int(11) NOT NULL,
  `id_apon` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `sugestao` text DEFAULT NULL,
  `data_sugestao` date NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id_utilizador` int(11) NOT NULL,
  `nome` varchar(12) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `secretpass` varchar(20) NOT NULL,
  `cargo` enum('cliente','moderador','administrador') NOT NULL DEFAULT 'cliente',
  `estado` enum('registado','pendente','negado') NOT NULL DEFAULT 'pendente',
  `data_registo` date NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `apontamentos`
--
ALTER TABLE `apontamentos`
  ADD PRIMARY KEY (`id_apo`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `fk_utilizador` (`id_utilizador`);

--
-- Índices para tabela `avalicao`
--
ALTER TABLE `avalicao`
  ADD PRIMARY KEY (`id_avalicao`),
  ADD KEY `fk_avaliacao_utilizador` (`id_utilizador`),
  ADD KEY `fk_avaliacao_apontamento` (`id_apo`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_comentario_apontamento` (`id_apo`),
  ADD KEY `fk_comentario_utilizador` (`id_utilizador`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices para tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disciplina`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices para tabela `sugestao`
--
ALTER TABLE `sugestao`
  ADD PRIMARY KEY (`id_sugestao`),
  ADD KEY `fk_sugestao_apon` (`id_apon`),
  ADD KEY `fk_sugestao_utilizador` (`id_utilizador`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id_utilizador`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `apontamentos`
--
ALTER TABLE `apontamentos`
  MODIFY `id_apo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avalicao`
--
ALTER TABLE `avalicao`
  MODIFY `id_avalicao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id_disciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sugestao`
--
ALTER TABLE `sugestao`
  MODIFY `id_sugestao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id_utilizador` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `apontamentos`
--
ALTER TABLE `apontamentos`
  ADD CONSTRAINT `apontamento_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`),
  ADD CONSTRAINT `apontamento_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  ADD CONSTRAINT `fk_utilizador` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`);

--
-- Limitadores para a tabela `avalicao`
--
ALTER TABLE `avalicao`
  ADD CONSTRAINT `avalicao_apontamento` FOREIGN KEY (`id_apo`) REFERENCES `apontamentos` (`id_apo`),
  ADD CONSTRAINT `avalicao_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`),
  ADD CONSTRAINT `fk_avaliacao_utilizador` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`);

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`),
  ADD CONSTRAINT `fk_comentario_apontamento` FOREIGN KEY (`id_apo`) REFERENCES `apontamentos` (`id_apo`),
  ADD CONSTRAINT `fk_comentario_utilizador` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`);

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Limitadores para a tabela `sugestao`
--
ALTER TABLE `sugestao`
  ADD CONSTRAINT `fk_apontamento_sugestao` FOREIGN KEY (`id_apon`) REFERENCES `apontamentos` (`id_apo`),
  ADD CONSTRAINT `fk_sugestao_utilizador` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`),
  ADD CONSTRAINT `sugestao_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id_utilizador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
