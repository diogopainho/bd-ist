<?php 
	session_start();
?>
<html>
	<head>
		<title>Lista dos Leiloes em Curso</title>
	</head>
	<body>
		<?php 
			$dia = $_POST["dia"]; 
			// Variaveis de conexao a BD
			$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
			$user="ist172744";			// -> substituir pelo nome de utilizador
			$password="gyed4619";		// -> substituir pela password dada pelo mysql_reset // a BD tem nome identico ao utilizador
			$dbname = $user;
			echo("<h2>Lista dos Leiloes em Curso</h2>\n");

			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			$dia = preg_replace('/-|:/', null, $dia);
			//Selecciona os leiloes em curso das datas que foram passadas do form da pagina anterior
			$sql = "SELECT * FROM leilao AS l NATURAL JOIN leilaor AS lr WHERE l.dia = $dia;";
			$result = $connection->query($sql);
			echo("<table border=\"1\">\n"); 
			echo("<tr>
					<td>Inscrever</td>
					<td>ID</td>
					<td>NIF</td>
					<td>Dia</td>
					<td>NrNoDia</td>
					<td>Nome</td>
					<td>Tipo</td>
					<td>Valor Base</td>
					<td>Termina</td>
				</tr>\n");
		    $idleilao = 0;
			?><form action="check-box.php" method="post"><?
			
			foreach($result as $row){
				$nrdias = $row["nrdias"];
				if(strtotime($row["dia"]. " + $nrdias days") > time()){
					$idleilao = $idleilao +1;
					echo("<tr><td>");
					//Guarda num array os leiloes que foram seleccionados para posterior inscricao
					?><input type="checkbox" name="Check[]" value="<? echo htmlspecialchars($row["lid"]); ?>" /><?
					echo("</td><td>");
					echo($row["lid"]); echo("</td><td>");
					echo($row["nif"]); echo("</td><td>");
					echo($row["dia"]); echo("</td><td>");
					echo($row["nrleilaonodia"]); echo("</td><td>");
					echo($row["nome"]); echo("</td><td>");
					echo($row["tipo"]); echo("</td><td>");
					echo($row["valorbase"]); echo("</td><td>");
					//Manipulacao das datas para obter o termino do leilao
					echo(date("Y-m-d", (strtotime($row["dia"]. " + $nrdias days")))); echo("</td><td>");
					
				} else continue;
			}
			echo("</table>\n");
		
?>
		<!-- Form para menu da pagina -->
			<p><input type="submit" value="Submeter" /></p>
		</form>
		<form method="get" action="menu.html">
		    <button type="submit">Menu</button>
		</form>
	</body>
</html>