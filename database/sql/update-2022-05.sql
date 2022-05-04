ALTER TABLE `zaabrac1_zaabra_salud_test`.`horarios`
DROP COLUMN `descanso`,
DROP COLUMN `duracion`,
ADD COLUMN `color_cita_pagada` VARCHAR(10) NULL AFTER `horario`,
ADD COLUMN `color_cita_presencial` VARCHAR(10) NULL AFTER `color_cita_pagada`,
ADD COLUMN `color_cita_agendada` VARCHAR(10) NULL AFTER `color_cita_precencial`,
ADD COLUMN `color_cita_cancelada` VARCHAR(10) NULL AFTER `color_cita_agendada`,
ADD COLUMN `color_bloqueado` VARCHAR(10) NULL AFTER `color_cita_cancelada`,
ADD COLUMN `dias_agenda` int(11) NULL AFTER `color_bloqueado`;

#Subido cesar
