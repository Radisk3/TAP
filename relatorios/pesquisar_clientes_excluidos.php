<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8"/>
	<title> Pesquisa de clientes excluídos </title>
	<link rel="stylesheet" type="text/css" href="../formulario.css"/>
</head>
<body>
<?php
	include_once("../funcoes/protege.php");
?>
<br>
<div class="principal">
	<div class="meio">
		<h3> Pesquisa de clientes excluídos </h3>
		<form method="POST" action="resultado_pesquisa_cliente_excluido.php">
			<font color="#00008b" size="2" font face="Arial" >
				<font size="1" color="red" >Informe o nome do cliente e pressione ENTER</font><br>
				<font size="1" color="red" >ou digite 'TODOS' para listar todos os clientes</font><br><br>
				<b>Nome do cliente: </b> <input type="text" name="Nome" placeholder="Nome do cliente" maxlength="50" required>
			</font>
			<button type="submit" value="Pesquisar">Pesquisar</button>
		</form>
		<br>
		<br>
		<form method="POST" action="../principal.php" autocomplete="off">
			<button type="submit" value="Principal">Página Principal</button>
		</form>
	</div>
</div>
<a href="../funcoes/sair.php">Sair</a>
</body>
</html>