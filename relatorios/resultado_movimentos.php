<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Resultado Movimento das Contas </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");
?>
<br>
<div class="principal">
	<div class="meio">
	<h3> Resultado Movimento das Contas </h3>
	<?php
		if (isset($_POST['Nome']))
			$Nome=$_POST['Nome'];
	
		if (isset($_POST['Banco']))
			$Banco=$_POST['Banco'];

		if (isset($_POST['Agencia']))
			$Agencia=$_POST['Agencia'];
		
		if($Nome=="" && $Banco=="" && $Agencia=="")
			Retornar("Cliente, Banco ou Agência");

		$mysqli = new mysqli("localhost", "root", "", "banco");

		if (mysqli_connect_errno()) {
			echo "Falha de conexao: %s\n", mysqli_connect_error();
			exit();
		}
#'0=abertura,1=deposito,2=saque,3=deposito por transferencia,4=saque por transferencia'
		$query = "select rel_cli_age.id_rca, ";
		$query = $query . "rel_cli_age.conta, ";
		$query = $query . "rel_cli_age.saldo as saldo_atual, ";
		$query = $query . "rel_cli_age.id_age, ";
		$query = $query . "rel_cli_age.id_cli, ";
		$query = $query . "rel_cli_age.criacao, ";
		$query = $query . "REPLACE(REPLACE(rel_cli_age.tipo_conta,0,'Corrente'),1,'Poupança') as tipo_conta, ";
		$query = $query . "hist_mov.data, ";
		$query = $query . "hist_mov.saldo, ";
		$query = $query . "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(hist_mov.tipo,0,'Abertura'),1,'Depósito'),2,'Saque'),3,'Depósito Transferência'),4,'Saque Transferência') as tipo, ";
		$query = $query . "hist_mov.valor, ";
		$query = $query . "cadastro_cliente.nome as cliente, ";
		$query = $query . "cadastro_agencia.nome as agencia, ";
		$query = $query . "cadastro_banco.codigo as codigo_banco, ";
		$query = $query . "cadastro_banco.nome as banco ";
		$query = $query . "from rel_cli_age ";
		$query = $query . "left join hist_mov on (rel_cli_age.id_rca = hist_mov.id_rca) ";
		$query = $query . "inner join cadastro_cliente on (cadastro_cliente.id_cliente = rel_cli_age.id_cli) ";
		$query = $query . "inner join cadastro_agencia on (cadastro_agencia.id_agencia = rel_cli_age.id_age) ";
		$query = $query . "inner join cadastro_banco on (cadastro_banco.id_banco = cadastro_agencia.id_banco) ";
		$Nome=strtolower($Nome);
		$Banco=strtolower($Banco);
		$Agencia=strtolower($Agencia);
		$query = $query . "where rel_cli_age.excluido = 0 " ;
		if ($Nome!="")
			if ($Nome!="todos")
				$query = $query . "and cadastro_cliente.nome like '%$Nome%' " ;
		if ($Banco!="")
			if ($Banco!="todos")
				$query = $query . "and cadastro_banco.nome like '%$Banco%' " ;
		if ($Agencia!="")
			if ($Agencia!="todos")
				$query = $query . "and cadastro_agencia.nome like '%$Agencia%' " ;
		$query = $query . "order by cadastro_cliente.id_cliente asc, ";
		$query = $query . "cadastro_banco.codigo asc, ";
		$query = $query . "rel_cli_age.conta asc, ";
		$query = $query . "hist_mov.tipo asc, ";
		$query = $query . "hist_mov.data asc";
#		echo $query;
#		echo '<br>';
		if ($result = $mysqli->query($query)) {
			$table = '<body><center><table border="1"><tr>';
			$table .= '<th>'.'Banco'.'</th>';
			$table .= '<th>'.'Agência'.'</th>';
			$table .= '<th>'.'Conta'.'</th>';
			$table .= '<th>'.'Cliente'.'</th>';
			$table .= '<th>'.'Data'.'</th>';
			$table .= '<th>'.'Tipo conta'.'</th>';
			$table .= '<th>'.'Tipo movimento'.'</th>';
			$table .= '<th>'.'Valor'.'</th>';
			$table .= '<th>'.'Saldo na data'.'</th>';
			$table .= '<tbody>';

			while($row = $result->fetch_assoc()){
				$table .= '<tr>';
				$table .= '<td>'.$row['banco'].'</td>';
				$table .= '<td>'.$row['agencia'].'</td>';
				$table .= '<td align="center">'.$row['conta'].'</td>';
				$table .= '<td>'.$row['cliente'].' </td>';
				$table .= '<td>'.date('d/m/Y H:i:s',strtotime($row['data'])).' </td>';
				$table .= '<td>'.$row['tipo_conta'].' </td>';
				$table .= '<td>'.$row['tipo'].' </td>';
				$table .= '<td align="right">'.number_format($row['valor'],2,',','.').'</td>';
				$table .= '<td align="right">'.number_format($row['saldo'],2,',','.').'</td>';
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
			echo '<a href="../relatorios/pesquisar_saldos.php">Voltar a pesquisa</a>';
			return;
		}
		?>
		<br>
		<br>
		<form method="POST" action="../relatorios/pesquisar_saldos.php" autocomplete="off">
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