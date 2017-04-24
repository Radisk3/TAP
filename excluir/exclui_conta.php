<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Exclusão de cliente </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");

	if (isset($_POST['ID_RCA']))
	{
		$IDRCA=$_POST['ID_RCA'];
		if($IDRCA=="")
			Retornar("de indice da conta ");
	}
	else
		Retornar("de indice da conta ","S");

	$mysqli = new mysqli("localhost", "root", "", "banco");

	if (mysqli_connect_errno()) {
		echo "Falha de conexao: %s\n", mysqli_connect_error();
		exit();
	}
	$query = "select * ";
	$query = $query . "from rel_cli_age ";
	$query = $query . "where id_rca = $IDRCA ";

	if ($result = $mysqli->query($query)) {

		$row = $result->fetch_assoc();
		#var_dump($row);
		echo "<br>";
		echo '<div class="principal">';
		echo '<div class="meio">';
		echo '<h3> Confirmação da exclusão de conta '.$row['CONTA'].' </h3>';
		echo '<form method="POST" action="../excluir/Excluir_Conta.php" autocomplete="off">';
		echo '<font color="#00008b" size="2" font face="Arial" >';
		echo '<b>ID</b> <input type="text" name="ID_RCA" placeholder="Índice da conta "  value = '.$row['ID_RCA'].' required readonly="true" ><br>';
		echo '<b>Conta</b> <input 	type="text" 	name="Conta"  	value = "'.$row['CONTA'].'" maxlength="10" size =10 required readonly="true"><br>';
		echo '<b>Saldo</b> <input 	type="text" 	name="Saldo" 	value = "'.$row['SALDO'].'" maxlength="10" size =10 required readonly="true"><br>';
		echo '</font>';
		echo '<br>';
		echo '<h3> Confirma a exclusão da conta '.$row['CONTA'].'? </h3>';
		if($row['SALDO']==0)
			echo '<button type="submit" value="Excluir">Excluir</button>';
		else{
			echo '<h4> NÃO É PERMITIDO EXCLUIR UMA CONTA COM SALDO! </h4>';
			echo '<form method="POST" action="../pesquisar/pesquisa_conta.php" autocomplete="off">';
			echo '<button type="submit" value="Pesquisa_Conta">  Pesquisar contas  </button>';
			echo '</form>';
		}
		echo '</form>';
		echo '<br>';
		echo '<form method="POST" action="../principal.php" autocomplete="off">';
		echo '<button type="submit" value="Principal">Página Principal</button>';
		echo '</form>';
		echo '</div>';
		echo '</div>';
	}

	$mysqli->close();

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