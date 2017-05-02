<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Movimentação de contas </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");

	if (isset($_POST['ID_RCA']))
	{
		$ID_RCA=$_POST['ID_RCA'];
		if($ID_RCA=="")
			Retornar("de indice da conta ");
	}
	else
		Retornar("de indice da conta ","S");

	echo '<div class="principal">';
	echo '<div class="meio">';
	echo '<div class="esquerda">';
	echo '<h3> Movimentação da conta </h3>';
	echo '<h3> Destino do depósito </h3>';
	echo '<form method="POST" action="../movimento/destino_valor.php" autocomplete="off">';
	echo '<input type="text" name="ID_RCA" hidden=true placeholder="Índice da conta"  value = "'.$ID_RCA.'" required readonly="true" size=6 ><br>';
	echo '<font color="#00008b" size="2" font face="Arial" >';
	echo '<b>Destino do depósito: </b> <br>
		<input type="radio" name="Destino" value="Propria" required checked > <b>Própria conta </b>  <br>
		<input type="radio" name="Destino" value="Terceiro" > <b>Conta de terceiro </b>  <br>';

	echo '<br>';
	echo '<button type="submit" value="Avancar">  Avançar  </button>';
	echo'</form>';
	echo '<br>';
	echo '<form method="POST" action="../pesquisar/pesquisa_conta.php" autocomplete="off">';
	echo '<button type="submit" value="Voltar a pesquisa">Voltar a pesquisa</button>';
	echo '</form>';
	echo '<br>';
	echo '<form method="POST" action="../principal.php" autocomplete="off">';
	echo '<button type="submit" value="Principal">Página Principal</button>';
	echo '</form>';
	echo '<br>';
	echo '</div>';
	echo '</div>';
	echo '</div>';

	function Retornar($Campo,$Falhou="") {
		echo "<br>";
		echo "<br>";
		if ($Falhou=="")
			echo 'O campo '. $Campo .' não foi preenchido!';
		else
			echo 'Falha ao ler os dados do campo '. $Campo .'!';
		echo "<br>";
		echo "<br>";
		echo '<a href="../pesquisar/pesquisa_conta.php">Voltar a pesquisa</a>';
		return;
	}
?>
	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>