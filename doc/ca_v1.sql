/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50540
Source Host           : 127.0.0.1:3306
Source Database       : ca_v1

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-07-21 14:38:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for common_actions
-- ----------------------------
DROP TABLE IF EXISTS `common_actions`;
CREATE TABLE `common_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `is_group` tinyint(4) DEFAULT '1' COMMENT '是否分组',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of common_actions
-- ----------------------------
INSERT INTO `common_actions` VALUES ('3', '日志列表', 'CommonLoginRecord.Index', '2', '', '0');
INSERT INTO `common_actions` VALUES ('2', '登录日志', '', '1', '', '1');
INSERT INTO `common_actions` VALUES ('1', '日志模块', '', '0', '日志模块', '1');
INSERT INTO `common_actions` VALUES ('12', '权限列表', 'CommonActions.Index', '11', '', '0');
INSERT INTO `common_actions` VALUES ('11', '权限', '', '4', '', '1');
INSERT INTO `common_actions` VALUES ('10', '菜单列表', 'CommonMenus.Index', '9', '', '0');
INSERT INTO `common_actions` VALUES ('9', '菜单', '', '4', '', '1');
INSERT INTO `common_actions` VALUES ('8', '用户组列表', 'CommonGroups.Index', '7', '', '0');
INSERT INTO `common_actions` VALUES ('7', '用户组', '', '4', '', '1');
INSERT INTO `common_actions` VALUES ('6', '管理员列表', 'CommonAdmin.Index', '5', '', '0');
INSERT INTO `common_actions` VALUES ('4', '管理员模块', '', '0', '', '1');
INSERT INTO `common_actions` VALUES ('5', '管理员', '', '4', '', '1');

-- ----------------------------
-- Table structure for common_admin
-- ----------------------------
DROP TABLE IF EXISTS `common_admin`;
CREATE TABLE `common_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `login_name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `salt` varchar(5) DEFAULT NULL COMMENT '密码盐',
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `last_login_ip` varchar(20) DEFAULT NULL,
  `last_login_time` bigint(20) DEFAULT NULL,
  `last_login_address` varchar(50) DEFAULT NULL,
  `error_count` int(11) DEFAULT '0' COMMENT '密码输入异常次数',
  `memo` varchar(255) DEFAULT NULL COMMENT '备注',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  `skin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of common_admin
-- ----------------------------
INSERT INTO `common_admin` VALUES ('1', '超级管理员', 'admin', 'c4e8120040b73db42167a3b91fc51424', 'QETS', '13883096587', 'ww@qq.com', '127.0.0.1', '1469069377', '本机地址', '0', 'sssss', '1', null, 'green');
INSERT INTO `common_admin` VALUES ('2', 'test001', 'admin1', 'bf0a7b071550cb4a64be9fcaae8f63e8', 'Aa8a', '', '', '127.0.0.1', '1469003696', '本机地址', '0', '12345\r\nadddddddddddddddd', '1', '1469003696', null);
INSERT INTO `common_admin` VALUES ('3', '123', '13883096587', '3e9154953e649c794cbdac4e77be9568', 'sRto', '', '', '127.0.0.1', '1469003759', '本机地址', '0', '', '1', '1469003759', null);
INSERT INTO `common_admin` VALUES ('4', '123456', '15025409035', '95173257e3c10a411d384376254a039d', '97JZ', '', '', '127.0.0.1', '1469003824', '本机地址', '0', '', '2', '1469003824', null);

-- ----------------------------
-- Table structure for common_admin_group
-- ----------------------------
DROP TABLE IF EXISTS `common_admin_group`;
CREATE TABLE `common_admin_group` (
  `admin_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of common_admin_group
-- ----------------------------
INSERT INTO `common_admin_group` VALUES ('1', '1');
INSERT INTO `common_admin_group` VALUES ('2', '1');
INSERT INTO `common_admin_group` VALUES ('2', '2');

-- ----------------------------
-- Table structure for common_groups
-- ----------------------------
DROP TABLE IF EXISTS `common_groups`;
CREATE TABLE `common_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_sys` tinyint(4) DEFAULT '0' COMMENT '是否系统组',
  `type` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of common_groups
-- ----------------------------
INSERT INTO `common_groups` VALUES ('1', '管理员', '1', null, null, '所有权限');
INSERT INTO `common_groups` VALUES ('2', '普通用户', '0', null, null, '普通用户');

-- ----------------------------
-- Table structure for common_group_action
-- ----------------------------
DROP TABLE IF EXISTS `common_group_action`;
CREATE TABLE `common_group_action` (
  `group_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`action_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of common_group_action
-- ----------------------------
INSERT INTO `common_group_action` VALUES ('1', '1');
INSERT INTO `common_group_action` VALUES ('1', '2');
INSERT INTO `common_group_action` VALUES ('1', '3');
INSERT INTO `common_group_action` VALUES ('1', '4');
INSERT INTO `common_group_action` VALUES ('1', '5');
INSERT INTO `common_group_action` VALUES ('1', '6');
INSERT INTO `common_group_action` VALUES ('1', '7');
INSERT INTO `common_group_action` VALUES ('1', '8');
INSERT INTO `common_group_action` VALUES ('1', '9');
INSERT INTO `common_group_action` VALUES ('1', '10');
INSERT INTO `common_group_action` VALUES ('1', '11');
INSERT INTO `common_group_action` VALUES ('1', '12');
INSERT INTO `common_group_action` VALUES ('2', '1');
INSERT INTO `common_group_action` VALUES ('2', '2');
INSERT INTO `common_group_action` VALUES ('2', '3');

-- ----------------------------
-- Table structure for common_login_record
-- ----------------------------
DROP TABLE IF EXISTS `common_login_record`;
CREATE TABLE `common_login_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `created` int(11) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of common_login_record
-- ----------------------------
INSERT INTO `common_login_record` VALUES ('19', '1', '1468377760', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('18', '1', '1468225560', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('17', '1', '1468225527', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('16', '1', '1468221515', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('15', '1', '1467252264', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('14', '6', '1467184370', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('13', '6', '1467184321', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('12', '1', '1467182608', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('11', '1', '1467170977', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('20', '1', '1468379494', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('21', '1', '1468382477', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('22', '1', '1468486540', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('23', '1', '1468487932', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('24', '1', '1468487974', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('25', '1', '1468487986', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('26', '1', '1468490549', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('27', '1', '1468548098', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('28', '1', '1468548184', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('29', '1', '1468552335', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('30', '1', '1468639863', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('31', '1', '1468807031', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('32', '1', '1468824142', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('33', '1', '1468891761', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('34', '1', '1468893712', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('35', '1', '1468898873', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('36', '1', '1468981030', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('37', '1', '1468981105', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('38', '1', '1468981321', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('39', '1', '1468986254', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('40', '1', '1469068500', '127.0.0.1', '本机地址');
INSERT INTO `common_login_record` VALUES ('41', '1', '1469069377', '127.0.0.1', '本机地址');

-- ----------------------------
-- Table structure for common_menus
-- ----------------------------
DROP TABLE IF EXISTS `common_menus`;
CREATE TABLE `common_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT '0' COMMENT '菜单父级',
  `icon_class` varchar(255) DEFAULT NULL,
  `weight` int(11) DEFAULT '99' COMMENT '权重（值越大排序越前）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of common_menus
-- ----------------------------
INSERT INTO `common_menus` VALUES ('7', '登录日志', '0', 'CommonLoginRecord/Index', 'CommonLoginRecord.Index', '2', '', '99');
INSERT INTO `common_menus` VALUES ('2', '日志管理', '0', '', '', '0', '日志', '98');
INSERT INTO `common_menus` VALUES ('1', '管理员管理', 'Hui-iconfont-root', '', '', '0', '管理', '99');
INSERT INTO `common_menus` VALUES ('3', '管理员列表', '0', 'CommonAdmin/Index', 'CommonAdmin.Index', '1', '', '99');
INSERT INTO `common_menus` VALUES ('4', '用户组管理', '0', 'CommonGroups/Index', 'CommonGroups.Index', '1', '', '99');
INSERT INTO `common_menus` VALUES ('5', '菜单管理', '0', 'CommonMenus/Index', 'CommonMenus.Index', '1', '', '99');
INSERT INTO `common_menus` VALUES ('6', '权限列表', '0', 'CommonActions/Index', 'CommonActions.Index', '1', '', '99');
