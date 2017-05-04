<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Recibo de Transferência </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");

	if (isset($_SESSION['ID_RCA_O']))
	{
		$ID_RCA_0=$_SESSION['ID_RCA_O'];
		if($ID_RCA_0=="")
			Retornar("de indice da conta depositante ");
	}
	else
		Retornar("de indice da conta depositante","S");

	if (isset($_SESSION['ID_RCA_F']))
	{
		$ID_RCA_F=$_SESSION['ID_RCA_F'];
		if($ID_RCA_F=="")
			Retornar("de indice da conta favorecido ");
	}
	else
		Retornar("de indice da conta favorecido","S");

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

		$TituloR='Tranferência entre contas';
		$TituloR=mb_convert_encoding($TituloR,'UTF-8');
		$TextoR=$Dts.' - '.$Hora.''.'<br>';
		$TextoR=$TextoR.'================================================'.'<br>';
		$TextoR=$TextoR.'------------------ DEPOSITANTE -----------------'.'<br>';
		$TextoR=$TextoR.'================================================'.'<br>';
		$TextoR=$TextoR.'Cliente: '.$row['cliente'].''.'<br>';
		$TextoR=$TextoR.'RG: '.$row['rg'].''.'<br>';
		$TextoR=$TextoR.'Banco: '.$row['codigo_banco'].' - '.$row['banco'].''.'<br>';
		$TextoR=$TextoR.'Agência: '.$row['numero_agencia'].' - '.$row['agencia'].''.'<br>';
		$TextoR=$TextoR.'Conta: '.$row['conta'].''.'<br>';
		$TextoR=$TextoR.''.'<br>';
		$TextoR=$TextoR.'================================================'.'<br>';
		$TextoR=$TextoR.'------------------ FAVORECIDO ------------------'.'<br>';
		$TextoR=$TextoR.'================================================'.'<br>';

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
		$query = $query . "where id_rca = $ID_RCA_F " ;
		if ($result = $mysqli->query($query)) {
			$row = $result->fetch_assoc();
			$TextoR=$TextoR.'Favorecido: '. $row['cliente'] .''.'<br>';
			$TextoR=$TextoR.'RG: '.$row['rg'].''.'<br>';
			$TextoR=$TextoR.'Banco: '.$row['codigo_banco'].' - '.$row['banco'].''.'<br>';
			$TextoR=$TextoR.'Agência: '.$row['numero_agencia'].' - '.$row['agencia'].''.'<br>';
			$TextoR=$TextoR.'Conta: '.$row['conta'].''.'<br>';
		}
		$TextoR=$TextoR.'================================================'.'<br>';
		$TextoR=$TextoR.'Valor R$: '.number_format($Valor,2,',','.').''.'<br>';
		$TextoR=$TextoR.'================================================'.'<br>';
		$TextoR=mb_convert_encoding($TextoR,'UTF-8');
		echo '<font color="#00008b" size="4" font face="Courier New" >';
		echo '<b>'.$TituloR.'</b><br>';
		echo '<font color="#00008b" size="2" font face="Courier New" >';
		echo '<font color="#00008b" size="2" font face="Courier New" >';
		echo '<b>'. $TextoR .'<b><br>';
	}
	$_SESSION['ID_RCA_O'] = '';
	$_SESSION['ID_RCA_F'] = '';
	$_SESSION['Valor_Deposito'] = '';

	$Dts=date("Ymd");
	$Hora=date("His");
	$_SESSION['Data_Hora'] = $Dts.'_'.$Hora;
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
		echo "<br>";
		Limpa_Variaveis();
		echo "<br>";
		echo '<a href="../principal.php">Página principal</a>';
		return;
	}
	function Limpa_Variaveis(){
		$_SESSION['ID_RCA_O'] = '';
		$_SESSION['ID_RCA_F'] = '';
		$_SESSION['Valor_Deposito'] = '';
		$_SESSION['Data_Hora'] = '';
		$_SESSION['TituloPDF'] = '';
		$_SESSION['Texto_Recibo'] = '';
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