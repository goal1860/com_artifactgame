CREATE TABLE `#__artifactgame_cardv2` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `type` VARCHAR(20) NULL,
  `subtype` VARCHAR(20) NULL,
  `color` VARCHAR(10) NULL,
  `rarity` VARCHAR(10) NULL,
  `information` VARCHAR(45) NULL,
  `miniImgUrl` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))ENGINE=InnoDB DEFAULT CHARSET=utf8;
