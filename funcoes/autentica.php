<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Validação </title>
	</head>
<body>
<br>
<?php
	if (isset($_POST['Usuario']))
	{
		$Usuario=$_POST['Usuario'];
		if($Usuario=="")
		{
			echo "Nenhum Usuario fora inserido!";		
			echo '<br><br><a href="../login.html">Voltar</a>';
			return;
		}	
	}
	else 
	{
		echo "Falha ao ler dados!";		
		echo '<br><br><a href="../login.html">Voltar</a>';
		return;
	}
	if (isset($_POST['Senha']))
	{
		$Senha=$_POST['Senha'];
		if($Senha=="")
		{
			echo "Nenhuma Senha fora inserida!";		
			echo '<br><br><a href="../login.html">Voltar</a>';
			return;
		}	
	}
	else 
	{
		echo "Falha ao ler dados!";		
		echo '<br><br><a href="../login.html">Voltar</a>';
		return;
	}
	$conecta = mysqli_connect("localhost","root","");
	#$conecta = mysqli_connect("grupohs.com","grupo185_radiske","Cois@");
	if (!$conecta) {
		echo "Erro no mysqli_connect: " . PHP_EOL . "<br>";
		echo "Debugging error nº: " . mysqli_connect_errno() . PHP_EOL . "<br>";
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL . "<br>";
		exit;
	}
	$base = mysqli_select_db($conecta,"banco");
	#$base = mysqli_select_db($conecta,"grupo185_banco");
	if (!$base) {
		echo "Erro no mysqli_select_db " . PHP_EOL . "<br>";
		echo "Debugging error nº: " . mysqli_connect_errno() . PHP_EOL . "<br>";
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL . "<br>";
		exit;
	}
	$sql = "select id_usuario, nome from cadastro_usuario where nome = '$Usuario' and senha = '$Senha'";
	$result = mysqli_query($conecta,$sql);
	if (!$result) {
		echo "Erro no mysqli_query " . PHP_EOL . "<br>";
		echo "Debugging error nº: " . mysqli_connect_errno() . PHP_EOL . "<br>";
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL . "<br>";
		exit;
	}
	$Consulta = mysqli_fetch_array($result);
	if("$Consulta[nome]")
	{
//		session_destroy();
		$IDU="$Consulta[id_usuario]";
		$NomeU="$Consulta[nome]";
		echo "Feito!! Acesso liberado ao usuário $Consulta[nome]";
		echo "Verificando quem ele é... ";

		session_start();
		$_SESSION['NomeU'] = $NomeU;
		$_SESSION['IDU'] = $IDU;
		header('Location:../principal.php');
	}
	else
	{
		echo "Usuário ou senha inválidos!";
		echo '<br><br><a href="../login.html">Voltar</a>';
	}
	mysqli_close($conecta);
	?>
</html>