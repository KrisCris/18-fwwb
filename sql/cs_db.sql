# Host: localhost  (Version: 5.5.53)
# Date: 2018-10-19 17:01:16
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "administrator"
#

CREATE TABLE `administrator` (
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `facialData` text,
  `mail` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `identificationNum` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "administrator"
#

REPLACE INTO `administrator` VALUES ('Chris Wong','CONNECTION_LOST','910189033',NULL,'910189033@qq.com','110','be6f7cad026585081539938690',111);

#
# Structure for table "company"
#

CREATE TABLE `company` (
  `companyName` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "company"
#

REPLACE INTO `company` VALUES ('enormousFish',1),('tigerSpotShark',2);

#
# Structure for table "user"
#

CREATE TABLE `user` (
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `facialData` text NOT NULL,
  `company` int(255) NOT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `isCensored` int(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userGroup` int(255) DEFAULT NULL,
  `identificationNum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "user"
#

REPLACE INTO `user` VALUES ('Chris','hi.imhpc','hi.imhpc','',1,'hi.imhpc@outlook.com','13000000000000',1,'0d928d4bf8ce0ff21539868887',1,NULL,123),('wrf','wrf','wrf','',2,NULL,'',0,'',2,NULL,NULL),('543','reer','rtest','',2,'42','242452',0,NULL,3,NULL,NULL),('543','453','5hi.imhpc','45',2,'42','242452',1,'73d08e959397adf31539938772',14,45,5),('543','fasd','5hi.imhpc','45',2,'42','242452',0,NULL,16,45,15),('543','zxz','5hi.imhpc','45',2,'42','242452',-1,'',17,45,22),('543','ee','rtest','457867',2,'42','242452',0,NULL,18,4,55),('543','156','rtest','457867',2,'42','242452',0,NULL,19,4,11);
