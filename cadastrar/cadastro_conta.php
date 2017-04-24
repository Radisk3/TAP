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
<br>
<div class="principal">
	<div class="meio">
	<h3> Cadastro de contas </h3>
		<div class="esquerda">
		<form method="POST" action="../cadastrar/cadastro_conta2.php" autocomplete="off">
			<font color="#00008b" size="2" font face="Arial" >
				<font size="1" color="red" >Selecione a AGÊNCIA</font><br>
				<b>Agência: </b><select class="form-control" name="ID_Agencia">
				<?php
					$sql = 'select id_agencia, nome from cadastro_agencia order by nome';
					$conecta = new Conexao;
					$Consulta_Agencia=$conecta->SQL_Query($sql);
					while($Valor = mysql_fetch_array($Consulta_Agencia)){
					echo '<option value="'.$Valor["id_agencia"].'" required >';
					echo $Valor["nome"];
					echo'</option>';
					mysqli_close($conecta);
				}?>
				</select>
				<br>
			</font>
			<br>
			<button type="submit" value="Proximo">   Próximo   </button>
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