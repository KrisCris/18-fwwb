/*
 Navicat Premium Data Transfer

 Source Server         : locahost
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : cs_db

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 20/10/2018 12:35:12
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
  `facialData` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `identificationNum` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of administrator
-- ----------------------------
INSERT INTO `administrator` VALUES ('Chris Wong', 'CONNECTION_LOST', '910189033', NULL, '910189033@qq.com', '110', 'be6f7cad026585081539938690', 111);

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company`  (
  `companyName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('enormousFish', 1);
INSERT INTO `company` VALUES ('tigerSpotShark', 2);

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `sendId` int(11) NOT NULL,
  `receiverId` int(11) NULL DEFAULT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`sendId`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project`  (
  `prjName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `publisher` int(255) NULL DEFAULT NULL,
  `demandPath` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `prjBegin` int(11) NULL DEFAULT NULL,
  `prjEnd` int(11) NULL DEFAULT NULL,
  `hasDone` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for skill
-- ----------------------------
DROP TABLE IF EXISTS `skill`;
CREATE TABLE `skill`  (
  `php` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `vue` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task`  (
  `prjId` int(11) NOT NULL,
  `startTime` int(11) NULL DEFAULT NULL,
  `deadTime` int(11) NULL DEFAULT NULL,
  `partName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `idDelay` int(255) NULL DEFAULT NULL,
  `hasDone` int(255) NULL DEFAULT NULL,
  `userId` int(11) NULL DEFAULT NULL,
  `securityLevel` int(255) NULL DEFAULT NULL,
  `id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`prjId`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `isCensored` int(255) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userGroup` int(255) NULL DEFAULT NULL,
  `identificationNum` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `username`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('wrf', 'wrf', 'wrf', '', 2, NULL, '', 0, '', 2, NULL, NULL);
INSERT INTO `user` VALUES ('Chris', 'hi.imhpc', 'hi.imhpc', '', 1, 'hi.imhpc@outlook.com', '13000000000000', 1, '0d928d4bf8ce0ff21539868887', 1, NULL, 123);
INSERT INTO `user` VALUES ('543', 'reer', 'rtest', '', 2, '42', '242452', 0, NULL, 3, NULL, NULL);
INSERT INTO `user` VALUES ('543', '453', '5hi.imhpc', '45', 2, '42', '242452', 1, 'ddfc689c1d0e3b9c1539959586', 14, 45, 5);
INSERT INTO `user` VALUES ('543', 'fasd', '5hi.imhpc', '45', 2, '42', '242452', 0, NULL, 16, 45, 15);
INSERT INTO `user` VALUES ('543', 'zxz', '5hi.imhpc', '45', 2, '42', '242452', -1, '', 17, 45, 22);
INSERT INTO `user` VALUES ('543', 'ee', 'rtest', '457867', 2, '42', '242452', 0, NULL, 18, 4, 55);
INSERT INTO `user` VALUES ('543', '156', 'rtest', '457867', 2, '42', '242452', 0, NULL, 19, 4, 11);

-- ----------------------------
-- Table structure for workinfo
-- ----------------------------
DROP TABLE IF EXISTS `workinfo`;
CREATE TABLE `workinfo`  (
  `begin` date NULL DEFAULT NULL,
  `end` date NULL DEFAULT NULL,
  `taskId` int(11) NULL DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

SET FOREIGN_KEY_CHECKS = 1;
