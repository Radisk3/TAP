<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Salvar transferencia </title>
	</head>
	<body>
<?php
	include_once("../funcoes/protege.php");
	if (isset($_POST['ID_RCAD']))
	{
		$ID_RCAD=$_POST['ID_RCAD'];
		if($ID_RCAD=="")
			Retornar("de indice da conta do depositante ");
	}
	else
		Retornar("de indice da conta do depositante ","S");

	if (isset($_POST['ID_RCAF']))
	{
		$ID_RCAF=$_POST['ID_RCAF'];
		if($ID_RCAF=="")
			Retornar("de indice da conta do favorecido ");
	}
	else
		Retornar("de indice da conta do favorecido ","S");

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

	$Valor=str_replace("-","",$Valor);
	include("../funcoes/conexao.php");
	$conecta = new Conexao;
	#0=abertura, 1=deposito, 2=saque, 3=deposito por transferencia, 4=saque por transferencia
	$sql = "insert into hist_mov (id_rca, valor, id_cliente_origem, tipo) 
				values ($ID_RCAF, $Valor, $ID_Cliente, $Tipo)";
	$result=$conecta->SQL_Query($sql);

	$sql = "insert into hist_mov (id_rca, valor, id_cliente_origem, tipo) 
					values ($ID_RCAD, $Valor, $ID_Cliente, 4)";
	$result=$conecta->SQL_Query($sql);

	$sql = 'update rel_cli_age set saldo = saldo+'.$Valor.' where id_rca='.$ID_RCAF;
	$result=$conecta->SQL_Query($sql);

	$sql = 'update rel_cli_age set saldo = saldo-'.$Valor.' where id_rca='.$ID_RCAD;
	$result=$conecta->SQL_Query($sql);

#	session_start();
	$_SESSION['ID_RCA_O'] = $ID_RCAD;
	$_SESSION['ID_RCA_F'] = $ID_RCAF;
	$_SESSION['Valor_Deposito'] = $Valor;

	echo "<h2>Transferência realizada com sucesso!</h2>";
	echo '<br>';
	echo '<meta http-equiv="Refresh" content="1;url=../funcoes/recibo_transferencia.php"></body>';

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
</html>