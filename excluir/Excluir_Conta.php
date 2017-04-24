<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Exclusão de clientes </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");

	if (isset($_POST['ID_Cliente']))
	{
		$IDCliente=$_POST['ID_Cliente'];
		if($IDCliente=="")
			Retornar("de indice do cliente ");
	}
	else
		Retornar("de indice do cliente ","S");

	$mysqli = new mysqli("localhost", "root", "", "banco");

	if (mysqli_connect_errno()) {
		echo "Falha de conexao: %s\n", mysqli_connect_error();
		exit();
	}
	#VERIFICA SE O CLIENTE TEM CONTA ATIVA
	$query = "select id_rca ";
	$query = $query . "from rel_cli_age ";
	$query = $query . "where excluido = 0 " ;
	$query = $query . "and id_cli = $IDCliente " ;

	if ($result = $mysqli->query($query)) {
		$row = $result->fetch_assoc();
		#var_dump($row);
		echo "<br>";
		echo '<h3> O cliente possui conta ativa </h3>';
		echo '<meta http-equiv="Refresh" content="5;url=../pesquisar/pesquisa_cliente.php"></body>';
	}else{
		$sql='update cadastro_cliente set excluido = "S" where ID_Cliente='.$IDCliente;

		if ($mysqli->query($sql) === TRUE) {
			echo '<h3> Registro excluído com sucesso! </h3>';
		} else {
			echo '<h3> Erro ao excluir o registro: ' . $mysqli->error . ' </h3>';
		}

		$mysqli->close();
		echo "<br>";
		echo '<meta http-equiv="Refresh" content="3;url=../pesquisar/pesquisa_cliente.php"></body>';

		function Retornar($Campo,$Falhou="") {
			echo "<br>";
			echo "<br>";
			if ($Falhou=="")
				echo 'O campo '. $Campo .' não foi preenchido!';
			else
				echo 'Falha ao ler os dados do campo '. $Campo .'!';
			echo "<br>";
			echo "<br>";
			echo '<a href="../pesquisar/pesquisa_cliente.php">Voltar a pesquisa</a>';
			return;
		}
	}
?>

	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>