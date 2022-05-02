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

ALTER TABLE `zaabrac1_zaabra_salud_test`.`ventabanners`
ADD COLUMN `ruta_logo` VARCHAR(150) NULL DEFAULT NULL AFTER `rutaImagenVenta`;

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


alter table zaabrac1_zaabra_salud_test.ventabanners add column orden int null after aprobado;

### 22/04/2022 jhonf

ALTER TABLE `zaabrac1_zaabra_salud_test`.`profesionales_instituciones`
    ADD COLUMN `correo_verified_at` TIMESTAMP NULL DEFAULT NULL AFTER `estado`,
    ADD COLUMN `password` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL AFTER `correo_verified_at`,
    ADD COLUMN `remember_token` VARCHAR(100) NULL DEFAULT NULL AFTER `password`;

### Subido testing
### Subido producción
ALTER TABLE `zaabrac1_zaabra_salud_test`.`users`
    DROP COLUMN `nombre_completo`;

ALTER TABLE `zaabrac1_zaabra_salud_test`.`users`
    ADD COLUMN `profesional_id` INT NULL AFTER `institucion_id`,
    ADD INDEX `fk_users_profesiocal_idx` (`profesional_id` ASC);
;
ALTER TABLE `zaabrac1_zaabra_salud_test`.`users`
    ADD CONSTRAINT `fk_users_profesional`
        FOREIGN KEY (`profesional_id`)
            REFERENCES `zaabrac1_zaabra_salud_test`.`perfilesprofesionales` (`idPerfilProfesional`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT;


ALTER TABLE `zaabrac1_zaabra_salud_test`.`users`
    ADD COLUMN `nombre_completo` TEXT GENERATED ALWAYS AS (concat(
        if((`primernombre` is not null),concat(`primernombre`,' '),''),
        if((`segundonombre` is not null),concat(`segundonombre`,' '),''),
        if((`primerapellido` is not null),concat(`primerapellido`,' '),''),
        if((`segundoapellido` is not null),concat(`segundoapellido`,' '),''))) VIRTUAL null AFTER `segundoapellido`;

ALTER TABLE `zaabrac1_zaabra_salud_test`.`servicios`
    ADD COLUMN `profesional_id` INT(11) NULL AFTER `institucion_id`,
    ADD INDEX `fk_servicio_profesional_idx` (`profesional_id` ASC);
;
ALTER TABLE `zaabrac1_zaabra_salud_test`.`servicios`
    ADD CONSTRAINT `fk_servicio_profesional`
        FOREIGN KEY (`profesional_id`)
            REFERENCES `zaabrac1_zaabra_salud_test`.`perfilesprofesionales` (`idPerfilProfesional`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT;

### Subido cesar




### Sentencia para la creación de la tabla banner_plantilla 02/05/2022 jhonf
create table zaabra_salud.banner_plantillas (
id int auto_increment primary key,
nombre varchar (50)
);

insert into zaabra_salud.banner_plantillas (nombre)
values
('banner_corto'), ('banner_mediano'), ('banner_largo');

## Sentencia para adicionar la nueva columna banner_plantilla_id 02/05/2022 jhonf

alter table zaabra_salud.ventabanners add banner_plantilla_id int;

### Subido a jhonf
