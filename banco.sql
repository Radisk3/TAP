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
  `MOMENTO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastro_agencia`
--

INSERT INTO `cadastro_agencia` (`ID_AGENCIA`, `NUMERO`, `ID_BANCO`, `NOME`, `ENDERECO`, `CIDADE`, `ESTADO`, `CEP`, `MOMENTO`) VALUES
(1, 10, 8, 'agencia 10', 'rua tal', NULL, NULL, NULL, '2017-01-17 20:57:55'),
(2, 444, 10, 'Agencia 4445', 'rua da 444', 'cidade 444', 'SC', '81846165', '2017-01-17 21:12:06'),
(3, 777, 14, 'agencia 7', 'rua da agÃªncia cara!!', 'Cidade 77777', 'MA', '67684513', '2017-01-17 22:58:04'),
(4, 20, 7, 'agencia 20', NULL, NULL, 'RS', NULL, '2017-01-18 11:30:19'),
(6, 7480, 16, 'SICREDI CENTRO', NULL, NULL, NULL, NULL, '2017-01-18 20:13:53'),
(7, 5445, 16, 'Sicredi Serra', NULL, 'Itaaara', 'RS', NULL, '2017-01-18 20:17:13'),
(9, 789, 16, 'Sicredi Medianeira', NULL, 'Santa Maria', 'RS', NULL, '2017-01-18 20:18:38'),
(10, 111, 1, 'Niderauer', 'Niderauer', NULL, 'RS', NULL, '2017-01-18 22:07:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_banco`
--

CREATE TABLE `cadastro_banco` (
  `ID_BANCO` int(11) NOT NULL,
  `CODIGO` varchar(10) NOT NULL,
  `NOME` varchar(50) NOT NULL,
  `CNPJ` varchar(14) NOT NULL,
  `MOMENTO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastro_banco`
--

INSERT INTO `cadastro_banco` (`ID_BANCO`, `CODIGO`, `NOME`, `CNPJ`, `MOMENTO`) VALUES
(1, '001', 'Banco do Brasil S/A', '00111222000133', '2017-01-17 20:06:09'),
(7, '555', 'banco 5 5', '5465465465465', '2017-01-17 20:06:09'),
(10, '88', 'BANCO 888', '88888888888888', '2017-01-17 20:06:09'),
(12, '99', 'BANCO 99999', '99999999999999', '2017-01-17 20:06:09'),
(14, '222', 'BANCO 2222', '22222222222222', '2017-01-17 20:06:09'),
(16, '748', 'SICREDI', '54651321561513', '2017-01-18 20:13:21');

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

--
-- Extraindo dados da tabela `cadastro_cliente`
--

INSERT INTO `cadastro_cliente` (`ID_CLIENTE`, `CPF`, `RG`, `NOME`, `RUA`, `NUMERO`, `COMPLEMENTO`, `TELEFONE`, `CIDADE`, `ESTADO`, `CEP`, `DATA_MORADIA`, `EXCLUIDO`, `MOMENTO`) VALUES
(1, '549874354', '987654654', 'Diego Radiske', 'Rua Coisa e Tal', '111111', 'Comp', '5513132131', 'Santa Maria', 'RS', '87894556', '2013-03-18', NULL, '2017-01-18 02:11:16'),
(2, '3290482394', '3492039209', 'Juca bala', 'rua', NULL, NULL, NULL, '', '', '', '0000-00-00', 'S', '2017-01-18 02:55:13'),
(3, '8789798798', '7987987897', 'Juca bala', 'Rua tal', NULL, NULL, '55 6787y888887', 'Santa ', 'RS', '32943034', '0000-00-00', NULL, '2017-01-18 02:57:15'),
(4, '4398305309', '0495930580', 'Tiona Chaves', 'Rua coisa', '32492093', NULL, '5454564654', 'Itaara', 'RS', '90898908', '0000-00-00', NULL, '2017-01-18 03:23:34'),
(5, '329023098', '32948230', 'maria ', 'rua da maria', '324', 'kdfjskl ', '348394', 'a cidade', 'UP', '39284092', '1984-12-01', NULL, '2017-01-18 08:13:50'),
(6, '8765164987', '5456465465', 'Mariana da Silva', 'rua do treco', NULL, NULL, '5566668454', 'Santa Maria', 'RS', '87465464', '1990-01-01', NULL, '2017-01-18 11:31:02'),
(7, '8979845646', '2132132123', 'Augusto G.', 'Rua principal', NULL, NULL, '55 99898465146', 'Restinga Seca', 'RS', '97484313', '1990-01-01', NULL, '2017-01-18 22:30:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_usuario`
--

CREATE TABLE `cadastro_usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOME` varchar(20) NOT NULL,
  `SENHA` varchar(10) NOT NULL DEFAULT '123',
  `DATA_CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastro_usuario`
--

INSERT INTO `cadastro_usuario` (`ID_USUARIO`, `NOME`, `SENHA`, `DATA_CADASTRO`) VALUES
(1, 'admin', '123', '2017-01-02 06:44:40'),
(2, 'Diego', '123', '2017-01-02 06:44:47');

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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
