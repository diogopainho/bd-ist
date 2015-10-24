<?php 
	session_start();
?>
<html>
	<head>
		<title>Lista dos Leiloes</title>
	</head>
	<body>
		<?php
			$utilizador = $_SESSION['utilizador'];
			$nif = $_SESSION['nif']; 
			// Variaveis de conexao a BD
			$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
			$user="ist172744";			// -> substituir pelo nome de utilizador
			$password="gyed4619";		// -> substituir pela password dada pelo mysql_reset // a BD tem nome identico ao utilizador
			$dbname = $user;
			echo("<h2>Lista dos Leiloes</h2>\n");
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			// Apresenta os leiloes
			$sql = "SELECT * FROM leilao";
			$result = $connection->query($sql);
			echo("<table border=\"1\">\n"); 
			echo("<tr>
					<td>ID</td>
					<td>nif</td>
					<td>diahora</td>
					<td>NrDoDia</td>
					<td>nome</td>
					<td>tipo</td>
					<td>valorbase</td>
				</tr>\n");
		    $idleilao = 0;

			foreach($result as $row){
				$idleilao = $idleilao +1;
				echo("<tr><td>");
				echo($idleilao); echo("</td><td>");
				echo($row["nif"]); echo("</td><td>");
				echo($row["dia"]); echo("</td><td>");
				echo($row["nrleilaonodia"]); echo("</td><td>");
				echo($row["nome"]); echo("</td><td>");
				echo($row["tipo"]); echo("</td><td>");
				echo($row["valorbase"]); echo("</td><td>");
				$leilao[$idleilao]= array($row["nif"],$row["diahora"],$row["nrleilaonodia"]);
			}
			echo("</table>\n");
			$_SESSION['nif'] = $nif;
?>
		<!-- Form para o menu da pagina -->
		<form method="get" action="menu.html">
		    <button type="submit">Menu</button>
		</form>
	</body>
</html>