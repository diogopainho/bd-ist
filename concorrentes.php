<?php 
	session_start();
?>
<html>
	<head>
		<title>Lista dos Concorrentes</title>
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
			
			// Apresenta os concorrentes
			$sql = "SELECT * FROM concorrente";
			$result = $connection->query($sql);
			echo("<table border=\"1\">\n"); 
			echo("<tr>
					<td>Pessoa</td>
					<td>Leilao</td>
				</tr>\n");
		  //  $idleilao = 0;

			foreach($result as $row){
				$idleilao = $idleilao +1;
				echo("<tr><td>");
			//	echo($idleilao); echo("</td><td>");
				echo($row["pessoa"]); echo("</td><td>");
				echo($row["leilao"]); echo("</td><td>");
			}
			echo("</table>\n");
?>
		<!-- Form para o menu da pagina -->
		<form method="get" action="menu.html">
		    <button type="submit">Menu</button>
		</form>
		<form method="get" action="login.html">
		    <button type="submit">Log Out</button>
		</form>
	</body>
</html>