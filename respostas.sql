Respostas:

3) QUERY'S
	1)  SELECT pessoa 
		FROM concorrente 
		WHERE concorrente.pessoa NOT IN (SELECT pessoa 
								   FROM lance);

	2)  SELECT p.nome 
		FROM concorrente AS c, pessoac AS pc, pessoa AS p 
		WHERE p.nif=pc.nif AND pc.nif=c.pessoa GROUP BY p.nome HAVING count(*)=2;

	3)  SELECT DISTINCT lr.lid 
		FROM leilaor as lr, leilao as le, lance as lc 
		WHERE lc.leilao = lr.lid AND le.nif = lr.nif 
						AND le.dia= lr.dia 
						AND le.nrleilaonodia = lr.nrleilaonodia 
						AND(lc.valor / le.valorbase)=(
							SELECT MAX(lc.valor / le.valorbase) 
							FROM leilaor as lr, leilao as le, lance as lc 
							WHERE lc.leilao = lr.lid AND le.nif = lr.nif 
										AND le.dia= lr.dia 
										AND le.nrleilaonodia = 											lr.nrleilaonodia);

	4) 	SELECT p1.nif AS Pessoa1, p2.nif AS Pessoa2 
		FROM pessoac AS p1, pessoac AS p2 
		WHERE p1.capitalsocial = p2.capitalsocial AND p1.nif != p2.nif;

4)	TRIGGERS

	delimiter //
	CREATE TRIGGER tg_lance BEFORE INSERT ON lance
	FOR EACH ROW
	BEGIN
	DECLARE @valor_base int(11);
	DECLARE @valor_cres int(11);
	SELECT l.valorbase INTO valor_base FROM leilao as l NATURAL JOIN leilaor as lr WHERE NEW.leilao = lr.leilao;
	SELECT max(valor) INTO valor_cres FROM lance WHERE NEW.leilao = lance.leilao;
	IF(NEW.valor < @valor_base) THEN 
		CALL ERRO_menor_base();
	ELSEIF(NEW.valor < @valor_cres) THEN
		CALL ERRO_val_nao_cres();
	ENDIF;
	END; //
	delimiter;

5) 	TRANSACOES

	START TRANSACTION;
	INSERT INTO concorrente (pessoa,leilao) VALUES ($nif, $checks[$i]);
	COMMIT;

	ou ROLLBACK;

6)	INDICES

	1)  CREATE INDEX IndexLC on
		lance(valor)
		USING BTREE;  

		CREATE INDEX IndexLR on
		leilaor(nif, dia, nrleilaonodia, lid)
		USING HASH; 

		CREATE INDEX IndexLE on
		leilao(nif, dia, nrleilaonodia)
		USING HASH; 

	2)  CREATE INDEX IndexCapSocial ON pessoac(capitalsocial)
		USING BTREE;

7) 	ESTRELA

8)	ROLLUP
