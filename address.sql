SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `person` (
  `Name` varchar(10) NOT NULL,
  `Nickname` varchar(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Company` varchar(50) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `Phone` varchar(11) NOT NULL,
  `Rand_Num` varchar(10) NOT NULL,
  `isConfirm` varchar(5) NOT NULL,
  `Firstlogin` varchar(5) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;