/*
Navicat MySQL Data Transfer

Source Server         : Mysql
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : storedb

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-07-24 12:13:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `available` tinyint(1) NOT NULL,
  `price` float NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', 'product1', '1', '0.51', 0x6465736372697074696F6E31, '2017-07-24');
INSERT INTO `product` VALUES ('9', 'product2', '0', '0.52', 0x6465736372697074696F6E32, '2017-07-24');
INSERT INTO `product` VALUES ('10', 'product3', '1', '0.53', 0x6465736372697074696F6E33, '2017-07-24');
INSERT INTO `product` VALUES ('13', 'product4', '1', '0.54', 0x6465736372697074696F6E34, '2017-07-23');
INSERT INTO `product` VALUES ('14', 'product5', '1', '0.55', 0x6465736372697074696F6E35, '2017-07-24');
INSERT INTO `product` VALUES ('15', 'product6', '1', '0.56', 0x6465736372697074696F6E36, '2017-07-23');
INSERT INTO `product` VALUES ('22', 'ooaaaa kkk', '0', '34', 0x66676864666768, '2017-07-24');

-- ----------------------------
-- Table structure for rol
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES ('1', 'READ');
INSERT INTO `rol` VALUES ('2', 'CRUD');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `pasword` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin@admin.com', 'admin123');
INSERT INTO `user` VALUES ('2', 'user@user.com', 'user123');

-- ----------------------------
-- Table structure for user_rol
-- ----------------------------
DROP TABLE IF EXISTS `user_rol`;
CREATE TABLE `user_rol` (
  `id_user` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of user_rol
-- ----------------------------
INSERT INTO `user_rol` VALUES ('1', '2');
INSERT INTO `user_rol` VALUES ('2', '1');
