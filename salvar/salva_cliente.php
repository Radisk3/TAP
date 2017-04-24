<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Salvar cliente </title>
	</head>
	<body>
<?php
	include_once("../funcoes/protege.php");
//VERIFICA SE É UMA INCLUSAO OU ALTERACAO
	if (isset($_POST['ID_CLIENTE']))
	{
		$Tipo='2';
		$ID=$_POST['ID_CLIENTE'];
		if($ID=="")
		{
#			echo "ID não fora informado!!";
			echo '<br><br><a href="../pesquisar/pesquisa_cliente.php">Voltar</a>';
			return;
		}	
	}
	else{
#		echo "ID não fora informado!!";
		$ID='0';
		$Tipo='1';
	}

    # CAMPOS OBRIGATÓRIOS
	if (isset($_POST['Nome'])){
		$Nome=$_POST['Nome'];
		if($Nome=="")
			Retornar("Nome");
		$Nome="'".$Nome."'";
	}
	else
		Retornar("Nome","S");

	if (isset($_POST['CPF'])){
		$CPF=$_POST['CPF'];
		if($CPF=="")
			Retornar("CPF");
		$CPF="'".$CPF."'";
	}
	else
		Retornar("CPF","S");

	if (isset($_POST['RG'])){
		$RG=$_POST['RG'];
		if($RG=="")
			Retornar("RG");
		$RG="'".$RG."'";
	}
	else
		Retornar("RG","S");

	if (isset($_POST['Rua'])){
		$Rua=$_POST['Rua'];
		if($Rua=="")
			Retornar("Rua");
		$Rua="'".$Rua."'";
	}
	else
		Retornar("Rua","S");

	if (isset($_POST['Cidade'])){
		$Cidade=$_POST['Cidade'];
		if($Cidade=="")
			Retornar("Cidade");
		$Cidade="'".$Cidade."'";
	}
	else
		Retornar("Cidade","S");

	if (isset($_POST['Estado'])){
		$Estado=$_POST['Estado'];
		if($Estado=="")
			Retornar("Estado");
		$Estado="'".$Estado."'";
	}
	else
		Retornar("Estado","S");

	if (isset($_POST['CEP'])){
		$CEP=$_POST['CEP'];
		if($CEP=="")
			Retornar("CEP");
		$CEP="'".$CEP."'";
	}
	else
		Retornar("CEP","S");

	if (isset($_POST['Dia'])){
		$Dia=$_POST['Dia'];
		if($Dia=="")
			Retornar("Dia");
		#$Dia="'".$Dia."'";
	}
	else
		Retornar("Dia","S");

	if (isset($_POST['Mes'])){
		$Mes=$_POST['Mes'];
		if($Mes=="")
			Retornar("Mes");
		#$Mes="'".$Mes."'";
	}
	else
		Retornar("Mes","S");

	if (isset($_POST['Ano'])){
		$Ano=$_POST['Ano'];
		if($Ano=="")
			Retornar("Ano");
		#$Ano="'".$Ano."'";
	}
	else
		Retornar("Ano","S");

#CAMPOS OPCIONAIS
	if (isset($_POST['Numero'])){
		$Numero=$_POST['Numero'];
		if($Numero=="")
			$Numero="Null";
		else
			$Numero="'".$Numero."'";
	}
	else
		$Numero="Null";
    if (isset($_POST['Complemento'])){
        $Complemento=$_POST['Complemento'];
        if($Complemento=="")
			$Complemento="Null";
        else
			$Complemento="'".$Complemento."'";
    }
    else
		$Complemento="Null";
    if (isset($_POST['Telefone'])){
        $Telefone=$_POST['Telefone'];
        if($Telefone=="")
			$Telefone="Null";
        else
			$Telefone="'".$Telefone."'";
    }
    else
		$Telefone="Null";

	include("../funcoes/conexao.php");
	$conecta = new Conexao;

	if ($Tipo=='1')
	{
		$sql = "insert into cadastro_cliente (cpf, rg, nome, rua, numero, 
			complemento, telefone, cidade, estado, cep, data_moradia) 
			values ($CPF, $RG, $Nome, $Rua, $Numero,  
			$Complemento, $Telefone, $Cidade, $Estado, $CEP, '$Ano-$Mes-$Dia')";
		$result=$conecta->SQL_Query($sql);
		echo "<h2>Dados gravados com sucesso!</h2>";
		echo '<br>';
		echo '<meta http-equiv="Refresh" content="3;url=../cadastrar/cadastro_cliente.php"></body>';
	}
	elseif ($Tipo=='2') {
		$sql = "update cadastro_cliente set 
			cpf = $CPF,  
			rg = $RG,  
			nome = $Nome,  
			rua = $Rua,  
			numero = $Numero,  
			complemento = $Complemento,  
			telefone = $Telefone,  
			cidade = $Cidade,  
			estado = $Estado,  
			cep = $CEP,  
			data_moradia = '$Ano-$Mes-$Dia'  
			where id_cliente = $ID";
		#echo $sql;
        $result=$conecta->SQL_Query($sql);
		echo "<h2>Dados alterados com sucesso!</h2>";
		echo '<br>';
		echo '<meta http-equiv="Refresh" content="3;url=../pesquisar/pesquisa_cliente.php"></body>';
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
	echo '<a href="../cadastrar/cadastro_cliente.php">Voltar ao cadastro</a>';
	return;
}
		?>
</html>