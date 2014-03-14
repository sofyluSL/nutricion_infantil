SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `institucion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `institucion` ;

CREATE TABLE IF NOT EXISTS `institucion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `correo` VARCHAR(45) NULL,
  `director` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `ninios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ninios` ;

CREATE TABLE IF NOT EXISTS `ninios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(45) NULL,
  `apellidos` VARCHAR(45) NULL,
  `fecha_nacimiento` DATE NULL,
  `edad` INT NULL,
  `representante_nombre` VARCHAR(45) NULL,
  `representante_apellido` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `celular` VARCHAR(45) NULL,
  `correo` VARCHAR(45) NULL,
  `institucion_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_ninios_institucion1`
    FOREIGN KEY (`institucion_id`)
    REFERENCES `institucion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE INDEX `fk_ninios_institucion1_idx` ON `ninios` (`institucion_id` ASC);


-- -----------------------------------------------------
-- Table `ficha_nutricional`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ficha_nutricional` ;

CREATE TABLE IF NOT EXISTS `ficha_nutricional` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ninios_id` INT NOT NULL,
  `fecha_ingreso` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_salida` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` TINYINT(1) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_ficha_nutricional_ninios`
    FOREIGN KEY (`ninios_id`)
    REFERENCES `ninios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_ficha_nutricional_ninios_idx` ON `ficha_nutricional` (`ninios_id` ASC);


-- -----------------------------------------------------
-- Table `datos_antropomorficos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `datos_antropomorficos` ;

CREATE TABLE IF NOT EXISTS `datos_antropomorficos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ninios_id` INT NOT NULL,
  `fecha` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `talla` DECIMAL(3,2) NULL,
  `peso` DECIMAL(5,2) NULL,
  `genero` CHAR(1) NOT NULL,
  `imc` DECIMAL(5,2) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_datos_antropomorficos_ninios1`
    FOREIGN KEY (`ninios_id`)
    REFERENCES `ninios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_datos_antropomorficos_ninios1_idx` ON `datos_antropomorficos` (`ninios_id` ASC);


-- -----------------------------------------------------
-- Table `patologias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `patologias` ;

CREATE TABLE IF NOT EXISTS `patologias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ninios_id` INT NOT NULL,
  `pregunta1` VARCHAR(45) NULL,
  `pregunta2` VARCHAR(45) NULL,
  `pregunta3` VARCHAR(45) NULL,
  `pregunta4` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_patologias_ninios1`
    FOREIGN KEY (`ninios_id`)
    REFERENCES `ninios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_patologias_ninios1_idx` ON `patologias` (`ninios_id` ASC);


-- -----------------------------------------------------
-- Table `categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `categoria` ;

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `alimentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `alimentos` ;

CREATE TABLE IF NOT EXISTS `alimentos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `categoria_id` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_alimentos_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_alimentos_categoria1_idx` ON `alimentos` (`categoria_id` ASC);


-- -----------------------------------------------------
-- Table `subcategoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subcategoria` ;

CREATE TABLE IF NOT EXISTS `subcategoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `categoria_id` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_subcategoria_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_subcategoria_categoria1_idx` ON `subcategoria` (`categoria_id` ASC);


-- -----------------------------------------------------
-- Table `valores_nutricionales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `valores_nutricionales` ;

CREATE TABLE IF NOT EXISTS `valores_nutricionales` (
  `id` INT NOT NULL,
  `porcentaje_agua` DECIMAL(5,2) NULL,
  `agua_g` DECIMAL(5,2) NULL,
  `energia_kcal` DECIMAL(5,2) NULL,
  `proteinas_g` DECIMAL(4,2) NULL,
  `grasa_total_g` DECIMAL(5,2) NULL,
  `carbohidratos_g` DECIMAL(5,2) NULL,
  `fibra_dietetica_g` DECIMAL(4,2) NULL,
  `fibra_cruda_g` DECIMAL(4,2) NULL,
  `fibra_dietaria_g` DECIMAL(4,2) NULL,
  `ceniza_g` DECIMAL(4,2) NULL,
  `calcio_mg` DECIMAL(5,2) NULL,
  `fosforo_mg` DECIMAL(5,2) NULL,
  `hierro_mg` DECIMAL(4,2) NULL,
  `tiamina_mg` DECIMAL(3,2) NULL,
  `riboflavina_mg` DECIMAL(3,2) NULL,
  `niacina_mg` DECIMAL(4,2) NULL,
  `vitamina_c_mg` DECIMAL(4,2) NULL,
  `vitamina_a_eqiv_retinol_mcg` DECIMAL(5,2) NULL,
  `acidos_grasos_monoinsat_g` DECIMAL(4,2) NULL,
  `acidos_grasos_poliinsaturad_g` DECIMAL(4,2) NULL,
  `acidos_grasos_saturados_g` DECIMAL(4,2) NULL,
  `colesterol_mg` DECIMAL(5,2) NULL,
  `potasio_mg` DECIMAL(6,2) NULL,
  `sodio_mg` DECIMAL(5,2) NULL,
  `zinc_mg` DECIMAL(4,2) NULL,
  `magnesio_mg` DECIMAL(5,2) NULL,
  `vitamina_b6_mg` DECIMAL(4,2) NULL,
  `vitamina_b12_mcg` DECIMAL(4,2) NULL,
  `folato_mcg` DECIMAL(4,2) NULL,
  `porcentaje_fracc_comestible` DECIMAL(5,2) NULL,
  `b_caroteno_equiv_totales_ug` DECIMAL(5,2) NULL,
  `retinol_ug` DECIMAL(6,2) NULL,
  `asct_mg` DECIMAL(3,2) NULL,
  `ch2o_g` DECIMAL(5,2) NULL,
  `equivalentes_totales` VARCHAR(45) NULL,
  `alimentos_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_valores_nutricionales_alimentos1`
    FOREIGN KEY (`alimentos_id`)
    REFERENCES `alimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_valores_nutricionales_alimentos1_idx` ON `valores_nutricionales` (`alimentos_id` ASC);


-- -----------------------------------------------------
-- Table `tipo_menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tipo_menu` ;

CREATE TABLE IF NOT EXISTS `tipo_menu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menu` ;

CREATE TABLE IF NOT EXISTS `menu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  `tipo_menu_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_menu_tipo_menu1`
    FOREIGN KEY (`tipo_menu_id`)
    REFERENCES `tipo_menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_menu_tipo_menu1_idx` ON `menu` (`tipo_menu_id` ASC);


-- -----------------------------------------------------
-- Table `menu_ninio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menu_ninio` ;

CREATE TABLE IF NOT EXISTS `menu_ninio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `menu_id` INT NOT NULL,
  `ninios_id` INT NOT NULL,
  `fecha_ingesta` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `observaciones` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_menu_ninio_menu1`
    FOREIGN KEY (`menu_id`)
    REFERENCES `menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_ninio_ninios1`
    FOREIGN KEY (`ninios_id`)
    REFERENCES `ninios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_menu_ninio_menu1_idx` ON `menu_ninio` (`menu_id` ASC);

CREATE INDEX `fk_menu_ninio_ninios1_idx` ON `menu_ninio` (`ninios_id` ASC);


-- -----------------------------------------------------
-- Table `porcion_personal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `porcion_personal` ;

CREATE TABLE IF NOT EXISTS `porcion_personal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cantidad g/cc` VARCHAR(10) NULL,
  `medida_cacera` VARCHAR(10) NULL,
  `alimentos_id` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_porcion_personal_alimentos1`
    FOREIGN KEY (`alimentos_id`)
    REFERENCES `alimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_porcion_personal_alimentos1_idx` ON `porcion_personal` (`alimentos_id` ASC);


-- -----------------------------------------------------
-- Table `porciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `porciones` ;

CREATE TABLE IF NOT EXISTS `porciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero_personas` INT NULL,
  `porcion_personal_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_porciones_porcion_personal1`
    FOREIGN KEY (`porcion_personal_id`)
    REFERENCES `porcion_personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_porciones_porcion_personal1_idx` ON `porciones` (`porcion_personal_id` ASC);


-- -----------------------------------------------------
-- Table `plato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plato` ;

CREATE TABLE IF NOT EXISTS `plato` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_plato` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plato_alimentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plato_alimentos` ;

CREATE TABLE IF NOT EXISTS `plato_alimentos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `plato_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_ingrediente_plato_plato1`
    FOREIGN KEY (`plato_id`)
    REFERENCES `plato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_ingrediente_plato_plato1_idx` ON `plato_alimentos` (`plato_id` ASC);


-- -----------------------------------------------------
-- Table `menu_alimentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menu_alimentos` ;

CREATE TABLE IF NOT EXISTS `menu_alimentos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `menu_id` INT NOT NULL,
  `alimentos_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_menu_has_alimentos_menu1`
    FOREIGN KEY (`menu_id`)
    REFERENCES `menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_has_alimentos_alimentos1`
    FOREIGN KEY (`alimentos_id`)
    REFERENCES `alimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_menu_has_alimentos_alimentos1_idx` ON `menu_alimentos` (`alimentos_id` ASC);

CREATE INDEX `fk_menu_has_alimentos_menu1_idx` ON `menu_alimentos` (`menu_id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
