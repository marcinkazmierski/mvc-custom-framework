CREATE TABLE IF NOT EXISTS `mvc_db`.`users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `mvc_db`.`pages` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `content` varchar(2048) NOT NULL,
  `date` int(11) NOT NULL
);

CREATE TABLE IF NOT EXISTS `mvc_db`.`caches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cache_key` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `expire` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

INSERT INTO `mvc_db`.`users` (`id`, `login`, `password`) VALUES (NULL, 'test', '$2y$10$80vnzmwqfDQTuv5unhZctOzZhaMPkqgbFtDalrub6ZmGXNAQ9f5ae');
