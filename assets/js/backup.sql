#
# TABLE STRUCTURE FOR: acc_account_name
#

DROP TABLE IF EXISTS `acc_account_name`;

CREATE TABLE `acc_account_name` (
  `account_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) NOT NULL,
  `account_type` int(11) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `acc_account_name` (`account_id`, `account_name`, `account_type`) VALUES ('1', 'Employee Salary', '0');
INSERT INTO `acc_account_name` (`account_id`, `account_name`, `account_type`) VALUES ('3', 'Example', '1');
INSERT INTO `acc_account_name` (`account_id`, `account_name`, `account_type`) VALUES ('4', 'Loan Expense', '0');
INSERT INTO `acc_account_name` (`account_id`, `account_name`, `account_type`) VALUES ('5', 'Loan Income', '1');
#
# TABLE STRUCTURE FOR: acc_coa
#

DROP TABLE IF EXISTS `acc_coa`;

CREATE TABLE `acc_coa` (
  `HeadCode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `HeadName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PHeadName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `HeadLevel` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsTransaction` tinyint(1) NOT NULL,
  `IsGL` tinyint(1) NOT NULL,
  `HeadType` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `IsBudget` tinyint(1) NOT NULL,
  `IsDepreciation` tinyint(1) NOT NULL,
  `DepreciationRate` decimal(18,2) NOT NULL,
  `CreateBy` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CreateDate` datetime NOT NULL,
  `UpdateBy` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UpdateDate` datetime NOT NULL,
  PRIMARY KEY (`HeadName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: acc_customer_income
#

DROP TABLE IF EXISTS `acc_customer_income`;

CREATE TABLE `acc_customer_income` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_Id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `VNo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: acc_glsummarybalance
#

DROP TABLE IF EXISTS `acc_glsummarybalance`;

CREATE TABLE `acc_glsummarybalance` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COAID` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Debit` decimal(18,2) DEFAULT NULL,
  `Credit` decimal(18,2) DEFAULT NULL,
  `FYear` int(11) DEFAULT NULL,
  `CreateBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: acc_income_expence
#

DROP TABLE IF EXISTS `acc_income_expence`;

CREATE TABLE `acc_income_expence` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VNo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Student_Id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Paymode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Perpose` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Narration` text COLLATE utf8_unicode_ci NOT NULL,
  `StoreID` int(11) NOT NULL,
  `COAID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `IsApprove` tinyint(4) NOT NULL,
  `CreateBy` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CreateDate` datetime NOT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: acc_temp
#

DROP TABLE IF EXISTS `acc_temp`;

CREATE TABLE `acc_temp` (
  `COAID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Debit` decimal(18,2) NOT NULL,
  `Credit` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: acc_transaction
#

DROP TABLE IF EXISTS `acc_transaction`;

CREATE TABLE `acc_transaction` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VNo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Vtype` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VDate` date DEFAULT NULL,
  `COAID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Narration` text COLLATE utf8_unicode_ci,
  `Debit` decimal(18,2) DEFAULT NULL,
  `Credit` decimal(18,2) DEFAULT NULL,
  `StoreID` int(11) NOT NULL,
  `IsPosted` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreateBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `IsAppove` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: accesslog
#

DROP TABLE IF EXISTS `accesslog`;

CREATE TABLE `accesslog` (
  `sl_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `action_page` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_done` text COLLATE utf8_unicode_ci,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  UNIQUE KEY `SerialNo` (`sl_no`)
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('1', 'Add Category', 'Insert Data', 'Category is Created', 'Jhon  Doe', '2018-11-04 13:33:19');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('2', 'Category List', 'Delete Data', 'Category Deleted', 'Jhon  Doe', '2018-11-04 13:34:20');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('3', 'Category List', 'Update Data', 'Category Updated', 'Jhon  Doe', '2018-11-04 13:41:05');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('4', 'Category List', 'Delete Data', 'Category Deleted', 'Jhon  Doe', '2018-11-04 13:41:28');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('5', 'Category List', 'Delete Data', 'Category Deleted', 'Jhon  Doe', '2018-11-04 13:41:32');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('6', 'Add Add-ons', 'Insert Data', 'New Add-ons is Created', 'Jhon  Doe', '2018-11-04 14:27:24');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('7', 'Add Add-ons', 'Insert Data', 'New Add-ons is Created', 'Jhon  Doe', '2018-11-04 14:27:52');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('8', 'Add Add-ons', 'Insert Data', 'New Add-ons is Created', 'Jhon  Doe', '2018-11-04 14:28:18');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('9', 'Add Add-ons', 'Insert Data', 'New Add-ons is Created', 'Jhon  Doe', '2018-11-04 14:28:48');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('10', 'Add Add-ons', 'Insert Data', 'New Add-ons is Created', 'Jhon  Doe', '2018-11-04 14:29:23');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('11', 'Add-ons List', 'Update Data', 'Add-ons Updated', 'Jhon  Doe', '2018-11-04 14:33:33');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('12', 'Add-ons List', 'Update Data', 'Add-ons Updated', 'Jhon  Doe', '2018-11-04 14:34:27');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('13', 'Add-ons List', 'Update Data', 'Add-ons Updated', 'Jhon  Doe', '2018-11-04 14:34:34');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('14', 'Add Add-ons', 'Insert Data', 'New Add-ons is Created', 'Jhon  Doe', '2018-11-04 14:34:49');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('15', 'Add-ons List', 'Delete Data', 'Add-ons Deleted', 'Jhon  Doe', '2018-11-04 14:34:58');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('16', 'Category List', 'Update Data', 'Category Updated', 'Jhon  Doe', '2018-11-05 09:19:10');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('17', 'Category List', 'Update Data', 'Category Updated', 'Jhon  Doe', '2018-11-05 09:19:22');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('18', 'Category List', 'Update Data', 'Category Updated', 'Jhon  Doe', '2018-11-05 09:21:37');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('19', 'Category List', 'Update Data', 'Category Updated', 'Jhon  Doe', '2018-11-05 09:21:56');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('20', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-05 13:35:43');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('21', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-05 13:37:44');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('22', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-05 13:41:10');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('23', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-05 13:43:07');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('24', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-05 13:44:20');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('25', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-05 13:46:37');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('26', 'Unit List', 'Update Data', 'Unit Updated', 'Jhon  Doe', '2018-11-06 06:41:19');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('27', 'Unit List', 'Update Data', 'Unit Updated', 'Jhon  Doe', '2018-11-06 07:10:03');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('28', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-06 07:24:07');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('29', 'Units List', 'Delete Data', 'Unit Deleted', 'Jhon  Doe', '2018-11-06 07:25:37');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('30', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-06 08:43:27');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('31', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-06 08:49:27');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('32', 'Ingredient List', 'Delete Data', 'Ingredient Deleted', 'Jhon  Doe', '2018-11-06 08:49:44');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('33', 'Ingredient List', 'Update Data', 'Ingredient Updated', 'Jhon  Doe', '2018-11-06 08:50:26');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('34', 'Ingredient List', 'Update Data', 'Ingredient Updated', 'Jhon  Doe', '2018-11-06 08:50:33');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('35', 'Ingredient List', 'Update Data', 'Ingredient Updated', 'Jhon  Doe', '2018-11-06 08:50:39');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('36', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-06 09:34:03');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('37', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-06 09:59:35');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('38', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-06 09:59:56');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('39', 'Add Food', 'Insert Data', 'New Food Added', 'Jhon  Doe', '2018-11-06 11:56:00');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('40', 'Food List', 'Update Data', 'Food Updated', 'Jhon  Doe', '2018-11-06 11:58:16');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('41', 'Food List', 'Update Data', 'Food Updated', 'Jhon  Doe', '2018-11-06 11:58:23');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('42', 'Add Food', 'Insert Data', 'New Food Added', 'Jhon  Doe', '2018-11-06 11:59:46');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('43', 'Add Food', 'Insert Data', 'New Food Added', 'Jhon  Doe', '2018-11-06 12:01:16');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('44', 'Food List', 'Delete Data', 'Food Deleted', 'Jhon  Doe', '2018-11-06 12:01:29');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('45', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-06 13:26:20');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('46', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-06 13:31:36');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('47', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-06 13:34:02');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('48', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-06 13:51:25');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('49', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-06 13:51:49');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('50', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-06 13:54:42');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('51', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-06 13:56:00');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('52', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-06 13:56:18');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('53', 'Add-ons List', 'Delete Data', 'Add-ons Assign Menu Deleted', 'Jhon  Doe', '2018-11-06 13:56:25');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('54', 'Add-ons List', 'Delete Data', 'Add-ons Assign Menu Deleted', 'Jhon  Doe', '2018-11-06 13:56:30');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('55', 'Add-ons List', 'Delete Data', 'Add-ons Assign Menu Deleted', 'Jhon  Doe', '2018-11-06 13:56:35');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('56', 'Add-ons List', 'Delete Data', 'Add-ons Assign Menu Deleted', 'Jhon  Doe', '2018-11-06 13:56:44');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('57', 'Add-ons Assign List', 'Update Data', 'Add-ons Assign List Updated', 'Jhon  Doe', '2018-11-06 13:58:06');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('58', 'Add-ons Assign List', 'Update Data', 'Add-ons Assign List Updated', 'Jhon  Doe', '2018-11-06 13:58:20');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('59', 'Add-ons Assign List', 'Update Data', 'Add-ons Assign List Updated', 'Jhon  Doe', '2018-11-06 14:06:11');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('60', 'Add-ons List', 'Delete Data', 'Add-ons Assign Menu Deleted', 'Jhon  Doe', '2018-11-06 14:06:18');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('61', 'Unit List', 'Insert Data', 'New unit Created', 'AB Doe', '2018-11-06 14:36:26');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('62', 'Units List', 'Delete Data', 'Unit Deleted', 'Jhon  Doe', '2018-11-06 14:36:50');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('63', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-07 06:38:53');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('64', 'Add-ons Assign List', 'Update Data', 'Add-ons Assign List Updated', 'Jhon  Doe', '2018-11-07 06:39:21');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('65', 'Add-ons List', 'Delete Data', 'Add-ons Assign Menu Deleted', 'Jhon  Doe', '2018-11-07 06:39:28');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('66', 'Add-ons Assign List', 'Update Data', 'Add-ons Assign List Updated', 'Jhon  Doe', '2018-11-07 06:42:23');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('67', 'Add-ons Assign List', 'Update Data', 'Add-ons Assign List Updated', 'Jhon  Doe', '2018-11-07 06:42:31');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('68', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-07 06:48:27');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('69', 'Add-ons Assign List', 'Update Data', 'Add-ons Assign List Updated', 'Jhon  Doe', '2018-11-07 06:48:46');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('70', 'Add-ons List', 'Delete Data', 'Add-ons Assign Menu Deleted', 'Jhon  Doe', '2018-11-07 06:48:55');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('71', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-07 06:49:35');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('72', 'Add-ons Assign List', 'Update Data', 'Add-ons Assign List Updated', 'Jhon  Doe', '2018-11-07 06:49:43');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('73', 'Add-ons List', 'Delete Data', 'Add-ons Assign Menu Deleted', 'Jhon  Doe', '2018-11-07 06:49:47');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('74', 'Unit List', 'Update Data', 'Unit Updated', 'Jhon  Doe', '2018-11-07 06:52:12');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('75', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-07 06:52:25');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('76', 'Units List', 'Delete Data', 'Unit Deleted', 'Jhon  Doe', '2018-11-07 06:52:29');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('77', 'Unit List', 'Update Data', 'Unit Updated', 'Jhon  Doe', '2018-11-07 06:52:35');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('78', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-07 06:54:11');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('79', 'Ingredient List', 'Update Data', 'Ingredient Updated', 'Jhon  Doe', '2018-11-07 06:54:18');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('80', 'Ingredient List', 'Delete Data', 'Ingredient Deleted', 'Jhon  Doe', '2018-11-07 06:54:23');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('81', 'Varient List', 'Insert Data', 'New Varient Created', 'Jhon  Doe', '2018-11-07 10:01:08');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('82', 'Varient List', 'Insert Data', 'New Varient Created', 'Jhon  Doe', '2018-11-07 10:12:20');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('83', 'Varient List', 'Insert Data', 'New Varient Created', 'Jhon  Doe', '2018-11-07 10:12:35');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('84', 'Varient List', 'Update Data', 'Varient Updated', 'Jhon  Doe', '2018-11-07 10:15:58');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('85', 'Varient List', 'Delete Data', 'Varient Deleted', 'Jhon  Doe', '2018-11-07 10:17:49');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('86', 'Food Availablity', 'Insert Data', 'New Food Availablity Created', 'Jhon  Doe', '2018-11-07 10:58:27');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('87', 'Food Availablity', 'Insert Data', 'New Food Availablity Created', 'Jhon  Doe', '2018-11-07 11:01:32');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('88', 'Food Availablity', 'Insert Data', 'New Food Availablity Created', 'Jhon  Doe', '2018-11-07 11:33:45');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('89', 'Food Availablity', 'Update Data', 'Food Availablity Updated', 'Jhon  Doe', '2018-11-07 11:40:24');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('90', 'Food Availablity', 'Delete Data', 'Food Availablity Deleted', 'Jhon  Doe', '2018-11-07 11:40:35');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('91', 'Membership List', 'Insert Data', 'New Membership Created', 'Jhon  Doe', '2018-11-07 14:16:50');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('92', 'Membership List', 'Insert Data', 'New Membership Created', 'Jhon  Doe', '2018-11-07 14:17:11');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('93', 'Membership List', 'Insert Data', 'New Membership Created', 'Jhon  Doe', '2018-11-07 14:17:32');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('94', 'Membership List', 'Insert Data', 'New Membership Created', 'Jhon  Doe', '2018-11-07 14:17:44');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('95', 'Membership List', 'Update Data', 'Membership Updated', 'Jhon  Doe', '2018-11-07 14:21:40');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('96', 'Membership List', 'Update Data', 'Membership Updated', 'Jhon  Doe', '2018-11-07 14:22:01');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('97', 'Membership List', 'Update Data', 'Membership Updated', 'Jhon  Doe', '2018-11-07 14:22:41');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('98', 'Membership List', 'Delete Data', 'Membership Deleted', 'Jhon  Doe', '2018-11-07 14:23:27');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('99', 'Payment Method List', 'Insert Data', 'New Payment Method Created', 'Jhon  Doe', '2018-11-07 14:51:28');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('100', 'Payment Method List', 'Update Data', 'Payment Method Updated', 'Jhon  Doe', '2018-11-07 14:57:07');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('101', 'Payment Method List', 'Update Data', 'Payment Method Updated', 'Jhon  Doe', '2018-11-07 14:57:11');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('102', 'Payment Method List', 'Update Data', 'Payment Method Updated', 'Jhon  Doe', '2018-11-07 14:57:16');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('103', 'Payment Method List', 'Insert Data', 'New Payment Method Created', 'Jhon  Doe', '2018-11-07 14:57:29');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('104', 'Payment Method List', 'Insert Data', 'New Payment Method Created', 'Jhon  Doe', '2018-11-07 14:57:44');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('105', 'Payment Method List', 'Insert Data', 'New Payment Method Created', 'Jhon  Doe', '2018-11-07 14:57:54');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('106', 'Payment Method List', 'Insert Data', 'New Payment Method Created', 'Jhon  Doe', '2018-11-07 14:58:02');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('107', 'Payment Method List', 'Delete Data', 'Payment Method Deleted', 'Jhon  Doe', '2018-11-07 14:58:05');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('108', 'Shipping Method List', 'Insert Data', 'New Shipping Method Created', 'Jhon  Doe', '2018-11-08 06:48:19');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('109', 'Shipping Method List', 'Update Data', 'Shipping Method Updated', 'Jhon  Doe', '2018-11-08 06:52:48');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('110', 'Shipping Method List', 'Insert Data', 'New Shipping Method Created', 'Jhon  Doe', '2018-11-08 06:53:36');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('111', 'Shipping Method List', 'Insert Data', 'New Shipping Method Created', 'Jhon  Doe', '2018-11-08 06:55:49');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('112', 'Shipping Method List', 'Insert Data', 'New Shipping Method Created', 'Jhon  Doe', '2018-11-08 06:56:01');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('113', 'Shipping Method List', 'Delete Data', 'Shipping Method Deleted', 'Jhon  Doe', '2018-11-08 06:56:05');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('114', 'Supplier List', 'Insert Data', 'New Supplier Created', 'Jhon  Doe', '2018-11-08 07:49:02');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('115', 'Supplier List', 'Update Data', 'Supplier Updated', 'Jhon  Doe', '2018-11-08 07:57:51');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('116', 'Supplier List', 'Insert Data', 'New Supplier Created', 'Jhon  Doe', '2018-11-08 08:01:47');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('117', 'Supplier List', 'Insert Data', 'New Supplier Created', 'Jhon  Doe', '2018-11-08 08:02:09');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('118', 'Supplier List', 'Delete Data', 'Supplier Deleted', 'Jhon  Doe', '2018-11-08 08:02:13');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('119', 'Purchase List', 'Insert Data', 'New Purchase Created', 'Jhon  Doe', '2018-11-08 11:02:57');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('120', 'Add Purchase', 'Insert Data', 'Item Purchase Created', 'Jhon  Doe', '2018-11-10 13:30:40');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('121', 'Add Purchase', 'Insert Data', 'Item Purchase Created', 'Jhon  Doe', '2018-11-11 08:23:43');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('122', 'Add Purchase', 'Insert Data', 'Item Purchase Created', 'Jhon  Doe', '2018-11-11 08:43:06');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('123', 'Update Purchase', 'Update Data', 'Item Purchase Updated', 'Jhon  Doe', '2018-11-11 09:26:55');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('124', 'Update Purchase', 'Update Data', 'Item Purchase Updated', 'Jhon  Doe', '2018-11-11 09:28:28');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('125', 'Update Purchase', 'Update Data', 'Item Purchase Updated', 'Jhon  Doe', '2018-11-11 09:29:05');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('133', 'Update Purchase', 'Update Data', 'Item Purchase Updated', 'Jhon  Doe', '2018-11-11 10:02:02');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('146', 'Update Purchase', 'Update Data', 'Item Purchase Updated', 'Jhon  Doe', '2018-11-11 10:44:09');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('147', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-11 11:44:43');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('148', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-11 11:44:59');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('149', 'Update Purchase', 'Update Data', 'Item Purchase Updated', 'Jhon  Doe', '2018-11-11 11:58:59');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('150', 'Update Purchase', 'Update Data', 'Item Purchase Updated', 'Jhon  Doe', '2018-11-11 11:59:13');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('151', 'Add Purchase', 'Insert Data', 'Item Purchase Created', 'Jhon  Doe', '2018-11-11 12:36:54');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('152', 'Purchase List', 'Delete Data', 'Purchase Deleted', 'Jhon  Doe', '2018-11-11 12:40:56');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('153', 'Add Purchase', 'Insert Data', 'Item Purchase Created', 'Jhon  Doe', '2018-11-11 12:43:37');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('154', 'Add Purchase', 'Insert Data', 'Item Purchase Created', 'Jhon  Doe', '2018-11-11 12:45:29');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('155', 'Add Purchase', 'Insert Data', 'Item Purchase Created', 'Jhon  Doe', '2018-11-11 12:47:05');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('156', 'Add Purchase', 'Insert Data', 'Item Purchase Created', 'Jhon  Doe', '2018-11-11 12:48:24');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('157', 'Purchase List', 'Delete Data', 'Purchase Deleted', 'Jhon  Doe', '2018-11-11 12:49:21');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('158', 'Add Food', 'Insert Data', 'New Food Added', 'Jhon  Doe', '2018-11-12 11:50:22');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('159', 'Add Food', 'Insert Data', 'New Food Added', 'Jhon  Doe', '2018-11-12 11:51:22');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('160', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-13 06:18:17');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('161', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-13 06:21:11');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('162', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-13 06:21:43');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('163', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-13 06:22:56');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('164', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-13 06:23:18');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('165', 'Unit List', 'Insert Data', 'New unit Created', 'Jhon  Doe', '2018-11-13 06:25:22');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('166', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-13 06:25:50');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('167', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-13 06:27:05');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('168', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-13 06:27:54');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('169', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-13 06:29:00');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('170', 'Ingredient List', 'Insert Data', 'New Ingredient Created', 'Jhon  Doe', '2018-11-13 06:29:56');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('171', 'Add Purchase', 'Insert Data', 'Item Purchase Created', 'Jhon  Doe', '2018-11-13 06:35:23');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('172', 'Add Purchase', 'Insert Data', 'Item Purchase Created', 'Jhon  Doe', '2018-11-13 06:36:55');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('173', 'Add Production', 'Insert Data', 'Item Production Created', 'Jhon  Doe', '2018-11-13 07:04:31');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('174', 'Table List', 'Insert Data', 'New table Created', 'Jhon  Doe', '2018-11-13 10:08:28');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('175', 'Table List', 'Insert Data', 'New table Created', 'Jhon  Doe', '2018-11-13 10:10:05');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('176', 'Table List', 'Insert Data', 'New table Created', 'Jhon  Doe', '2018-11-13 10:10:12');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('177', 'Table List', 'Insert Data', 'New table Created', 'Jhon  Doe', '2018-11-13 10:10:22');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('178', 'Table List', 'Insert Data', 'New table Created', 'Jhon  Doe', '2018-11-13 10:17:25');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('179', 'Table List', 'Update Data', 'Table Updated', 'Jhon  Doe', '2018-11-13 10:18:30');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('180', 'Table List', 'Insert Data', 'New table Created', 'Jhon  Doe', '2018-11-13 10:28:29');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('181', 'Customer Type List', 'Insert Data', 'New Customer Type Created', 'Jhon  Doe', '2018-11-13 11:56:27');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('182', 'Customer Type List', 'Insert Data', 'New Customer Type Created', 'Jhon  Doe', '2018-11-13 11:56:38');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('183', 'Customer Type List', 'Insert Data', 'New Customer Type Created', 'Jhon  Doe', '2018-11-13 11:56:47');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('184', 'Customer Type List', 'Delete Data', 'Customer Type Deleted', 'Jhon  Doe', '2018-11-13 11:58:28');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('185', 'Customer Type List', 'Insert Data', 'New Customer Type Created', 'Jhon  Doe', '2018-11-13 11:58:42');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('186', 'Customer Type List', 'Insert Data', 'New Customer Type Created', 'Jhon  Doe', '2018-11-13 11:58:48');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('187', 'Customer Type List', 'Insert Data', 'New Customer Type Created', 'Jhon  Doe', '2018-11-13 11:58:55');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('188', 'Customer Type List', 'Insert Data', 'New Customer Type Created', 'Jhon  Doe', '2018-11-13 12:05:13');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('189', 'Customer Type List', 'Insert Data', 'New Customer Type Created', 'Jhon  Doe', '2018-11-13 12:05:24');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('190', 'Customer Type List', 'Update Data', 'Customer Type Updated', 'Jhon  Doe', '2018-11-13 12:05:57');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('191', 'Customer Type List', 'Update Data', 'Customer Type Updated', 'Jhon  Doe', '2018-11-13 12:06:04');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('192', 'Customer Type List', 'Insert Data', 'New Customer Type Created', 'Jhon  Doe', '2018-11-13 12:06:40');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('193', 'Customer Type List', 'Update Data', 'Customer Type Updated', 'Jhon  Doe', '2018-11-13 12:06:51');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('194', 'Customer Type List', 'Delete Data', 'Customer Type Deleted', 'Jhon  Doe', '2018-11-13 12:06:54');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('195', 'Varient List', 'Insert Data', 'New Varient Created', 'Jhon  Doe', '2018-11-14 06:09:12');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('196', 'Varient List', 'Insert Data', 'New Varient Created', 'Jhon  Doe', '2018-11-14 06:09:30');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('197', 'Varient List', 'Insert Data', 'New Varient Created', 'Jhon  Doe', '2018-11-14 06:09:47');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('198', 'Add New Order', 'Insert Data', 'Item New Order Created', 'Jhon  Doe', '2018-11-15 10:57:09');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('199', 'Add Food', 'Insert Data', 'New Food Added', 'Jhon  Doe', '2018-11-15 11:40:17');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('200', 'Add Food', 'Insert Data', 'New Food Added', 'Jhon  Doe', '2018-11-15 11:43:43');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('201', 'Add Add-ons', 'Insert Data', 'New Add-ons is Created', 'Jhon  Doe', '2018-11-15 11:44:51');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('202', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-15 11:45:09');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('203', 'Add-ons Assign', 'Insert Data', 'Assign New Add-ons To Menu', 'Jhon  Doe', '2018-11-15 11:45:24');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('204', 'Varient List', 'Insert Data', 'New Varient Created', 'Jhon  Doe', '2018-11-15 11:47:22');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('205', 'Varient List', 'Insert Data', 'New Varient Created', 'Jhon  Doe', '2018-11-15 11:47:22');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('206', 'Varient List', 'Insert Data', 'New Varient Created', 'Jhon  Doe', '2018-11-15 11:47:39');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('207', 'Add New Order', 'Insert Data', 'Item New Order Created', 'Jhon  Doe', '2018-11-17 06:06:50');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('208', 'Add New Order', 'Insert Data', 'Item New Order Created', 'Jhon  Doe', '2018-11-17 06:46:42');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('209', 'Add New Order', 'Insert Data', 'Item New Order Created', 'Jhon  Doe', '2018-11-17 06:50:03');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('210', 'Add New Order', 'Insert Data', 'Item New Order Created', 'Jhon  Doe', '2018-11-17 07:25:52');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('211', 'Add New Order', 'Insert Data', 'Item New Order Created', 'Jhon  Doe', '2018-11-17 07:44:17');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('212', 'Add New Order', 'Insert Data', 'Item New Order Created', 'Jhon  Doe', '2018-11-17 10:22:57');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('213', 'Add Customer', 'Insert Data', 'Customer is Created', 'Jhon  Doe', '2018-11-18 13:55:53');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('214', 'Add Customer', 'Insert Data', 'Customer is Created', 'Jhon  Doe', '2018-11-20 07:18:57');
INSERT INTO `accesslog` (`sl_no`, `action_page`, `action_done`, `remarks`, `user_name`, `entry_date`) VALUES ('215', 'Add New Order', 'Insert Data', 'Item New Order Created', 'Jhon  Doe', '2018-11-20 07:28:59');


#
# TABLE STRUCTURE FOR: add_ons
#

DROP TABLE IF EXISTS `add_ons`;

CREATE TABLE `add_ons` (
  `add_on_id` int(11) NOT NULL AUTO_INCREMENT,
  `add_on_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint(4) NOT NULL,
  PRIMARY KEY (`add_on_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `add_ons` (`add_on_id`, `add_on_name`, `price`, `is_active`) VALUES ('1', 'BBQ Sauce', '25.00', '1');
INSERT INTO `add_ons` (`add_on_id`, `add_on_name`, `price`, `is_active`) VALUES ('2', 'French Fries', '20.00', '1');
INSERT INTO `add_ons` (`add_on_id`, `add_on_name`, `price`, `is_active`) VALUES ('3', 'Pepperoni', '20.00', '1');
INSERT INTO `add_ons` (`add_on_id`, `add_on_name`, `price`, `is_active`) VALUES ('4', 'Mayo', '30.00', '1');
INSERT INTO `add_ons` (`add_on_id`, `add_on_name`, `price`, `is_active`) VALUES ('5', 'Cheese', '20.00', '1');
INSERT INTO `add_ons` (`add_on_id`, `add_on_name`, `price`, `is_active`) VALUES ('6', 'Mayo', '25.00', '1');


#
# TABLE STRUCTURE FOR: award
#

DROP TABLE IF EXISTS `award`;

CREATE TABLE `award` (
  `award_id` int(11) NOT NULL AUTO_INCREMENT,
  `award_name` varchar(50) NOT NULL,
  `aw_description` varchar(200) NOT NULL,
  `awr_gift_item` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  `awarded_by` varchar(30) NOT NULL,
  PRIMARY KEY (`award_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `award` (`award_id`, `award_name`, `aw_description`, `awr_gift_item`, `date`, `employee_id`, `awarded_by`) VALUES ('2', 'PriceMoney', 'sdfasdf', '1000tk', '2017-09-09', 'EVJ77XOI', 'Isahq');
INSERT INTO `award` (`award_id`, `award_name`, `aw_description`, `awr_gift_item`, `date`, `employee_id`, `awarded_by`) VALUES ('3', 'fdg', 'dfg', 'dfg', '2017-09-08', 'EVJ77XOI', 'dfg');
INSERT INTO `award` (`award_id`, `award_name`, `aw_description`, `awr_gift_item`, `date`, `employee_id`, `awarded_by`) VALUES ('4', 'Gift', 'fsdf', 'Laptop', '2017-09-10', '4324', 'Bdtask');


#
# TABLE STRUCTURE FOR: bill
#

DROP TABLE IF EXISTS `bill`;

CREATE TABLE `bill` (
  `bill_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `total_amount` float NOT NULL,
  `discount` float NOT NULL,
  `service_charge` float NOT NULL,
  `VAT` float NOT NULL,
  `bill_amount` float NOT NULL,
  `bill_date` date NOT NULL,
  `bill_time` time NOT NULL,
  `bill_status` tinyint(1) NOT NULL COMMENT '0=unpaid, 1=paid',
  `payment_method_id` tinyint(4) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` date NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: bill_card_payment
#

DROP TABLE IF EXISTS `bill_card_payment`;

CREATE TABLE `bill_card_payment` (
  `row_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bill_id` bigint(20) NOT NULL,
  `card_no` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `issuer_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: custom_table
#

DROP TABLE IF EXISTS `custom_table`;

CREATE TABLE `custom_table` (
  `custom_id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_field` varchar(100) NOT NULL,
  `custom_data_type` int(11) NOT NULL,
  `custom_data` text NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  PRIMARY KEY (`custom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('7', 'Field1', '1', 'value1', 'EU8EH6BY');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('9', 'Teacher Name', '2', 'Abdul Halim', 'EF6MQRAX');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('12', 'Primary School', '1', 'Test Primary School', 'E4ZNFBIC');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('13', 'High School Name', '2', 'Taker Hat High school', 'E4ZNFBIC');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('14', 'Versity Name', '3', 'Nu', 'E4ZNFBIC');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('15', 'Company Name', '1', 'Bdtask', 'ER6RJAY8');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('16', 'House Name', '3', 'Shikder Bari', 'ER6RJAY8');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('17', 'Person name', '2', 'Tuhin', 'ER6RJAY8');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('21', 'customfield1', '1', 'custom value1', 'E0LHJ447');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('22', 'dsfsdf', '1', 'sdfdsf', 'E0LHJ447');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('23', 'dsfsd', '1', 'fdsfsdf', 'E0LHJ447');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('24', '', '1', '', 'E0LHJ447');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('25', '', '1', '', 'E0LHJ447');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('34', 'isahadf', '1', '23424', 'ELPGMMRL');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('35', 'dfsdf', '1', 'dfgdfg', 'ELPGMMRL');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('36', 'hhh', '1', 'sdfsdf', 'ELPGMMRL');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('37', 'fdfgdfg', '1', 'dfg', 'ELPGMMRL');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('38', 'dfgdfg', '1', '', 'ELPGMMRL');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('39', 'First isahaq', '1', 'sdfsdf', 'E4K0I0DA');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('40', 'sdfsadf', '1', 'sdfsdf', 'EYOBEEFQ');
INSERT INTO `custom_table` (`custom_id`, `custom_field`, `custom_data_type`, `custom_data`, `employee_id`) VALUES ('41', 'fsdfsadf', '1', '234234324', 'EHBEEFQQ');


#
# TABLE STRUCTURE FOR: customer_info
#

DROP TABLE IF EXISTS `customer_info`;

CREATE TABLE `customer_info` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `favorite_delivery_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `customer_info` (`customer_id`, `customer_name`, `customer_email`, `customer_address`, `customer_phone`, `favorite_delivery_address`, `is_active`) VALUES ('1', 'Kawsar Ahmed', 'test@gmail.com', 'Dhaka', '01713245341', 'dhaka', '1');
INSERT INTO `customer_info` (`customer_id`, `customer_name`, `customer_email`, `customer_address`, `customer_phone`, `favorite_delivery_address`, `is_active`) VALUES ('2', 'test', 'test@gmail.com', 'Dhaka', '01723451221', 'dhaka', '1');
INSERT INTO `customer_info` (`customer_id`, `customer_name`, `customer_email`, `customer_address`, `customer_phone`, `favorite_delivery_address`, `is_active`) VALUES ('3', 'Ripon', 'ripon@gmail.com', 'Dhaka', '01612991234', 'Dhaka', '1');


#
# TABLE STRUCTURE FOR: customer_membership_map
#

DROP TABLE IF EXISTS `customer_membership_map`;

CREATE TABLE `customer_membership_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `active_date` date NOT NULL,
  `active_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: customer_order
#

DROP TABLE IF EXISTS `customer_order`;

CREATE TABLE `customer_order` (
  `order_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `cutomertype` int(11) NOT NULL,
  `waiter_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `table_no` int(11) NOT NULL,
  `totalamount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `customer_note` text COLLATE utf8_unicode_ci,
  `order_status` tinyint(1) NOT NULL COMMENT '1=Pending, 2=Processing, 3=Ready, 4=Served',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `customer_order` (`order_id`, `customer_id`, `cutomertype`, `waiter_id`, `order_date`, `order_time`, `table_no`, `totalamount`, `customer_note`, `order_status`) VALUES ('1', '1', '1', '165', '2018-11-17', '10:22:57', '2', '1575.50', '', '1');
INSERT INTO `customer_order` (`order_id`, `customer_id`, `cutomertype`, `waiter_id`, `order_date`, `order_time`, `table_no`, `totalamount`, `customer_note`, `order_status`) VALUES ('2', '3', '1', '165', '2018-11-20', '07:28:59', '2', '1696.25', 'test', '1');


#
# TABLE STRUCTURE FOR: customer_type
#

DROP TABLE IF EXISTS `customer_type`;

CREATE TABLE `customer_type` (
  `customer_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`customer_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `customer_type` (`customer_type_id`, `customer_type`) VALUES ('1', 'Walking Customer');
INSERT INTO `customer_type` (`customer_type_id`, `customer_type`) VALUES ('2', 'Online Customer');


#
# TABLE STRUCTURE FOR: department
#

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `parent_id` int(10) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES ('2', 'IT Department', '0');
INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES ('3', 'php', '2');
INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES ('4', 'Wordpress', '0');
INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES ('6', 'html', '4');
INSERT INTO `department` (`dept_id`, `department_name`, `parent_id`) VALUES ('7', 'javascript', '4');


#
# TABLE STRUCTURE FOR: duty_type
#

DROP TABLE IF EXISTS `duty_type`;

CREATE TABLE `duty_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `duty_type` (`id`, `type_name`) VALUES ('1', 'Full Time');
INSERT INTO `duty_type` (`id`, `type_name`) VALUES ('2', 'Part Time');
INSERT INTO `duty_type` (`id`, `type_name`) VALUES ('3', 'Contructual');
INSERT INTO `duty_type` (`id`, `type_name`) VALUES ('4', 'Other');


#
# TABLE STRUCTURE FOR: employee_benifit
#

DROP TABLE IF EXISTS `employee_benifit`;

CREATE TABLE `employee_benifit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bnf_cl_code` varchar(100) NOT NULL,
  `bnf_cl_code_des` varchar(250) NOT NULL,
  `bnff_acural_date` date NOT NULL,
  `bnf_status` tinyint(4) NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `employee_benifit` (`id`, `bnf_cl_code`, `bnf_cl_code_des`, `bnff_acural_date`, `bnf_status`, `employee_id`) VALUES ('1', '234234', '23423sdfsdfs', '0000-00-00', '1', 'EYOBEEFQ');
INSERT INTO `employee_benifit` (`id`, `bnf_cl_code`, `bnf_cl_code_des`, `bnff_acural_date`, `bnf_status`, `employee_id`) VALUES ('2', '3243245', '43dfgdfsgdfg', '0000-00-00', '1', 'EYOBEEFQ');
INSERT INTO `employee_benifit` (`id`, `bnf_cl_code`, `bnf_cl_code_des`, `bnff_acural_date`, `bnf_status`, `employee_id`) VALUES ('3', '23423', '32432', '0000-00-00', '1', 'EHBEEFQQ');
INSERT INTO `employee_benifit` (`id`, `bnf_cl_code`, `bnf_cl_code_des`, `bnff_acural_date`, `bnf_status`, `employee_id`) VALUES ('4', '34532423', 'sdfsaf', '0000-00-00', '2', 'EHBEEFQQ');
INSERT INTO `employee_benifit` (`id`, `bnf_cl_code`, `bnf_cl_code_des`, `bnff_acural_date`, `bnf_status`, `employee_id`) VALUES ('5', 'sdf34234', '23dfsdfasdf', '0000-00-00', '1', 'EHBEEFQQ');


#
# TABLE STRUCTURE FOR: employee_history
#

DROP TABLE IF EXISTS `employee_history`;

CREATE TABLE `employee_history` (
  `emp_his_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(30) NOT NULL,
  `pos_id` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `alter_phone` varchar(30) NOT NULL,
  `present_address` varchar(100) DEFAULT NULL,
  `parmanent_address` varchar(100) DEFAULT NULL,
  `picture` text,
  `degree_name` varchar(30) DEFAULT NULL,
  `university_name` varchar(50) DEFAULT NULL,
  `cgp` varchar(30) DEFAULT NULL,
  `passing_year` varchar(30) DEFAULT NULL,
  `company_name` varchar(30) DEFAULT NULL,
  `working_period` varchar(30) DEFAULT NULL,
  `duties` varchar(30) DEFAULT NULL,
  `supervisor` varchar(30) DEFAULT NULL,
  `signature` text,
  `is_admin` int(2) NOT NULL DEFAULT '0',
  `dept_id` int(11) DEFAULT NULL,
  `division_id` int(11) NOT NULL,
  `maiden_name` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` int(11) NOT NULL,
  `citizenship` int(11) NOT NULL,
  `duty_type` int(11) NOT NULL,
  `hire_date` date NOT NULL,
  `original_hire_date` date NOT NULL,
  `termination_date` date NOT NULL,
  `termination_reason` text NOT NULL,
  `voluntary_termination` int(11) NOT NULL,
  `rehire_date` date NOT NULL,
  `rate_type` int(11) NOT NULL,
  `rate` float NOT NULL,
  `pay_frequency` int(11) NOT NULL,
  `pay_frequency_txt` varchar(50) NOT NULL,
  `hourly_rate2` float NOT NULL,
  `hourly_rate3` float NOT NULL,
  `home_department` varchar(100) NOT NULL,
  `department_text` varchar(100) NOT NULL,
  `class_code` varchar(50) NOT NULL,
  `class_code_desc` varchar(100) NOT NULL,
  `class_acc_date` date NOT NULL,
  `class_status` tinyint(4) NOT NULL,
  `is_super_visor` int(11) DEFAULT NULL,
  `super_visor_id` varchar(30) NOT NULL,
  `supervisor_report` text NOT NULL,
  `dob` date NOT NULL,
  `gender` int(11) NOT NULL,
  `marital_status` int(11) NOT NULL,
  `ethnic_group` varchar(100) NOT NULL,
  `eeo_class_gp` varchar(100) NOT NULL,
  `ssn` varchar(50) NOT NULL,
  `work_in_state` int(11) NOT NULL,
  `live_in_state` int(11) NOT NULL,
  `home_email` varchar(50) NOT NULL,
  `business_email` varchar(50) NOT NULL,
  `home_phone` varchar(30) NOT NULL,
  `business_phone` varchar(30) NOT NULL,
  `cell_phone` varchar(30) NOT NULL,
  `emerg_contct` varchar(30) NOT NULL,
  `emrg_h_phone` varchar(30) NOT NULL,
  `emrg_w_phone` varchar(30) NOT NULL,
  `emgr_contct_relation` varchar(50) NOT NULL,
  `alt_em_contct` varchar(30) NOT NULL,
  `alt_emg_h_phone` varchar(30) NOT NULL,
  `alt_emg_w_phone` varchar(30) NOT NULL,
  PRIMARY KEY (`emp_his_id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8;

INSERT INTO `employee_history` (`emp_his_id`, `employee_id`, `pos_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `alter_phone`, `present_address`, `parmanent_address`, `picture`, `degree_name`, `university_name`, `cgp`, `passing_year`, `company_name`, `working_period`, `duties`, `supervisor`, `signature`, `is_admin`, `dept_id`, `division_id`, `maiden_name`, `state`, `city`, `zip`, `citizenship`, `duty_type`, `hire_date`, `original_hire_date`, `termination_date`, `termination_reason`, `voluntary_termination`, `rehire_date`, `rate_type`, `rate`, `pay_frequency`, `pay_frequency_txt`, `hourly_rate2`, `hourly_rate3`, `home_department`, `department_text`, `class_code`, `class_code_desc`, `class_acc_date`, `class_status`, `is_super_visor`, `super_visor_id`, `supervisor_report`, `dob`, `gender`, `marital_status`, `ethnic_group`, `eeo_class_gp`, `ssn`, `work_in_state`, `live_in_state`, `home_email`, `business_email`, `home_phone`, `business_phone`, `cell_phone`, `emerg_contct`, `emrg_h_phone`, `emrg_w_phone`, `emgr_contct_relation`, `alt_em_contct`, `alt_emg_h_phone`, `alt_emg_w_phone`) VALUES ('161', 'EU8EH6BY', '1', 'shafullah', NULL, 'Rahman', 'hab@gmail.com', '34234', '34234', '234234', 'dfg', './application/modules/employee/assets/images/2017-08-30/145.jpg', 'H.S.C', 'National University', '3', '21321', 'Infostystem', '07/23/2017 - 07/23/2017', 'Senior Programmar', 'Isahaq', '', '0', '3', '0', '', '', '', '0', '0', '0', '0000-00-00', '0000-00-00', '0000-00-00', '', '0', '0000-00-00', '0', '0', '0', '', '0', '0', '', '', '', '', '0000-00-00', '0', '0', '0', '', '0000-00-00', '0', '0', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `employee_history` (`emp_his_id`, `employee_id`, `pos_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `alter_phone`, `present_address`, `parmanent_address`, `picture`, `degree_name`, `university_name`, `cgp`, `passing_year`, `company_name`, `working_period`, `duties`, `supervisor`, `signature`, `is_admin`, `dept_id`, `division_id`, `maiden_name`, `state`, `city`, `zip`, `citizenship`, `duty_type`, `hire_date`, `original_hire_date`, `termination_date`, `termination_reason`, `voluntary_termination`, `rehire_date`, `rate_type`, `rate`, `pay_frequency`, `pay_frequency_txt`, `hourly_rate2`, `hourly_rate3`, `home_department`, `department_text`, `class_code`, `class_code_desc`, `class_acc_date`, `class_status`, `is_super_visor`, `super_visor_id`, `supervisor_report`, `dob`, `gender`, `marital_status`, `ethnic_group`, `eeo_class_gp`, `ssn`, `work_in_state`, `live_in_state`, `home_email`, `business_email`, `home_phone`, `business_phone`, `cell_phone`, `emerg_contct`, `emrg_h_phone`, `emrg_w_phone`, `emgr_contct_relation`, `alt_em_contct`, `alt_emg_h_phone`, `alt_emg_w_phone`) VALUES ('162', 'EY2T1OWA', '4', 'jahangir', NULL, 'Ahmad', 'jahangir@gmail.com', '0195511016', '234234', NULL, NULL, './application/modules/employee/assets/images/2018-09-20/pra.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', '3', '3', 'Kala', 'New York', 'New', '234234', '0', '1', '2018-09-19', '2018-09-19', '2018-09-19', 'sdfasdf', '2', '2018-09-26', '1', '323', '2', '234', '324234', '2523', '234', '234532', '', '', '1970-01-01', '1', '0', '0', 'dfasdfsdf', '2018-09-19', '1', '2', 'sunni', '234324', '23423', '1', '1', 'u@gmail.com', 'b@gmail.com', 'dsfsdf', 'dsfdsf', 'sdfsdf', '42342323', '234234', '234234', '2343', '234', '324234', '324324');
INSERT INTO `employee_history` (`emp_his_id`, `employee_id`, `pos_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `alter_phone`, `present_address`, `parmanent_address`, `picture`, `degree_name`, `university_name`, `cgp`, `passing_year`, `company_name`, `working_period`, `duties`, `supervisor`, `signature`, `is_admin`, `dept_id`, `division_id`, `maiden_name`, `state`, `city`, `zip`, `citizenship`, `duty_type`, `hire_date`, `original_hire_date`, `termination_date`, `termination_reason`, `voluntary_termination`, `rehire_date`, `rate_type`, `rate`, `pay_frequency`, `pay_frequency_txt`, `hourly_rate2`, `hourly_rate3`, `home_department`, `department_text`, `class_code`, `class_code_desc`, `class_acc_date`, `class_status`, `is_super_visor`, `super_visor_id`, `supervisor_report`, `dob`, `gender`, `marital_status`, `ethnic_group`, `eeo_class_gp`, `ssn`, `work_in_state`, `live_in_state`, `home_email`, `business_email`, `home_phone`, `business_phone`, `cell_phone`, `emerg_contct`, `emrg_h_phone`, `emrg_w_phone`, `emgr_contct_relation`, `alt_em_contct`, `alt_emg_h_phone`, `alt_emg_w_phone`) VALUES ('164', 'E1Q5NMGS', '5', 'Harun', NULL, 'Ur Rashid', 'harun@gmail.com', '01955110016', '23423523', NULL, NULL, './application/modules/employee/assets/images/2018-09-20/log.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '4', '7', 'Harun', 'New York', 'test', '32244', '0', '2', '2018-09-20', '2018-09-21', '2018-09-21', 'sdfsdf', '1', '2018-09-21', '1', '234234', '2', '234', '234', '234', '234', '23', '', '', '0000-00-00', '0', '0', '0', 'supervisor reports', '2018-07-04', '2', '1', 'sunni', 'dsfsd', '23423', '1', '1', 'home@gmail.com', 'bussiness@gmail.com', '23423', '234', '4234234', '235543', '234324', '325345', '423432', '2342', '34234', '234234');
INSERT INTO `employee_history` (`emp_his_id`, `employee_id`, `pos_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `alter_phone`, `present_address`, `parmanent_address`, `picture`, `degree_name`, `university_name`, `cgp`, `passing_year`, `company_name`, `working_period`, `duties`, `supervisor`, `signature`, `is_admin`, `dept_id`, `division_id`, `maiden_name`, `state`, `city`, `zip`, `citizenship`, `duty_type`, `hire_date`, `original_hire_date`, `termination_date`, `termination_reason`, `voluntary_termination`, `rehire_date`, `rate_type`, `rate`, `pay_frequency`, `pay_frequency_txt`, `hourly_rate2`, `hourly_rate3`, `home_department`, `department_text`, `class_code`, `class_code_desc`, `class_acc_date`, `class_status`, `is_super_visor`, `super_visor_id`, `supervisor_report`, `dob`, `gender`, `marital_status`, `ethnic_group`, `eeo_class_gp`, `ssn`, `work_in_state`, `live_in_state`, `home_email`, `business_email`, `home_phone`, `business_phone`, `cell_phone`, `emerg_contct`, `emrg_h_phone`, `emrg_w_phone`, `emgr_contct_relation`, `alt_em_contct`, `alt_emg_h_phone`, `alt_emg_w_phone`) VALUES ('165', '145454', '6', 'Hm', NULL, 'Isahaq', 'hmisahaq@gmail.com', '2344098234', '49023', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '5', '6', 'Yousuf', 'Alabama', 'deom', '3243', '0', '1', '2018-09-20', '2018-09-20', '2018-09-29', 'fsdf', '1', '2018-09-29', '1', '234', '3', '234', '0', '0', '', '', '', '', '0000-00-00', '0', '0', '165', '324', '2018-09-29', '1', '1', 'sdfsdf', '', '23423', '1', '1', '234', 'sd', '82309423', '', '234', '324234', '34242', '546456', '', '', '', '');
INSERT INTO `employee_history` (`emp_his_id`, `employee_id`, `pos_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `alter_phone`, `present_address`, `parmanent_address`, `picture`, `degree_name`, `university_name`, `cgp`, `passing_year`, `company_name`, `working_period`, `duties`, `supervisor`, `signature`, `is_admin`, `dept_id`, `division_id`, `maiden_name`, `state`, `city`, `zip`, `citizenship`, `duty_type`, `hire_date`, `original_hire_date`, `termination_date`, `termination_reason`, `voluntary_termination`, `rehire_date`, `rate_type`, `rate`, `pay_frequency`, `pay_frequency_txt`, `hourly_rate2`, `hourly_rate3`, `home_department`, `department_text`, `class_code`, `class_code_desc`, `class_acc_date`, `class_status`, `is_super_visor`, `super_visor_id`, `supervisor_report`, `dob`, `gender`, `marital_status`, `ethnic_group`, `eeo_class_gp`, `ssn`, `work_in_state`, `live_in_state`, `home_email`, `business_email`, `home_phone`, `business_phone`, `cell_phone`, `emerg_contct`, `emrg_h_phone`, `emrg_w_phone`, `emgr_contct_relation`, `alt_em_contct`, `alt_emg_h_phone`, `alt_emg_w_phone`) VALUES ('166', 'EQLAJFUW', '6', 'Ainal', '', 'Haque', 'ainal@gmail.com', '01715234991', '', NULL, NULL, './application/modules/employee/assets/images/2018-11-12/def1.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '3', '0', '', 'Alabama', '', '0', '1', '1', '2018-11-12', '2018-11-12', '2018-11-12', '', '1', '2018-11-12', '1', '5', '1', '', '0', '0', '', '', '', '', '2018-11-12', '1', NULL, '0', '', '2018-11-12', '1', '1', '', '', '3425', '1', '1', '', '', '017123657332', '', '017123657332', '017123657332', '017123657332', '017123657332', '', '', '', '');


#
# TABLE STRUCTURE FOR: employee_performance
#

DROP TABLE IF EXISTS `employee_performance`;

CREATE TABLE `employee_performance` (
  `emp_per_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `note` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date` varchar(50) CHARACTER SET latin1 NOT NULL,
  `note_by` varchar(50) CHARACTER SET latin1 NOT NULL,
  `number_of_star` varchar(50) CHARACTER SET latin1 NOT NULL,
  `status` varchar(50) CHARACTER SET latin1 NOT NULL,
  `updated_by` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`emp_per_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: employee_salary_payment
#

DROP TABLE IF EXISTS `employee_salary_payment`;

CREATE TABLE `employee_salary_payment` (
  `emp_sal_pay_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `total_salary` varchar(50) CHARACTER SET latin1 NOT NULL,
  `total_working_minutes` varchar(50) CHARACTER SET latin1 NOT NULL,
  `working_period` varchar(50) CHARACTER SET latin1 NOT NULL,
  `payment_due` varchar(50) CHARACTER SET latin1 NOT NULL,
  `payment_date` varchar(50) CHARACTER SET latin1 NOT NULL,
  `paid_by` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`emp_sal_pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: foodvariable
#

DROP TABLE IF EXISTS `foodvariable`;

CREATE TABLE `foodvariable` (
  `availableID` int(11) NOT NULL AUTO_INCREMENT,
  `foodid` int(11) NOT NULL,
  `availtime` varchar(50) NOT NULL,
  `availday` varchar(30) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`availableID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `foodvariable` (`availableID`, `foodid`, `availtime`, `availday`, `is_active`) VALUES ('1', '1', 'Saturday', '2:00PM-9:00PM', '1');
INSERT INTO `foodvariable` (`availableID`, `foodid`, `availtime`, `availday`, `is_active`) VALUES ('2', '2', 'Sunday', '11:30AM-7:00PM', '1');


#
# TABLE STRUCTURE FOR: gender
#

DROP TABLE IF EXISTS `gender`;

CREATE TABLE `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `gender` (`id`, `gender_name`) VALUES ('1', 'Male');
INSERT INTO `gender` (`id`, `gender_name`) VALUES ('2', 'Female');
INSERT INTO `gender` (`id`, `gender_name`) VALUES ('3', 'Other');


#
# TABLE STRUCTURE FOR: ingredients
#

DROP TABLE IF EXISTS `ingredients`;

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredient_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `uom_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('2', 'Oil', '2', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('3', 'Onion', '1', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('4', 'Ginger', '1', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('5', 'Beef Meat', '1', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('6', 'Mutton', '1', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('7', 'Sugar', '1', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('8', 'Egg', '7', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('9', 'ground beef', '9', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('10', 'Worcestershire', '10', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('11', 'salt', '1', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('12', 'hamburger buns', '7', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('13', 'mayonnaise', '3', '1');
INSERT INTO `ingredients` (`id`, `ingredient_name`, `uom_id`, `is_active`) VALUES ('14', 'tomato', '1', '1');


#
# TABLE STRUCTURE FOR: item_category
#

DROP TABLE IF EXISTS `item_category`;

CREATE TABLE `item_category` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `CategoryImage` varchar(255) DEFAULT NULL,
  `Position` int(11) DEFAULT NULL,
  `CategoryIsActive` int(11) DEFAULT NULL,
  `offerstartdate` date DEFAULT '0000-00-00',
  `offerendate` date NOT NULL DEFAULT '0000-00-00',
  `isoffer` int(11) DEFAULT '0',
  `parentid` int(11) DEFAULT '0',
  `UserIDInserted` int(11) NOT NULL DEFAULT '0',
  `UserIDUpdated` int(11) NOT NULL DEFAULT '0',
  `UserIDLocked` int(11) NOT NULL DEFAULT '0',
  `DateInserted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateLocked` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`CategoryID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO `item_category` (`CategoryID`, `Name`, `CategoryImage`, `Position`, `CategoryIsActive`, `offerstartdate`, `offerendate`, `isoffer`, `parentid`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('3', 'Appetizers', './application/modules/itemmanage/assets/images/2018-11-04/apa.jpg', NULL, '1', '2018-11-15', '0000-00-00', '1', '3', '2', '2', '2', '2018-11-04 11:51:52', '2018-11-04 12:00:02', '2018-11-04 11:51:52');
INSERT INTO `item_category` (`CategoryID`, `Name`, `CategoryImage`, `Position`, `CategoryIsActive`, `offerstartdate`, `offerendate`, `isoffer`, `parentid`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('4', 'Burger', './application/modules/itemmanage/assets/images/2018-11-04/bur1.jpg', NULL, '1', '2018-11-22', '2018-11-28', '1', '4', '2', '2', '2', '2018-11-04 12:03:46', '2018-11-05 09:21:56', '2018-11-04 12:03:46');
INSERT INTO `item_category` (`CategoryID`, `Name`, `CategoryImage`, `Position`, `CategoryIsActive`, `offerstartdate`, `offerendate`, `isoffer`, `parentid`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('5', 'Pizza', './application/modules/itemmanage/assets/images/2018-11-04/piz.jpg', NULL, '1', '0000-00-00', '0000-00-00', '0', '0', '2', '2', '2', '2018-11-04 12:04:19', '2018-11-04 12:04:19', '2018-11-04 12:04:19');
INSERT INTO `item_category` (`CategoryID`, `Name`, `CategoryImage`, `Position`, `CategoryIsActive`, `offerstartdate`, `offerendate`, `isoffer`, `parentid`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('6', 'Tandoori', './application/modules/itemmanage/assets/images/2018-11-04/tan.jpg', NULL, '1', '0000-00-00', '0000-00-00', '0', '0', '2', '2', '2', '2018-11-04 12:06:02', '2018-11-04 12:06:02', '2018-11-04 12:06:02');
INSERT INTO `item_category` (`CategoryID`, `Name`, `CategoryImage`, `Position`, `CategoryIsActive`, `offerstartdate`, `offerendate`, `isoffer`, `parentid`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('7', 'Indian', './application/modules/itemmanage/assets/images/2018-11-04/ind.jpg', NULL, '0', '0000-00-00', '0000-00-00', '0', '0', '2', '2', '2', '2018-11-04 12:07:02', '2018-11-04 12:07:02', '2018-11-04 12:07:02');
INSERT INTO `item_category` (`CategoryID`, `Name`, `CategoryImage`, `Position`, `CategoryIsActive`, `offerstartdate`, `offerendate`, `isoffer`, `parentid`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('9', 'Fast Food', './application/modules/itemmanage/assets/images/2018-11-04/fas.jpg', NULL, '1', '0000-00-00', '0000-00-00', '0', '0', '2', '2', '2', '2018-11-04 13:00:19', '2018-11-04 13:00:19', '2018-11-04 13:00:19');
INSERT INTO `item_category` (`CategoryID`, `Name`, `CategoryImage`, `Position`, `CategoryIsActive`, `offerstartdate`, `offerendate`, `isoffer`, `parentid`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('10', 'Chinese Mains', './application/modules/itemmanage/assets/images/2018-11-04/chi.jpg', NULL, '1', '0000-00-00', '0000-00-00', '0', '0', '2', '2', '2', '2018-11-04 13:07:23', '2018-11-04 13:07:23', '2018-11-04 13:07:23');


#
# TABLE STRUCTURE FOR: item_foods
#

DROP TABLE IF EXISTS `item_foods`;

CREATE TABLE `item_foods` (
  `ProductsID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryID` int(11) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductImage` varchar(200) DEFAULT NULL,
  `component` text,
  `productvat` int(11) DEFAULT '0',
  `OffersRate` int(11) NOT NULL DEFAULT '0' COMMENT '1=offer rate',
  `offerIsavailable` int(11) NOT NULL DEFAULT '0' COMMENT '1=offer available,0=No Offer',
  `offerstartdate` date DEFAULT '0000-00-00',
  `offerendate` date DEFAULT '0000-00-00',
  `Position` int(11) DEFAULT NULL,
  `ProductsIsActive` int(11) DEFAULT NULL,
  `UserIDInserted` int(11) NOT NULL DEFAULT '0',
  `UserIDUpdated` int(11) NOT NULL DEFAULT '0',
  `UserIDLocked` int(11) NOT NULL DEFAULT '0',
  `DateInserted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateLocked` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ProductsID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `item_foods` (`ProductsID`, `CategoryID`, `ProductName`, `ProductImage`, `component`, `productvat`, `OffersRate`, `offerIsavailable`, `offerstartdate`, `offerendate`, `Position`, `ProductsIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('1', '4', 'Hamburgers', './application/modules/itemmanage/assets/images/2018-11-06/bur1.jpg', 'ground beef,Macaroni,Ground meat,soy sauce', '3', '0', '0', '0000-00-00', '0000-00-00', NULL, '1', '2', '2', '2', '2018-11-06 11:56:00', '2018-11-06 11:58:23', '2018-11-06 11:56:00');
INSERT INTO `item_foods` (`ProductsID`, `CategoryID`, `ProductName`, `ProductImage`, `component`, `productvat`, `OffersRate`, `offerIsavailable`, `offerstartdate`, `offerendate`, `Position`, `ProductsIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('2', '4', 'Bacon cheeseburger', './application/modules/itemmanage/assets/images/2018-11-06/bur2.jpg', 'ground beef,Macaroni,Ground meat,soy sauce', '0', '5', '1', '2018-11-08', '2018-11-29', NULL, '1', '2', '2', '2', '2018-11-06 11:59:46', '2018-11-06 11:59:46', '2018-11-06 11:59:46');
INSERT INTO `item_foods` (`ProductsID`, `CategoryID`, `ProductName`, `ProductImage`, `component`, `productvat`, `OffersRate`, `offerIsavailable`, `offerstartdate`, `offerendate`, `Position`, `ProductsIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('3', '5', 'Chicago Pizza', './application/modules/itemmanage/assets/images/2018-11-12/piz.jpg', 'tomato sauce. Generally, the toppings for Chicago pizza are ground beef, sausage, pepperoni, onion, mushrooms, and green peppers', '0', '0', '0', '0000-00-00', '0000-00-00', NULL, '1', '2', '2', '2', '2018-11-12 11:50:22', '2018-11-12 11:50:22', '2018-11-12 11:50:22');
INSERT INTO `item_foods` (`ProductsID`, `CategoryID`, `ProductName`, `ProductImage`, `component`, `productvat`, `OffersRate`, `offerIsavailable`, `offerstartdate`, `offerendate`, `Position`, `ProductsIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('4', '5', 'Sicilian Pizza', './application/modules/itemmanage/assets/images/2018-11-12/piz1.jpg', 'tomato sauce, onions, herbs, anchovies', '0', '0', '0', '0000-00-00', '0000-00-00', NULL, '1', '2', '2', '2', '2018-11-12 11:51:22', '2018-11-12 11:51:22', '2018-11-12 11:51:22');
INSERT INTO `item_foods` (`ProductsID`, `CategoryID`, `ProductName`, `ProductImage`, `component`, `productvat`, `OffersRate`, `offerIsavailable`, `offerstartdate`, `offerendate`, `Position`, `ProductsIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('5', '6', 'Special Tandoori', NULL, '', '0', '0', '0', '0000-00-00', '0000-00-00', NULL, '1', '2', '2', '2', '2018-11-15 11:40:17', '2018-11-15 11:40:17', '2018-11-15 11:40:17');
INSERT INTO `item_foods` (`ProductsID`, `CategoryID`, `ProductName`, `ProductImage`, `component`, `productvat`, `OffersRate`, `offerIsavailable`, `offerstartdate`, `offerendate`, `Position`, `ProductsIsActive`, `UserIDInserted`, `UserIDUpdated`, `UserIDLocked`, `DateInserted`, `DateUpdated`, `DateLocked`) VALUES ('6', '9', '301. Club Sandwich', NULL, '', '0', '0', '0', '0000-00-00', '0000-00-00', NULL, '1', '2', '2', '2', '2018-11-15 11:43:43', '2018-11-15 11:43:43', '2018-11-15 11:43:43');


#
# TABLE STRUCTURE FOR: language
#

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` varchar(100) NOT NULL,
  `english` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('2', 'login', 'Login');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('3', 'email', 'Email Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('4', 'password', 'Password');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('5', 'reset', 'Reset');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('6', 'dashboard', 'Dashboard');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('7', 'home', 'Home');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('8', 'profile', 'Profile');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('9', 'profile_setting', 'Profile Setting');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('10', 'firstname', 'First Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('11', 'lastname', 'Last Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('12', 'about', 'About');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('13', 'preview', 'Preview');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('14', 'image', 'Image');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('15', 'save', 'Save');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('16', 'upload_successfully', 'Upload Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('17', 'user_added_successfully', 'User Added Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('18', 'please_try_again', 'Please Try Again...');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('19', 'inbox_message', 'Inbox Messages');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('20', 'sent_message', 'Sent Message');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('21', 'message_details', 'Message Details');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('22', 'new_message', 'New Message');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('23', 'receiver_name', 'Receiver Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('24', 'sender_name', 'Sender Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('25', 'subject', 'Subject');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('26', 'message', 'Message');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('27', 'message_sent', 'Message Sent!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('28', 'ip_address', 'IP Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('29', 'last_login', 'Last Login');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('30', 'last_logout', 'Last Logout');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('31', 'status', 'Status');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('32', 'delete_successfully', 'Delete Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('33', 'send', 'Send');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('34', 'date', 'Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('35', 'action', 'Action');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('36', 'sl_no', 'SL No.');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('37', 'are_you_sure', 'Are You Sure ? ');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('38', 'application_setting', 'Application Setting');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('39', 'application_title', 'Application Title');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('40', 'address', 'Address');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('41', 'phone', 'Phone');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('42', 'favicon', 'Favicon');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('43', 'logo', 'Logo');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('44', 'language', 'Language');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('45', 'left_to_right', 'Left To Right');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('46', 'right_to_left', 'Right To Left');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('47', 'footer_text', 'Footer Text');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('48', 'site_align', 'Application Alignment');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('49', 'welcome_back', 'Welcome Back!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('50', 'please_contact_with_admin', 'Please Contact With Admin');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('51', 'incorrect_email_or_password', 'Incorrect Email/Password');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('52', 'select_option', 'Select Option');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('53', 'ftp_setting', 'Data Synchronize [FTP Setting]');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('54', 'hostname', 'Host Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('55', 'username', 'User Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('56', 'ftp_port', 'FTP Port');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('57', 'ftp_debug', 'FTP Debug');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('58', 'project_root', 'Project Root');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('59', 'update_successfully', 'Update Successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('60', 'save_successfully', 'Save Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('61', 'delete_successfully', 'Delete Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('62', 'internet_connection', 'Internet Connection');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('63', 'ok', 'Ok');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('64', 'not_available', 'Not Available');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('65', 'available', 'Available');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('66', 'outgoing_file', 'Outgoing File');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('67', 'incoming_file', 'Incoming File');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('68', 'data_synchronize', 'Data Synchronize');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('69', 'unable_to_upload_file_please_check_configuration', 'Unable to upload file! please check configuration');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('70', 'please_configure_synchronizer_settings', 'Please configure synchronizer settings');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('71', 'download_successfully', 'Download Successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('72', 'unable_to_download_file_please_check_configuration', 'Unable to download file! please check configuration');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('73', 'data_import_first', 'Data Import First');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('74', 'data_import_successfully', 'Data Import Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('75', 'unable_to_import_data_please_check_config_or_sql_file', 'Unable to import data! please check configuration / SQL file.');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('76', 'download_data_from_server', 'Download Data from Server');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('77', 'data_import_to_database', 'Data Import To Database');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('79', 'data_upload_to_server', 'Data Upload to Server');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('80', 'please_wait', 'Please Wait...');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('81', 'ooops_something_went_wrong', ' Ooops something went wrong...');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('82', 'module_permission_list', 'Module Permission List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('83', 'user_permission', 'User Permission');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('84', 'add_module_permission', 'Add Module Permission');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('85', 'module_permission_added_successfully', 'Module Permission Added Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('86', 'update_module_permission', 'Update Module Permission');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('87', 'download', 'Download');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('88', 'module_name', 'Module Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('89', 'create', 'Create');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('90', 'read', 'Read');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('91', 'update', 'Update');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('92', 'delete', 'Delete');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('93', 'module_list', 'Module List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('94', 'add_module', 'Add Module');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('95', 'directory', 'Module Direcotory');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('96', 'description', 'Description');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('97', 'image_upload_successfully', 'Image Upload Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('98', 'module_added_successfully', 'Module Added Successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('99', 'inactive', 'Inactive');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('100', 'active', 'Active');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('101', 'user_list', 'User List');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('102', 'see_all_message', 'See All Messages');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('103', 'setting', 'Setting');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('104', 'logout', 'Logout');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('105', 'admin', 'Admin');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('106', 'add_user', 'Add User');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('107', 'user', 'User');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('108', 'module', 'Module');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('109', 'new', 'New');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('110', 'inbox', 'Inbox');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('111', 'sent', 'Sent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('112', 'synchronize', 'Synchronize');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('113', 'data_synchronizer', 'Data Synchronizer');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('114', 'module_permission', 'Module Permission');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('115', 'backup_now', 'Backup Now!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('116', 'restore_now', 'Restore Now!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('117', 'backup_and_restore', 'Backup and Restore');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('118', 'captcha', 'Captcha Word');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('119', 'database_backup', 'Database Backup');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('120', 'restore_successfully', 'Restore Successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('121', 'backup_successfully', 'Backup Successfully');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('122', 'filename', 'File Name');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('123', 'file_information', 'File Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('124', 'size', 'size');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('125', 'backup_date', 'Backup Date');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('126', 'overwrite', 'Overwrite');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('127', 'invalid_file', 'Invalid File!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('128', 'invalid_module', 'Invalid Module');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('129', 'remove_successfully', 'Remove Successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('130', 'install', 'Install');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('131', 'uninstall', 'Uninstall');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('132', 'tables_are_not_available_in_database', 'Tables are not available in database.sql');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('133', 'no_tables_are_registered_in_config', 'No tables are registerd in config.php');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('134', 'enquiry', 'Enquiry');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('135', 'read_unread', 'Read/Unread');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('136', 'enquiry_information', 'Enquiry Information');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('137', 'user_agent', 'User Agent');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('138', 'checked_by', 'Checked By');
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES ('139', 'new_enquiry', 'New Enquiry');


#
# TABLE STRUCTURE FOR: marital_info
#

DROP TABLE IF EXISTS `marital_info`;

CREATE TABLE `marital_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marital_sta` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `marital_info` (`id`, `marital_sta`) VALUES ('1', 'Single');
INSERT INTO `marital_info` (`id`, `marital_sta`) VALUES ('2', 'Married');
INSERT INTO `marital_info` (`id`, `marital_sta`) VALUES ('3', 'Divorced');
INSERT INTO `marital_info` (`id`, `marital_sta`) VALUES ('4', 'Widowed');
INSERT INTO `marital_info` (`id`, `marital_sta`) VALUES ('5', 'Other');


#
# TABLE STRUCTURE FOR: membership
#

DROP TABLE IF EXISTS `membership`;

CREATE TABLE `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `discount` float NOT NULL,
  `other_facilities` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `membership` (`id`, `membership_name`, `discount`, `other_facilities`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('1', 'Premium Member', '20', 'Get a souse', '2', '2018-11-07', '2', '2018-11-07');
INSERT INTO `membership` (`id`, `membership_name`, `discount`, `other_facilities`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('2', 'Silver Member', '18', '', '2', '2018-11-07', '2', '2018-11-07');
INSERT INTO `membership` (`id`, `membership_name`, `discount`, `other_facilities`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('3', 'Gold Member', '20', '', '2', '2018-11-07', '2', '2018-11-07');


#
# TABLE STRUCTURE FOR: menu_add_on
#

DROP TABLE IF EXISTS `menu_add_on`;

CREATE TABLE `menu_add_on` (
  `row_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `add_on_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `menu_add_on` (`row_id`, `menu_id`, `add_on_id`, `is_active`) VALUES ('1', '1', '1', '1');
INSERT INTO `menu_add_on` (`row_id`, `menu_id`, `add_on_id`, `is_active`) VALUES ('2', '1', '5', '1');
INSERT INTO `menu_add_on` (`row_id`, `menu_id`, `add_on_id`, `is_active`) VALUES ('7', '2', '1', '1');
INSERT INTO `menu_add_on` (`row_id`, `menu_id`, `add_on_id`, `is_active`) VALUES ('8', '5', '4', '1');
INSERT INTO `menu_add_on` (`row_id`, `menu_id`, `add_on_id`, `is_active`) VALUES ('9', '6', '4', '1');


#
# TABLE STRUCTURE FOR: message
#

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL,
  `sender_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen, 2=delete',
  `receiver_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen, 2=delete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES ('1', '2', '1', 'TEST', 'All the best', '2017-02-07 00:00:00', '0', '2');
INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES ('3', '26', '3', 'TEST', 'Hello world!', '2017-02-07 00:00:00', '0', '1');
INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES ('10', '2', '17', 'TEST', 'The quick brown fox jumps over the lazy dog!', '2017-02-07 11:34:41', '0', '0');
INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES ('11', '2', '6', 'ateat', '<p>TEST</p>', '2017-05-11 10:00:07', '1', '0');


#
# TABLE STRUCTURE FOR: module
#

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `image` varchar(255) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: module_permission
#

DROP TABLE IF EXISTS `module_permission`;

CREATE TABLE `module_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_module_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `create` tinyint(1) DEFAULT NULL,
  `read` tinyint(1) DEFAULT NULL,
  `update` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_module_id` (`fk_module_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: order_menu
#

DROP TABLE IF EXISTS `order_menu`;

CREATE TABLE `order_menu` (
  `row_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menuqty` float NOT NULL,
  `add_on_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `addonsqty` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `varientid` int(11) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `order_menu` (`row_id`, `order_id`, `menu_id`, `menuqty`, `add_on_id`, `addonsqty`, `varientid`) VALUES ('1', '1', '1', '1', '1', '1', '1');
INSERT INTO `order_menu` (`row_id`, `order_id`, `menu_id`, `menuqty`, `add_on_id`, `addonsqty`, `varientid`) VALUES ('3', '1', '2', '2', '1', '1', '3');
INSERT INTO `order_menu` (`row_id`, `order_id`, `menu_id`, `menuqty`, `add_on_id`, `addonsqty`, `varientid`) VALUES ('4', '1', '1', '1', '5', '1', '2');
INSERT INTO `order_menu` (`row_id`, `order_id`, `menu_id`, `menuqty`, `add_on_id`, `addonsqty`, `varientid`) VALUES ('5', '1', '4', '1', '', '', '5');
INSERT INTO `order_menu` (`row_id`, `order_id`, `menu_id`, `menuqty`, `add_on_id`, `addonsqty`, `varientid`) VALUES ('6', '2', '3', '1', '', '', '4');
INSERT INTO `order_menu` (`row_id`, `order_id`, `menu_id`, `menuqty`, `add_on_id`, `addonsqty`, `varientid`) VALUES ('7', '2', '2', '1', '1', '1', '3');
INSERT INTO `order_menu` (`row_id`, `order_id`, `menu_id`, `menuqty`, `add_on_id`, `addonsqty`, `varientid`) VALUES ('8', '2', '4', '1', '', '', '5');


#
# TABLE STRUCTURE FOR: pay_frequency
#

DROP TABLE IF EXISTS `pay_frequency`;

CREATE TABLE `pay_frequency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frequency_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `pay_frequency` (`id`, `frequency_name`) VALUES ('1', 'Weekly');
INSERT INTO `pay_frequency` (`id`, `frequency_name`) VALUES ('2', 'Biweekly');
INSERT INTO `pay_frequency` (`id`, `frequency_name`) VALUES ('3', 'Annual');


#
# TABLE STRUCTURE FOR: payment_method
#

DROP TABLE IF EXISTS `payment_method`;

CREATE TABLE `payment_method` (
  `payment_method_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `payment_method` (`payment_method_id`, `payment_method`, `is_active`) VALUES ('1', 'Card Payment', '1');
INSERT INTO `payment_method` (`payment_method_id`, `payment_method`, `is_active`) VALUES ('2', 'Bikash Payment', '1');
INSERT INTO `payment_method` (`payment_method_id`, `payment_method`, `is_active`) VALUES ('3', 'Online Payment', '1');
INSERT INTO `payment_method` (`payment_method_id`, `payment_method`, `is_active`) VALUES ('4', 'Cash Payment', '1');


#
# TABLE STRUCTURE FOR: position
#

DROP TABLE IF EXISTS `position`;

CREATE TABLE `position` (
  `pos_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `position_details` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`pos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES ('1', 'chef', 'Responsible for the pastry shop in a foodservice establishment. Ensures that the products produced in the pastry shop meet the quality standards in conjunction with the executive chef.');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES ('2', 'HRM', 'Recruits and hires qualified employees, creates in-house job-training programs, and assists employees with their career needs.');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES ('3', 'Kitchen manager', 'Supervises and coordinates activities concerning all back-of-the-house operations and personnel, including food preparation, kitchen and storeroom areas.');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES ('4', 'Counter server', 'Responsible for providing quick and efficient service to customers. Greets customers, takes their food and beverage orders, rings orders into register, and prepares and serves hot and cold drinks.');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES ('5', 'Cashier', 'Like the drive-thru operator, cashiers must accurately record a customer’s order and handle cash to process the transaction. Cashiers must be able to listen when customers have problems or');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES ('6', 'Waiter', 'Most waiters and waitresses, also called servers, work in full-service restaurants. They greet customers, take food orders, bring food and drinks to the tables and take payment and make change.');
INSERT INTO `position` (`pos_id`, `position_name`, `position_details`) VALUES ('7', 'Accounts', 'Play a key role in every restaurant. ');


#
# TABLE STRUCTURE FOR: production
#

DROP TABLE IF EXISTS `production`;

CREATE TABLE `production` (
  `productionid` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) NOT NULL,
  `itemquantity` int(11) NOT NULL,
  `savedby` int(11) NOT NULL,
  `saveddate` date NOT NULL,
  PRIMARY KEY (`productionid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `production` (`productionid`, `itemid`, `itemquantity`, `savedby`, `saveddate`) VALUES ('1', '1', '2', '2', '2018-11-13');


#
# TABLE STRUCTURE FOR: production_details
#

DROP TABLE IF EXISTS `production_details`;

CREATE TABLE `production_details` (
  `pro_detailsid` int(11) NOT NULL AUTO_INCREMENT,
  `productionid` int(11) NOT NULL,
  `ingredientid` int(11) NOT NULL,
  `qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `createdby` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`pro_detailsid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `production_details` (`pro_detailsid`, `productionid`, `ingredientid`, `qty`, `createdby`, `created_date`) VALUES ('1', '1', '12', '2.00', '2', '2018-11-13');
INSERT INTO `production_details` (`pro_detailsid`, `productionid`, `ingredientid`, `qty`, `createdby`, `created_date`) VALUES ('2', '1', '13', '0.25', '2', '2018-11-13');


#
# TABLE STRUCTURE FOR: purchase_details
#

DROP TABLE IF EXISTS `purchase_details`;

CREATE TABLE `purchase_details` (
  `detailsid` int(11) NOT NULL AUTO_INCREMENT,
  `purchaseid` int(11) NOT NULL,
  `indredientid` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `totalprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `purchaseby` int(11) NOT NULL,
  `purchasedate` date NOT NULL,
  PRIMARY KEY (`detailsid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO `purchase_details` (`detailsid`, `purchaseid`, `indredientid`, `quantity`, `price`, `totalprice`, `purchaseby`, `purchasedate`) VALUES ('1', '1', '2', '2.00', '105.00', '210.00', '2', '2018-11-11');
INSERT INTO `purchase_details` (`detailsid`, `purchaseid`, `indredientid`, `quantity`, `price`, `totalprice`, `purchaseby`, `purchasedate`) VALUES ('2', '1', '3', '3.00', '35.00', '105.00', '2', '2018-11-11');
INSERT INTO `purchase_details` (`detailsid`, `purchaseid`, `indredientid`, `quantity`, `price`, `totalprice`, `purchaseby`, `purchasedate`) VALUES ('9', '1', '4', '1.00', '120.00', '120.00', '2', '2018-11-11');
INSERT INTO `purchase_details` (`detailsid`, `purchaseid`, `indredientid`, `quantity`, `price`, `totalprice`, `purchaseby`, `purchasedate`) VALUES ('10', '2', '11', '5.00', '40.00', '200.00', '2', '2018-11-13');
INSERT INTO `purchase_details` (`detailsid`, `purchaseid`, `indredientid`, `quantity`, `price`, `totalprice`, `purchaseby`, `purchasedate`) VALUES ('11', '2', '8', '12.00', '8.00', '96.00', '2', '2018-11-13');
INSERT INTO `purchase_details` (`detailsid`, `purchaseid`, `indredientid`, `quantity`, `price`, `totalprice`, `purchaseby`, `purchasedate`) VALUES ('12', '2', '12', '20.00', '15.00', '300.00', '2', '2018-11-13');
INSERT INTO `purchase_details` (`detailsid`, `purchaseid`, `indredientid`, `quantity`, `price`, `totalprice`, `purchaseby`, `purchasedate`) VALUES ('13', '2', '14', '5.00', '75.00', '375.00', '2', '2018-11-13');
INSERT INTO `purchase_details` (`detailsid`, `purchaseid`, `indredientid`, `quantity`, `price`, `totalprice`, `purchaseby`, `purchasedate`) VALUES ('14', '2', '10', '10.00', '100.00', '1000.00', '2', '2018-11-13');
INSERT INTO `purchase_details` (`detailsid`, `purchaseid`, `indredientid`, `quantity`, `price`, `totalprice`, `purchaseby`, `purchasedate`) VALUES ('15', '3', '13', '4.00', '120.00', '480.00', '2', '2018-11-13');
INSERT INTO `purchase_details` (`detailsid`, `purchaseid`, `indredientid`, `quantity`, `price`, `totalprice`, `purchaseby`, `purchasedate`) VALUES ('16', '3', '9', '5.00', '400.00', '2000.00', '2', '2018-11-13');


#
# TABLE STRUCTURE FOR: purchaseitem
#

DROP TABLE IF EXISTS `purchaseitem`;

CREATE TABLE `purchaseitem` (
  `purID` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceid` int(11) NOT NULL,
  `suplierID` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `purchasedate` date NOT NULL,
  `savedby` int(11) NOT NULL,
  PRIMARY KEY (`purID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `purchaseitem` (`purID`, `invoiceid`, `suplierID`, `total_price`, `details`, `purchasedate`, `savedby`) VALUES ('1', '1', '1', '435.00', '', '2018-11-11', '2');
INSERT INTO `purchaseitem` (`purID`, `invoiceid`, `suplierID`, `total_price`, `details`, `purchasedate`, `savedby`) VALUES ('2', '3', '2', '1971.00', '', '2018-11-13', '2');
INSERT INTO `purchaseitem` (`purID`, `invoiceid`, `suplierID`, `total_price`, `details`, `purchasedate`, `savedby`) VALUES ('3', '4', '1', '2480.00', '', '2018-11-13', '2');


#
# TABLE STRUCTURE FOR: rate_type
#

DROP TABLE IF EXISTS `rate_type`;

CREATE TABLE `rate_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `r_type_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `rate_type` (`id`, `r_type_name`) VALUES ('1', 'Hourly');
INSERT INTO `rate_type` (`id`, `r_type_name`) VALUES ('2', 'Salary');


#
# TABLE STRUCTURE FOR: rest_table
#

DROP TABLE IF EXISTS `rest_table`;

CREATE TABLE `rest_table` (
  `tableid` int(11) NOT NULL AUTO_INCREMENT,
  `tablename` varchar(50) NOT NULL,
  `person_capicity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1=booked,0=free',
  PRIMARY KEY (`tableid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `rest_table` (`tableid`, `tablename`, `person_capicity`, `status`) VALUES ('1', '1', '4', '0');
INSERT INTO `rest_table` (`tableid`, `tablename`, `person_capicity`, `status`) VALUES ('2', '2', '4', '0');
INSERT INTO `rest_table` (`tableid`, `tablename`, `person_capicity`, `status`) VALUES ('3', '3', '6', '0');
INSERT INTO `rest_table` (`tableid`, `tablename`, `person_capicity`, `status`) VALUES ('4', '4', '5', '0');
INSERT INTO `rest_table` (`tableid`, `tablename`, `person_capicity`, `status`) VALUES ('5', '5', '6', '0');
INSERT INTO `rest_table` (`tableid`, `tablename`, `person_capicity`, `status`) VALUES ('6', '6', '3', '0');


#
# TABLE STRUCTURE FOR: role_permission
#

DROP TABLE IF EXISTS `role_permission`;

CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `create` tinyint(1) DEFAULT NULL,
  `read` tinyint(1) DEFAULT NULL,
  `update` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_module_id` (`fk_module_id`),
  KEY `fk_user_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: sec_menu_item
#

DROP TABLE IF EXISTS `sec_menu_item`;

CREATE TABLE `sec_menu_item` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_url` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_menu` int(11) DEFAULT NULL,
  `is_report` tinyint(1) DEFAULT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('1', 'manage_category', '', 'itemmanage', '0', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('2', 'category_list', 'item_category', 'itemmanage', '0', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('3', 'add_category', 'create', 'itemmanage', '2', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('4', 'manage_food', '', 'itemmanage', '0', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('5', 'food_list', 'item_food', 'itemmanage', '0', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('6', 'add_food', 'index', 'itemmanage', '5', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('7', 'food_varient', 'foodvarientlist', 'itemmanage', '5', '0', '2', '2018-11-07 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('8', 'add_varient', 'addvariant', 'itemmanage', '5', '0', '2', '2018-11-07 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('9', 'food_availablity', 'availablelist', 'itemmanage', '5', '0', '2', '2018-11-07 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('10', 'add_availablity', 'addavailable', 'itemmanage', '5', '0', '2', '2018-11-07 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('11', 'manage_addons', '', 'itemmanage', '0', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('12', 'addons_list', 'menu_addons', 'itemmanage', '0', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('13', 'add_adons', 'create', 'itemmanage', '8', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('14', 'manage_unitmeasurement', '', 'units', '0', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('15', 'unit_list', 'unitmeasurement', 'units', '0', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('16', 'unit_add', 'create', 'units', '12', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('17', 'manage_ingradient', '', 'units', '0', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('18', 'ingradient_list', 'ingradient', 'units', '0', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('19', 'add_ingredient', 'create', 'units', '15', '0', '2', '2018-11-05 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('20', 'assign_adons_list', 'assignaddons', 'itemmanage', '8', '0', '2', '2018-11-06 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('21', 'assign_adons', 'assignaddonscreate', 'itemmanage', '8', '0', '2', '2018-11-06 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('22', 'position', 'position_form', 'employee', '0', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('23', 'Direct_Empl', '', 'employee', '0', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('24', 'add_employee', 'employ_form', 'employee', '23', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('25', 'manage_employee', 'employee_view', 'employee', '23', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('26', 'emp_performance', 'emp_performance_form', 'employee', '0', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('27', 'emp_sal_payment', 'paymentview', 'employee', '0', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('28', 'membership_management', '', 'setting', '0', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('29', 'membership_list', 'index', 'setting', '28', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('30', 'membership_add', 'create', 'setting', '29', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('31', 'payment_setting', '', 'setting', '0', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('32', 'paymentmethod_list', 'index', 'setting', '31', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('33', 'payment_add', 'create', 'setting', '32', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('34', 'shipping_setting', '', 'setting', '0', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('35', 'shipping_list', 'index', 'setting', '34', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('36', 'shipping_add', 'create', 'setting', '35', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('37', 'supplier_manage', '', 'setting', '0', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('38', 'supplier_list', 'index', 'setting', '37', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('39', 'supplier_add', 'create', 'setting', '38', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('40', 'purchase_item', 'index', 'purchase', '0', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('41', 'purchase_add', 'create', 'purchase', '40', '0', '2', '2018-11-12 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('42', 'table_manage', '', 'setting', '0', '0', '2', '2018-11-13 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('43', 'add_new_table', 'create', 'setting', '44', '0', '2', '2018-11-13 00:00:00');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`) VALUES ('44', 'table_list', 'restauranttable', 'setting', '42', '0', '2', '2018-11-13 00:00:00');


#
# TABLE STRUCTURE FOR: sec_role_permission
#

DROP TABLE IF EXISTS `sec_role_permission`;

CREATE TABLE `sec_role_permission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `can_access` tinyint(1) NOT NULL,
  `can_create` tinyint(1) NOT NULL,
  `can_edit` tinyint(1) NOT NULL,
  `can_delete` tinyint(1) NOT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('169', '3', '1', '1', '1', '1', '1', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('170', '3', '2', '1', '0', '0', '0', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('171', '3', '3', '0', '0', '0', '0', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('172', '3', '4', '0', '0', '0', '0', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('173', '3', '5', '0', '0', '0', '0', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('174', '3', '6', '0', '0', '0', '0', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('175', '3', '7', '1', '1', '1', '1', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('176', '3', '8', '1', '0', '0', '0', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('177', '3', '10', '0', '0', '0', '0', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('178', '3', '17', '0', '0', '0', '0', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('179', '3', '18', '0', '0', '0', '0', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('180', '3', '11', '1', '1', '1', '1', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('181', '3', '12', '1', '1', '0', '0', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('182', '3', '13', '1', '1', '1', '1', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('183', '3', '14', '1', '1', '1', '1', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('184', '3', '15', '1', '1', '0', '0', '2', '2018-11-06 02:34:24');
INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES ('185', '3', '16', '0', '0', '0', '0', '2', '2018-11-06 02:34:24');


#
# TABLE STRUCTURE FOR: sec_role_tbl
#

DROP TABLE IF EXISTS `sec_role_tbl`;

CREATE TABLE `sec_role_tbl` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` text NOT NULL,
  `role_description` text NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `role_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `sec_role_tbl` (`role_id`, `role_name`, `role_description`, `create_by`, `date_time`, `role_status`) VALUES ('3', 'Manager', 'sdfdfsdf', '2', '2018-10-04 11:22:31', '1');
INSERT INTO `sec_role_tbl` (`role_id`, `role_name`, `role_description`, `create_by`, `date_time`, `role_status`) VALUES ('4', 'Second Role', 'sdfasdf', '2', '2018-10-24 08:07:37', '1');
INSERT INTO `sec_role_tbl` (`role_id`, `role_name`, `role_description`, `create_by`, `date_time`, `role_status`) VALUES ('5', 'Test', 'testyyu ', '2', '2018-11-05 10:28:38', '1');


#
# TABLE STRUCTURE FOR: sec_user_access_tbl
#

DROP TABLE IF EXISTS `sec_user_access_tbl`;

CREATE TABLE `sec_user_access_tbl` (
  `role_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_role_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  PRIMARY KEY (`role_acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES ('6', '3', '16');
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES ('9', '3', '7');
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES ('10', '4', '7');
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES ('13', '3', '1');
INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES ('14', '5', '9');


#
# TABLE STRUCTURE FOR: setting
#

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `address` text,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `site_align` varchar(50) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `setting` (`id`, `title`, `address`, `email`, `phone`, `logo`, `favicon`, `language`, `site_align`, `footer_text`) VALUES ('2', 'Dynamic Admin Panel', '98 Green Road, Farmgate, Dhaka-1215.', 'bdtask@gmail.com', '0123456789', 'assets/img/icons/logo.png', 'assets/img/icons/m.png', 'english', 'LTR', '2017Â©Copyright');


#
# TABLE STRUCTURE FOR: shipping_method
#

DROP TABLE IF EXISTS `shipping_method`;

CREATE TABLE `shipping_method` (
  `ship_id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_method` varchar(150) NOT NULL,
  `shippingrate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `shipping_method` (`ship_id`, `shipping_method`, `shippingrate`, `is_active`) VALUES ('1', 'Home Delivary', '60.00', '1');
INSERT INTO `shipping_method` (`ship_id`, `shipping_method`, `shippingrate`, `is_active`) VALUES ('2', 'Pickup', '0.00', '1');
INSERT INTO `shipping_method` (`ship_id`, `shipping_method`, `shippingrate`, `is_active`) VALUES ('3', 'In the restaurant', '0.00', '1');


#
# TABLE STRUCTURE FOR: supplier
#

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `supid` int(11) NOT NULL AUTO_INCREMENT,
  `supName` varchar(100) NOT NULL,
  `supEmail` varchar(100) NOT NULL,
  `supMobile` varchar(50) NOT NULL,
  `supAddress` text NOT NULL,
  PRIMARY KEY (`supid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `supplier` (`supid`, `supName`, `supEmail`, `supMobile`, `supAddress`) VALUES ('1', 'Md. Kamal Hossain', 'kamal@gmail.com', '01723451261', 'Uttara,Dhaka,Bangladesh');
INSERT INTO `supplier` (`supid`, `supName`, `supEmail`, `supMobile`, `supAddress`) VALUES ('2', 'Ilias Ali', 'ilias@gmail.com', '01723451221', 'Mirpur-10,Dhaka,Bangladesh.');


#
# TABLE STRUCTURE FOR: synchronizer_setting
#

DROP TABLE IF EXISTS `synchronizer_setting`;

CREATE TABLE `synchronizer_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `port` varchar(10) NOT NULL,
  `debug` varchar(10) NOT NULL,
  `project_root` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `synchronizer_setting` (`id`, `hostname`, `username`, `password`, `port`, `debug`, `project_root`) VALUES ('8', '70.35.198.244', 'softest3bdtask', 'Ux5O~MBJ#odK', '21', 'true', './public_html/');


#
# TABLE STRUCTURE FOR: unit_of_measurement
#

DROP TABLE IF EXISTS `unit_of_measurement`;

CREATE TABLE `unit_of_measurement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uom_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `uom_short_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES ('1', 'Kilogram', 'kg.', '1');
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES ('2', 'Liter', 'ltr.', '1');
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES ('3', 'Gram', 'grm.', '1');
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES ('4', 'tonne', 'tn.', '1');
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES ('5', 'milligram', 'mg.', '1');
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES ('6', 'carat', 'carat', '1');
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES ('7', 'Per Pieces', 'pcs', '1');
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES ('8', 'Per Cup', 'cup', '1');
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES ('9', 'Pound', 'pnd.', '1');
INSERT INTO `unit_of_measurement` (`id`, `uom_name`, `uom_short_code`, `is_active`) VALUES ('10', 'tablespoon', 'tspoon', '1');


#
# TABLE STRUCTURE FOR: user
#

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `about` text,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `password_reset_token` varchar(20) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `ip_address` varchar(14) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `firstname`, `lastname`, `about`, `email`, `password`, `password_reset_token`, `image`, `last_login`, `last_logout`, `ip_address`, `status`, `is_admin`) VALUES ('1', 'Johnny', 'Doe', '', 'johnny@example.com', '827ccb0eea8a706c4c34a16891f84e7b', '', './assets/img/user/m.png', '2017-05-22 13:01:39', '2017-05-22 13:02:46', '::1', '1', '0');
INSERT INTO `user` (`id`, `firstname`, `lastname`, `about`, `email`, `password`, `password_reset_token`, `image`, `last_login`, `last_logout`, `ip_address`, `status`, `is_admin`) VALUES ('2', 'John', 'Doe', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'admin@example.com', '827ccb0eea8a706c4c34a16891f84e7b', '', './assets/img/user/m2.png', '2017-06-22 12:21:20', '2017-05-22 13:01:32', '::1', '1', '1');
INSERT INTO `user` (`id`, `firstname`, `lastname`, `about`, `email`, `password`, `password_reset_token`, `image`, `last_login`, `last_logout`, `ip_address`, `status`, `is_admin`) VALUES ('3', 'Janie ', 'Doe', '', 'janie@example.com', '827ccb0eea8a706c4c34a16891f84e7b', '', './assets/img/user/f.png', '2017-05-22 13:00:35', '2017-05-22 13:01:02', '::1', '1', '0');
INSERT INTO `user` (`id`, `firstname`, `lastname`, `about`, `email`, `password`, `password_reset_token`, `image`, `last_login`, `last_logout`, `ip_address`, `status`, `is_admin`) VALUES ('6', 'Jane', 'Doe', '', 'jane@example.com', 'e10adc3949ba59abbe56e057f20f883e', '', './assets/img/user/f2.png', NULL, NULL, NULL, '1', '0');


#
# TABLE STRUCTURE FOR: variant
#

DROP TABLE IF EXISTS `variant`;

CREATE TABLE `variant` (
  `variantid` int(11) NOT NULL AUTO_INCREMENT,
  `menuid` int(11) NOT NULL,
  `variantName` varchar(120) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`variantid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `variant` (`variantid`, `menuid`, `variantName`, `price`) VALUES ('1', '1', '12 Inch', '150.00');
INSERT INTO `variant` (`variantid`, `menuid`, `variantName`, `price`) VALUES ('2', '1', '16 Inch', '200.00');
INSERT INTO `variant` (`variantid`, `menuid`, `variantName`, `price`) VALUES ('3', '2', '12 Inch', '200.00');
INSERT INTO `variant` (`variantid`, `menuid`, `variantName`, `price`) VALUES ('4', '3', '16 Inch', '700.00');
INSERT INTO `variant` (`variantid`, `menuid`, `variantName`, `price`) VALUES ('5', '4', '12 Inch', '550.00');
INSERT INTO `variant` (`variantid`, `menuid`, `variantName`, `price`) VALUES ('6', '5', 'sample', '80.00');
INSERT INTO `variant` (`variantid`, `menuid`, `variantName`, `price`) VALUES ('7', '5', 'sample', '80.00');
INSERT INTO `variant` (`variantid`, `menuid`, `variantName`, `price`) VALUES ('8', '6', 'sample', '140.00');


