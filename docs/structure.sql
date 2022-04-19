-- MySQL Script generated by MySQL Workbench
-- 01/28/20 15:11:47
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema skoule
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `skoule` ;

-- -----------------------------------------------------
-- Schema skoule
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `skoule` DEFAULT CHARACTER SET utf8 ;
USE `skoule` ;

-- -----------------------------------------------------
-- Table `skoule`.`teacher`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skoule`.`teacher` ;

CREATE TABLE IF NOT EXISTS `skoule`.`teacher` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(64) NULL,
  `lastname` VARCHAR(64) NULL,
  `job` VARCHAR(64) NULL,
  `status` TINYINT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skoule`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skoule`.`student` ;

CREATE TABLE IF NOT EXISTS `skoule`.`student` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(64) NULL,
  `lastname` VARCHAR(64) NULL,
  `status` TINYINT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `teacher_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_student_teacher_idx` (`teacher_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `skoule`.`app_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `skoule`.`app_user` ;

CREATE TABLE IF NOT EXISTS `skoule`.`app_user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(128) NOT NULL,
  `name` VARCHAR(64) NULL,
  `password` VARCHAR(60) NOT NULL,
  `role` ENUM('user', 'admin') NOT NULL,
  `status` TINYINT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;