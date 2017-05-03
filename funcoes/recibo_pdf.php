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

	$Texto_Recibo=str_replace('<br>','|',$Texto_Recibo);
	#$Texto_Recibo=utf8_encode($Texto_Recibo);
	$Resultado=explode("|",$Texto_Recibo);

	require ('../PDF/fpdf.php');
	$pdf=new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Courier','B',10);
	$pdf->Text(10,10,$TituloPDF);
	$Linha=15;
	for ($w=0;$w<sizeof($Resultado);$w++)
	{
		$pdf->Text(10,$Linha,$Resultado[$w]);
		$Linha=$Linha+5;
	}
#	$pdf->Text(30,20,$Texto_Recibo);
	$pdf->Output();

function SaiFora() {
	echo "<br>";
	echo "<br>";
	$_SESSION['TituloPDF'] = '';
	$_SESSION['Texto_Recibo'] = '';
	echo '<h4>Falha ao ler os dados!</h4>';
	echo "<br>";
	echo '<meta http-equiv="Refresh" content="3;url=../principal.php"></body>';
	return;
}
?>
