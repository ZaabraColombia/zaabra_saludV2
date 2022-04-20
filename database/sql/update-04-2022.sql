##2022-04-12
ALTER TABLE `zaabrac1_zaabra_salud`.`citas`
DROP FOREIGN KEY `fk_citas_tipo_cita`;
ALTER TABLE `zaabrac1_zaabra_salud`.`citas`
DROP INDEX `fk_citas_tipo_cita_idx` ;

ALTER TABLE `zaabrac1_zaabra_salud`.`citas`
    DROP COLUMN `estimado`,
    ADD COLUMN `especialidad_id` INT NULL AFTER `comentario`,
    ADD INDEX `fk_citas_especialidad_idx` (`especialidad_id` ASC);
;
ALTER TABLE `zaabrac1_zaabra_salud`.`citas`
    ADD CONSTRAINT `fk_citas_especialidad`
        FOREIGN KEY (`especialidad_id`)
            REFERENCES `zaabrac1_zaabra_salud`.`especialidades` (`idEspecialidad`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT;

##2022-04-13
ALTER TABLE `zaabrac1_zaabra_salud`.`pago_citas`
    ADD COLUMN `descripcion` TEXT NULL AFTER `tipo`;

ALTER TABLE `zaabrac1_zaabra_salud`.`profesionales_instituciones`
    ADD COLUMN `estado` TINYINT(1) NULL DEFAULT 0 AFTER `slug`;

## Subido jhonf 18/04/2022

##2022-04-18
ALTER TABLE zaabrac1_zaabra_salud.users ADD nombre_completo text GENERATED ALWAYS AS (
    concat(
        primernombre, ' ',
        IF( segundonombre is not null,concat(segundonombre, ' '), ''),
        primerapellido, ' ',
        IF( segundoapellido is not null,concat(segundoapellido, ' '), '')
        )
    ) VIRTUAL AFTER segundoapellido;

ALTER TABLE zaabrac1_zaabra_salud.profesionales_instituciones ADD nombre_completo text GENERATED ALWAYS AS (
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
ALTER TABLE `zaabra_salud`.`ventabanners` 
ADD COLUMN `ruta_logo` VARCHAR(150) NULL DEFAULT NULL AFTER `rutaImagenVenta`;

