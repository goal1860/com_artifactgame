DROP TABLE IF EXISTS `#__artifactgame_card`;
CREATE TABLE `#__artifactgame_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jid` int(10) unsigned DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `subtype` varchar(15) DEFAULT NULL,
  `rarity` varchar(10) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `revealed` tinyint(3) unsigned DEFAULT '1',
  `attack` int(10) unsigned DEFAULT '0',
  `armor` int(10) DEFAULT '0',
  `health` int(10) unsigned DEFAULT '0',
  `mana` int(10) unsigned DEFAULT '0',
  `gold` int(10) unsigned DEFAULT '0',
  `skills` varchar(250) DEFAULT NULL,
  `effect` varchar(400) DEFAULT NULL,
  `effectType` varchar(25) DEFAULT NULL,
  `sigCard` varchar(60) DEFAULT NULL,
  `sigOf` varchar(60) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jid_UNIQUE` (`jid`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

