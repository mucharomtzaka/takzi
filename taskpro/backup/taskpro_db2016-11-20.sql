#
# TABLE STRUCTURE FOR: categoriespost
#

DROP TABLE IF EXISTS `categoriespost`;

CREATE TABLE `categoriespost` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategories_title` varchar(100) NOT NULL,
  `kategories_description` text,
  PRIMARY KEY (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('3', 'Artikel', 'Artikel');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('4', 'Computers', 'Computers');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('5', 'Smartphones', 'Smartphones');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('6', 'Gadgets', 'Gadgets');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('7', 'Technologys', 'Technologys');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('8', 'News', 'News');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('9', 'Features', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut \r\net dolore magna aliqua. Ut enim ad minim veniam');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('10', 'Our Service', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut \r\net dolore magna aliqua. Ut enim ad minim veniam');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('11', 'COMPANY', 'COMPANY');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('12', 'SUPPORT', 'SUPPORT');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('13', 'DEVELOPERS', 'DEVELOPERS');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('14', 'OUR PARTNERS', 'OUR PARTNERS');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('16', 'Creative', 'Creative');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('17', 'Photography', 'Photography');
INSERT INTO `categoriespost` (`categories_id`, `kategories_title`, `kategories_description`) VALUES ('18', 'Web Development', 'Web Development');


#
# TABLE STRUCTURE FOR: features
#

DROP TABLE IF EXISTS `features`;

CREATE TABLE `features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_features` varchar(100) NOT NULL,
  `desc_features` varchar(100) NOT NULL,
  `icon_features` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `features` (`id`, `title_features`, `desc_features`, `icon_features`) VALUES ('1', 'Fresh and Clean', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', '<i class=\"fa fa-bullhorn\"></i>');
INSERT INTO `features` (`id`, `title_features`, `desc_features`, `icon_features`) VALUES ('2', 'Adipisicing elit', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', '<i class=\"fa fa-leaf\"></i>');
INSERT INTO `features` (`id`, `title_features`, `desc_features`, `icon_features`) VALUES ('3', 'Retina ready', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', '<i class=\"fa fa-comments\"></i>');
INSERT INTO `features` (`id`, `title_features`, `desc_features`, `icon_features`) VALUES ('4', 'Easy to customize', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', '<i class=\"fa fa-cloud-download\"></i>');
INSERT INTO `features` (`id`, `title_features`, `desc_features`, `icon_features`) VALUES ('5', 'Sed do eiusmod', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', '<i class=\"fa fa-cogs\"></i>');
INSERT INTO `features` (`id`, `title_features`, `desc_features`, `icon_features`) VALUES ('6', 'Labore et dolore', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', '<i class=\"fa fa-heart\"></i>');


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
# TABLE STRUCTURE FOR: groups_portfolio
#

DROP TABLE IF EXISTS `groups_portfolio`;

CREATE TABLE `groups_portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categories` int(11) NOT NULL,
  `id_porto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `groups_portfolio` (`id`, `id_categories`, `id_porto`) VALUES ('3', '17', '3');
INSERT INTO `groups_portfolio` (`id`, `id_categories`, `id_porto`) VALUES ('4', '17', '4');
INSERT INTO `groups_portfolio` (`id`, `id_categories`, `id_porto`) VALUES ('6', '16', '5');
INSERT INTO `groups_portfolio` (`id`, `id_categories`, `id_porto`) VALUES ('7', '16', '6');


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
# TABLE STRUCTURE FOR: linkscompany
#

DROP TABLE IF EXISTS `linkscompany`;

CREATE TABLE `linkscompany` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_link_menu` varchar(50) NOT NULL,
  `desc_link_menu` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `linkscompany` (`id`, `title_link_menu`, `desc_link_menu`) VALUES ('1', 'About Us', 'welcome/Profil');
INSERT INTO `linkscompany` (`id`, `title_link_menu`, `desc_link_menu`) VALUES ('2', 'Services', 'welcome/Services');
INSERT INTO `linkscompany` (`id`, `title_link_menu`, `desc_link_menu`) VALUES ('3', 'Blog', 'welcome/Blog');
INSERT INTO `linkscompany` (`id`, `title_link_menu`, `desc_link_menu`) VALUES ('4', 'Contact', 'welcome/Contact');


#
# TABLE STRUCTURE FOR: linksdevelop
#

DROP TABLE IF EXISTS `linksdevelop`;

CREATE TABLE `linksdevelop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_link_menu_develop` varchar(50) NOT NULL,
  `desc_link_menu_develop` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: linkspartner
#

DROP TABLE IF EXISTS `linkspartner`;

CREATE TABLE `linkspartner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_link_menu_partner` varchar(50) NOT NULL,
  `desc_link_menu_partner` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: linkssupport
#

DROP TABLE IF EXISTS `linkssupport`;

CREATE TABLE `linkssupport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_link_menu_support` varchar(50) NOT NULL,
  `desc_link_menu_support` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

INSERT INTO `menubar` (`menu_id`, `menu`, `menu_link`) VALUES ('1', 'Berita', '#');
INSERT INTO `menubar` (`menu_id`, `menu`, `menu_link`) VALUES ('2', 'Karir', '#');


#
# TABLE STRUCTURE FOR: menus
#

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menus` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('1', NULL, 'Item 0', 'glyphicon glyphicon-user', 'Item-0', '1');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('2', NULL, 'Item 1', 'glyphicon glyphicon-remove', 'Item-1', '2');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('3', NULL, 'Item 2', '', 'Item-2', '3');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('4', NULL, 'Item 3', '', 'Item-3', '4');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('5', NULL, 'Item 4', '', 'Item-4', '5');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('6', NULL, 'Item 5', '', 'Item-5', '6');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('7', NULL, 'Item 6', '', 'Item-6', '7');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('8', '1', 'Item 0.1', '', 'item-0.1', '1');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('9', '1', 'Item 0.2', 'glyphicon glyphicon-search', 'item-0-2', '2');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('10', '8', 'Item 0.1.1', '', 'item-0-1-1', '1');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('11', '8', 'Item 0.1.2', '', 'Item-0-1-2', '2');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('12', '10', 'Item 0.1.1.1', '', 'Item-0-1-1-1', '1');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('13', '10', 'Item 0.1.1.2', '', 'Item-0-1-1-2', '2');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('14', '2', 'Item 1.1', '', 'item-1-1', '1');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('15', '2', 'Item 1.2', '', 'item-1-2', '2');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('16', '3', 'Item 2.2', '', 'item-2-2', '2');
INSERT INTO `menus` (`id`, `parent`, `name`, `icon`, `slug`, `number`) VALUES ('17', '3', 'Item 2.1', '', 'item-2.1', '1');


#
# TABLE STRUCTURE FOR: messages
#

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameuser` varchar(50) NOT NULL,
  `emailuser` varchar(100) NOT NULL,
  `phoneuser` varchar(12) NOT NULL,
  `companyuser` varchar(50) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `messages` (`id`, `nameuser`, `emailuser`, `phoneuser`, `companyuser`, `subject`, `message`) VALUES ('1', 'hary', 'harypot34@gmail.com', '', '', 'Halo', 'halo guysslkswkjdejlwcn ljlcnlskdnvsvksb jhkvhuahjb');


#
# TABLE STRUCTURE FOR: migrations
#

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`version`) VALUES ('20161117101104');


#
# TABLE STRUCTURE FOR: portofolio
#

DROP TABLE IF EXISTS `portofolio`;

CREATE TABLE `portofolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_porto` varchar(100) NOT NULL,
  `desc_porto` text,
  `image_porto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `portofolio` (`id`, `title_porto`, `desc_porto`, `image_porto`) VALUES ('1', 'ik', '<p>\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority\r\n\r\n<br></p>', 'item4.png');
INSERT INTO `portofolio` (`id`, `title_porto`, `desc_porto`, `image_porto`) VALUES ('3', 'PO', '<p>\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority\r\n\r\n<br></p>', 'item6.png');
INSERT INTO `portofolio` (`id`, `title_porto`, `desc_porto`, `image_porto`) VALUES ('4', 'wa', '<p>\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority\r\n\r\n<br></p>', 'item3.png');
INSERT INTO `portofolio` (`id`, `title_porto`, `desc_porto`, `image_porto`) VALUES ('5', 'JK', '<p>\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority\r\n\r\n<br></p>', 'item5.png');
INSERT INTO `portofolio` (`id`, `title_porto`, `desc_porto`, `image_porto`) VALUES ('6', 'OP', '<p>\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority\r\n\r\n<br></p>', 'item8.png');


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `postartikel` (`article_id`, `article_title`, `article_description`, `Date`, `Image`) VALUES ('4', 'APaop', 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.', '2016-11-14', 'blog1.jpg');
INSERT INTO `postartikel` (`article_id`, `article_title`, `article_description`, `Date`, `Image`) VALUES ('6', 'Consequat bibendum quam  liquam viverra', '<h3>Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.</h3>\r\n\r\n<br>', '2016-11-16', 'blog2.jpg');
INSERT INTO `postartikel` (`article_id`, `article_title`, `article_description`, `Date`, `Image`) VALUES ('7', 'Membuat Navbar Men Dinamis dengan Bootstrap PHP dan MySQL', '<p>\r\n\r\n</p><strong><small>Membuat Navbar Menu Dinamis dengan Bootstrap, PHP dan MySQL</small></strong><small>. Bootstrap lagi </small><img alt=\"\" src=\"http://tutorialweb.net/wp-content/plugins/kaskus-emoticons/emoticons/15.gif\"><small>. Kali ini tutorial membuat menu navbar dinamis dengan Boostrap, PHP dan MySQL. Setelah beberapa saat yang lalu saya juga menulis artikel tentang </small><a target=\"_blank\" rel=\"nofollow\" href=\"http://tutorialweb.net/3-free-bootstrap-admin-template/\"><small>3 Free Bootstrap Admin Template</small></a><small>.Apa sih maksud dari Navbar Menu Dinamis dengan Bootstrap, PHP dan MySQL?Biasanya kan Navbar menu yang dibuat selalu Statis atau tetap atau merubahnya secara manual (dengan menuliskan kode html). Nah, sekarang saya akan mencoba cara membuat Navbar Menu tersebuat bisa Dinamis, data menu tersebut di ambil dari database MySQL dengan kode PHP. Anda bisa melihat contoh Navbar Bootstrap yang Statis </small><a target=\"_blank\" rel=\"nofollow\" href=\"http://getbootstrap.com/components/#navbar\"><small>Disini</small></a><small>. Nanti akan kita buat Navbar tersebut Dinamis dan bisa di rubah dari database. Oke, langsung saja tutorialnya dimulai </small><img alt=\"\" src=\"http://tutorialweb.net/wp-content/plugins/kaskus-emoticons/emoticons/15.gif\"><p><small>Pertama tentu saja buat database dulu, dalam kasus ini saya membuat database dengan nama </small><strong><small>tutorialweb</small></strong><small>. Kemudian dumping Script SQL di bawah ini di phpMyAdmin.</small></p><small>\r\n\r\nCREATE TABLE `menu` (</small><br><small>  `menu_id` int(11) NOT NULL auto_increment,</small><br><small>  `menu` varchar(20) NOT NULL,</small><br><small>  `menu_link` varchar(200) NOT NULL,</small><br><small>  PRIMARY KEY  (`menu_id`)</small><br><small>) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;</small><br><br><small>CREATE TABLE `submenu` (</small><br><small>  `submenu_id` int(11) NOT NULL auto_increment,</small><br><small>  `menu_id` int(11) NOT NULL,</small><br><small>  `submenu` varchar(20) NOT NULL,</small><br><small>  `submenu_link` varchar(200) NOT NULL,</small><br><small>  PRIMARY KEY  (`submenu_id`)</small><br><small>) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;</small><br><p></p><p><br></p>', '2016-11-17', 'navbar-db.jpg');


#
# TABLE STRUCTURE FOR: services
#

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_services` varchar(100) NOT NULL,
  `desc_services` tinytext NOT NULL,
  `icon_services` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `services` (`id`, `title_services`, `desc_services`, `icon_services`) VALUES ('5', 'SEO Marketing', 'Lorem ipsum dolor sit ame consectetur adipisicing elit', 'services4.png');
INSERT INTO `services` (`id`, `title_services`, `desc_services`, `icon_services`) VALUES ('8', 'SEO Marketing', 'Lorem ipsum dolor sit ame consectetur adipisicing elit', 'services2.png');
INSERT INTO `services` (`id`, `title_services`, `desc_services`, `icon_services`) VALUES ('9', 'SEO Marketing', 'Lorem ipsum dolor sit ame consectetur adipisicing elit', 'services1.png');
INSERT INTO `services` (`id`, `title_services`, `desc_services`, `icon_services`) VALUES ('10', 'SEO Marketing', 'Lorem ipsum dolor sit ame consectetur adipisicing elit', 'services3.png');
INSERT INTO `services` (`id`, `title_services`, `desc_services`, `icon_services`) VALUES ('11', 'SEO Marketing', 'Lorem ipsum dolor sit ame consectetur adipisicing elit', 'services5.png');
INSERT INTO `services` (`id`, `title_services`, `desc_services`, `icon_services`) VALUES ('12', 'SEO Marketing', 'Lorem ipsum dolor sit ame consectetur adipisicing elit', 'services6.png');


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

INSERT INTO `settings` (`id_sett`, `header_title`, `footer_title`, `meta_title`, `themes`, `image_favicon`, `backgrounds`, `name_company`, `address_company`, `contact_company`, `name_company_profil_des`) VALUES ('1', 'Taskpro LTE ', '© Copyright 2016 Taskpro LTE ', 'Taskpro LTE ,design', 'skin-green-light', 'gears.gif', 'logo.png', 'Taskpro LTE ', 'Jalan Sukorejo -Parakan ', '089692412261', 'Taskpro LTE Corporation .IT Support For bussiness Solution');


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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `slideshow` (`id`, `image_front`, `image_back`, `description`, `active`) VALUES ('6', 'img1.png', 'bg1.jpg', '<p>\r\n\r\n</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p><p>Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</p>\r\n\r\n<p></p>', '0');
INSERT INTO `slideshow` (`id`, `image_front`, `image_back`, `description`, `active`) VALUES ('7', 'img2.png', 'bg2.jpg', '<p>\r\n\r\n</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p><p>Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</p>\r\n\r\n<p></p>', '0');
INSERT INTO `slideshow` (`id`, `image_front`, `image_back`, `description`, `active`) VALUES ('8', 'img3.png', 'bg3.jpg', '<p>\r\n\r\n</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p><p>Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</p>\r\n\r\n<p></p>', '1');
INSERT INTO `slideshow` (`id`, `image_front`, `image_back`, `description`, `active`) VALUES ('12', 'hotel.jpg', 'hotel1.jpg', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br>et dolore magna aliqua. Ut enim ad minim veniam\r\n\r\n<br></p>', '0');
INSERT INTO `slideshow` (`id`, `image_front`, `image_back`, `description`, `active`) VALUES ('13', 'slider_one.jpg', 'hotel2.jpg', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br>et dolore magna aliqua. Ut enim ad minim veniam\r\n\r\n<br></p>', '0');


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `submenubar` (`submenu_id`, `submenu`, `menu_id`, `submenu_link`) VALUES ('1', 'Administrator', '2', 'http://localhost/taskpro/welcome/Blog?q=karir');
INSERT INTO `submenubar` (`submenu_id`, `submenu`, `menu_id`, `submenu_link`) VALUES ('2', 'Jogja Jobs Vacancy', '2', 'http://localhost/taskpro/welcome/Blog?q=karir');


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

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('1', '127.0.0.1', 'administrator', '$2y$08$owVbeNWAS3gXV6RKHD/PAeVrQJz.46yZfVpVYdVR8krZdp5FZEACC', '', 'admin@admin.com', NULL, NULL, NULL, NULL, '1268889823', '1479625706', '1', 'Admin', 'istrator', 'ADMIN', '0');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('2', '::1', 'mucharomtzaka@gmail.com', '$2y$08$UnEWdyFEQQdSJQZq/YALse9FXUMgw3TDBgibWUAivcB9Fs.DmX4gW', '', 'mucharomtzaka@gmail.com', NULL, NULL, NULL, NULL, '1478874799', '1479626616', '1', 'Mucharom', 'tzaka', 'taskpro LTE', '8900909080898');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('17', '::1', 'mucharomtzaka@yahoo.co.id', '$2y$08$MKtLL8UQ/o23Tnyxmf.zs.UPvBbV0pywm10tgUL9BmtBWD9/RvsbS', '', 'mucharomtzaka@yahoo.co.id', NULL, NULL, NULL, NULL, '1479013361', '1479626129', '1', 'andi', 'andilau', 'andi corporation', '1234567890');


#
# TABLE STRUCTURE FOR: users_groups
#

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('62', '17', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('64', '1', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('65', '2', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('66', '2', '5');


