-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Nov-2018 às 03:48
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `preetec`
--
CREATE DATABASE IF NOT EXISTS `preetec` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `preetec`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` mediumint(8) UNSIGNED NOT NULL,
  `id_responsavel` mediumint(8) UNSIGNED DEFAULT NULL,
  `id_turma` tinyint(3) UNSIGNED DEFAULT NULL,
  `data_matricula` date NOT NULL,
  `data_nascimento_aluno` date NOT NULL,
  `rg_aluno` varchar(14) DEFAULT NULL,
  `cpf` char(11) DEFAULT NULL,
  `rua_aluno` varchar(60) NOT NULL,
  `numero_aluno` varchar(5) NOT NULL,
  `bairro_aluno` varchar(60) NOT NULL,
  `cidade_aluno` varchar(60) NOT NULL,
  `complemento_aluno` varchar(100) DEFAULT NULL,
  `cep_aluno` char(8) DEFAULT NULL,
  `escolaridade` enum('Ensino_fundamental_cursando','Ensino_fundamental_concluido','Ensino_medio_cursando','Ensino_medio_concluido') NOT NULL,
  `escola` varchar(120) NOT NULL,
  `matriculado` tinyint(1) NOT NULL DEFAULT '0',
  `status_aluno` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `id_responsavel`, `id_turma`, `data_matricula`, `data_nascimento_aluno`, `rg_aluno`, `cpf`, `rua_aluno`, `numero_aluno`, `bairro_aluno`, `cidade_aluno`, `complemento_aluno`, `cep_aluno`, `escolaridade`, `escola`, `matriculado`, `status_aluno`) VALUES
(1, 2, 9, '2018-11-10', '2000-10-25', '51635441621461', '16416154747', 'pari', '102', 'penha', 'sp', 'Proximo ao BrÃ¡s', '15248256', 'Ensino_medio_concluido', 'Nossa Senhora da Pari', 1, 1),
(2, 4, 9, '2018-11-10', '2001-06-21', '123125421-X', '45698235642', 'N/A', 'N/A', 'N/A', 'N/A', 'na', '43612312', 'Ensino_fundamental_concluido', 'na', 1, 1),
(5, 2, 10, '2018-11-20', '2002-12-20', '145362958-0', '14524524524', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '12123123', 'Ensino_medio_concluido', 'N/A', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamada`
--

CREATE TABLE `chamada` (
  `id_chamada` int(10) UNSIGNED NOT NULL,
  `id_turma` tinyint(3) UNSIGNED DEFAULT NULL,
  `id_aluno` mediumint(8) UNSIGNED DEFAULT NULL,
  `id_professor` smallint(5) UNSIGNED DEFAULT NULL,
  `data_chamada` date NOT NULL,
  `presenca` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chamada`
--

INSERT INTO `chamada` (`id_chamada`, `id_turma`, `id_aluno`, `id_professor`, `data_chamada`, `presenca`) VALUES
(6, 1, 1, 1, '2018-11-16', 1),
(13, 9, 1, 1, '2018-11-19', 1),
(14, 9, 2, 1, '2018-11-19', 0),
(15, 9, 2, 1, '2018-11-18', 0),
(16, 9, 1, 1, '2018-11-18', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id_disciplina` tinyint(3) UNSIGNED NOT NULL,
  `nome_disciplina` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`id_disciplina`, `nome_disciplina`) VALUES
(1, 'PortuguÃªs'),
(2, 'Java'),
(3, 'CiÃªncia de Dados');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_ministrada`
--

CREATE TABLE `disciplina_ministrada` (
  `id_professor` smallint(5) UNSIGNED NOT NULL,
  `id_disciplina` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina_ministrada`
--

INSERT INTO `disciplina_ministrada` (`id_professor`, `id_disciplina`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricao`
--

CREATE TABLE `inscricao` (
  `id_inscricao` mediumint(8) UNSIGNED NOT NULL,
  `data_inscricao` datetime NOT NULL,
  `nome_aluno` varchar(120) NOT NULL,
  `sexo_aluno` enum('MASCULINO','FEMININO','OUTRO') NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `telefone_contato` char(10) DEFAULT NULL,
  `celular_contato` char(11) DEFAULT NULL,
  `inscrito` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `inscricao`
--

INSERT INTO `inscricao` (`id_inscricao`, `data_inscricao`, `nome_aluno`, `sexo_aluno`, `email`, `telefone_contato`, `celular_contato`, `inscrito`) VALUES
(1, '2018-07-23 22:27:37', 'Fabio Puentes', 'MASCULINO', 'email@gmail.com', '1143434343', '11979797979', 1),
(2, '2018-08-09 17:42:08', 'Francisco de Alguma Coisa', 'MASCULINO', 'xico.eumesmo@gmail.com', '1145213562', '11952632563', 1),
(5, '2018-08-09 17:43:41', 'Otavio', 'MASCULINO', '25@25', '', '', 1),
(6, '2018-08-09 17:43:54', 'Sergio', 'MASCULINO', 'sergio.oficial@gmail.com', '', '', 0),
(7, '2018-10-18 03:56:10', 'Lucas RomÃ£o Gomes', 'MASCULINO', 'teste@teste.com.br', '1145245245', '11959595959', 0),
(8, '2018-11-12 23:51:38', 'Renan de Souza', 'MASCULINO', 'renanExtreme@yahoo.com', '1143434343', '11979797979', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id_login` smallint(5) UNSIGNED NOT NULL,
  `nome_usuario` varchar(24) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `tipo_usuario` enum('PROFESSOR','ADMINISTRADOR','DATASHOW') NOT NULL DEFAULT 'PROFESSOR',
  `status_login` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id_login`, `nome_usuario`, `senha`, `tipo_usuario`, `status_login`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'ADMINISTRADOR', 1),
(2, 'prof', '202cb962ac59075b964b07152d234b70', 'PROFESSOR', 1),
(3, 'inativo', '202cb962ac59075b964b07152d234b70', 'PROFESSOR', 0),
(4, '15324675985', '21a910dcb1b6c8a50adcebd1f2999018', 'PROFESSOR', 1),
(5, 'data', '202cb962ac59075b964b07152d234b70', 'DATASHOW', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano_aula`
--

CREATE TABLE `plano_aula` (
  `id_plano` mediumint(8) UNSIGNED NOT NULL,
  `id_professor` smallint(5) UNSIGNED DEFAULT NULL,
  `id_disciplina` tinyint(3) UNSIGNED DEFAULT NULL,
  `titulo` varchar(40) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `plano_aula`
--

INSERT INTO `plano_aula` (`id_plano`, `id_professor`, `id_disciplina`, `titulo`, `descricao`) VALUES
(1, 1, 2, 'Poo no Java', 'Linguagens informatizadas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `id_professor` smallint(5) UNSIGNED NOT NULL,
  `data_nascimento_professor` date NOT NULL,
  `nome_professor` varchar(120) NOT NULL,
  `sexo_professor` enum('MASCULINO','FEMININO','OUTRO') NOT NULL,
  `cpf` char(11) NOT NULL,
  `rg_professor` varchar(14) DEFAULT NULL,
  `rua_professor` varchar(60) NOT NULL,
  `numero_professor` varchar(5) NOT NULL,
  `bairro_professor` varchar(60) NOT NULL,
  `cidade_professor` varchar(60) NOT NULL,
  `complemento_professor` varchar(100) DEFAULT NULL,
  `cep_professor` char(8) DEFAULT NULL,
  `telefone_professor` char(10) DEFAULT NULL,
  `celular_professor` char(11) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `formacao` varchar(120) NOT NULL,
  `status_professor` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `data_nascimento_professor`, `nome_professor`, `sexo_professor`, `cpf`, `rg_professor`, `rua_professor`, `numero_professor`, `bairro_professor`, `cidade_professor`, `complemento_professor`, `cep_professor`, `telefone_professor`, `celular_professor`, `email`, `formacao`, `status_professor`) VALUES
(1, '1982-06-12', 'Airton Teste', 'MASCULINO', '15324675985', NULL, 'CDsdds', '1240', 'xvxcv', 'xcv', NULL, '15246251', NULL, NULL, NULL, 'cvxc', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` smallint(5) UNSIGNED NOT NULL,
  `id_sala` tinyint(3) UNSIGNED DEFAULT NULL,
  `id_professor` smallint(5) UNSIGNED DEFAULT NULL,
  `data_reserva` date NOT NULL,
  `obs` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `id_sala`, `id_professor`, `data_reserva`, `obs`) VALUES
(1, 2, 1, '2018-11-17', '1234'),
(2, 2, 1, '2018-11-14', '1523'),
(4, 2, 1, '2018-11-21', 'ops nÃ£o aceita \'Cedilha\''),
(5, 2, 1, '2018-11-19', '123123123'),
(6, 1, 1, '2018-11-20', '78964545'),
(7, 1, 1, '2018-11-19', '7445454');

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsavel`
--

CREATE TABLE `responsavel` (
  `id_responsavel` mediumint(8) UNSIGNED NOT NULL,
  `nome_responsavel` varchar(120) NOT NULL,
  `sexo_responsavel` enum('MASCULINO','FEMININO','OUTRO') NOT NULL,
  `data_nascimento_responsavel` date NOT NULL,
  `cpf` char(11) DEFAULT NULL,
  `rg_responsavel` varchar(14) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `status_responsavel` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `responsavel`
--

INSERT INTO `responsavel` (`id_responsavel`, `nome_responsavel`, `sexo_responsavel`, `data_nascimento_responsavel`, `cpf`, `rg_responsavel`, `email`, `status_responsavel`) VALUES
(2, 'Pai do Ano', 'MASCULINO', '1980-07-14', '10231313654', '45456564564564', 'souomelhor@gmail.com', 1),
(3, 'Melhor Pai', 'MASCULINO', '1989-01-19', '', '', '0@dsd', 1),
(4, 'Pia de Todos', 'MASCULINO', '1973-05-03', '53453453453', '', '4345@dgsdf', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala_video`
--

CREATE TABLE `sala_video` (
  `id_sala` tinyint(3) UNSIGNED NOT NULL,
  `identificador` varchar(3) NOT NULL,
  `disponivel` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sala_video`
--

INSERT INTO `sala_video` (`id_sala`, `identificador`, `disponivel`) VALUES
(1, '14', 1),
(2, '12A', 1),
(3, '18A', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id_turma` tinyint(3) UNSIGNED NOT NULL,
  `nome_turma` varchar(2) NOT NULL,
  `quantidade_alunos` tinyint(3) UNSIGNED NOT NULL,
  `disponivel` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id_turma`, `nome_turma`, `quantidade_alunos`, `disponivel`) VALUES
(1, 'A', 39, 1),
(2, 'B', 38, 1),
(3, 'C', 41, 1),
(9, 'E', 2, 0),
(10, 'D', 37, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `FK_responsavel_aluno` (`id_responsavel`),
  ADD KEY `FK_turma_aluno` (`id_turma`);

--
-- Indexes for table `chamada`
--
ALTER TABLE `chamada`
  ADD PRIMARY KEY (`id_chamada`),
  ADD KEY `FK_turma_chamada` (`id_turma`),
  ADD KEY `FK_aluno_chamada` (`id_aluno`),
  ADD KEY `FK_professor_chamada` (`id_professor`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disciplina`);

--
-- Indexes for table `disciplina_ministrada`
--
ALTER TABLE `disciplina_ministrada`
  ADD PRIMARY KEY (`id_professor`,`id_disciplina`),
  ADD KEY `FK_disciplina_disciplina_ministrada` (`id_disciplina`);

--
-- Indexes for table `inscricao`
--
ALTER TABLE `inscricao`
  ADD PRIMARY KEY (`id_inscricao`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `plano_aula`
--
ALTER TABLE `plano_aula`
  ADD PRIMARY KEY (`id_plano`),
  ADD KEY `FK_professor_plano` (`id_professor`),
  ADD KEY `FK_disciplina_plano` (`id_disciplina`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id_professor`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `FK_professor_reserva` (`id_professor`),
  ADD KEY `FK_sala_reserva` (`id_sala`);

--
-- Indexes for table `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`id_responsavel`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sala_video`
--
ALTER TABLE `sala_video`
  ADD PRIMARY KEY (`id_sala`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id_turma`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chamada`
--
ALTER TABLE `chamada`
  MODIFY `id_chamada` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id_disciplina` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inscricao`
--
ALTER TABLE `inscricao`
  MODIFY `id_inscricao` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plano_aula`
--
ALTER TABLE `plano_aula`
  MODIFY `id_plano` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id_professor` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `responsavel`
--
ALTER TABLE `responsavel`
  MODIFY `id_responsavel` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sala_video`
--
ALTER TABLE `sala_video`
  MODIFY `id_sala` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `id_turma` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `FK_aluno` FOREIGN KEY (`id_aluno`) REFERENCES `inscricao` (`id_inscricao`),
  ADD CONSTRAINT `FK_responsavel_aluno` FOREIGN KEY (`id_responsavel`) REFERENCES `responsavel` (`id_responsavel`),
  ADD CONSTRAINT `FK_turma_aluno` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`);

--
-- Limitadores para a tabela `chamada`
--
ALTER TABLE `chamada`
  ADD CONSTRAINT `FK_aluno_chamada` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `FK_professor_chamada` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`),
  ADD CONSTRAINT `FK_turma_chamada` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`);

--
-- Limitadores para a tabela `disciplina_ministrada`
--
ALTER TABLE `disciplina_ministrada`
  ADD CONSTRAINT `FK_disciplina_disciplina_ministrada` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  ADD CONSTRAINT `FK_professor_disciplina_ministrada` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`);

--
-- Limitadores para a tabela `plano_aula`
--
ALTER TABLE `plano_aula`
  ADD CONSTRAINT `FK_disciplina_plano` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  ADD CONSTRAINT `FK_professor_plano` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`);

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `FK_professor_reserva` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`),
  ADD CONSTRAINT `FK_sala_reserva` FOREIGN KEY (`id_sala`) REFERENCES `sala_video` (`id_sala`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
