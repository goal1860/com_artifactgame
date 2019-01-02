DROP TABLE IF EXISTS `#__artifactgame_deck_card`;
CREATE TABLE `#__artifactgame_deck_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deck_id` int(11) NOT NULL,
  `card_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;