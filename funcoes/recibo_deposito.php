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

	$TituloR='';
	$TextoR='';
	if ($result = $mysqli->query($query)) {

		$row = $result->fetch_assoc();
		$Dts=date("d/m/Y");
		$Hora=date("H:i:s");
		#var_dump($row);

		echo '<font color="#00008b" size="4" font face="Courier New" >';
		$TituloR='Recibo de Deposito';
		echo '<b>'.$TituloR.'</b><br>';
		echo '<font color="#00008b" size="2" font face="Courier New" >';
		$TextoR=$Dts.' - '.$Hora.''.'<br>';
		$TextoR=$TextoR.'================================================'.'<br>';
		$TextoR=$TextoR.'------------------ FAVORECIDO ------------------'.'<br>';
		$TextoR=$TextoR.'================================================'.'<br>';
		$TextoR=$TextoR.'Cliente: '.$row['cliente'].''.'<br>';
		$TextoR=$TextoR.'RG: '.$row['rg'].''.'<br>';
		$TextoR=$TextoR.'Banco: '.$row['codigo_banco'].' - '.$row['banco'].''.'<br>';
		$TextoR=$TextoR.'Agência: '.$row['numero_agencia'].' - '.$row['agencia'].''.'<br>';
		$TextoR=$TextoR.'Conta: '.$row['conta'].''.'<br>';
		$TextoR=$TextoR.''.'<br>';
		$TextoR=$TextoR.'================================================'.'<br>';
		$TextoR=$TextoR.'------------------ DEPOSITANTE -----------------'.'<br>';
		$TextoR=$TextoR.'================================================'.'<br>';

		$query = "select cadastro_cliente.nome as cliente, ";
		$query = $query . "cadastro_cliente.rg as rg ";
		$query = $query . "from cadastro_cliente ";
		$query = $query . "where id_cliente = $ID_Cliente_Op " ;
		if ($result = $mysqli->query($query)) {
			$row = $result->fetch_assoc();
			$TextoR=$TextoR.'Nome: '. $row['cliente'] .''.'<br>';
			$TextoR=$TextoR.'RG: '.$row['rg'].''.'<br>';
		}
		$TextoR=$TextoR.'================================================'.'<br>';
		$TextoR=$TextoR.'Valor R$: '.number_format($Valor,2,',','.').''.'<br>';
		$TextoR=$TextoR.'================================================'.'<br>';
		$TextoR=utf8_encode($TextoR);
		echo '<font color="#00008b" size="2" font face="Courier New" >';
		echo '<b>'. utf8_encode($TextoR) .'</b><br>';
	}
	$_SESSION['ID_RCA_Op'] = '';
	$_SESSION['ID_Cliente_Op'] = '';
	$_SESSION['Valor_Deposito'] = '';
	$_SESSION['TituloPDF'] = $TituloR;
	$_SESSION['Texto_Recibo'] = $TextoR;
	echo '<form method="POST" action="../funcoes/recibo_pdf.php" target="_blank" autocomplete="off">';
	echo '<button type="submit" value="Recibo">Recibo em PDF</button>';
	echo '</form>';

	$mysqli->close();

	function Retornar($Campo,$Falhou="") {
		echo "<br>";
		echo "<br>";
		if ($Falhou=="")
			echo 'O campo '. $Campo .' não foi preenchido!';
		else
			echo 'Falha ao ler os dados do campo '. $Campo .'!';
		Limpa_Variaveis();
		echo "<br>";
		echo "<br>";
		echo '<a href="../principal.php">Página principal</a>';
		return;
	}
	function Limpa_Variaveis(){
		$_SESSION['ID_RCA_Op'] = '';
		$_SESSION['ID_Cliente_Op'] = '';
		$_SESSION['Valor_Deposito'] = '';
		$_SESSION['TituloPDF'] = '';
		$_SESSION['Texto_Recibo'] = '';
	}
	echo'<form method="POST" action="../pesquisar/pesquisa_conta.php" autocomplete="off">';
	echo'<button type="submit" value="Voltar">Voltar a pesquisa</button>';
	echo'</form>';
	echo'<form method="POST" action="../principal.php" autocomplete="off">';
	echo'<button type="submit" value="Principal">Página Principal</button>';
	echo'</form>';
?>
	<br>
	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>