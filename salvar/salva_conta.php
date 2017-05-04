<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Salvar conta </title>
	</head>
	<body>
<?php
	include_once("../funcoes/protege.php");
//VERIFICA SE É UMA INCLUSAO OU ALTERACAO
	if (isset($_POST['ID_RCA']))
	{
		$Tipo='2';
		$ID=$_POST['ID_RCA'];
		if($ID=="")
		{
#			echo "ID não fora informado!!";
			echo '<br><br><a href="../pesquisar/pesquisa_conta.php">Voltar</a>';
			return;
		}	
	}
	else{
#		echo "ID não fora informado!!";
		$ID='0';
		$Tipo='1';
	}

    # CAMPOS OBRIGATÓRIOS
	if (isset($_POST['ID_Agencia'])){
		$ID_Agencia=$_POST['ID_Agencia'];
		if($ID_Agencia=="")
			Retornar("ID_Agencia");
		$ID_Agencia="'".$ID_Agencia."'";
	}
	else
		Retornar("Agência","S");

	if (isset($_POST['ID_Cliente'])){
		$ID_Cliente=$_POST['ID_Cliente'];
		if($ID_Cliente=="")
			Retornar("ID_Cliente");
		$ID_Cliente="'".$ID_Cliente."'";
	}
	else
		Retornar("ID_Cliente","S");

	if (isset($_POST['Conta'])){
		$Conta=$_POST['Conta'];
		if($Conta=="")
			Retornar("Conta");
		$Conta="'".$Conta."'";
	}
	else
		Retornar("Conta","S");

	if (isset($_POST['Tipo_Conta'])){
		$Tipo_Conta=$_POST['Tipo_Conta'];
		if($Tipo_Conta=="")
			Retornar("Tipo_Conta");
		$Tipo_Conta="'".$Tipo_Conta."'";
	}
	else
		Retornar("Tipo_Conta","S");

#CAMPOS OPCIONAIS
	if (isset($_POST['Saldo'])){
		$Saldo=$_POST['Saldo'];
		if($Saldo=="")
			$Saldo="'0'";
		else
			$Saldo="'".$Saldo."'";
	}
	else
		$Saldo="'0'";

	include("../funcoes/conexao.php");
	$conecta = new Conexao;

	if ($Tipo=='1')
	{
		#GRAVA NA TABELA CONTA
		$sql = "insert into rel_cli_age (id_age, id_cli, conta, tipo_conta, saldo) 
			values ($ID_Agencia, $ID_Cliente, $Conta, $Tipo_Conta, $Saldo)";
		$result=$conecta->SQL_Query($sql);

		#GRAVA NO HISTORICO
		$mysqli = new mysqli("localhost", "root", "", "banco");
		if (mysqli_connect_errno()) {
			echo "Falha de conexao: %s\n", mysqli_connect_error();
			exit();
		}
		$sql = "select max(id_rca) id from rel_cli_age ";
		if ($result = $mysqli->query($sql)) {
			$row = $result->fetch_assoc();
			$ID=$row['id'];
		}

		$sql = "insert into hist_mov (id_rca, valor, id_cliente_origem) 
			values ($ID, $Saldo, $ID_Cliente)";
		$result=$conecta->SQL_Query($sql);
		echo "<h2>Dados gravados com sucesso!</h2>";
		echo '<br>';
		echo '<meta http-equiv="Refresh" content="3;url=../cadastrar/cadastro_conta.php"></body>';
	}
	elseif ($Tipo=='2') {
		$sql = "update cadastro_conta set 
			id_age = $ID_Agencia,  
			id_cli = $ID_Cliente,
		  	conta = $Conta,
		  	Tipo_Conta=$Tipo_Conta,
			saldo = $Saldo  
			where id_rca = $ID";
		#echo $sql;
        $result=$conecta->SQL_Query($sql);
		#GRAVA NO HISTORICO
		$sql = "insert into hist_mov (id_rca, valor, id_cliente_origem) 
			values ($ID, $Saldo, $ID_Cliente)";
		$result=$conecta->SQL_Query($sql);
		echo "<h2>Dados alterados com sucesso!</h2>";
		echo '<br>';
		echo '<meta http-equiv="Refresh" content="3;url=../pesquisar/pesquisa_conta.php"></body>';
	}

function Retornar($Campo,$Falhou="") {
	echo "<br>";
	echo "<br>";
	if ($Falhou=="")
		echo 'O campo '. $Campo .' não foi preenchido!';
	else
		echo 'Falha ao ler os dados do campo '. $Campo .'!';
	echo "<br>";
	echo "<br>";
	echo '<a href="../cadastrar/cadastro_conta.php">Voltar ao cadastro</a>';
	return;
}
		?>
</html>