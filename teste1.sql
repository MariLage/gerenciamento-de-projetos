-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/02/2026 às 16:59
-- Versão do servidor: 10.4.32
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste1`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '1234', '2026-01-30 11:59:55');

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `nome_original` varchar(255) NOT NULL,
  `caminho_arquivo` varchar(255) NOT NULL,
  `data_upload` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `list`
--

CREATE TABLE `list` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_nopad_ci NOT NULL,
  `task_description` text CHARACTER SET latin1 COLLATE latin1_swedish_nopad_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) DEFAULT NULL,
  `DepartmentCode` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`, `DepartmentCode`, `CreationDate`) VALUES
(1, 'Departamento de RH', 'RH', 'HR01', '2023-08-31 14:50:20'),
(2, 'Departamento de TI', 'Ti', 'IT01', '2023-08-31 14:50:56'),
(3, 'Dip', 'Dip', 'ACCNT01', '2023-08-31 14:51:26'),
(4, 'ADMIN', 'Admin', 'ADMN01', '2023-09-01 11:35:50'),
(6, 'Departamento tal', 'Dt', '456', '2026-02-09 12:24:02');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tblemployees`
--

CREATE TABLE `tblemployees` (
  `id` int(11) NOT NULL,
  `EmpId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FirstName` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LastName` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EmailId` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Gender` varchar(100) DEFAULT NULL,
  `DataNasc` varchar(100) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Country` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phonenumber` char(12) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tblemployees`
--

INSERT INTO `tblemployees` (`id`, `EmpId`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `DataNasc`, `Department`, `Address`, `City`, `Country`, `Phonenumber`, `Status`, `RegDate`) VALUES
(1, '10805121', 'Rahul', 'Kumar', '111@teste.com', '12345', 'Male', '3 August, 1995', 'Information Technology', 'A 123 XYZ Apartment ', 'New Delhi', 'India', '12121212', 0, '2026-01-30 11:56:23'),
(2, '10235612', 'Garima', 'Yadav', 'grama123@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'Female', '2 January, 1997', 'Accounts', 'Hno 123 ABC Colony', 'New Delhi', 'India', '7485963210', 1, '2023-08-31 15:02:47'),
(5, '7856214', 'John', 'Doe', 'jhn12@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'Male', '3 January, 1995', 'Accounts', 'H no 1', 'Ghaziabad ', 'India', '23232323', 1, '2023-09-01 11:38:23'),
(6, '123456', 'Marina', 'Lage', 'ml@gmail.com', '1234mls', 'feminino', '03/04/1999', 'Departamento de TI', 'rua nao sei oque, 3', 'Rio de janeiro', 'Brasil', '21966455115', 1, '2026-01-30 12:40:58'),
(9, '888888', 'oi', 'oi', 'oi@gmail.com', 'a2e63ee01401aaeca78be023dfbb8c59', 'Other', '2006-04-03', 'Departamento de TI', 'não sei', 'são paulo', 'brasil', '1231231231', 0, '2026-02-05 15:52:46'),
(11, '33333', 'dede', 'fafa', 'oii@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Other', '2008-12-02', 'ADMIN', 'rua n sei oq', 'rio de janeiro', 'brasil', '21966435115', 1, '2026-02-09 12:42:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tblprojects`
--

CREATE TABLE `tblprojects` (
  `id` int(11) NOT NULL,
  `ProjectType` varchar(110) DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `IsRead` int(1) DEFAULT NULL,
  `empid` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tblprojects`
--

INSERT INTO `tblprojects` (`id`, `ProjectType`, `to_date`, `from_date`, `Description`, `PostingDate`, `AdminRemark`, `AdminRemarkDate`, `Status`, `IsRead`, `empid`) VALUES
(11, 'Projeto simples', '2026-01-10', '2026-03-10', 'aaaaa', '2023-08-31 15:06:21', 'Concluida', '2026-03-29 20:39:40 ', 1, 1, 1),
(12, 'Projeto complexo', '2026-03-10', '2025-01-25', 'aaaa', '2023-09-01 11:42:40', 'Em andamento', '2025-12-07 10:13:20 ', 0, 1, 5),
(18, 'Projeto complexo', '2026-06-10', '2026-03-03', 'werewrw', '2026-02-05 13:00:59', 'adada', '2026-02-05 18:46:02 ', 2, 1, 6),
(23, 'Projeto comum', '2026-06-20', '2026-02-10', 'aaa', '2026-02-05 13:55:02', NULL, NULL, 0, 1, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tblprojecttype`
--

CREATE TABLE `tblprojecttype` (
  `id` int(11) NOT NULL,
  `ProjectType` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tblprojecttype`
--

INSERT INTO `tblprojecttype` (`id`, `ProjectType`, `Description`, `CreationDate`) VALUES
(1, 'Projeto comum', 'Projeto comum', '2023-08-31 14:52:22'),
(2, 'Projeto complexo', 'Projetos complexos', '2023-08-31 14:52:49'),
(3, 'Projeto simples', 'Projeto simples', '2023-08-31 14:53:15'),
(6, 'Projeto sustentavel', 'Projeto sustentavel', '2026-02-09 12:24:30');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tblprojects`
--
ALTER TABLE `tblprojects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`empid`);

--
-- Índices de tabela `tblprojecttype`
--
ALTER TABLE `tblprojecttype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tblprojects`
--
ALTER TABLE `tblprojects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `tblprojecttype`
--
ALTER TABLE `tblprojecttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
