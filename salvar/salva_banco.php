<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Salvar banco </title>
	</head>
	<body>
<?php
	include_once("../funcoes/protege.php");
//VERIFICA SE É UMA INCLUSAO OU ALTERACAO
	if (isset($_POST['ID_BANCO']))
	{
		$Tipo='2';
		$ID=$_POST['ID_BANCO'];
		if($ID=="")
		{
			#echo "ID não fora informado!!";
			echo '<br><br><a href="../pesquisar/pesquisa_banco.php">Voltar</a>';
			return;
		}	
	}
	else{
		#echo "ID não fora informado!!";
		$ID='0';
		$Tipo='1';
	}
//DADOS PARA A TABELA BANCO
	if (isset($_POST['CNPJ'])){
		$CNPJ=$_POST['CNPJ'];
		if($CNPJ=="")
			Retornar("CNPJ");
	}
	else
		Retornar("CNPJ","S");

	if (isset($_POST['Codigo'])){
		$Codigo=$_POST['Codigo'];
		if($Codigo=="")
			Retornar("Codigo");
	}
	else
		Retornar("Codigo","S");

	if (isset($_POST['Nome'])){
		$Nome=$_POST['Nome'];
		if($Nome=="")
			Retornar("Nome");
	}
	else
		Retornar("Nome","S");

	include("../funcoes/conexao.php");
	$conecta = new Conexao;

	if ($Tipo=='1')
	{
		$sql = "insert into cadastro_banco (codigo, nome, cnpj) values ('$Codigo','$Nome', '$CNPJ')";
		$result=$conecta->SQL_Query($sql);
		echo "<h2>Dados gravados com sucesso!</h2>";
		echo '<br>';
		echo '<meta http-equiv="Refresh" content="3;url=../cadastrar/cadastro_banco.php"></body>';
	}
	elseif ($Tipo=='2') {
		$sql = "update cadastro_banco set 
			codigo = '$Codigo',  
			nome = '$Nome',  
			cnpj = '$CNPJ'  
			where id_banco = '$ID'";
		$result=$conecta->SQL_Query($sql);
/*		$result = mysqli_query($conecta,$sql);
		mysqli_close($conecta);*/
		echo "<h2>Dados alterados com sucesso!</h2>";
		echo '<br>';
		echo '<meta http-equiv="Refresh" content="3;url=../pesquisar/pesquisa_banco.php"></body>';
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
	echo '<a href="../cadastrar/cadastro_banco.php">Voltar ao cadastro</a>';
	return;
}
?>
</html>