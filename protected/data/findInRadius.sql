SELECT `t`.`id` AS `t0_c0`, `t`.`user_id` AS `t0_c1`, `t`.`make_id` AS `t0_c2`, `t`.`category_id` AS `t0_c3`, `t`.`vehicle_type_id` AS `t0_c4`, `t`.`model_id` AS `t0_c5`, `t`.`body_type_id` AS `t0_c6`, `t`.`bearing_capacity` AS `t0_c7`, `t`.`body_capacity` AS `t0_c8`, `t`.`license_plate` AS `t0_c9`, `t`.`number_trailer` AS `t0_c10`, `t`.`number_semitrailer` AS `t0_c11`, `t`.`is_deleted` AS `t0_c12`, `t`.`is_verification` AS `t0_c13`, `t`.`permissions` AS `t0_c14`, `t`.`shipments` AS `t0_c15`, `t`.`adr` AS `t0_c16`, `t`.`date_from` AS `t0_c17`, `t`.`date_to` AS `t0_c18`, `t`.`country_id` AS `t0_c19`, `t`.`region_id` AS `t0_c20`, `t`.`city_id` AS `t0_c21`, `t`.`country_id_to` AS `t0_c22`, `t`.`region_id_to` AS `t0_c23`, `t`.`city_id_to` AS `t0_c24`, `t`.`created_at` AS `t0_c25`, `t`.`updated_at` AS `t0_c26`, `t`.`slug` AS `t0_c27`, (SELECT GROUP_CONCAT(shipment.name_ru SEPARATOR ", ") FROM shipment WHERE FIND_IN_SET(shipment.id, t.shipments) > 0) as shipmentsNames, `user`.`id` AS `t1_c0`, `user`.`email` AS `t1_c1`, `user`.`username` AS `t1_c2`, `user`.`password` AS `t1_c3`, `user`.`logins` AS `t1_c4`, `user`.`last_login` AS `t1_c5`, `user`.`code` AS `t1_c6`, `user`.`enabled` AS `t1_c7`, `user`.`balance` AS `t1_c8`, `profiles`.`id` AS `t2_c0`, `profiles`.`user_id` AS `t2_c1`, `profiles`.`last_name` AS `t2_c2`, `profiles`.`first_name` AS `t2_c3`, `profiles`.`middle_name` AS `t2_c4`, `profiles`.`mobile` AS `t2_c5`, `profiles`.`country_id` AS `t2_c6`, `profiles`.`region_id` AS `t2_c7`, `profiles`.`city_id` AS `t2_c8`, `profiles`.`address` AS `t2_c9`, `profiles`.`phone` AS `t2_c10`, `profiles`.`skype` AS `t2_c11`, `profiles`.`icq` AS `t2_c12`, `profiles`.`rating` AS `t2_c13`, `profiles`.`avatar` AS `t2_c14`, `profiles`.`user_type_id` AS `t2_c15`, `profiles`.`created_at` AS `t2_c16`, `profiles`.`updated_at` AS `t2_c17` 
FROM `vehicle` `t` 
LEFT OUTER JOIN `users` `user` ON (`t`.`user_id`=`user`.`id`) 
LEFT OUTER JOIN `profiles` `profiles` ON (`profiles`.`user_id`=`user`.`id`) 
WHERE (t.user_id <> 10041 
AND NOT ((1375822800 < t.date_from AND 1376427600 < t.date_from) OR (1375822800 > t.date_to AND 1376427600 < t.date_to)) 
AND date_to >= 1375893574 
AND (FIND_IN_SET(3, t.shipments) > 0) 
AND (FIND_IN_SET(t.body_type_id, "3") > 0) 
AND (4<= t.bearing_capacity OR (4 = 0 AND (0 <= t.bearing_capacity OR 4 <= t.bearing_capacity))) 
AND (16 <= t.body_capacity OR (16 = 0 AND (0 <= t.body_capacity OR 16 <= t.body_capacity))) 
AND (t.city_id IN (CASE
WHEN t.country_id IS NULL THEN (SELECT id FROM city)
WHEN t.region_id IS NULL THEN (SELECT id FROM city WHERE t.country_id = 248)
WHEN t.city_id IS NULL THEN (SELECT id FROM city WHERE t.country_id = 248 AND t.region_id = 349)
ELSE ( SELECT id
FROM city WHERE (6371 * acos( cos( radians(53.8829002380371) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(27.717399597168) ) + sin( radians(53.8829002380371) ) * sin( radians( latitude ) ) ) ) < 60) ) 
AND t.city_id_to IN (CASE
WHEN t.country_id_to IS NULL THEN (SELECT id FROM city)
WHEN t.region_id_to IS NULL THEN (SELECT id FROM city WHERE t.country_id_to = 248)
WHEN t.city_id_to IS NULL THEN (SELECT id FROM city WHERE t.country_id_to = 248 AND t.region_id_to = 349)
ELSE ( SELECT id
FROM city WHERE (6371 * acos( cos( radians(54.2211990356445) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(28.5128993988037) ) + sin( radians(54.2211990356445) ) * sin( radians( latitude ) ) ) ) < 60) )) AND is_deleted = 0) ORDER BY t.updated_at DESC LIMIT 10 