/*
 Navicat Premium Data Transfer

 Source Server         : say local
 Source Server Type    : MySQL
 Source Server Version : 50722
 Source Host           : localhost:3306
 Source Schema         : naive_bayes

 Target Server Type    : MySQL
 Target Server Version : 50722
 File Encoding         : 65001

 Date: 28/06/2018 14:44:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
BEGIN;
INSERT INTO `category` VALUES (1, 'Neuroticism (N)', '2018-06-22 07:29:33');
INSERT INTO `category` VALUES (2, 'Extraversion (E)', '2018-06-22 07:30:07');
INSERT INTO `category` VALUES (3, 'Agreeableness (A)', '2018-06-22 07:30:44');
INSERT INTO `category` VALUES (4, 'Openness (O)', '2018-06-22 07:32:00');
INSERT INTO `category` VALUES (5, 'Conscientiousness (C)', '2018-06-22 07:32:39');
COMMIT;

-- ----------------------------
-- Table structure for history
-- ----------------------------
DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `result` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of history
-- ----------------------------
BEGIN;
INSERT INTO `history` VALUES (2, 'ssa_augusta', '{\"data\":[{\"name\":\"Neuroticism (N)\",\"prob\":0.2777777777777778,\"n\":10,\"Xi_Y\":0,\"bayes\":0},{\"name\":\"Extraversion (E)\",\"prob\":0.19444444444444445,\"n\":7,\"Xi_Y\":0,\"bayes\":0},{\"name\":\"Agreeableness (A)\",\"prob\":0.1388888888888889,\"n\":5,\"Xi_Y\":0,\"bayes\":0},{\"name\":\"Openness (O)\",\"prob\":0.3055555555555556,\"n\":11,\"Xi_Y\":0.18181818181818182,\"bayes\":0.05555555555555556},{\"name\":\"Conscientiousness (C)\",\"prob\":0.08333333333333333,\"n\":3,\"Xi_Y\":0,\"bayes\":0}],\"n\":36}', '2018-06-28 06:10:26');
INSERT INTO `history` VALUES (4, 'onecak', '{\"data\":[{\"name\":\"Neuroticism (N)\",\"prob\":0.2777777777777778,\"n\":10,\"Xi_Y\":2.4,\"bayes\":0.6666666666666666},{\"name\":\"Extraversion (E)\",\"prob\":0.19444444444444445,\"n\":7,\"Xi_Y\":1.1428571428571428,\"bayes\":0.2222222222222222},{\"name\":\"Agreeableness (A)\",\"prob\":0.1388888888888889,\"n\":5,\"Xi_Y\":4,\"bayes\":0.5555555555555556},{\"name\":\"Openness (O)\",\"prob\":0.3055555555555556,\"n\":11,\"Xi_Y\":1.6363636363636365,\"bayes\":0.5000000000000001},{\"name\":\"Conscientiousness (C)\",\"prob\":0.08333333333333333,\"n\":3,\"Xi_Y\":2.6666666666666665,\"bayes\":0.2222222222222222}],\"n\":36}', '2018-06-28 06:45:48');
INSERT INTO `history` VALUES (5, 'af_harismawan', '{\"data\":[{\"name\":\"Neuroticism (N)\",\"prob\":0.2777777777777778,\"n\":10,\"Xi_Y\":0.1,\"bayes\":0.02777777777777778},{\"name\":\"Extraversion (E)\",\"prob\":0.19444444444444445,\"n\":7,\"Xi_Y\":1,\"bayes\":0.19444444444444445},{\"name\":\"Agreeableness (A)\",\"prob\":0.1388888888888889,\"n\":5,\"Xi_Y\":1.2,\"bayes\":0.16666666666666666},{\"name\":\"Openness (O)\",\"prob\":0.3055555555555556,\"n\":11,\"Xi_Y\":0.18181818181818182,\"bayes\":0.05555555555555556},{\"name\":\"Conscientiousness (C)\",\"prob\":0.08333333333333333,\"n\":3,\"Xi_Y\":0,\"bayes\":0}],\"n\":36}', '2018-06-28 06:54:36');
COMMIT;

-- ----------------------------
-- Table structure for subcategory
-- ----------------------------
DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE `subcategory` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `categoryID` int(10) unsigned DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `categoryID` (`categoryID`),
  CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of subcategory
-- ----------------------------
BEGIN;
INSERT INTO `subcategory` VALUES (1, 1, 'marah', '2018-06-22 16:32:54');
INSERT INTO `subcategory` VALUES (2, 1, 'bangsat', '2018-06-22 09:44:11');
INSERT INTO `subcategory` VALUES (3, 1, 'kesal', '2018-06-22 09:46:07');
INSERT INTO `subcategory` VALUES (4, 1, 'emosi', '2018-06-22 09:47:36');
INSERT INTO `subcategory` VALUES (5, 1, 'cemburu', '2018-06-22 09:52:43');
INSERT INTO `subcategory` VALUES (6, 1, 'benci', '2018-06-22 09:52:59');
INSERT INTO `subcategory` VALUES (7, 1, 'tegang', '2018-06-22 09:53:06');
INSERT INTO `subcategory` VALUES (8, 1, 'gugup', '2018-06-22 09:53:12');
INSERT INTO `subcategory` VALUES (9, 1, 'gopoh', '2018-06-22 09:53:23');
INSERT INTO `subcategory` VALUES (10, 1, 'takut', '2018-06-22 09:53:29');
INSERT INTO `subcategory` VALUES (11, 2, 'peduli', '2018-06-22 09:53:49');
INSERT INTO `subcategory` VALUES (12, 2, 'suka', '2018-06-22 09:53:55');
INSERT INTO `subcategory` VALUES (13, 2, 'senang', '2018-06-22 09:54:04');
INSERT INTO `subcategory` VALUES (14, 2, 'bahagia', '2018-06-22 09:54:12');
INSERT INTO `subcategory` VALUES (15, 2, 'motivasi', '2018-06-22 10:08:42');
INSERT INTO `subcategory` VALUES (16, 2, 'simpati', '2018-06-22 10:08:54');
INSERT INTO `subcategory` VALUES (17, 2, 'semangat', '2018-06-22 10:09:16');
INSERT INTO `subcategory` VALUES (18, 3, 'sabar', '2018-06-22 10:09:59');
INSERT INTO `subcategory` VALUES (19, 3, 'sayang', '2018-06-22 10:10:05');
INSERT INTO `subcategory` VALUES (20, 3, 'cinta', '2018-06-22 10:10:11');
INSERT INTO `subcategory` VALUES (21, 3, 'kangen', '2018-06-22 10:10:16');
INSERT INTO `subcategory` VALUES (22, 3, 'kasih', '2018-06-22 10:10:22');
INSERT INTO `subcategory` VALUES (23, 4, 'cita-cita', '2018-06-22 10:10:40');
INSERT INTO `subcategory` VALUES (24, 4, 'mimpi', '2018-06-22 10:10:47');
INSERT INTO `subcategory` VALUES (25, 4, 'khayal', '2018-06-22 10:10:53');
INSERT INTO `subcategory` VALUES (26, 4, 'andai', '2018-06-22 10:11:07');
INSERT INTO `subcategory` VALUES (27, 4, 'coba', '2018-06-22 10:11:12');
INSERT INTO `subcategory` VALUES (28, 4, 'ingin', '2018-06-22 10:11:18');
INSERT INTO `subcategory` VALUES (29, 4, 'maaf', '2018-06-22 10:11:26');
INSERT INTO `subcategory` VALUES (30, 4, 'sabar', '2018-06-22 10:11:34');
INSERT INTO `subcategory` VALUES (31, 4, 'yakin', '2018-06-22 10:11:45');
INSERT INTO `subcategory` VALUES (32, 4, 'doa', '2018-06-22 10:11:50');
INSERT INTO `subcategory` VALUES (33, 4, 'syukur', '2018-06-22 10:11:56');
INSERT INTO `subcategory` VALUES (34, 5, 'ambisi', '2018-06-22 10:12:14');
INSERT INTO `subcategory` VALUES (35, 5, 'usaha', '2018-06-22 10:12:19');
INSERT INTO `subcategory` VALUES (36, 5, 'waktu', '2018-06-22 10:12:26');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
