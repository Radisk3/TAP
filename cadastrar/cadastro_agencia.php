<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Cadastro de agências </title>
		<link rel="stylesheet" type="text/css" href="../formulario.css"/>
	</head>
<body>
<?php
	include_once("../funcoes/protege.php");
?>
<?php
	include('../funcoes/conexao.php');
	$sql = 'select id_banco, nome from cadastro_banco order by nome';
	$conecta = new Conexao;
	$consulta=$conecta->SQL_Query($sql);
?>
<br>
<div class="principal">
	<div class="meio">
	<h3> Cadastro de agências </h3>
		<div class="esquerda">
		<form method="POST" action="../salvar/salva_agencia.php" autocomplete="off">
			<font color="#00008b" size="2" font face="Arial" >
				<font size="1" color="red" >Informe somente números</font><br>
				<b>Número: </b> <input type="text" name="Numero" placeholder="Número agência" pattern="[0-9]+$" maxlength="10" size =10 required><br>
				<b>Nome: </b> <input type="text" name="Nome" placeholder="Nome completo da agência" maxlength="60" size =40 required><br>
				<b>Endereço: </b> <input type="text" name="Endereco" placeholder="Endereço da agência" maxlength="100" size =50 ><br>
				<b>Cidade: </b> <input type="text" name="Cidade" placeholder="Cidade da agência" maxlength="100" size =50 ><br>
				<b>Estado: </b> <input type="text" name="Estado" placeholder="Estado da agência" maxlength="2" size =3 ><br>
				<font size="1" color="red" >Informe somente números</font><br>
				<b>CEP: </b> <input type="text" name="CEP" placeholder="CEP da agência" pattern="[0-9]+$" maxlength="8" size =10 ><br>
				<b>Banco: </b><select class="form-control" name="ID_Banco">
					<?php while($Valor = mysql_fetch_array($consulta)){
						echo '<option value="$Valor["id_banco"]; " required >';
							echo $Valor["nome"];
						echo'</option>';
					}?>
				</select>
			</font>
			<br>
			<br>
			<button type="submit" value="Salvar">   Salvar   </button>
		</form>
		</div>
			<br>
		<form method="POST" action="../principal.php" autocomplete="off">
			<button type="submit" value="Principal">Página Principal</button>
		</form>
	</div>
</div>
	<a href="../funcoes/sair.php"><i>Sair</i></a>
</body>
</html>