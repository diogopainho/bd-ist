<html>
	<head>
		<title>Leiloes em que estou inscrito</title>
	</head>
	<body>
	
	<?php
			session_start();
			$nif = $_SESSION['nif'];
	// Variaveis de conexao a BD
			$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
			$user="ist172744";			// -> substituir pelo nome de utilizador
			$password="gyed4619";		// -> substituir pela password dada pelo mysql_reset // a BD tem nome identico ao utilizador
			$dbname = $user;
			echo("<h2>Leiloes em que estou inscrito</h2>\n");
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
			//Junta as tabelas leilao e leilaor por causa do ID, e mostra os leiloes onde o utilizador esta inscrito (faz parte da tabela concorrente)
			$sql = "SELECT * FROM leilao AS L NATURAL JOIN leilaor AS lr NATURAL JOIN concorrente AS c WHERE lr.lid = c.leilao AND c.pessoa = $nif;"; 
			$result = $connection->query($sql);
			echo("<table border=\"1\">\n"); 
			echo("<tr>
					<td>NIF</td>
					<td>Inicio</td>
					<td>Nº no Dia</td>
					<td>Nome</td>
					<td>Valor Base</td>
					<td>Tipo</td>
					<td>Duracao</td>
					<td>Pessoa</td>
					<td>Leilao</td>
					<td>Termina</td>
					<td>Maior Lance</td>
				</tr>\n");


			foreach($result as $row){
				$nrdias = $row["nrdias"];
				$lid = $row["leilao"];
				//Manipulacao de datas para countdown
				$remaining = (strtotime($row["dia"]. "+ $nrdias days")) - time();
				$days_remaining = floor(($remaining / 86400));
				$hours_remaining = floor(($remaining % 86400) / 3600);
				if($days_remaining > 0){ // Para mostrar aqueles cuja data ainda e valida
					echo("<tr><td>");
					echo($row["nif"]); echo("</td><td>");
					echo($row["dia"]); echo("</td><td>");
					echo($row["nrleilaonodia"]); echo("</td><td>");
					echo($row["nome"]); echo("</td><td>");
					echo($row["valorbase"]); echo("</td><td>");
					echo($row["tipo"]); echo("</td><td>");
					echo($row["nrdias"]); echo("</td><td>");
					echo($row["pessoa"]); echo("</td><td>");
					echo($row["leilao"]); echo("</td><td>");
					$remaining = (strtotime($row["dia"]. "+ $nrdias days")) - time();
					$days_remaining = floor(($remaining / 86400));
					$hours_remaining = floor(($remaining % 86400) / 3600);
					echo($days_remaining." dias e ".$hours_remaining." horas"); echo ("</td><td>");

					//Selecciona e mostra o valor mais alto dos lances para os leiloes que tem lances
					$q = "SELECT MAX(lance.valor) AS max FROM lance WHERE lance.leilao = $lid;";
					$valor = $connection->query($q);
						foreach($valor as $v){
							echo($v["max"]); echo("</td>");
						}
				} else continue;
			}
			echo("</table>\n");
		?>
		<!-- Form para o menu da pagina -->
			<!-- Form para fazer um lance -->
		<form action="fazlance.php" method="post">
			<h2>Escolha o ID do leilao em que pretende fazer um lance</h2>
			<p>ID: <input type="text" name="lid" /></p>
			<p>Valor: <input type="text" name= "valor" /></p>
			<p><input type="submit" value="Licitar" /></p>
		</form>
		<form method="get" action="menu.html">
		    <button type="submit">Menu</button>
		</form>
	</body>
</html>