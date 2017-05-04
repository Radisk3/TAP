<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Movimentação de contas </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");

	if (isset($_SESSION['ID_RCA']))
	{
		$ID_RCA=$_SESSION['ID_RCA'];
		if($ID_RCA=="")
			Retornar("de indice da conta ");
	}
	else
		Retornar("de indice da conta ","S");
	$_SESSION['ID_RCA']='';

	$mysqli = new mysqli("localhost", "root", "", "banco");

	if (mysqli_connect_errno()) {
		echo "Falha de conexao: %s\n", mysqli_connect_error();
		exit();
	}
	$query = "select rel_cli_age.id_rca, ";
	$query = $query . "rel_cli_age.conta, ";
	$query = $query . "rel_cli_age.saldo, ";
	$query = $query . "rel_cli_age.id_age, ";
	$query = $query . "rel_cli_age.id_cli, ";
	$query = $query . "cadastro_cliente.nome as cliente, ";
	$query = $query . "cadastro_cliente.rg as rg, ";
	$query = $query . "cadastro_agencia.nome as agencia, ";
	$query = $query . "cadastro_banco.nome as banco ";
	$query = $query . "from rel_cli_age ";
	$query = $query . "inner join cadastro_cliente on (cadastro_cliente.id_cliente = rel_cli_age.id_cli) ";
	$query = $query . "inner join cadastro_agencia on (cadastro_agencia.id_agencia = rel_cli_age.id_age) ";
	$query = $query . "inner join cadastro_banco on (cadastro_banco.id_banco = cadastro_agencia.id_banco) ";
	$query = $query . "where id_rca = $ID_RCA " ;

	if ($result = $mysqli->query($query)) {

		$row = $result->fetch_assoc();
		#var_dump($row);
		echo '<div class="principal">';
		echo '<div class="meio">';
		echo '<div class="esquerda">';
		echo '<h3> Movimentação da conta  - Depósito própria conta </h3>';
		echo '<form method="POST" action="../salvar/salva_movimento.php" autocomplete="off">';
		echo '<input type="text" hidden="true" name="ID_RCA" placeholder="Índice da conta"  value = "'.$row['id_rca'].'" required readonly="true" size=6 >';
		echo '<input type="text" hidden="true" name="ID_Cliente" placeholder="Cliente da conta"  value = "'.$row['id_cli'].'" required readonly="true" size=6 >';
		echo '<input type="text" hidden="true" name="Tipo" value = "1">';
#		echo '<b>Tipo de movimento: </b> <input type="text" name="Tipo" value = "'.$NomeTipo.'" size =10 required readonly="true" ><br>';
		echo '<font color="#00008b" size="2" font face="Arial" >';
		echo '<b>Cliente: </b>';
		echo '<font color="#8b0000" size="2" font face="Arial" >';
		echo '<b>'.$row['cliente'].'</b><br>';
		echo '<font color="#00008b" size="2" font face="Arial" >';
		echo '<b>RG: </b>';
		echo '<font color="#8b0000" size="2" font face="Arial" >';
		echo '<b>'.$row['rg'].'</b><br>';
		echo '<font color="#00008b" size="2" font face="Arial" >';
		echo '<b>Conta: </b>';
		echo '<font color="#8b0000" size="2" font face="Arial" >';
		echo '<b>'.$row['conta'].'</b> <br>';
		echo '<font color="#00008b" size="2" font face="Arial" >';
		echo '<b>Agência: </b>';
		echo '<font color="#8b0000" size="2" font face="Arial" >';
		echo '<b>'.$row['agencia'].'</b><br>';
		echo '<font color="#00008b" size="2" font face="Arial" >';
		echo '<b>Banco: </b>';
		echo '<font color="#8b0000" size="2" font face="Arial" >';
		echo '<b>'.$row['banco'].'</b><br>';
		$Dts=date("d/m/Y");
		echo '<font color="#00008b" size="2" font face="Arial" >';
		echo '<b>Data: </b>';
		echo '<font color="#8b0000" size="2" font face="Arial" >';
		echo '<b>'.$Dts.'</b><br>';
		$Dts=date("H:i:s");
		echo '<font color="#00008b" size="2" font face="Arial" >';
		echo '<b>Hora: </b>';
		echo '<font color="#8b0000" size="2" font face="Arial" >';
		echo '<b>'.$Dts.'</b><br>';
		echo '<font color="#00008b" size="2" font face="Arial" >';
		echo '<input type="text" name="Saldo" VALUE="'.$row['saldo'].'" hidden="true" readonly="true">';
		echo '<b>Valor: </b> <input type="number" name="Valor" placeholder="Valor R$" step="any" maxlength="10" size =10 required><br>';
		echo '<br>';
		echo '<button type="submit" value="Salvar">  DEPOSITAR  </button>';
		echo'</font>';
		echo'</form>';
		echo '<br>';
		echo '<br>';
		echo '<form method="POST" action="../pesquisar/pesquisa_conta.php" autocomplete="off">';
		echo '<button type="submit" value="Voltar a pesquisa">Voltar a pesquisa</button>';
		echo '</form>';
		echo '<br>';
		echo '<form method="POST" action="../principal.php" autocomplete="off">';
		echo '<button type="submit" value="Principal">Página Principal</button>';
		echo '</form>';
		echo '<br>';
		echo '</div>';
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
		echo '<a href="../pesquisar/pesquisa_agencia.php">Voltar a pesquisa</a>';
		return;
	}
?>
	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>