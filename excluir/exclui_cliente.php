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

	if (isset($_POST['ID_CLIENTE']))
	{
		$IDCliente=$_POST['ID_CLIENTE'];
		if($IDCliente=="")
			Retornar("de indice do cliente ");
	}
	else
		Retornar("de indice do cliente ","S");

	$mysqli = new mysqli("localhost", "root", "", "banco");

	if (mysqli_connect_errno()) {
		echo "Falha de conexao: %s\n", mysqli_connect_error();
		exit();
	}
	$query = "select * ";
	$query = $query . "from cadastro_cliente ";
	$query = $query . "where id_cliente = $IDCliente " ;

	if ($result = $mysqli->query($query)) {

		$row = $result->fetch_assoc();
			#var_dump($row);
			echo "<br>";
			echo '<div class="principal">';
			echo '<div class="meio">';
			echo '<h3> Confirmação da exclusão do cliente '.$row['NOME'].' </h3>';
			echo '<form method="POST" action="../excluir/Excluir_Cliente.php" autocomplete="off">';
			echo '<b>ID</b> <input type="text" name="ID_Cliente" placeholder="Índice do cliente "  value = '.$row['ID_CLIENTE'].' required readonly="true" ><br>';
			echo '<font color="#00008b" size="2" font face="Arial" >';
			echo '<b>Nome</b> <input 	type="text" 	name="Nome"  value = "'.$row['NOME'].'" placeholder="Nome completo do cliente" maxlength="60" required readonly="true"><br>';
			echo '<b>CPF</b> <input 	type="text" 	name="CPF" 		placeholder="CPF"  		value = "'.$row['CPF'].'" 	pattern="[0-9]+$" maxlength="14" required readonly="true"><br>';
			echo '<b>RG</b> <input 		type="text" 	name="RG" 		placeholder="RG"  		value = "'.$row['RG'].'" 		pattern="[0-9]+$" maxlength="12" required readonly="true"><br>';
			echo '<b>Rua</b> <input 	type="text" 	name="Rua" 		placeholder="Rua"  		value = "'.$row['RUA'].'" 	maxlength="14" required readonly="true"><br>';
			echo '<b>Número</b> <input 	type="text" 	name="Numero" 	placeholder="Número"  	value = "'.$row['NUMERO'].'" 	maxlength="14" required readonly="true"><br>';
			echo '<b>Complemento</b> <input type="text" name="Complemento" placeholder="Complemento"  value = "'.$row['COMPLEMENTO'].'" maxlength="14" required readonly="true"><br>';
			echo '<b>Telefone</b> <input type="text" 	name="Telefone" placeholder="Telefone"  value = "'.$row['TELEFONE'].'" pattern="[0-9]+$" maxlength="14" required readonly="true"><br>';
			echo '<b>Cidade</b> <input 	type="text" 	name="Cidade" 	placeholder="Cidade"  	value = "'.$row['CIDADE'].'" 	maxlength="14" required readonly="true"><br>';
			echo '<b>Estado</b> <input 	type="text" 	name="Estado" 	placeholder="Estado"  	value = "'.$row['ESTADO'].'" 	maxlength="14" required readonly="true"><br>';
			echo '<b>CEP</b> <input 	type="text" 	name="CEP" 		placeholder="CEP"  		value = "'.$row['CEP'].'" 	pattern="[0-9]+$" maxlength="14" required readonly="true"><br>';
			echo '<b>Data Moradia</b> <input type="text" name="DM" 		placeholder="Data Moradia"  value = '.$row['DATA_MORADIA'].' pattern="[0-9/]+$" maxlength="14" required readonly="true"><br>';
			echo '</font>';
			echo '<br>';
			echo '<h3> Confirma a exclusão do cliente '.$row['NOME'].'? </h3>';
			echo '<button type="submit" value="Excluir">Excluir</button>';
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
		echo '<a href="../pesquisar/pesquisa_cliente.php">Voltar a pesquisa</a>';
		return;
	}
?>

	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>