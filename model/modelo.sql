SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `atom` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `atom` ;

-- -----------------------------------------------------
-- Table `atom`.`municipio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `atom`.`municipio` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `municipio_nombre` VARCHAR(45) NULL ,
  `municipio_departamento` VARCHAR(45) NULL ,
  `municipio_longitud` VARCHAR(45) NULL ,
  `municipio_latitud` VARCHAR(45) NULL ,
  `municipio_categoria` VARCHAR(45) NULL ,
  `municipio_codigo` VARCHAR(45) NULL ,
  `municipio_estado` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `atom`.`indicador`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `atom`.`indicador` (
  `id` INT NOT NULL ,
  `indicador_descripcion` VARCHAR(45) NULL ,
  `indicador_tipo` VARCHAR(45) NULL ,
  `indicador_estado` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `atom`.`indice`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `atom`.`indice` (
  `id` INT NOT NULL ,
  `indice_gestion` VARCHAR(45) NULL ,
  `indice_valor` VARCHAR(45) NULL ,
  `municipio_id` INT NOT NULL ,
  `indicador_id` INT NOT NULL ,
  `indice_estado` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_indice_municipio_idx` (`municipio_id` ASC) ,
  INDEX `fk_indice_indicador1_idx` (`indicador_id` ASC) ,
  CONSTRAINT `fk_indice_municipio`
    FOREIGN KEY (`municipio_id` )
    REFERENCES `atom`.`municipio` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_indice_indicador1`
    FOREIGN KEY (`indicador_id` )
    REFERENCES `atom`.`indicador` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
