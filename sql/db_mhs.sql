-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for db_mhs
CREATE DATABASE IF NOT EXISTS `db_mhs` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_mhs`;


-- Dumping structure for table db_mhs.aauth_groups
CREATE TABLE IF NOT EXISTS `aauth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.aauth_groups: ~3 rows (approximately)
DELETE FROM `aauth_groups`;
/*!40000 ALTER TABLE `aauth_groups` DISABLE KEYS */;
INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
	(1, 'Admin', 'Super Admin Group'),
	(2, 'Public', 'Public Access Group'),
	(3, 'Default', 'Default Access Group');
/*!40000 ALTER TABLE `aauth_groups` ENABLE KEYS */;


-- Dumping structure for table db_mhs.aauth_group_to_group
CREATE TABLE IF NOT EXISTS `aauth_group_to_group` (
  `group_id` int(11) unsigned NOT NULL,
  `subgroup_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`subgroup_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.aauth_group_to_group: ~0 rows (approximately)
DELETE FROM `aauth_group_to_group`;
/*!40000 ALTER TABLE `aauth_group_to_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_group_to_group` ENABLE KEYS */;


-- Dumping structure for table db_mhs.aauth_login_attempts
CREATE TABLE IF NOT EXISTS `aauth_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.aauth_login_attempts: ~0 rows (approximately)
DELETE FROM `aauth_login_attempts`;
/*!40000 ALTER TABLE `aauth_login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_login_attempts` ENABLE KEYS */;


-- Dumping structure for table db_mhs.aauth_perms
CREATE TABLE IF NOT EXISTS `aauth_perms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.aauth_perms: ~80 rows (approximately)
DELETE FROM `aauth_perms`;
/*!40000 ALTER TABLE `aauth_perms` DISABLE KEYS */;
INSERT INTO `aauth_perms` (`id`, `name`, `definition`) VALUES
	(1, '1_menu', 'Main Navigation - Label'),
	(2, '2_menu', 'Labels - Label'),
	(3, '3_menu', 'Dashboard - Menu'),
	(4, '4_menu', 'Dashboard v1 - Menu'),
	(5, '5_menu', 'Dashboard v2 - Menu'),
	(6, '6_menu', 'Layout Options - Menu'),
	(7, '7_menu', 'Top Navigation - Menu'),
	(8, '8_menu', 'Boxed - Menu'),
	(9, '9_menu', 'Fixed - Menu'),
	(10, '10_menu', 'Collapsed Sidebar - Menu'),
	(11, '11_menu', 'Widgets - Menu'),
	(12, '12_menu', 'Charts - Menu'),
	(13, '13_menu', 'ChartJS - Menu'),
	(14, '14_menu', 'Morris - Menu'),
	(15, '15_menu', 'Flot - Menu'),
	(16, '16_menu', 'Inline Charts - Menu'),
	(17, '17_menu', 'UI Elements - Menu'),
	(18, '18_menu', 'General - Menu'),
	(19, '19_menu', 'Icons - Menu'),
	(20, '20_menu', 'Buttons - Menu'),
	(21, '21_menu', 'Sliders - Menu'),
	(22, '22_menu', 'Timeline - Menu'),
	(23, '23_menu', 'Modals - Menu'),
	(24, '24_menu', 'Forms - Menu'),
	(25, '25_menu', 'General Elements - Menu'),
	(26, '26_menu', 'Advanced Elements - Menu'),
	(27, '27_menu', 'Editors - Menu'),
	(28, '28_menu', 'Tables - Menu'),
	(29, '29_menu', 'Simple Table - Menu'),
	(30, '30_menu', 'Data Tables - Menu'),
	(31, '31_menu', 'Calendar - Menu'),
	(32, '32_menu', 'Mailbox - Menu ( TEMPLATE )'),
	(33, '33_menu', 'Examples - Menu'),
	(34, '34_menu', 'Invoice - Menu'),
	(35, '35_menu', 'Profile - Menu'),
	(36, '36_menu', 'Login - Menu'),
	(37, '37_menu', 'Register - Menu'),
	(38, '38_menu', 'Lockscreen - Menu'),
	(39, '39_menu', '404 Error - Menu'),
	(40, '40_menu', '500 Error - Menu'),
	(41, '41_menu', 'Blank Page - Menu'),
	(42, '42_menu', 'Pace Page - Menu'),
	(43, '43_menu', 'Multilevel - Menu'),
	(44, '44_menu', 'Level One - Menu'),
	(45, '45_menu', 'Level One - Menu'),
	(46, '46_menu', 'Level One - Menu'),
	(47, '47_menu', 'Level Two - Menu'),
	(48, '48_menu', 'Level Two - Menu'),
	(49, '49_menu', 'Level Three - Menu'),
	(50, '50_menu', 'Level Three - Menu'),
	(51, '51_menu', 'Documentation - Menu'),
	(52, '52_menu', 'Important - Menu'),
	(53, '53_menu', 'Warning - Menu'),
	(54, '54_menu', 'Information - Menu'),
	(55, '55_menu', 'Backend Settings - Label'),
	(56, '56_menu', 'Menu - Menu'),
	(57, '57_menu', 'Users - Menu'),
	(65, '58_menu', 'Groups - Menu'),
	(67, '59_menu', 'Permission - Menu'),
	(68, 'menu_add', 'Add Menu/ Submenu - Action'),
	(69, 'menu_delete', 'Delete Menu/ Submenu - Action'),
	(70, 'menu_edit', 'Edit Menu/ Submenu Details - Action'),
	(71, 'menu_common', 'Basic ( Arrange & View Menu Details ) - Action'),
	(72, 'user_add', 'Add User - Action'),
	(73, 'user_edit', 'Edit User Data - Action'),
	(74, 'user_ban', 'Ban User - Action'),
	(75, 'user_unban', 'Unban User - Action'),
	(76, 'user_common', 'Basic ( Profile ) - Action'),
	(77, 'user_log', 'View User Activity Log - Feature'),
	(78, 'user_permission', 'Modify User Permission - Ability'),
	(79, 'user_group', 'Modify User Groups - Ability'),
	(80, 'user_password', 'Reset User Password - Ability'),
	(81, 'group_add', 'Add Group - Action'),
	(82, 'group_edit', 'Edit Group Data - Action'),
	(83, 'group_delete', 'Delete Group - Action'),
	(84, 'permission_add', 'Add Permission Data - Action'),
	(85, 'permission_edit', 'Edit Permission Data - Action'),
	(86, 'permission_delete', 'Delete Permission Data - Action'),
	(87, '61_menu', 'Mailbox - Menu'),
	(108, '68_menu', 'Menu Mahasiswa');
/*!40000 ALTER TABLE `aauth_perms` ENABLE KEYS */;


-- Dumping structure for table db_mhs.aauth_perm_to_group
CREATE TABLE IF NOT EXISTS `aauth_perm_to_group` (
  `perm_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perm_id`,`group_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.aauth_perm_to_group: ~0 rows (approximately)
DELETE FROM `aauth_perm_to_group`;
/*!40000 ALTER TABLE `aauth_perm_to_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_perm_to_group` ENABLE KEYS */;


-- Dumping structure for table db_mhs.aauth_perm_to_user
CREATE TABLE IF NOT EXISTS `aauth_perm_to_user` (
  `perm_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perm_id`,`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.aauth_perm_to_user: ~0 rows (approximately)
DELETE FROM `aauth_perm_to_user`;
/*!40000 ALTER TABLE `aauth_perm_to_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_perm_to_user` ENABLE KEYS */;


-- Dumping structure for table db_mhs.aauth_pms
CREATE TABLE IF NOT EXISTS `aauth_pms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) unsigned NOT NULL,
  `receiver_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.aauth_pms: ~0 rows (approximately)
DELETE FROM `aauth_pms`;
/*!40000 ALTER TABLE `aauth_pms` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_pms` ENABLE KEYS */;


-- Dumping structure for table db_mhs.aauth_system_variables
CREATE TABLE IF NOT EXISTS `aauth_system_variables` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `data_key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.aauth_system_variables: ~0 rows (approximately)
DELETE FROM `aauth_system_variables`;
/*!40000 ALTER TABLE `aauth_system_variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `aauth_system_variables` ENABLE KEYS */;


-- Dumping structure for table db_mhs.aauth_users
CREATE TABLE IF NOT EXISTS `aauth_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(64) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` datetime DEFAULT NULL,
  `verification_code` text DEFAULT NULL,
  `totp_secret` varchar(15) DEFAULT NULL,
  `ip_address` text DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `EMAIL_UNIQUE` (`email`) USING BTREE,
  UNIQUE KEY `USERNAME_UNIQUE` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.aauth_users: ~1 rows (approximately)
DELETE FROM `aauth_users`;
/*!40000 ALTER TABLE `aauth_users` DISABLE KEYS */;
INSERT INTO `aauth_users` (`id`, `email`, `pass`, `username`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`) VALUES
	(1, 'admin@example.com', '5711aa2253ac62088bf34f79f8ccd82e41bdbcf32e7670772d2a1e1746a9be9b', 'Admin', 0, '2020-07-22 16:05:54', '2020-07-22 16:05:54', NULL, NULL, NULL, NULL, NULL, NULL, '::1');
/*!40000 ALTER TABLE `aauth_users` ENABLE KEYS */;


-- Dumping structure for table db_mhs.aauth_user_to_group
CREATE TABLE IF NOT EXISTS `aauth_user_to_group` (
  `user_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.aauth_user_to_group: ~1 rows (approximately)
DELETE FROM `aauth_user_to_group`;
/*!40000 ALTER TABLE `aauth_user_to_group` DISABLE KEYS */;
INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
	(1, 1);
/*!40000 ALTER TABLE `aauth_user_to_group` ENABLE KEYS */;


-- Dumping structure for table db_mhs.aauth_user_variables
CREATE TABLE IF NOT EXISTS `aauth_user_variables` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id_index` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.aauth_user_variables: ~7 rows (approximately)
DELETE FROM `aauth_user_variables`;
/*!40000 ALTER TABLE `aauth_user_variables` DISABLE KEYS */;
INSERT INTO `aauth_user_variables` (`id`, `user_id`, `data_key`, `value`) VALUES
	(1, 1, 'activeTemplate', 'default/'),
	(2, 1, 'profileName', 'Administrator'),
	(3, 1, 'profilePic', 'assets/profilePicture/ppacid2.jpg'),
	(4, 1, 'profileJob', 'Web Developer'),
	(5, 1, 'profileReg', '2012-11-01'),
	(6, 1, 'activeTemplate', 'default/'),
	(7, 1, 'profileReg', '2018-02-08');
/*!40000 ALTER TABLE `aauth_user_variables` ENABLE KEYS */;


-- Dumping structure for table db_mhs.backendmenu
CREATE TABLE IF NOT EXISTS `backendmenu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(2) NOT NULL DEFAULT 0,
  `order` int(2) NOT NULL DEFAULT 0,
  `config` text DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.backendmenu: ~63 rows (approximately)
DELETE FROM `backendmenu`;
/*!40000 ALTER TABLE `backendmenu` DISABLE KEYS */;
INSERT INTO `backendmenu` (`id`, `parent_id`, `order`, `config`) VALUES
	(1, 0, 2, 'MAIN NAVIGATION'),
	(2, 0, 3, 'LABELS'),
	(3, 1, 0, '{"menuName":"Dashboard","menuLink":"#","menuIcon":"fa fa-dashboard","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(4, 3, 0, '{"menuName":"Dashboard v1","menuLink":"home","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(5, 3, 1, '{"menuName":"Dashboard v2","menuLink":"home/v2","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(6, 1, 2, '{"menuName":"Layout Options","menuLink":"#","menuIcon":"fa fa-files-o","showNotif":true,"menuNotif":"4","menuNotifColor":"label-primary","menuActive":""}'),
	(7, 6, 0, '{"menuName":"Top Navigation","menuLink":"layout/top_navigation","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(8, 6, 1, '{"menuName":"Boxed","menuLink":"layout/boxed","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(9, 6, 2, '{"menuName":"Fixed","menuLink":"layout/fixed","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(10, 6, 3, '{"menuName":"Collapsed Sidebar","menuLink":"layout/collapsed","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(11, 1, 1, '{"menuName":"Widgets","menuLink":"widgets","menuIcon":"fa fa-th","menuNotif":"new","menuNotifColor":"bg-green","menuActive":""}'),
	(12, 1, 3, '{"menuName":"Charts","menuLink":"#","menuIcon":"fa fa-pie-chart","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(13, 12, 0, '{"menuName":"ChartJS","menuLink":"charts/chartJS","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(14, 12, 1, '{"menuName":"Morris","menuLink":"charts/morris","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(15, 12, 2, '{"menuName":"Flot","menuLink":"charts/flot","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(16, 12, 3, '{"menuName":"Inline Charts","menuLink":"charts/inline","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(17, 1, 4, '{"menuName":"UI Elements","menuLink":"#","menuIcon":"fa fa-laptop","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(18, 17, 0, '{"menuName":"General","menuLink":"ui/general","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(19, 17, 1, '{"menuName":"Icons","menuLink":"ui/icons","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(20, 17, 2, '{"menuName":"Buttons","menuLink":"ui/buttons","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(21, 17, 3, '{"menuName":"Sliders","menuLink":"ui/sliders","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(22, 17, 4, '{"menuName":"Timeline","menuLink":"ui/timeline","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(23, 17, 5, '{"menuName":"Modals","menuLink":"ui/modals","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(24, 1, 5, '{"menuName":"Forms","menuLink":"#","menuIcon":"fa fa-edit","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(25, 24, 0, '{"menuName":"General Elements","menuLink":"forms/general","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(26, 24, 1, '{"menuName":"Advanced Elements","menuLink":"forms/advance","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(27, 24, 2, '{"menuName":"Editors","menuLink":"forms/editors","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(28, 1, 6, '{"menuName":"Tables","menuLink":"#","menuIcon":"fa fa-table","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(29, 28, 0, '{"menuName":"Simple tables","menuLink":"tables/simple","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(30, 28, 1, '{"menuName":"Data tables","menuLink":"tables/data","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(31, 1, 7, '{"menuName":"Calendar","menuLink":"calendar","menuIcon":"fa fa-calendar","menuNotif":"3","menuNotifColor":"bg-red","menuActive":""}'),
	(32, 1, 8, '{"menuName":"Mailbox","menuLink":"mail","menuIcon":"fa fa-envelope","menuNotif":"12","menuNotifColor":"bg-yellow","menuActive":""}'),
	(33, 1, 9, '{"menuName":"Examples","menuLink":"#","menuIcon":"fa fa-folder","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(34, 33, 0, '{"menuName":"Invoice","menuLink":"sample/invoice","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(35, 33, 1, '{"menuName":"Profile","menuLink":"sample/profile","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(36, 33, 2, '{"menuName":"Login","menuLink":"sample/login","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(37, 33, 3, '{"menuName":"Register","menuLink":"sample/register","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(38, 33, 4, '{"menuName":"Lockscreen","menuLink":"sample/lockscreen","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(39, 33, 5, '{"menuName":"404 Error","menuLink":"sample/error_404","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(40, 33, 6, '{"menuName":"500 Error","menuLink":"sample/error_500","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(41, 33, 7, '{"menuName":"Blank Page","menuLink":"sample/blank","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(42, 33, 8, '{"menuName":"Pace Page","menuLink":"sample/pace","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(43, 1, 10, '{"menuName":"Multilevel","menuLink":"#","menuIcon":"fa fa-share","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(44, 43, 0, '{"menuName":"Level One","menuLink":"#","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(45, 43, 1, '{"menuName":"Level One","menuLink":"#","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(46, 43, 2, '{"menuName":"Level One","menuLink":"#","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(47, 45, 0, '{"menuName":"Level Two","menuLink":"#","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(48, 45, 1, '{"menuName":"Level Two","menuLink":"#","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(49, 48, 0, '{"menuName":"Level Three","menuLink":"#","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(50, 48, 1, '{"menuName":"Level Three","menuLink":"#","menuIcon":"fa fa-circle-o","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(51, 1, 11, '{"menuName":"Documentation","menuLink":"documentation","menuIcon":"fa fa-book","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(52, 2, 0, '{"menuName":"Important","menuLink":"#","menuIcon":"fa fa-circle-o text-red","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(53, 2, 1, '{"menuName":"Warning","menuLink":"#","menuIcon":"fa fa-circle-o text-yellow","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(54, 2, 2, '{"menuName":"Information","menuLink":"#","menuIcon":"fa fa-circle-o text-aqua","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(55, 0, 1, 'BACKEND SETTINGS'),
	(56, 55, 3, '{"menuName":"Menu","menuLink":"settings/menu","menuIcon":"fa fa-list-ul","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(57, 55, 0, '{"menuName":"Users","menuLink":"settings/users","menuIcon":"fa fa-user","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(58, 55, 1, '{"menuName":"Groups","menuLink":"settings/groups","menuIcon":"fa fa-users","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(59, 55, 2, '{"menuName":"Permissions","menuLink":"settings/permissions","menuIcon":"fa fa-legal","menuNotif":"","menuNotifColor":"","menuActive":""}'),
	(60, 0, 0, 'MAIN MENU'),
	(61, 60, 0, '{"menuName":"Mailbox","menuLink":"message","menuIcon":"fa fa-envelope","menuNotif":"","menuNotifColor":"4","menuActive":""}'),
	(67, 0, 4, 'MAHASISWA'),
	(68, 67, 0, '{"menuName":"Mahasiswa","menuLink":"mahasiswa","menuIcon":"fa fa-black-tie","menuNotif":"","menuNotifColor":"","menuActive":""}');
/*!40000 ALTER TABLE `backendmenu` ENABLE KEYS */;


-- Dumping structure for table db_mhs.mst_sessions
CREATE TABLE IF NOT EXISTS `mst_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.mst_sessions: ~8 rows (approximately)
DELETE FROM `mst_sessions`;
/*!40000 ALTER TABLE `mst_sessions` DISABLE KEYS */;
INSERT INTO `mst_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
	('19ce0urmns9tk62eu6gqr1ds0je530jc', '::1', 1595084974, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353038343937343B69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B656D61696C7C733A31373A2261646D696E406578616D706C652E636F6D223B6C6F67676564696E7C623A313B61637469766974797C733A31393A225375636365737366756C6C79206C6F67696E2E223B),
	('qrnovgh4atrj28jb70ja9vj4vihehp59', '::1', 1595085259, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353038343937343B69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B656D61696C7C733A31373A2261646D696E406578616D706C652E636F6D223B6C6F67676564696E7C623A313B61637469766974797C733A31393A225375636365737366756C6C79206C6F67696E2E223B),
	('ve1jnedkhchb3fuvs54mjnfv6kqg88nn', '::1', 1595085112, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353038353131313B),
	('rr2a7qslav60s0feu8281hep05uret5q', '::1', 1595085112, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353038353131323B),
	('kikjen0dvpl77ocgflnn1jvafbfsnbk2', '::1', 1595174542, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353137343534323B),
	('oqbabcpordcfteujbb1vim2ic0l6rjp5', '::1', 1595426754, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353432363735343B),
	('fr762tsar2hnl5a3caevi1cq8ue4jgkg', '::1', 1595427058, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353432373035383B69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B656D61696C7C733A31373A2261646D696E406578616D706C652E636F6D223B6C6F67676564696E7C623A313B61637469766974797C733A31393A225375636365737366756C6C79206C6F67696E2E223B),
	('4n4f22k1okoerhlcve92l7jnj9u6t6qj', '::1', 1595427361, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353432373336313B69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B656D61696C7C733A31373A2261646D696E406578616D706C652E636F6D223B6C6F67676564696E7C623A313B61637469766974797C733A31393A225375636365737366756C6C79206C6F67696E2E223B),
	('reon7eo0nvtm11ljpn49lcf7kesgji79', '::1', 1595428606, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353432383630363B69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B656D61696C7C733A31373A2261646D696E406578616D706C652E636F6D223B6C6F67676564696E7C623A313B61637469766974797C733A31393A225375636365737366756C6C79206C6F67696E2E223B),
	('neqc5lnh8sj8v0d15ieqkik9p3tmlsl1', '::1', 1595428913, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353432383931333B69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B656D61696C7C733A31373A2261646D696E406578616D706C652E636F6D223B6C6F67676564696E7C623A313B61637469766974797C733A31393A225375636365737366756C6C79206C6F67696E2E223B),
	('f8hrg1us9g73vk08itnkogmh6010lvga', '::1', 1595429597, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353432393539373B69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B656D61696C7C733A31373A2261646D696E406578616D706C652E636F6D223B6C6F67676564696E7C623A313B61637469766974797C733A31393A225375636365737366756C6C79206C6F67696E2E223B),
	('0c62nd4nhpnishclu5jvio3jieo9mrjv', '::1', 1595430075, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353433303037353B69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B656D61696C7C733A31373A2261646D696E406578616D706C652E636F6D223B6C6F67676564696E7C623A313B61637469766974797C733A31393A225375636365737366756C6C79206C6F67696E2E223B),
	('phgtr7umb54seccfe0tfb44gbi9evcln', '::1', 1595430401, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353433303430313B69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B656D61696C7C733A31373A2261646D696E406578616D706C652E636F6D223B6C6F67676564696E7C623A313B61637469766974797C733A31393A225375636365737366756C6C79206C6F67696E2E223B),
	('lrht75ehgnr7a7hmp51sih8ah6f12ae3', '::1', 1595431152, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353433313135323B69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B656D61696C7C733A31373A2261646D696E406578616D706C652E636F6D223B6C6F67676564696E7C623A313B61637469766974797C733A31393A225375636365737366756C6C79206C6F67696E2E223B),
	('9209fdn1m2nm67umisluf9ibjturlabq', '::1', 1595431168, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313539353433313135323B69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B656D61696C7C733A31373A2261646D696E406578616D706C652E636F6D223B6C6F67676564696E7C623A313B61637469766974797C733A31393A225375636365737366756C6C79206C6F67696E2E223B);
/*!40000 ALTER TABLE `mst_sessions` ENABLE KEYS */;


-- Dumping structure for table db_mhs.tbagama
CREATE TABLE IF NOT EXISTS `tbagama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agama` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_mhs.tbagama: ~0 rows (approximately)
DELETE FROM `tbagama`;
/*!40000 ALTER TABLE `tbagama` DISABLE KEYS */;
INSERT INTO `tbagama` (`id`, `agama`) VALUES
	(1, 'Islam'),
	(2, 'Kristen'),
	(3, 'Protestan'),
	(4, 'Hindu'),
	(5, 'Buddha');
/*!40000 ALTER TABLE `tbagama` ENABLE KEYS */;


-- Dumping structure for table db_mhs.tbmhs
CREATE TABLE IF NOT EXISTS `tbmhs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `agama` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_mhs.tbmhs: ~10 rows (approximately)
DELETE FROM `tbmhs`;
/*!40000 ALTER TABLE `tbmhs` DISABLE KEYS */;
INSERT INTO `tbmhs` (`id`, `nama`, `alamat`, `agama`) VALUES
	(1, 'Airi', 'Tokyo', 'Islam'),
	(2, 'Angelica', 'London', 'Islam'),
	(3, 'Ashton', 'San Francisco', 'Islam'),
	(4, 'Bradley', 'London', 'Kristen'),
	(5, 'Brenden', 'San Francisco', 'Kristen'),
	(6, 'Brielle', 'New York', 'Kristen'),
	(7, 'Bruno', 'London', 'Hindu'),
	(8, 'Caesar', 'New York', 'Hindu'),
	(9, 'Cara', 'New York', 'Hindu'),
	(10, 'Cedric', 'Edinburgh', 'Hindu'),
	(14, 'Farhan', 'a', 'Kristen'),
	(15, 'Agus', 'Ciputat', 'Buddha');
/*!40000 ALTER TABLE `tbmhs` ENABLE KEYS */;


-- Dumping structure for table db_mhs.users_activity
CREATE TABLE IF NOT EXISTS `users_activity` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL DEFAULT 0,
  `ACTIVITY` varchar(100) DEFAULT '',
  `URL_SOURCE` text DEFAULT NULL,
  `REQUEST_DATA` text DEFAULT NULL,
  `IP_ADDRESS` varchar(50) DEFAULT NULL,
  `LOG_DATE` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`) USING BTREE,
  KEY `USER_ID` (`USER_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=162 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_mhs.users_activity: 65 rows
DELETE FROM `users_activity`;
/*!40000 ALTER TABLE `users_activity` DISABLE KEYS */;
INSERT INTO `users_activity` (`ID`, `USER_ID`, `ACTIVITY`, `URL_SOURCE`, `REQUEST_DATA`, `IP_ADDRESS`, `LOG_DATE`) VALUES
	(1, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:02:44'),
	(2, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:03:25'),
	(3, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:03:26'),
	(4, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:03:27'),
	(5, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:03:27'),
	(6, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:03:27'),
	(7, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:03:27'),
	(8, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:03:51'),
	(9, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:03:53'),
	(10, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:03:53'),
	(11, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:03:53'),
	(12, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:04:13'),
	(13, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:04:39'),
	(14, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:05:14'),
	(15, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:05:18'),
	(16, 1, 'GET', 'http://localhost/fac-ci-backend/home', 'No Request Data', '::1', '2020-07-18 22:05:52'),
	(17, 1, 'GET : Profile Access - Success', 'http://localhost/fac-ci-backend/profile', '{"userId":"1"}', '::1', '2020-07-18 22:09:34'),
	(18, 1, 'POST : Profile Access - Success', 'http://localhost/fac-ci-backend/settings/users/save/password', '{"pPass":"No Peeping Password !","cpPass":"No Peeping Password !","pId":"1"}', '::1', '2020-07-18 22:09:41'),
	(19, 1, 'GET', 'http://localhost/fac-ci-backend/home', 'No Request Data', '::1', '2020-07-18 22:09:45'),
	(20, 1, 'GET', 'http://localhost/fac-ci-backend/home', 'No Request Data', '::1', '2020-07-18 22:11:26'),
	(21, 1, 'GET : Permissions Menu Access - Success', 'http://localhost/fac-ci-backend/settings/permissions', 'No Request Data', '::1', '2020-07-18 22:11:38'),
	(22, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-18 22:11:52'),
	(23, 1, 'GET : Profile Access - Success', 'http://localhost/fac-ci-backend/profile', '{"userId":"1"}', '::1', '2020-07-18 22:14:19'),
	(24, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-19 22:59:52'),
	(25, 1, 'GET', 'http://localhost/fac-ci-backend/home', 'No Request Data', '::1', '2020-07-19 23:00:03'),
	(26, 1, 'GET', 'http://localhost/fac-ci-backend/home/v2', 'No Request Data', '::1', '2020-07-19 23:00:11'),
	(27, 1, 'GET', 'http://localhost/fac-ci-backend/charts/chartJS', 'No Request Data', '::1', '2020-07-19 23:00:15'),
	(28, 1, 'GET : Users Menu Access - Success', 'http://localhost/fac-ci-backend/settings/users', 'No Request Data', '::1', '2020-07-19 23:00:17'),
	(29, 1, 'GET : Groups Menu Access - Success', 'http://localhost/fac-ci-backend/settings/groups', 'No Request Data', '::1', '2020-07-19 23:00:18'),
	(30, 1, 'GET : Permissions Menu Access - Success', 'http://localhost/fac-ci-backend/settings/permissions', 'No Request Data', '::1', '2020-07-19 23:00:19'),
	(31, 1, 'GET : Menu Access - Success', 'http://localhost/fac-ci-backend/settings/menu', 'No Request Data', '::1', '2020-07-19 23:00:20'),
	(32, 1, 'GET : Permissions Menu Access - Success', 'http://localhost/fac-ci-backend/settings/permissions', 'No Request Data', '::1', '2020-07-19 23:01:56'),
	(33, 1, 'GET : Groups Menu Access - Success', 'http://localhost/fac-ci-backend/settings/groups', 'No Request Data', '::1', '2020-07-19 23:01:57'),
	(34, 1, 'GET : Users Menu Access - Success', 'http://localhost/fac-ci-backend/settings/users', 'No Request Data', '::1', '2020-07-19 23:01:58'),
	(35, 1, 'GET', 'http://localhost/fac-ci-backend/message', 'No Request Data', '::1', '2020-07-19 23:01:59'),
	(36, 0, 'GET', 'http://localhost/fac-ci-backend/login', 'No Request Data', '::1', '2020-07-19 23:02:22'),
	(37, 0, 'GET', 'http://localhost/projectmhs/login', 'No Request Data', '::1', '2020-07-22 20:58:10'),
	(38, 1, 'GET', 'http://localhost/projectmhs/home', 'No Request Data', '::1', '2020-07-22 21:05:54'),
	(39, 1, 'GET : Menu Access - Success', 'http://localhost/projectmhs/settings/menu', 'No Request Data', '::1', '2020-07-22 21:06:15'),
	(40, 1, 'GET : Permissions Menu Access - Success', 'http://localhost/projectmhs/settings/permissions', 'No Request Data', '::1', '2020-07-22 21:06:21'),
	(41, 1, 'GET : Menu Access - Success', 'http://localhost/projectmhs/settings/menu', 'No Request Data', '::1', '2020-07-22 21:06:25'),
	(42, 1, 'GET : Add Menu/ Submenu Access - Success', 'http://localhost/projectmhs/settings/menu/add', '{"menuId":"","parentId":""}', '::1', '2020-07-22 21:06:27'),
	(43, 1, 'POST : Menu/ Submenu Details Access - Success', 'http://localhost/projectmhs/settings/menu/save/new', '{"mnuName":"MAHASISWA"}', '::1', '2020-07-22 21:06:36'),
	(44, 1, 'GET : Menu/ Submenu Details Access - Success', 'http://localhost/projectmhs/settings/menu/details/67/0', '{"menuId":"67","parentId":"0"}', '::1', '2020-07-22 21:06:38'),
	(45, 1, 'GET : Add Menu/ Submenu Access - Success', 'http://localhost/projectmhs/settings/menu/add/67/0', '{"menuId":"67","parentId":"0"}', '::1', '2020-07-22 21:06:39'),
	(46, 1, 'GET', 'http://localhost/projectmhs/ui/icons', 'No Request Data', '::1', '2020-07-22 21:06:49'),
	(47, 1, 'POST : Menu/ Submenu Details Access - Success', 'http://localhost/projectmhs/settings/menu/save/67/0/new', '{"mnuName":"Mahasiswa","mnuLink":"mahasiswa","mnuIcon":"fa fa-black-tie","mnuNotifColor":""}', '::1', '2020-07-22 21:07:02'),
	(48, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:07:06'),
	(49, 1, 'GET : Permissions Menu Access - Success', 'http://localhost/projectmhs/settings/permissions', 'No Request Data', '::1', '2020-07-22 21:07:14'),
	(50, 1, 'GET : Edit Permission Access - Success', 'http://localhost/projectmhs/settings/permissions/edit/108', '{"permissionId":"108"}', '::1', '2020-07-22 21:07:19'),
	(51, 1, 'POST : Permissions Menu Access - Success', 'http://localhost/projectmhs/settings/permissions/save/108', '{"pName":"68_menu","pDesc":"Menu Mahasiswa"}', '::1', '2020-07-22 21:07:29'),
	(52, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:07:34'),
	(53, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:08:10'),
	(54, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:08:57'),
	(55, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595426937209"}', '::1', '2020-07-22 21:08:57'),
	(56, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:09:16'),
	(57, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:09:26'),
	(58, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595426966071"}', '::1', '2020-07-22 21:09:26'),
	(59, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:09:52'),
	(60, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595426992946"}', '::1', '2020-07-22 21:09:53'),
	(61, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:10:58'),
	(62, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595427058160"}', '::1', '2020-07-22 21:10:58'),
	(63, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:12:59'),
	(64, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:13:17'),
	(65, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595427197671"}', '::1', '2020-07-22 21:13:17'),
	(66, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:15:10'),
	(67, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595427310145"}', '::1', '2020-07-22 21:15:10'),
	(68, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:15:48'),
	(69, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:16:01'),
	(70, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595427361375"}', '::1', '2020-07-22 21:16:01'),
	(71, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:18:29'),
	(72, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595427509839"}', '::1', '2020-07-22 21:18:29'),
	(73, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:18:49'),
	(74, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595427529779"}', '::1', '2020-07-22 21:18:49'),
	(75, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', 'No Request Data', '::1', '2020-07-22 21:18:52'),
	(76, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":"Islam"}', '::1', '2020-07-22 21:18:55'),
	(77, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":"I"}', '::1', '2020-07-22 21:18:59'),
	(78, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":""}', '::1', '2020-07-22 21:19:06'),
	(79, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:19:20'),
	(80, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595427560604"}', '::1', '2020-07-22 21:19:20'),
	(81, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', 'No Request Data', '::1', '2020-07-22 21:19:23'),
	(82, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:19:29'),
	(83, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595427569638"}', '::1', '2020-07-22 21:19:29'),
	(84, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', 'No Request Data', '::1', '2020-07-22 21:19:32'),
	(85, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":""}', '::1', '2020-07-22 21:19:33'),
	(86, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":"kri"}', '::1', '2020-07-22 21:19:34'),
	(87, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:36:46'),
	(88, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595428606355"}', '::1', '2020-07-22 21:36:46'),
	(89, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:36:57'),
	(90, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595428617353"}', '::1', '2020-07-22 21:36:57'),
	(91, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:37:22'),
	(92, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595428642999"}', '::1', '2020-07-22 21:37:23'),
	(93, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', 'No Request Data', '::1', '2020-07-22 21:37:26'),
	(94, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":"Islam"}', '::1', '2020-07-22 21:37:29'),
	(95, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":""}', '::1', '2020-07-22 21:37:31'),
	(96, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":"I"}', '::1', '2020-07-22 21:37:31'),
	(97, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', 'No Request Data', '::1', '2020-07-22 21:37:37'),
	(98, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":"Ilam"}', '::1', '2020-07-22 21:37:40'),
	(99, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":"Islam"}', '::1', '2020-07-22 21:37:42'),
	(100, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":"I"}', '::1', '2020-07-22 21:37:44'),
	(101, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":""}', '::1', '2020-07-22 21:37:44'),
	(102, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":"I"}', '::1', '2020-07-22 21:37:46'),
	(103, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/getAgama', '{"searchTerm":""}', '::1', '2020-07-22 21:37:47'),
	(104, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:40:22'),
	(105, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595428822177"}', '::1', '2020-07-22 21:40:22'),
	(106, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:40:47'),
	(107, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595428847177"}', '::1', '2020-07-22 21:40:47'),
	(108, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:41:53'),
	(109, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595428913659"}', '::1', '2020-07-22 21:41:53'),
	(110, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:42:04'),
	(111, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595428924976"}', '::1', '2020-07-22 21:42:05'),
	(112, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:43:51'),
	(113, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595429031765"}', '::1', '2020-07-22 21:43:51'),
	(114, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:44:11'),
	(115, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595429051071"}', '::1', '2020-07-22 21:44:11'),
	(116, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:53:17'),
	(117, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595429597419"}', '::1', '2020-07-22 21:53:17'),
	(118, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:53:29'),
	(119, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595429609767"}', '::1', '2020-07-22 21:53:29'),
	(120, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"2","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"10","length":"10","search":{"value":"","regex":"false"},"_":"1595429609768"}', '::1', '2020-07-22 21:53:32'),
	(121, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/deleteDataMHS', '{"id":"11"}', '::1', '2020-07-22 21:53:42'),
	(122, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"3","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595429609769"}', '::1', '2020-07-22 21:53:42'),
	(123, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:54:20'),
	(124, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595429660841"}', '::1', '2020-07-22 21:54:20'),
	(125, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:54:46'),
	(126, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595429686113"}', '::1', '2020-07-22 21:54:46'),
	(127, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"2","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"10","length":"10","search":{"value":"","regex":"false"},"_":"1595429686114"}', '::1', '2020-07-22 21:54:47'),
	(128, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/deleteDataMHS', '{"id":"12"}', '::1', '2020-07-22 21:57:56'),
	(129, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"3","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595429686115"}', '::1', '2020-07-22 21:57:56'),
	(130, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 21:58:06'),
	(131, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595429886872"}', '::1', '2020-07-22 21:58:06'),
	(132, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"2","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"10","length":"10","search":{"value":"","regex":"false"},"_":"1595429886873"}', '::1', '2020-07-22 21:58:08'),
	(133, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:01:15'),
	(134, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595430075850"}', '::1', '2020-07-22 22:01:15'),
	(135, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:01:26'),
	(136, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595430086729"}', '::1', '2020-07-22 22:01:26'),
	(137, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"2","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"10","length":"10","search":{"value":"","regex":"false"},"_":"1595430086730"}', '::1', '2020-07-22 22:01:28'),
	(138, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:02:18'),
	(139, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595430138161"}', '::1', '2020-07-22 22:02:18'),
	(140, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"2","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"10","length":"10","search":{"value":"","regex":"false"},"_":"1595430138162"}', '::1', '2020-07-22 22:02:20'),
	(141, 1, 'POST', 'http://localhost/projectmhs/mahasiswa/deleteDataMHS', '{"id":"13"}', '::1', '2020-07-22 22:02:32'),
	(142, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"3","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595430138163"}', '::1', '2020-07-22 22:02:32'),
	(143, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:03:16'),
	(144, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595430196400"}', '::1', '2020-07-22 22:03:16'),
	(145, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"2","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"10","length":"10","search":{"value":"","regex":"false"},"_":"1595430196401"}', '::1', '2020-07-22 22:03:17'),
	(146, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"3","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595430196402"}', '::1', '2020-07-22 22:03:26'),
	(147, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:03:44'),
	(148, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:03:50'),
	(149, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595430230047"}', '::1', '2020-07-22 22:03:50'),
	(150, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:04:08'),
	(151, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"2","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595430248789"}', '::1', '2020-07-22 22:04:08'),
	(152, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:06:41'),
	(153, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:07:01'),
	(154, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:07:10'),
	(155, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:07:23'),
	(156, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"","name":"","searchable":"true","orderable":"false","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595430443330"}', '::1', '2020-07-22 22:07:23'),
	(157, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:19:12'),
	(158, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"id","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"1","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595431152274"}', '::1', '2020-07-22 22:19:12'),
	(159, 1, 'GET : Users Menu Access - Success', 'http://localhost/projectmhs/mahasiswa', 'No Request Data', '::1', '2020-07-22 22:19:24'),
	(160, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"1","columns":{"0":{"data":"id","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"0","dir":"asc"}},"start":"0","length":"10","search":{"value":"","regex":"false"},"_":"1595431164901"}', '::1', '2020-07-22 22:19:25'),
	(161, 1, 'GET', 'http://localhost/projectmhs/mahasiswa/getDataMHS', '{"draw":"2","columns":{"0":{"data":"id","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"1":{"data":"nama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"2":{"data":"alamat","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"3":{"data":"agama","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}},"4":{"data":"aksi","name":"","searchable":"true","orderable":"true","search":{"value":"","regex":"false"}}},"order":{"0":{"column":"0","dir":"asc"}},"start":"10","length":"10","search":{"value":"","regex":"false"},"_":"1595431164902"}', '::1', '2020-07-22 22:19:28');
/*!40000 ALTER TABLE `users_activity` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
