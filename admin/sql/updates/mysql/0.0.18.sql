DROP TABLE IF EXISTS `#__artifactgame_heroskill`;
CREATE TABLE `#__artifactgame_heroskill` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NULL,
  `name` VARCHAR(45) NULL,
  `text` VARCHAR(400) NULL,
  `mini_image` VARCHAR(200) NULL,
  `large_image` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))ENGINE=InnoDB DEFAULT CHARSET=utf8;