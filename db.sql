/*
SQLyog Enterprise - MySQL GUI v6.5
MySQL - 5.0.45-community-nt : Database - aptsec_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

create database if not exists `aptsec_db`;

USE `aptsec_db`;

/*Table structure for table `agency_type` */

DROP TABLE IF EXISTS `agency_type`;

CREATE TABLE `agency_type` (
  `agency_type_id` int(11) NOT NULL auto_increment,
  `agency_type_name` varchar(200) default NULL,
  `agency_type_name_kh` varchar(200) default NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`agency_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `agency_type` */

insert  into `agency_type`(`agency_type_id`,`agency_type_name`,`agency_type_name_kh`,`is_deletable`) values (1,'Factory','រោងចត្រ',0),(2,'Industry','សហគ្រាស',0);

/*Table structure for table `application` */

DROP TABLE IF EXISTS `application`;

CREATE TABLE `application` (
  `application_id` int(11) NOT NULL,
  `application_code` varchar(100) default NULL,
  `application_name` varchar(200) default NULL,
  PRIMARY KEY  (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `application` */

insert  into `application`(`application_id`,`application_code`,`application_name`) values (1,'UserGroup','User Group'),(2,'UserType','UserType'),(3,'User','User');

/*Table structure for table `application_function` */

DROP TABLE IF EXISTS `application_function`;

CREATE TABLE `application_function` (
  `application_function_id` int(11) NOT NULL auto_increment,
  `application_id` int(11) default NULL,
  `function_id` int(11) default NULL,
  PRIMARY KEY  (`application_function_id`),
  UNIQUE KEY `application_function` (`application_id`,`function_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `application_function` */

insert  into `application_function`(`application_function_id`,`application_id`,`function_id`) values (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,2,1),(6,2,2),(7,2,3),(8,2,4),(9,3,1),(10,3,2),(11,3,3),(12,3,4);

/*Table structure for table `arrival_departure` */

DROP TABLE IF EXISTS `arrival_departure`;

CREATE TABLE `arrival_departure` (
  `arrival_departure_id` int(11) NOT NULL auto_increment,
  `document_ref` varchar(20) default NULL,
  `arrival_departure_date` date default NULL,
  `register_id` int(11) default NULL,
  `travel_method` varchar(200) default NULL,
  `from_location_id` int(11) default NULL,
  `to_location_id` int(11) default NULL,
  `visa_no` varchar(100) default NULL,
  `visa_issue_location_id` int(11) default NULL,
  `travel_purpose` varchar(200) default NULL,
  `length_of_stay` varchar(200) default NULL,
  `from_address` varchar(200) default NULL,
  `to_address` varchar(200) default NULL,
  `created_by` int(11) default NULL,
  `created_date` datetime default NULL,
  `modified_by` int(11) default NULL,
  `modified_date` datetime default NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`arrival_departure_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `arrival_departure` */

insert  into `arrival_departure`(`arrival_departure_id`,`document_ref`,`arrival_departure_date`,`register_id`,`travel_method`,`from_location_id`,`to_location_id`,`visa_no`,`visa_issue_location_id`,`travel_purpose`,`length_of_stay`,`from_address`,`to_address`,`created_by`,`created_date`,`modified_by`,`modified_date`,`is_deletable`) values (2,'','2016-05-16',57,'Bus',2,17,'1762556',3,'Work','2 years','from phnom penh\r\n','to thai\r\n',7,'2016-05-16 17:04:45',7,'2016-05-17 11:19:10',1),(3,'drf','2016-05-17',58,'dsfsd',4,3,'dsfs',2,'dsfs','sdfsd','fsdf','dds',7,'2016-05-17 15:55:39',7,'2016-05-17 15:55:39',1);

/*Table structure for table `border_crossing` */

DROP TABLE IF EXISTS `border_crossing`;

CREATE TABLE `border_crossing` (
  `border_crossing_id` int(11) NOT NULL auto_increment,
  `border_crossing_name` varchar(500) NOT NULL default '',
  `border_crossing_name_kh` varchar(500) NOT NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`border_crossing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `border_crossing` */

insert  into `border_crossing`(`border_crossing_id`,`border_crossing_name`,`border_crossing_name_kh`,`is_deletable`) values (1,'None','អត់មាន',0),(2,'PoiPet','ប៉ោយប៉ែត',1),(4,'new','new',1);

/*Table structure for table `cancel_type` */

DROP TABLE IF EXISTS `cancel_type`;

CREATE TABLE `cancel_type` (
  `cancel_type_id` int(11) NOT NULL auto_increment,
  `cancel_type_name` varchar(200) default NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`cancel_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `cancel_type` */

insert  into `cancel_type`(`cancel_type_id`,`cancel_type_name`,`is_deletable`) values (1,'Run away',1),(2,'Medical checkup fail',1),(3,'Bad manner',1),(7,'Other',1);

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL default '0',
  `data` blob NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ci_sessions` */

/*Table structure for table `contact` */

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL auto_increment,
  `contact_code` varchar(50) character set utf8 default NULL,
  `contact_name` varchar(200) character set utf8 default NULL,
  `contact_name_kh` varchar(200) character set utf8 default NULL,
  `phone_number` varchar(200) character set utf8 default NULL,
  `phone_number_2` varchar(200) character set utf8 default NULL,
  `email` varchar(200) character set utf8 default NULL,
  `website` varchar(200) character set utf8 default NULL,
  `photo` text character set utf8,
  `contact_type` varchar(50) character set utf8 NOT NULL default '',
  `nationality_id` int(11) default NULL,
  `first_name` varchar(100) character set utf8 default NULL,
  `last_name` varchar(100) character set utf8 default NULL,
  `first_name_kh` varchar(100) character set utf8 default NULL,
  `last_name_kh` varchar(100) character set utf8 default NULL,
  `nick_name` varchar(100) character set utf8 default NULL,
  `gender` char(1) character set utf8 default NULL,
  `date_of_birth` date default NULL,
  `father_name` varchar(200) character set utf8 default NULL,
  `father_name_kh` varchar(200) character set utf8 default NULL,
  `father_job` varchar(200) character set utf8 default NULL,
  `father_age` int(11) default NULL,
  `mother_name` varchar(200) character set utf8 default NULL,
  `mother_name_kh` varchar(200) character set utf8 default NULL,
  `mother_job` varchar(200) character set utf8 default NULL,
  `mother_age` int(11) default NULL,
  `family_phone` varchar(200) character set utf8 default NULL,
  `family_phone_2` varchar(200) character set utf8 default NULL,
  `marital_status` varchar(20) character set utf8 default NULL COMMENT 'Single, Married, Seperated, Widow',
  `spouse_name` varchar(200) character set utf8 default NULL,
  `spouse_name_kh` varchar(200) character set utf8 default NULL,
  `spouse_job` varchar(200) character set utf8 default NULL,
  `spouse_age` int(11) default NULL,
  `height` varchar(50) character set utf8 default NULL,
  `weight` varchar(50) character set utf8 default NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  `created_date` datetime default NULL,
  `recruitment_fee_rate` float NOT NULL default '0',
  `is_fixed_rate` tinyint(1) NOT NULL default '0',
  `number_of_brother` int(11) default NULL,
  `number_of_sister` int(11) default NULL,
  `sibling_order` int(11) default NULL,
  `number_of_children` int(11) default NULL,
  `oldest_age` int(11) default NULL,
  `youngest_age` int(11) default NULL,
  `agency_type_id` int(11) default NULL,
  `created_by` int(11) default NULL,
  `modified_by` int(11) default NULL,
  `modified_date` datetime default NULL,
  PRIMARY KEY  (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=239 DEFAULT CHARSET=latin1;

/*Data for the table `contact` */

insert  into `contact`(`contact_id`,`contact_code`,`contact_name`,`contact_name_kh`,`phone_number`,`phone_number_2`,`email`,`website`,`photo`,`contact_type`,`nationality_id`,`first_name`,`last_name`,`first_name_kh`,`last_name_kh`,`nick_name`,`gender`,`date_of_birth`,`father_name`,`father_name_kh`,`father_job`,`father_age`,`mother_name`,`mother_name_kh`,`mother_job`,`mother_age`,`family_phone`,`family_phone_2`,`marital_status`,`spouse_name`,`spouse_name_kh`,`spouse_job`,`spouse_age`,`height`,`weight`,`is_deletable`,`created_date`,`recruitment_fee_rate`,`is_fixed_rate`,`number_of_brother`,`number_of_sister`,`sibling_order`,`number_of_children`,`oldest_age`,`youngest_age`,`agency_type_id`,`created_by`,`modified_by`,`modified_date`) values (1,'AP','APTSE&C Cambodian Resources Co, Ltd.','អេភីធីអេសអ៊ីស៊ី ខេមបូឌារីសស ខូអ៊ីលធីឌី','092546556','','','www.aptsec.com','AP.png','Company',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'0','0',0,'2016-04-03 00:00:00',0,0,0,0,0,0,0,0,NULL,7,7,'2016-05-17 11:54:49'),(17,'REC-00001','Office Recruiter','បុគ្គលិកអ្នករកពលករ','០៩៣៤៤៥៤៣៦៣','','',NULL,'','Recruiter',NULL,NULL,NULL,NULL,NULL,NULL,'M','1988-08-10',NULL,NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,'Single',NULL,NULL,NULL,0,'0','0',1,'2016-04-04 08:43:11',40,1,0,0,0,0,0,0,NULL,7,7,NULL),(18,'AGE-00001','Agency Malaysia','Agency Malaysia','099877600','sdfds','dsfds','dsfds','','Agency',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'0','0',1,'2016-04-04 23:39:01',0,0,0,0,0,0,0,0,1,7,7,NULL),(19,'AGE-00002','Agency Thia','Agency Thia','099776640','','dsfsdf','','','Agency',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'0','0',1,'2016-04-04 23:42:42',0,0,0,0,0,0,0,0,2,7,7,NULL),(221,'REG-00001','Chan Doo','ចាន់ឌូ','0998776654','',NULL,NULL,'','Register',1,'Doo','Chan','ឌូ','ចាន់','DooDoo','M','1989-02-14','','','',0,'','','',0,'','','Single','','','',0,'0','0',1,'2016-04-20 15:47:42',0,0,0,0,0,0,0,0,NULL,7,7,NULL),(223,'REG-00003','Boom Boo','ប៊ូម ប៊ូ','099876665','',NULL,NULL,'','Register',1,'Boo','Boom','ប៊ូ','Boom','','M','2016-04-05','','','',0,'','','',0,'','','Single','','','',0,'0','0',1,'2016-04-22 11:03:29',0,0,0,0,0,0,0,0,NULL,7,7,NULL),(230,'REG-00004','sdfdsf','dsfdsf','5t435435sdf','',NULL,NULL,'','Register',1,'fdsfsd','dsfsd','dsfsd','fdsfds','fdsfsd','F','2016-04-05','','','',0,'','','',0,'','','Married','','','',0,'0','0',1,'2016-04-24 16:02:47',0,0,0,0,0,0,0,0,NULL,7,7,'2016-05-17 11:53:42'),(231,'REG-00006','dfsdfsdf','sdfdsfds','dsfdsfsdfsdfsd','',NULL,NULL,'','Register',1,'sdfds','dsfdsfsdfds','dfdsfsd','sdfsdfds','','F','2016-04-12','','','',0,'','','',0,'','','Married','','','',0,'0','0',1,'2016-04-24 16:08:54',0,0,0,0,0,0,0,0,NULL,7,7,NULL),(232,'REG-00008','sadsad','dsfdsa','wq4324324','',NULL,NULL,'','Register',1,'sadsadas','sdfdsfsdfsd','dasdsa','ddadas','dasdas','F','2016-04-11','','','',0,'','','',0,'','','Single','','','',0,'0','0',1,'2016-04-24 16:10:29',0,0,0,0,0,0,0,0,NULL,7,7,NULL),(235,'REG-00011','dsfsd','sdfds','dsfsdftrdt','',NULL,NULL,'','Register',1,'sdfds','dsfsd','sdfsd','sdfds','','F','2016-04-24','','','',0,'','','',0,'','','Single','','','',0,'0','0',1,'2016-04-24 16:29:56',0,0,0,0,0,0,0,0,NULL,7,7,NULL),(236,'REG-00012','sfdsf','sdfdsf','435345345345345','',NULL,NULL,'','Register',1,'dfdsf','dsfsdf','dsfsdf','dsfdsf','','F','2016-04-12','','','',0,'','','',0,'','','Single','','','',0,'0','0',1,'2016-04-25 08:39:44',0,0,0,0,0,0,0,0,NULL,7,7,NULL),(237,'REG-00013','sdfs','dsfsd','t543543534534','',NULL,NULL,'','Register',1,'dsfds','dsfsd','dsfds','dsfsd','dsfsd','F','2016-04-05','','','',0,'','','',0,'','','Married','','','',0,'0','0',1,'2016-04-30 06:31:49',0,0,0,0,0,0,0,0,NULL,7,7,NULL),(238,'AGE-00003','sdfsddsfs','dsfsd','dsfsd235346456','','boralim53@yahoo.com','','','Agency',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'0','0',1,'2016-05-17 11:49:55',0,0,0,0,0,0,0,0,1,7,7,'2016-05-17 11:52:01');

/*Table structure for table `contact_address` */

DROP TABLE IF EXISTS `contact_address`;

CREATE TABLE `contact_address` (
  `address_id` int(11) NOT NULL auto_increment,
  `contact_id` int(11) default NULL,
  `address` text character set utf8,
  `address_key` varchar(100) character set utf8 NOT NULL default 'contact' COMMENT 'contact, pob, parent_address',
  `country_id` int(11) default NULL,
  `province_city_id` int(11) default NULL,
  `district_khan_id` int(11) default NULL,
  `commune_sangkat_id` int(11) default NULL,
  `village_id` int(11) default NULL,
  `location_id` int(11) default NULL,
  `house_no` varchar(50) character set utf8 default NULL,
  `street_no` varchar(50) character set utf8 default NULL,
  `late` float NOT NULL default '0',
  `long` float NOT NULL default '0',
  PRIMARY KEY  (`address_id`),
  UNIQUE KEY `address_key_index` (`contact_id`,`address_key`),
  CONSTRAINT `FK_contact_address` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=555 DEFAULT CHARSET=latin1;

/*Data for the table `contact_address` */

insert  into `contact_address`(`address_id`,`contact_id`,`address`,`address_key`,`country_id`,`province_city_id`,`district_khan_id`,`commune_sangkat_id`,`village_id`,`location_id`,`house_no`,`street_no`,`late`,`long`) values (1,1,'','contact',2,11,12,13,14,NULL,'','',0,0),(11,17,'','contact',2,4,NULL,NULL,NULL,NULL,'','',0,0),(13,18,'','contact',2,3,NULL,NULL,NULL,NULL,'','',0,0),(14,19,'sdflsdj, sdflsjlsdk,ds fsdlfjsd, dsflsdkjflds,ds fsd,dsfsdf','contact',2,3,NULL,NULL,NULL,NULL,'','',0,0),(503,221,'','contact',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(504,221,'','pob',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(505,221,'','parent_address',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(509,223,'','contact',2,3,NULL,NULL,NULL,NULL,'','',0,0),(510,223,'','pob',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(511,223,'','parent_address',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(530,230,'','contact',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(531,230,'','pob',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(532,230,'','parent_address',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(533,231,'','contact',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(534,231,'','pob',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(535,231,'','parent_address',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(536,232,'','contact',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(537,232,'','pob',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(538,232,'','parent_address',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(545,235,'','contact',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(546,235,'','pob',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(547,235,'','parent_address',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(548,236,'','contact',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(549,236,'','pob',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(550,236,'','parent_address',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(551,237,'','contact',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(552,237,'','pob',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(553,237,'','parent_address',2,NULL,NULL,NULL,NULL,NULL,'','',0,0),(554,238,'','contact',2,3,NULL,NULL,NULL,NULL,'','',0,0);

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL auto_increment,
  `department_name` varchar(200) default NULL,
  `parent_department_id` int(11) default NULL,
  PRIMARY KEY  (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `department` */

/*Table structure for table `document_type` */

DROP TABLE IF EXISTS `document_type`;

CREATE TABLE `document_type` (
  `document_type_id` int(11) NOT NULL auto_increment,
  `document_type_name` varchar(500) character set utf8 default NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`document_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `document_type` */

insert  into `document_type`(`document_type_id`,`document_type_name`,`is_deletable`) values (1,'None',0),(2,'BIO Data',1);

/*Table structure for table `employee_hired` */

DROP TABLE IF EXISTS `employee_hired`;

CREATE TABLE `employee_hired` (
  `employee_hired_id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `position_id` int(11) default NULL,
  `department_id` int(11) default NULL,
  `hired_date` date default NULL,
  `salary` decimal(10,0) default NULL,
  `resigned_or_promoted` tinyint(1) default NULL,
  `resigned_or_promoted_date` date default NULL,
  `description` text,
  PRIMARY KEY  (`employee_hired_id`),
  KEY `FK_employee_hired_department` (`department_id`),
  KEY `FK_employee_hired_position` (`position_id`),
  KEY `FK_employee_hired_contact` (`employee_id`),
  CONSTRAINT `FK_employee_hired_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  CONSTRAINT `FK_employee_hired_position` FOREIGN KEY (`position_id`) REFERENCES `position` (`contact_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `employee_hired` */

/*Table structure for table `function` */

DROP TABLE IF EXISTS `function`;

CREATE TABLE `function` (
  `function_id` int(11) NOT NULL,
  `function_name` varchar(200) default NULL,
  PRIMARY KEY  (`function_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `function` */

insert  into `function`(`function_id`,`function_name`) values (1,'View'),(2,'Create'),(3,'Edit'),(4,'Delete'),(5,'Print'),(6,'PDF'),(7,'Excel');

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL auto_increment,
  `location_name` varchar(200) character set utf8 default NULL,
  `location_name_kh` varchar(200) character set utf8 default NULL,
  `location_code` varchar(200) character set utf8 default NULL,
  `parent_location_id` int(11) default NULL,
  `location_type_id` int(11) default NULL,
  `Late` decimal(10,0) default NULL,
  `long` decimal(10,0) default NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`location_id`,`is_deletable`),
  UNIQUE KEY `location_index` (`location_name`,`parent_location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `location` */

insert  into `location`(`location_id`,`location_name`,`location_name_kh`,`location_code`,`parent_location_id`,`location_type_id`,`Late`,`long`,`is_deletable`) values (1,'None','អត់មាន','',1,9,'0','0',0),(2,'Cambodia','កម្ពុជា','',1,1,'0','0',0),(3,'Phnom Penh','ភ្នំពេញ','',2,3,'0','0',1),(4,'Kampong Cham','កំពង់ចាម','',2,2,'0','0',1),(5,'Kampong Tom','កំពង់ធំ','',2,2,'0','0',1),(6,'Siem Reap','សៀមរាប','',2,2,'0','0',1),(7,'Por Sat','ពោធិ៍សាធ','',2,2,'0','0',1),(8,'Battam Bong','បាត់ដំបង់','',2,2,'0','0',1),(9,'Banteay Mean Chey','បន្ទាយមានជ័យ','',2,2,'0','0',1),(10,'Oudor Mean Chey','ឧត្ដមានជ័យ','',2,2,'0','0',1),(11,'Tbong Khmom','ត្បួងឃ្មុំ','',2,2,'0','0',1),(12,'Tbong Khmom','ត្បូងឃ្មុំ','',11,4,'0','0',1),(13,'Chikor','ជីគរ','',12,6,'0','0',1),(14,'Sammarky','សាមគ្គី','',13,8,'0','0',1),(15,'Kandal','កណ្ដាល','',2,2,'0','0',1),(16,'Saang','ស្អាង','',15,4,'0','0',1),(17,'Thailand','ថៃ','',1,1,'0','0',1),(18,'Khnach Krosang','ខ្នាច់ក្រសាំង','',13,8,'0','0',1),(19,'Takeo','តាកែវ','',2,2,'0','0',1),(20,'Muong Riev','ម៉ុងរៀវ','',12,7,'0','0',1),(21,'USA','USA','',1,1,'0','0',1),(22,'Malaysia','Malaysia','',1,1,'0','0',1);

/*Table structure for table `location_type` */

DROP TABLE IF EXISTS `location_type`;

CREATE TABLE `location_type` (
  `location_type_id` int(11) NOT NULL auto_increment,
  `location_type_name` varchar(200) default NULL,
  PRIMARY KEY  (`location_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `location_type` */

insert  into `location_type`(`location_type_id`,`location_type_name`) values (1,'Country'),(2,'Province'),(3,'City'),(4,'District'),(5,'Khan'),(6,'Commune'),(7,'Sang Kat'),(8,'Village'),(9,'Location');

/*Table structure for table `nationality` */

DROP TABLE IF EXISTS `nationality`;

CREATE TABLE `nationality` (
  `nationality_id` int(11) NOT NULL auto_increment,
  `nationality_name` varchar(200) character set utf8 default NULL,
  `nationality_name_kh` varchar(200) character set utf8 default NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`nationality_id`,`is_deletable`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `nationality` */

insert  into `nationality`(`nationality_id`,`nationality_name`,`nationality_name_kh`,`is_deletable`) values (1,'Khmer','ខ្មែរ',0),(2,'Thai','ថៃ',1);

/*Table structure for table `permission` */

DROP TABLE IF EXISTS `permission`;

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL auto_increment,
  `user_group_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  PRIMARY KEY  (`permission_id`),
  UNIQUE KEY `permission_index` (`user_group_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `permission` */

insert  into `permission`(`permission_id`,`user_group_id`,`user_id`) values (9,1,1),(16,1,6),(17,1,7),(18,1,8),(7,2,2),(10,2,3),(11,2,4),(13,2,5);

/*Table structure for table `position` */

DROP TABLE IF EXISTS `position`;

CREATE TABLE `position` (
  `contact_type_id` int(11) NOT NULL auto_increment,
  `contact_type_name` varchar(200) default NULL,
  PRIMARY KEY  (`contact_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `position` */

/*Table structure for table `register` */

DROP TABLE IF EXISTS `register`;

CREATE TABLE `register` (
  `worker_id` int(11) NOT NULL auto_increment,
  `register_date` date default NULL,
  `worker_code` varchar(50) character set utf8 default NULL,
  `recruiter_id` int(11) default NULL,
  `contact_id` int(11) default NULL COMMENT 'contact info',
  `company_id` int(11) default NULL,
  `to_country_id` int(11) default NULL,
  `service_type_id` int(11) default NULL,
  `worker_type_id` int(11) default NULL,
  `agency_id` int(11) default NULL,
  `passport_no` varchar(50) character set utf8 default NULL,
  `passport_issue_date` date default NULL,
  `passport_expired_date` date default NULL,
  `id_card_no` varchar(50) character set utf8 default NULL,
  `id_card_issue_date` date default NULL,
  `id_card_expired_date` date default NULL,
  `date_of_send_document` date default NULL,
  `document_type_id` int(11) default NULL,
  `date_of_send_bio_scan` date default NULL,
  `date_of_send_medical_checkup_sd` date default NULL,
  `date_of_receive_passport` date default NULL,
  `date_of_send_ppc_sd` date default NULL,
  `date_of_mofa` date default NULL COMMENT 'MOFA = ministry of foreign affaire',
  `date_of_employer` date default NULL,
  `employer_name` varchar(200) character set utf8 default NULL,
  `employer_address` text character set utf8,
  `employer_address_2` text character set utf8,
  `employer_address_3` text character set utf8,
  `employer_address_4` text character set utf8,
  `employer_address_5` text character set utf8,
  `employer_nirc` varchar(50) character set utf8 default NULL,
  `employer_phone` varchar(200) character set utf8 default NULL,
  `employer_phone_2` varchar(200) character set utf8 default NULL,
  `date_of_visa_rd_confirm` date default NULL,
  `date_of_visa_rd_receive` date default NULL,
  `date_of_buy_air_ticket` date default NULL,
  `date_of_fly` date default NULL,
  `Note` text character set utf8,
  `border_crossing_id` int(11) NOT NULL default '1',
  `is_cancel` tinyint(1) NOT NULL default '0',
  `canceled_date` date default NULL,
  `cancel_type_id` int(11) default NULL,
  `canceled_reason` text character set utf8,
  `created_date` datetime default NULL,
  PRIMARY KEY  (`worker_id`),
  KEY `FK_register` (`contact_id`),
  CONSTRAINT `FK_register` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

/*Data for the table `register` */

insert  into `register`(`worker_id`,`register_date`,`worker_code`,`recruiter_id`,`contact_id`,`company_id`,`to_country_id`,`service_type_id`,`worker_type_id`,`agency_id`,`passport_no`,`passport_issue_date`,`passport_expired_date`,`id_card_no`,`id_card_issue_date`,`id_card_expired_date`,`date_of_send_document`,`document_type_id`,`date_of_send_bio_scan`,`date_of_send_medical_checkup_sd`,`date_of_receive_passport`,`date_of_send_ppc_sd`,`date_of_mofa`,`date_of_employer`,`employer_name`,`employer_address`,`employer_address_2`,`employer_address_3`,`employer_address_4`,`employer_address_5`,`employer_nirc`,`employer_phone`,`employer_phone_2`,`date_of_visa_rd_confirm`,`date_of_visa_rd_receive`,`date_of_buy_air_ticket`,`date_of_fly`,`Note`,`border_crossing_id`,`is_cancel`,`canceled_date`,`cancel_type_id`,`canceled_reason`,`created_date`) values (57,'2016-04-20','AP-CSW1604-0001',17,221,1,2,1,1,18,'N1762556',NULL,NULL,'',NULL,NULL,'2016-03-28',2,'2016-04-05','2016-04-12','2016-04-13','2016-04-21',NULL,NULL,'','','','','','','','','',NULL,NULL,NULL,'2016-04-26','',1,0,NULL,NULL,'','2016-04-20 15:47:42'),(58,'2016-04-22','AP-CSW1604-0002',17,223,1,2,1,1,NULL,'',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','',NULL,NULL,NULL,'2015-01-01','',1,0,NULL,NULL,'','2016-04-22 11:03:29'),(64,'2016-04-24','AP-CSW1604-0003',17,230,1,2,1,1,NULL,'',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','',NULL,NULL,NULL,NULL,'',1,0,NULL,NULL,'','2016-04-24 16:02:47'),(65,'2016-04-24','AP-CSW1604-0004',17,231,1,2,1,1,NULL,'',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','',NULL,NULL,NULL,'2016-01-04','',1,0,NULL,NULL,'','2016-04-24 16:08:54'),(66,'2016-04-24','AP-CSM1604-0001',17,232,1,2,2,1,NULL,'',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','',NULL,NULL,NULL,'2016-03-08','',1,0,NULL,NULL,'','2016-04-24 16:10:29'),(68,'2016-04-24','AP-CSW1604-0006',17,235,1,2,1,1,NULL,'',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','',NULL,NULL,NULL,NULL,'',1,0,NULL,NULL,'','2016-04-24 16:29:56'),(69,'2016-03-23','AP-CSM1604-0002',17,236,1,2,2,1,NULL,'',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','',NULL,NULL,NULL,NULL,'',1,0,NULL,NULL,'','2016-04-25 08:39:44'),(70,'2016-04-30','AP-CSW1604-0007',17,237,1,2,1,1,NULL,'',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','',NULL,NULL,NULL,NULL,'',1,0,NULL,NULL,'','2016-04-30 06:31:49');

/*Table structure for table `register_type` */

DROP TABLE IF EXISTS `register_type`;

CREATE TABLE `register_type` (
  `register_type_id` int(11) NOT NULL auto_increment,
  `register_type_name` varchar(200) character set utf8 default NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`register_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `register_type` */

insert  into `register_type`(`register_type_id`,`register_type_name`,`is_deletable`) values (1,'Worker',0),(2,'Ex-Maid',0),(3,'Fresh',0);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL auto_increment,
  `application_function_id` int(11) default NULL,
  `user_group_id` int(11) default NULL,
  PRIMARY KEY  (`role_id`),
  UNIQUE KEY `role_index` (`application_function_id`,`user_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `role` */

/*Table structure for table `service_type` */

DROP TABLE IF EXISTS `service_type`;

CREATE TABLE `service_type` (
  `service_type_id` int(11) NOT NULL auto_increment,
  `service_type_code` varchar(20) character set utf8 default NULL,
  `service_type_name` varchar(200) character set utf8 default NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`service_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `service_type` */

insert  into `service_type`(`service_type_id`,`service_type_code`,`service_type_name`,`is_deletable`) values (1,'CSW','Cleaning Service Worker',0),(2,'CSM','Cleaning Service Maid',1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_name` varchar(200) default NULL,
  `email` varchar(200) default NULL,
  `password` varchar(200) default NULL,
  `contact_id` int(11) default NULL,
  `image` varchar(200) default NULL,
  `user_type_id` int(11) NOT NULL,
  `is_hidden` tinyint(1) NOT NULL default '0',
  `is_deletable` tinyint(1) NOT NULL default '1',
  `is_editable` tinyint(1) NOT NULL default '1',
  `is_active` tinyint(1) NOT NULL default '0',
  `created_date` datetime default NULL,
  PRIMARY KEY  (`user_id`),
  KEY `FK_user` (`user_type_id`),
  CONSTRAINT `FK_user` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`user_id`,`user_name`,`email`,`password`,`contact_id`,`image`,`user_type_id`,`is_hidden`,`is_deletable`,`is_editable`,`is_active`,`created_date`) values (7,'admin','boralim2011@gmail.com','386943a05043bbd2a1cc119b6d883e2f61dc1aec',NULL,'',1,1,0,1,1,'2016-04-27 15:05:08'),(8,'bora','boralim53@yahoo.com','e6481b6f7e8c3b6f0f0e4b4135d5e3cf7a05591f',NULL,'',1,0,1,1,1,'2016-04-27 15:06:49');

/*Table structure for table `user_group` */

DROP TABLE IF EXISTS `user_group`;

CREATE TABLE `user_group` (
  `user_group_id` int(11) NOT NULL auto_increment,
  `user_group_name` varchar(200) default NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`user_group_id`,`is_deletable`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_group` */

insert  into `user_group`(`user_group_id`,`user_group_name`,`is_deletable`) values (1,'Administrators',1),(2,'Accounting Users',1);

/*Table structure for table `user_type` */

DROP TABLE IF EXISTS `user_type`;

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL auto_increment,
  `user_type_name` varchar(200) default NULL,
  `is_deletable` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`user_type_id`,`is_deletable`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_type` */

insert  into `user_type`(`user_type_id`,`user_type_name`,`is_deletable`) values (1,'Administrators',0),(2,'Power Users',1),(3,'Accounting Users',1),(4,'HR/Admin Users',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
