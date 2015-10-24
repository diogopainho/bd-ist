<?php 
	session_start();
?>
<html>
	<head>
		<title>Esquema em Estrela</title>
	</head>
	<body>
		<?php
			// Variaveis de conexao a BD
			$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
			$user="ist172744";			// -> substituir pelo nome de utilizador
			$password="gyed4619";		// -> substituir pela password dada pelo mysql_reset // a BD tem nome identico ao utilizador
			$dbname = $user;
			echo("<h2>Lista dos Concorrentes</h2>\n");
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			// Apresenta os leiloes
			$sql = "TRUNCATE TABLE tempo_dim;";
			$result = $connection->query($sql);
			$sql = "TRUNCATE TABLE geo_dim;";
			$result = $connection->query($sql);
			$sql = "TRUNCATE TABLE factos;";
			$result = $connection->query($sql);
			$sql = "INSERT IGNORE INTO tempo_dim(dia, nif) SELECT DISTINCT le.dia, le.nif FROM leilao as le;";
			$result = $connection->query($sql);
			$sql = "INSERT IGNORE INTO geo_dim(nif, concelho, regiao) SELECT DISTINCT l.nif, l.concelho, l.regiao FROM leiloeira AS l;";
			$result = $connection->query($sql);
			$sql = "INSERT IGNORE INTO factos(nif, concelho, regiao, dia) SELECT DISTINCT la.nif, la.concelho, la.regiao, lo.dia FROM geo_dim AS la, tempo_dim AS lo WHERE la.nif = lo.nif;";
			$result = $connection->query($sql);
			$sql = "SELECT DISTINCT f.concelho, f.regiao, f.dia, lan.leilao, lan.valor
FROM factos AS f, lance AS lan, leilaor AS lr 
WHERE lan.leilao = lr.lid AND f.dia = lr.dia;";
			$result = $connection->query($sql);
			echo("<table border=\"1\">\n"); 
			echo("<tr>
					<td>concelho</td>
					<td>regiao</td>
					<td>dia</td>
					<td>leilao</td>
					<td>valor</td>
				</tr>\n");

			foreach($result as $row){
				echo("<tr><td>");
				echo($row["concelho"]);echo("</td><td>");
				echo($row["regiao"]);echo("</td><td>");
				echo($row["dia"]);echo("</td><td>");
				echo($row["leilao"]);echo("</td><td>");
				echo($row["valor"]);echo("</td>");
			}
			echo("</tr></table>\n");
?>
		<!-- Form para inscrever num lance bastante incompleto... Temos de passar o id do leilao etc etc -->
		<form method="get" action="menu.html">
		    <button type="submit">Menu</button>
		</form>
		<form method="get" action="login.html">
		    <button type="submit">Log Out</button>
		</form>
	</body>
</html>