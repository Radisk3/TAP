<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Remove contas com saldo zero </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");

	$mysqli = new mysqli("localhost", "root", "", "banco");

	if (mysqli_connect_errno()) {
		echo "Falha de conexao: %s\n", mysqli_connect_error();
		CaiFora();
		exit();
	}
	$query = "SELECT rel_cli_age.ID_RCA as ID_CONTA ";
	$query = $query . "FROM `hist_mov` ";
	$query = $query . "INNER JOIN rel_cli_age ON hist_mov.ID_RCA=rel_cli_age.ID_RCA ";
	$query = $query . "WHERE hist_mov.DATA < (CURRENT_DATE - INTERVAL 1 YEAR) ";
	$query = $query . "AND rel_cli_age.SALDO=0 ";
	$query = $query . "AND rel_cli_age.EXCLUIDO=0";
	$Cods='0';
	if ($result = $mysqli->query($query)) {
		while($row = $result->fetch_assoc()){
			$Cods=$Cods . ','.$row['ID_CONTA'];
		}
	}
	$query = "UPDATE rel_cli_age SET rel_cli_age.EXCLUIDO=1, MOTIVO = 2, REMOCAO = CURRENT_TIMESTAMP() ";
	$query = $query . "WHERE rel_cli_age.ID_RCA IN(".$Cods.")" ;

	if ($result = $mysqli->query($query)) {
		if ($result=0 && $Cods!='0')
			CaiFora();
	}

	$mysqli->close();
	if($Cods!='0')
		echo '<h4> Contas foram removidas!! </h4>';
	else
		echo '<h3> Sem contas a remover!! </h3>';
	echo '<h3> Redirecionando para a página principal!! </h3>';
	echo '<meta http-equiv="Refresh" content="3;url=../principal.php"></body>';

	function CaiFora() {
		echo '<h4> Falha ao remover contas!! </h4>';
		header('Location:../principal.php');
		return;
	}
?>
	<form method="POST" action="../principal.php" autocomplete="off">
		<button type="submit" value="Principal">Página Principal</button>
	</form>
	<br>
	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>