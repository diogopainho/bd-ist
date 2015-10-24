
<html>
	<head>
		<title>Inscricao em Leilao</title>
	</head>
	<body>
	
	<?php
			session_start();
			//Variaveis de sessao e do post
			$nif = $_SESSION['nif'];
			$lid = $_POST['lid'];
	// Variaveis de conexao a BD
			$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
			$user="ist172744";			// -> substituir pelo nome de utilizador
			$password="gyed4619";		// -> substituir pela password dada pelo mysql_reset // a BD tem nome identico ao utilizador
			$dbname = $user;
			echo("<h2>Inscricao em Leiloes</h2>\n");
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
			//Regista a pessoa no leilao. 
			$sql = "INSERT INTO concorrente (pessoa,leilao) VALUES ($nif,$lid)"; 
			$result = $connection->query($sql);
			if (!$result) {
				echo("<p> Pessoa nao registada: Erro na Query:($sql) </p>"); 
				exit();
			}
			echo("<p> A pessoa com o nif $nif foi registada no leilao $lid com sucesso!</p>\n"); 
		?>
		<!-- Form para o menu da pagina -->
		<form method="get" action="menu.html">
		    <button type="submit">Menu</button>
		</form>
	</body>
</html>

