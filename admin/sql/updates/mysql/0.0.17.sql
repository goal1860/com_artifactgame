ALTER TABLE `#__artifactgame_card`
CHANGE COLUMN `sigId` `sigId` INT(11) NOT NULL DEFAULT '0' COMMENT 'referenced to k2item table' ,
ADD COLUMN `sigCardId` INT(11) NOT NULL DEFAULT '0' COMMENT 'referenced to card table.' ;
