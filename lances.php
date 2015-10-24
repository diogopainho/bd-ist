<?php 
	session_start();
?>
<html>
	<head>
		<title>Lista dos Lances</title>
	</head>
	<body>
		<?php
			$nif = $_SESSION['nif'];
			// Variaveis de conexao a BD
			$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
			$user="ist172744";			// -> substituir pelo nome de utilizador
			$password="gyed4619";		// -> substituir pela password dada pelo mysql_reset // a BD tem nome identico ao utilizador
			$dbname = $user;
			echo("<h2>Lista dos Lances</h2>\n");
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			// Apresenta os lances do utilizador
			$sql = "SELECT * FROM lance WHERE pessoa=$nif;";
			$result = $connection->query($sql);
			echo("<table border=\"1\">\n"); 
			echo("<tr>
					<td>Pessoa</td>
					<td>Leilao</td>
					<td>Valor</td>
				</tr>\n");

			foreach($result as $row){
				echo("<tr><td>");
				echo($row["pessoa"]); echo("</td><td>");
				echo($row["leilao"]); echo("</td><td>");
				echo($row["valor"]); echo("</td><td>");
			}
			echo("</table>\n");
			echo("<p>PS: Os id's apresentados sao correspondentes a tabela de todos os leiloes </p>");
?>
		<!-- Form para inscrever num lance bastante incompleto... Temos de passar o id do leilao etc etc -->
		<form method="get" action="menu.html">
		    <button type="submit">Menu</button>
		</form>
	</body>
</html>