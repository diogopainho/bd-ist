-- define como terminador de comandos o caracter ; 
DELIMITER ;

-- desativa a verificacao das chaves estrangeiras 
SET foreign_key_checks = 0 ;

-- tabela das pessoas
DROP TABLE IF EXISTS pessoa; 
CREATE TABLE pessoa(
	nif INT,
	nome VARCHAR(80) NOT NULL, 
	pin INT NOT NULL,
	PRIMARY KEY (nif));

-- tabela das pessoas coletivas 
DROP TABLE IF EXISTS pessoac; 
CREATE TABLE pessoac(
	nif INT,
	capitalsocial INT NOT NULL, 
	PRIMARY KEY (nif),
	FOREIGN KEY (nif) REFERENCES pessoa(nif));

-- tabela das leiloeiras
DROP TABLE IF EXISTS leiloeira; 
CREATE TABLE leiloeira(
	nif INT,
	nralvara INT NOT NULL, 
	concelho VARCHAR (80) NULL, 
	regiao VARCHAR (80) NULL, 
	PRIMARY KEY (nif),
	FOREIGN KEY (nif) REFERENCES pessoac(nif));

-- tabela dos leiloes
DROP TABLE IF EXISTS leilao; 
CREATE TABLE leilao(
	dia DATE,
	nrleilaonodia INT ,
	nif INT ,
	nome VARCHAR (80) NULL, 
	valorbase INT NOT NULL,
	tipo BOOLEAN NOT NULL,			-- FALSE = leilao de area de exploracao de infraestrutura 
	PRIMARY KEY (nif,dia,nrleilaonodia),
	FOREIGN KEY (nif) REFERENCES leiloeira(nif));

-- tabela dos leiloes de areas de concessoes de Recursos 
DROP TABLE IF EXISTS leilaor;
CREATE TABLE leilaor(
	dia DATE NOT NULL,
	nrleilaonodia INT NOT NULL,
	nif INT NOT NULL,
	nrdias INT NOT NULL,
	lid INT AUTO_INCREMENT,
	FOREIGN KEY (nif,dia,nrleilaonodia) REFERENCES leilao(nif,dia,nrleilaonodia), 
	PRIMARY KEY (nif,dia,nrleilaonodia),
	UNIQUE KEY(lid));

-- tabela com os concorrentes registados aos leiloes de Recursos 
DROP TABLE IF EXISTS concorrente;
CREATE TABLE concorrente(
	pessoa INT NOT NULL, 
	leilao INT NOT NULL, 
	PRIMARY KEY (pessoa,leilao),
	FOREIGN KEY (pessoa) REFERENCES pessoa(nif), 
	FOREIGN KEY (leilao) REFERENCES leilaor(lid));

-- tabela com os lances dos concorrentes aos leiloes de Recursos 
DROP TABLE IF EXISTS lance;
CREATE TABLE lance(
	pessoa INT NOT NULL, 
	leilao INT NOT NULL, 
	valor INT NOT NULL, 			-- valor de cada lance 
	PRIMARY KEY (pessoa,leilao,valor),
	FOREIGN KEY (pessoa,leilao) REFERENCES concorrente(pessoa,leilao));

-- ativa a verificacao das chaves estrangeiras 
SET foreign_key_checks = 1 ;
