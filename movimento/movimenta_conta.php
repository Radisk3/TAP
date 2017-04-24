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
		echo '<h3> Movimentação da conta '.$row['conta'].' </h3>';
		echo '<form method="POST" action="../salvar/salva_movimento.php" autocomplete="off">';
		echo '<b>ID</b> <input type="text" name="ID_RCA" placeholder="Índice da conta"  value = '.$row['id_rca'].' required readonly="true" size=6 ><br>';
		echo '<font color="#00008b" size="2" font face="Arial" >';
		echo '<b>Nome: </b> <input type="text" name="Nome" value = "'.$row['cliente'].'" placeholder="Nome do cliente" maxlength="60" size =30 required readonly="true" ><br>';
		echo '<b>RG: </b> <input type="text" name="RG" value = "'.$row['rg'].'" placeholder="RG" maxlength="14" size =10 required readonly="true" ><br>';
		echo '<b>Conta: </b> <input type="text" name="Conta" value = "'.$row['conta'].'" placeholder="Número conta" pattern="[0-9]+$" maxlength="10" size =10 required readonly="true" ><br>';
		echo '<b>Agência: </b> <input type="text" name="Agencia" value = "'.$row['agencia'].'" placeholder="Número agência" pattern="[0-9]+$" maxlength="10" size =10 required readonly="true" ><br>';
		echo '<b>Banco: </b> <input type="text" name="Banco" value = "'.$row['banco'].'" placeholder="Número banco" pattern="[0-9]+$" maxlength="10" size =10 required readonly="true" ><br>';
		echo '<b>Valor: </b> <input type="number" name="Valor" placeholder="Valor R$" step="any" maxlength="10" size =10 required><br>';
		$Dts=date("d/m/Y");
		echo '<b>Data: </b> <input type="text" name="Data" placeholder="Data" value = "'.$Dts.'" maxlength="10" required size =10 readonly="true"><br>';
		$Dts=date("H:i:s");
		echo '<b>Hora: </b> <input type="text" name="Hora" placeholder="Hora" value = "'.$Dts.'" maxlength="10" required size =10 readonly="true">';
		echo '<br>';
		echo '<b>Tipo movimento: </b>';
		echo '<select class="form-control" name="Tipo">';
		echo '<option value = "1" required >Depósito</option>';
		echo '<option value = "2" required >Saque</option>';
		echo '<option value = "3" required >Transferência</option>';
		echo '</select>';

		echo'</font>';
		echo'</form>';
		echo '<br>';
		echo '<br>';
		echo '<form method="POST" action="../salvar/salva_agencia.php" autocomplete="off">';
		echo '<button type="submit" value="Salvar">  Salvar  </button>';
		echo '</form>';
		echo '<br>';
		echo '<form method="POST" action="../pesquisar/pesquisa_agencia.php" autocomplete="off">';
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