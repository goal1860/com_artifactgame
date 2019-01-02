DROP TABLE IF EXISTS `#__artifactgame_decks`;
DROP TABLE IF EXISTS `#__artifactgame_deck`;
DROP TABLE IF EXISTS `#__decks`;
DROP TABLE IF EXISTS `#__deck`;
CREATE TABLE `#__artifactgame_decks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `format` varchar(45) DEFAULT NULL,
  `hero_black` int(11) DEFAULT NULL,
  `hero_blue` int(11) DEFAULT NULL,
  `hero_red` int(11) DEFAULT NULL,
  `hero_green` int(11) DEFAULT NULL,
  `mana_black` int(11) DEFAULT NULL,
  `mana_blue` int(11) DEFAULT NULL,
  `mana_red` int(11) DEFAULT NULL,
  `mana_green` int(11) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
