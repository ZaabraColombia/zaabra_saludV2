ALTER TABLE `zaabrac1_zaabra_salud_test`.`horarios`
    DROP COLUMN `descanso`,
    DROP COLUMN `duracion`,
    ADD COLUMN `color_cita_pagada` VARCHAR(10) NULL AFTER `horario`,
    ADD COLUMN `color_cita_presencial` VARCHAR(10) NULL AFTER `color_cita_pagada`,
    ADD COLUMN `color_cita_agendada` VARCHAR(10) NULL AFTER `color_cita_presencial`,
    ADD COLUMN `color_cita_cancelada` VARCHAR(10) NULL AFTER `color_cita_agendada`,
    ADD COLUMN `color_bloqueado` VARCHAR(10) NULL AFTER `color_cita_cancelada`,
    ADD COLUMN `dias_agenda` int(11) NULL AFTER `color_bloqueado`;

ALTER TABLE `zaabrac1_zaabra_salud_test`.`citas`
    ADD COLUMN `convenio_id` INT NULL AFTER `tipo_cita_id`,
    ADD INDEX `fk_citas_convenios_idx` (`convenio_id` ASC);
;
ALTER TABLE `zaabrac1_zaabra_salud_test`.`citas`
    ADD CONSTRAINT `fk_citas_convenios`
        FOREIGN KEY (`convenio_id`)
            REFERENCES `zaabrac1_zaabra_salud_test`.`convenios` (`id`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT;
#Subido jhon 10-05-2022 16:24

ALTER TABLE `zaabrac1_zaabra_salud_test`.`profesionales_instituciones`
    CHANGE COLUMN `telefono` `telefono` VARCHAR(100) NULL DEFAULT NULL ,
    CHANGE COLUMN `celular` `celular` VARCHAR(100) NULL DEFAULT NULL ;

ALTER TABLE `zaabrac1_zaabra_salud_test`.`users`
    CHANGE COLUMN `numerodocumento` `numerodocumento` VARCHAR(100) NULL DEFAULT NULL ;

ALTER TABLE `zaabrac1_zaabra_salud_test`.`auxiliares`
    ADD COLUMN `cargo` VARCHAR(50) NULL AFTER `celular`;

#Subido jhon 16-05-2022 12:19

CREATE TABLE `zaabrac1_zaabra_salud_test`.`paises`
(
    `code` VARCHAR(3) NOT NULL,
    `nombre` VARCHAR(100) NULL,
    PRIMARY KEY (`code`)
);

CREATE TABLE `zaabrac1_zaabra_salud_test`.`regiones`
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NULL,
    `pais_code` VARCHAR(3) NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_region_pais`
        FOREIGN KEY (pais_code)
            REFERENCES `zaabrac1_zaabra_salud_test`.`paises` (code)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT
);

CREATE TABLE `zaabrac1_zaabra_salud_test`.`ciudades`
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NULL,
    `latitud` VARCHAR(100) NULL,
    `longitud` VARCHAR(100) NULL,
    `region_id` INT(11) NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_ciudad_region_idx` (`region_id` ASC),
    CONSTRAINT `fk_ciudad_region`
        FOREIGN KEY (`region_id`)
            REFERENCES `zaabrac1_zaabra_salud_test`.`regiones` (`id`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT);

ALTER TABLE `zaabrac1_zaabra_salud_test`.`pago_citas`
    CHANGE COLUMN `fecha` `fecha` DATETIME NULL DEFAULT NULL ,
    CHANGE COLUMN `vencimiento` `vencimiento` DATETIME NULL DEFAULT NULL ;


#Subido cesar
#Subido test
#Subido production
#Subido jhon f 23/05/2022 08:41
