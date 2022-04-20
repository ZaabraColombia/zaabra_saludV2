##2022-04-12
ALTER TABLE `zaabrac1_zaabra_salud_test`.`citas`
DROP FOREIGN KEY `fk_citas_tipo_cita`;
ALTER TABLE `zaabrac1_zaabra_salud_test`.`citas`
DROP INDEX `fk_citas_tipo_cita_idx` ;

ALTER TABLE `zaabrac1_zaabra_salud_test`.`citas`
    DROP COLUMN `estimado`,
    ADD COLUMN `especialidad_id` INT NULL AFTER `comentario`,
    ADD INDEX `fk_citas_especialidad_idx` (`especialidad_id` ASC);
;
ALTER TABLE `zaabrac1_zaabra_salud_test`.`citas`
    ADD CONSTRAINT `fk_citas_especialidad`
        FOREIGN KEY (`especialidad_id`)
            REFERENCES `zaabrac1_zaabra_salud_test`.`especialidades` (`idEspecialidad`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT;

##2022-04-13
ALTER TABLE `zaabrac1_zaabra_salud_test`.`pago_citas`
    ADD COLUMN `descripcion` TEXT NULL AFTER `tipo`;

ALTER TABLE `zaabrac1_zaabra_salud_test`.`profesionales_instituciones`
    ADD COLUMN `estado` TINYINT(1) NULL DEFAULT 0 AFTER `slug`;

##2022-04-18
ALTER TABLE zaabrac1_zaabra_salud_test.users ADD nombre_completo text GENERATED ALWAYS AS (
    concat(
        primernombre, ' ',
        IF( segundonombre is not null,concat(segundonombre, ' '), ''),
        primerapellido, ' ',
        IF( segundoapellido is not null,concat(segundoapellido, ' '), '')
        )
    ) VIRTUAL AFTER segundoapellido;

ALTER TABLE zaabrac1_zaabra_salud_test.profesionales_instituciones ADD nombre_completo text GENERATED ALWAYS AS (
    concat(
        primer_nombre, ' ',
        IF(segundo_nombre is not null,concat(segundo_nombre, ' '), ''),
        primer_apellido, ' ',
        IF(segundo_apellido is not null,concat(segundo_apellido, ' '), '')
        )
    ) VIRTUAL AFTER segundo_apellido;
###Subido testing
###Subido producción

##2022-04-19
ALTER TABLE `zaabrac1_zaabra_salud_test`.`ventabanners`
ADD COLUMN `ruta_logo` VARCHAR(150) NULL DEFAULT NULL AFTER `rutaImagenVenta`;

## Subido jhon

##2022-04-19
ALTER TABLE `zaabrac1_zaabra_salud_test`.`servicios`
    CHANGE COLUMN `tipo_atencion` `tipo_atencion` ENUM('virtual', 'presencial') NULL DEFAULT NULL ;

##2022-04-20
ALTER TABLE `zaabrac1_zaabra_salud_test`.`atiguedades`
    DROP FOREIGN KEY `fk_atiguedades_profesional_ins_id`;
ALTER TABLE `zaabrac1_zaabra_salud_test`.`atiguedades`
    CHANGE COLUMN `profesional_ins_id` `institucion_id` INT(11) NULL DEFAULT NULL ,
    ADD INDEX `fk_atiguedades_institucion_id_idx` (`institucion_id` ASC),
    DROP INDEX `fk_atiguedades_profesional_ins_id_idx` ;
;
ALTER TABLE `zaabrac1_zaabra_salud_test`.`atiguedades`
    ADD CONSTRAINT `fk_atiguedades_institucion_id`
        FOREIGN KEY (`institucion_id`)
            REFERENCES `zaabrac1_zaabra_salud_test`.`instituciones` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;

