CREATE TABLE `#__artifactgame_pphistory` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `points` INT NOT NULL,
  `description` VARCHAR(100) NULL,
  `datetime` DATETIME NULL,
  PRIMARY KEY (`id`))ENGINE=InnoDB DEFAULT CHARSET=utf8;