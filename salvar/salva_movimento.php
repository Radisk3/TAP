<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Salvar movimento </title>
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

	if (isset($_POST['ID_Cliente'])){
		$ID_Cliente=$_POST['ID_Cliente'];
		if($ID_Cliente=="")
			Retornar("Cliente");
	}
	else
		Retornar("Cliente","S");

	if (isset($_POST['Valor'])){
		$Valor=$_POST['Valor'];
		if($Valor=="")
			Retornar("Valor");
	}
	else
		Retornar("Valor","S");

	if (isset($_POST['Tipo'])){
		$Tipo=$_POST['Tipo'];
		if($Tipo=="")
			Retornar("Tipo");
	}
	else
		Retornar("Tipo","S");

	if (isset($_POST['Saldo'])){
		$Saldo=$_POST['Saldo'];
		if($Saldo=="")
			Retornar("Saldo Favorecido");
	}
	else
		Retornar("Saldo Favorecido","S");

	$Valor=str_replace("-","",$Valor);
	include("../funcoes/conexao.php");
	$conecta = new Conexao;
	#0=abertura, 1=deposito, 2=saque, 3=deposito por transferencia, 4=saque por transferencia

	if ($Tipo=='1')
	{
		$sql = 'update rel_cli_age set saldo = saldo+'.$Valor.' where id_rca='.$ID_RCA;
		$Saldo=$Saldo+$Valor;
		echo "<h2>Depósito realizado com sucesso!</h2>";
	}
	elseif ($Tipo=='2') {
		$sql = 'update rel_cli_age set saldo = saldo-'.$Valor.' where id_rca='.$ID_RCA;
		$Saldo=$Saldo-$Valor;
		echo "<h2>Saque realizado com sucesso!</h2>";
	}
	$result=$conecta->SQL_Query($sql);

	$sql = "insert into hist_mov (id_rca, valor, saldo, id_cliente_origem, tipo) 
					values ($ID_RCA, $Valor, $Saldo, $ID_Cliente, $Tipo)";
	$result=$conecta->SQL_Query($sql);

	#	session_start();
	echo '<br>';
	if ($Tipo=='1') {
		$_SESSION['ID_RCA_Op'] = $ID_RCA;
		$_SESSION['ID_Cliente_Op'] = $ID_Cliente;
		$_SESSION['Valor_Deposito'] = $Valor;
		echo '<meta http-equiv="Refresh" content="2;url=../funcoes/recibo_deposito.php"></body>';
	}
	elseif ($Tipo=='2') {
		$_SESSION['ID_RCA_Op'] = $ID_RCA;
		$_SESSION['Valor_Deposito'] = $Valor;
		echo '<meta http-equiv="Refresh" content="2;url=../funcoes/recibo_saque.php"></body>';
	}
function Retornar($Campo,$Falhou="") {
	echo "<br>";
	echo "<br>";
	if ($Falhou=="")
		echo 'O campo '. $Campo .' não foi preenchido!';
	else
		echo 'Falha ao ler os dados do campo '. $Campo .'!';
	echo "<br>";
	echo "<br>";
	echo '<a href="../pesquisar/pesquisa_agencia.php">Voltar a pesquisa</a>';
	return;
}
?>
</html>