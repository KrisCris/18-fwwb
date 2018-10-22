/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : cs_db

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 23/10/2018 00:22:23
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
INSERT INTO `administrator` VALUES ('admin', 'admin', 'admin', NULL, '910189033@qq.com', '110', 'b2db37feedfdeaab1540225280', 111);

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company`  (
  `companyName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regDate` int(11) NULL DEFAULT NULL,
  `responsiblePerson` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('enormousFish', 1, NULL, NULL, NULL, NULL);
INSERT INTO `company` VALUES ('tigerSpotShark', 2, NULL, NULL, NULL, NULL);

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
  `isCensored` int(255) NOT NULL DEFAULT 0,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userGroup` int(255) NULL DEFAULT NULL,
  `identificationNum` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('ChrisWong', 'hi.imhpc', '910189033', '', -1, 'hi.imhpc@xxx.com', '13900000000', 1, NULL, 24, 1, '330103000000000000');
INSERT INTO `user` VALUES ('接包_1', 'recev_1', 'recev_1', '', 1, '111@qq.com', '11111111111', 0, NULL, 23, 2, '111111111111111111');
INSERT INTO `user` VALUES ('发包_1', 'post_1', 'post_1', '', -1, 'hi.imhpc@000.com', '15906670000', 0, NULL, 22, 1, '330103199810240000');

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
