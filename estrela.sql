DROP TABLE IF EXISTS tempo_dim;
CREATE TABLE  tempo_dim (
  id INT,
  dia DATE NOT NULL,
  PRIMARY KEY (id));
DROP TABLE IF EXISTS geo_dim;
CREATE TABLE geo_dim (
	id INT,
	concelho VARCHAR (80) NULL, 
	regiao VARCHAR (80) NULL, 
	PRIMARY KEY (id));
DROP TABLE IF EXISTS factos;
CREATE TABLE factos (
	id INT AUTO_INCREMENT,
	concelho VARCHAR (80) NULL, 
	regiao VARCHAR (80) NULL,
	dia DATE NOT NULL,
	PRIMARY KEY (id));