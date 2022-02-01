DELETE FROM `language` WHERE `language`.`phrase` = 'add_facebook_app';
DELETE FROM `language` WHERE `language`.`phrase` = 'api_key';
DELETE FROM `language` WHERE `language`.`phrase` = 'secret_key';
DELETE FROM `language` WHERE `language`.`phrase` = 'facebook_api';
DELETE FROM `language` WHERE `language`.`phrase` = 'facebook_login';
DELETE FROM `language` WHERE `language`.`phrase` = 'facebooklogin';
DELETE FROM `sec_menu_item` WHERE `sec_menu_item`.`module` = 'facebooklogin';
ALTER TABLE customer_info
  DROP COLUMN facebook_id;
