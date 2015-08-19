/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50623
Source Host           : localhost:3306
Source Database       : tz

Target Server Type    : MYSQL
Target Server Version : 50623
File Encoding         : 65001

Date: 2015-08-19 19:49:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1440002942');
INSERT INTO `migration` VALUES ('m141206_230735_init', '1440002949');
INSERT INTO `migration` VALUES ('m141206_230740_data', '1440002949');

-- ----------------------------
-- Table structure for positions
-- ----------------------------
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название',
  PRIMARY KEY (`id`),
  UNIQUE KEY `positions_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Должности';

-- ----------------------------
-- Records of positions
-- ----------------------------
INSERT INTO `positions` VALUES ('5', 'Архитектор баз данных');
INSERT INTO `positions` VALUES ('2', 'Дизайнер');
INSERT INTO `positions` VALUES ('7', 'Парень, который ничего не делает');
INSERT INTO `positions` VALUES ('6', 'Пиарщик');
INSERT INTO `positions` VALUES ('1', 'Программист');
INSERT INTO `positions` VALUES ('3', 'Руководитель проекта');
INSERT INTO `positions` VALUES ('4', 'Тестировщик');

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название',
  `description` text COLLATE utf8_unicode_ci COMMENT 'Описание',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Статус',
  `time_create` int(11) DEFAULT NULL COMMENT 'Дата создания',
  `time_update` int(11) DEFAULT NULL COMMENT 'Дата редактирования',
  PRIMARY KEY (`id`),
  KEY `projects_status` (`status`),
  KEY `projects_time_create` (`time_create`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Проекты';

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES ('1', 'Сайт-Визитка', 'Разработать Сайт-Визитку', '1', '1440002949', '1440002949');
INSERT INTO `projects` VALUES ('2', 'Корпоративный сайт', 'Разработать Корпоративный сайт', '1', '1440002949', '1440002949');
INSERT INTO `projects` VALUES ('3', 'Лендинг', 'Разработать продающий лендинг', '1', '1440002949', '1440002949');
INSERT INTO `projects` VALUES ('4', 'Сайт-Визитка', 'Разработать Сайт-Визитку', '1', '1440002949', '1440002949');
INSERT INTO `projects` VALUES ('5', 'Стартап', 'Разработать Стартап', '1', '1440002949', '1440002949');

-- ----------------------------
-- Table structure for projects_positions
-- ----------------------------
DROP TABLE IF EXISTS `projects_positions`;
CREATE TABLE `projects_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_positions_project_id` (`project_id`),
  KEY `projects_positions_user_id` (`user_id`),
  KEY `projects_positions_position_id` (`position_id`),
  CONSTRAINT `projects_positions_position_id` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `projects_positions_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `projects_positions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Отношение Проекты-Должности';

-- ----------------------------
-- Records of projects_positions
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название',
  `auth_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Секретный ключ авторизации',
  `secure_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Секретный ключ',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Пользователи';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Вася', '5i534FxLDcnuW7Ydxm87jOmYgW8I2rEA', 'h_iAcGr8AXyElY8HyfOnt1VkDRshVNgC');
INSERT INTO `users` VALUES ('2', 'Игорь', 'RgpfrrlpUV79slYt_67yMoOFpKvKjDil', 'TgFqU5XlM8d0_cOC0b413vzUjRkQfVMR');
INSERT INTO `users` VALUES ('3', 'Игнат', 'nxxk5_86Py0EKat2EY1qRuhIsGz6PxRe', 'lI-yJzSXHII6L0UeObymMe0PIc-ALE_U');
INSERT INTO `users` VALUES ('4', 'Наташа', 'jKASiAtPuPEgV1w6Xso-NxkWCYjCrfdw', 'EoeI9syCbuboaJIvgMftNEeTe8QGHK7f');
INSERT INTO `users` VALUES ('5', 'Оля', 'sc1wdORY_HKUXwWi3g3rktfFFxbKmYX7', 'eUbIlACv7fjd0C8vv1LKyi_nHjpjMA9T');
INSERT INTO `users` VALUES ('6', 'Костя', 'gGgcylUjZeEBg8g90VkBkW2n67FhV4aZ', 'lbRiIvZkTBKWguaiTD4hET-L1kDEFwAJ');
INSERT INTO `users` VALUES ('7', 'Катя', 'jkRhHTHY_tjnzqgn_uQmajtMgwFI1F9z', '8PiB2UhExloDYmJubPmgDCuoFzltvREN');
INSERT INTO `users` VALUES ('8', 'Вика', 'IMJkwdngFQABPDRb3i0s3L4fKxAr557J', 'WaoPNtfa-YSerw4NS4zzhQK4qJGB6H0S');
INSERT INTO `users` VALUES ('9', 'Олег', '09kUtXFcXto5a8Z-4f1Pvfq2732wxSQN', 'dsaOYrgsUodItAcktwBXA6nivIm6dRCP');
INSERT INTO `users` VALUES ('10', 'Инокентий', 'Ftzgkw7G9KO6RlC8Tzo8inYxjYJexMrz', 'l9Au2A4RJ0kgYQzpGpuLLHHPMYEvVqut');
