<?php
    if (isset($_POST['ID_RCA']))
    {
        $ID_RCA=$_POST['ID_RCA'];
        if($ID_RCA=="")
            Retornar("de indice da conta ");
    }
    else
        Retornar("de indice da conta ","S");
    if (isset($_POST['Destino']))
    {
        $Destino=$_POST['Destino'];
        if($Destino=="")
            Retornar("Destino ");
    }
    else
        Retornar("Destino ","S");

    echo '<input type="text" name="ID_RCA" value = "' . $ID_RCA . '" required readonly="true" size=6 ><br>';
    session_start();
    $_SESSION['ID_RCA'] = $ID_RCA;

if ($Destino=="Propria")
        header('Location:../movimento/propria_conta.php');
    else
        header('Location:../pesquisar/pesquisa_terceiro.php');

    function Retornar($Campo,$Falhou="") {
        echo "<br>";
        echo "<br>";
        if ($Falhou=="")
            echo 'O campo '. $Campo .' não foi preenchido!';
        else
            echo 'Falha ao ler os dados do campo '. $Campo .'!';
        echo "<br>";
        echo "<br>";
        echo '<a href="../pesquisar/pesquisa_conta.php">Voltar a pesquisa</a>';
        return;
    }
?>