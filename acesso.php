<?php
	session_start();
?>
<html>
	<head>
		<title> Sistema de Leiloes de Areas Maritimas</title>
	</head>
	<body>
	<!-- Script para validar o utilizador e o pin na base de dados -->
		<?php

			$username = $_POST["username"]; 
			$pin = $_POST["pin"];
			
			// Variaveis de conexao a BD
			$host="db.ist.utl.pt";	// o MySQL esta disponivel nesta maquina
			$user="ist172744";			// -> substituir pelo nome de utilizador
			$password="gyed4619";		// -> substituir pela password dada pelo mysql_reset // a BD tem nome identico ao utilizador
			$dbname = $user;
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		

			// Obtem o pin da tabela pessoa
			$sql = "SELECT * FROM pessoa WHERE nif=" . $username; 
			$result = $connection->query($sql);
			if (!$result) {
				echo("<p> Erro na Query:($sql)<p>"); 
				exit();
			}

			foreach($result as $row){
		            $safepin = $row["pin"];
		            $nif =     $row["nif"];
		    }

		    if ($safepin != $pin ) {
				echo "<p>Pin Invalido! Tente Novamente</p>\n"; 
				$connection = null;
				exit;
			}
			echo "<h2>Seja Bem-Vindo ao Sistema de Leiloes de Areas Maritimas</h2>\n";

			$_SESSION['nif'] = $nif;
		?>
		</form>
		<form method="get" action="menu.html">
		    <button type="submit">Avancar</button>
		</form>
	</body>
</html>
