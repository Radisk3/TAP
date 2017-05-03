<?php
class Conexao {
    // Informações do Banco de Dados
    var $host = "localhost";
    var $user = "root";
    var $senha = "";
    var $dbase = "banco";

    // Variáveis utilizadas
    var $query;
    var $link;
    var $resultado;

    // Instancia o Objeto
    function MySQL(){

    }
    // Cria a função para Conectarr ao Banco MySQL
    function Conectar(){
        $this->link = @mysql_connect($this->host,$this->user,$this->senha);
        // Conectar ao Banco de Dados
        if(!$this->link){
            print "Ocorreu um Erro na conexão MySQL:";
            print "<b>".mysql_error()."</b>";
            die();
        }elseif(!mysql_select_db($this->dbase,$this->link)){
            print "Ocorreu um Erro em selecionar o Banco:";
            print "<b>".mysql_error()."</b>";
            die();
        }
    }

    // Cria a função para query no Banco de Dados
    function SQL_Query($query){
        $this->Conectar();
        $this->query = $query;
        // Conectar e faz a query no MySQL
        if($this->resultado = mysql_query($this->query)){
            $this->Desconectar();
            return $this->resultado;
        }else{
            // Caso ocorra um erro, exibe uma mensagem com o Erro
            print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
            print "<br /><br />";
            print "Erro no MySQL: <b>".mysql_error()."</b>";
            $this->Desconectar();
            die();
        }
    }

    // Cria a função para DesConectarr ao Banco MySQL
    function Desconectar(){
        return mysql_close($this->link);
    }
}
?>