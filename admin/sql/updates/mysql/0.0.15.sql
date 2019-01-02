ALTER TABLE `#__artifactgame_card`
ADD COLUMN `sigId` INT NOT NULL DEFAULT 0 AFTER `update_time`,
ADD COLUMN `sigMana` INT NOT NULL DEFAULT 0 AFTER `sigId`;
