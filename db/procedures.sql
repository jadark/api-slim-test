DROP PROCEDURE IF EXISTS `getCategories`;
DELIMITER //
CREATE PROCEDURE getCategories()
BEGIN
  select idm,nombre,descripcion,imagen from at_categoria_music;
END 
//DELIMITER ;


DROP PROCEDURE IF EXISTS `getCategory`;
DELIMITER //
CREATE PROCEDURE getCategory(
	IN _idm varchar(11)
)
BEGIN
  SELECT * FROM at_categoria_music WHERE idm=_idm;
END 
//DELIMITER ;


DROP PROCEDURE IF EXISTS `getAlbumsbyCategory`;
DELIMITER //
CREATE PROCEDURE getAlbumsbyCategory(
	IN _categorias TEXT
)
BEGIN
	SELECT * FROM at_album WHERE categorias= _categorias COLLATE utf8_unicode_ci;
END 
//DELIMITER ;

DROP PROCEDURE IF EXISTS `get_data`;
DELIMITER //
CREATE PROCEDURE get_data(IN _idm varchar(11))
BEGIN
	SELECT nombre FROM at_categoria_music WHERE idm = _idm
    UNION ALL
	SELECT nombre FROM at_album WHERE categorias = _idm COLLATE utf8_unicode_ci;
END 
//DELIMITER ;
