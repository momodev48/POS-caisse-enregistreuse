CREATE TABLE `facebook_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(100) DEFAULT  NULL,
  `app_secret` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;