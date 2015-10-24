<?php 
	session_start();
?>
<html>
	<head>
		<title>Lista dos Leiloes</title>
	</head>
	<body>
		<?php 
			// Variaveis de conexao a BD
			$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
			$user="ist172744";			// -> substituir pelo nome de utilizador
			$password="gyed4619";		// -> substituir pela password dada pelo mysql_reset // a BD tem nome identico ao utilizador
			$dbname = $user;
			echo("<h2>Lista dos Leiloes</h2>\n");
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			$sql = "SELECT DISTINCT dia FROM leilao;";
			$result = $connection->query($sql);
			echo("<table border=\"1\">\n"); 
			echo("<tr>
					<td>Data</td>
					<td></td>
				</tr>\n");
			?><form action="checkins.php" method="post"><?

			//Apresenta as datas dos leiloes em que se pode inscrever e junta uma radiobox para seleecionar a data pretendida
			foreach($result as $row){
					echo("<tr><td>");
					echo($row["dia"]); echo("</td><td>");
					?><input type="radio" name="dia" value="<? echo htmlspecialchars($row["dia"]); ?>" /><?
					
			}
			echo("</table>\n");
		
?>
		<!-- Form do menu da pagina -->
		<p><input type="submit" value="Submeter" /></p>
		</form>
		<form method="get" action="menu.html">
		    <button type="submit">Menu</button>
		</form>
	</body>
</html>