DROP TABLE IF EXISTS `#__artifactgame_upvotes`;
CREATE TABLE `#__artifactgame_upvotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deck_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
