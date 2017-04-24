<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Cadastro de bancos </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");
?>
<br>
<div class="principal">
	<div class="meio">
	<h3> Cadastro de bancos </h3>
		<form method="POST" action="../salvar/salva_banco.php" autocomplete="off">
			<font color="#00008b" size="2" font face="Arial" >
				<font size="1" color="red" >Informe somente números</font><br>
				<b>Código</b> <input type="text" name="Codigo" placeholder="Codigo do banco" pattern="[0-9]+$" maxlength="10" required><br>
				<br>
				<b>Nome</b> <input type="text" name="Nome" placeholder="Nome completo do banco" maxlength="50" required><br>
				<font size="1" color="red" >Informe somente números</font><br>
				<b>CNPJ</b> <input type="text" name="CNPJ" placeholder="CNPJ do banco" pattern="[0-9]+$" maxlength="14" required><br>
			</font>
			<br>
			<button type="submit" value="Salvar">Cadastrar</button>
		</form>
		<br>
		<form method="POST" action="../pesquisar/pesquisa_banco.php" autocomplete="off">
			<button type="submit" value="Pesquisa_Banco">  Pesquisar bancos  </button>
		</form>
		<form method="POST" action="../principal.php" autocomplete="off">
			<button type="submit" value="Principal">Página Principal</button>
		</form>
	</div>
</div>
	<a href="../funcoes/sair.php">Sair</a>
</body>
</html>