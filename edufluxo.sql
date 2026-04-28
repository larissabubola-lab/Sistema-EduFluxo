-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/04/2026 às 11:19
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `edufluxo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `cgm` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sala` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`cgm`, `nome`, `email`, `sala`) VALUES
(67866, 'helen', 'helen@gmail.com', '3° A'),
(74574, 'marcos', 'matheuspalma0309@gmail.com', '8° C'),
(457595, 'Pietra', 'svdvj@gmail.com', '6° C'),
(5659564, 'aluno novo', 'larissa.bubola@escola.pr.gov.br', '7° A'),
(47554257, 'teste', 'teste@gamial.com', 'outro sala'),
(54956723, 'elisa', 'larissa.bubola@escola.pr.gov.br', '6° A'),
(74642472, 'helena', 'helena@escola.pr.gov.br', '2° D'),
(384624956, 'teodrore', 'maria.souza@gmail.com', '8° C'),
(784789545, 'banco ta funcionando', 'banco@gamil.com', '7° A'),
(2147483647, 'teresa', 'larissa.bubola@escola.pr.gov.br', '6° C');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fluxo_saidas`
--

CREATE TABLE `fluxo_saidas` (
  `id` int(11) NOT NULL,
  `cgm` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `serie` varchar(50) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `data` varchar(50) NOT NULL,
  `motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fluxo_saidas`
--

INSERT INTO `fluxo_saidas` (`id`, `cgm`, `nome`, `serie`, `usuario`, `data`, `motivo`) VALUES
(8, 457595, 'Pietra', '6° C', 'Larissa', '19/04/2026', 'O aluno chegou atrasado'),
(9, 5659564, 'aluno novo', '7° A', 'Larissa', '25/04/2026', 'O aluno saiu mais cedo'),
(10, 47554257, 'teste', 'outro sala', 'Larissa', '25/04/2026', 'texto grande so para ri ver o que acpntece'),
(11, 67866, 'helen', '3° A', 'Larissa', '25/04/2026', 'o aluno teve que sair mais cedo devido uma consulta do dentista mas vai voltar mais tarde lorem ipsum'),
(12, 457595, 'Pietra', '6° C', 'Larissa', '25/04/2026', 'O aluno chegou atrasado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocorrencias`
--

CREATE TABLE `ocorrencias` (
  `id` int(11) NOT NULL,
  `cgm` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `serie` varchar(50) NOT NULL,
  `relator` varchar(100) NOT NULL,
  `data` varchar(50) NOT NULL,
  `tipo` enum('positiva','negativa','','') NOT NULL,
  `motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ocorrencias`
--

INSERT INTO `ocorrencias` (`id`, `cgm`, `nome`, `serie`, `relator`, `data`, `tipo`, `motivo`) VALUES
(4, 5659564, 'aluno novo', '7° A', 'Larissa', '06/04/2026', 'positiva', 'aaa'),
(5, 457595, 'Pietra', '6° C', 'Larissa', '06/04/2026', 'negativa', 'ruim'),
(6, 67866, 'helen', '3° A', 'Larissa', '06/04/2026', 'positiva', 'boa'),
(7, 5659564, 'aluno novo', '7° A', 'Larissa', '27/04/2026', 'positiva', 'yigrfowrgfrps'),
(8, 784789545, 'banco ta funcionando', '7° A', 'Larissa', '27/04/2026', 'positiva', 'lotem ipsum'),
(9, 67866, 'helen', '3° A', 'Larissa', '27/04/2026', 'negativa', 'ocorrencia ruim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `cpf` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `permissao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`cpf`, `nome`, `email`, `senha`, `permissao`) VALUES
('139.840.669.45', 'Larissa', 'larissa.bubola@escola.pr.gov.br', '1234', 0),
('458605705', 'Amanda Leticia', 'larissa.bubola@escola.pr.gov.br', '1234', 1),
('463.443.975.23', 'Pedro', 'pedro.lopes@escola.pr.gov.br', '1234', 1),
('4765504264', 'Sandra', 'aaaa@gamil.com', '1234', 2),
('563.345.656.00', 'Maria', 'maria.souza@gmail.com', '1234', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`cgm`);

--
-- Índices de tabela `fluxo_saidas`
--
ALTER TABLE `fluxo_saidas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `fluxo_saidas`
--
ALTER TABLE `fluxo_saidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
