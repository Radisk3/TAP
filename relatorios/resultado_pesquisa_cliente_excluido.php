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
		$query = $query . "from cadastro_cliente ";
		$Nome=strtolower($Nome);
		$query = $query . "where excluido ='S' " ;
		if ($Nome!="todos")
			$query = $query . "and nome like '%$Nome%' " ;
		$query = $query . "order by nome asc";

		if ($result = $mysqli->query($query)) {
			$table = '<body><center><table border="1"><tr>';
			$table .= '<th>'.'Excluir'.'</th>';
			$table .= '<th>'.'Editar'.'</th>';
			$table .= '<th>'.'Nome'.'</th>';
			$table .= '<th>'.'CPF'.'</th>';
			$table .= '<th>'.'RG'.'</th>';
			$table .= '<th>'.'Rua'.'</th>';
			$table .= '<th>'.'Numero'.'</th>';
			$table .= '<th>'.'Complemento'.'</th>';
			$table .= '<th>'.'Telefone'.'</th>';
			$table .= '<th>'.'Cidade'.'</th>';
			$table .= '<th>'.'Estado'.'</th>';
			$table .= '<th>'.'CEP'.'</th>';
			$table .= '<th>'.'Data Moradia'.'</th>';
			$table .= '<tbody>';

			while($row = $result->fetch_assoc()){
				$table .= '<tr>';
				#Excluir o cliente
				$table .= '<td><form method="POST" action="../excluir/exclui_cliente.php">
					<input hidden value=' .$row['ID_CLIENTE'].' name="ID_CLIENTE">
					<button type="submit" value="Excluir">Excluir</button></form></td>';
				#Editar o cliente
				$table .= '<td><form method="POST" action="../editar/edita_cliente.php">
					<input hidden value=' .$row['ID_CLIENTE'].' name="ID_CLIENTE">
					<button type="submit" value="Editar">Editar</button></form></td>';
				$table .= '<td>'.$row['NOME'].'</td>';
				$table .= '<td>'.$row['CPF'].'</td>';
				$table .= '<td>'.$row['RG'].'</td>';
				$table .= '<td>'.$row['RUA'].'</td>';
				$table .= '<td>'.$row['NUMERO'].'</td>';
				$table .= '<td>'.$row['COMPLEMENTO'].'</td>';
				$table .= '<td>'.$row['TELEFONE'].'</td>';
				$table .= '<td>'.$row['CIDADE'].'</td>';
				$table .= '<td>'.$row['ESTADO'].'</td>';
				$table .= '<td>'.$row['CEP'].'</td>';
				$table .= '<td>'.$row['DATA_MORADIA'].'</td>';
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
			echo '<a href="../relatorios/pesquisar_clientes_excluidos.php">Voltar a pesquisa</a>';
			return;
		}
		?>
		<br>
		<br>
		<form method="POST" action="../relatorios/pesquisar_clientes_excluidos.php" autocomplete="off">
			<button type="submit" value="Voltar">Voltar a pesquisa</button>
		</form>
		<form method="POST" action="../principal.php" autocomplete="off">
			<button type="submit" value="Principal">Página Principal</button>
		</form>
	</div>
</div>
	<a href="../funcoes/sair.php">Sair</a>
</body>
</html>