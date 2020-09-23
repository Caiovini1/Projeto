-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22-Set-2020 às 03:06
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

create database cadastros;
use cadastros;


-- --------------------------------------------------------

--
-- Estrutura da tabela `estadocivil`
--

DROP TABLE IF EXISTS `estadocivil`;
CREATE TABLE IF NOT EXISTS `estadocivil` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estadocivil`
--

INSERT INTO `estadocivil` (`id`, `descricao`) VALUES
(1, 'Solteiro'),
(2, 'Casado'),
(3, 'Divorciado'),
(4, 'Convivente'),
(5, 'Enrolado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE IF NOT EXISTS `pessoa` (
  `idPessoa` int(10) NOT NULL AUTO_INCREMENT,
  `razaoSocial` varchar(130) NOT NULL,
  `nomeFantasia` varchar(130) NOT NULL,
  `telefone` varchar(18) NOT NULL,
  `email` varchar(200) NOT NULL,
  `idEstadoCivil` int(5) NOT NULL,
  PRIMARY KEY (`idPessoa`),
  KEY `pessoa_ibfk_1` (`idEstadoCivil`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`idPessoa`, `razaoSocial`, `nomeFantasia`, `telefone`, `email`, `idEstadoCivil`) VALUES
(126, 'Oliver Nicolas Vitor Moura', 'Vitor Moura', '(86) 2920-288', 'olivernicolasvitormoura__olivernicolasvitormoura@iblojas.com.br', 3),
(127, 'Geraldo Raimundo Oliveira', 'Oliveira', '(68) 3933-260', 'geraldoraimundooliveira__geraldoraimundooliveira@midiasim.com.br', 2),
(128, 'Sandra e Edson Inf', 'Sandra e Edson Informática Ltda', '(11) 2984-756', 'posvenda@sandraeedsoninformaticaltda.com.br', 2),
(129, 'Dani e Davi', 'Daniela e Davi Informática ME', '(11) 2655-6178', 'sistema@danielaedaviinformaticame.com.br', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoafisica`
--

DROP TABLE IF EXISTS `pessoafisica`;
CREATE TABLE IF NOT EXISTS `pessoafisica` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idPessoa` int(10) NOT NULL,
  `rg` varchar(18) NOT NULL,
  `cpf` varchar(18) NOT NULL,
  PRIMARY KEY (`id`,`idPessoa`),
  KEY `FK_idPessoa` (`idPessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoafisica`
--

INSERT INTO `pessoafisica` (`id`, `idPessoa`, `rg`, `cpf`) VALUES
(47, 126, '17.773.547-8', '945.097.667-85'),
(48, 127, '14.387.198-5', '769.711.820-30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoajuridica`
--

DROP TABLE IF EXISTS `pessoajuridica`;
CREATE TABLE IF NOT EXISTS `pessoajuridica` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idPessoa` int(10) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  PRIMARY KEY (`id`,`idPessoa`),
  KEY `FK_idPessoaCNPJ` (`idPessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoajuridica`
--

INSERT INTO `pessoajuridica` (`id`, `idPessoa`, `cnpj`) VALUES
(2, 128, '15.101.745/0001-14'),
(3, 129, 'Daniela e Davi Inf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(130) NOT NULL,
  `login` varchar(130) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `login`, `senha`) VALUES
(6, 'Administrador', 'admin', '123456');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `pessoa_ibfk_1` FOREIGN KEY (`idEstadoCivil`) REFERENCES `estadocivil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pessoafisica`
--
ALTER TABLE `pessoafisica`
  ADD CONSTRAINT `FK_idPessoa` FOREIGN KEY (`idPessoa`) REFERENCES `pessoa` (`idPessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pessoajuridica`
--
ALTER TABLE `pessoajuridica`
  ADD CONSTRAINT `FK_idPessoaCNPJ` FOREIGN KEY (`idPessoa`) REFERENCES `pessoa` (`idPessoa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
