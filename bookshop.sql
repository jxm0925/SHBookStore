-- MySQL dump 10.13  Distrib 5.7.11, for Win32 (AMD64)
--
-- Host: localhost    Database: bookshop
-- ------------------------------------------------------
-- Server version	5.7.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `shop_access`
--

DROP TABLE IF EXISTS `shop_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_access` (
  `access_id` int(11) NOT NULL AUTO_INCREMENT,
  `access_name` varchar(20) NOT NULL,
  `access_title` varchar(20) NOT NULL,
  `access_urls` varchar(100) NOT NULL,
  `access_status` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_access`
--

LOCK TABLES `shop_access` WRITE;
/*!40000 ALTER TABLE `shop_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_address`
--

DROP TABLE IF EXISTS `shop_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_address`
--

LOCK TABLES `shop_address` WRITE;
/*!40000 ALTER TABLE `shop_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_admin`
--

DROP TABLE IF EXISTS `shop_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(20) NOT NULL,
  `admin_pwd` varchar(32) NOT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_status` int(11) NOT NULL,
  `update_time` int(13) NOT NULL,
  `create_time` int(13) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_admin`
--

LOCK TABLES `shop_admin` WRITE;
/*!40000 ALTER TABLE `shop_admin` DISABLE KEYS */;
INSERT INTO `shop_admin` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e',NULL,1,123,1123),(2,'test','e10adc3949ba59abbe56e057f20f883e',NULL,1,123,123);
/*!40000 ALTER TABLE `shop_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_admintorole`
--

DROP TABLE IF EXISTS `shop_admintorole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_admintorole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_admintorole`
--

LOCK TABLES `shop_admintorole` WRITE;
/*!40000 ALTER TABLE `shop_admintorole` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_admintorole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_adv`
--

DROP TABLE IF EXISTS `shop_adv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_adv` (
  `adv_id` int(11) NOT NULL AUTO_INCREMENT,
  `adv_width` int(11) DEFAULT NULL,
  `adv_height` int(11) DEFAULT NULL,
  `adv_link` varchar(50) NOT NULL,
  `adv_status` smallint(6) NOT NULL DEFAULT '1',
  `adv_path` varchar(50) NOT NULL,
  `adv_sort` smallint(6) NOT NULL DEFAULT '0',
  `create_time` int(13) NOT NULL,
  `update_time` int(13) NOT NULL,
  `delete_time` int(13) DEFAULT NULL,
  PRIMARY KEY (`adv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_adv`
--

LOCK TABLES `shop_adv` WRITE;
/*!40000 ALTER TABLE `shop_adv` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_adv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_car`
--

DROP TABLE IF EXISTS `shop_car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_car` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `mount` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `create_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_car`
--

LOCK TABLES `shop_car` WRITE;
/*!40000 ALTER TABLE `shop_car` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_collect`
--

DROP TABLE IF EXISTS `shop_collect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_collect` (
  `collect_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `create_time` int(13) NOT NULL,
  `delete_time` int(13) DEFAULT NULL,
  PRIMARY KEY (`collect_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_collect`
--

LOCK TABLES `shop_collect` WRITE;
/*!40000 ALTER TABLE `shop_collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_collect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_comment`
--

DROP TABLE IF EXISTS `shop_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(300) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_comment`
--

LOCK TABLES `shop_comment` WRITE;
/*!40000 ALTER TABLE `shop_comment` DISABLE KEYS */;
INSERT INTO `shop_comment` VALUES (1,1,2,'太棒了',1508932063,1508983589,NULL),(2,2,2,'也很好看',1408931955,1508983564,NULL),(3,2,2,'123',1231231231,1508983557,NULL),(4,1,1,'123',1123123,1508983508,NULL);
/*!40000 ALTER TABLE `shop_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_dispose`
--

DROP TABLE IF EXISTS `shop_dispose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_dispose` (
  `dis_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `dis_express` varchar(50) NOT NULL COMMENT '快递单号',
  `dis_number` varchar(20) NOT NULL COMMENT '快递名称',
  `create_time` int(13) NOT NULL,
  `update_time` int(13) NOT NULL,
  `delete_time` int(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_dispose`
--

LOCK TABLES `shop_dispose` WRITE;
/*!40000 ALTER TABLE `shop_dispose` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_dispose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_fund`
--

DROP TABLE IF EXISTS `shop_fund`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_fund` (
  `fund_id` int(11) NOT NULL AUTO_INCREMENT,
  `fund_count` int(11) NOT NULL,
  `create_time` int(13) NOT NULL,
  `update_time` int(13) NOT NULL,
  PRIMARY KEY (`fund_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_fund`
--

LOCK TABLES `shop_fund` WRITE;
/*!40000 ALTER TABLE `shop_fund` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_fund` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_good`
--

DROP TABLE IF EXISTS `shop_good`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_good` (
  `good_id` int(11) NOT NULL AUTO_INCREMENT,
  `good_name` varchar(100) NOT NULL,
  `good_author` varchar(50) DEFAULT NULL,
  `good_product` varchar(100) DEFAULT NULL,
  `good_time` int(13) NOT NULL,
  `good_type` int(11) NOT NULL,
  `good_pic` varchar(100) NOT NULL,
  `good_count` int(11) NOT NULL DEFAULT '0',
  `good_price` decimal(10,0) NOT NULL,
  `good_realprice` decimal(10,0) NOT NULL,
  `good_showprice` decimal(10,0) NOT NULL,
  `good_sold` int(11) NOT NULL DEFAULT '0' COMMENT '卖了多少',
  `good_status` smallint(6) NOT NULL DEFAULT '1',
  `good_details` varchar(50) DEFAULT NULL,
  `start_time` int(13) DEFAULT NULL,
  `end_time` int(13) DEFAULT NULL,
  `create_time` int(13) NOT NULL,
  `update_time` int(13) NOT NULL,
  `delete_time` int(13) DEFAULT NULL,
  PRIMARY KEY (`good_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_good`
--

LOCK TABLES `shop_good` WRITE;
/*!40000 ALTER TABLE `shop_good` DISABLE KEYS */;
INSERT INTO `shop_good` VALUES (1,'从你的全世界路过','张嘉佳','我',123123,1,'123',0,123,123,123,123,123,NULL,123123,123123,123123,123123,NULL),(2,'阿弥陀佛么么哒','自行车','自行车持续性',123,1,'123',12,123,123,123,1231,1,NULL,123,1321,123,123123,NULL),(3,'千万','1223','123',1508981641,3,'20171027/1ecfac53e3f64b16c00d9d148b714060.jpg',12,26,23,24,0,1,'',0,0,1509068222,1509068222,NULL),(4,'周星驰','321','123',1508307855,22,'20171028/76e81bdcb471b6e669af90c0332645c1.jpg',111,29,23,24,0,1,'',0,0,1509171913,1509171913,NULL),(5,'从你的全世界路过','张嘉佳','湖南文艺出版社',1383235200,26,'20171028/450aeb6ce9967928fe094556cd2dcf6c.jpg',132,36,20,30,0,1,'',0,0,1509177204,1509177204,NULL),(6,'活着','余华','作家出版社',1285948800,26,'20171028/066a98e7d8b399f7216ab8c20e515ddb.jpg',100,40,30,38,0,1,'',0,0,1509177554,1509177554,NULL),(7,'此刻花开','徐静','百花洲文艺出版社',1480608000,22,'20171028/c92b436f032f09604f347f0f94e949fa.png',50,68,40,60,0,1,'',1510739535,0,1509184376,1509184376,NULL);
/*!40000 ALTER TABLE `shop_good` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_history`
--

DROP TABLE IF EXISTS `shop_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_history`
--

LOCK TABLES `shop_history` WRITE;
/*!40000 ALTER TABLE `shop_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_notice`
--

DROP TABLE IF EXISTS `shop_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_notice` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_name` varchar(30) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `notice` text NOT NULL,
  `create_time` int(13) NOT NULL,
  `update_time` int(13) NOT NULL,
  `delete_time` int(13) DEFAULT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_notice`
--

LOCK TABLES `shop_notice` WRITE;
/*!40000 ALTER TABLE `shop_notice` DISABLE KEYS */;
INSERT INTO `shop_notice` VALUES (1,'拾忆书城今天开站啦！！！',1,'欢迎大家前来选购图书',1508911636,1509068804,NULL),(2,'测试公告',1,'测试公告',1508912775,1509068892,NULL),(3,'123323',1,'1232323',1508916664,1509068837,NULL);
/*!40000 ALTER TABLE `shop_notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_order`
--

DROP TABLE IF EXISTS `shop_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_num` varchar(20) DEFAULT NULL,
  `order_price` decimal(10,0) NOT NULL,
  `good_id` int(11) NOT NULL,
  `order_discount` float NOT NULL,
  `order_status` smallint(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_time` int(13) NOT NULL,
  `update_time` int(13) NOT NULL,
  `delete_time` int(13) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_order`
--

LOCK TABLES `shop_order` WRITE;
/*!40000 ALTER TABLE `shop_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_picture`
--

DROP TABLE IF EXISTS `shop_picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_picture` (
  `pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_name` varchar(50) NOT NULL,
  `pic_path` varchar(200) DEFAULT NULL,
  `pic_status` smallint(6) NOT NULL DEFAULT '1',
  `pic_forum` smallint(6) NOT NULL COMMENT '所属版块',
  `pic_sort` smallint(6) NOT NULL DEFAULT '0',
  `create_time` int(13) NOT NULL,
  `update_time` int(13) NOT NULL,
  `delete_time` int(13) DEFAULT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_picture`
--

LOCK TABLES `shop_picture` WRITE;
/*!40000 ALTER TABLE `shop_picture` DISABLE KEYS */;
INSERT INTO `shop_picture` VALUES (1,'少儿同属','20171028/afc5432c1103690c5df93796b9201378.jpg',1,8,1,1509172390,1509172390,NULL);
/*!40000 ALTER TABLE `shop_picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_refund`
--

DROP TABLE IF EXISTS `shop_refund`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_refund` (
  `refund_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单编号',
  `user_id` int(11) NOT NULL COMMENT '退款用户编号',
  `good_id` int(11) NOT NULL COMMENT '退款物品编号',
  `refund_details` varchar(200) DEFAULT NULL COMMENT '退款说明',
  `refund_money` decimal(10,0) NOT NULL,
  `refund_status` smallint(6) NOT NULL DEFAULT '0',
  `refund_amount` int(11) NOT NULL,
  `create_time` int(13) NOT NULL,
  `update_time` int(13) NOT NULL,
  `delete_time` int(13) DEFAULT NULL,
  PRIMARY KEY (`refund_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_refund`
--

LOCK TABLES `shop_refund` WRITE;
/*!40000 ALTER TABLE `shop_refund` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_refund` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_role`
--

DROP TABLE IF EXISTS `shop_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL,
  `role_status` int(11) NOT NULL,
  `create_time` int(13) NOT NULL,
  `update_time` int(13) NOT NULL,
  `delete_time` int(13) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_role`
--

LOCK TABLES `shop_role` WRITE;
/*!40000 ALTER TABLE `shop_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_roletoaccess`
--

DROP TABLE IF EXISTS `shop_roletoaccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_roletoaccess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `access_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_roletoaccess`
--

LOCK TABLES `shop_roletoaccess` WRITE;
/*!40000 ALTER TABLE `shop_roletoaccess` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_roletoaccess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_type`
--

DROP TABLE IF EXISTS `shop_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_pid` int(11) NOT NULL,
  `type_name` varchar(20) NOT NULL,
  `type_path` varchar(100) NOT NULL,
  `type_level` int(11) NOT NULL,
  `type_explain` varchar(100) DEFAULT NULL,
  `create_time` int(13) NOT NULL,
  `update_time` int(13) DEFAULT NULL,
  `delete_time` int(13) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_type`
--

LOCK TABLES `shop_type` WRITE;
/*!40000 ALTER TABLE `shop_type` DISABLE KEYS */;
INSERT INTO `shop_type` VALUES (1,0,'哲学','0-1',1,'123',1509067363,1509095440,1509095440),(2,0,'文学艺术','0-2',1,'文学艺术',1509067719,1509067719,NULL),(3,2,'抒情','0-2-3',2,'123123',1509067738,1509095444,1509095444),(4,0,'人文社科','0-4',1,'人文社科即人文社会科学，是人文科学和社会科学的总称.。人文科学关注的中心、研究的对象主要是关于人的精神、文化、价值、观念的问题。研究对象与研究者自身都具有强烈的主体性、个体性、多变性和丰富性。',1509095613,1509095613,NULL),(5,0,'经管励志','0-5',1,'经管励志即经济管理与励志文学',1509095711,1509095711,NULL),(6,0,'生活时尚','0-6',1,'即日常生活与时尚追求',1509095838,1509095838,NULL),(7,0,'科技教育','0-7',1,'教育，教化培育，以现有的经验、学识推敲于人，为其解释各种现象、问题或行为，其根本是以人的一种相对成熟或理性的思维来认知对待，让事物得以接近其最根本的存在',1509095873,1509095873,NULL),(8,0,'少儿童书','0-8',1,'让你孩子的生活更加丰富多彩吧',1509095919,1509095920,NULL),(9,2,'诗歌散文','0-2-9',2,'诗歌',1509095967,1509095967,NULL),(10,2,'小说','0-2-10',2,'小说',1509095988,1509095988,NULL),(11,2,'青春文学','0-2-11',2,'青春就是好啊',1509096004,1509096004,NULL),(12,2,'文集理论','0-2-12',2,'各种作文',1509096019,1509096019,NULL),(13,2,'古籍','0-2-13',2,'古文学',1509096040,1509096040,NULL),(14,2,'艺术','0-2-14',2,'艺术源于生活',1509096063,1509096628,1509096628),(15,9,'中国古诗词','0-2-9-15',3,'古诗',1509096106,1509096107,NULL),(16,9,'中国当代诗歌','0-2-9-16',3,'中国当代',1509096172,1509096172,NULL),(17,9,'外国诗歌','0-2-9-17',3,'外国',1509096186,1509096186,NULL),(18,5,'经济','0-5-18',2,'经济学总览',1509096219,1509096219,NULL),(19,5,'管理','0-5-19',2,'管理学',1509096240,1509096240,NULL),(20,5,'投资理财','0-5-20',2,'学会投资',1509096256,1509096256,NULL),(21,5,'职场/励志','0-5-21',2,'职场人生',1509096274,1509096274,NULL),(22,10,'名家名作','0-2-10-22',3,'名家小说',1509096302,1509096302,NULL),(23,10,'中国古典小说','0-2-10-23',3,'经典',1509096339,1509096339,NULL),(24,10,'世界名著','0-2-10-24',3,'大师级小说',1509096360,1509096361,NULL),(25,11,'校园','0-2-11-25',3,'校园恋爱',1509096400,1509096400,NULL),(26,11,'爱情/情感','0-2-11-26',3,'真好啊',1509096416,1509096416,NULL),(27,11,'偶像/娱乐','0-2-11-27',3,'嗷嗷嗷',1509096434,1509096434,NULL),(28,12,'文学理论','0-2-12-28',3,'文学',1509096450,1509096450,NULL),(29,12,'评论鉴赏','0-2-12-29',3,'教你成为大师',1509096466,1509096467,NULL),(30,12,'作品集','0-2-12-30',3,'123',1509096482,1509096482,NULL),(31,13,'经部','0-2-13-31',3,'厉害',1509096510,1509096510,NULL),(32,13,'史部','0-2-13-32',3,'123',1509096554,1509096554,NULL),(33,13,'子部','0-2-13-33',3,'12',1509096574,1509096574,NULL),(34,13,'集部','0-2-13-34',3,'12',1509096589,1509096589,NULL),(35,13,'四库全书','0-2-13-35',3,'大全',1509096602,1509096602,NULL),(36,13,'古籍工具书','0-2-13-36',3,'必不可少',1509096620,1509096620,NULL);
/*!40000 ALTER TABLE `shop_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_user`
--

DROP TABLE IF EXISTS `shop_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `phone` varchar(12) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `sex` smallint(6) NOT NULL DEFAULT '0',
  `birthday` varchar(20) DEFAULT NULL,
  `isban` smallint(6) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_user`
--

LOCK TABLES `shop_user` WRITE;
/*!40000 ALTER TABLE `shop_user` DISABLE KEYS */;
INSERT INTO `shop_user` VALUES (1,'test001','e10adc3949ba59abbe56e057f20f883e',0,'17865923231',NULL,0,NULL,1,123123123,1509089282,NULL),(2,'123456','e10adc3949ba59abbe56e057f20f883e',0,'18601021538',NULL,0,NULL,0,1508810002,1509153055,NULL);
/*!40000 ALTER TABLE `shop_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-28 20:06:27
