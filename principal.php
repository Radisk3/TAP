<html>
<head>
    <title>Sistema do Banco</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="formulario.css"/>
</head>
<body>
    <?php
        include_once("funcoes/protege.php");
        $IDU=$_SESSION['IDU'];
        $NOME=$_SESSION['NomeU'];
        echo "<h2> Olá " . $NOME . " este é o seu painel do sistema! </h2>";
    ?>
    <h2>Escolha uma das opções abaixo</h2>
    <table align="center">
        <tr>
            <td><form method="POST" action="cadastrar/cadastro_banco.php" autocomplete="off">
                <button type="submit" value="Banco">  Cadastrar novo banco  </button>
            </form></td>
            <td><form method="POST" action="cadastrar/cadastro_agencia.php" autocomplete="off">
                <button type="submit" value="Agencia">  Cadastrar nova agência  </button>
            </form></td>
            <td><form method="POST" action="cadastrar/cadastro_cliente.php" autocomplete="off">
                <button type="submit" value="Clientes">  Cadastrar novo cliente  </button>
            </form></td>
            <td><form method="POST" action="cadastrar/cadastro_conta.php" autocomplete="off">
                <button type="submit" value="Clientes">  Cadastrar nova conta  </button>
            </form></td>
        </tr>
    </table>
    <br>
    <table align="center">
        <tr>
            <td><form method="POST" action="pesquisar/pesquisa_banco.php" autocomplete="off">
                <button type="submit" value="Pesquisa_Banco">  Pesquisar bancos  </button>
            </form></td>
            <td><form method="POST" action="pesquisar/pesquisa_agencia.php" autocomplete="off">
                <button type="submit" value="Pesquisa_Agencia">  Pesquisar agências  </button>
            </form></td>
            <td><form method="POST" action="pesquisar/pesquisa_cliente.php" autocomplete="off">
                <button type="submit" value="Pesquisa_Cliente">  Pesquisar clientes  </button>
            </form></td>
            <td><form method="POST" action="pesquisar/pesquisa_conta.php" autocomplete="off">
                <button type="submit" value="Pesquisa_Conta">  Pesquisar contas  </button>
            </form></td>
        </tr>
    </table>
    <h2>MOVIMENTO</h2>
    <table align="center">
        <tr>
            <td><form method="POST" action="movimento/propria_conta.php" autocomplete="off">
                <button type="submit" value="Propria_Conta">  Própria conta  </button>
            </form></td>
            <td><form method="POST" action="movimento/entre_contas.php" autocomplete="off">
                <button type="submit" value="Entre_Contas">  Entre contas  </button>
            </form></td>
        </tr>
    </table>
    <br>
    <table align="center">
        <tr>
            <td><form method="POST" action="funcoes/sair.php">
                    <button type="submit" value="Sair">     Sair     </button>
            </form></td>
        </tr>
    </table>
</body>
</html>
