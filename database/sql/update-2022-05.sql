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

#Subido test
#Subido production
#Subido jhon 10-05-2022 16:24

ALTER TABLE `zaabrac1_zaabra_salud_test`.`profesionales_instituciones`
    CHANGE COLUMN `telefono` `telefono` VARCHAR(100) NULL DEFAULT NULL ,
    CHANGE COLUMN `celular` `celular` VARCHAR(100) NULL DEFAULT NULL ;

ALTER TABLE `zaabra_salud`.`users`
    CHANGE COLUMN `numerodocumento` `numerodocumento` VARCHAR(100) NULL DEFAULT NULL ;

#Subido cesar
