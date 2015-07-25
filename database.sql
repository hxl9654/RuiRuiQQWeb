-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
<<<<<<< HEAD
-- 生成日期: 2015 �?06 �?24 �?17:20
-- 服务器版本: 5.5.40
=======
-- 生成日期: 2015 �?07 �?23 �?00:00
-- 服务器版本: 5.5.38
>>>>>>> origin/master
-- PHP 版本: 5.6.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
<<<<<<< HEAD
-- 数据库: `echo`
=======
-- 数据库: `smartqq`
>>>>>>> origin/master
--

-- --------------------------------------------------------

--
-- 表的结构 `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data` text NOT NULL,
<<<<<<< HEAD
  `enable` smallint(1) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;
=======
  `enable` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1550 ;
>>>>>>> origin/master

-- --------------------------------------------------------

--
-- 表的结构 `groupmanage`
--

CREATE TABLE IF NOT EXISTS `groupmanage` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gno` text NOT NULL,
  `enable` text NOT NULL,
  `enableWeather` text NOT NULL,
<<<<<<< HEAD
  `enableenableExchangeRate` text NOT NULL,
=======
  `enableExchangeRate` text NOT NULL,
>>>>>>> origin/master
  `enableStock` text NOT NULL,
  `enableStudy` text NOT NULL,
  `enabletalk` text NOT NULL,
  `enablexhj` text NOT NULL,
<<<<<<< HEAD
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;
=======
  `enableemoje` text NOT NULL,
  `enableCityInfo` text NOT NULL,
  `enableWiki` text NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=32 ;
>>>>>>> origin/master

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- 表的结构 `log`
--

CREATE TABLE IF NOT EXISTS `log` (
=======
-- 表的结构 `logqqcount`
--

CREATE TABLE IF NOT EXISTS `logqqcount` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qqnum` text NOT NULL,
  `study` int(11) NOT NULL DEFAULT '0',
  `talk` int(11) NOT NULL DEFAULT '0',
  `weather` int(11) NOT NULL DEFAULT '0',
  `wiki` int(11) NOT NULL DEFAULT '0',
  `exchangerate` int(11) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL DEFAULT '0',
  `cityinfo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=883 ;

-- --------------------------------------------------------

--
-- 表的结构 `logquncount`
--

CREATE TABLE IF NOT EXISTS `logquncount` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qunnum` text NOT NULL,
  `study` int(11) NOT NULL DEFAULT '0',
  `talk` int(11) NOT NULL DEFAULT '0',
  `weather` int(11) NOT NULL DEFAULT '0',
  `wiki` int(11) NOT NULL DEFAULT '0',
  `exchangerate` int(11) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL DEFAULT '0',
  `cityinfo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

--
-- 表的结构 `logstudy`
--

CREATE TABLE IF NOT EXISTS `logstudy` (
>>>>>>> origin/master
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `source` text NOT NULL,
  `aim` text NOT NULL,
  `qqnum` text NOT NULL,
<<<<<<< HEAD
  `sourceno` text NOT NULL,
  `aimno` text NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;
=======
  `qunnum` text NOT NULL,
  `sourceno` text NOT NULL,
  `aimno` text NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=905 ;

-- --------------------------------------------------------

--
-- 表的结构 `loguse`
--

CREATE TABLE IF NOT EXISTS `loguse` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qqnum` text NOT NULL,
  `groupno` text NOT NULL,
  `action` text NOT NULL,
  `p1` text NOT NULL,
  `p2` text NOT NULL,
  `p3` text NOT NULL,
  `p4` text NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=15087 ;
>>>>>>> origin/master

-- --------------------------------------------------------

--
-- 表的结构 `qqinf`
--

CREATE TABLE IF NOT EXISTS `qqinf` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
<<<<<<< HEAD
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
=======
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
>>>>>>> origin/master
  `qq` text NOT NULL,
  `conf` int(11) NOT NULL DEFAULT '1',
  `super` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no`)
<<<<<<< HEAD
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;
=======
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=22 ;
>>>>>>> origin/master

-- --------------------------------------------------------

--
-- 表的结构 `talk`
--

CREATE TABLE IF NOT EXISTS `talk` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
<<<<<<< HEAD
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
=======
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
>>>>>>> origin/master
  `source` text NOT NULL,
  `aim` text NOT NULL,
  `enable` text NOT NULL,
  PRIMARY KEY (`no`)
<<<<<<< HEAD
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;
=======
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1328 ;

-- --------------------------------------------------------

--
-- 表的结构 `weathercityid`
--

CREATE TABLE IF NOT EXISTS `weathercityid` (
  `id` int(11) NOT NULL,
  `pinyin` text NOT NULL,
  `city` text NOT NULL,
  `province` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
>>>>>>> origin/master

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
