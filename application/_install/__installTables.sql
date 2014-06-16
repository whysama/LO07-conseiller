-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-06-10 14:58:52
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `young`
--

-- --------------------------------------------------------

--
-- 表的结构 `CONSEILLER`
--

CREATE TABLE IF NOT EXISTS `CONSEILLER` (
  `id_EC` int(11) NOT NULL,
  `programme` varchar(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_EC`,`programme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `EC`
--

CREATE TABLE IF NOT EXISTS `EC` (
  `id_EC` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `bureau` varchar(20) DEFAULT NULL,
  `pole` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_EC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ETU`
--

CREATE TABLE IF NOT EXISTS `ETU` (
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `programme` varchar(6) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `id_ETU` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_ETU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `LIEN`
--

CREATE TABLE IF NOT EXISTS `LIEN` (
  `id_EC` int(11) NOT NULL,
  `id_ETU` int(11) NOT NULL,
  PRIMARY KEY (`id_EC`,`id_ETU`),
  UNIQUE KEY `id_ETU` (`id_ETU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `USER`
--

CREATE TABLE IF NOT EXISTS `USER` (
  `email` varchar(50) NOT NULL DEFAULT '',
  `pwd` varchar(15) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `USER`
--

INSERT INTO `USER` (`email`, `pwd`, `role`) VALUES
('aurelien.benel@utt.fr', '123456', 'TC'),
('directeur.rh@utt.fr', '123456', 'DRH'),
('estelle.deloux@utt.fr', '123456', 'SM'),
('lionel.amodeo@utt.fr', '123456', 'SI'),
('marc.lemercier@utt.fr', '123456', 'ISI'),
('service.scolarite@utt.fr', '123456', 'SS'),
('thomas.grosges@utt.fr', '123456', 'SRT');

--
-- 限制导出的表
--

--
-- 限制表 `CONSEILLER`
--
ALTER TABLE `CONSEILLER`
  ADD CONSTRAINT `fk_id_EC_c` FOREIGN KEY (`id_EC`) REFERENCES `EC` (`id_EC`);

--
-- 限制表 `LIEN`
--
ALTER TABLE `LIEN`
  ADD CONSTRAINT `fk_id_ETU_l` FOREIGN KEY (`id_ETU`) REFERENCES `ETU` (`id_ETU`),
  ADD CONSTRAINT `fk_id_EC_l` FOREIGN KEY (`id_EC`) REFERENCES `CONSEILLER` (`id_EC`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
