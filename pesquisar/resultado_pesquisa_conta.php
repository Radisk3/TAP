<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Resultado da Pesquisa de Contas </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");
?>
<br>
<div class="principal">
	<div class="meio">
	<h3> Pesquisa de Contas </h3>
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

		$query = "select rel_cli_age.id_rca, ";
		$query = $query . "rel_cli_age.conta, ";
		$query = $query . "rel_cli_age.saldo, ";
		$query = $query . "rel_cli_age.id_age, ";
		$query = $query . "rel_cli_age.id_cli, ";
		$query = $query . "cadastro_cliente.nome as cliente, ";
		$query = $query . "cadastro_agencia.nome as agencia, ";
		$query = $query . "cadastro_banco.nome as banco ";
		$query = $query . "from rel_cli_age ";
		$query = $query . "inner join cadastro_cliente on (cadastro_cliente.id_cliente = rel_cli_age.id_cli) ";
		$query = $query . "inner join cadastro_agencia on (cadastro_agencia.id_agencia = rel_cli_age.id_age) ";
		$query = $query . "inner join cadastro_banco on (cadastro_banco.id_banco = cadastro_agencia.id_banco) ";
		$Nome=strtolower($Nome);
		$query = $query . "where rel_cli_age.excluido = 0 " ;
		if ($Nome!="todos")
			$query = $query . "and cadastro_cliente.nome like '%$Nome%' " ;
		$query = $query . "order by cadastro_cliente.nome asc";
#		echo $query;
#		echo '<br>';
		if ($result = $mysqli->query($query)) {
			$table = '<body><center><table border="1"><tr>';
			$table .= '<th>'.'Excluir'.'</th>';
			#$table .= '<th>'.'Editar'.'</th>';
			$table .= '<th>'.'Movimentar'.'</th>';
			$table .= '<th>'.'Cliente'.'</th>';
			$table .= '<th>'.'Banco'.'</th>';
			$table .= '<th>'.'Agência'.'</th>';
			$table .= '<th>'.'Conta'.'</th>';
			$table .= '<th>'.'Saldo'.'</th>';
			$table .= '<tbody>';

			while($row = $result->fetch_assoc()){
				$table .= '<tr>';
				#Excluir o cliente
				$table .= '<td><form method="POST" action="../excluir/exclui_conta.php">
					<input hidden value=' .$row['id_rca'].' name="ID_RCA">
					<button type="submit" value="Excluir">Excluir</button></form></td>';
/*				#Editar a conta
				$table .= '<td><form method="POST" action="../editar/edita_conta.php">
					<input hidden value=' .$row['id_rca'].' name="ID_RCA">
					<button type="submit" value="Editar">Editar</button></form></td>';*/
				#Movimentar conta
				$table .= '<td><form method="POST" action="../movimento/movimenta_conta.php">
					<input hidden value=' .$row['id_rca'].' name="ID_RCA">
					<button type="submit" value="Movimentar">Movimentar</button></form></td>';
				$table .= '<td>'.$row['cliente'].'</td>';
				$table .= '<td>'.$row['banco'].'</td>';
				$table .= '<td>'.$row['agencia'].'</td>';
				$table .= '<td align="center">'.$row['conta'].'</td>';
				$table .= '<td align="right">'.$row['saldo'].'</td>';
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
			echo '<a href="../pesquisar/pesquisa_conta.php">Voltar a pesquisa</a>';
			return;
		}
		?>
		<br>
		<br>
		<form method="POST" action="../pesquisar/pesquisa_conta.php" autocomplete="off">
			<button type="submit" value="Voltar">Voltar a pesquisa</button>
		</form>
		<form method="POST" action="../cadastrar/cadastro_conta.php" autocomplete="off">
			<button type="submit" value="Conta">  Cadastrar nova conta  </button>
		</form>
		<form method="POST" action="../principal.php" autocomplete="off">
			<button type="submit" value="Principal">Página Principal</button>
		</form>
	</div>
</div>
	<a href="../funcoes/sair.php">Sair</a>
</body>
</html>