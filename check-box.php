<html>
	<head>
		<title>Inscricao em Leilao</title>
	</head>
	<body>
	<?php
	session_start();
				$nif = $_SESSION['nif'];
				$checks = $_POST['Check'];
		// Variaveis de conexao a BD
				$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
				$user="ist172744";			// -> substituir pelo nome de utilizador
			$password="gyed4619";		// -> substituir pela password dada pelo mysql_reset // a BD tem nome identico ao utilizador
				$dbname = $user;
				echo("<h2>Inscricao em Leiloes</h2>\n");
				$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));	
		
		if(empty($checks)) 
		{   
			echo("Nao selecionou nenhum leilao");
		} 
		else
		{
			$N = count($checks);
			try {
					$sql = "START TRANSACTION;";
					$result = $connection->query($sql);
			for($i=0; $i < $N; $i++)
			{		
					$sql = "INSERT INTO concorrente (pessoa,leilao) VALUES ($nif, $checks[$i]);";
					$result = $connection->query($sql);
					
					if (!$result) {
						echo("<p> Ja esta a concorrer no leilao $checks[$i]</p>");
						continue;
					}
					
					
					
					
					echo("<p> A pessoa com o nif $nif foi registada no leilao $checks[$i] com sucesso!</p>\n");
					}
			$sql = "COMMIT;";
			$result = $connection->query($sql);
			} 	catch (PDOException $e) {
				$sql = "ROLLBACK;";
				$result = $connection->query($sql);
				echo("<p>ERROR: {$e->getMessage()}</p>");
				}

		}
	?>

		<form method="get" action="menu.html">
		    <button type="submit">Menu</button>
		</form>
	</body>
</html>