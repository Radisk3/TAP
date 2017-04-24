<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Cadastro de conta </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");
?>
<?php
	include('../funcoes/conexao.php');
?>
<?php
	if (isset($_POST['ID_Agencia']))
	{
		$ID_Agencia=$_POST['ID_Agencia'];
		if($ID_Agencia=="")
			Retornar("ID_Agencia");
		}
	else
		Retornar("ID_Agencia","S");
	
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
<br>
<div class="principal">
	<div class="meio">
		<h3> Cadastro de contas - Selecão do cliente </h3>
		<?php
		$mysqli = new mysqli("localhost", "root", "", "banco");
		if (mysqli_connect_errno()) {
			echo "Falha de conexao: %s\n", mysqli_connect_error();
			exit();
		}
		$sql = 'select nome from cadastro_agencia 
					where id_agencia = '.$ID_Agencia;
		if ($result = $mysqli->query($sql)) {
			$row = $result->fetch_assoc();
			$Nome= $row['nome'];
		}
		mysqli_close($mysqli);
		?>
		<div class="esquerda">
		<form method="POST" action="../salvar/salva_conta.php" autocomplete="off">
			<font color="#00008b" size="2" font face="Arial" >
				<?php
				echo '<input type="text" name="ID_Agencia" value="'.$ID_Agencia.'" placeholder="ID Agênca" hidden="true">';
				echo'<font size="1" color="red" >Agência selecionada</font><br>';
				echo '<b>Agência: </b> <input type="text" name="Conta" value="'.$Nome.'" placeholder="Número conta" pattern="[0-9]+$" maxlength="10" size =10 required readonly="true"><br>';
				?>
				<font size="1" color="red" >Selecione o CLIENTE</font><br>
				<b>Cliente: </b><select class="form-control" name="ID_Cliente">
				<?php
					$conecta = new Conexao;
					$sql = 'select id_cliente, nome from cadastro_cliente where excluido is null order by nome';
					$Consulta_Cliente=$conecta->SQL_Query($sql);
					while($Valor = mysql_fetch_array($Consulta_Cliente)){
					echo '<option value="'.$Valor["id_cliente"].'" required >';
					echo $Valor["nome"];
					echo'</option>';
					mysqli_close($conecta);
				}?>
				</select>
				<br>
				<font size="1" color="red" >Número da conta</font><br>
				<?php
				$mysqli = new mysqli("localhost", "root", "", "banco");
				if (mysqli_connect_errno()) {
					echo "Falha de conexao: %s\n", mysqli_connect_error();
					exit();
				}
				$sql = 'select max(conta) as conta from rel_cli_age 
					where excluido = 0  
					and id_age = '.$ID_Agencia;
				if ($result = $mysqli->query($sql)) {
					$row = $result->fetch_assoc();
					$Conta= $row['conta'];
				}
				if ($Conta==''||$Conta==null)
					$Conta='1';
				else
					$Conta=$Conta+1;
				#echo $sql.' - '.$ID_Agencia .' - '.$Conta.' - ';
				echo '<b>Conta: </b> <input type="number" name="Conta" value="'.$Conta.'" placeholder="Número conta" pattern="[0-9]+$" maxlength="10" size =10 required readonly="true"><br>';
				mysqli_close($mysqli);
				?>
				<font size="1" color="red" >Informe o saldo inicial</font><br>
				<b>Saldo: </b> <input type="number" name="Saldo" placeholder="Saldo inicial" step="any" maxlength="10" size =10 required><br>
			</font>
			<br>
			<button type="submit" value="Salvar">   Salvar   </button>
		</form>
		</div>
			<br>
		<form method="POST" action="../principal.php" autocomplete="off">
			<button type="submit" value="Principal">Página Principal</button>
		</form>
		<br>
	</div>
</div>
	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>