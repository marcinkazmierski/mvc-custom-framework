# Simple MVC framework [PHP]

database:
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

CREATE TABLE IF NOT EXISTS `caches` (
  `id` int(10) UNSIGNED NOT NULL,
  `cache_key` varchar(254) NOT NULL,
  `value` text CHARACTER SET utf8 NOT NULL,
  `expire` int(11) NOT NULL DEFAULT '0'
);

```


**what was implemented?**
- MVC Architecture
- __autoload
- namespaces
- PDO
- Logs