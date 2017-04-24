<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Banco </title>
	</head>
<body>
<?php
	$IDU=$_SESSION['NomeU'];
	$NOME=$_SESSION['IDU'];
	include_once("funcoes/protege.php");
	echo "<h2> Olá " . $NOME . " este é o seu painel do sistema! </h2>";
?>
	<h2>Escolha uma das opções abaixo</h2>
	<form method="POST" action="usuario.html" autocomplete="off">
		<button type="submit" value="Usuario">  Cadastrar novo usuario  </button>
	</form>
	<form method="POST" action="listarusuario.html" autocomplete="off">
		<button type="submit" value="ListaPedido"> Listar usuários </button>
	</form>
	<form method="POST" action="funcoes/sair.php">
		<button type="submit" value="Sair">     Sair     </button>
	</form>
	<br>
	<a href="login.html">Voltar...</a>
</html>