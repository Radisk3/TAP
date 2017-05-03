<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Relatório de Bancos </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");
?>
<br>
<div class="principal">
	<div class="meio">
	<h3> Relatório de bancos </h3>
	<?php
		if (isset($_POST['Nome']))
		{
			$Nome=$_POST['Nome'];
			if($Nome=="")
				Retornar("Nome");
		}
		else
			Retornar("Nome","S");

		$mysqli = new mysqli("localhost", "root", "", "banco");

		if (mysqli_connect_errno()) {
			echo "Falha de conexao: %s\n", mysqli_connect_error();
			exit();
		}

		$query = "select * ";
		$query = $query . "from cadastro_banco ";
		$Nome=strtolower($Nome);
		$query = $query . "where cadastro_banco.excluido = 0 " ;
		if ($Nome!="todos")
			$query = $query . "and nome like '%$Nome%' " ;
		$query = $query . "order by nome asc";

		if ($result = $mysqli->query($query)) {
			$table = '<body><center><table border="1"><tr>';
			$table .= '<th>'.'Codigo'.'</th>';
			$table .= '<th>'.'Nome'.'</th>';
			$table .= '<tbody>';

			while($row = $result->fetch_assoc()){
				$table .= '<tr>';
				$table .= '<td>'.$row['CODIGO'].'</td>';
				$table .= '<td>'.$row['NOME'].'</td>';
				$table .= '</tr>';
			}

			$table .= '</tbody></table></center></body>';

			echo $table;
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
			echo '<a href="../relatorios/pesquisar_bancos.php">Voltar a pesquisa</a>';
			return;
		}
		?>
		<br>
		<br>
		<form method="POST" action="../relatorios/pesquisar_bancos.php" autocomplete="off">
			<button type="submit" value="Voltar">Voltar a pesquisa</button>
		</form>
		<form method="POST" action="../cadastrar/cadastro_banco.php" autocomplete="off">
			<button type="submit" value="Banco">  Cadastrar novo banco  </button>
		</form>
		<form method="POST" action="../principal.php" autocomplete="off">
			<button type="submit" value="Principal">Página Principal</button>
		</form>
	</div>
</div>
	<a href="../funcoes/sair.php">Sair</a>
</body>
</html>