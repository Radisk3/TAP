<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Resultado da Pesquisa de Clientes </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");
?>
<br>
<div class="principal">
	<div class="meio">
	<h3> Pesquisa de clientes </h3>
	<?php
		if (isset($_POST['Nome']))
			$Nome=$_POST['Nome'];

		if (isset($_POST['Cidade']))
			$Cidade=$_POST['Cidade'];

		if($Nome=="" && $Cidade=="")
			Retornar("Nome ou Cidade");

		$mysqli = new mysqli("localhost", "root", "", "banco");

		if (mysqli_connect_errno()) {
			echo "Falha de conexao: %s\n", mysqli_connect_error();
			exit();
		}

		$query = "select cadastro_cliente.nome as cliente, ";
		$query = $query . "cadastro_cliente.rg as rg, ";
		$query = $query . "cadastro_cliente.rua as rua, ";
		$query = $query . "cadastro_cliente.numero as numero, ";
		$query = $query . "cadastro_cliente.complemento as complemento, ";
		$query = $query . "cadastro_cliente.cidade as cidade, ";
		$query = $query . "cadastro_agencia.numero as numero_agencia, ";
		$query = $query . "cadastro_agencia.nome as agencia, ";
		$query = $query . "cadastro_banco.codigo as codigo_banco, ";
		$query = $query . "cadastro_banco.nome as banco ";
		$query = $query . "from rel_cli_age ";
		$query = $query . "inner join cadastro_cliente on (cadastro_cliente.id_cliente = rel_cli_age.id_cli) ";
		$query = $query . "inner join cadastro_agencia on (cadastro_agencia.id_agencia = rel_cli_age.id_age) ";
		$query = $query . "inner join cadastro_banco on (cadastro_banco.id_banco = cadastro_agencia.id_banco) ";

		$Nome=strtolower($Nome);
		$query = $query . "where cadastro_cliente.excluido is null " ;
		if ($Nome!="")
			if ($Nome!="todos")
				$query = $query . "and cadastro_cliente.nome like '%$Nome%' " ;
		if ($Cidade!="")
			if ($Cidade!="todos")
				$query = $query . "and cadastro_cliente.cidade like '%$Cidade%' " ;
		$query = $query . "order by cadastro_cliente.nome asc";

		if ($result = $mysqli->query($query)) {
			$table = '<body><center><table border="1"><tr>';
			$table .= '<th>'.'Nome'.'</th>';
			$table .= '<th>'.'RG'.'</th>';
			$table .= '<th>'.'Rua'.'</th>';
			$table .= '<th>'.'Numero'.'</th>';
			$table .= '<th>'.'Complemento'.'</th>';
			$table .= '<th>'.'Cidade'.'</th>';
			$table .= '<th>'.'Banco'.'</th>';
			$table .= '<th>'.'Agencia'.'</th>';
			$table .= '<tbody>';

			while($row = $result->fetch_assoc()){
				$table .= '<tr>';
				$table .= '<td>'.$row['cliente'].'</td>';
				$table .= '<td>'.$row['rg'].'</td>';
				$table .= '<td>'.$row['rua'].'</td>';
				$table .= '<td>'.$row['numero'].'</td>';
				$table .= '<td>'.$row['complemento'].'</td>';
				$table .= '<td>'.$row['cidade'].'</td>';
				$table .= '<td>'.$row['codigo_banco'].' - '.$row['banco'].'</td>';
				$table .= '<td>'.$row['numero_agencia'].' - '.$row['agencia'].'</td>';
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
			echo '<a href="../relatorios/pesquisar_clientes.php">Voltar a pesquisa</a>';
			return;
		}
		?>
		<br>
		<br>
		<form method="POST" action="../relatorios/pesquisar_clientes.php" autocomplete="off">
			<button type="submit" value="Voltar">Voltar a pesquisa</button>
		</form>
		<form method="POST" action="../cadastrar/cadastro_cliente.php" autocomplete="off">
			<button type="submit" value="Banco">  Cadastrar novo cliente  </button>
		</form>
		<form method="POST" action="../principal.php" autocomplete="off">
			<button type="submit" value="Principal">Página Principal</button>
		</form>
	</div>
</div>
	<a href="../funcoes/sair.php">Sair</a>
</body>
</html>