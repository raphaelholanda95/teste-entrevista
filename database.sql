-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19-Set-2017 às 00:57
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_teste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_post`
--

CREATE TABLE `tb_post` (
  `id_post` int(11) NOT NULL,
  `qtd_curtidas` int(11) NOT NULL,
  `nm_img` varchar(32) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_post`
--

INSERT INTO `tb_post` (`id_post`, `qtd_curtidas`, `nm_img`, `id_usuario`) VALUES
(1, 100, 'img4.jpg', 2),
(2, 121, 'img3.jpg', 4),
(3, 99, 'img2.jpg', 3),
(4, 200, 'img1.jpg', 3),
(5, 201, 'img5.gif', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nm_usuario` varchar(32) NOT NULL,
  `nm_senha` varchar(32) NOT NULL,
  `nm_email` varchar(32) NOT NULL,
  `cd_token` varchar(32) NOT NULL,
  `nm_foto` varchar(32) NOT NULL,
  `nm_nome` varchar(32) DEFAULT NULL,
  `dt_autenticacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id_usuario`, `nm_usuario`, `nm_senha`, `nm_email`, `cd_token`, `nm_foto`, `nm_nome`, `dt_autenticacao`) VALUES
(1, 'raphael', '123', 'raphael.soares15@hotmail.com', 'abcdefghabcdefghabcdefghabcdefgh', '', NULL, NULL),
(2, 'Daenerys Targaryen', '1234', 'gabryel@teste.com.b.r', 'abcdefghabcdefghabcdefghabcdefg1', 'perfil3.jpg', 'daenerys_targaryen', NULL),
(3, 'Doutor', '8277e0910d750195b448797616e091ad', 'a', '', 'perfil2.jpg', 'doutor', NULL),
(4, 'Darth Vader', '8277e0910d750195b448797616e091ad', 'darthvader@teste.com.br', '', 'perfil1.jpg', 'darth_vader', NULL),
(5, 'raphael123', '202cb962ac59075b964b07152d234b70', 'raphael.soares15@hotmail.com', 'G76ZXvWyggSJabGHlicw4KpTkBpAvI9H', 'image_resized988635.jpg', 'Raphael Ferreira de Holanda Soar', '2017-09-18 19:55:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_post`
--
ALTER TABLE `tb_post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_post`
--
ALTER TABLE `tb_post`
  ADD CONSTRAINT `tb_post_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
