<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Cadastro de clientes </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");
?>
<br>
<div class="principal">
	<div class="meio">
	<h3> Cadastro de clientes </h3>
		<div class="esquerda">
		<form method="POST" action="../salvar/salva_cliente.php" autocomplete="off">
			<font color="#00008b" size="2" font face="Arial" >
				<font size="1" color="red" >Informe somente números</font><br>
				<b>Nome: </b> <input type="text" name="Nome" placeholder="Nome completo" maxlength="60" size =60 required><br>
				<b>CPF: </b> <input type="text" name="CPF" placeholder="CPF" pattern="[0-9]+$" maxlength="10" size =14 required><br>
				<b>RG: </b> <input type="text" name="RG" placeholder="RG" pattern="[0-9]+$" maxlength="10" size =12 required><br>
				<b>Rua: </b> <input type="text" name="Rua" placeholder="Nome da rua" maxlength="100" size =52 required ><br>
				<b>Numero: </b> <input type="text" name="Numero" placeholder="Número" maxlength="100" size =50 required><br>
				<b>Complemento: </b> <input type="text" name="Complemento" placeholder="Complemento" maxlength="100" size =50 required><br>
				<b>Telefone: </b> <input type="tel" name="Telefone" placeholder="Telefone" maxlength="14" size =50 required ><br>
				<b>Cidade: </b> <input type="text" name="Cidade" placeholder="Cidade" maxlength="60" size =50 required ><br>
				<b>Estado: </b> <input type="text" name="Estado" placeholder="Estado" maxlength="2" size =3 required align="center"><br>
				<font size="1" color="red" >Informe somente números</font><br>
				<b>CEP: </b> <input type="text" name="CEP" placeholder="CEP" pattern="[0-9]+$" maxlength="8" size =10 required ><br>
				<font size="1" color="red" >Informe somente números</font><br>
				<b>Data moradia: </b> <input type="text" name="Dia" placeholder="Dia" pattern="[0-9]+$" maxlength="2" required size =2 >
				<b>/</b> <input type="text" name="Mes" placeholder="Mês" pattern="[0-9]+$" maxlength="2" required size =2 >
				<b>/</b> <input type="text" name="Ano" placeholder="Ano" pattern="[0-9]+$" maxlength="4" required size =4 >
			</font>
			<br>
			<br>
			<button type="submit" value="Salvar">   Salvar   </button>
		</form>
		</div>
			<br>
		<form method="POST" action="../principal.php" autocomplete="off">
			<button type="submit" value="Principal">Página Principal</button>
		</form>
	</div>
</div>
	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>