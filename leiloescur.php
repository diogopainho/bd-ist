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
			
			//Vai buscar todos os leiloes e junta o leilaor para obter o ID (nao deve ser feito)
			$sql = "SELECT * FROM leilao AS l NATURAL JOIN leilaor AS lr;";
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
					<td>termina</td>
					<td>lancemaisalto</td>
				</tr>\n");
		    $idleilao = 0;

			foreach($result as $row){
				$nrdias = $row["nrdias"];
				//Manipula a data para obter os leiloes que ainda estao em dia... A data de inicio + dias de duracao < data do sistema
				if(strtotime($row["dia"]. " + $nrdias days") > time()){
					$idleilao = $idleilao +1;
					$lid = $row["lid"];
					echo("<tr><td>");
					echo($row["lid"]); echo("</td><td>");
					echo($row["nif"]); echo("</td><td>");
					echo($row["dia"]); echo("</td><td>");
					echo($row["nrleilaonodia"]); echo("</td><td>");
					echo($row["nome"]); echo("</td><td>");
					echo($row["tipo"]); echo("</td><td>");
					echo($row["valorbase"]); echo("</td><td>");
					echo(date("Y-m-d", (strtotime($row["dia"]. " + $nrdias days")))); echo("</td><td>");
					
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
		<!-- Form do menu da pagina -->
			<!-- Form que remete para a inscricao num leilao -->
		<form action="insleilao.php" method="post">
			<h2>Escolha o ID do leilao que pretende concorrer</h2>
			<p>ID: <input type="text" name="lid" /></p>
			<p><input type="submit" value="Inscrever" /></p>
		</form>
		<form method="get" action="menu.html">
		    <button type="submit">Menu</button>
		</form>
	</body>
</html>