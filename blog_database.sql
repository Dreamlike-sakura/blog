/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50723
Source Host           : localhost:3306
Source Database       : mysql

Target Server Type    : MYSQL
Target Server Version : 50723
File Encoding         : 65001

Date: 2019-02-11 16:10:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_database
-- ----------------------------
DROP TABLE IF EXISTS `blog_database`;
CREATE TABLE `blog_database` (
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `m_text` longblob NOT NULL,
  `m_addtime` varchar(255) NOT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of blog_database
-- ----------------------------
INSERT INTO `blog_database` VALUES ('1212323@5465.com', 'efcf8bc6d31de8fadc6b383d417f5a0a', 'luolik', '', '');
