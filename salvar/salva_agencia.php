<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Salvar agência </title>
	</head>
	<body>
<?php
	include_once("../funcoes/protege.php");
//VERIFICA SE É UMA INCLUSAO OU ALTERACAO
	if (isset($_POST['ID_AGENCIA']))
	{
		$Tipo='2';
		$ID=$_POST['ID_AGENCIA'];
		if($ID=="")
		{
#			echo "ID não fora informado!!";
			echo '<br><br><a href="../pesquisar/pesquisa_agencia.php">Voltar</a>';
			return;
		}	
	}
	else{
#		echo "ID não fora informado!!";
		$ID='0';
		$Tipo='1';
	}
    # CAMPOS OBRIGATÓRIOS
	if (isset($_POST['Numero'])){
		$Numero=$_POST['Numero'];
		if($Numero=="")
			Retornar("Numero");
		$Numero="'".$Numero."'";
	}
	else
		Retornar("Numero","S");

	if (isset($_POST['Nome'])){
		$Nome=$_POST['Nome'];
		if($Nome=="")
			Retornar("Nome");
		$Nome="'".$Nome."'";
	}
	else
		Retornar("Nome","S");

	if (isset($_POST['ID_Banco'])){
		$ID_Banco=$_POST['ID_Banco'];
		if($ID_Banco=="")
			Retornar("Banco");
		$ID_Banco="'".$ID_Banco."'";
	}
	else
		Retornar("Banco","S");

    #CAMPOS OPCIONAIS
	if (isset($_POST['Endereco'])){
		$Endereco=$_POST['Endereco'];
		if($Endereco=="")
			$Endereco="Null";
		else
			$Endereco="'".$Endereco."'";
	}
	else
        $Endereco="Null";
    if (isset($_POST['Cidade'])){
        $Cidade=$_POST['Cidade'];
        if($Cidade=="")
            $Cidade="Null";
        else
            $Cidade="'".$Cidade."'";
    }
    else
        $Cidade="Null";
    if (isset($_POST['Estado'])){
        $Estado=$_POST['Estado'];
        if($Estado=="")
            $Estado="Null";
        else
            $Estado="'".$Estado."'";
    }
    else
        $Estado="Null";
    if (isset($_POST['CEP'])){
        $CEP=$_POST['CEP'];
        if($CEP=="")
            $CEP="Null";
        else
            $CEP="'".$CEP."'";
    }
    else
        $CEP="Null";

	include("../funcoes/conexao.php");
	$conecta = new Conexao;

	if ($Tipo=='1')
	{
		$sql = "insert into cadastro_agencia (numero, id_banco, nome, endereco, cidade, estado, cep) 
			values ($Numero, $ID_Banco,$Nome,$Endereco,$Cidade,$Estado,$CEP)";
		$result=$conecta->SQL_Query($sql);
		echo "<h2>Dados gravados com sucesso!</h2>";
		echo '<br>';
		echo '<meta http-equiv="Refresh" content="3;url=../cadastrar/cadastro_agencia.php"></body>';
	}
	elseif ($Tipo=='2') {
		$sql = "update cadastro_agencia set 
			numero = $Numero,  
			id_banco = $ID_Banco,  
			endereco = $Endereco,  
			cidade = $Cidade,  
			estado = $Estado,  
			cep = $CEP,  
			nome = $Nome  
			where id_agencia = $ID";
		#echo $sql;
        $result=$conecta->SQL_Query($sql);
		echo "<h2>Dados alterados com sucesso!</h2>";
		echo '<br>';
		echo '<meta http-equiv="Refresh" content="3;url=../pesquisar/pesquisa_agencia.php"></body>';
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
	echo '<a href="../cadastrar/cadastro_agencia.php">Voltar ao cadastro</a>';
	return;
}
		?>
</html>