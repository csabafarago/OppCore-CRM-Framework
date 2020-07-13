-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2017. Jún 04. 08:17
-- Kiszolgáló verziója: 5.7.18-0ubuntu0.17.04.1
-- PHP verzió: 7.0.18-0ubuntu0.17.04.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opp_core`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `active`) VALUES
(1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_lang`
--

CREATE TABLE `category_lang` (
  `category_id` int(11) NOT NULL,
  `lang_id` int(2) DEFAULT NULL,
  `category_name` varchar(30) DEFAULT NULL,
  `sef` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_lang`
--

INSERT INTO `category_lang` (`category_id`, `lang_id`, `category_name`, `sef`) VALUES
(1, 2, 'Category 1', 'category-1'),
(1, 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(8) NOT NULL,
  `lead_image` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `deleted_by` varchar(45) DEFAULT NULL,
  `deleted_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `lead_image`, `active`, `created_by`, `created_date`, `modified_by`, `modified_date`, `deleted_by`, `deleted_date`) VALUES
(1, '', 1, 1, 1474454320, 1, 1491040116, NULL, NULL),
(2, 'example', 1, 2, 1475819860, 1, 1594603687, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `content_category`
--

CREATE TABLE `content_category` (
  `content_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content_category`
--

INSERT INTO `content_category` (`content_id`, `category_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `content_lang`
--

CREATE TABLE `content_lang` (
  `content_id` int(11) NOT NULL,
  `lang_id` int(2) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sef` varchar(255) DEFAULT NULL,
  `lead` varchar(255) DEFAULT NULL,
  `text` text,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content_lang`
--

INSERT INTO `content_lang` (`content_id`, `lang_id`, `title`, `sef`, `lead`, `text`, `keywords`) VALUES
(1, 1, 'Rólunk', 'rolunk', 'cke_toolbar', '<div id=\"Content\">\r\n<div class=\"boxed\">\r\n<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur laoreet mi et risus pretium, imperdiet placerat nulla sodales. Aenean in auctor mauris, eu efficitur libero. Proin pellentesque mi massa, sed bibendum turpis tempor quis. Etiam a sollicitudin nulla, id condimentum nunc. Nunc ultricies, quam ac varius viverra, odio nunc tincidunt velit, a bibendum dui tortor eu felis. Maecenas massa purus, accumsan in commodo at, viverra ut libero. Quisque pretium at leo vel mattis. Quisque iaculis viverra leo. Fusce vehicula elit vel augue gravida, sit amet porttitor quam ornare. Morbi tempor sed quam in volutpat. Integer volutpat lacus sed quam aliquam, quis elementum nibh tincidunt. Pellentesque vitae consequat turpis. Ut blandit mattis ante, a viverra purus imperdiet vel. Aenean quis massa a leo consequat sollicitudin ut eget ipsum.</p>\r\n<p>Phasellus ut justo sit amet elit elementum lobortis. Mauris non lectus tortor. Praesent quis dignissim nulla, et convallis justo. Vivamus nibh eros, malesuada a tincidunt sit amet, placerat ac justo. Ut quam diam, tempor a ipsum nec, placerat accumsan orci. Donec sodales mollis auctor. Integer in velit massa. Fusce venenatis, diam eget aliquet feugiat, nisl sem lacinia nunc, id ullamcorper sem augue et ipsum.</p>\r\n<p>Ut ornare elementum justo, nec convallis sem aliquam sit amet. Morbi luctus ante sed turpis accumsan faucibus id eu lacus. Curabitur tempus est risus, in feugiat ligula blandit quis. Vestibulum pulvinar nulla ut nisl sollicitudin, quis porta neque pharetra. Nullam eleifend maximus mauris in aliquet. Curabitur sollicitudin turpis sit amet ipsum sollicitudin, sollicitudin euismod justo venenatis. Cras in efficitur magna. Nullam iaculis gravida velit eget rutrum. Sed efficitur, turpis in varius lacinia, felis sem ullamcorper lacus, dictum iaculis est dolor porttitor mauris.</p>\r\n<p>Aliquam a ullamcorper ligula. Duis ut consectetur velit. Nulla porttitor justo eget porttitor rhoncus. Donec porttitor ornare metus, sed cursus nulla porta a. Vestibulum fermentum urna turpis, quis fermentum risus pharetra eu. Nulla dictum lectus a mollis viverra. Aliquam varius lorem ac nisl porttitor, non finibus dolor maximus. In blandit justo tincidunt purus mattis, eu condimentum tellus euismod. Vestibulum elementum ex elit, at vulputate metus pretium eu.</p>\r\n<p>Cras est mi, porttitor mollis nisi ac, sollicitudin aliquam dui. Ut vel massa dapibus, imperdiet leo nec, tempor diam. Etiam tristique odio quis erat facilisis commodo at id velit. Vestibulum facilisis, sapien id commodo dapibus, tortor sem gravida nisi, quis tincidunt purus ligula ac est. Proin elementum nisi id augue porta imperdiet. Cras cursus dictum turpis scelerisque ornare. Vestibulum volutpat lorem diam, at placerat turpis ultrices ac. Fusce at massa rutrum, porta ex in, placerat tortor. Sed nulla urna, finibus ac dignissim ut, sagittis a ligula. Sed accumsan, est nec consectetur varius, mi sem varius nisl, eget gravida ligula neque sed mauris. Donec dapibus orci id ex porttitor, at aliquet nisl malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed faucibus lacinia euismod.</p>\r\n</div>\r\n</div>\r\n</div>', 'cke_toolbar'),
(1, 2, '', '', '', '', ''),
(2, 1, 'Valami 2', 'teszt', 'dasdsadsad', '<p><img class=\"content-img\" src=\"https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-504300.jpg\" /></p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>teszt</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>teszt</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>teszt</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>teszt</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>teszt</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>teszt</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 'dadsaddsadad'),
(2, 2, 'Test content', '', '', 'Lorem ipsum', '');

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `lang_id` int(2) DEFAULT NULL,
  `lang_code` varchar(3) DEFAULT NULL,
  `lang_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`id`, `lang_id`, `lang_code`, `lang_name`) VALUES
(1, 1, 'hu', 'Magyar'),
(2, 2, 'en', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `registered_date` int(11) DEFAULT NULL,
  `deleted_date` int(11) DEFAULT NULL,
  `admin_login` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `active`, `registered_date`, `deleted_date`, `admin_login`) VALUES
(1, 'csaba', 'Csaba', 'Farago', 'faragoc@example.com', '4cef9a2dc57422c4466b4bbe2e3fa4dc79286bbc', 1, 1474453983, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_privilge_group_lang`
--

CREATE TABLE `user_privilge_group_lang` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `user_privilige_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_privilige_group`
--

CREATE TABLE `user_privilige_group` (
  `id` int(11) NOT NULL,
  `privilige_group` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_to_privilige_group`
--

CREATE TABLE `user_to_privilige_group` (
  `user_id` int(11) NOT NULL,
  `user_privilige_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_lang`
--
ALTER TABLE `category_lang`
  ADD KEY `fk_category_lang_category1_idx` (`category_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_category`
--
ALTER TABLE `content_category`
  ADD KEY `fk_content_category_category1_idx` (`category_id`),
  ADD KEY `fk_content_category_content1` (`content_id`);

--
-- Indexes for table `content_lang`
--
ALTER TABLE `content_lang`
  ADD KEY `fk_content_lang_content1` (`content_id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`) USING BTREE,
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `user_privilge_group_lang`
--
ALTER TABLE `user_privilge_group_lang`
  ADD PRIMARY KEY (`id`,`user_privilige_group_id`),
  ADD KEY `fk_user_privilige_group_lang_user_privilidge_group1_idx` (`user_privilige_group_id`);

--
-- Indexes for table `user_privilige_group`
--
ALTER TABLE `user_privilige_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_to_privilige_group`
--
ALTER TABLE `user_to_privilige_group`
  ADD PRIMARY KEY (`user_id`,`user_privilige_group_id`),
  ADD KEY `fk_user_to_privilige_group_user_privilidge_group1_idx` (`user_privilige_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_lang`
--
ALTER TABLE `category_lang`
  ADD CONSTRAINT `fk_category_lang_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `content_category`
--
ALTER TABLE `content_category`
  ADD CONSTRAINT `fk_content_category_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_content_category_content1` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `content_lang`
--
ALTER TABLE `content_lang`
  ADD CONSTRAINT `fk_content_lang_content1` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_privilge_group_lang`
--
ALTER TABLE `user_privilge_group_lang`
  ADD CONSTRAINT `fk_user_privilige_group_lang_user_privilidge_group1` FOREIGN KEY (`user_privilige_group_id`) REFERENCES `user_privilige_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_to_privilige_group`
--
ALTER TABLE `user_to_privilige_group`
  ADD CONSTRAINT `fk_user_to_privilige_group_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_to_privilige_group_user_privilidge_group1` FOREIGN KEY (`user_privilige_group_id`) REFERENCES `user_privilige_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;