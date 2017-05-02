<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Exclusão de agências </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");

	if (isset($_POST['ID_Agencia']))
	{
		$IDAgencia=$_POST['ID_Agencia'];
		if($IDAgencia=="")
			Retornar("de indice da agência ");
	}
	else
		Retornar("de indice da agência ","S");

	$mysqli = new mysqli("localhost", "root", "", "banco");

	if (mysqli_connect_errno()) {
		echo "Falha de conexao: %s\n", mysqli_connect_error();
		exit();
	}
	$query = "select * ";
	$query = $query . "from cadastro_agencia ";
	$query = $query . "where id_agencia = $IDAgencia " ;

	if ($result = $mysqli->query($query)) {

		$row = $result->fetch_assoc();
		echo "<br>";
		echo '<div class="principal">';
		echo '<div class="meio">';
		echo '<h3> Confirmação da exclusão da agência '.$row['NOME'].' </h3>';
		echo '<form method="POST" action="../excluir/Excluir_Agencia.php" autocomplete="off">';
		echo '<b>ID</b> <input type="text" name="ID_AGENCIA" placeholder="Índice da agência"  value = '.$row['ID_AGENCIA'].' required readonly="true" size=6 ><br>';

		echo '<font color="#00008b" size="2" font face="Arial" >';
		echo '<font size="1" color="red" >Informe somente números</font><br>';
		echo '<b>Número: </b> <input type="text" name="Numero" value = '.$row['NUMERO'].' placeholder="Número agência" pattern="[0-9]+$" maxlength="10" size =10 required readonly="true"><br>';
		echo '<b>Nome: </b> <input type="text" name="Nome" value = "'.$row['NOME'].'" placeholder="Nome completo da agência" maxlength="60" size =40 required readonly="true"><br>';
		echo '<b>Endereço: </b> <input type="text" name="Endereco" value = "'.$row['ENDERECO'].'" placeholder="Endereço da agência" maxlength="100" size =50  readonly="true"><br>';
		echo '<b>Cidade: </b> <input type="text" name="Cidade" value = "'.$row['CIDADE'].'" placeholder="Cidade da agência" maxlength="100" size =50  readonly="true"><br>';
		echo '<b>Estado: </b> <input type="text" name="Estado" value = "'.$row['ESTADO'].'" placeholder="Estado da agência" maxlength="2" size =3  readonly="true"><br>';
		echo '<font size="1" color="red" >Informe somente números</font><br>';
		echo '<b>CEP: </b> <input type="text" name="CEP" value = "'.$row['CEP'].'" placeholder="CEP da agência" pattern="[0-9]+$" maxlength="8" size =10 readonly="true" ><br>';
		$ID_B=$row['ID_BANCO'];
		#pesquisar todos os bancos e carregá-los
		include('../funcoes/conexao.php');
		$sql = 'select id_banco, nome from cadastro_banco order by nome';
		$conecta = new Conexao;
		$consulta=$conecta->SQL_Query($sql);
		echo'<b>Banco: </b><select class="form-control" name="ID_Banco" readonly="true">';
		while($Valor = mysql_fetch_array($consulta)){
			if($Valor["id_banco"]==$ID_B){
				echo '<option selected value="'.$Valor["id_banco"].'" required >';
			}
			else {
				echo '<option value="'.$Valor["id_banco"].'" required >';
			}
			echo $Valor["nome"];
			echo'</option>';
		}
		echo'</select>';
		echo'</font>';

		$query = "select * ";
		$query = $query . "from rel_cli_age ";
		$query = $query . "where id_age = $IDAgencia" ;

		if ($result = $mysqli->query($query)) {
			$row = $result->fetch_assoc();
			if($row['ID_AGE']){
				echo '</form>';
				echo '<h4> NÃO É PERMITIDO EXCLUIR UMA AGÊNCIA VINCULADA A UM CLIENTE! </h4>';
				echo '<form method="POST" action="../pesquisar/pesquisa_agencia.php" autocomplete="off">';
				echo '<button type="submit" value="Pesquisa_Agencia">  Pesquisar Agências  </button>';
				echo '</form>';
				echo '<form method="POST" action="../pesquisar/pesquisa_conta.php" autocomplete="off">';
				echo '<button type="submit" value="Pesquisa_Conta">  Pesquisar contas  </button>';
				echo '</form>';
			}
			else{
				echo '<h4> Confirma a exclusão da agência? </h4>';
				echo '<button type="submit" value="Excluir">Excluir</button>';
				echo '</form>';
			}
		}
		else{
			echo '<h4> Confirma a exclusão da agência? </h4>';
			echo '<button type="submit" value="Excluir">Excluir</button>';
			echo '</form>';
		}

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