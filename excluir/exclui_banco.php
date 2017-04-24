<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Exclusão de bancos </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");

	if (isset($_POST['ID_Banco']))
	{
		$IDBanco=$_POST['ID_Banco'];
		if($IDBanco=="")
			Retornar("de indice do banco ");
	}
	else
		Retornar("de indice do banco ","S");

	$mysqli = new mysqli("localhost", "root", "", "banco");

	if (mysqli_connect_errno()) {
		echo "Falha de conexao: %s\n", mysqli_connect_error();
		exit();
	}
	$query = "select * ";
	$query = $query . "from cadastro_banco ";
	$query = $query . "where id_banco = $IDBanco " ;

	if ($result = $mysqli->query($query)) {

		$row = $result->fetch_assoc();
			#var_dump($row);
			echo "<br>";
			echo '<div class="principal">';
			echo '<div class="meio">';
			echo '<h3> Confirmação da exclusão do banco '.$row['NOME'].' </h3>';
			echo '<form method="POST" action="../excluir/Excluir_Banco.php" autocomplete="off">';
			#echo '<input hidden name="ID_BANCO" value = "'.$row['ID_BANCO'].'"';
			echo '<b>ID</b> <input type="text" name="ID_Banco" placeholder="Índice do banco"  value = '.$row['ID_BANCO'].' required readonly="true" ><br>';
			echo '<font color="#00008b" size="2" font face="Arial" >';
			echo '<font size="1" color="red" >Informe somente números</font><br>';
			echo '<b>Código</b> <input type="text" name="Codigo" value = "'.$row['CODIGO'].'" placeholder="Codigo do banco" pattern="[0-9]+$" maxlength="10" required readonly="true"><br>';
			echo '<br>';
			echo '<b>Nome</b> <input type="text" name="Nome"  value = "'.$row['NOME'].'" placeholder="Nome completo do banco" maxlength="50" required readonly="true"><br>';
			echo '<font size="1" color="red" >Informe somente números</font><br>';
			echo '<b>CNPJ</b> <input type="text" name="CNPJ" placeholder="CNPJ do banco"  value = '.$row['CNPJ'].' pattern="[0-9]+$" maxlength="14" required readonly="true"><br>';
			echo '</font>';
			echo '<br>';
			echo '<h3> Confirma a exclusão do banco '.$row['NOME'].'? </h3>';
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
		echo '<a href="../pesquisar/pesquisa_banco.php">Voltar a pesquisa</a>';
		return;
	}
?>

	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>