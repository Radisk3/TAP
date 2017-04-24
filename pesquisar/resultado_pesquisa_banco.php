<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Resultado da Pesquisa de Bancos </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");
?>
<br>
<div class="principal">
	<div class="meio">
	<h3> Pesquisa de bancos </h3>
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
		if ($Nome!="todos")
			$query = $query . "where nome like '%$Nome%' " ;
		$query = $query . "order by nome asc";

		if ($result = $mysqli->query($query)) {
			$table = '<body><center><table border="1"><tr>';
			$table .= '<th>'.'Excluir'.'</th>';
			$table .= '<th>'.'Editar'.'</th>';
			$table .= '<th>'.'Codigo'.'</th>';
			$table .= '<th>'.'Nome'.'</th>';
			$table .= '<th>'.'CNPJ'.'</th>';
			$table .= '<tbody>';

			while($row = $result->fetch_assoc()){
				$table .= '<tr>';
				#Excluir o banco
				$table .= '<td><form method="POST" action="../excluir/exclui_banco.php">
					<input hidden value=' .$row['ID_BANCO'].' name="ID_Banco">
					<button type="submit" value="Excluir">Excluir</button></form></td>';
				#Editar o banco
				$table .= '<td><form method="POST" action="../editar/edita_banco.php">
					<input hidden value=' .$row['ID_BANCO'].' name="ID_Banco">
					<button type="submit" value="Editar">Editar</button></form></td>';
				$table .= '<td>'.$row['CODIGO'].'</td>';
				$table .= '<td>'.$row['NOME'].'</td>';
				$table .= '<td>'.$row['CNPJ'].'</td>';
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
			echo '<a href="../pesquisar/pesquisa_banco.php">Voltar a pesquisa</a>';
			return;
		}
		?>
		<br>
		<br>
		<form method="POST" action="../pesquisar/pesquisa_banco.php" autocomplete="off">
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