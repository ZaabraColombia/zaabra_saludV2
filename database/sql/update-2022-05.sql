ALTER TABLE `zaabrac1_zaabra_salud_test`.`horarios`
DROP
COLUMN `descanso`,
    DROP
COLUMN `duracion`,
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
    CHANGE COLUMN `telefono` `telefono` VARCHAR (100) NULL DEFAULT NULL,
    CHANGE COLUMN `celular` `celular` VARCHAR (100) NULL DEFAULT NULL;

ALTER TABLE `zaabrac1_zaabra_salud_test`.`users`
    CHANGE COLUMN `numerodocumento` `numerodocumento` VARCHAR (100) NULL DEFAULT NULL;

ALTER TABLE `zaabrac1_zaabra_salud_test`.`auxiliares`
    ADD COLUMN `cargo` VARCHAR(50) NULL AFTER `celular`;

#Subido jhon 16-05-2022 12:19

CREATE TABLE `zaabrac1_zaabra_salud_test`.`paises`
(
    `code`   VARCHAR(3) NOT NULL,
    `nombre` VARCHAR(100) NULL,
    PRIMARY KEY (`code`)
);

CREATE TABLE `zaabrac1_zaabra_salud_test`.`regiones`
(
    `id`        INT NOT NULL AUTO_INCREMENT,
    `nombre`    VARCHAR(100) NULL,
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
    `id`        INT NOT NULL AUTO_INCREMENT,
    `nombre`    VARCHAR(100) NULL,
    `latitud`   VARCHAR(100) NULL,
    `longitud`  VARCHAR(100) NULL,
    `region_id` INT(11) NULL,
    PRIMARY KEY (`id`),
    INDEX       `fk_ciudad_region_idx` (`region_id` ASC),
    CONSTRAINT `fk_ciudad_region`
        FOREIGN KEY (`region_id`)
            REFERENCES `zaabrac1_zaabra_salud_test`.`regiones` (`id`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT
);

ALTER TABLE `zaabrac1_zaabra_salud_test`.`pago_citas`
    CHANGE COLUMN `fecha` `fecha` DATETIME NULL DEFAULT NULL,
    CHANGE COLUMN `vencimiento` `vencimiento` DATETIME NULL DEFAULT NULL;

#Subido test
#Subido production
#Subido jhon f 23/05/2022 08:41
CREATE TABLE `zaabrac1_zaabra_salud_test`.`rutas`
(
    `id`     INT NOT NULL AUTO_INCREMENT,
    `titulo` VARCHAR(45) NULL,
    `url`    VARCHAR(45) NULL,
    `name`   VARCHAR(45) NULL,
    `slug`   VARCHAR(45) NULL,
    `tipo`   ENUM('paciente', 'profesional', 'institucion') NULL,
    PRIMARY KEY (`id`)
);

insert into zaabrac1_zaabra_salud_test.rutas (titulo, url, name, tipo, slug)
    value ('Perfil', '/FormularioInstitucion', 'entidad.FormularioInstitucion', 'institucion', 'perfil'),
    ('Histórico de citas', '/institucion/citas', 'institucion.citas', 'institucion', 'ver-citas'),
    ('Pagos', '/institucion/pagos', 'institucion.pagos', 'institucion', 'ver-pagos'),
    ('Cie10', '/institucion/cie10', 'institucion.catalogos.cie10', 'institucion', 'ver-catalogos'),
    ('Cups', '/institucion/cups', 'institucion.catalogos.cups', 'institucion', 'ver-catalogos'),
    ('Cums', '/institucion/cums', 'institucion.catalogos.cums', 'institucion', 'ver-catalogos'),
    ('Favoritos', '/institucion/favoritos', 'institucion.favoritos', 'institucion', 'favoritos'),
    ('Pacientes', '/institucion/pacientes', 'institucion.pacientes', 'institucion', 'ver-pacientes'),
    ('Contactos', '/institucion/contactos', 'institucion.contactos.index', 'institucion', 'ver-contactos'),
    ('Profesionales', '/institucion/profesionales', 'institucion.profesionales.index', 'institucion', 'ver-profesionales'),
    ('Crear profesional', '/institucion/profesionales/create', 'institucion.profesionales.create', 'institucion', 'agregar-profesional'),
    ('Convenios', '/institucion/configuracion/convenios', 'institucion.configuracion.convenios.index', 'institucion', 'ver-convenios'),
    ('Crear Convenio', '/institucion/configuracion/convenios/create', 'institucion.configuracion.convenios.create', 'institucion', 'agregar-convenio'),
    ('Servicios', '/institucion/configuracion/servicios', 'institucion.configuracion.servicios.index', 'institucion', 'ver-servicios'),
    ('Crear Servicio', '/institucion/configuracion/servicios/create', 'institucion.configuracion.servicios.create', 'institucion', 'agregar-servicio'),
    ('Usuario', '/institucion/configuracion/usuarios', 'institucion.configuracion.usuarios.index', 'institucion', 'ver-usuarios'),
    ('Crear Usuarios', '/institucion/configuracion/usuarios/create', 'institucion.configuracion.usuarios.create', 'institucion', 'agregar-usuario'),
    ('Administración de citas', '/institucion/calendario/citas', 'institucion.calendario.citas', 'institucion', 'administracion-citas'),
    ('Crear una cita', '/institucion/calendario/crear-cita', 'institucion.calendario.crear-cita', 'institucion', 'agregar-cita');

INSERT INTO `zaabrac1_zaabra_salud_test`.`accesos` (`nombre`, `slug`, `tipo`)
    VALUES ('Administrar citas', 'administracion-citas', 'institucion'),
           ('Crear cita', 'agregar-cita', 'institucion');



#Subido cesar
