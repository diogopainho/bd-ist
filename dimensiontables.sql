-- define como terminador de comandos o caracter ; 
DELIMITER ;

	

DROP TABLE IF EXISTS tempo_dim;
CREATE TABLE tempo_dim (
  dia DATE,
  nif INT,
  id INT AUTO_INCREMENT,
  PRIMARY KEY (id));

DROP TABLE IF EXISTS geo_dim;
CREATE TABLE geo_dim (
	nif INT,
	concelho VARCHAR (80) NULL, 
	regiao VARCHAR (80) NULL, 
	id INT AUTO_INCREMENT,
	PRIMARY KEY (id));

DROP TABLE IF EXISTS factos;
CREATE TABLE factos (
	nif INT,
	concelho VARCHAR (80) NULL, 
	regiao VARCHAR (80) NULL,
	dia DATE,
	id INT AUTO_INCREMENT,
	PRIMARY KEY (id));
