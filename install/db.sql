-- tabla imagenes ---
CREATE TABLE IF NOT EXISTS imagenes (
	id_img int(11) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	img varchar(255) NOT NULL,
	res varchar(255) NOT NULL,
	thn varchar(255) NOT NULL,
	user_id varchar(255) NOT NULL,
	modo enum('publica','privada') NOT NULL DEFAULT 'publica',
	status enum('normal','eliminada') NOT NULL DEFAULT 'normal',
	fecha int(11),
	PRIMARY KEY (id_img)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- Tabla datos de imagenes ---
CREATE TABLE IF NOT EXISTS datosimagen(
	id_dato int(11) NOT NULL AUTO_INCREMENT,
	id_imagen int(11) NOT NULL,
	tipo varchar(4) NOT NULL,
	size varchar(200) NOT NULL,
	width int(11) NOT NULL,
	height int(11) NOT NULL,
	height_res int(11) NOT NULL,
	pais varchar(155) NOT NULL,
	PRIMARY KEY (id_dato)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- tabla Favoritos ---
CREATE TABLE IF NOT EXISTS favs(
	id_fav int(11) NOT NULL AUTO_INCREMENT,
	img varchar(60) NOT NULL,
	user_id varchar(255) NOT NULL,
	fecha int(11) NOT NULL,
	PRIMARY KEY (id_fav)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- tabla Usuarios ---
CREATE TABLE IF NOT EXISTS usuarios(
	id_user int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(11) NOT NULL,
	usuario varchar(16) NOT NULL,
	pass varchar(50) NOT NULL,
	correo varchar(200) NOT NULL,
	status enum('Inactivo','Activo','Eliminado') NOT NULL DEFAULT 'Inactivo',
	rango enum('Normal','Moderador','Admin') NOT NULL DEFAULT 'Normal',
	registro int(11) NOT NULL,
	pais varchar(255) NOT NULL,
	ip varchar(100) NOT NULL,
	PRIMARY KEY (id_user)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- Dominios --
CREATE TABLE IF NOT EXISTS dominios (
  id int(11) NOT NULL AUTO_INCREMENT,
  pais varchar(100) DEFAULT NULL,
  dominio varchar(10) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `dominios`
-- 

INSERT INTO `dominios` VALUES (1, 'Afganistán', 'af');
INSERT INTO `dominios` VALUES (2, 'Algeria', 'dz');
INSERT INTO `dominios` VALUES (3, 'Andorra', 'ad');
INSERT INTO `dominios` VALUES (4, 'Aguilla', 'al');
INSERT INTO `dominios` VALUES (5, 'Antigua and Bermuda', 'ag');
INSERT INTO `dominios` VALUES (6, 'Armenia', 'am');
INSERT INTO `dominios` VALUES (7, 'Australia', 'au');
INSERT INTO `dominios` VALUES (8, 'Azerbaijan', 'az');
INSERT INTO `dominios` VALUES (9, 'Bahrain', 'bh');
INSERT INTO `dominios` VALUES (10, 'Barbados', 'bb');
INSERT INTO `dominios` VALUES (11, 'Begium', 'be');
INSERT INTO `dominios` VALUES (12, 'Benin', 'bj');
INSERT INTO `dominios` VALUES (13, 'Bhutan', 'bt');
INSERT INTO `dominios` VALUES (14, 'Bosnia-Herzegovina', 'ba');
INSERT INTO `dominios` VALUES (15, 'Bouvet Island', 'bv');
INSERT INTO `dominios` VALUES (16, 'British Indian Ocean Territory', 'io');
INSERT INTO `dominios` VALUES (17, 'Bulgaria', 'bg');
INSERT INTO `dominios` VALUES (18, 'Burundi', 'bi');
INSERT INTO `dominios` VALUES (19, 'Camerun', 'cm');
INSERT INTO `dominios` VALUES (20, 'Cape Verde', 'cv');
INSERT INTO `dominios` VALUES (21, 'República Central de Africa', 'cf');
INSERT INTO `dominios` VALUES (22, 'Chile', 'cl');
INSERT INTO `dominios` VALUES (23, 'Christmas Island', 'cx');
INSERT INTO `dominios` VALUES (24, 'Colombia', 'co');
INSERT INTO `dominios` VALUES (25, 'Congo', 'cg');
INSERT INTO `dominios` VALUES (26, 'Costa Rica', 'cr');
INSERT INTO `dominios` VALUES (27, 'Cuba', 'cu');
INSERT INTO `dominios` VALUES (28, 'República Checa', 'cz');
INSERT INTO `dominios` VALUES (29, 'Dinamarca', 'dk');
INSERT INTO `dominios` VALUES (30, 'Dominica', 'dm');
INSERT INTO `dominios` VALUES (31, 'East Timor', 'tp');
INSERT INTO `dominios` VALUES (32, 'Egipto', 'eg');
INSERT INTO `dominios` VALUES (33, 'Equatorial Guinea', 'gq');
INSERT INTO `dominios` VALUES (34, 'Ethiopia', 'et');
INSERT INTO `dominios` VALUES (35, 'Islas Faroe', 'fo');
INSERT INTO `dominios` VALUES (36, 'Finlandia', 'fi');
INSERT INTO `dominios` VALUES (37, 'Francias ( Territorio Europeo )', 'fx');
INSERT INTO `dominios` VALUES (38, 'French Polynesia', 'pf');
INSERT INTO `dominios` VALUES (39, 'Gabon', 'ga');
INSERT INTO `dominios` VALUES (40, 'Georgia', 'ge');
INSERT INTO `dominios` VALUES (41, 'Ghana', 'gh');
INSERT INTO `dominios` VALUES (42, 'Grecia', 'gr');
INSERT INTO `dominios` VALUES (43, 'Granada', 'gd');
INSERT INTO `dominios` VALUES (44, 'Guam (US)', 'gu');
INSERT INTO `dominios` VALUES (45, 'Guinea', 'gn');
INSERT INTO `dominios` VALUES (46, 'Guyana', 'gy');
INSERT INTO `dominios` VALUES (47, 'Heard and McDonald Islands', 'hm');
INSERT INTO `dominios` VALUES (48, 'Hong Kong', 'hk');
INSERT INTO `dominios` VALUES (49, 'Iceland', 'is');
INSERT INTO `dominios` VALUES (50, 'Indonesia', 'id');
INSERT INTO `dominios` VALUES (51, 'Iraq', 'iq');
INSERT INTO `dominios` VALUES (52, 'Israel', 'il');
INSERT INTO `dominios` VALUES (53, 'Ivory Coast (C''te D''Ivoire)', 'ci');
INSERT INTO `dominios` VALUES (54, 'Japón', 'jp');
INSERT INTO `dominios` VALUES (55, 'Kazakhstan', 'kz');
INSERT INTO `dominios` VALUES (56, 'Kiribati', 'ki');
INSERT INTO `dominios` VALUES (57, 'Kyrgyzstan', 'kg');
INSERT INTO `dominios` VALUES (58, 'Latvia', 'lv');
INSERT INTO `dominios` VALUES (59, 'Lesotho', 'ls');
INSERT INTO `dominios` VALUES (60, 'Libya (Libyan Arab Jamahiriya)', 'ly');
INSERT INTO `dominios` VALUES (61, 'Lituania', 'lt');
INSERT INTO `dominios` VALUES (62, 'Macau', 'mo');
INSERT INTO `dominios` VALUES (63, 'Madagascar', 'mg');
INSERT INTO `dominios` VALUES (64, 'Malasya', 'my');
INSERT INTO `dominios` VALUES (65, 'Mali', 'ml');
INSERT INTO `dominios` VALUES (66, 'Marshall Islands', 'mh');
INSERT INTO `dominios` VALUES (67, 'Mauritania', 'mr');
INSERT INTO `dominios` VALUES (68, 'México', 'mx');
INSERT INTO `dominios` VALUES (69, 'Moldavia', 'md');
INSERT INTO `dominios` VALUES (70, 'Mongolia', 'mn');
INSERT INTO `dominios` VALUES (71, 'Marruecos', 'ma');
INSERT INTO `dominios` VALUES (72, 'Myanmar', 'mm');
INSERT INTO `dominios` VALUES (73, 'Nauru', 'nr');
INSERT INTO `dominios` VALUES (74, 'Netherland Antilles', 'an');
INSERT INTO `dominios` VALUES (75, 'Zona Neutral', 'nt');
INSERT INTO `dominios` VALUES (76, 'Nueva Zelanda', 'nz');
INSERT INTO `dominios` VALUES (77, 'Nigeria', 'ne');
INSERT INTO `dominios` VALUES (78, 'Niue', 'nu');
INSERT INTO `dominios` VALUES (79, 'Korea del Norte', 'kp');
INSERT INTO `dominios` VALUES (80, 'Noruega', 'no');
INSERT INTO `dominios` VALUES (81, 'Pakistán', 'pk');
INSERT INTO `dominios` VALUES (82, 'Panamá', 'pa');
INSERT INTO `dominios` VALUES (83, 'Paraguay', 'py');
INSERT INTO `dominios` VALUES (84, 'Filipinas', 'ph');
INSERT INTO `dominios` VALUES (85, 'Polonia', 'pl');
INSERT INTO `dominios` VALUES (86, 'Portugal', 'pt');
INSERT INTO `dominios` VALUES (87, 'Qatar', 'qa');
INSERT INTO `dominios` VALUES (88, 'Rumania', 'ro');
INSERT INTO `dominios` VALUES (89, 'Rwanda', 'rw');
INSERT INTO `dominios` VALUES (90, 'Saint Kitts Nevis Anguilla', 'kn');
INSERT INTO `dominios` VALUES (91, 'Saint Pierre and Miquelon', 'pm');
INSERT INTO `dominios` VALUES (92, 'Saint Vincent and the Grenadines', 'vc');
INSERT INTO `dominios` VALUES (93, 'San Marino', 'sm');
INSERT INTO `dominios` VALUES (94, 'Senegal', 'sn');
INSERT INTO `dominios` VALUES (95, 'Sierra Leone', 'sl');
INSERT INTO `dominios` VALUES (96, 'Slovak Republic (Slovakia)', 'sk');
INSERT INTO `dominios` VALUES (97, 'Islas Salomón', 'sb');
INSERT INTO `dominios` VALUES (98, 'Sudáfrica', 'za');
INSERT INTO `dominios` VALUES (99, 'Unión Soviética', 'su');
INSERT INTO `dominios` VALUES (100, 'Sri Lanka', 'lk');
INSERT INTO `dominios` VALUES (101, 'Surinam', 'sr');
INSERT INTO `dominios` VALUES (102, 'Swaziland', 'sz');
INSERT INTO `dominios` VALUES (103, 'Suiza', 'ch');
INSERT INTO `dominios` VALUES (104, 'Tajikistan', 'tj');
INSERT INTO `dominios` VALUES (105, 'Tanzania', 'tz');
INSERT INTO `dominios` VALUES (106, 'Togo', 'tg');
INSERT INTO `dominios` VALUES (107, 'Tonga', 'to');
INSERT INTO `dominios` VALUES (108, 'Tunisia', 'tn');
INSERT INTO `dominios` VALUES (109, 'Turkmenistan', 'tm');
INSERT INTO `dominios` VALUES (110, 'Tuvalu', 'tv');
INSERT INTO `dominios` VALUES (111, 'Ucrania', 'ua');
INSERT INTO `dominios` VALUES (112, 'United Kingdom', 'uk');
INSERT INTO `dominios` VALUES (113, 'United States Minor Outlying Islands', 'um');
INSERT INTO `dominios` VALUES (114, 'Uzbekistan', 'uz');
INSERT INTO `dominios` VALUES (115, 'Vatican City State', 'va');
INSERT INTO `dominios` VALUES (116, 'Islas Vírgenes', 'vi');
INSERT INTO `dominios` VALUES (117, 'Western Sahara', 'eh');
INSERT INTO `dominios` VALUES (118, 'Yugoslavia', 'yu');
INSERT INTO `dominios` VALUES (119, 'Zambia', 'zm');
INSERT INTO `dominios` VALUES (120, 'Albania', 'al');
INSERT INTO `dominios` VALUES (121, 'American Samoa', 'as');
INSERT INTO `dominios` VALUES (122, 'Angola', 'ao');
INSERT INTO `dominios` VALUES (123, 'Antártica', 'aq');
INSERT INTO `dominios` VALUES (124, 'Argentina', 'ar');
INSERT INTO `dominios` VALUES (125, 'Aruba', 'aw');
INSERT INTO `dominios` VALUES (126, 'Austria', 'at');
INSERT INTO `dominios` VALUES (127, 'Bahamas', 'bs');
INSERT INTO `dominios` VALUES (128, 'Bangladesh', 'bd');
INSERT INTO `dominios` VALUES (129, 'Belarus', 'by');
INSERT INTO `dominios` VALUES (130, 'Belize', 'bz');
INSERT INTO `dominios` VALUES (131, 'Bermuda', 'bm');
INSERT INTO `dominios` VALUES (132, 'Bolivia', 'bo');
INSERT INTO `dominios` VALUES (133, 'Botswana', 'bw');
INSERT INTO `dominios` VALUES (134, 'Brasil', 'br');
INSERT INTO `dominios` VALUES (135, 'Brunei Darussalam', 'bn');
INSERT INTO `dominios` VALUES (136, 'Burkina Faso', 'bf');
INSERT INTO `dominios` VALUES (137, 'Cambodia', 'kh');
INSERT INTO `dominios` VALUES (138, 'Canadá', 'ca');
INSERT INTO `dominios` VALUES (139, 'Islas Caymán', 'ky');
INSERT INTO `dominios` VALUES (140, 'Chad', 'td');
INSERT INTO `dominios` VALUES (141, 'China', 'cn');
INSERT INTO `dominios` VALUES (142, 'Cocos (Keeling) Islands', 'cc');
INSERT INTO `dominios` VALUES (143, 'Comoros', 'km');
INSERT INTO `dominios` VALUES (144, 'Cook Islands', 'ck');
INSERT INTO `dominios` VALUES (145, 'Croacia (Hrvatska)', 'hr');
INSERT INTO `dominios` VALUES (146, 'Cyprus', 'cy');
INSERT INTO `dominios` VALUES (147, 'Checoslovaquia', 'cs');
INSERT INTO `dominios` VALUES (148, 'Djibouti', 'dj');
INSERT INTO `dominios` VALUES (149, 'República Dominicana', 'do');
INSERT INTO `dominios` VALUES (150, 'Ecuador', 'ec');
INSERT INTO `dominios` VALUES (151, 'El Salvador', 'sv');
INSERT INTO `dominios` VALUES (152, 'Estonia', 'ee');
INSERT INTO `dominios` VALUES (153, 'Falkland Islands (Malvinas)', 'fk');
INSERT INTO `dominios` VALUES (154, 'Fiji', 'fj');
INSERT INTO `dominios` VALUES (155, 'Francia', 'fr');
INSERT INTO `dominios` VALUES (156, 'French Guyana', 'gf');
INSERT INTO `dominios` VALUES (157, 'French Southern Territories', 'tf');
INSERT INTO `dominios` VALUES (158, 'Gambia', 'gm');
INSERT INTO `dominios` VALUES (159, 'Alemania', 'de');
INSERT INTO `dominios` VALUES (160, 'Gibraltar', 'gi');
INSERT INTO `dominios` VALUES (161, 'Greenland', 'gl');
INSERT INTO `dominios` VALUES (162, 'Guadaloupe (French)', 'gp');
INSERT INTO `dominios` VALUES (163, 'Guatemala', 'gt');
INSERT INTO `dominios` VALUES (164, 'Guinea-Bissau', 'gw');
INSERT INTO `dominios` VALUES (165, 'Haití', 'ht');
INSERT INTO `dominios` VALUES (166, 'Honduras', 'hn');
INSERT INTO `dominios` VALUES (167, 'Hungría', 'hu');
INSERT INTO `dominios` VALUES (168, 'India', 'in');
INSERT INTO `dominios` VALUES (169, 'República Islámica de Irán', 'ir');
INSERT INTO `dominios` VALUES (170, 'Irlanda', 'ie');
INSERT INTO `dominios` VALUES (171, 'Italia', 'it');
INSERT INTO `dominios` VALUES (172, 'Jamaica', 'jm');
INSERT INTO `dominios` VALUES (173, 'Jordania', 'jo');
INSERT INTO `dominios` VALUES (174, 'Kenya', 'ke');
INSERT INTO `dominios` VALUES (175, 'Kuwait', 'kw');
INSERT INTO `dominios` VALUES (176, 'Laos (People''s Democratic Republic)', 'la');
INSERT INTO `dominios` VALUES (177, 'Lebanon', 'lb');
INSERT INTO `dominios` VALUES (178, 'Liberia', 'lr');
INSERT INTO `dominios` VALUES (179, 'Liechtenstein', 'li');
INSERT INTO `dominios` VALUES (180, 'Luxemburgo', 'lu');
INSERT INTO `dominios` VALUES (181, 'Macedonia (Former Yugoslav Republic of)', 'mk');
INSERT INTO `dominios` VALUES (182, 'Malawi', 'mw');
INSERT INTO `dominios` VALUES (183, 'Maldives', 'mv');
INSERT INTO `dominios` VALUES (184, 'Malta', 'mt');
INSERT INTO `dominios` VALUES (185, 'Martinique (French)', 'mq');
INSERT INTO `dominios` VALUES (186, 'Mauritius', 'mu');
INSERT INTO `dominios` VALUES (187, 'Micronesia', 'fm');
INSERT INTO `dominios` VALUES (188, 'Mónaco', 'mc');
INSERT INTO `dominios` VALUES (189, 'Montserrat', 'ms');
INSERT INTO `dominios` VALUES (190, 'Mozambique', 'mz');
INSERT INTO `dominios` VALUES (191, 'Namibia', 'na');
INSERT INTO `dominios` VALUES (192, 'Nepal', 'np');
INSERT INTO `dominios` VALUES (193, 'Holanda', 'nl');
INSERT INTO `dominios` VALUES (194, 'New Caledonia (French)', 'nc');
INSERT INTO `dominios` VALUES (195, 'Nicaragua', 'ni');
INSERT INTO `dominios` VALUES (196, 'Nigeria', 'ng');
INSERT INTO `dominios` VALUES (197, 'Norfolk Island', 'nf');
INSERT INTO `dominios` VALUES (198, 'Northern Mariana Islands', 'mp');
INSERT INTO `dominios` VALUES (199, 'Oman', 'om');
INSERT INTO `dominios` VALUES (200, 'Palau', 'pw');
INSERT INTO `dominios` VALUES (201, 'Papua New Guinea', 'pg');
INSERT INTO `dominios` VALUES (202, 'Perú', 'pe');
INSERT INTO `dominios` VALUES (203, 'Pitcairn', 'pn');
INSERT INTO `dominios` VALUES (204, 'Polynesia (French)', 'pf');
INSERT INTO `dominios` VALUES (205, 'Puerto Rico (US)', 'pr');
INSERT INTO `dominios` VALUES (206, 'Reunion (French)', 're');
INSERT INTO `dominios` VALUES (207, 'Rusia', 'ru');
INSERT INTO `dominios` VALUES (208, 'Santa Helena', 'sh');
INSERT INTO `dominios` VALUES (209, 'Santa Lucía', 'lc');
INSERT INTO `dominios` VALUES (210, 'Saint Tome and Principe', 'st');
INSERT INTO `dominios` VALUES (211, 'Samoa', 'ws');
INSERT INTO `dominios` VALUES (212, 'Arabia Saudita', 'sa');
INSERT INTO `dominios` VALUES (213, 'Seychelles', 'sc');
INSERT INTO `dominios` VALUES (214, 'Singapore', 'sg');
INSERT INTO `dominios` VALUES (215, 'Slovenia', 'si');
INSERT INTO `dominios` VALUES (216, 'Somalia', 'so');
INSERT INTO `dominios` VALUES (217, 'Korea del Sur', 'kr');
INSERT INTO `dominios` VALUES (218, 'España', 'es');
INSERT INTO `dominios` VALUES (219, 'Sudan', 'sd');
INSERT INTO `dominios` VALUES (220, 'Svalbard and Jan Mayen Islands', 'sj');
INSERT INTO `dominios` VALUES (221, 'Suecia', 'se');
INSERT INTO `dominios` VALUES (222, 'Syria (Syrian Arab Republic)', 'sy');
INSERT INTO `dominios` VALUES (223, 'Taiwan', 'tw');
INSERT INTO `dominios` VALUES (224, 'Tailandia', 'th');
INSERT INTO `dominios` VALUES (225, 'Tokelau', 'tk');
INSERT INTO `dominios` VALUES (226, 'Trinidad y Tobago', 'tt');
INSERT INTO `dominios` VALUES (227, 'Turkia', 'tr');
INSERT INTO `dominios` VALUES (228, 'Turks and Caicos Islands', 'tc');
INSERT INTO `dominios` VALUES (229, 'Uganda', 'ug');
INSERT INTO `dominios` VALUES (230, 'Emiratos Arabes Unidos', 'ae');
INSERT INTO `dominios` VALUES (231, 'Estados Unidos', 'us');
INSERT INTO `dominios` VALUES (232, 'Uruguay', 'uy');
INSERT INTO `dominios` VALUES (233, 'Vanuatu', 'vu');
INSERT INTO `dominios` VALUES (234, 'Venezuela', 've');
INSERT INTO `dominios` VALUES (235, 'Wallis and Futuna Islands', 'wf');
INSERT INTO `dominios` VALUES (236, 'Yemen', 'ye');
INSERT INTO `dominios` VALUES (237, 'Zaire', 'zr');
INSERT INTO `dominios` VALUES (238, 'Zimbabwe', 'zw');
