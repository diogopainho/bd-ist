<html>
	<head>
		<title>Inscricao em Leilao</title>
	</head>
	<body>
	
	<?php
			session_start();
			$nif = $_SESSION['nif'];
			$lid = $_POST['lid'];
			$valor = $_POST['valor'];
	// Variaveis de conexao a BD
			$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
			$user="ist172744";			// -> substituir pelo nome de utilizador
			$password="gyed4619";		// -> substituir pela password dada pelo mysql_reset // a BD tem nome identico ao utilizador
			$dbname = $user;
			echo("<h2>Inscricao em Leiloes</h2>\n");
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
			//Faz um lance do utilizador num leilao previamente seleccionado com o respectivo valor 
			$sql = "INSERT INTO lance (pessoa,leilao, valor) VALUES ($nif,$lid, $valor)"; 
			$result = $connection->query($sql);
			if (!$result) {
				echo("<p> Falha no lance: Erro na Query:($sql) </p>"); 
				exit();
			}
			echo("<p> A pessoa com o nif $nif fez um lance no leilao $lid  no valor de $valor com sucesso!</p>\n"); 
		?>
		<!-- Form para inscrever num leilao -->
		<form method="get" action="menu.html">
		    <button type="submit">Menu</button>
		</form>
	</body>
</html>
