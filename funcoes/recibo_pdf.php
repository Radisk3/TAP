<?php
	session_start();
	if (isset($_SESSION['TituloPDF']))
	{
		$TituloPDF=$_SESSION['TituloPDF'];
		if($TituloPDF=="")
			SaiFora();
	}
	else
		SaiFora();

	if (isset($_SESSION['Texto_Recibo']))
	{
		$Texto_Recibo=$_SESSION['Texto_Recibo'];
		if($Texto_Recibo=="")
			SaiFora();
	}
	else
		SaiFora();

	if (isset($_SESSION['Data_Hora']))
	{
		$Data_Hora=$_SESSION['Data_Hora'];
		if($Data_Hora=="")
			SaiFora();
	}
	else
		SaiFora();


	$Texto_Recibo=str_replace('<br>','|',$Texto_Recibo);
	$Texto_Recibo=utf8_encode($Texto_Recibo);
	#$Texto_Recibo=iconv('windows-1252','UTF-8',$Texto_Recibo);

	$Resultado=explode("|",$Texto_Recibo);

	require ('../PDF/fpdf.php');
	$pdf=new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Courier','B',12);
	$pdf->SetTextColor(0,0,150);
	$pdf->SetTitle($TituloPDF.'_'.$Data_Hora,true);
	$pdf->Text(10,10,utf8_decode($TituloPDF));
	$pdf->SetFont('Courier','B',10);
	$Linha=15;
	#$Linha=mb_convert_encoding($Linha,'auto');
	for ($w=0;$w<sizeof($Resultado);$w++)
	{
		$pdf->Text(10,$Linha,utf8_decode(utf8_decode($Resultado[$w])));
		$Linha=$Linha+5;
	}
	$pdf->Output();

function SaiFora() {
	echo "<br>";
	echo "<br>";
	$_SESSION['TituloPDF'] = '';
	$_SESSION['Texto_Recibo'] = '';
	echo '<h4>Falha ao ler os dados!</h4>';
	echo "<br>";
	echo '<meta http-equiv="Refresh" content="5;url=../principal.php"></body>';
	return;
}
?>
