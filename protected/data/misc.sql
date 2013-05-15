ALTER TABLE `vehicle` ADD `date_from` INT NULL AFTER `adr` , ADD INDEX ( `date_from` );
ALTER TABLE `vehicle` ADD `date_to` INT NULL AFTER `date_from` , ADD INDEX ( `date_to` );
ALTER TABLE `vehicle` ADD `country_id_to` INT NULL AFTER `city_id` ,
ADD INDEX ( `country_id_to` );
ALTER TABLE `vehicle` ADD `region_id_to` INT NULL AFTER `country_id_to` ,
ADD INDEX ( `region_id_to` );
ALTER TABLE `vehicle` ADD `city_id_to` INT NULL AFTER `region_id_to` ,
ADD INDEX ( `city_id_to` );
ALTER TABLE `vehicle` CHANGE `country_id_to` `country_id_to` INT( 11 ) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `vehicle` CHANGE `region_id_to` `region_id_to` INT( 11 ) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `vehicle` CHANGE `city_id_to` `city_id_to` INT( 11 ) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `vehicle` ADD FOREIGN KEY ( `country_id_to` ) REFERENCES `host5841_gruz`.`country` (
`id`
) ON DELETE SET NULL ON UPDATE RESTRICT;

ALTER TABLE `vehicle` ADD FOREIGN KEY ( `region_id_to` ) REFERENCES `host5841_gruz`.`region` (
`id`
) ON DELETE SET NULL ON UPDATE RESTRICT;
ALTER TABLE `vehicle` ADD FOREIGN KEY ( `city_id_to` ) REFERENCES `host5841_gruz`.`city` (
`id`
) ON DELETE SET NULL ON UPDATE RESTRICT;