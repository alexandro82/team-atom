ALTER TABLE `municipio` CHANGE `municipio_codigo` `municipio_codigo_ine` VARCHAR( 45 ) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NULL DEFAULT NULL ;
ALTER TABLE `municipio` ADD `municipio_codigo_ine_anterior` VARCHAR( 30 ) NOT NULL AFTER `municipio_codigo_ine` ,
ADD `municipio_codigo_economia_finanzas` VARCHAR( 30 ) NOT NULL AFTER `municipio_codigo_ine_anterior` ;