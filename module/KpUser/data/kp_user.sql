-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014 年 04 月 26 日 08:03
-- 服务器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `kp_user`
--

CREATE TABLE IF NOT EXISTS `kp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(30) NOT NULL,
  `regdate` int(10) unsigned zerofill NOT NULL,
  `lastlogindate` int(1) unsigned zerofill NOT NULL,
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `regip` varchar(30) NOT NULL,
  `lastloginip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- 转存表中的数据 `kp_user`
--

INSERT INTO `kp_user` (`id`, `username`, `password`, `email`, `regdate`, `lastlogindate`, `type`, `status`, `regip`, `lastloginip`) VALUES
(19, '1212', '123', '11212@qq.com', 1396143549, 0, 1, 0, '', ''),
(32, 'aaaa', '', '110@qq.com', 1396162011, 0, 1, 0, '', ''),
(22, 'sdjajda', '9903c4a1e505b00a21b23f915b42bf87', 'dad@qq.com', 1396146349, 0, -1, 0, '', ''),
(23, 'dadad', 'd938c0e5250c99334dd403a5c37ba637', 'sdad12@qq.com', 1396146417, 0, 1, 0, '', ''),
(33, '111', 'b223601ba9448481c70be58f480c64e9', '111@qq.com', 1396752104, 1397365511, 3, 0, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
