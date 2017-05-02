<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Relatório de Agências </title>
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
	<?php
		if (isset($_POST['Nome']))
			$Nome=$_POST['Nome'];

		if (isset($_POST['Banco']))
			$Banco=$_POST['Banco'];

		if($Nome=="" && $Banco=="")
			Retornar("Nome ou Banco");

		$mysqli = new mysqli("localhost", "root", "", "banco");

		if (mysqli_connect_errno()) {
			echo "Falha de conexao: %s\n", mysqli_connect_error();
			exit();
		}

		$query = "select ";
		$query = $query . "cadastro_banco.CODIGO as CODIGO_BANCO, ";
		$query = $query . "cadastro_agencia.NUMERO, ";
		$query = $query . "cadastro_agencia.ENDERECO, ";
		$query = $query . "cadastro_agencia.CIDADE, ";
		$query = $query . "cadastro_agencia.ESTADO ";
		$query = $query . "from cadastro_agencia ";
		$query = $query . "left join cadastro_banco on (cadastro_banco.id_banco = cadastro_agencia.id_banco) ";
		$query = $query . "where cadastro_agencia.id_agencia > 0 ";
		$Nome=strtolower($Nome);
		if ($Nome!="")
			if ($Nome!="todos")
				$query = $query . "and cadastro_agencia.nome like '%$Nome%' " ;
		if ($Banco!="")
			if ($Banco!="todos")
				$query = $query . "and cadastro_banco.nome like '%$Banco%' " ;
		$query = $query . "order by cadastro_agencia.nome asc";

		if ($result = $mysqli->query($query)) {
			$table = '<body><center><table border="1"><tr>';
			$table .= '<th>'.'Banco'.'</th>';
			$table .= '<th>'.'Agência'.'</th>';
			$table .= '<th>'.'Endereco'.'</th>';
			$table .= '<th>'.'Cidade'.'</th>';
			$table .= '<th>'.'Estado'.'</th>';
			$table .= '<tbody>';

			while($row = $result->fetch_assoc()){
				$table .= '<tr>';
				$table .= '<td>'.$row['CODIGO_BANCO'].'</td>';
				$table .= '<td>'.$row['NUMERO'].'</td>';
				$table .= '<td>'.$row['ENDERECO'].'</td>';
				$table .= '<td>'.$row['CIDADE'].'</td>';
				$table .= '<td>'.$row['ESTADO'].'</td>';
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
				echo 'Os campos '. $Campo .' não foram preenchidos!';
			else
				echo 'Falha ao ler os dados dos campos '. $Campo .'!';
			echo "<br>";
			echo "<br>";
			echo '<a href="../relatorios/pesquisar_agencias.php">Voltar a pesquisa</a>';
			return;
		}
		?>
		<br>
		<br>
		<form method="POST" action="../relatorios/pesquisar_agencias.php" autocomplete="off">
			<button type="submit" value="Voltar">Voltar a pesquisa</button>
		</form>
		<form method="POST" action="../cadastrar/cadastro_agencia.php" autocomplete="off">
			<button type="submit" value="Agência">  Cadastrar nova agência  </button>
		</form>
		<form method="POST" action="../principal.php" autocomplete="off">
			<button type="submit" value="Principal">Página Principal</button>
		</form>
	</div>
</div>
	<a href="../funcoes/sair.php">Sair</a>
</body>
</html>