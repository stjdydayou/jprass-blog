/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50160
Source Host           : 127.0.0.1:3306
Source Database       : jprass_blog

Target Server Type    : MYSQL
Target Server Version : 50160
File Encoding         : 65001

Date: 2014-11-22 20:30:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for db_article
-- ----------------------------
DROP TABLE IF EXISTS `db_article`;
CREATE TABLE `db_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `from` varchar(20) NOT NULL DEFAULT '',
  `fromurl` varchar(200) NOT NULL DEFAULT '',
  `description` varchar(150) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `type` enum('page','post') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dateline` (`dateline`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_article
-- ----------------------------
INSERT INTO `db_article` VALUES ('241', '1', '关于', '1', '', '', '个人博客www.joyphper.netJPrass开源社区www.jprass.com联系方式：Email：me@joyphper.netQQ：97142822QQ群：106501129（有兴趣的朋友可以加一下，共同交流）', '&lt;p&gt;个人博客&lt;/p&gt;&lt;p&gt;www.joyphper.net&lt;/p&gt;&lt;p&gt;JPrass开源社区&lt;/p&gt;&lt;p&gt;www.jprass.com&lt;/p&gt;&lt;p&gt;联系方式：&lt;/p&gt;&lt;p&gt;Email：me@joyphper.net&lt;/p&gt;&lt;p&gt;QQ：97142822&lt;/p&gt;&lt;p&gt;QQ群：106501129（有兴趣的朋友可以加一下，共同交流）&lt;br /&gt;&lt;/p&gt;&lt;p&gt;&lt;br /&gt;&lt;/p&gt;', '6953', '1416403289', 'page');
INSERT INTO `db_article` VALUES ('242', '1', '开源JPrass博客系统', '1', '', '', '开源JPrass博客系统', '&lt;p&gt;开源JPrass博客系统&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/admin/Css/logo.png&quot; alt=&quot;&quot; /&gt;&lt;/p&gt;&lt;p style=&quot;text-align: left; margin: 20px 0px 0px; padding: 0px; list-style: none; font-family: \'Helvetica Neue\', Helvetica, Arial, STHeiti, \'Microsoft Yahei\', sans-serif; font-size: 36px; line-height: 100px;&quot;&gt;&lt;strong&gt;JPrass框架，原来开发如此简单！&lt;/strong&gt;&lt;br /&gt;&lt;/p&gt;', '2', '1416658173', 'post');

-- ----------------------------
-- Table structure for db_article_cate
-- ----------------------------
DROP TABLE IF EXISTS `db_article_cate`;
CREATE TABLE `db_article_cate` (
  `id` int(11) NOT NULL,
  `aid` int(10) NOT NULL,
  `cate_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cid` (`cate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_article_cate
-- ----------------------------
INSERT INTO `db_article_cate` VALUES ('2425', '242', '5');

-- ----------------------------
-- Table structure for db_article_tag
-- ----------------------------
DROP TABLE IF EXISTS `db_article_tag`;
CREATE TABLE `db_article_tag` (
  `id` varchar(32) NOT NULL,
  `aid` int(11) NOT NULL,
  `tagid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_article_tag
-- ----------------------------

-- ----------------------------
-- Table structure for db_category
-- ----------------------------
DROP TABLE IF EXISTS `db_category`;
CREATE TABLE `db_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `catename` varchar(50) NOT NULL,
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `ishide` tinyint(1) NOT NULL DEFAULT '0',
  `orderid` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_category
-- ----------------------------
INSERT INTO `db_category` VALUES ('5', '默认分类', '默认关键字', '默认描述', '0', '0');

-- ----------------------------
-- Table structure for db_comment
-- ----------------------------
DROP TABLE IF EXISTS `db_comment`;
CREATE TABLE `db_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `homepage` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `ischeck` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_comment
-- ----------------------------

-- ----------------------------
-- Table structure for db_flink
-- ----------------------------
DROP TABLE IF EXISTS `db_flink`;
CREATE TABLE `db_flink` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT '',
  `logo` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(200) NOT NULL DEFAULT '',
  `visible` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_flink
-- ----------------------------

-- ----------------------------
-- Table structure for db_options
-- ----------------------------
DROP TABLE IF EXISTS `db_options`;
CREATE TABLE `db_options` (
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT '',
  `desc` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_options
-- ----------------------------
INSERT INTO `db_options` VALUES ('archives_url_pattern', '2', 'permalink', '');
INSERT INTO `db_options` VALUES ('default_category', '1', 'blog', '');
INSERT INTO `db_options` VALUES ('default_timezone', '8', 'blog', '');
INSERT INTO `db_options` VALUES ('description', 'JPrass开源博客', 'blog', '');
INSERT INTO `db_options` VALUES ('file_ext_doc', 'true', 'upload', '');
INSERT INTO `db_options` VALUES ('file_ext_image', 'true', 'upload', '');
INSERT INTO `db_options` VALUES ('file_ext_media', 'false', 'upload', '');
INSERT INTO `db_options` VALUES ('file_ext_other', '', 'upload', '');
INSERT INTO `db_options` VALUES ('keywords', 'JPrass开源博客', 'blog', '');
INSERT INTO `db_options` VALUES ('max_size', '5048', 'upload', '');
INSERT INTO `db_options` VALUES ('rewrite', '1', 'permalink', '');
INSERT INTO `db_options` VALUES ('subtitle', 'JPrass开源博客', 'blog', '');
INSERT INTO `db_options` VALUES ('title', 'JPrass开源博客', 'blog', '');
INSERT INTO `db_options` VALUES ('url', 'http://jprass-blog.localhost.jprass.com', 'blog', '');
INSERT INTO `db_options` VALUES ('url_ext', '.html', 'permalink', '');

-- ----------------------------
-- Table structure for db_restricted_ip
-- ----------------------------
DROP TABLE IF EXISTS `db_restricted_ip`;
CREATE TABLE `db_restricted_ip` (
  `id` bigint(20) NOT NULL DEFAULT '0',
  `ip` varchar(32) NOT NULL,
  `dateline` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_restricted_ip
-- ----------------------------

-- ----------------------------
-- Table structure for db_tag
-- ----------------------------
DROP TABLE IF EXISTS `db_tag`;
CREATE TABLE `db_tag` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_tag
-- ----------------------------

-- ----------------------------
-- Table structure for db_upload
-- ----------------------------
DROP TABLE IF EXISTS `db_upload`;
CREATE TABLE `db_upload` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `originalname` varchar(100) NOT NULL DEFAULT '',
  `filepath` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0',
  `filetype` varchar(50) NOT NULL DEFAULT '',
  `fileext` char(10) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `downloads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_upload
-- ----------------------------

-- ----------------------------
-- Table structure for db_user
-- ----------------------------
DROP TABLE IF EXISTS `db_user`;
CREATE TABLE `db_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `login_name` varchar(20) NOT NULL,
  `login_pwd` varchar(32) NOT NULL,
  `screen_name` varchar(32) NOT NULL,
  `email` varchar(100) DEFAULT '',
  `last_login_time` int(10) unsigned DEFAULT '0',
  `last_login_ip` varchar(16) DEFAULT '0.0.0.0',
  `qq_openid` varchar(64) DEFAULT NULL,
  `enable` enum('N','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`login_name`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_user
-- ----------------------------
INSERT INTO `db_user` VALUES ('100', 'admin', 'c4f1f2b04cbf1d444f1e5bf6a3604358', 'sjime', 'stjdydayou@163.com', '1416658131', '127.0.0.1', null, 'Y');
