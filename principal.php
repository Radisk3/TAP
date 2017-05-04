<html>
<head>
    <title>Sistema do Banco</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="formulario.css"/>
</head>
<body>
<div class="principal">
    <div class="meio">
    <?php
        include_once("funcoes/protege.php");
        $IDU=$_SESSION['IDU'];
        $NOME=$_SESSION['NomeU'];
        echo "<h1> Olá " . $NOME . " este é o seu painel do sistema! </h1>";
    ?>
    <h1>Escolha uma das opções abaixo</h1>
    <h1>CADASTRO</h1>
    <table align="center">
        <tr>
            <td><form method="POST" action="cadastrar/cadastro_banco.php" autocomplete="off">
                <button type="submit" value="Banco">  BANCO  </button>
            </form></td>
            <td><form method="POST" action="cadastrar/cadastro_agencia.php" autocomplete="off">
                <button type="submit" value="Agencia">  AGÊNCIA  </button>
            </form></td>
            <td><form method="POST" action="cadastrar/cadastro_cliente.php" autocomplete="off">
                <button type="submit" value="Clientes">  CLIENTE  </button>
            </form></td>
            <td><form method="POST" action="cadastrar/cadastro_conta.php" autocomplete="off">
                <button type="submit" value="Clientes">  CONTA  </button>
            </form></td>
        </tr>
    </table>
    <h1>PESQUISA</h1>
    <table align="center">
        <tr>
            <td><form method="POST" action="pesquisar/pesquisa_banco.php" autocomplete="off">
                <button type="submit" value="Pesquisa_Banco">  BANCOS  </button>
            </form></td>
            <td><form method="POST" action="pesquisar/pesquisa_agencia.php" autocomplete="off">
                <button type="submit" value="Pesquisa_Agencia">  AGÊNCIAS  </button>
            </form></td>
            <td><form method="POST" action="pesquisar/pesquisa_cliente.php" autocomplete="off">
                <button type="submit" value="Pesquisa_Cliente">  CLIENTES  </button>
            </form></td>
            <td><form method="POST" action="pesquisar/pesquisa_conta.php" autocomplete="off">
                <button type="submit" value="Pesquisa_Conta">  CONTAS  </button>
            </form></td>
        </tr>
    </table>
    <h1>MOVIMENTO</h1>
    <table align="center">
        <tr>
            <td><form method="POST" action="pesquisar/pesquisa_conta.php" autocomplete="off">
                <button type="submit" value="Propria_Conta">  CONTAS  </button>
            </form></td>
        </tr>
    </table>
    <h1>RELATÓRIO</h1>
    <table align="center">
        <tr>
            <td><form method="POST" action="relatorios/pesquisar_contas.php" autocomplete="off">
                <button type="submit" value="Contas">  CONTAS  </button>
            </form></td>
            <td><form method="POST" action="relatorios/pesquisar_bancos.php" autocomplete="off">
                <button type="submit" value="Bancos">  BANCOS  </button>
            </form></td>
            <td><form method="POST" action="relatorios/pesquisar_agencias.php" autocomplete="off">
                <button type="submit" value="Agencias">  AGÊNCIAS  </button>
            </form></td>
            <td><form method="POST" action="relatorios/pesquisar_clientes.php" autocomplete="off">
                <button type="submit" value="Clientes">  CLIENTES  </button>
            </form></td>
        </tr>
    </table>
    <table align="center">
        <tr>
            <td><form method="POST" action="relatorios/pesquisar_saldos.php" autocomplete="off">
                <button type="submit" value="Saldos">  SALDOS DAS CONTAS  </button>
            </form></td>
            <td><form method="POST" action="relatorios/pesquisar_movimentos.php" autocomplete="off">
                <button type="submit" value="Movimentos">  MOVIMENTO DAS CONTAS  </button>
            </form></td>
        </tr>
    </table>
    <table align="center">
        <tr>
            <td><form method="POST" action="relatorios/pesquisar_clientes_excluidos.php" autocomplete="off">
                <button type="submit" value="Clientes">  CLIENTES EXCLUIDOS  </button>
            </form></td>
            <td><form method="POST" action="relatorios/pesquisar_contas_excluidas.php" autocomplete="off">
                <button type="submit" value="Clientes">  CONTAS EXCLUIDAS  </button>
            </form></td>
        </tr>
    </table>
    <table align="center">
        <tr>
            <td><form method="POST" action="funcoes/sair.php">
                <button type="submit" value="Sair">     Sair     </button>
            </form></td>
        </tr>
    </table>
    </div>
</div>
</body>
</html>
