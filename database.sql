-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 �?07 �?31 �?01:11
-- 服务器版本: 5.5.38
-- PHP 版本: 5.6.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `smartqq`
--

-- --------------------------------------------------------

--
-- 表的结构 `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data` text NOT NULL,
  `enable` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1724 ;

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
  `enableExchangeRate` text NOT NULL,
  `enableStock` text NOT NULL,
  `enableStudy` text NOT NULL,
  `enabletalk` text NOT NULL,
  `enablexhj` text NOT NULL,
  `enableemoje` text NOT NULL,
  `enableCityInfo` text NOT NULL,
  `enableWiki` text NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=87 ;

-- --------------------------------------------------------

--
-- 表的结构 `loginfreport`
--

CREATE TABLE IF NOT EXISTS `loginfreport` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qq` text NOT NULL,
  `adminqq` text NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
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
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1686 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=119 ;

-- --------------------------------------------------------

--
-- 表的结构 `logstudy`
--

CREATE TABLE IF NOT EXISTS `logstudy` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `source` text NOT NULL,
  `aim` text NOT NULL,
  `qqnum` text NOT NULL,
  `qunnum` text NOT NULL,
  `sourceno` text NOT NULL,
  `aimno` text NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1138 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=32468 ;

-- --------------------------------------------------------

--
-- 表的结构 `pendingtalk`
--

CREATE TABLE IF NOT EXISTS `pendingtalk` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `source` text NOT NULL,
  `aim` text NOT NULL,
  `qqnum` text NOT NULL,
  `qunnum` text NOT NULL,
  `statu` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `qqinf`
--

CREATE TABLE IF NOT EXISTS `qqinf` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `qq` text NOT NULL,
  `conf` int(11) NOT NULL DEFAULT '1',
  `super` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- 表的结构 `talk`
--

CREATE TABLE IF NOT EXISTS `talk` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `source` text NOT NULL,
  `aim` text NOT NULL,
  `enable` text NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1461 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
