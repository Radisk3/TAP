<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8"/>
	<title> Relatório de agências </title>
	<link rel="stylesheet" type="text/css" href="../formulario.css"/>
</head>
<body>
<?php
include_once("../funcoes/protege.php");
?>
<br>
<div class="principal">
	<div class="meio">
		<h3> Relatório de agências </h3>
		<form method="POST" action="../relatorios/resultado_agencias.php">
			<font color="#00008b" size="2" font face="Arial" >
				<font size="1" color="red" >Informe o nome da agência e pressione ENTER</font><br>
				<font size="1" color="red" >ou digite 'TODOS' para listar todos as agências</font><br>
				<b>Nome da agência: </b> <input type="text" name="Nome" placeholder="Nome da agência" maxlength="50"><br><br>
				<font size="1" color="red" >Informe o nome do banco e pressione ENTER</font><br>
				<font size="1" color="red" >ou digite 'TODOS' para listar todos os bancos</font><br>
				<b>Nome do banco: </b> <input type="text" name="Banco" placeholder="Nome do banco" maxlength="50" ><br><br>
			</font>
			<button type="submit" value="Pesquisar">Pesquisar</button>
		</form>
		<br>
		<form method="POST" action="../principal.php" autocomplete="off">
			<button type="submit" value="Principal">Página Principal</button>
		</form>
	</div>
</div>
<a href="../funcoes/sair.php">Sair</a>
</body>
</html>