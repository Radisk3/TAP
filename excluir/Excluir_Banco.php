<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Exclusão de bancos </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");

	if (isset($_POST['ID_Banco']))
	{
		$IDBanco=$_POST['ID_Banco'];
		if($IDBanco=="")
			Retornar("de indice do banco ");
	}
	else
		Retornar("de indice do banco ","S");

	$mysqli = new mysqli("localhost", "root", "", "banco");

	if (mysqli_connect_errno()) {
		echo "Falha de conexao: %s\n", mysqli_connect_error();
		exit();
	}
	$sql='delete from cadastro_banco where id_banco='.$IDBanco;

	if ($mysqli->query($sql) === TRUE) {
		echo '<h3> Registro excluído com sucesso! </h3>';
	} else {
		echo '<h3> Erro ao excluir o registro: ' . $mysqli->error . ' </h3>';
	}

	$mysqli->close();
	echo "<br>";
	echo '<meta http-equiv="Refresh" content="3;url=../pesquisar/pesquisa_banco.php"></body>';

	function Retornar($Campo,$Falhou="") {
		echo "<br>";
		echo "<br>";
		if ($Falhou=="")
			echo 'O campo '. $Campo .' não foi preenchido!';
		else
			echo 'Falha ao ler os dados do campo '. $Campo .'!';
		echo "<br>";
		echo "<br>";
		echo '<a href="../pesquisar/pesquisa_banco.php">Voltar a pesquisa</a>';
		return;
	}
?>

	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>