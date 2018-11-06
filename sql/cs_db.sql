/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : cs_db

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 05/11/2018 11:35:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for administrator
-- ----------------------------
DROP TABLE IF EXISTS `administrator`;
CREATE TABLE `administrator`  (
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `facialData` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `identificationNum` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of administrator
-- ----------------------------
INSERT INTO `administrator` VALUES ('admin', 'admin', 'admin', NULL, '910189033@qq.com', '13333333333', '96fcc4b4ce72d7731541302110', 111);

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company`  (
  `companyName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regDate` int(11) DEFAULT NULL,
  `responsiblePerson` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('好大的鱼', 1, 0, 'qr', 'qr', 'qwr');
INSERT INTO `company` VALUES ('虎纹鲨鱼', 2, NULL, '', '', '');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `sendId` int(11) NOT NULL,
  `receiverId` int(11) DEFAULT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`sendId`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project`  (
  `prjName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `publisherId` int(255) DEFAULT NULL,
  `demandPath` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `prjBegin` int(11) DEFAULT NULL,
  `prjEnd` int(11) DEFAULT NULL,
  `hasDone` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('咸鱼', 27, NULL, 1, NULL, 1541340416, NULL);
INSERT INTO `project` VALUES ('小鱼干', 27, NULL, 2, NULL, 1541513248, NULL);

-- ----------------------------
-- Table structure for skill
-- ----------------------------
DROP TABLE IF EXISTS `skill`;
CREATE TABLE `skill`  (
  `userId` int(11) DEFAULT NULL,
  `php` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `vue` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task`  (
  `prjId` int(11) NOT NULL,
  `startTime` int(11) DEFAULT NULL,
  `endTime` int(11) DEFAULT NULL,
  `taskName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `state` int(255) DEFAULT 0,
  `userId` int(11) DEFAULT NULL,
  `securityLevel` int(255) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workFile` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `descriptionFile` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `workDescription` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`prjId`, `id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES (1, 1540995617, 1541340418, '烤咸鱼', 1, 26, 0, 1, '../../files/prj/咸鱼/烤咸鱼/receiver/黄平川/mysql密码.txt;../../files/prj/咸鱼/烤咸鱼/receiver/黄平川/NTN技术综述.doc', '', '发顺丰', 'fdsafadfdadf;阿发达的说法');
INSERT INTO `task` VALUES (1, 1540995617, 1541340416, '咸鱼干', 0, 26, 1, 2, NULL, NULL, NULL, NULL);
INSERT INTO `task` VALUES (2, NULL, 1540995617, NULL, -1, 26, 0, 3, NULL, NULL, NULL, NULL);
INSERT INTO `task` VALUES (2, 1540995617, 1541653689, '晒咸鱼', 0, 26, 1, 4, NULL, NULL, NULL, NULL);
INSERT INTO `task` VALUES (2, 1540995617, 1540995617, '老咸鱼', -1, 26, 1, 5, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `facialData` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `company` int(255) NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `isCensored` int(255) NOT NULL DEFAULT 0,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userGroup` int(255) DEFAULT NULL,
  `identificationNum` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `portrait` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `workTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('Anthony', 'medic', 'medic', '', 1, '233@233.com', '13333333333', 1, '7dee729311ef5b5c1540965700', 25, 2, '333333333333333333', NULL, NULL);
INSERT INTO `user` VALUES ('黄平川', 'r_hpc', '910189033', '', 2, '910189033@qq.com', '15906675075', 1, '0efcfab08731a97e1541074189', 26, 2, '123456789123456789', NULL, NULL);
INSERT INTO `user` VALUES ('ChrisWong', 's_hpc', '910189033', '', -1, 'jkl@outlook.com', '15906675555', 1, 'a3d5b344bc40f3bc1541074253', 27, 1, '123456789123456111', NULL, NULL);
INSERT INTO `user` VALUES ('wrf', 'r_wrf', 'wrf', '', 1, 'dfsa@qq.com', '11122233344', 1, NULL, 28, 2, '980890123456789', NULL, NULL);
INSERT INTO `user` VALUES ('wrfs', 's_wrf', 'wrf', '', -1, 'fsadjkla2@qq.com', '12345678922', 1, NULL, 29, 1, '111222333444555', NULL, NULL);
INSERT INTO `user` VALUES ('jdhs', 'asdf', '111111', '', -1, 'wgwrg', '5555', 1, NULL, 37, 1, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('jdhs', 'fdasf', '111111', '', 825, 'wgwrg', '5555', 0, NULL, 34, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('jdhs', 'dfafa', '111111', '', 825, 'wgwrg', '5555', 1, NULL, 35, 2, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for workinfo
-- ----------------------------
DROP TABLE IF EXISTS `workinfo`;
CREATE TABLE `workinfo`  (
  `begin` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `taskId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of workinfo
-- ----------------------------
INSERT INTO `workinfo` VALUES (2147483647, 123, 2, 26);
INSERT INTO `workinfo` VALUES (2147483647, 123, 2, 25);
INSERT INTO `workinfo` VALUES (456, 123, 5, 27);
INSERT INTO `workinfo` VALUES (1546786786, 54254334, 5, 27);

SET FOREIGN_KEY_CHECKS = 1;
