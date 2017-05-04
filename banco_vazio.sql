--
-- Database: `banco`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_agencia`
--

CREATE TABLE `cadastro_agencia` (
  `ID_AGENCIA` int(11) NOT NULL,
  `NUMERO` int(11) NOT NULL,
  `ID_BANCO` int(11) NOT NULL,
  `NOME` varchar(60) NOT NULL,
  `ENDERECO` varchar(100) DEFAULT NULL,
  `CIDADE` varchar(100) DEFAULT NULL,
  `ESTADO` varchar(2) DEFAULT NULL,
  `CEP` varchar(8) DEFAULT NULL,
  `MOMENTO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EXCLUIDO` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_banco`
--

CREATE TABLE `cadastro_banco` (
  `ID_BANCO` int(11) NOT NULL,
  `CODIGO` varchar(10) NOT NULL,
  `NOME` varchar(50) NOT NULL,
  `CNPJ` varchar(14) NOT NULL,
  `MOMENTO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EXCLUIDO` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_cliente`
--

CREATE TABLE `cadastro_cliente` (
  `ID_CLIENTE` int(11) NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `RG` varchar(12) NOT NULL,
  `NOME` varchar(60) NOT NULL,
  `RUA` varchar(100) NOT NULL,
  `NUMERO` varchar(10) DEFAULT NULL,
  `COMPLEMENTO` varchar(100) DEFAULT NULL,
  `TELEFONE` varchar(14) DEFAULT NULL,
  `CIDADE` varchar(60) NOT NULL,
  `ESTADO` varchar(2) NOT NULL,
  `CEP` varchar(8) NOT NULL,
  `DATA_MORADIA` date NOT NULL,
  `EXCLUIDO` varchar(1) DEFAULT NULL,
  `MOMENTO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_usuario`
--

CREATE TABLE `cadastro_usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOME` varchar(20) NOT NULL,
  `SENHA` varchar(10) NOT NULL DEFAULT '123',
  `DATA_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EXCLUIDO` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hist_mov`
--

CREATE TABLE `hist_mov` (
  `ID_HM` int(11) NOT NULL,
  `ID_RCA` int(11) NOT NULL,
  `VALOR` double NOT NULL DEFAULT '0',
  `TIPO` smallint(6) NOT NULL DEFAULT '0' COMMENT '0=abertura,1=deposito,2=saque,3=deposito por transferencia,4=saque por transferencia',
  `DATA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_CLIENTE_ORIGEM` int(11) NOT NULL,
  `EXCLUIDO` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_cli_age`
--

CREATE TABLE `rel_cli_age` (
  `ID_RCA` int(11) NOT NULL,
  `ID_CLI` int(11) NOT NULL,
  `ID_AGE` int(11) NOT NULL,
  `CONTA` int(11) NOT NULL,
  `SALDO` double NOT NULL DEFAULT '0',
  `EXCLUIDO` tinyint(4) NOT NULL DEFAULT '0',
  `CRIACAO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `REMOCAO` timestamp NULL DEFAULT NULL,
  `MOTIVO` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=ZERO NO ANO, 2=MANUAL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadastro_agencia`
--
ALTER TABLE `cadastro_agencia`
  ADD PRIMARY KEY (`ID_AGENCIA`),
  ADD UNIQUE KEY `NUMERO` (`NUMERO`);

--
-- Indexes for table `cadastro_banco`
--
ALTER TABLE `cadastro_banco`
  ADD PRIMARY KEY (`ID_BANCO`),
  ADD UNIQUE KEY `CODIGO` (`CODIGO`);

--
-- Indexes for table `cadastro_cliente`
--
ALTER TABLE `cadastro_cliente`
  ADD PRIMARY KEY (`ID_CLIENTE`),
  ADD UNIQUE KEY `CPF` (`CPF`);

--
-- Indexes for table `cadastro_usuario`
--
ALTER TABLE `cadastro_usuario`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- Indexes for table `hist_mov`
--
ALTER TABLE `hist_mov`
  ADD PRIMARY KEY (`ID_HM`);

--
-- Indexes for table `rel_cli_age`
--
ALTER TABLE `rel_cli_age`
  ADD PRIMARY KEY (`ID_RCA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cadastro_agencia`
--
ALTER TABLE `cadastro_agencia`
  MODIFY `ID_AGENCIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `cadastro_banco`
--
ALTER TABLE `cadastro_banco`
  MODIFY `ID_BANCO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `cadastro_cliente`
--
ALTER TABLE `cadastro_cliente`
  MODIFY `ID_CLIENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cadastro_usuario`
--
ALTER TABLE `cadastro_usuario`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hist_mov`
--
ALTER TABLE `hist_mov`
  MODIFY `ID_HM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `rel_cli_age`
--
ALTER TABLE `rel_cli_age`
  MODIFY `ID_RCA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
