DROP TABLE IF EXISTS `#__artifactgame_gold_distribution`;
CREATE TABLE `#__artifactgame_gold_distribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deck_id` int(11) DEFAULT NULL,
  `gold_cost` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `#__artifactgame_mana_distribution`;
CREATE TABLE `#__artifactgame_mana_distribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deck_id` int(11) DEFAULT NULL,
  `mana` int(11) DEFAULT NULL,
  `count_black` int(11) DEFAULT NULL,
  `count_blue` int(11) DEFAULT NULL,
  `count_red` int(11) DEFAULT NULL,
  `count_green` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
