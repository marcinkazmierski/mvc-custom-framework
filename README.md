# Simple MVC framework [PHP]

## Version v1.0.1

### database:
```sql
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text CHARACTER SET utf8 NOT NULL,
  `password` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `pages` (
`id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `content` varchar(2048) NOT NULL,
  `date` int(11) NOT NULL
);

CREATE TABLE `caches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cache_key` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `expire` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

INSERT INTO `users` (`id`, `login`, `password`) VALUES (NULL, 'test', '098f6bcd4621d373cade4e832627b4f6');
```
User: test / test

### What implemented? 
- MVC Architecture
- __autoload
- namespaces
- PDO
- Logs
- simple cache engine
- simple ORM
- PHPUnit
- environments [dev, prod]
- flash messages
- Exceptions

### TODO 
- translations
- PHP7.3
- docker-compose
- password hash provider
- composer

###PHPUnit
- Tests run: php phpunit.phar framework/tests/
- Tests results: /build/coverage/