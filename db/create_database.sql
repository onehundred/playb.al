CREATE SCHEMA IF NOT EXISTS `eindwerk` DEFAULT CHARACTER SET latin1 ;
USE `eindwerk` ;

-- -----------------------------------------------------
-- Table `eindwerk`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `voornaam` VARCHAR(45) NULL DEFAULT NULL ,
  `achternaam` VARCHAR(45) NULL DEFAULT NULL ,
  `land` VARCHAR(45) NULL DEFAULT NULL ,
  `gemeente` VARCHAR(45) NULL DEFAULT NULL ,
  `adres` VARCHAR(100) NULL DEFAULT NULL ,
  `gebruikersnaam` VARCHAR(100) NULL DEFAULT NULL ,
  `paswoord` VARCHAR(100) NULL DEFAULT NULL ,
  `email` VARCHAR(100) NULL DEFAULT NULL ,
  `datum_creatie` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`user_id`) )
ENGINE = MyISAM
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`korf_teams`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`korf_teams` (
  `team_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `startdatum` DATE NULL DEFAULT NULL ,
  `FK_user_id` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`team_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`korf_divisies`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`korf_divisies` (
  `divisie_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `FK_team_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`divisie_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`korf_financien`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`korf_financien` (
  `financien_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `sponsors` INT(11) NULL DEFAULT NULL ,
  `wedstrijdinkomsten` INT(11) NULL DEFAULT NULL ,
  `varia` INT(11) NULL DEFAULT NULL ,
  `FK_team_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`financien_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`korf_spelers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`korf_spelers` (
  `speler_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `voornaam` VARCHAR(45) NULL DEFAULT NULL ,
  `achternaam` VARCHAR(45) NULL DEFAULT NULL ,
  `leeftijd` INT(11) NULL DEFAULT NULL ,
  `ervaring` VARCHAR(45) NULL DEFAULT NULL ,
  `FK_team_id` VARCHAR(45) NULL DEFAULT NULL ,
  `prijs` INT NULL ,
  `uithouding` INT NULL ,
  PRIMARY KEY (`speler_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`korf_stadion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`korf_stadion` (
  `stadion_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `aantal_plaatsen` INT(11) NULL DEFAULT NULL ,
  `FK_team_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`stadion_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`korf_transfers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`korf_transfers` (
  `transfer_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `minimum_bod` INT(11) NULL DEFAULT NULL ,
  `huidig_bod` INT(11) NULL DEFAULT NULL ,
  `deadline` DATETIME NULL DEFAULT NULL ,
  `FK_speler_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`transfer_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`korf_trophies`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`korf_trophies` (
  `trophy_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `datum` VARCHAR(45) NULL DEFAULT NULL ,
  `FK_user_id` INT(11) NULL DEFAULT NULL ,
  `FK_team_id` INT NULL ,
  PRIMARY KEY (`trophy_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`korf_wedstrijden`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`korf_wedstrijden` (
  `wedstrijd_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `verslag` LONGTEXT NULL DEFAULT NULL ,
  `uitslag` VARCHAR(45) NULL DEFAULT NULL ,
  `thuisteam_id` VARCHAR(45) NULL DEFAULT NULL ,
  `bezoekersteam_id` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`wedstrijd_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`vol_teams`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`vol_teams` (
  `team_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `startdatum` DATE NULL DEFAULT NULL ,
  `FK_user_id` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`team_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`vol_spelers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`vol_spelers` (
  `speler_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `voornaam` VARCHAR(45) NULL DEFAULT NULL ,
  `achternaam` VARCHAR(45) NULL DEFAULT NULL ,
  `leeftijd` INT(11) NULL DEFAULT NULL ,
  `ervaring` VARCHAR(45) NULL DEFAULT NULL ,
  `FK_team_id` VARCHAR(45) NULL DEFAULT NULL ,
  `prijs` INT NULL ,
  `uithouding` INT NULL ,
  PRIMARY KEY (`speler_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`vol_stadion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`vol_stadion` (
  `stadion_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `aantal_plaatsen` INT(11) NULL DEFAULT NULL ,
  `FK_team_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`stadion_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`vol_financien`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`vol_financien` (
  `financien_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `sponsors` INT(11) NULL DEFAULT NULL ,
  `wedstrijdinkomsten` INT(11) NULL DEFAULT NULL ,
  `varia` INT(11) NULL DEFAULT NULL ,
  `FK_team_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`financien_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`vol_divisies`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`vol_divisies` (
  `divisie_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `FK_team_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`divisie_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`vol_trophies`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`vol_trophies` (
  `trophy_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `datum` VARCHAR(45) NULL DEFAULT NULL ,
  `FK_user_id` INT(11) NULL DEFAULT NULL ,
  `FK_team_id` INT NULL ,
  PRIMARY KEY (`trophy_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`vol_wedstrijden`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`vol_wedstrijden` (
  `wedstrijd_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `verslag` LONGTEXT NULL DEFAULT NULL ,
  `uitslag` VARCHAR(45) NULL DEFAULT NULL ,
  `thuisteam_id` VARCHAR(45) NULL DEFAULT NULL ,
  `bezoekersteam_id` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`wedstrijd_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`vol_transfers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`vol_transfers` (
  `transfer_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `minimum_bod` INT(11) NULL DEFAULT NULL ,
  `huidig_bod` INT(11) NULL DEFAULT NULL ,
  `deadline` DATETIME NULL DEFAULT NULL ,
  `FK_speler_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`transfer_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`bas_teams`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`bas_teams` (
  `team_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `startdatum` DATE NULL DEFAULT NULL ,
  `FK_user_id` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`team_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`bas_spelers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`bas_spelers` (
  `speler_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `voornaam` VARCHAR(45) NULL DEFAULT NULL ,
  `achternaam` VARCHAR(45) NULL DEFAULT NULL ,
  `leeftijd` INT(11) NULL DEFAULT NULL ,
  `ervaring` VARCHAR(45) NULL DEFAULT NULL ,
  `FK_team_id` VARCHAR(45) NULL DEFAULT NULL ,
  `prijs` INT NULL ,
  `uithouding` INT NULL ,
  PRIMARY KEY (`speler_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`bas_stadion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`bas_stadion` (
  `stadion_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `aantal_plaatsen` INT(11) NULL DEFAULT NULL ,
  `FK_team_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`stadion_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`bas_trophies`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`bas_trophies` (
  `trophy_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `datum` VARCHAR(45) NULL DEFAULT NULL ,
  `FK_user_id` INT(11) NULL DEFAULT NULL ,
  `FK_team_id` INT NULL ,
  PRIMARY KEY (`trophy_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`bas_divisies`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`bas_divisies` (
  `divisie_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(45) NULL DEFAULT NULL ,
  `FK_team_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`divisie_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`bas_financien`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`bas_financien` (
  `financien_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `sponsors` INT(11) NULL DEFAULT NULL ,
  `wedstrijdinkomsten` INT(11) NULL DEFAULT NULL ,
  `varia` INT(11) NULL DEFAULT NULL ,
  `FK_team_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`financien_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`bas_wedstrijden`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`bas_wedstrijden` (
  `wedstrijd_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `verslag` LONGTEXT NULL DEFAULT NULL ,
  `uitslag` VARCHAR(45) NULL DEFAULT NULL ,
  `thuisteam_id` VARCHAR(45) NULL DEFAULT NULL ,
  `bezoekersteam_id` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`wedstrijd_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `eindwerk`.`bas_transfers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eindwerk`.`bas_transfers` (
  `transfer_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `minimum_bod` INT(11) NULL DEFAULT NULL ,
  `huidig_bod` INT(11) NULL DEFAULT NULL ,
  `deadline` DATETIME NULL DEFAULT NULL ,
  `FK_speler_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`transfer_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
