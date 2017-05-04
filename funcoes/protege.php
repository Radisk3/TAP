<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>  </title>
	</head>
<body>
<?php
	session_start();
	if(isset($_SESSION['IDU'])==false)
	{
		header('Location:funcoes/invalido.html');
		return;
	}
	else{
		if ($_SESSION['IDU'] == null || $_SESSION['IDU'] == "")
		{
			header('Location:funcoes/invalido.html');
			return;
		}
	}

?>
</body>
</html>