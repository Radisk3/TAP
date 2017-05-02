<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Recibo de Depósito </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");

	if (isset($_SESSION['ID_RCA_Op']))
	{
		$ID_RCA_0=$_SESSION['ID_RCA_Op'];
		if($ID_RCA_0=="")
			Retornar("de indice da conta ");
	}
	else
		Retornar("de indice da conta ","S");

	if (isset($_SESSION['ID_Cliente_Op']))
	{
		$ID_Cliente_Op=$_SESSION['ID_Cliente_Op'];
		if($ID_Cliente_Op=="")
			Retornar("de indice do cliente ");
	}
	else
		Retornar("de indice do cliente ","S");

	if (isset($_SESSION['Valor_Deposito']))
	{
		$Valor=$_SESSION['Valor_Deposito'];
		if($Valor=="")
			Retornar("Valor ");
	}
	else
		Retornar("Valor","S");

	$mysqli = new mysqli("localhost", "root", "", "banco");

	if (mysqli_connect_errno()) {
		echo "Falha de conexao: %s\n", mysqli_connect_error();
		exit();
	}
	$query = "select rel_cli_age.conta as conta, ";
	$query = $query . "cadastro_cliente.nome as cliente, ";
	$query = $query . "cadastro_cliente.rg as rg, ";
	$query = $query . "cadastro_agencia.numero as numero_agencia, ";
	$query = $query . "cadastro_agencia.nome as agencia, ";
	$query = $query . "cadastro_banco.codigo as codigo_banco, ";
	$query = $query . "cadastro_banco.nome as banco ";
	$query = $query . "from rel_cli_age ";
	$query = $query . "inner join cadastro_cliente on (cadastro_cliente.id_cliente = rel_cli_age.id_cli) ";
	$query = $query . "inner join cadastro_agencia on (cadastro_agencia.id_agencia = rel_cli_age.id_age) ";
	$query = $query . "inner join cadastro_banco on (cadastro_banco.id_banco = cadastro_agencia.id_banco) ";
	$query = $query . "where id_rca = $ID_RCA_0 " ;

	if ($result = $mysqli->query($query)) {

		$row = $result->fetch_assoc();
		$Dts=date("d/m/Y");
		$Hora=date("H:i:s");
		#var_dump($row);
		echo '<font color="#00008b" size="4" font face="Courier New" >';
		echo '<b>Recibo de Depósito</b><br>';
		echo '<font color="#00008b" size="2" font face="Courier New" >';
		echo '<b>'.$Dts.'</b> - <b>'.$Hora.'</b><br>';
		echo '<b>╔====================================================╗</b><br>';
		echo '<b>║-------------------- FAVORECIDO --------------------║ </b><br>';
		echo '<b>╚====================================================╝</b><br>';
		echo '<b>Cliente: </b>';
		echo '<b>'.$row['cliente'].'</b> <br>';
		echo '<b>RG: </b>';
		echo '<b>'.$row['rg'].'</b> <br>';
		echo '<b>Banco: </b>';
		echo '<b>'.$row['codigo_banco'].'</b> - ';
		echo '<b>'.$row['banco'].'</b> <br>';
		echo '<b>Agência: </b>';
		echo '<b>'.$row['numero_agencia'].'</b> - ';
		echo '<b>'.$row['agencia'].'</b> <br>';
		echo '<b>Conta: </b>';
		echo '<b>'.$row['conta'].'</b> <br>';

		echo '<b>╔====================================================╗</b><br>';
		echo '<b>║-------------------- DEPOSITANTE -------------------║ </b><br>';
		echo '<b>╚====================================================╝</b><br>';
		$query = "select cadastro_cliente.nome as cliente, ";
		$query = $query . "cadastro_cliente.rg as rg ";
		$query = $query . "from cadastro_cliente ";
		$query = $query . "where id_cliente = $ID_Cliente_Op " ;
		if ($result = $mysqli->query($query)) {
			$row = $result->fetch_assoc();
			echo '<b>Nome: </b>';
			echo '<b>' . $row['cliente'] . '</b> <br>';
			echo '<b>RG: </b>';
			echo '<b>'.$row['rg'].'</b> <br>';
		}

		echo '<b>======================================================</b><br>';
		echo '<font color="#00008b" size="3" font face="Courier New" >';
		echo '<b>Valor R$: </b>';
		echo '<b>'.number_format($Valor,2,',','.').'</b> <br>';
		echo '<font color="#00008b" size="2" font face="Courier New" >';
		echo '<b>======================================================</b><br>';
		echo '<br>';
		echo '<br>';
	}
	$_SESSION['ID_RCA_Op'] = '';
	$_SESSION['ID_Cliente_Op'] = '';
	$_SESSION['Valor_Deposito'] = '';

	$mysqli->close();

	function Retornar($Campo,$Falhou="") {
		echo "<br>";
		echo "<br>";
		if ($Falhou=="")
			echo 'O campo '. $Campo .' não foi preenchido!';
		else
			echo 'Falha ao ler os dados do campo '. $Campo .'!';
		echo "<br>";
		$_SESSION['ID_RCA_Op'] = '';
		$_SESSION['ID_Cliente_Op'] = '';
		$_SESSION['Valor_Deposito'] = '';
		echo "<br>";
		echo '<a href="../principal.php">Página principal</a>';
		return;
	}
?>
	<form method="POST" action="../pesquisar/pesquisa_conta.php" autocomplete="off">
		<button type="submit" value="Voltar">Voltar a pesquisa</button>
	</form>
	<form method="POST" action="../principal.php" autocomplete="off">
		<button type="submit" value="Principal">Página Principal</button>
	</form>
	<br>
	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>