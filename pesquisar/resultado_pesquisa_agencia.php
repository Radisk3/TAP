<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Resultado da Pesquisa de Agências </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");
?>
<br>
<div class="principal">
	<div class="meio">
	<h3> Pesquisa de agências </h3>
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
		$query = $query . "from cadastro_agencia ";
		$Nome=strtolower($Nome);
		if ($Nome!="todos")
			$query = $query . "where nome like '%$Nome%' " ;
		$query = $query . "order by nome asc";

		if ($result = $mysqli->query($query)) {
			$table = '<body><center><table border="1"><tr>';
			$table .= '<th>'.'Excluir'.'</th>';
			$table .= '<th>'.'Editar'.'</th>';
			$table .= '<th>'.'Número'.'</th>';
			$table .= '<th>'.'Nome'.'</th>';
			$table .= '<th>'.'Endereco'.'</th>';
			$table .= '<th>'.'Cidade'.'</th>';
			$table .= '<th>'.'Estado'.'</th>';
			$table .= '<th>'.'CEP'.'</th>';
			$table .= '<tbody>';

			while($row = $result->fetch_assoc()){
				$table .= '<tr>';
				#Excluir o banco
				$table .= '<td><form method="POST" action="../excluir/exclui_agencia.php">
					<input hidden value=' .$row['ID_AGENCIA'].' name="ID_Agencia">
					<button type="submit" value="Excluir">Excluir</button></form></td>';
				#Editar o banco
				$table .= '<td><form method="POST" action="../editar/edita_agencia.php">
					<input hidden value=' .$row['ID_AGENCIA'].' name="ID_Agencia">
					<button type="submit" value="Editar">Editar</button></form></td>';
				$table .= '<td>'. $row['NUMERO'].'</td>';
				$table .= '<td>'.$row['NOME'].'</td>';
				$table .= '<td>'.$row['ENDERECO'].'</td>';
				$table .= '<td>'.$row['CIDADE'].'</td>';
				$table .= '<td>'.$row['ESTADO'].'</td>';
				$table .= '<td>'.$row['CEP'].'</td>';
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
			echo '<a href="../pesquisar/pesquisa_agencia.php">Voltar a pesquisa</a>';
			return;
		}
		?>
		<br>
		<br>
		<form method="POST" action="../pesquisar/pesquisa_agencia.php" autocomplete="off">
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