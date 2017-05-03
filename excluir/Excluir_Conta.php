<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Exclusão de contas </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");

	if (isset($_POST['ID_RCA']))
	{
		$ID_RCA=$_POST['ID_RCA'];
		if($ID_RCA=="")
			Retornar("de indice da conta ");
	}
	else
		Retornar("de indice da conta ","S");

	$mysqli = new mysqli("localhost", "root", "", "banco");

	if (mysqli_connect_errno()) {
		echo "Falha de conexao: %s\n", mysqli_connect_error();
		exit();
	}

	$sql='update rel_cli_age set excluido = 1, MOTIVO = 2, REMOCAO = CURRENT_TIMESTAMP() where ID_RCA='.$ID_RCA;

	if ($mysqli->query($sql) === TRUE) {
		echo '<h3> Registro excluído com sucesso! </h3>';
	} else {
		echo '<h3> Erro ao excluir o registro: ' . $mysqli->error . ' </h3>';
	}

	$mysqli->close();
	echo "<br>";
	echo '<meta http-equiv="Refresh" content="3;url=../pesquisar/pesquisa_conta.php"></body>';

	function Retornar($Campo,$Falhou="") {
		echo "<br>";
		echo "<br>";
		if ($Falhou=="")
			echo 'O campo '. $Campo .' não foi preenchido!';
		else
			echo 'Falha ao ler os dados do campo '. $Campo .'!';
		echo "<br>";
		echo "<br>";
		echo '<a href="../pesquisar/pesquisa_conta.php">Voltar a pesquisa</a>';
		return;
	}
?>
	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>