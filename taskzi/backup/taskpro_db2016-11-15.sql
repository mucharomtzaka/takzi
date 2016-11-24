#
# TABLE STRUCTURE FOR: categoriespost
#

DROP TABLE IF EXISTS `categoriespost`;

CREATE TABLE `categoriespost` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategories_title` varchar(100) NOT NULL,
  `kategories_description` text,
  PRIMARY KEY (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('3', 'Artikel', 'Artikel');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('4', 'Computers', 'Computers');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('5', 'Smartphones', 'Smartphones');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('6', 'Gadgets', 'Gadgets');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('7', 'Technologys', 'Technologys');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('8', 'News', 'News');


#
# TABLE STRUCTURE FOR: groups
#

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('1', 'admin', 'Administrator');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('2', 'members', 'General User');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('5', 'IT-Support', 'IT-Support');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('7', 'Audit Keuangan', 'Audit Keuangan');


#
# TABLE STRUCTURE FOR: groups_post
#

DROP TABLE IF EXISTS `groups_post`;

CREATE TABLE `groups_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_id` mediumint(8) unsigned NOT NULL,
  `article_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `groups_post` (`id`, `categories_id`, `article_id`) VALUES ('2', '4', '5');
INSERT INTO `groups_post` (`id`, `categories_id`, `article_id`) VALUES ('3', '4', '4');


#
# TABLE STRUCTURE FOR: login_attempts
#

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: menubar
#

DROP TABLE IF EXISTS `menubar`;

CREATE TABLE `menubar` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(20) NOT NULL,
  `menu_link` varchar(200) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `menubar` (`menu_id`, `menu`, `menu_link`) VALUES ('1', 'Berita', 'http://localhost/taskpro/welcome/Blog/content/berita');
INSERT INTO `menubar` (`menu_id`, `menu`, `menu_link`) VALUES ('2', 'Karir', 'http://localhost/taskpro/welcome/Blog/content/karir');


#
# TABLE STRUCTURE FOR: migrations
#

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`version`) VALUES ('20161115162039');


#
# TABLE STRUCTURE FOR: postartikel
#

DROP TABLE IF EXISTS `postartikel`;

CREATE TABLE `postartikel` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(100) NOT NULL,
  `article_description` text,
  `Date` date NOT NULL,
  `Image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `postartikel` (`article_id`, `article_title`, `article_description`, `Date`, `Image`) VALUES ('4', 'APaop', 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.', '2016-11-14', '20160825_145119.jpg');
INSERT INTO `postartikel` (`article_id`, `article_title`, `article_description`, `Date`, `Image`) VALUES ('5', 'Consequat bibendum quam liquam viverra', '<h3>Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.</h3>', '2016-11-14', 'bg1.jpg');


#
# TABLE STRUCTURE FOR: settings
#

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id_sett` int(11) NOT NULL AUTO_INCREMENT,
  `header_title` varchar(80) DEFAULT NULL,
  `footer_title` varchar(100) DEFAULT NULL,
  `meta_title` varchar(200) DEFAULT NULL,
  `themes` varchar(95) DEFAULT NULL,
  `image_favicon` varchar(95) DEFAULT NULL,
  `backgrounds` varchar(100) DEFAULT NULL,
  `name_company` varchar(100) DEFAULT NULL,
  `address_company` varchar(100) DEFAULT NULL,
  `contact_company` varchar(100) DEFAULT NULL,
  `name_company_profil_des` text,
  PRIMARY KEY (`id_sett`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`id_sett`, `header_title`, `footer_title`, `meta_title`, `themes`, `image_favicon`, `backgrounds`, `name_company`, `address_company`, `contact_company`, `name_company_profil_des`) VALUES ('1', 'Taskpro LTE ', '© Copyright 2016 Taskpro LTE ', 'Taskpro LTE ,design', 'skin-green-light', 'gears.gif', 'logo.png', 'Taskpro LTE ', 'Jalan Sukorejo -Parakan ', '089692412261', 'Taskpro LTE Corporation .IT Support For bussiness Solution ');


#
# TABLE STRUCTURE FOR: settings_email
#

DROP TABLE IF EXISTS `settings_email`;

CREATE TABLE `settings_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol` varchar(80) NOT NULL,
  `smtp_host` varchar(80) NOT NULL,
  `smtp_user` varchar(100) NOT NULL,
  `smtp_pass` varchar(100) NOT NULL,
  `smtp_port` varchar(12) NOT NULL,
  `newline_smtp` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `settings_email` (`id`, `protocol`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `newline_smtp`) VALUES ('1', 'smtp', 'ssl://smtp.gmail.com', 'mucharomtzaka@gmail.com', 'kotajogja', '465', '\"\\r\\n\"');


#
# TABLE STRUCTURE FOR: slideshow
#

DROP TABLE IF EXISTS `slideshow`;

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_front` varchar(100) DEFAULT NULL,
  `image_back` varchar(100) DEFAULT NULL,
  `description` text,
  `active` tinyint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: submenubar
#

DROP TABLE IF EXISTS `submenubar`;

CREATE TABLE `submenubar` (
  `submenu_id` int(11) NOT NULL AUTO_INCREMENT,
  `submenu` varchar(20) NOT NULL,
  `menu_id` varchar(20) NOT NULL,
  `submenu_link` varchar(200) NOT NULL,
  PRIMARY KEY (`submenu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `submenubar` (`submenu_id`, `submenu`, `menu_id`, `submenu_link`) VALUES ('1', 'edrf', '2', 'g');


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('1', '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, '1268889823', '1479218297', '1', 'Admin', 'istrator', 'ADMIN', '0');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('2', '::1', 'mucharomtzaka@gmail.com', '$2y$08$UnEWdyFEQQdSJQZq/YALse9FXUMgw3TDBgibWUAivcB9Fs.DmX4gW', '', 'mucharomtzaka@gmail.com', NULL, NULL, NULL, NULL, '1478874799', '1479090681', '1', 'Mucharom', 'tzaka', 'taskpro LTE', '8900909080898');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('17', '::1', 'mucharomtzaka@yahoo.co.id', '$2y$08$/tAkJ1quXolTRsKNCATabeGdh/oT/vCgq8/SiihQwtW/6OiDtjKUe', '', 'mucharomtzaka@yahoo.co.id', 'da6ee5462c0b364b8441e0185dbda0ee44f9c0ef', NULL, NULL, NULL, '1479013361', NULL, '0', 'andi', 'andilau', 'andi corporation', '1234567890');


#
# TABLE STRUCTURE FOR: users_groups
#

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('56', '17', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('57', '2', '5');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('60', '1', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('61', '1', '5');


