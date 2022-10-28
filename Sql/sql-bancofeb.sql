-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: mysql11-farm76.kinghost.net
-- Tempo de geração: 30/03/2019 às 20:58
-- Versão do servidor: 5.6.36-log
-- Versão do PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `feb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_conf_de_para`
--

CREATE TABLE IF NOT EXISTS `a_conf_de_para` (
  `id_configuracao` int(11) NOT NULL,
  `id_loja` int(10) NOT NULL,
  `tipo_configuracao` varchar(100) NOT NULL,
  `de` varchar(100) NOT NULL,
  `para` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_conf_integracao`
--

CREATE TABLE IF NOT EXISTS `a_conf_integracao` (
  `id_config` int(10) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(250) NOT NULL,
  `detalhesdaconfiguracao` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=274 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `a_conf_integracao`
--

INSERT INTO `a_conf_integracao` (`id_config`, `id_loja`, `name`, `value`, `detalhesdaconfiguracao`) VALUES
(240, 8, 'nomeWSProdutos', 'http://189.6.53.200:8081/ws/WSHorusItensEstoque.asmx', ''),
(241, 8, 'nomeWSClientes', 'http://189.6.53.200:8081/ws/WSHorusCliente.asmx', ''),
(242, 8, 'nomeWSPedidos', 'http://189.6.53.200:8081:8081/ws/WSHorusPedidoVenda.asmx', ''),
(243, 8, 'codEmpresa', '1', ''),
(244, 8, 'codFilial', '1', ''),
(245, 8, 'codTipoCaracteristica', '1', ''),
(246, 8, 'codCaracteristica', '1', ''),
(247, 8, 'codMetodoVenda', '6', ''),
(248, 8, 'codResponsavelVenda', '11', ''),
(249, 8, 'percentualEstoqueDisponivel', '6', ''),
(250, 8, 'codTipoCli', '3', ''),
(251, 8, 'codTipoEndCli', '1', ''),
(252, 8, 'codRespCli', '11', ''),
(253, 8, 'nomeRespCli', 'Site', ''),
(254, 8, 'codFormaPagtoBoletoVenda', '8', ''),
(255, 8, 'codFormaPagtoCCredVenda', '2', ''),
(256, 8, 'codFormaPagtoCDebiVenda', '2', ''),
(257, 8, 'codPac', '37', ''),
(258, 8, 'codSedex', '38', ''),
(259, 8, 'codImpressoModico', '40', ''),
(260, 8, 'codOutra', '39', ''),
(261, 8, 'codSedex10', '2', ''),
(262, 8, 'nomeStatPedidoEnvErp', '''Aprovado''', ''),
(263, 8, 'codStatusAoEnviarParaErp', '0', ''),
(264, 8, 'nomeStatPedidoSincronizacaoERP', '''Enviado para o Horus'', ''Ag Faturamento'', ''Faturado'', ''Em Expedicao'',  ''Pre - venda Aprovado''', 'Informe no valor entre aspas simples e separado por virgula os status dos pedidos que deverão sincronizar no ERP.\nEssa configuração, determina quais status de pedidos o Eros deverá buscar para sincronização com o ERP.'),
(265, 8, 'nomeStatusFaturadoBuscaNfRastreio', 'FAT', 'Configuração define Status do Pedido ERP para que o Eros busque informações de Codigo de Rastreio e Nota fiscal. Esta configuração é vinculada a tela status_pedido.php (Sincronização de Status de Pedidos no ADMIN)'),
(266, 8, 'qtdDiasCron', '30', 'Quantidade de dias para sincronização dos Status dos pedidos. Essa configuração esta sendo utilizada na tela de status_pedidos.php.'),
(267, 8, 'nomeWSCapas', 'http://189.6.53.200:8081/ws/capas-web/', ''),
(268, 8, 'codStatusBoletoAguardandoPagamento', '0', 'Esta configuração é necessário para configurar o código do status do pedido quando finaliza uma compra com o boleto.\r\nPaginas onde se encontra a chamada dessa informação: (/Webservices/creatOrder.php)'),
(269, 8, 'nomeStatusFaturadoBuscaNfRastreioEros', '''Faturado''', 'Configuração define Status do Pedido do Eros, para que busque informações de Codigo de Rastreio e Nota fiscal. Esta configuração é vinculada a tela status_pedido.php (Sincronização de Status de Pedidos no ADMIN)'),
(270, 8, 'nomeArquivoCapa', 'isbn', 'Configuração necessária para buscar o nome das imagens por codigo interno ou codigo de barras'),
(271, 8, 'estoqueEm', 'quantidade', 'Configuração necessária para validar o tipo de pesquisa do saldo do estoque'),
(272, 8, 'statusPreVendaNaoConf', '''Pre - venda Ag pagamento''', 'Configuração para atribuir vendas com o metodo com itens em Pre venda'),
(273, 8, 'statusPreVendaConf', '''Pre - venda Aprovado''', 'Configuração para atribuir vendas com o metodo com itens em Pre venda onde o pagamento foi confirmado.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_logs_login`
--

CREATE TABLE IF NOT EXISTS `a_logs_login` (
  `id_l` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `sid` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12782 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `a_logs_login`
--

INSERT INTO `a_logs_login` (`id_l`, `id_u`, `data`, `status`, `sid`, `ip`) VALUES
(12774, 10016, '2019-02-16 15:26:11', 1, '1d535e0ae57aae3aa5ff0047460112ad', '177.138.149.212'),
(12775, 10016, '2019-02-18 00:47:38', 1, 'd3841bd5c622d885441584da62f38740', '177.138.149.212'),
(12776, 10016, '2019-02-20 09:41:43', 1, 'd3b9b2e9ce2c2affe8afa19605eecbe2', '177.138.149.212'),
(12777, 10016, '2019-02-20 14:31:24', 1, 'dcbd40ba1c1be86b42a4c6b0911c3a2a', '191.193.174.184'),
(12778, 10016, '2019-02-21 00:47:33', 1, '2f38e15d7daa0f8dc9c5618a65b629fa', '177.138.149.212'),
(12779, 10016, '2019-02-26 16:08:45', 1, '68e58ce3a90602aded61a6f5596f03cd', '189.110.63.129'),
(12780, 10016, '2019-02-26 16:21:36', 1, '2e41589cb24e32247fef4d576ef41397', '189.110.63.129'),
(12781, 10016, '2019-02-27 02:11:00', 1, '2e41589cb24e32247fef4d576ef41397', '189.110.63.129');

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_lojas`
--

CREATE TABLE IF NOT EXISTS `a_lojas` (
  `id_l` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `ativo` int(11) NOT NULL,
  `data_cad` datetime NOT NULL,
  `token` varchar(40) DEFAULT NULL,
  `domain` varchar(100) DEFAULT NULL,
  `domain_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `a_lojas`
--

INSERT INTO `a_lojas` (`id_l`, `nome`, `ativo`, `data_cad`, `token`, `domain`, `domain_ip`) VALUES
(8, 'Loja Monergismo', 1, '2019-02-15 00:00:00', NULL, 'www.feb.com.br', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_lojas_cielo`
--

CREATE TABLE IF NOT EXISTS `a_lojas_cielo` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `MerchantId` varchar(100) NOT NULL,
  `MerchantKey` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_lojas_dados`
--

CREATE TABLE IF NOT EXISTS `a_lojas_dados` (
  `id_config` int(10) unsigned NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `a_lojas_dados`
--

INSERT INTO `a_lojas_dados` (`id_config`, `id_loja`, `name`, `value`) VALUES
(15, 8, 'cepOrigem', '70760620'),
(16, 8, 'nomeLoja', 'Editora Monergismo'),
(17, 8, 'siteLoja', 'https://www.feb.com.br'),
(18, 8, 'telSac', '(61) 3222-1795'),
(19, 8, 'horaAtend', '08:30 às 17:30'),
(20, 8, 'emailNotif', 'contato@monergismo.com'),
(21, 8, 'parcMin', '6'),
(22, 8, 'valAcres', '1.00'),
(23, 8, 'lojaAtiva', '1'),
(24, 8, 'smtpServer', 'smtp.eroscommerce.com.br'),
(25, 8, 'smtpUser', 'notificacao@eroscommerce.com.br'),
(26, 8, 'smtpPass', 'er05top123'),
(27, 8, 'smtpPort', '587'),
(28, 8, 'valFrtFree', '15000.00'),
(30, 8, 'impModico', '1'),
(39, 8, 'vlrMinParcela', '30.00'),
(41, 8, 'nomBancoBoleto', 'Bradesco'),
(42, 8, 'codBancoBoleto', '237'),
(43, 8, 'numAgenciaBoleto', '0200'),
(44, 8, 'numDigAgenciaBoleto', '3'),
(45, 8, 'numContaBoleto', '108960'),
(46, 8, 'numDigContaBoleto', '9'),
(47, 8, 'qtdDiasVencBoleto', '3'),
(68, 8, 'codCarteiraBanco', '25'),
(69, 8, 'CNPJ', '10.677.104/0001-99'),
(70, 8, 'logradouro', 'SCRN 712/713, Bloco B, Loja 28 - Ed. Francisco Morato'),
(71, 8, 'cidade', 'Brasília'),
(72, 8, 'uf', 'DF'),
(73, 8, 'primeiraPolitica', 'Produto'),
(74, 8, 'segundaPolitica', 'Categoria'),
(75, 8, 'terceiraPolitica', 'Editora'),
(83, 8, 'metaheadgoogle', 'FMbjOepNzUCbfvqC98mTVdQkXsFdMFpDCX_jgqjgNB4'),
(143, 8, 'tokenPagseguro', '0F204B68C9F1476BB825E22F9DC4547E'),
(144, 8, 'emailPagseguro', 'informatica@editoraalianca.com.br'),
(145, 8, 'ambientePagseguro', 'production'),
(149, 8, 'linkPagseguro', 'https://ws.pagseguro.uol.com.br/v2/');

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_lojas_itau`
--

CREATE TABLE IF NOT EXISTS `a_lojas_itau` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `codigo_empresa` varchar(26) NOT NULL,
  `chave_cripto` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_lojas_rede`
--

CREATE TABLE IF NOT EXISTS `a_lojas_rede` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `AffiliationPV` varchar(100) NOT NULL,
  `Token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_mails_param`
--

CREATE TABLE IF NOT EXISTS `a_mails_param` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `id_template` int(11) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_pages`
--

CREATE TABLE IF NOT EXISTS `a_pages` (
  `id_page` smallint(5) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `a_pages`
--

INSERT INTO `a_pages` (`id_page`, `name`, `category`) VALUES
(1, 'dashboard.php', 'Default'),
(2, 'add_produto.php', 'Produtos'),
(3, 'produtos.php', 'Produtos'),
(4, 'clientes.php', 'Clientes'),
(5, 'pedidos.php', 'Pedidos'),
(6, 'p_editoras.php', 'Produtos'),
(7, 'add_editora.php', 'Produtos'),
(8, 'p_autores.php', 'Produtos'),
(9, 'add_autor.php', 'Produtos'),
(10, 'add_cliente.php', 'Clientes'),
(11, 'clientes.php', 'Clientes'),
(12, 'add_status.php', 'Pedidos'),
(13, 'pedidos_status.php', 'Pedidos'),
(14, 'vitrines.php', 'Aparencia'),
(15, 'p_categorias.php', 'Produtos'),
(16, 'add_categoria.php', 'Produtos'),
(17, 'add_vitrine.php', 'Aparencia'),
(18, 'viewOrder.php', 'Pedidos'),
(19, 'banners.php', 'Aparencia'),
(20, 'add_banner.php', 'Aparencia'),
(21, 'promocoes.php', 'Promocoes'),
(22, 'p_import.php', 'Produtos'),
(23, 'add_promo.php', 'Promocoes'),
(24, 'cupons.php', 'Promocoes'),
(26, 'add_cupom.php', 'Promocoes'),
(27, 'aprova_coment.php', 'Clientes'),
(28, 'frete_gratis.php', 'Promocoes'),
(29, 'add_frete_gratis.php', 'Promocoes'),
(30, 'transportadoras.php', 'Configuracoes'),
(31, 'add_transportadora.php', 'Configuracoes'),
(32, 'integracoes.php', 'Integracoes'),
(33, 'p_tipo_produto.php', 'Produtos'),
(34, 'dados_cadastrais.php', 'Configuracoes'),
(35, 'configuracao_integracao.php', 'Configuracoes'),
(36, 'add_range_transportadora.php', 'Configuracoes'),
(37, 'produtosskyhub.php', 'Marketplace'),
(38, 'menutopo.php', 'Aparencia'),
(39, 'preferencias.php', 'Configuracoes'),
(40, 'google.php', 'Configuracoes'),
(41, 'integracoes_magento.php', 'Integracoes'),
(42, 'configuracao_magento.php', 'Configuracoes'),
(43, 'relatorio_de_produtos.php', 'Relatorios'),
(44, 'configuracao_pagseguro.php', 'Configuracoes'),
(45, 'p_selos.php', 'Produtos'),
(46, 'relatorio_de_vendas.php', 'Relatorios'),
(47, 'relatorio_de_vendas_itens.php', 'Relatorios'),
(48, 'dados_cadastrais.php', 'Configuracoes');

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_pages_front`
--

CREATE TABLE IF NOT EXISTS `a_pages_front` (
  `id_page_front` int(10) NOT NULL,
  `id_loja` int(10) NOT NULL,
  `tipoinfomenu` varchar(50) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_page_user_access`
--

CREATE TABLE IF NOT EXISTS `a_page_user_access` (
  `id_access` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `page` varchar(50) NOT NULL,
  `access` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_preferencias`
--

CREATE TABLE IF NOT EXISTS `a_preferencias` (
  `id_preferencia` int(10) NOT NULL,
  `id_loja` int(10) NOT NULL,
  `preferencia` varchar(150) NOT NULL,
  `value` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `a_preferencias`
--

INSERT INTO `a_preferencias` (`id_preferencia`, `id_loja`, `preferencia`, `value`) VALUES
(41, 8, 'utilizarIntegracaoErp', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_sicronizacao_integrador`
--

CREATE TABLE IF NOT EXISTS `a_sicronizacao_integrador` (
  `id_sicronizacao` int(10) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `tipo_sicronizacao` varchar(50) NOT NULL,
  `data_sicronizacao` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `a_sicronizacao_integrador`
--

INSERT INTO `a_sicronizacao_integrador` (`id_sicronizacao`, `id_loja`, `tipo_sicronizacao`, `data_sicronizacao`) VALUES
(67, 8, 'autores', '2019-02-20 17:46:44'),
(68, 8, 'editora', '2019-02-20 17:46:26'),
(69, 8, 'tipo_produto', '2019-02-20 17:51:17'),
(70, 8, 'produtos', '2019-02-27 10:41:43'),
(71, 8, 'autores_produtos', '2019-02-20 19:03:48'),
(72, 8, 'preco_itens', '2019-02-20 19:01:13'),
(84, 8, 'categoria_produto', '2019-02-26 16:33:40'),
(86, 8, 'estoque_produtos2', '2019-02-20 19:17:30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_transportadoras`
--

CREATE TABLE IF NOT EXISTS `a_transportadoras` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` enum('valorxpeso','retiranaloja','internacional','terceiros','40010','41106','retiranaloja2','speed','04162','04669') DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_users`
--

CREATE TABLE IF NOT EXISTS `a_users` (
  `id_u` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_cad` datetime NOT NULL,
  `last_sid` varchar(100) NOT NULL,
  `loja_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL COMMENT 'GRUPO DE ADMINISTRACAO',
  `ativo` enum('1','0') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10017 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `a_users`
--

INSERT INTO `a_users` (`id_u`, `nome`, `login`, `senha`, `email`, `data_cad`, `last_sid`, `loja_id`, `group_id`, `ativo`) VALUES
(10016, 'monergismo', 'monergismo', '5dee05ae7f753fc15398022933454f9d35b9ec881a5eaf29adaf529d7c6361c4a83006acc8f83bb6d470f11886922638e4b2c16015f4d8b81b901f6d3bc83f8a', '', '2019-02-16 00:00:00', '2e41589cb24e32247fef4d576ef41397', 8, 0, '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `a_user_pref`
--

CREATE TABLE IF NOT EXISTS `a_user_pref` (
  `id_p` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  `pref_name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `id_loja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `c_cidades`
--

CREATE TABLE IF NOT EXISTS `c_cidades` (
  `id` int(4) unsigned zerofill NOT NULL,
  `estado` int(2) unsigned zerofill NOT NULL DEFAULT '00',
  `uf` varchar(4) NOT NULL DEFAULT '',
  `nome` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=9718 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `c_clientes`
--

CREATE TABLE IF NOT EXISTS `c_clientes` (
  `id_cli` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `apelido` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `id_group` tinyint(10) unsigned NOT NULL,
  `data_cad` datetime NOT NULL,
  `newsletter` enum('0','1') DEFAULT NULL,
  `ativo` enum('0','1') DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `rg` varchar(100) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT '',
  `tipo` enum('PJ','PF') DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `id_cliente_erp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `c_clientes_tokens`
--

CREATE TABLE IF NOT EXISTS `c_clientes_tokens` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `valid` enum('0','1') DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `c_enderecos`
--

CREATE TABLE IF NOT EXISTS `c_enderecos` (
  `id_e` int(11) NOT NULL,
  `nome_end` varchar(150) DEFAULT NULL,
  `id_cli` int(11) NOT NULL,
  `tipo` enum('Principal','Entrega','Comercial','Outro','Casa','Apartamento') DEFAULT NULL,
  `logradouro` varchar(200) NOT NULL,
  `bairro` varchar(70) DEFAULT NULL,
  `numero` varchar(50) NOT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `cidade` smallint(100) unsigned DEFAULT NULL,
  `estado` tinyint(3) unsigned NOT NULL,
  `cep` char(9) NOT NULL,
  `id_loja` int(11) unsigned NOT NULL,
  `principal` enum('0','1') NOT NULL COMMENT '1: SIM - 0: NAO',
  `ativo` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `c_estados`
--

CREATE TABLE IF NOT EXISTS `c_estados` (
  `id` int(2) unsigned zerofill NOT NULL,
  `uf` varchar(10) NOT NULL DEFAULT '',
  `nome` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `c_grupos`
--

CREATE TABLE IF NOT EXISTS `c_grupos` (
  `id_g` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `loja_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_acessos`
--

CREATE TABLE IF NOT EXISTS `l_acessos` (
  `id_acesso` int(10) unsigned NOT NULL,
  `id_loja` int(10) unsigned NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_hora` datetime DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `sid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_avise_me`
--

CREATE TABLE IF NOT EXISTS `l_avise_me` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_banners`
--

CREATE TABLE IF NOT EXISTS `l_banners` (
  `id_banner` int(10) unsigned NOT NULL,
  `id_loja` int(10) unsigned NOT NULL,
  `link` varchar(150) DEFAULT NULL,
  `img` varchar(150) DEFAULT NULL,
  `position` enum('topo') DEFAULT NULL,
  `alt` varchar(150) DEFAULT NULL,
  `data_ini` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `ativo` enum('0','1') DEFAULT NULL,
  `posicao` int(10) DEFAULT NULL,
  `tiposessao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_carrinho`
--

CREATE TABLE IF NOT EXISTS `l_carrinho` (
  `id_cart` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_loja` int(11) NOT NULL,
  `sid` varchar(100) NOT NULL,
  `online` enum('0','1') NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `cliente` varchar(50) DEFAULT NULL,
  `statusCart` enum('OLN','ABN','FNZ') DEFAULT NULL,
  `cepCart` varchar(20) DEFAULT NULL,
  `vlrFrete` float DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_carrinho_itens`
--

CREATE TABLE IF NOT EXISTS `l_carrinho_itens` (
  `id_item` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `id_loja` int(11) NOT NULL,
  `qntd` int(11) NOT NULL DEFAULT '0',
  `remove` enum('0','1') DEFAULT NULL,
  `add` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_frete_gratis`
--

CREATE TABLE IF NOT EXISTS `l_frete_gratis` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `cep_ini` varchar(45) DEFAULT NULL,
  `cep_fim` varchar(45) DEFAULT NULL,
  `gratis` enum('0','1') DEFAULT NULL,
  `validade` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_itens_vendas`
--

CREATE TABLE IF NOT EXISTS `l_itens_vendas` (
  `id_item` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `val_unit` float NOT NULL COMMENT 'valor da unidade',
  `preco_bruto` float NOT NULL,
  `desconto` float NOT NULL,
  `desconto_cupom` float DEFAULT NULL,
  `preco_liq` float NOT NULL,
  `id_loja` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_log_pedido_magento`
--

CREATE TABLE IF NOT EXISTS `l_log_pedido_magento` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `name_file` varchar(100) NOT NULL,
  `situacao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_mail_template`
--

CREATE TABLE IF NOT EXISTS `l_mail_template` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `html` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_newsletter`
--

CREATE TABLE IF NOT EXISTS `l_newsletter` (
  `email` varchar(150) NOT NULL,
  `data` datetime DEFAULT NULL,
  `id_loja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_pesquisas`
--

CREATE TABLE IF NOT EXISTS `l_pesquisas` (
  `id_loja` int(11) NOT NULL,
  `term` varchar(100) NOT NULL,
  `resultados` int(11) DEFAULT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_range_transportadora`
--

CREATE TABLE IF NOT EXISTS `l_range_transportadora` (
  `id` int(10) NOT NULL,
  `id_transportadora` int(10) NOT NULL,
  `id_loja` int(10) NOT NULL,
  `cep_ini` char(8) NOT NULL,
  `cep_fim` char(8) NOT NULL,
  `peso_ini` decimal(10,2) NOT NULL,
  `peso_fim` decimal(10,2) NOT NULL,
  `prazo` int(10) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `uf` char(2) NOT NULL,
  `localidade` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_vendas`
--

CREATE TABLE IF NOT EXISTS `l_vendas` (
  `v_id` int(11) NOT NULL,
  `cod_pedido_erp` int(10) DEFAULT NULL,
  `status_pag` varchar(10) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `total_desc` decimal(10,2) NOT NULL COMMENT 'total com desconto',
  `frete` decimal(10,2) DEFAULT NULL,
  `prazo` int(11) DEFAULT NULL,
  `id_cli` int(11) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `obs` text NOT NULL COMMENT 'Uso interno',
  `data` datetime NOT NULL COMMENT 'Data de criacao',
  `id_status_prod` int(10) unsigned DEFAULT '0' COMMENT 'Status da produção -> l_vendas_status',
  `id_cupom` int(11) unsigned DEFAULT NULL,
  `freteMode` varchar(20) DEFAULT NULL,
  `tid` varchar(40) DEFAULT NULL,
  `paymentId` char(36) NOT NULL,
  `tipoPagto` enum('debitCard','creditCard','boleto','deposito','boletoPagseguro','credPagseguro','debPagseguro','transferItau','boletoItau') DEFAULT NULL,
  `bandeira` varchar(20) DEFAULT NULL,
  `parcelas` int(10) DEFAULT NULL,
  `authenticationUrl` varchar(128) NOT NULL,
  `nro_nota_fiscal` varchar(10) DEFAULT NULL,
  `codigo_rastreio` varchar(20) DEFAULT NULL,
  `pedido_exportado_erp` enum('0','1') DEFAULT '0',
  `dispositivo` varchar(100) DEFAULT NULL,
  `id_pedido_magento` varchar(50) DEFAULT NULL,
  `pscode` varchar(32) DEFAULT NULL,
  `prevenda` enum('0','1') DEFAULT NULL,
  `notificadoRastreio` enum('0','1') DEFAULT NULL,
  `retornoRede` varchar(200) DEFAULT NULL,
  `nsu` varchar(100) DEFAULT NULL,
  `codePagseguro` varchar(250) DEFAULT NULL,
  `linkBoletoPagseguro` varchar(250) DEFAULT NULL,
  `erroPagseguro` varchar(500) DEFAULT NULL,
  `statusPagseguro` varchar(10) DEFAULT NULL,
  `navegador` varchar(20) DEFAULT NULL,
  `id_ped_skyhub` varchar(100) DEFAULT NULL,
  `status_skyhub` varchar(100) DEFAULT NULL,
  `tipo_frete_skyhub` varchar(100) DEFAULT NULL,
  `data_estimada_entrega_skyhub` date DEFAULT NULL,
  `canal_skyhub` varchar(100) DEFAULT NULL,
  `data_aprovacao_skyhub` date DEFAULT NULL,
  `chave_nfe` varchar(44) DEFAULT NULL,
  `tipo_pedido` enum('LOJA','MKT') DEFAULT NULL,
  `tipo_pagto_itau` varchar(10) DEFAULT NULL,
  `dat_venc_itau` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_vendas_coment`
--

CREATE TABLE IF NOT EXISTS `l_vendas_coment` (
  `id_comment` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_vendas_historico`
--

CREATE TABLE IF NOT EXISTS `l_vendas_historico` (
  `id_h` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `id_loja` int(11) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT '-1: System (uso interno)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_vendas_historico_pag`
--

CREATE TABLE IF NOT EXISTS `l_vendas_historico_pag` (
  `id_hist` int(10) unsigned NOT NULL,
  `id_loja` int(10) unsigned DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `obs` text,
  `id_venda` int(11) DEFAULT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_vendas_status`
--

CREATE TABLE IF NOT EXISTS `l_vendas_status` (
  `id_status` int(10) unsigned NOT NULL,
  `id_loja` int(10) unsigned NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `color` enum('primary','default','danger','success','warning','dark','system','info','alert','Light grey') DEFAULT NULL,
  `pendente` enum('0','1') DEFAULT NULL,
  `concluido` enum('0','1') DEFAULT NULL,
  `cancelado` enum('0','1') DEFAULT NULL,
  `aprovado` enum('1','0') NOT NULL,
  `tipo` enum('Recebemos seu pedido','Cancelado','Processando','Nota fiscal emitida','Não Aprovado','Entrega realizada','Em separação no estoque','Aguardando pagamento','Em procedimento para entrega','Aguardando retirada em nossa loja','Pedido realizado','Pagamento aprovado','Pedido enviado') NOT NULL,
  `enviar_notificacao` enum('0','1') NOT NULL,
  `html` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_visitors`
--

CREATE TABLE IF NOT EXISTS `l_visitors` (
  `id_v` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data` datetime NOT NULL,
  `sid` varchar(150) DEFAULT NULL,
  `id_loja` int(11) NOT NULL,
  `online` enum('0','1') NOT NULL,
  `dispositivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_vitrines`
--

CREATE TABLE IF NOT EXISTS `l_vitrines` (
  `id_vitrine` int(10) unsigned NOT NULL,
  `id_loja` int(10) unsigned NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `ordem` tinyint(4) DEFAULT NULL,
  `show_home` enum('1','0') DEFAULT NULL,
  `ativo` enum('1','0') DEFAULT NULL,
  `ordenacao` varchar(50) DEFAULT NULL,
  `data_ini` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `qtd_exibir_home` int(10) NOT NULL,
  `tipo` enum('Padrao','Google','SkyHub') NOT NULL,
  `show_maior_zero` enum('0','1') NOT NULL,
  `faixa_rodape_item` enum('0','1') DEFAULT NULL,
  `tiposessao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `l_vitrines_produtos`
--

CREATE TABLE IF NOT EXISTS `l_vitrines_produtos` (
  `id_produto` int(10) unsigned NOT NULL,
  `id_vitrine` int(10) unsigned NOT NULL,
  `id_loja` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_arquivos`
--

CREATE TABLE IF NOT EXISTS `p_arquivos` (
  `id` int(10) unsigned NOT NULL,
  `id_loja` int(10) unsigned NOT NULL,
  `id_produto` int(10) unsigned NOT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `nome_original` varchar(100) DEFAULT NULL,
  `deleted` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_autores`
--

CREATE TABLE IF NOT EXISTS `p_autores` (
  `id_autor` int(10) unsigned NOT NULL,
  `id_tipo_autor` int(10) NOT NULL,
  `id_loja` int(10) unsigned NOT NULL,
  `nome_autor` varchar(100) DEFAULT NULL,
  `ativo` enum('1','0') DEFAULT NULL,
  `id_autor_externo` int(10) NOT NULL,
  `id_tipo_autor_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12925 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `p_autores`
--

INSERT INTO `p_autores` (`id_autor`, `id_tipo_autor`, `id_loja`, `nome_autor`, `ativo`, `id_autor_externo`, `id_tipo_autor_externo`, `data_atualizacao`) VALUES
(12839, 0, 8, 'Abraham Kuyper', '1', 23, 1, '2018-12-10T17:35:37.663-02:00'),
(12840, 0, 8, 'Alexandre Magno Fernandes Moreira', '1', 48, 1, '2018-12-12T13:16:56.38-02:00'),
(12841, 0, 8, 'ALVIN PLANTINGA', '1', 46, 1, '2018-12-12T13:00:11.437-02:00'),
(12842, 0, 8, 'Brian G. Mattson', '1', 15, 1, '2018-12-10T16:39:20.173-02:00'),
(12843, 0, 8, 'Carl F. H. Henry', '1', 56, 1, '2018-12-12T15:37:40.037-02:00'),
(12844, 0, 8, 'Carl R. Trueman', '1', 62, 1, '2018-12-12T17:07:49.96-02:00'),
(12845, 0, 8, 'Carolyn Mahaney & Nicole Mahaney', '1', 43, 1, '2018-12-12T12:31:39.733-02:00'),
(12846, 0, 8, 'Cornelius Van Til', '1', 63, 1, '2018-12-12T17:12:22.713-02:00'),
(12847, 0, 8, 'David. K. Naugle', '1', 19, 1, '2018-12-10T17:07:55.07-02:00'),
(12848, 0, 8, 'Diversos', '1', 85, 1, '2019-01-30T15:53:42.543-02:00'),
(12849, 0, 8, 'Diversos Autores', '1', 49, 1, '2018-12-12T13:22:24.587-02:00'),
(12850, 0, 8, 'Douglas Jones', '1', 37, 1, '2018-12-12T11:43:25.637-02:00'),
(12851, 0, 8, 'Douglas Wilson', '1', 3, 1, '2018-12-19T14:48:39.26-02:00'),
(12852, 0, 8, 'Douglas Wilson e outros', '1', 35, 1, '2018-12-12T11:25:48.553-02:00'),
(12853, 0, 8, 'Egbert Schuurman', '1', 64, 1, '2018-12-12T17:18:14.477-02:00'),
(12854, 0, 8, 'Elizabeth Gomes', '1', 80, 1, '2018-12-19T14:37:32.92-02:00'),
(12855, 0, 8, 'Émile Léonard', '1', 26, 1, '2018-12-10T18:01:40.923-02:00'),
(12856, 0, 8, 'Emílio Garofalo Neto', '1', 52, 1, '2018-12-12T15:08:48.817-02:00'),
(12857, 0, 8, 'Felipe Sabino e outros', '1', 22, 1, '2018-12-10T17:24:18.733-02:00'),
(12858, 0, 8, 'Francis A. Schaeffer', '1', 4, 1, '2018-12-06T15:45:32.147-02:00'),
(12859, 0, 8, 'Francisco Leonardo Schalkwijk', '1', 36, 1, '2018-12-12T11:34:26.643-02:00'),
(12860, 0, 8, 'Gary DeMar', '1', 77, 1, '2018-12-14T14:10:56.99-02:00'),
(12861, 0, 8, 'Gerald Hiestand e Jay Thomas', '1', 82, 1, '2018-12-19T14:52:13.467-02:00'),
(12862, 0, 8, 'Gordon H. Clark', '1', 7, 1, '2018-12-10T15:20:33.117-02:00'),
(12863, 0, 8, 'Greg L. Bahnsen', '1', 54, 1, '2018-12-12T15:29:20.877-02:00'),
(12864, 0, 8, 'Hans R. Rookmaaker', '1', 38, 1, '2018-12-12T11:46:38.68-02:00'),
(12865, 0, 8, 'Harvey e Laurie Bluedorn', '1', 51, 1, '2018-12-12T13:46:18.86-02:00'),
(12866, 0, 8, 'Hélio Angotti Neto', '1', 50, 1, '2018-12-12T13:32:36.303-02:00'),
(12867, 0, 8, 'Herman Bavinck', '1', 39, 1, '2018-12-12T11:54:51.907-02:00'),
(12868, 0, 8, 'Herman Dooyeweerd', '1', 24, 1, '2018-12-10T17:40:26.923-02:00'),
(12869, 0, 8, 'Herman Hanko, Homer Hoeksema e Gise J. Van Baren', '1', 78, 1, '2018-12-14T14:15:47.673-02:00'),
(12870, 0, 8, 'Hermisten Maia', '1', 67, 1, '2018-12-14T13:42:25.217-02:00'),
(12871, 0, 8, 'Hugh J. Flemming', '1', 33, 1, '2018-12-10T18:54:28.697-02:00'),
(12872, 0, 8, 'James K. A. Smith', '1', 53, 1, '2018-12-12T15:24:57.027-02:00'),
(12873, 0, 8, 'James W. Sire', '1', 32, 1, '2018-12-10T18:49:46.43-02:00'),
(12874, 0, 8, 'Jason Lisle', '1', 70, 1, '2018-12-12T18:03:41.827-02:00'),
(12875, 0, 8, 'Jay Adams', '1', 45, 1, '2018-12-12T12:40:21.563-02:00'),
(12876, 0, 8, 'Jean-Marc Berthoud', '1', 30, 1, '2018-12-10T18:40:29.68-02:00'),
(12877, 0, 8, 'Jeffery J. Ventrella', '1', 75, 1, '2018-12-14T13:14:00.097-02:00'),
(12878, 0, 8, 'Jerry Bridges', '1', 60, 1, '2018-12-12T16:46:11.893-02:00'),
(12879, 0, 8, 'João Calvino', '1', 83, 1, '2019-01-08T18:15:02.577-02:00'),
(12880, 0, 8, 'Joe Morecraft III', '1', 74, 1, '2018-12-14T13:10:22.973-02:00'),
(12881, 0, 8, 'Joe Rigney', '1', 47, 1, '2018-12-12T13:11:08.12-02:00'),
(12882, 0, 8, 'Joe Thorn', '1', 25, 1, '2018-12-10T17:51:49.34-02:00'),
(12883, 0, 8, 'Joel McDurmon', '1', 73, 1, '2018-12-14T13:06:47.44-02:00'),
(12884, 0, 8, 'John Perritt', '1', 57, 1, '2018-12-12T15:50:11.88-02:00'),
(12885, 0, 8, 'John Piper e outros', '1', 18, 1, '2018-12-10T17:03:10.47-02:00'),
(12886, 0, 8, 'Joseph Farinaccio', '1', 9, 1, '2018-12-10T15:34:28.903-02:00'),
(12887, 0, 8, 'Josué K. Reichow', '1', 86, 1, '2019-02-04T16:26:55.003-02:00'),
(12888, 0, 8, 'K. Scott Oliphint', '1', 58, 1, '2018-12-12T16:13:31.2-02:00'),
(12889, 0, 8, 'Kenneth G. Talbot', '1', 66, 1, '2018-12-12T17:37:09.87-02:00'),
(12890, 0, 8, 'Kenneth L. Gentry Jr.', '1', 28, 1, '2018-12-10T18:22:53.013-02:00'),
(12891, 0, 8, 'Kevin J. Vanhoozer', '1', 68, 1, '2018-12-12T17:51:28.03-02:00'),
(12892, 0, 8, 'Lee Duigon', '1', 69, 1, '2018-12-12T17:56:59.47-02:00'),
(12893, 0, 8, 'Louis Berkhof', '1', 27, 1, '2018-12-10T18:11:49.853-02:00'),
(12894, 0, 8, 'Mark Jones', '1', 59, 1, '2018-12-12T16:18:53.48-02:00'),
(12895, 0, 8, 'Martinho Lutero', '1', 21, 1, '2018-12-10T17:20:43.96-02:00'),
(12896, 0, 8, 'Michael Reeves', '1', 10, 1, '2018-12-10T15:40:09.36-02:00'),
(12897, 0, 8, 'N. D. Wilson', '1', 41, 1, '2018-12-12T12:03:17.92-02:00'),
(12898, 0, 8, 'Odayr Olivetti', '1', 11, 1, '2018-12-10T15:56:05.827-02:00'),
(12899, 0, 8, 'P. Andrew Sandlin', '1', 8, 1, '2018-12-10T15:26:50.74-02:00'),
(12900, 0, 8, 'Peter Bringe', '1', 65, 1, '2018-12-12T17:33:21.923-02:00'),
(12901, 0, 8, 'Peter Leithart', '1', 13, 1, '2018-12-10T16:21:43.907-02:00'),
(12902, 0, 8, 'Philip Ryken', '1', 81, 1, '2018-12-19T14:43:44.74-02:00'),
(12903, 0, 8, 'Pierre Viret', '1', 29, 1, '2018-12-10T18:31:58.82-02:00'),
(12904, 0, 8, 'R. J. RUSHDOONY', '1', 5, 1, '2018-12-10T15:03:52.993-02:00'),
(12905, 0, 8, 'Richard Swinburne', '1', 55, 1, '2018-12-12T15:33:17.43-02:00'),
(12906, 0, 8, 'Robert Kolb e Carl R. Trueman', '1', 20, 1, '2018-12-10T17:14:02.923-02:00'),
(12907, 0, 8, 'Ron Gleason', '1', 14, 1, '2018-12-10T16:27:56.233-02:00'),
(12908, 0, 8, 'Ronald Nash', '1', 31, 1, '2018-12-10T18:44:31.94-02:00'),
(12909, 0, 8, 'Rosaria Champagne Butterfield', '1', 72, 1, '2018-12-12T18:44:44.597-02:00'),
(12910, 0, 8, 'Russell D. Moore', '1', 1, 1, '2018-12-12T12:13:44.427-02:00'),
(12911, 0, 8, 'Sam Allberry', '1', 79, 1, '2018-12-14T14:21:54.65-02:00'),
(12912, 0, 8, 'Sara Leone', '1', 34, 1, '2018-12-12T11:10:37.957-02:00'),
(12913, 0, 8, 'Stephen C. Perks', '1', 2, 1, '2018-12-06T15:29:40.443-02:00'),
(12914, 0, 8, 'Stephen C. Perks', '1', 40, 1, '2018-12-12T11:58:45.303-02:00'),
(12915, 0, 8, 'Terry L. Johnson', '1', 12, 1, '2018-12-10T16:14:30.09-02:00'),
(12916, 0, 8, 'Thaddeus J. Williams', '1', 71, 1, '2018-12-12T18:23:16.853-02:00'),
(12917, 0, 8, 'Uri Brito', '1', 61, 1, '2018-12-12T16:53:26.673-02:00'),
(12918, 0, 8, 'Vicent Cheung', '1', 84, 1, '2019-01-21T15:04:05.407-02:00'),
(12919, 0, 8, 'Vicente Themudo Lessa', '1', 42, 1, '2018-12-12T12:23:00.183-02:00'),
(12920, 0, 8, 'Voodie Baucham Jr.', '1', 44, 1, '2018-12-12T12:34:49.95-02:00'),
(12921, 0, 8, 'W. Gary Crampton', '1', 6, 1, '2018-12-10T15:13:29.413-02:00'),
(12922, 0, 8, 'W. Gary Crampton & Richard E. Bacon', '1', 76, 1, '2018-12-14T13:38:05.98-02:00'),
(12923, 0, 8, 'Wadislau M. Gomes', '1', 16, 1, '2018-12-10T16:42:35.663-02:00'),
(12924, 0, 8, 'William Perkins', '1', 17, 1, '2018-12-10T16:47:06.473-02:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_categorias`
--

CREATE TABLE IF NOT EXISTS `p_categorias` (
  `id_cat` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `id_loja` int(11) NOT NULL,
  `id_categoria_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2037 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `p_categorias`
--

INSERT INTO `p_categorias` (`id_cat`, `nome`, `parent_id`, `id_loja`, `id_categoria_externo`, `data_atualizacao`) VALUES
(2013, 'Aconselhamento bíblico', 2013, 8, 13, '2019-02-04T02:22:48.753-02:00'),
(2014, 'Apologética', 2014, 8, 5, '2018-12-10T15:33:05.833-02:00'),
(2015, 'Arte e Literatura', 2015, 8, 28, '2019-02-04T02:23:19.647-02:00'),
(2016, 'Escola Bíblica Dominical', 2016, 8, 29, '2019-02-04T02:23:52.55-02:00'),
(2017, 'Catecúmenos', 2017, 8, 4, '2018-12-06T15:45:04.793-02:00'),
(2018, 'Conhecimento de Deus', 2018, 8, 30, '2019-02-04T02:24:15.673-02:00'),
(2019, 'Cosmovisão', 2019, 8, 15, '2018-12-10T17:06:49.887-02:00'),
(2020, 'Cultura cristã', 2020, 8, 2, '2019-02-04T02:24:42.437-02:00'),
(2021, 'Economia, Política, Negócios e Ética', 2021, 8, 27, '2019-02-04T02:25:14.247-02:00'),
(2022, 'Educação', 2022, 8, 18, '2018-12-12T10:53:03.83-02:00'),
(2023, 'Escatologia', 2023, 8, 8, '2018-12-10T16:02:43.02-02:00'),
(2024, 'Estudos bíblicos', 2024, 8, 31, '2019-02-04T02:25:36.063-02:00'),
(2025, 'Ética e Medicina', 2025, 8, 32, '2019-02-04T02:26:11.187-02:00'),
(2026, 'Evangelismo & Missões', 2026, 8, 24, '2019-02-04T02:26:29.997-02:00'),
(2027, 'Família Cristã', 2027, 8, 19, '2019-02-04T02:26:54.9-02:00'),
(2028, 'Filosofia cristã', 2028, 8, 10, '2019-02-04T02:27:21.07-02:00'),
(2029, 'História & Biografia', 2029, 8, 33, '2019-02-04T02:29:45.357-02:00'),
(2030, 'Mulher cristã', 2030, 8, 34, '2019-02-04T02:30:22.773-02:00'),
(2031, 'Reforma Protestante', 2031, 8, 35, '2019-02-04T02:30:40.737-02:00'),
(2032, 'Sexualidade', 2032, 8, 36, '2019-02-04T02:31:01.76-02:00'),
(2033, 'Teologia', 2033, 8, 6, '2018-12-10T15:49:56.093-02:00'),
(2034, 'Teologia do Deslumbramento', 2034, 8, 20, '2018-12-20T13:54:29.973-02:00'),
(2035, 'Teologia Eclesiástica', 2035, 8, 37, '2019-02-04T02:31:23.03-02:00'),
(2036, 'Vida Cristã', 2036, 8, 3, '2018-12-06T15:38:49.06-02:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_editoras`
--

CREATE TABLE IF NOT EXISTS `p_editoras` (
  `id_editora` int(10) unsigned NOT NULL,
  `id_loja` int(10) unsigned NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `id_editora_externo` int(10) NOT NULL,
  `vlr_desconto_editora` decimal(5,2) NOT NULL,
  `nom_fantasia` varchar(150) NOT NULL,
  `data_atualizacao` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1447 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `p_editoras`
--

INSERT INTO `p_editoras` (`id_editora`, `id_loja`, `nome`, `status`, `id_editora_externo`, `vlr_desconto_editora`, `nom_fantasia`, `data_atualizacao`) VALUES
(1446, 8, 'Editora Monergismo', '1', 2, '0.00', 'Editora Monergismo', '2018-12-06T12:02:51.373-02:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_grupo_item`
--

CREATE TABLE IF NOT EXISTS `p_grupo_item` (
  `id_grupo_item` int(10) unsigned NOT NULL,
  `nome` varchar(50) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `id_loja` int(11) unsigned NOT NULL,
  `id_grupo_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(50) NOT NULL,
  `data_envio_skyhub` datetime DEFAULT NULL,
  `data_atualizacao_skyhub` datetime DEFAULT NULL,
  `skyhub` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_images`
--

CREATE TABLE IF NOT EXISTS `p_images` (
  `id_img` int(11) unsigned NOT NULL,
  `id_loja` int(11) unsigned NOT NULL,
  `id_produto` int(11) unsigned NOT NULL,
  `default_img` enum('0','1') NOT NULL COMMENT '1: IMAGEM PADRAO, 0: DEMAIS IMAGENS',
  `dir_name` varchar(300) NOT NULL,
  `deleted` enum('0','1') DEFAULT '0',
  `data_modificacao` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29382 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `p_images`
--

INSERT INTO `p_images` (`id_img`, `id_loja`, `id_produto`, `default_img`, `dir_name`, `deleted`, `data_modificacao`) VALUES
(29225, 8, 120969, '1', '8/9788569980599.jpg', '0', 'Thu, 07 Feb 2019 04:14:56 GMT'),
(29226, 8, 120970, '1', '8/9788562478758.jpg', '0', 'Thu, 07 Feb 2019 03:59:53 GMT'),
(29227, 8, 120971, '1', '8/9788562478697.jpg', '0', 'Thu, 07 Feb 2019 17:11:14 GMT'),
(29228, 8, 120972, '1', '8/9788562478390.jpg', '0', 'Thu, 07 Feb 2019 04:09:20 GMT'),
(29229, 8, 120973, '1', '8/9788569980018.jpg', '0', 'Sat, 16 Feb 2019 22:49:03 GMT'),
(29230, 8, 120974, '1', '8/9788569980803.jpg', '0', 'Sun, 17 Feb 2019 22:41:05 GMT'),
(29231, 8, 120975, '1', '8/9788569980179.jpg', '0', 'Sun, 17 Feb 2019 13:03:28 GMT'),
(29232, 8, 120976, '1', '8/9788562478970.jpg', '0', 'Sun, 17 Feb 2019 20:33:16 GMT'),
(29233, 8, 120977, '1', '8/9788569980292.jpg', '0', 'Sun, 17 Feb 2019 21:06:45 GMT'),
(29234, 8, 120978, '1', '8/9788569980513.jpg', '0', 'Sun, 17 Feb 2019 22:16:30 GMT'),
(29235, 8, 120979, '1', '8/9788562478819.jpg', '0', 'Sun, 17 Feb 2019 22:07:05 GMT'),
(29236, 8, 120980, '1', '8/9788562478383.jpg', '0', 'Sun, 17 Feb 2019 21:08:34 GMT'),
(29237, 8, 120980, '1', '8/semimagem.png', '0', '20/02/2019'),
(29238, 8, 120982, '1', '8/9788569980261.jpg', '0', 'Sun, 17 Feb 2019 20:31:14 GMT'),
(29239, 8, 120983, '1', '8/9788595930018.jpg', '0', 'Sun, 17 Feb 2019 21:24:25 GMT'),
(29240, 8, 120984, '1', '8/9788569980582.jpg', '0', 'Sun, 17 Feb 2019 22:31:09 GMT'),
(29241, 8, 120985, '1', '8/9788562478598.jpg', '0', 'Sun, 17 Feb 2019 22:03:04 GMT'),
(29242, 8, 120986, '1', '8/9788569980049.jpg', '0', 'Sun, 17 Feb 2019 21:34:34 GMT'),
(29243, 8, 120987, '1', '8/9788569885047.jpg', '0', 'Sun, 17 Feb 2019 21:00:50 GMT'),
(29244, 8, 120988, '1', '8/9788562478444.jpg', '0', 'Sun, 17 Feb 2019 21:34:04 GMT'),
(29245, 8, 120989, '1', '8/9788562478673.jpg', '0', 'Sun, 17 Feb 2019 22:05:49 GMT'),
(29246, 8, 120990, '1', '8/9788569980131.jpg', '0', 'Sat, 16 Feb 2019 22:47:52 GMT'),
(29247, 8, 120991, '1', '8/9788562478895.jpg', '0', 'Sun, 17 Feb 2019 22:08:35 GMT'),
(29248, 8, 120992, '1', '8/9788569980728.jpg', '0', 'Sun, 17 Feb 2019 22:38:24 GMT'),
(29249, 8, 120993, '1', '8/9788569885054.jpg', '0', 'Sun, 17 Feb 2019 22:12:06 GMT'),
(29250, 8, 120994, '1', '8/9788562478963.jpg', '0', 'Sat, 16 Feb 2019 23:50:02 GMT'),
(29251, 8, 120995, '1', '8/9788569980568.jpg', '0', 'Sun, 17 Feb 2019 22:29:41 GMT'),
(29252, 8, 120996, '1', '8/9788569980339.jpg', '0', 'Sun, 17 Feb 2019 20:58:16 GMT'),
(29253, 8, 120997, '1', '8/9788569980391.jpg', '0', 'Sun, 17 Feb 2019 20:49:16 GMT'),
(29254, 8, 120998, '1', '8/9788562478918.jpg', '0', 'Sun, 17 Feb 2019 21:03:24 GMT'),
(29255, 8, 120999, '1', '8/9788569980148.jpg', '0', 'Sun, 17 Feb 2019 21:30:21 GMT'),
(29256, 8, 121000, '1', '8/9788562478505.jpg', '0', 'Sun, 17 Feb 2019 22:00:57 GMT'),
(29257, 8, 121001, '1', '8/9788569885023.jpg', '0', 'Sun, 17 Feb 2019 20:56:41 GMT'),
(29258, 8, 121002, '1', '8/9788569980353.jpg', '0', 'Sun, 17 Feb 2019 13:02:11 GMT'),
(29259, 8, 121003, '1', '8/9788569980322.jpg', '0', 'Sun, 17 Feb 2019 13:02:49 GMT'),
(29260, 8, 121004, '1', '8/9788569980452.jpg', '0', 'Sun, 17 Feb 2019 22:13:11 GMT'),
(29261, 8, 121005, '1', '8/9788562478611.jpg', '0', 'Sun, 17 Feb 2019 22:03:34 GMT'),
(29262, 8, 121006, '1', '8/9788569980155.jpg', '0', 'Sun, 17 Feb 2019 21:18:43 GMT'),
(29263, 8, 121006, '1', '8/semimagem.png', '0', '20/02/2019'),
(29264, 8, 121008, '1', '8/9788569980438.jpg', '0', 'Sun, 17 Feb 2019 20:33:46 GMT'),
(29265, 8, 121009, '1', '8/9788562478888.jpg', '0', 'Sat, 16 Feb 2019 22:54:48 GMT'),
(29266, 8, 121010, '1', '8/9788569980209.jpg', '0', 'Sat, 16 Feb 2019 22:59:27 GMT'),
(29267, 8, 121011, '1', '8/9788562478567.jpg', '0', 'Sun, 17 Feb 2019 20:30:48 GMT'),
(29268, 8, 121012, '1', '8/9788569980001.jpg', '0', 'Sun, 17 Feb 2019 20:53:08 GMT'),
(29269, 8, 121013, '1', '8/9788569980704.jpg', '0', 'Sun, 17 Feb 2019 22:37:17 GMT'),
(29270, 8, 121014, '1', '8/9788569980087.jpg', '0', 'Sun, 17 Feb 2019 20:32:21 GMT'),
(29271, 8, 121014, '1', '8/semimagem.png', '0', '20/02/2019'),
(29272, 8, 121016, '1', '8/9788569980506.jpg', '0', 'Sun, 17 Feb 2019 22:15:35 GMT'),
(29273, 8, 121017, '1', '8/9788569980223.jpg', '0', 'Sun, 17 Feb 2019 20:35:52 GMT'),
(29274, 8, 121018, '1', '8/9788562478475.jpg', '0', 'Sun, 17 Feb 2019 20:56:12 GMT'),
(29275, 8, 121019, '1', '8/9788569885016.jpg', '0', 'Sun, 17 Feb 2019 22:11:22 GMT'),
(29276, 8, 121020, '1', '8/9788569980278.jpg', '0', 'Sun, 17 Feb 2019 21:20:02 GMT'),
(29277, 8, 121021, '1', '8/9788569980773.jpg', '0', 'Sun, 17 Feb 2019 21:20:27 GMT'),
(29278, 8, 121022, '1', '8/9788569980780.jpg', '0', 'Sun, 17 Feb 2019 22:40:34 GMT'),
(29279, 8, 121023, '1', '8/9788569980094.jpg', '0', 'Sun, 17 Feb 2019 21:33:39 GMT'),
(29280, 8, 121024, '1', '8/9788569980254.jpg', '0', 'Sun, 17 Feb 2019 20:35:26 GMT'),
(29281, 8, 121025, '1', '8/9788562478321.jpg', '0', 'Sun, 17 Feb 2019 20:55:21 GMT'),
(29282, 8, 121026, '1', '8/9788569980476.jpg', '0', 'Sun, 17 Feb 2019 22:14:06 GMT'),
(29283, 8, 121027, '1', '8/9788569980797.jpg', '0', 'Sun, 17 Feb 2019 21:22:55 GMT'),
(29284, 8, 121028, '1', '8/9788569980193.jpg', '0', 'Sun, 17 Feb 2019 21:02:17 GMT'),
(29285, 8, 121029, '1', '8/9788569980810.jpg', '0', 'Sun, 17 Feb 2019 21:32:41 GMT'),
(29286, 8, 121030, '1', '8/9788569980469.jpg', '0', 'Sun, 17 Feb 2019 13:01:29 GMT'),
(29287, 8, 121031, '1', '8/9788569980100.jpg', '0', 'Sun, 17 Feb 2019 20:31:49 GMT'),
(29288, 8, 121032, '1', '8/9788569980162.jpg', '0', 'Sun, 17 Feb 2019 21:10:32 GMT'),
(29289, 8, 121033, '1', '8/9788562478635.jpg', '0', 'Sun, 17 Feb 2019 20:59:46 GMT'),
(29290, 8, 121034, '1', '8/9788562478857.jpg', '0', 'Sun, 17 Feb 2019 22:08:06 GMT'),
(29291, 8, 121035, '1', '8/9788569980636.jpg', '0', 'Sun, 17 Feb 2019 22:33:17 GMT'),
(29292, 8, 121036, '1', '8/9788569980537.jpg', '0', 'Sun, 17 Feb 2019 22:24:56 GMT'),
(29293, 8, 121036, '1', '8/semimagem.png', '0', '20/02/2019'),
(29294, 8, 121038, '1', '8/9788562478413.jpg', '0', 'Sun, 17 Feb 2019 22:01:29 GMT'),
(29295, 8, 121039, '1', '8/9788569980681.jpg', '0', 'Sun, 17 Feb 2019 22:36:07 GMT'),
(29296, 8, 121040, '1', '8/9788562478796.jpg', '0', 'Sat, 16 Feb 2019 23:03:32 GMT'),
(29297, 8, 121041, '1', '8/9788562478840.jpg', '0', 'Sun, 17 Feb 2019 22:07:33 GMT'),
(29298, 8, 121042, '1', '8/9788562478543.jpg', '0', 'Sun, 17 Feb 2019 22:02:23 GMT'),
(29299, 8, 121042, '1', '8/semimagem.png', '0', '20/02/2019'),
(29300, 8, 121044, '1', '8/9788562478659.jpg', '0', 'Sun, 17 Feb 2019 21:23:21 GMT'),
(29301, 8, 121045, '1', '8/9000000001473.jpg', '0', 'Sun, 17 Feb 2019 21:45:24 GMT'),
(29302, 8, 121046, '1', '8/9000000001350.jpg', '0', 'Sun, 17 Feb 2019 21:38:42 GMT'),
(29303, 8, 121047, '1', '8/9788569980445.jpg', '0', 'Sun, 17 Feb 2019 20:36:21 GMT'),
(29304, 8, 121047, '1', '8/semimagem.png', '0', '20/02/2019'),
(29305, 8, 121049, '1', '8/9788569980698.jpg', '0', 'Sun, 17 Feb 2019 22:36:38 GMT'),
(29306, 8, 121050, '1', '8/9788569980360.jpg', '0', 'Sun, 17 Feb 2019 21:05:11 GMT'),
(29307, 8, 121051, '1', '8/9788562478680.jpg', '0', 'Sun, 17 Feb 2019 21:40:11 GMT'),
(29308, 8, 121052, '1', '8/9788569980247.jpg', '0', 'Sun, 17 Feb 2019 20:32:49 GMT'),
(29309, 8, 121053, '1', '8/9788569980742.jpg', '0', 'Sun, 17 Feb 2019 22:40:04 GMT'),
(29310, 8, 121054, '1', '8/9788569980216.jpg', '0', 'Sun, 17 Feb 2019 20:39:29 GMT'),
(29311, 8, 121055, '1', '8/9788569980230.jpg', '0', 'Sun, 17 Feb 2019 13:07:32 GMT'),
(29312, 8, 121056, '1', '8/9788562478277.jpg', '0', 'Sun, 17 Feb 2019 13:07:07 GMT'),
(29313, 8, 121057, '1', '8/9788569980117.jpg', '0', 'Sun, 17 Feb 2019 21:16:37 GMT'),
(29314, 8, 121058, '1', '8/9788569980544.jpg', '0', 'Sun, 17 Feb 2019 22:27:59 GMT'),
(29315, 8, 121059, '1', '8/9788569980421.jpg', '0', 'Sun, 17 Feb 2019 20:34:57 GMT'),
(29316, 8, 121060, '1', '8/9788569980667.jpg', '0', 'Sun, 17 Feb 2019 22:34:25 GMT'),
(29317, 8, 121061, '1', '8/9788569980285.jpg', '0', 'Sun, 17 Feb 2019 20:58:49 GMT'),
(29318, 8, 121062, '1', '8/9788569980841.jpg', '0', 'Sun, 17 Feb 2019 22:42:23 GMT'),
(29319, 8, 121063, '1', '8/9788569980025.jpg', '0', 'Sun, 17 Feb 2019 13:04:58 GMT'),
(29320, 8, 121064, '1', '8/9788562478666.jpg', '0', 'Sun, 17 Feb 2019 21:17:22 GMT'),
(29321, 8, 121065, '1', '8/9788569980735.jpg', '0', 'Sun, 17 Feb 2019 22:38:53 GMT'),
(29322, 8, 121066, '1', '8/9788569980483.jpg', '0', 'Sun, 17 Feb 2019 22:14:35 GMT'),
(29323, 8, 121067, '1', '8/9788569980377.jpg', '0', 'Sun, 17 Feb 2019 21:15:08 GMT'),
(29324, 8, 121067, '1', '8/semimagem.png', '0', '20/02/2019'),
(29325, 8, 121069, '1', '8/9788562478901.jpg', '0', 'Sun, 17 Feb 2019 20:57:46 GMT'),
(29326, 8, 121070, '1', '8/9788569980575.jpg', '0', 'Sun, 17 Feb 2019 22:30:20 GMT'),
(29327, 8, 121071, '1', '8/9788569980551.jpg', '0', 'Sun, 17 Feb 2019 22:28:40 GMT'),
(29328, 8, 121072, '1', '8/9788562478574.jpg', '0', 'Sun, 17 Feb 2019 20:52:32 GMT'),
(29329, 8, 121073, '1', '8/9788562478550.jpg', '0', 'Sun, 17 Feb 2019 21:29:44 GMT'),
(29330, 8, 121074, '1', '8/9788569980346.jpg', '0', 'Sun, 17 Feb 2019 12:58:56 GMT'),
(29331, 8, 121075, '1', '8/9788562478833.jpg', '0', 'Sun, 17 Feb 2019 21:04:44 GMT'),
(29332, 8, 121076, '1', '8/9788569980612.jpg', '0', 'Sun, 17 Feb 2019 22:32:14 GMT'),
(29333, 8, 121077, '1', '8/9788562478376.jpg', '0', 'Sun, 17 Feb 2019 21:44:50 GMT'),
(29334, 8, 121077, '1', '8/semimagem.png', '0', '20/02/2019'),
(29335, 8, 121079, '1', '8/9788562478734.jpg', '0', 'Sun, 17 Feb 2019 22:04:56 GMT'),
(29336, 8, 121080, '1', '8/9788562478345.jpg', '0', 'Sun, 17 Feb 2019 21:01:33 GMT'),
(29337, 8, 121081, '1', '8/9788562478772.jpg', '0', 'Sun, 17 Feb 2019 21:27:31 GMT'),
(29338, 8, 121082, '1', '8/9788569980384.jpg', '0', 'Sun, 17 Feb 2019 21:36:03 GMT'),
(29339, 8, 121083, '1', '8/9788562478147.jpg', '0', 'Sun, 17 Feb 2019 21:59:18 GMT'),
(29340, 8, 121084, '1', '8/9788569980308.jpg', '0', 'Sun, 17 Feb 2019 20:29:21 GMT'),
(29341, 8, 121085, '1', '8/9788569980186.jpg', '0', 'Sun, 17 Feb 2019 21:30:51 GMT'),
(29342, 8, 121086, '1', '8/9788569980032.jpg', '0', 'Sun, 17 Feb 2019 21:43:16 GMT'),
(29343, 8, 121087, '1', '8/9788562478628.jpg', '0', 'Sun, 17 Feb 2019 21:18:15 GMT'),
(29344, 8, 121088, '1', '8/9788569980858.jpg', '0', 'Sun, 17 Feb 2019 22:42:50 GMT'),
(29345, 8, 121089, '1', '8/9788562478437.jpg', '0', 'Sun, 17 Feb 2019 21:35:06 GMT'),
(29346, 8, 121090, '1', '8/9788562478994.jpg', '0', 'Sun, 17 Feb 2019 22:09:51 GMT'),
(29347, 8, 121091, '1', '8/9788569980490.jpg', '0', 'Sun, 17 Feb 2019 22:15:08 GMT'),
(29348, 8, 121092, '1', '8/9788562478529.jpg', '0', 'Sun, 17 Feb 2019 21:36:36 GMT'),
(29349, 8, 121093, '1', '8/9788569980711.jpg', '0', 'Sun, 17 Feb 2019 22:37:45 GMT'),
(29350, 8, 121093, '1', '8/semimagem.png', '0', '20/02/2019'),
(29351, 8, 121093, '1', '8/semimagem.png', '0', '20/02/2019'),
(29352, 8, 121096, '1', '8/9788569980520.jpg', '0', 'Sun, 17 Feb 2019 22:22:44 GMT'),
(29353, 8, 121097, '1', '8/9788562478871.jpg', '0', 'Sun, 17 Feb 2019 21:08:08 GMT'),
(29354, 8, 121098, '1', '8/9788569980650.jpg', '0', 'Sun, 17 Feb 2019 22:33:58 GMT'),
(29355, 8, 121098, '1', '8/semimagem.png', '0', '20/02/2019'),
(29356, 8, 121098, '1', '8/semimagem.png', '0', '20/02/2019'),
(29357, 8, 121101, '1', '8/9788569980056.jpg', '0', 'Sun, 17 Feb 2019 21:41:52 GMT'),
(29358, 8, 121102, '1', '8/9788562478581.jpg', '0', 'Sun, 17 Feb 2019 21:28:40 GMT'),
(29359, 8, 121102, '1', '8/semimagem.png', '0', '20/02/2019'),
(29360, 8, 121104, '1', '8/9788562478130.jpg', '0', 'Sat, 16 Feb 2019 23:04:26 GMT'),
(29361, 8, 121105, '1', '8/9788562478703.jpg', '0', 'Sun, 17 Feb 2019 21:35:39 GMT'),
(29362, 8, 121106, '1', '8/9788562478741.jpg', '0', 'Sun, 17 Feb 2019 21:33:11 GMT'),
(29363, 8, 121107, '1', '8/9788562478864.jpg', '0', 'Sun, 17 Feb 2019 21:42:30 GMT'),
(29364, 8, 121108, '1', '8/9788562478789.jpg', '0', 'Sun, 17 Feb 2019 20:54:53 GMT'),
(29365, 8, 121109, '1', '8/9788569980605.jpg', '0', 'Sun, 17 Feb 2019 22:31:49 GMT'),
(29366, 8, 121110, '1', '8/9788569980674.jpg', '0', 'Sun, 17 Feb 2019 22:35:17 GMT'),
(29367, 8, 121111, '1', '8/9788562478826.jpg', '0', 'Sat, 16 Feb 2019 23:47:16 GMT'),
(29368, 8, 121112, '1', '8/9788569980063.jpg', '0', 'Sun, 17 Feb 2019 21:31:21 GMT'),
(29369, 8, 121007, '1', '8/semimagem.png', '0', '2019-02-26'),
(29370, 8, 121015, '1', '8/semimagem.png', '0', '2019-02-26'),
(29371, 8, 121037, '1', '8/semimagem.png', '0', '2019-02-27'),
(29372, 8, 121043, '1', '8/semimagem.png', '0', '2019-02-26'),
(29373, 8, 121113, '1', '8/9788562478642.jpg', '0', 'Sat, 16 Feb 2019 22:56:15 GMT'),
(29374, 8, 121078, '1', '8/semimagem.png', '0', '2019-02-26'),
(29375, 8, 121114, '1', '8/9788569980629.jpg', '0', 'Sun, 17 Feb 2019 22:32:44 GMT'),
(29376, 8, 121090, '1', '8/semimagem.png', '0', '26/02/2019'),
(29377, 8, 121094, '1', '8/semimagem.png', '0', '2019-02-26'),
(29378, 8, 121100, '1', '8/semimagem.png', '0', '2019-02-26'),
(29379, 8, 121116, '1', '8/9788562478925.jpg', '0', 'Sun, 17 Feb 2019 22:09:08 GMT'),
(29380, 8, 121103, '1', '8/semimagem.png', '0', '2019-02-26'),
(29381, 8, 121117, '1', '8/9788562478727.jpg', '0', 'Sun, 17 Feb 2019 22:05:13 GMT');

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_logs_change`
--

CREATE TABLE IF NOT EXISTS `p_logs_change` (
  `id_log` int(10) unsigned NOT NULL,
  `type` tinyint(2) DEFAULT NULL,
  `old_value` varchar(45) DEFAULT NULL,
  `new_value` varchar(45) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `id_loja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_precos`
--

CREATE TABLE IF NOT EXISTS `p_precos` (
  `id_preco` int(10) unsigned NOT NULL,
  `id_loja` varchar(45) DEFAULT NULL,
  `id_produto` varchar(45) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `deleted` enum('1','0') DEFAULT '0',
  `id_item_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23310 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `p_precos`
--

INSERT INTO `p_precos` (`id_preco`, `id_loja`, `id_produto`, `data`, `valor`, `deleted`, `id_item_externo`, `data_atualizacao`) VALUES
(23166, '8', '120972', '2019-02-20 18:44:54', '39.90', '0', 2, '2018-12-06T15:43:41.573-02:00'),
(23167, '8', '120969', '2019-02-20 18:44:54', '33.90', '0', 20, '2018-12-10T16:53:37.62-02:00'),
(23168, '8', '120970', '2019-02-20 18:44:54', '54.90', '0', 92, '2018-12-12T16:16:48.847-02:00'),
(23169, '8', '120971', '2019-02-20 18:44:54', '39.90', '0', 96, '2018-12-12T16:51:24.843-02:00'),
(23170, '8', '120990', '2019-02-20 18:57:25', '24.90', '0', 1, '2018-12-06T15:36:57.44-02:00'),
(23171, '8', '120973', '2019-02-20 18:57:25', '42.90', '0', 3, '2018-12-06T15:48:35.493-02:00'),
(23172, '8', '121043', '2019-02-20 18:57:25', '36.90', '0', 4, '2018-12-10T15:09:23.52-02:00'),
(23173, '8', '121009', '2019-02-20 18:57:25', '34.90', '0', 5, '2018-12-10T15:43:59.487-02:00'),
(23174, '8', '121010', '2019-02-20 18:57:25', '29.90', '0', 7, '2018-12-10T15:45:26.13-02:00'),
(23175, '8', '121034', '2019-02-20 18:57:25', '44.90', '0', 8, '2018-12-10T15:46:02.227-02:00'),
(23176, '8', '121015', '2019-02-20 18:57:25', '35.90', '0', 9, '2018-12-10T15:43:10.56-02:00'),
(23177, '8', '121040', '2019-02-20 18:57:25', '42.90', '0', 10, '2018-12-10T15:53:29.5-02:00'),
(23178, '8', '121104', '2019-02-20 18:57:25', '22.90', '0', 11, '2018-12-10T16:00:33.29-02:00'),
(23179, '8', '121068', '2019-02-20 18:57:25', '15.00', '0', 12, '2018-12-10T16:06:08.937-02:00'),
(23180, '8', '121007', '2019-02-20 18:57:25', '64.90', '0', 13, '2018-12-10T16:10:36.04-02:00'),
(23181, '8', '120991', '2019-02-20 18:57:25', '31.90', '0', 14, '2018-12-10T16:20:07.08-02:00'),
(23182, '8', '121110', '2019-02-20 18:57:25', '48.50', '0', 15, '2018-12-10T16:25:59.253-02:00'),
(23183, '8', '121111', '2019-02-20 18:57:25', '44.90', '0', 16, '2018-12-10T16:31:09.78-02:00'),
(23184, '8', '121013', '2019-02-20 18:57:25', '39.90', '0', 17, '2018-12-10T16:37:10.523-02:00'),
(23185, '8', '120992', '2019-02-20 18:57:25', '28.90', '0', 18, '2018-12-10T16:41:33.31-02:00'),
(23186, '8', '120994', '2019-02-20 18:57:25', '44.90', '0', 19, '2018-12-10T16:45:13.647-02:00'),
(23187, '8', '121090', '2019-02-20 18:57:25', '67.90', '0', 21, '2018-12-10T16:58:40.823-02:00'),
(23188, '8', '121074', '2019-02-20 18:57:25', '45.90', '0', 22, '2018-12-10T17:05:34.993-02:00'),
(23189, '8', '121004', '2019-02-20 18:57:25', '84.90', '0', 23, '2018-12-10T17:11:04.863-02:00'),
(23190, '8', '121030', '2019-02-20 18:57:25', '65.90', '0', 24, '2018-12-10T17:17:07.57-02:00'),
(23191, '8', '121002', '2019-02-20 18:57:25', '75.90', '0', 25, '2018-12-10T17:22:30.52-02:00'),
(23192, '8', '121003', '2019-02-20 18:57:25', '159.90', '0', 26, '2018-12-10T17:28:20.257-02:00'),
(23193, '8', '120975', '2019-02-20 18:57:25', '47.90', '0', 27, '2018-12-10T17:34:11.823-02:00'),
(23194, '8', '121026', '2019-02-20 18:57:25', '39.90', '0', 28, '2018-12-10T17:39:15.687-02:00'),
(23195, '8', '121053', '2019-02-20 18:57:25', '53.90', '0', 29, '2018-12-10T17:46:06.317-02:00'),
(23196, '8', '121063', '2019-02-20 18:57:25', '45.90', '0', 30, '2018-12-10T18:02:54.36-02:00'),
(23197, '8', '121038', '2019-02-20 18:57:25', '36.90', '0', 31, '2018-12-10T18:08:34.263-02:00'),
(23198, '8', '121103', '2019-02-20 18:57:25', '59.90', '0', 32, '2018-12-10T18:14:40.24-02:00'),
(23199, '8', '121056', '2019-02-20 18:57:25', '29.90', '0', 33, '2018-12-10T18:21:19.78-02:00'),
(23200, '8', '121055', '2019-02-20 18:57:25', '46.90', '0', 34, '2018-12-10T18:25:06.493-02:00'),
(23201, '8', '121066', '2019-02-20 18:57:25', '18.90', '0', 35, '2018-12-10T18:29:40.68-02:00'),
(23202, '8', '121058', '2019-02-20 18:57:25', '26.90', '0', 36, '2018-12-10T18:36:10.917-02:00'),
(23203, '8', '121084', '2019-02-20 18:57:25', '44.90', '0', 37, '2018-12-10T18:42:53.5-02:00'),
(23204, '8', '121005', '2019-02-20 18:57:25', '49.90', '0', 38, '2018-12-10T18:47:19.457-02:00'),
(23205, '8', '121011', '2019-02-20 18:57:25', '52.90', '0', 39, '2019-01-22T10:38:58.23-02:00'),
(23206, '8', '120982', '2019-02-20 18:57:25', '29.90', '0', 40, '2018-12-10T18:56:47.747-02:00'),
(23207, '8', '121031', '2019-02-20 18:57:25', '46.90', '0', 41, '2018-12-12T10:58:37.213-02:00'),
(23208, '8', '121014', '2019-02-20 18:57:25', '19.90', '0', 42, '2018-12-12T11:05:16.787-02:00'),
(23209, '8', '121052', '2019-02-20 18:57:25', '19.90', '0', 43, '2018-12-12T11:09:12.593-02:00'),
(23210, '8', '120976', '2019-02-20 18:57:25', '29.90', '0', 44, '2018-12-12T11:12:59.35-02:00'),
(23211, '8', '121008', '2019-02-20 18:57:25', '29.90', '0', 45, '2018-12-12T11:15:29.603-02:00'),
(23212, '8', '121037', '2019-02-20 18:57:25', '42.90', '0', 46, '2018-12-12T11:20:05.573-02:00'),
(23213, '8', '121059', '2019-02-20 18:57:25', '34.90', '0', 47, '2018-12-12T11:24:23.27-02:00'),
(23214, '8', '121024', '2019-02-20 18:57:25', '22.50', '0', 48, '2018-12-12T11:33:15.117-02:00'),
(23215, '8', '121017', '2019-02-20 18:57:25', '39.90', '0', 49, '2018-12-12T11:37:25.877-02:00'),
(23216, '8', '121047', '2019-02-20 18:57:25', '29.90', '0', 50, '2018-12-12T11:41:39.733-02:00'),
(23217, '8', '121071', '2019-02-20 18:57:25', '24.90', '0', 51, '2018-12-12T11:45:03.797-02:00'),
(23218, '8', '121036', '2019-02-20 18:57:25', '59.90', '0', 52, '2018-12-12T11:49:46.003-02:00'),
(23219, '8', '121062', '2019-02-20 18:57:25', '59.90', '0', 53, '2018-12-12T11:53:03.173-02:00'),
(23220, '8', '120974', '2019-02-20 18:57:25', '35.00', '0', 54, '2018-12-12T11:57:04.38-02:00'),
(23221, '8', '121054', '2019-02-20 18:57:25', '48.90', '0', 55, '2018-12-12T12:07:14.857-02:00'),
(23222, '8', '121109', '2019-02-20 18:57:25', '32.90', '0', 56, '2018-12-12T12:11:32.567-02:00'),
(23223, '8', '120989', '2019-02-20 18:57:25', '54.90', '0', 57, '2018-12-12T12:15:51.577-02:00'),
(23224, '8', '120997', '2019-02-20 18:57:25', '38.90', '0', 58, '2018-12-12T12:21:33.533-02:00'),
(23225, '8', '121048', '2019-02-20 18:57:25', '59.90', '0', 59, '2018-12-12T12:25:32.29-02:00'),
(23226, '8', '121079', '2019-02-20 18:57:25', '54.90', '0', 61, '2018-12-12T12:33:47.003-02:00'),
(23227, '8', '121072', '2019-02-20 18:57:25', '54.90', '0', 62, '2018-12-12T12:38:38.65-02:00'),
(23228, '8', '121012', '2019-02-20 18:57:25', '49.90', '0', 63, '2018-12-12T12:42:11.66-02:00'),
(23229, '8', '121098', '2019-02-20 18:57:25', '36.90', '0', 64, '2018-12-12T12:44:52.46-02:00'),
(23230, '8', '121108', '2019-02-20 18:57:25', '49.90', '0', 65, '2018-12-12T12:48:26.693-02:00'),
(23231, '8', '121025', '2019-02-20 18:57:25', '29.90', '0', 66, '2018-12-12T12:51:43.797-02:00'),
(23232, '8', '121018', '2019-02-20 18:57:25', '28.90', '0', 68, '2018-12-12T12:59:18.57-02:00'),
(23233, '8', '121001', '2019-02-20 18:57:25', '48.90', '0', 69, '2018-12-12T13:02:42.66-02:00'),
(23234, '8', '120984', '2019-02-20 18:57:25', '58.90', '0', 70, '2018-12-12T13:05:55.6-02:00'),
(23235, '8', '121069', '2019-02-20 18:57:25', '49.90', '0', 71, '2018-12-12T13:09:49.927-02:00'),
(23236, '8', '120996', '2019-02-20 18:57:25', '65.90', '0', 72, '2018-12-12T13:14:41.937-02:00'),
(23237, '8', '121061', '2019-02-20 18:57:25', '58.90', '0', 73, '2018-12-12T13:19:08.507-02:00'),
(23238, '8', '121033', '2019-02-20 18:57:25', '54.90', '0', 75, '2018-12-12T13:30:57.533-02:00'),
(23239, '8', '120993', '2019-02-20 18:57:25', '41.90', '0', 76, '2018-12-12T13:34:22.22-02:00'),
(23240, '8', '120987', '2019-02-20 18:57:25', '54.90', '0', 77, '2018-12-12T13:38:17.69-02:00'),
(23241, '8', '121080', '2019-02-20 18:57:25', '54.90', '0', 78, '2018-12-12T13:42:13.203-02:00'),
(23242, '8', '121028', '2019-02-20 18:57:25', '66.90', '0', 79, '2018-12-12T13:48:45.75-02:00'),
(23243, '8', '121039', '2019-02-20 18:57:25', '32.90', '0', 80, '2018-12-12T15:23:17.52-02:00'),
(23244, '8', '120998', '2019-02-20 18:57:25', '38.90', '0', 81, '2018-12-12T15:27:12.74-02:00'),
(23245, '8', '121042', '2019-02-20 18:57:25', '48.90', '0', 82, '2018-12-12T15:32:00.81-02:00'),
(23246, '8', '121019', '2019-02-20 18:57:25', '49.90', '0', 83, '2018-12-12T15:35:46.073-02:00'),
(23247, '8', '121075', '2019-02-20 18:57:25', '36.90', '0', 84, '2018-12-12T15:41:02.75-02:00'),
(23248, '8', '121050', '2019-02-20 18:57:25', '29.90', '0', 85, '2018-12-12T15:44:50.623-02:00'),
(23249, '8', '121096', '2019-02-20 18:57:25', '49.90', '0', 86, '2018-12-12T15:48:52.347-02:00'),
(23250, '8', '120977', '2019-02-20 18:57:25', '36.90', '0', 88, '2018-12-12T15:57:45.323-02:00'),
(23251, '8', '121070', '2019-02-20 18:57:25', '44.90', '0', 89, '2018-12-12T16:02:22.58-02:00'),
(23252, '8', '121097', '2019-02-20 18:57:25', '67.90', '0', 90, '2018-12-12T16:07:08.77-02:00'),
(23253, '8', '120980', '2019-02-20 18:57:25', '24.90', '0', 91, '2018-12-12T16:11:02.77-02:00'),
(23254, '8', '121060', '2019-02-20 18:57:25', '59.90', '0', 93, '2018-12-12T16:22:04.283-02:00'),
(23255, '8', '121035', '2019-02-20 18:57:25', '59.90', '0', 94, '2018-12-12T16:26:34.87-02:00'),
(23256, '8', '121032', '2019-02-20 18:57:25', '47.90', '0', 95, '2018-12-12T16:48:32.713-02:00'),
(23257, '8', '121067', '2019-02-20 18:57:25', '27.90', '0', 97, '2018-12-12T16:57:13.247-02:00'),
(23258, '8', '121088', '2019-02-20 18:57:25', '24.90', '0', 98, '2018-12-12T17:03:37.033-02:00'),
(23259, '8', '121057', '2019-02-20 18:57:25', '34.90', '0', 99, '2018-12-12T17:06:39.083-02:00'),
(23260, '8', '121064', '2019-02-20 18:57:25', '59.90', '0', 100, '2018-12-12T17:10:49.967-02:00'),
(23261, '8', '121087', '2019-02-20 18:57:25', '32.90', '0', 101, '2018-12-12T17:15:41.06-02:00'),
(23262, '8', '121006', '2019-02-20 18:57:25', '26.90', '0', 102, '2018-12-12T17:20:50.797-02:00'),
(23263, '8', '121020', '2019-02-20 18:57:25', '36.90', '0', 103, '2018-12-12T17:24:40.497-02:00'),
(23264, '8', '121021', '2019-02-20 18:57:25', '36.90', '0', 104, '2018-12-12T17:28:28.863-02:00'),
(23265, '8', '121022', '2019-02-20 18:57:25', '36.90', '0', 105, '2018-12-12T17:31:48.12-02:00'),
(23266, '8', '120979', '2019-02-20 18:57:25', '28.90', '0', 106, '2018-12-12T17:35:28.553-02:00'),
(23267, '8', '121000', '2019-02-20 18:57:25', '44.90', '0', 107, '2018-12-12T17:39:42.983-02:00'),
(23268, '8', '121027', '2019-02-20 18:57:25', '53.90', '0', 108, '2018-12-12T17:43:48.52-02:00'),
(23269, '8', '121044', '2019-02-20 18:57:25', '66.90', '0', 109, '2018-12-12T17:48:54.343-02:00'),
(23270, '8', '121091', '2019-02-20 18:57:25', '67.90', '0', 110, '2018-12-12T17:54:06.99-02:00'),
(23271, '8', '120983', '2019-02-20 18:57:25', '49.90', '0', 111, '2018-12-12T18:01:30.403-02:00'),
(23272, '8', '120985', '2019-02-20 18:57:25', '64.90', '0', 112, '2018-12-12T18:07:49.893-02:00'),
(23273, '8', '121041', '2019-02-20 18:57:25', '44.90', '0', 113, '2018-12-12T18:15:54.04-02:00'),
(23274, '8', '121093', '2019-02-20 18:57:25', '49.90', '0', 114, '2018-12-12T18:26:51.557-02:00'),
(23275, '8', '121076', '2019-02-20 18:57:25', '68.90', '0', 115, '2018-12-12T18:32:36.18-02:00'),
(23276, '8', '121081', '2019-02-20 18:57:25', '54.90', '0', 116, '2018-12-12T18:47:23.453-02:00'),
(23277, '8', '120995', '2019-02-20 18:57:25', '37.90', '0', 117, '2018-12-12T18:53:11.17-02:00'),
(23278, '8', '121102', '2019-02-20 18:57:25', '37.90', '0', 118, '2018-12-12T19:04:26.523-02:00'),
(23279, '8', '120978', '2019-02-20 18:57:25', '36.90', '0', 119, '2018-12-12T19:09:14.507-02:00'),
(23280, '8', '121073', '2019-02-20 18:57:25', '39.90', '0', 120, '2018-12-14T13:08:22.2-02:00'),
(23281, '8', '120999', '2019-02-20 18:57:25', '64.90', '0', 121, '2018-12-14T13:12:27.45-02:00'),
(23282, '8', '121085', '2019-02-20 18:57:25', '22.90', '0', 122, '2018-12-14T13:15:58.877-02:00'),
(23283, '8', '121112', '2019-02-20 18:57:25', '44.90', '0', 123, '2018-12-14T13:19:24.25-02:00'),
(23284, '8', '121029', '2019-02-20 18:57:25', '75.00', '0', 124, '2018-12-14T13:25:21.113-02:00'),
(23285, '8', '121106', '2019-02-20 18:57:25', '51.90', '0', 125, '2018-12-14T13:36:33.93-02:00'),
(23286, '8', '121023', '2019-02-20 18:57:25', '32.90', '0', 126, '2018-12-14T13:40:10.107-02:00'),
(23287, '8', '120988', '2019-02-20 18:57:25', '57.90', '0', 127, '2018-12-14T13:44:33.45-02:00'),
(23288, '8', '120986', '2019-02-20 18:57:25', '84.90', '0', 128, '2018-12-14T13:48:31.29-02:00'),
(23289, '8', '121089', '2019-02-20 18:57:25', '46.90', '0', 129, '2018-12-14T14:00:55.687-02:00'),
(23290, '8', '121105', '2019-02-20 18:57:25', '59.90', '0', 130, '2018-12-14T14:04:52.92-02:00'),
(23291, '8', '121082', '2019-02-20 18:57:25', '59.90', '0', 131, '2018-12-14T14:07:46.26-02:00'),
(23292, '8', '121092', '2019-02-20 18:57:25', '44.90', '0', 132, '2018-12-14T14:13:54.83-02:00'),
(23293, '8', '121078', '2019-02-20 18:57:25', '46.90', '0', 133, '2018-12-14T14:18:41.56-02:00'),
(23294, '8', '121016', '2019-02-20 18:57:25', '25.90', '0', 134, '2018-12-14T14:24:26.053-02:00'),
(23295, '8', '121046', '2019-02-20 18:57:25', '39.90', '0', 135, '2018-12-14T14:42:31.75-02:00'),
(23296, '8', '121051', '2019-02-20 18:57:25', '36.90', '0', 138, '2018-12-19T14:40:57.943-02:00'),
(23297, '8', '121065', '2019-02-20 18:57:25', '42.90', '0', 139, '2018-12-19T14:46:35.287-02:00'),
(23298, '8', '121083', '2019-02-20 18:57:25', '39.50', '0', 140, '2018-12-19T15:08:55.357-02:00'),
(23299, '8', '121101', '2019-02-20 18:57:25', '43.50', '0', 141, '2018-12-19T14:55:23.863-02:00'),
(23300, '8', '121107', '2019-02-20 18:57:25', '31.90', '0', 142, '2018-12-19T14:59:06.23-02:00'),
(23301, '8', '121086', '2019-02-20 18:57:25', '28.90', '0', 143, '2018-12-19T15:31:38.81-02:00'),
(23302, '8', '121049', '2019-02-20 18:57:25', '48.90', '0', 144, '2018-12-20T13:57:45.027-02:00'),
(23303, '8', '121100', '2019-02-20 18:57:25', '69.90', '0', 145, '2019-01-08T18:16:49.693-02:00'),
(23304, '8', '121077', '2019-02-20 18:57:25', '25.90', '0', 146, '2019-01-11T09:43:28.277-02:00'),
(23305, '8', '121045', '2019-02-20 18:57:25', '39.90', '0', 147, '2019-01-17T17:48:35.9-02:00'),
(23306, '8', '121099', '2019-02-20 18:57:26', '26.90', '0', 149, '2019-01-17T17:54:39.58-02:00'),
(23307, '8', '120981', '2019-02-20 18:57:26', '23.90', '0', 150, '2019-01-21T15:16:20.533-02:00'),
(23308, '8', '121095', '2019-02-20 18:57:26', '25.90', '0', 151, '2019-01-21T15:17:17.117-02:00'),
(23309, '8', '121094', '2019-02-20 18:57:26', '42.90', '0', 153, '2019-02-04T16:39:40.353-02:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_produtos`
--

CREATE TABLE IF NOT EXISTS `p_produtos` (
  `p_id` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `sub_titulo` varchar(200) DEFAULT NULL,
  `mini_desc` text,
  `full_desc` text,
  `unidades` int(11) unsigned NOT NULL,
  `dat_ult_atl_saldo` varchar(150) DEFAULT NULL,
  `estoq_min` int(11) unsigned NOT NULL,
  `id_cat` int(11) unsigned NOT NULL,
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `added_cart` int(11) unsigned NOT NULL DEFAULT '0',
  `was_purchased` int(11) unsigned NOT NULL DEFAULT '0',
  `ativo` enum('0','1') NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `id_autor` int(10) unsigned DEFAULT NULL,
  `id_editora` int(10) unsigned DEFAULT NULL,
  `lanc_data` date DEFAULT NULL,
  `edicao` tinyint(3) unsigned DEFAULT NULL,
  `paginas` varchar(20) DEFAULT NULL,
  `tags` text,
  `dimensoes` varchar(100) DEFAULT NULL,
  `id_tipo_capa` int(11) DEFAULT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `idioma` varchar(50) DEFAULT NULL,
  `deleted` enum('0','1') DEFAULT '0',
  `id_tipo_produto` int(11) NOT NULL,
  `localizacao` varchar(20) DEFAULT NULL,
  `id_item_externo` int(10) NOT NULL,
  `situacao_item` varchar(10) NOT NULL,
  `data_atualizacao` varchar(50) NOT NULL,
  `id_categoria_externo` int(10) NOT NULL,
  `id_autor_externo` int(10) DEFAULT NULL,
  `id_editora_externo` int(10) NOT NULL,
  `id_tipo_produto_externo` int(10) NOT NULL,
  `id_tipo_autor_externo` int(10) DEFAULT NULL,
  `skyhub` enum('1','0') DEFAULT NULL,
  `data_envio_skyhub` datetime DEFAULT NULL,
  `data_atualizacao_skyhub` datetime DEFAULT NULL,
  `id_selo_externo` int(10) DEFAULT NULL,
  `id_grupo_externo` int(11) DEFAULT NULL,
  `status_item_erp` varchar(10) DEFAULT NULL,
  `qtd_venda_pre` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=121118 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `p_produtos`
--

INSERT INTO `p_produtos` (`p_id`, `id_loja`, `titulo`, `sub_titulo`, `mini_desc`, `full_desc`, `unidades`, `dat_ult_atl_saldo`, `estoq_min`, `id_cat`, `views`, `added_cart`, `was_purchased`, `ativo`, `isbn`, `id_autor`, `id_editora`, `lanc_data`, `edicao`, `paginas`, `tags`, `dimensoes`, `id_tipo_capa`, `peso`, `idioma`, `deleted`, `id_tipo_produto`, `localizacao`, `id_item_externo`, `situacao_item`, `data_atualizacao`, `id_categoria_externo`, `id_autor_externo`, `id_editora_externo`, `id_tipo_produto_externo`, `id_tipo_autor_externo`, `skyhub`, `data_envio_skyhub`, `data_atualizacao_skyhub`, `id_selo_externo`, `id_grupo_externo`, `status_item_erp`, `qtd_venda_pre`) VALUES
(120969, 8, 'A ARTE DE PROFETIZAR', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2035, 0, 0, 0, '1', '9788569980599', 12924, 1446, NULL, NULL, '0', NULL, '0.00x14.00x21.00', NULL, '157.00', NULL, '0', 783, NULL, 20, 'IN', '2019-02-27T08:16:40.837-03:00', 37, 17, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(120970, 8, 'A BATALHA PERTENCE AO SENHOR', NULL, NULL, NULL, 320, '2019-02-19T10:18:16.053-03:00', 0, 2014, 0, 0, 0, '1', '9788562478758', 12888, 1446, NULL, NULL, '224', NULL, '0.00x0.00x0.00', NULL, '258.00', NULL, '0', 783, NULL, 92, 'IN', '2019-02-19T10:18:15.863-03:00', 5, 58, 2, 1, NULL, NULL, NULL, NULL, 1, 6, 'D', NULL),
(120971, 8, 'A BUSCA DA SANTIDADE', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2036, 0, 0, 0, '1', '9788562478697', 12878, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '240.00', NULL, '0', 783, NULL, 96, 'IN', '2019-02-25T11:55:26.187-03:00', 3, 60, 2, 1, NULL, NULL, NULL, NULL, 1, 7, '0', NULL),
(120972, 8, 'Alegria no Limite das forças', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2024, 0, 0, 0, '1', '9788562478390', 12851, 1446, NULL, NULL, '128', NULL, '21.00x0.01x14.00', NULL, '158.00', NULL, '0', 783, NULL, 2, 'IN', '2019-02-25T14:13:50.263-03:00', 31, 3, 2, 1, NULL, NULL, NULL, NULL, 0, 2, '0', NULL),
(120973, 8, '25 Estudos Bíblicos Básicos', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2017, 0, 0, 0, '1', '9788569980018', 12858, 1446, NULL, NULL, '172', NULL, '21.00x0.01x14.00', NULL, '204.00', NULL, '0', 783, NULL, 3, 'IN', '2019-02-25T14:13:50.263-03:00', 4, 4, 2, 1, NULL, NULL, NULL, NULL, 0, 2, '0', NULL),
(120974, 8, 'A CERTEZA DA FÉ', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2033, 0, 0, 0, '1', '9788569980803', 12867, 1446, NULL, NULL, '124', NULL, '0.00x0.00x0.00', NULL, '195.00', NULL, '0', 783, NULL, 54, 'IN', '2019-02-25T14:13:50.323-03:00', 6, 39, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(120975, 8, 'A CHAMA INEXTINGUÍVEL', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2029, 0, 0, 0, '1', '9788569980179', 12896, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '311.00', NULL, '0', 783, NULL, 27, 'IN', '2019-02-25T14:13:50.287-03:00', 33, 10, 2, 1, NULL, NULL, NULL, NULL, 1, 11, '0', NULL),
(120976, 8, 'A COROA DO SEU MARIDO', NULL, NULL, NULL, 277, '2019-02-15T14:53:44.59-02:00', 0, 2027, 0, 0, 0, '1', '9788562478970', 12912, 1446, NULL, NULL, '80', NULL, '0.00x0.00x0.00', NULL, '110.00', NULL, '0', 783, NULL, 44, 'IN', '2019-02-17T17:32:57.913-03:00', 19, 34, 2, 1, NULL, NULL, NULL, NULL, 1, 14, 'D', NULL),
(120977, 8, 'A COSMOVISÃO SEXUAL CRISTÃ', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2032, 0, 0, 0, '1', '9788569980292', 12899, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '163.00', NULL, '0', 783, NULL, 88, 'IN', '2019-02-25T14:13:50.367-03:00', 36, 8, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(120978, 8, 'A DESGRAÇA DO ATEÍSMO NA ECONOMIA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2021, 0, 0, 0, '1', '9788569980513', 12899, 1446, NULL, NULL, '123', NULL, '0.00x0.00x0.00', NULL, '200.00', NULL, '0', 783, NULL, 119, 'IN', '2019-02-25T14:13:50.407-03:00', 27, 8, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(120979, 8, 'A FILOSOFIA CRISTÃ DA ALIMENTAÇÃO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2028, 0, 0, 0, '1', '9788562478819', 12900, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '144.00', NULL, '0', 783, NULL, 106, 'IN', '2019-02-27T10:11:59.88-03:00', 10, 65, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(120980, 8, 'A GRANDE DESCOMISSÃO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2026, 0, 0, 0, '1', '9788562478383', 12913, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '92.00', NULL, '0', 783, NULL, 91, 'IN', '2019-02-25T14:13:50.37-03:00', 24, 2, 2, 1, NULL, NULL, NULL, NULL, 1, 15, '0', NULL),
(120981, 8, 'A Luz de Nossas Mentes', NULL, NULL, NULL, 0, '2019-01-23T02:18:36.957-02:00', 0, 2014, 0, 0, 0, '1', '9788562478161', 12918, 1446, NULL, NULL, '0', NULL, '0.00x15.00x21.00', NULL, '0.00', NULL, '0', 783, NULL, 150, 'IN', '2019-02-17T18:53:03.7-03:00', 5, 84, 2, 1, NULL, NULL, NULL, NULL, 1, 6, 'D', NULL),
(120982, 8, 'A MEDICINA PÓS-HIPOCRÁTICA', NULL, NULL, NULL, 486, '2019-02-15T15:18:43.897-02:00', 0, 2025, 0, 0, 0, '1', '9788569980261', 12871, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '78.00', NULL, '0', 783, NULL, 40, 'IN', '2019-02-15T10:18:21.26-02:00', 32, 33, 2, 1, NULL, NULL, NULL, NULL, 1, 10, 'D', NULL),
(120983, 8, 'A MONTANHA DO SINO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2015, 0, 0, 0, '1', '9788595930018', 12892, 1446, NULL, NULL, '232', NULL, '0.00x0.00x0.00', NULL, '376.00', NULL, '0', 783, NULL, 111, 'IN', '2019-02-22T08:32:22.947-03:00', 28, 69, 2, 1, NULL, NULL, NULL, NULL, 1, 16, '0', NULL),
(120984, 8, 'A POLÍTICA DA PORNOGRAFIA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2032, 0, 0, 0, '1', '9788569980582', 12904, 1446, NULL, NULL, '247', NULL, '0.00x0.00x0.00', NULL, '363.00', NULL, '0', 783, NULL, 70, 'IN', '2019-02-25T14:13:50.35-03:00', 36, 5, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(120985, 8, 'A PROVA DEFINITIVA DA CRIAÇÃO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2014, 0, 0, 0, '1', '9788562478598', 12874, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '380.00', NULL, '0', 783, NULL, 112, 'IN', '2019-02-27T10:41:21.007-03:00', 5, 70, 2, 1, NULL, NULL, NULL, NULL, 1, 6, '0', NULL),
(120986, 8, 'A SISTEMÁTICA DA VIDA', NULL, NULL, NULL, 0, NULL, 0, 2033, 0, 0, 0, '1', '9788569980049', 12849, 1446, NULL, NULL, '512', NULL, '0.00x0.00x0.00', NULL, '680.00', NULL, '0', 783, NULL, 128, 'IN', '2019-02-20T15:32:35.04-03:00', 6, 49, 2, 1, NULL, NULL, NULL, NULL, 1, 2, 'D', NULL),
(120987, 8, 'A TRADIÇÃO DA MEDICINA', NULL, NULL, NULL, 408, '2019-02-15T14:56:25.453-02:00', 0, 2025, 0, 0, 0, '1', '9788569885047', 12866, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '254.00', NULL, '0', 783, NULL, 77, 'IN', '2019-02-15T10:18:21.26-02:00', 32, 50, 2, 1, NULL, NULL, NULL, NULL, 1, 10, 'D', NULL),
(120988, 8, 'A TUA PALAVRA É A VERDADE', NULL, NULL, NULL, 394, '2019-02-15T14:56:37.95-02:00', 0, 2024, 0, 0, 0, '1', '9788562478444', 12870, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '288.00', NULL, '0', 783, NULL, 127, 'IN', '2019-02-15T10:18:21.26-02:00', 31, 67, 2, 1, NULL, NULL, NULL, NULL, 1, 2, 'D', NULL),
(120989, 8, 'ADOÇÃO', NULL, NULL, NULL, 0, NULL, 0, 2027, 0, 0, 0, '1', '9788562478673', 12910, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '386.00', NULL, '0', 783, NULL, 57, 'IN', '2019-02-18T15:53:59.413-03:00', 19, 1, 2, 1, NULL, NULL, NULL, NULL, 1, 14, 'D', NULL),
(120990, 8, 'Adoração a Baal ', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2021, 0, 0, 0, '1', '9788569980131', 12913, 1446, NULL, NULL, '60', NULL, '0.21x0.00x0.14', NULL, '91.00', NULL, '0', 783, NULL, 1, 'IN', '2019-02-25T14:13:50.26-03:00', 27, 2, 2, 1, NULL, NULL, NULL, NULL, 0, 1, '0', NULL),
(120991, 8, 'ADORAÇÃO REFORMADA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2035, 0, 0, 0, '1', '9788562478895', 12915, 1446, NULL, NULL, '110', NULL, '0.00x0.00x0.00', NULL, '145.00', NULL, '0', 783, NULL, 14, 'IN', '2019-02-25T14:13:50.273-03:00', 37, 12, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(120992, 8, 'AMNÉSIA CULTURAL', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2020, 0, 0, 0, '1', '9788569980728', 12842, 1446, NULL, NULL, '72', NULL, '0.00x0.00x0.00', NULL, '101.00', NULL, '0', 783, NULL, 18, 'IN', '2019-02-25T11:55:26.187-03:00', 2, 15, 2, 1, NULL, NULL, NULL, NULL, 1, 5, '0', NULL),
(120993, 8, 'ARTE MÉDICA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 568, '2019-02-15T14:58:37.917-02:00', 0, 2025, 0, 0, 0, '1', '9788569885054', 12866, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '220.00', NULL, '0', 783, NULL, 76, 'IN', '2019-02-26T09:16:36.783-03:00', 32, 50, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(120994, 8, 'AS AGRIDOCES CADEIA DA GRAÇA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2024, 0, 0, 0, '1', '9788562478963', 12923, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '236.00', NULL, '0', 783, NULL, 19, 'IN', '2019-02-25T11:55:26.187-03:00', 31, 16, 2, 1, NULL, NULL, NULL, NULL, 1, 7, '0', NULL),
(120995, 8, 'AS BOAS NOVAS EM RUTE', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2024, 0, 0, 0, '1', '9788569980568', 12856, 1446, NULL, NULL, '175', NULL, '0.00x0.00x0.00', NULL, '200.00', NULL, '0', 783, NULL, 117, 'IN', '2019-02-25T11:55:26.187-03:00', 31, 52, 2, 1, NULL, NULL, NULL, NULL, 1, 7, '0', NULL),
(120996, 8, 'AS COISAS DA TERRA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2034, 0, 0, 0, '1', '9788569980339', 12881, 1446, NULL, NULL, '288', NULL, '0.00x0.00x0.00', NULL, '395.00', NULL, '0', 783, NULL, 72, 'IN', '2019-02-25T14:13:50.357-03:00', 20, 47, 2, 1, NULL, NULL, NULL, NULL, 1, 7, '0', NULL),
(120997, 8, 'CALVINO, GENEBRA', NULL, NULL, NULL, 0, NULL, 0, 2029, 0, 0, 0, '1', '9788569980391', 12876, 1446, NULL, NULL, '145', NULL, '0.00x0.00x0.00', NULL, '185.00', NULL, '0', 783, NULL, 58, 'IN', '2019-02-20T16:17:23.843-03:00', 33, 30, 2, 1, NULL, NULL, NULL, NULL, 1, 11, 'D', NULL),
(120998, 8, 'CARTAS A UM JOVEM CALVINISTA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2033, 0, 0, 0, '1', '9788562478918', 12872, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '223.00', NULL, '0', 783, NULL, 81, 'IN', '2019-02-25T14:13:50.36-03:00', 6, 53, 2, 1, NULL, NULL, NULL, NULL, 1, 8, '0', NULL),
(120999, 8, 'COM LIBERDADE E JUSTIÇA PARA TODOS', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2021, 0, 0, 0, '1', '9788569980148', 12880, 1446, NULL, NULL, '274', NULL, '0.00x0.00x0.00', NULL, '313.00', NULL, '0', 783, NULL, 121, 'IN', '2019-02-25T14:13:50.41-03:00', 27, 74, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121000, 8, 'CONFIRMAÇÃO DE NOSSA FÉ', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2035, 0, 0, 0, '1', '9788562478505', 12889, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '210.00', NULL, '0', 783, NULL, 107, 'IN', '2019-02-25T14:13:50.39-03:00', 37, 66, 2, 1, NULL, NULL, NULL, NULL, 1, 11, '0', NULL),
(121001, 8, 'CONHECIMENTO E CRENÇA CRISTÃ', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2028, 0, 0, 0, '1', '9788569885023', 12841, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '258.00', NULL, '0', 783, NULL, 69, 'IN', '2019-02-25T14:13:50.347-03:00', 10, 46, 2, 1, NULL, NULL, NULL, NULL, 1, 4, '0', NULL),
(121002, 8, 'CONVERSAS À MESA DE LUTERO', NULL, NULL, NULL, 0, NULL, 0, 2031, 0, 0, 0, '1', '9788569980353', 12895, 1446, NULL, NULL, '480', NULL, '0.00x0.00x0.00', NULL, '656.00', NULL, '0', 783, NULL, 25, 'IN', '2019-02-20T10:52:46.903-03:00', 35, 21, 2, 1, NULL, NULL, NULL, NULL, 1, 9, 'D', NULL),
(121003, 8, 'CORAM DEO', NULL, NULL, NULL, 0, '2019-02-15T15:01:08.053-02:00', 0, 2033, 0, 0, 0, '1', '9788569980322', 12857, 1446, NULL, NULL, '1060', NULL, '0.00x0.00x0.00', NULL, '1723.00', NULL, '0', 783, NULL, 26, 'IN', '2019-02-17T10:02:19.513-03:00', 6, 22, 2, 1, NULL, NULL, NULL, NULL, 1, 2, 'D', NULL),
(121004, 8, 'COSMOVISÃO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2019, 0, 0, 0, '1', '9788569980452', 12847, 1446, NULL, NULL, '487', NULL, '0.00x0.00x0.00', NULL, '757.00', NULL, '0', 783, NULL, 23, 'IN', '2019-02-25T14:13:50.287-03:00', 15, 19, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121005, 8, 'COSMOVISÕES EM CONFLITO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2019, 0, 0, 0, '1', '9788562478611', 12908, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '268.00', NULL, '0', 783, NULL, 38, 'IN', '2019-02-25T14:13:50.3-03:00', 15, 31, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121006, 8, 'CRISTÃOS EM BABEL', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2020, 0, 0, 0, '1', '9788569980155', 12853, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '100.00', NULL, '0', 783, NULL, 102, 'IN', '2019-02-25T14:13:50.373-03:00', 2, 64, 2, 1, NULL, NULL, NULL, NULL, 1, 5, '0', NULL),
(121007, 8, 'CRISTIANISMO E ESTADO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2021, 0, 0, 0, '1', '9788569980407', 12904, 1446, NULL, NULL, '272', NULL, '0.00x0.00x0.00', NULL, '480.00', NULL, '0', 783, NULL, 13, 'IN', '2019-02-25T14:13:50.273-03:00', 27, 5, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121008, 8, 'CRISTIANISMO PÚBLICO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2021, 0, 0, 0, '1', '9788569980438', 12899, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '137.00', NULL, '0', 783, NULL, 45, 'IN', '2019-02-25T14:13:50.307-03:00', 27, 8, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121009, 8, 'CRISTO, O MEDIADOR', NULL, NULL, NULL, 0, NULL, 0, 2018, 0, 0, 0, '1', '9788562478888', 12921, 1446, NULL, NULL, '116', NULL, '0.00x0.00x0.00', NULL, '149.00', NULL, '0', 783, NULL, 5, 'IN', '2019-02-19T10:18:15.863-03:00', 30, 6, 2, 1, NULL, NULL, NULL, NULL, 1, 2, 'D', NULL),
(121010, 8, 'CULTURA CRISTÃ', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2022, 0, 0, 0, '1', '9788569980209', 12899, 1446, NULL, NULL, '106', NULL, '0.00x0.00x0.00', NULL, '140.00', NULL, '0', 783, NULL, 7, 'IN', '2019-02-26T16:35:43.37-03:00', 18, 8, 2, 1, NULL, NULL, NULL, NULL, 1, 5, '0', NULL),
(121011, 8, 'DANDO NOME AO ELEFANTE', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2019, 0, 0, 0, '1', '9788562478567', 12873, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '338.00', NULL, '0', 783, NULL, 39, 'IN', '2019-02-25T14:13:50.3-03:00', 15, 32, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121012, 8, 'DE PERDOADO A PERDOADOR', NULL, NULL, NULL, 0, NULL, 0, 2013, 0, 0, 0, '1', '9788569980001', 12875, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '262.00', NULL, '0', 783, NULL, 63, 'IN', '2019-02-17T17:52:40.12-03:00', 13, 45, 2, 1, NULL, NULL, NULL, NULL, 1, 8, 'D', NULL),
(121013, 8, 'DELEITANDO-SE EM CRISTO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2018, 0, 0, 0, '1', '9788569980704', 12896, 1446, NULL, NULL, '141', NULL, '0.00x0.00x0.00', NULL, '180.00', NULL, '0', 783, NULL, 17, 'IN', '2019-02-25T14:13:50.28-03:00', 30, 10, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121014, 8, 'DELEITANDO-SE NA ORAÇÃO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 43, '2019-02-15T15:02:36.2-02:00', 0, 2036, 0, 0, 0, '1', '9788569980087', 12896, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '80.00', NULL, '0', 783, NULL, 42, 'IN', '2019-02-22T08:32:22.947-03:00', 3, 10, 2, 1, NULL, NULL, NULL, NULL, 1, 7, '0', NULL),
(121015, 8, 'DELEITANDO-SE NA TRINDADE', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2018, 0, 0, 0, '1', '9788562478802', 12896, 1446, NULL, NULL, '146', NULL, '0.00x14.00x21.00', NULL, '184.00', NULL, '0', 783, NULL, 9, 'IN', '2019-02-25T14:13:50.27-03:00', 30, 10, 2, 1, NULL, NULL, NULL, NULL, 1, 7, '0', NULL),
(121016, 8, 'DEUS É CONTRA OS HOMOSSEXUAIS?', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2032, 0, 0, 0, '1', '9788569980506', 12911, 1446, NULL, NULL, '96', NULL, '0.00x0.00x0.00', NULL, '101.00', NULL, '0', 783, NULL, 134, 'IN', '2019-02-27T10:11:59.883-03:00', 36, 79, 2, 1, NULL, NULL, NULL, NULL, 1, 15, '0', NULL),
(121017, 8, 'DEUS É FIEL', NULL, NULL, NULL, 452, '2019-02-18T11:44:03.14-03:00', 0, 2017, 0, 0, 0, '1', '9788569980223', 12859, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '172.00', NULL, '0', 783, NULL, 49, 'IN', '2019-02-18T11:44:03.073-03:00', 4, 36, 2, 1, NULL, NULL, NULL, NULL, 1, 7, 'D', NULL),
(121018, 8, 'DEUS E O MAL', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2033, 0, 0, 0, '1', '9788562478475', 12862, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '128.00', NULL, '0', 783, NULL, 68, 'IN', '2019-02-25T14:13:50.343-03:00', 6, 7, 2, 1, NULL, NULL, NULL, NULL, 1, 4, '0', NULL),
(121019, 8, 'DEUS EXISTE?', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2014, 0, 0, 0, '1', '9788569885016', 12905, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '224.00', NULL, '0', 783, NULL, 83, 'IN', '2019-02-25T14:13:50.363-03:00', 5, 55, 2, 1, NULL, NULL, NULL, NULL, 1, 6, '0', NULL),
(121020, 8, 'DISBIOÉTICA VOL.1', NULL, NULL, NULL, 475, '2019-02-15T15:09:53.917-02:00', 0, 2025, 0, 0, 0, '1', '9788569980278', 12866, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '150.00', NULL, '0', 783, NULL, 103, 'IN', '2019-02-17T18:18:51.537-03:00', 32, 50, 2, 1, NULL, NULL, NULL, NULL, 1, 12, 'D', NULL),
(121021, 8, 'DISBIOÉTICA VOL.2', NULL, NULL, NULL, 0, NULL, 0, 2025, 0, 0, 0, '1', '9788569980773', 12866, 1446, NULL, NULL, '108', NULL, '0.00x0.00x0.00', NULL, '145.00', NULL, '0', 783, NULL, 104, 'IN', '2019-02-20T10:52:46.903-03:00', 32, 50, 2, 1, NULL, NULL, NULL, NULL, 1, 12, 'D', NULL),
(121022, 8, 'DISBIOÉTICA VOL.3', NULL, NULL, NULL, 0, NULL, 0, 2025, 0, 0, 0, '1', '9788569980780', 12866, 1446, NULL, NULL, '210', NULL, '0.00x0.00x0.00', NULL, '250.00', NULL, '0', 783, NULL, 105, 'IN', '2019-02-20T10:52:46.903-03:00', 32, 50, 2, 1, NULL, NULL, NULL, NULL, 1, 12, 'D', NULL),
(121023, 8, 'EDIFICADOS SOBRE A ROCHA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2035, 0, 0, 0, '1', '9788569980094', 12922, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '130.00', NULL, '0', 783, NULL, 126, 'IN', '2019-02-25T14:13:50.42-03:00', 37, 76, 2, 1, NULL, NULL, NULL, NULL, 1, 11, '0', NULL),
(121024, 8, 'EDUCAÇÃO CLÁSSICA E EDUCAÇÃO DOMICILIAR', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 465, '2019-02-19T10:47:06.477-03:00', 0, 2022, 0, 0, 0, '1', '9788569980254', 12852, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '70.00', NULL, '0', 783, NULL, 48, 'IN', '2019-02-22T02:13:30.05-03:00', 18, 35, 2, 1, NULL, NULL, NULL, NULL, 1, 13, '0', NULL),
(121025, 8, 'EM DEFESA DA TEOLOGIA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2033, 0, 0, 0, '1', '9788562478321', 12862, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '146.00', NULL, '0', 783, NULL, 66, 'IN', '2019-02-25T14:13:50.337-03:00', 6, 7, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121026, 8, 'EM TODA A EXTENSÃO DO COSMOS', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2019, 0, 0, 0, '1', '9788569980476', 12839, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '202.00', NULL, '0', 783, NULL, 28, 'IN', '2019-02-25T11:55:26.187-03:00', 15, 23, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121027, 8, 'ENSAIOS SOBRE ÉTICA E POLÍTICA', NULL, NULL, NULL, 121, '2019-02-18T15:53:59.46-03:00', 0, 2021, 0, 0, 0, '1', '9788569980797', 12862, 1446, NULL, NULL, '312', NULL, '0.00x0.00x0.00', NULL, '410.00', NULL, '0', 783, NULL, 108, 'IN', '2019-02-18T15:53:59.413-03:00', 27, 7, 2, 1, NULL, NULL, NULL, NULL, 1, 12, 'D', NULL),
(121028, 8, 'ENSINANDO O TRIVIUM VOL.1', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 1419, '2019-02-19T10:18:16.053-03:00', 0, 2022, 0, 0, 0, '1', '9788569980193', 12865, 1446, NULL, NULL, '320', NULL, '0.00x0.00x0.00', NULL, '430.00', NULL, '0', 783, NULL, 79, 'IN', '2019-02-25T11:55:26.187-03:00', 18, 51, 2, 1, NULL, NULL, NULL, NULL, 1, 13, '0', NULL),
(121029, 8, 'ENSINANDO O TRIVIUM VOL.2', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2022, 0, 0, 0, '1', '9788569980810', 12865, 1446, NULL, NULL, '392', NULL, '0.00x0.00x0.00', NULL, '524.00', NULL, '0', 783, NULL, 124, 'IN', '2019-02-22T02:13:30.05-03:00', 18, 51, 2, 1, NULL, NULL, NULL, NULL, 1, 13, '0', NULL),
(121030, 8, 'ENTRE WITTENBERG E GENEBRA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 101, '2019-02-15T15:12:02.413-02:00', 0, 2033, 0, 0, 0, '1', '9788569980469', 12906, 1446, NULL, NULL, '289', NULL, '0.00x0.00x0.00', NULL, '470.00', NULL, '0', 783, NULL, 24, 'IN', '2019-02-22T02:13:30.05-03:00', 6, 20, 2, 1, NULL, NULL, NULL, NULL, 1, 11, '0', NULL),
(121031, 8, 'ESQUIZOFRENIA INTELECTUAL', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2022, 0, 0, 0, '1', '9788569980100', 12904, 1446, NULL, NULL, '204', NULL, '0.00x0.00x0.00', NULL, '273.00', NULL, '0', 783, NULL, 41, 'IN', '2019-02-25T14:13:50.303-03:00', 18, 5, 2, 1, NULL, NULL, NULL, NULL, 1, 13, '0', NULL),
(121032, 8, 'EXERCITA-TE NA PIEDADE', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2036, 0, 0, 0, '1', '9788569980162', 12878, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '305.00', NULL, '0', 783, NULL, 95, 'IN', '2019-02-26T09:54:29.48-03:00', 3, 60, 2, 1, NULL, NULL, NULL, NULL, 1, 7, '0', NULL),
(121033, 8, 'FAMÍLIA GUIADA PELA FÉ', NULL, NULL, NULL, 0, NULL, 0, 2027, 0, 0, 0, '1', '9788562478635', 12920, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '412.00', NULL, '0', 783, NULL, 75, 'IN', '2019-02-20T15:29:37.247-03:00', 19, 44, 2, 1, NULL, NULL, NULL, NULL, 1, 14, 'D', NULL),
(121034, 8, 'FÉ COM RAZÃO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 239, '2019-02-18T15:53:59.453-03:00', 0, 2014, 0, 0, 0, '1', '9788562478857', 12886, 1446, NULL, NULL, '126', NULL, '0.00x14.00x21.00', NULL, '185.00', NULL, '0', 783, NULL, 8, 'IN', '2019-02-22T08:32:22.947-03:00', 5, 9, 2, 1, NULL, NULL, NULL, NULL, 1, 6, '0', NULL),
(121035, 8, 'FÉ, ESPERANÇA E AMOR', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2017, 0, 0, 0, '1', '9788569980636', 12894, 1446, NULL, NULL, '322', NULL, '0.00x0.00x0.00', NULL, '410.00', NULL, '0', 783, NULL, 94, 'IN', '2019-02-27T10:11:59.877-03:00', 4, 59, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121036, 8, 'FILOSOFIA E ESTÉTICA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2028, 0, 0, 0, '1', '9788569980537', 12864, 1446, NULL, NULL, '216', NULL, '0.00x0.00x0.00', NULL, '456.00', NULL, '0', 783, NULL, 52, 'IN', '2019-02-25T14:13:50.317-03:00', 10, 38, 2, 1, NULL, NULL, NULL, NULL, 1, 4, '0', NULL),
(121037, 8, 'FILOSOFIA: UM GUIA PARA ESTUDANTES', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2028, 0, 0, 0, '1', '9788562478987', 12847, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '199.00', NULL, '0', 783, NULL, 46, 'IN', '2019-02-27T10:11:59.873-03:00', 10, 19, 2, 1, NULL, NULL, NULL, NULL, 1, 4, '0', NULL),
(121038, 8, 'FREUD', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 172, '2019-02-15T15:13:27.6-02:00', 0, 2019, 0, 0, 0, '1', '9788562478413', 12904, 1446, NULL, NULL, '110', NULL, '0.00x0.00x0.00', NULL, '160.00', NULL, '0', 783, NULL, 31, 'IN', '2019-02-25T11:55:26.187-03:00', 15, 5, 2, 1, NULL, NULL, NULL, NULL, 1, 4, '0', NULL),
(121039, 8, 'FUTEBOL É BOM PARA O CRISTÃO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 114, '2019-02-15T15:13:36.46-02:00', 0, 2036, 0, 0, 0, '1', '9788569980681', 12856, 1446, NULL, NULL, '120', NULL, '0.00x0.00x0.00', NULL, '104.00', NULL, '0', 783, NULL, 80, 'IN', '2019-02-25T11:55:26.187-03:00', 3, 52, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121040, 8, 'GÊNESIS NO ESPAÇO-TEMPO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2024, 0, 0, 0, '1', '9788562478796', 12858, 1446, NULL, NULL, '210', NULL, '0.00x14.00x21.00', NULL, '244.00', NULL, '0', 783, NULL, 10, 'IN', '2019-02-25T14:13:50.27-03:00', 31, 4, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121041, 8, 'GUERRA DE COSMOVISÕES', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2019, 0, 0, 0, '1', '9788562478840', 12849, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '243.00', NULL, '0', 783, NULL, 113, 'IN', '2019-02-25T14:13:50.393-03:00', 15, 49, 2, 1, NULL, NULL, NULL, NULL, 1, 6, '0', NULL),
(121042, 8, 'HOMOSSEXUALISMO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2032, 0, 0, 0, '1', '9788562478543', 12863, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '265.00', NULL, '0', 783, NULL, 82, 'IN', '2019-02-22T02:13:30.05-03:00', 36, 54, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121043, 8, 'INFALIBILIDADE E INTERPRETAÇÃO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 202, '2019-02-15T15:16:50.957-02:00', 0, 2033, 0, 0, 0, '1', '9788562478208', 12904, 1446, NULL, NULL, '132', NULL, '0.00x0.00x0.00', NULL, '159.00', NULL, '0', 783, NULL, 4, 'IN', '2019-02-25T08:31:49.237-03:00', 6, 5, 2, 1, NULL, NULL, NULL, NULL, 1, 3, '0', NULL),
(121044, 8, 'INTRODUÇÃO À EDUCAÇÃO CRISTÃ', NULL, NULL, NULL, 322, '2019-02-19T10:18:16.053-03:00', 0, 2022, 0, 0, 0, '1', '9788562478659', 12870, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '467.00', NULL, '0', 783, NULL, 109, 'IN', '2019-02-19T10:18:15.863-03:00', 18, 67, 2, 1, NULL, NULL, NULL, NULL, 1, 13, 'D', NULL),
(121045, 8, 'INVESTIGANDO A PALAVRA DE DEUS - LIVRO 1', NULL, NULL, NULL, 0, '2019-01-18T09:39:48.657-02:00', 0, 0, 0, 0, 0, '1', '9000000001473', 12849, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '316.00', NULL, '0', 783, NULL, 147, 'FD', '2019-02-17T18:44:58.847-03:00', 1, 49, 2, 1, NULL, NULL, NULL, NULL, NULL, 17, 'D', NULL),
(121046, 8, 'INVESTIGANDO A PALAVRA DE DEUS - LIVRO 3', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 65, '2019-02-19T16:19:00.16-03:00', 0, 2016, 0, 0, 0, '0', '9000000001350', 12839, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '265.00', NULL, '0', 783, NULL, 135, 'FE', '2019-02-27T10:42:16.087-03:00', 29, 23, 2, 1, NULL, NULL, NULL, NULL, 1, 17, '0', NULL),
(121047, 8, 'JOÃO AMÓS COMÊNIO e as origens da ideologia pedagógica', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 342, '2019-02-15T15:18:07.4-02:00', 0, 2022, 0, 0, 0, '1', '9788569980445', 12876, 1446, NULL, NULL, '88', NULL, '0.00x0.00x0.00', NULL, '120.00', NULL, '0', 783, NULL, 50, 'IN', '2019-02-25T11:55:26.187-03:00', 18, 30, 2, 1, NULL, NULL, NULL, NULL, 1, 13, '0', NULL),
(121048, 8, 'JOÃO CALVINO', NULL, NULL, NULL, 557, '2019-02-18T11:51:49.727-03:00', 0, 2029, 0, 0, 0, '1', '9788562478451', 12919, 1446, NULL, NULL, '358', NULL, '0.00x0.00x0.00', NULL, '411.00', NULL, '0', 783, NULL, 59, 'IN', '2019-02-18T11:51:49.763-03:00', 33, 42, 2, 1, NULL, NULL, NULL, NULL, 1, 9, 'D', NULL),
(121049, 8, 'MORRER DE TANTO VIVER', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2034, 0, 0, 0, '1', '9788569980698', 12897, 1446, NULL, NULL, '186', NULL, '0.00x14.00x21.00', NULL, '240.00', NULL, '0', 783, NULL, 144, 'IN', '2019-02-25T14:13:50.43-03:00', 20, 41, 2, 1, NULL, NULL, NULL, NULL, 0, 1, '0', NULL),
(121050, 8, 'MOVIMENTO DA LIBERDADE', NULL, NULL, NULL, 337, '2019-02-15T15:19:06.663-02:00', 0, 2031, 0, 0, 0, '1', '9788569980360', 12896, 1446, NULL, NULL, '38', NULL, '0.00x0.00x0.00', NULL, '170.00', NULL, '0', 783, NULL, 85, 'IN', '2019-02-17T18:04:51.92-03:00', 35, 10, 2, 1, NULL, NULL, NULL, NULL, 1, 11, 'D', NULL),
(121051, 8, 'MULHERES NO ESPELHO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 67, '2019-02-15T15:19:13.3-02:00', 0, 2030, 0, 0, 0, '1', '9788562478680', 12854, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '0.00', NULL, '0', 783, NULL, 138, 'IN', '2019-02-25T11:55:26.187-03:00', 34, 80, 2, 1, NULL, NULL, NULL, NULL, 1, 8, '0', NULL),
(121052, 8, 'NENHUM CONFLITO FINAL', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 353, '2019-02-19T10:18:16.053-03:00', 0, 2014, 0, 0, 0, '1', '9788569980247', 12858, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '83.00', NULL, '0', 783, NULL, 43, 'IN', '2019-02-25T11:55:26.187-03:00', 5, 4, 2, 1, NULL, NULL, NULL, NULL, 1, 6, '0', NULL),
(121053, 8, 'NO CREPÚSCULO DO PENSAMENTO OCIDENTAL', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2028, 0, 0, 0, '1', '9788569980742', 12868, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '0.00', NULL, '0', 783, NULL, 29, 'IN', '2019-02-25T14:13:50.29-03:00', 10, 24, 2, 1, NULL, NULL, NULL, NULL, 1, 4, '0', NULL),
(121054, 8, 'NOTAS DA XÍCARA MALUCA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2034, 0, 0, 0, '1', '9788569980216', 12897, 1446, NULL, NULL, '207', NULL, '0.00x0.00x0.00', NULL, '238.00', NULL, '0', 783, NULL, 55, 'IN', '2019-02-25T11:55:26.187-03:00', 20, 41, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121055, 8, 'O APOCALIPSE PARA LEIGOS', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 289, '2019-02-15T15:21:10.92-02:00', 0, 2023, 0, 0, 0, '1', '9788569980230', 12890, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '238.00', NULL, '0', 783, NULL, 34, 'IN', '2019-02-25T11:55:26.187-03:00', 8, 28, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121056, 8, 'O ATEÍSMO DA IGREJA PRIMITIVA', NULL, NULL, NULL, 252, '2019-02-15T15:21:21.74-02:00', 0, 2029, 0, 0, 0, '1', '9788562478277', 12904, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '130.00', NULL, '0', 783, NULL, 33, 'IN', '2019-02-15T10:18:21.26-02:00', 33, 5, 2, 1, NULL, NULL, NULL, NULL, 1, 11, 'D', NULL),
(121057, 8, 'O ATEU EM DELÍRIO', NULL, NULL, NULL, 250, '2019-02-19T10:18:16.053-03:00', 0, 2014, 0, 0, 0, '1', '9788569980117', 12851, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '128.00', NULL, '0', 783, NULL, 99, 'IN', '2019-02-19T10:18:15.863-03:00', 5, 3, 2, 1, NULL, NULL, NULL, NULL, 1, 6, 'D', NULL),
(121058, 8, 'O CATECISMO DE PIERRE VIRET', NULL, NULL, NULL, 120, '2019-02-15T15:21:41.06-02:00', 0, 2017, 0, 0, 0, '1', '9788569980544', 12903, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '113.00', NULL, '0', 783, NULL, 36, 'IN', '2019-02-17T17:28:11.49-03:00', 4, 29, 2, 1, NULL, NULL, NULL, NULL, 1, 2, 'D', NULL),
(121059, 8, 'O COMBATE CENTRAL DA REFORMA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2031, 0, 0, 0, '1', '9788569980421', 12876, 1446, NULL, NULL, '128', NULL, '0.00x0.00x0.00', NULL, '165.00', NULL, '0', 783, NULL, 47, 'IN', '2019-02-25T14:13:50.313-03:00', 35, 30, 2, 1, NULL, NULL, NULL, NULL, 1, 11, '0', NULL),
(121060, 8, 'O CONHECIMENTO DE CRISTO', NULL, NULL, NULL, 0, NULL, 0, 2018, 0, 0, 0, '1', '9788569980667', 12894, 1446, NULL, NULL, '328', NULL, '0.00x0.00x0.00', NULL, '417.00', NULL, '0', 783, NULL, 93, 'IN', '2019-02-20T15:29:37.25-03:00', 30, 59, 2, 1, NULL, NULL, NULL, NULL, 1, 2, 'D', NULL),
(121061, 8, 'O DIREITO À EDUCAÇÃO DOMICILIAR', NULL, NULL, NULL, 154, '2019-02-15T15:22:07.807-02:00', 0, 2022, 0, 0, 0, '1', '9788569980285', 12840, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '393.00', NULL, '0', 783, NULL, 73, 'IN', '2019-02-17T17:58:26.233-03:00', 18, 48, 2, 1, NULL, NULL, NULL, NULL, 1, 13, 'D', NULL),
(121062, 8, 'O DOM CRIATIVO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2015, 0, 0, 0, '1', '9788569980841', 12864, 1446, NULL, NULL, '216', NULL, '0.00x0.00x0.00', NULL, '440.00', NULL, '0', 783, NULL, 53, 'IN', '2019-02-25T14:13:50.32-03:00', 28, 38, 2, 1, NULL, NULL, NULL, NULL, 1, 4, '0', NULL),
(121063, 8, 'O ILUMINISMO NUM PROTESTANTISMO DE CONSTITUIÇÃO RECENTE', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2029, 0, 0, 0, '1', '9788569980025', 12855, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '296.00', NULL, '0', 783, NULL, 30, 'IN', '2019-02-25T14:13:50.293-03:00', 33, 26, 2, 1, NULL, NULL, NULL, NULL, 1, 12, '0', NULL),
(121064, 8, 'O IMPERATIVO CONFESSIONAL', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2035, 0, 0, 0, '1', '9788562478666', 12844, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '354.00', NULL, '0', 783, NULL, 100, 'IN', '2019-02-25T14:13:50.37-03:00', 37, 62, 2, 1, NULL, NULL, NULL, NULL, 1, 11, '0', NULL),
(121065, 8, 'O MESSIAS VEM A TERRA MÉDIA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 589, '2019-02-15T15:22:47.823-02:00', 0, 2015, 0, 0, 0, '1', '9788569980735', 12902, 1446, NULL, NULL, '170', NULL, '0.00x0.00x0.00', NULL, '223.00', NULL, '0', 783, NULL, 139, 'IN', '2019-02-25T11:55:26.187-03:00', 28, 81, 2, 1, NULL, NULL, NULL, NULL, 1, 16, '0', NULL),
(121066, 8, 'O NASCIMENTO DO REI', NULL, NULL, NULL, 0, NULL, 0, 2018, 0, 0, 0, '1', '9788569980483', 12899, 1446, NULL, NULL, '53', NULL, '0.00x0.00x0.00', NULL, '73.00', NULL, '0', 783, NULL, 35, 'IN', '2019-02-20T16:17:23.843-03:00', 30, 8, 2, 1, NULL, NULL, NULL, NULL, 1, 11, 'D', NULL),
(121067, 8, 'O PAI TRINITÁRIO', NULL, NULL, NULL, 352, '2019-02-19T10:18:16.053-03:00', 0, 2027, 0, 0, 0, '1', '9788569980377', 12917, 1446, NULL, NULL, '70', NULL, '0.00x0.00x0.00', NULL, '88.00', NULL, '0', 783, NULL, 97, 'IN', '2019-02-19T10:18:15.863-03:00', 19, 61, 2, 1, NULL, NULL, NULL, NULL, 1, 14, 'D', NULL),
(121068, 8, 'O PLANO DE DEUS PARA A VITÓRIA', NULL, NULL, NULL, 369, '2019-02-15T15:23:21.81-02:00', 0, 2023, 0, 0, 0, '1', '9788590897521', 12904, 1446, NULL, NULL, '71', NULL, '0.00x0.00x0.00', NULL, '0.00', NULL, '0', 783, NULL, 12, 'IN', '2019-02-16T21:04:47.087-02:00', 8, 5, 2, 1, NULL, NULL, NULL, NULL, 1, 2, 'D', NULL),
(121069, 8, 'O PRESBITERIANISMO BRASILEIRO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2029, 0, 0, 0, '1', '9788562478901', 12855, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '236.00', NULL, '0', 783, NULL, 71, 'IN', '2019-02-25T14:13:50.353-03:00', 33, 26, 2, 1, NULL, NULL, NULL, NULL, 1, 11, '0', NULL),
(121070, 8, 'O QUE APRENDI EM NÁRNIA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2015, 0, 0, 0, '1', '9788569980575', 12851, 1446, NULL, NULL, '177', NULL, '0.00x0.00x0.00', NULL, '266.00', NULL, '0', 783, NULL, 89, 'IN', '2019-02-25T11:55:26.187-03:00', 28, 3, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121071, 8, 'O QUÊ E POR QUÊ?', NULL, NULL, NULL, 405, '2019-02-15T15:23:38.66-02:00', 0, 2017, 0, 0, 0, '1', '9788569980551', 12850, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '105.00', NULL, '0', 783, NULL, 51, 'IN', '2019-02-17T17:36:26.5-03:00', 4, 37, 2, 1, NULL, NULL, NULL, NULL, 1, 2, 'D', NULL),
(121072, 8, 'O QUE ELE DEVE SER SE QUISER CASAR COM MINHA FILHA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2027, 0, 0, 0, '1', '9788562478574', 12920, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '371.00', NULL, '0', 783, NULL, 62, 'IN', '2019-02-27T10:07:22.32-03:00', 19, 44, 2, 1, NULL, NULL, NULL, NULL, 1, 14, '0', NULL),
(121073, 8, 'O QUE JESUS BEBERIA?', NULL, NULL, NULL, 0, NULL, 0, 2021, 0, 0, 0, '1', '9788562478550', 12883, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '180.00', NULL, '0', 783, NULL, 120, 'IN', '2019-02-17T18:29:22.42-03:00', 27, 73, 2, 1, NULL, NULL, NULL, NULL, 1, 7, 'D', NULL),
(121074, 8, 'O RACIONALISTA ROMÂNTICO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 596, '2019-02-18T11:44:03.14-03:00', 0, 2034, 0, 0, 0, '1', '9788569980346', 12885, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '278.00', NULL, '0', 783, NULL, 22, 'IN', '2019-02-25T11:55:26.187-03:00', 20, 18, 2, 1, NULL, NULL, NULL, NULL, 1, 9, '0', NULL),
(121075, 8, 'O RESGATE DA FÉ CRISTÃ', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 243, '2019-02-18T15:53:59.457-03:00', 0, 2014, 0, 0, 0, '1', '9788562478833', 12843, 1446, NULL, NULL, '128', NULL, '0.00x0.00x0.00', NULL, '158.00', NULL, '0', 783, NULL, 84, 'IN', '2019-02-22T08:32:22.947-03:00', 5, 56, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121076, 8, 'O UNIVERSO AO LADO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2019, 0, 0, 0, '1', '9788569980612', 12873, 1446, NULL, NULL, '317', NULL, '0.00x0.00x0.00', NULL, '545.00', NULL, '0', 783, NULL, 115, 'IN', '2019-02-25T14:51:05.433-03:00', 15, 32, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121077, 8, 'OS CHARUTOS, O CRISTÃO E A GLÓRIA DE DEUS', NULL, NULL, 'Fumar não é perigoso e, portanto, um abuso do corpo lhe dado por Deus?\n\nFumar não polui o “templo” em que o Espírito Santo habita?\n\nEm linguagem franca, fumar não é pecado?\n\nFumar não é um mau testemunho aos incrédulos?\n\nFumar não é um mau exemplo aos nossos (ou, talvez mais especificamente, meus) filhos?\n\nComo posso honrar a Deus fumando charutos?', 0, NULL, 0, 2021, 0, 0, 0, '1', '9788562478376', 12882, 1446, NULL, NULL, '0', NULL, '0.00x15.00x21.00', NULL, '90.00', NULL, '0', 783, NULL, 146, 'IN', '2019-02-25T14:13:50.437-03:00', 27, 25, 2, 1, NULL, NULL, NULL, NULL, 0, 1, '0', NULL),
(121078, 8, 'OS CINCO PONTOS DO CALVINISMO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2017, 0, 0, 0, '1', '9788562478765', 12869, 1446, NULL, NULL, '176', NULL, '0.00x0.00x0.00', NULL, '210.00', NULL, '0', 783, NULL, 133, 'IN', '2019-02-26T09:35:50-03:00', 4, 78, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121079, 8, 'PAPO DE GAROTA', NULL, NULL, NULL, 0, NULL, 0, 2030, 0, 0, 0, '1', '9788562478734', 12845, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '317.00', NULL, '0', 783, NULL, 61, 'IN', '2019-02-20T15:32:35.04-03:00', 34, 43, 2, 1, NULL, NULL, NULL, NULL, 1, 8, 'D', NULL),
(121080, 8, 'PASTORES DA FAMÍLIA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2027, 0, 0, 0, '1', '9788562478345', 12920, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '325.00', NULL, '0', 783, NULL, 78, 'IN', '2019-02-27T10:07:22.327-03:00', 19, 44, 2, 1, NULL, NULL, NULL, NULL, 1, 14, '0', NULL),
(121081, 8, 'PENSAMENTOS SECRETOS DE UMA CONVERTIDA IMPROVÁVEL', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2032, 0, 0, 0, '1', '9788562478772', 12909, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '308.00', NULL, '0', 783, NULL, 116, 'IN', '2019-02-25T14:13:50.403-03:00', 36, 72, 2, 1, NULL, NULL, NULL, NULL, 1, 15, '0', NULL),
(121082, 8, 'PERSONALIDADE CENTRADA EM DEUS', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2013, 0, 0, 0, '1', '9788569980384', 12923, 1446, NULL, NULL, '288', NULL, '0.00x0.00x0.00', NULL, '395.00', NULL, '0', 783, NULL, 131, 'IN', '2019-02-25T11:55:26.187-03:00', 13, 16, 2, 1, NULL, NULL, NULL, NULL, 1, 8, '0', NULL),
(121083, 8, 'PERSUASÕES', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 583, '2019-02-12T13:16:13.217-02:00', 0, 2014, 0, 0, 0, '1', '9788562478147', 12851, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '0.00', NULL, '0', 783, NULL, 140, 'IN', '2019-02-25T11:55:26.187-03:00', 5, 3, 2, 1, NULL, NULL, NULL, NULL, 1, 6, '0', NULL),
(121084, 8, 'PIERRE VIRET - O Gigante Esquecido da Reforma', NULL, NULL, NULL, 0, NULL, 0, 2029, 0, 0, 0, '1', '9788569980308', 12876, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '190.00', NULL, '0', 783, NULL, 37, 'IN', '2019-02-20T16:17:23.843-03:00', 33, 30, 2, 1, NULL, NULL, NULL, NULL, 1, 6, 'D', NULL),
(121085, 8, 'POLÍTICA E PÚLPITO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2021, 0, 0, 0, '1', '9788569980186', 12877, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '76.00', NULL, '0', 783, NULL, 122, 'IN', '2019-02-27T10:11:59.88-03:00', 27, 75, 2, 1, NULL, NULL, NULL, NULL, 1, 11, '0', NULL),
(121086, 8, 'POR QUE AS CRIANÇAS PRECISAM DE EDUCAÇÃO CRISTÃ?', NULL, NULL, NULL, 730, '2019-02-18T11:44:03.143-03:00', 0, 2022, 0, 0, 0, '1', '9788569980032', 12851, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '109.00', NULL, '0', 783, NULL, 143, 'IN', '2019-02-18T11:44:03.073-03:00', 18, 3, 2, 1, NULL, NULL, NULL, NULL, 1, 13, 'D', NULL),
(121087, 8, 'POR QUE CREIO EM DEUS', NULL, NULL, NULL, 434, '2019-02-18T15:53:59.46-03:00', 0, 2014, 0, 0, 0, '1', '9788562478628', 12846, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '128.00', NULL, '0', 783, NULL, 101, 'IN', '2019-02-18T15:53:59.413-03:00', 5, 63, 2, 1, NULL, NULL, NULL, NULL, 1, 6, 'D', NULL),
(121088, 8, 'POR QUE O MINISTRO DEVE SER HOMEM?', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 347, '2019-02-15T15:28:26.13-02:00', 0, 2035, 0, 0, 0, '1', '9788569980858', 12851, 1446, NULL, NULL, '70', NULL, '0.00x0.00x0.00', NULL, '91.00', NULL, '0', 783, NULL, 98, 'IN', '2019-02-25T11:55:26.187-03:00', 37, 3, 2, 1, NULL, NULL, NULL, NULL, 1, 11, '0', NULL),
(121089, 8, 'PÓS-MILENARISMO PARA LEIGOS', NULL, NULL, NULL, 667, '2019-02-15T15:29:39.14-02:00', 0, 2023, 0, 0, 0, '1', '9788562478437', 12890, 1446, NULL, NULL, '210', NULL, '0.00x0.00x0.00', NULL, '243.00', NULL, '0', 783, NULL, 129, 'IN', '2019-02-17T18:34:42.337-03:00', 8, 28, 2, 1, NULL, NULL, NULL, NULL, 1, 2, 'D', NULL),
(121090, 8, 'PRÁTICA DE ACONSELHAMENTO REDENTIVO', NULL, NULL, NULL, 202, '2019-02-18T13:32:41.37-03:00', 0, 2013, 0, 0, 0, '1', '9788562478994', 12923, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '386.00', NULL, '0', 783, NULL, 21, 'IN', '2019-02-18T13:32:41.273-03:00', 13, 16, 2, 1, NULL, NULL, NULL, NULL, 1, 8, 'D', NULL),
(121091, 8, 'QUADROS DE UMA EXPOSIÇÃO TEOLÓGICA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2033, 0, 0, 0, '1', '9788569980490', 12891, 1446, NULL, NULL, '334', NULL, '0.00x0.00x0.00', NULL, '524.00', NULL, '0', 783, NULL, 110, 'IN', '2019-02-25T11:55:26.187-03:00', 6, 68, 2, 1, NULL, NULL, NULL, NULL, 1, 11, '0', NULL),
(121092, 8, 'QUEM CONTROLA A ESCOLA GOVERNA O MUNDO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2022, 0, 0, 0, '1', '9788562478529', 12860, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '222.00', NULL, '0', 783, NULL, 132, 'IN', '2019-02-25T11:55:26.187-03:00', 18, 77, 2, 1, NULL, NULL, NULL, NULL, 1, 13, '0', NULL),
(121093, 8, 'REFLITA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2036, 0, 0, 0, '1', '9788569980711', 12916, 1446, NULL, NULL, '234', NULL, '0.00x0.00x0.00', NULL, '343.00', NULL, '0', 783, NULL, 114, 'IN', '2019-02-25T14:13:50.397-03:00', 3, 71, 2, 1, NULL, NULL, NULL, NULL, 1, 7, '0', NULL),
(121094, 8, 'Reformai a vossa mente', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2028, 0, 0, 0, '1', '9788569980759', 12887, 1446, NULL, NULL, '172', NULL, '1.00x14.00x21.00', NULL, '228.00', NULL, '0', 783, NULL, 153, 'IN', '2019-02-26T14:34:16.81-03:00', 10, 86, 2, 1, NULL, NULL, NULL, NULL, 0, 4, '0', NULL),
(121095, 8, 'Renovando a Mente', NULL, NULL, NULL, 0, '2019-01-23T02:18:36.957-02:00', 0, 2014, 0, 0, 0, '1', '9788562478123', 12918, 1446, NULL, NULL, '0', NULL, '0.00x15.00x21.00', NULL, '0.00', NULL, '0', 783, NULL, 151, 'IN', '2019-02-17T18:55:15.357-03:00', 5, 84, 2, 1, NULL, NULL, NULL, NULL, 1, 6, 'D', NULL),
(121096, 8, 'SABEDORIA E PRODÍGIOS', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2020, 0, 0, 0, '1', '9788569980520', 12839, 1446, NULL, NULL, '185', NULL, '0.00x0.00x0.00', NULL, '305.00', NULL, '0', 783, NULL, 86, 'IN', '2019-02-25T11:55:26.187-03:00', 2, 23, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121097, 8, 'SAL DA TERRA EM TERRAS DOS BRASIS', NULL, NULL, NULL, 114, '2019-02-15T15:30:34.283-02:00', 0, 2026, 0, 0, 0, '1', '9788562478871', 12923, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '680.00', NULL, '0', 783, NULL, 90, 'IN', '2019-02-17T18:07:42.893-03:00', 24, 16, 2, 1, NULL, NULL, NULL, NULL, 1, 15, 'D', NULL),
(121098, 8, 'SENHOR DEUS DA VERDADE', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2028, 0, 0, 0, '1', '9788569980650', 12862, 1446, NULL, NULL, '155', NULL, '0.00x0.00x0.00', NULL, '198.00', NULL, '0', 783, NULL, 64, 'IN', '2019-02-25T14:13:50.33-03:00', 10, 7, 2, 1, NULL, NULL, NULL, NULL, 1, 4, '0', NULL),
(121099, 8, 'SERÁ QUE JESUS VIRÁ EM BREVE?', NULL, NULL, NULL, 0, '2019-01-18T09:39:48.657-02:00', 0, 2023, 0, 0, 0, '1', '9000000001497', 12860, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '0.00', NULL, '0', 783, NULL, 149, 'FD', '2019-02-17T18:45:53.197-03:00', 8, 77, 2, 1, NULL, NULL, NULL, NULL, NULL, 3, 'D', NULL),
(121100, 8, 'Sermões sobre Eleição e Reprovação', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 0, 0, 0, 0, '1', '9788569980896', 12879, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '0.00', NULL, '0', 783, NULL, 145, 'IN', '2019-02-25T14:13:50.433-03:00', 1, 83, 2, 1, NULL, NULL, NULL, NULL, 0, 2, '0', NULL),
(121101, 8, 'SEXO, NAMORO E RELACIONAMENTO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2032, 0, 0, 0, '1', '9788569980056', 12861, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '238.00', NULL, '0', 783, NULL, 141, 'IN', '2019-02-25T14:13:50.427-03:00', 36, 82, 2, 1, NULL, NULL, NULL, NULL, 1, 8, '0', NULL),
(121102, 8, 'SOCORRO, NÃO TENHO TEMPO!', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2030, 0, 0, 0, '1', '9788562478581', 12845, 1446, NULL, NULL, '110', NULL, '0.00x0.00x0.00', NULL, '157.00', NULL, '0', 783, NULL, 118, 'IN', '2019-02-26T15:13:28.063-03:00', 34, 43, 2, 1, NULL, NULL, NULL, NULL, 1, 7, '0', NULL),
(121103, 8, 'SUMÁRIO DE DOUTRINA CRISTÃ', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2017, 0, 0, 0, '1', '9788569980872', 12893, 1446, NULL, NULL, '246', NULL, '0.00x0.00x0.00', NULL, '372.00', NULL, '0', 783, NULL, 32, 'IN', '2019-02-25T14:13:50.297-03:00', 4, 27, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121104, 8, 'TEOLOGIA PARA VOCÊ', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 204, '2019-02-15T15:31:34.223-02:00', 0, 2017, 0, 0, 0, '1', '9788562478130', 12898, 1446, NULL, NULL, '86', NULL, '0.00x0.00x0.00', NULL, '124.00', NULL, '0', 783, NULL, 11, 'IN', '2019-02-25T11:55:26.187-03:00', 4, 11, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121105, 8, 'TODO MUNDO PENSA, VOCÊ TAMBÉM', NULL, NULL, NULL, 0, NULL, 0, 2028, 0, 0, 0, '1', '9788562478703', 12923, 1446, NULL, NULL, '272', NULL, '0.00x0.00x0.00', NULL, '303.00', NULL, '0', 783, NULL, 130, 'IN', '2019-02-20T15:32:35.04-03:00', 10, 16, 2, 1, NULL, NULL, NULL, NULL, 1, 8, 'D', NULL),
(121106, 8, 'Três Tipos de Filosofia Religiosa', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2028, 0, 0, 0, '1', '9788562478741', 12862, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '271.00', NULL, '0', 783, NULL, 125, 'IN', '2019-02-25T14:13:50.417-03:00', 10, 7, 2, 1, NULL, NULL, NULL, NULL, 1, 4, '0', NULL),
(121107, 8, 'UM MARIDO OLHANDO A SUA ESPOSA', NULL, NULL, NULL, 0, '2019-02-15T15:31:59.28-02:00', 0, 2027, 0, 0, 0, '1', '9788562478864', 12923, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '152.00', NULL, '0', 783, NULL, 142, 'IN', '2019-02-17T18:42:03.047-03:00', 19, 16, 2, 1, NULL, NULL, NULL, NULL, 1, 7, 'D', NULL),
(121108, 8, 'UMA INTRODUÇÃO À FILOSOFIA CRISTÃ', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2028, 0, 0, 0, '1', '9788562478789', 12862, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '242.00', NULL, '0', 783, NULL, 65, 'IN', '2019-02-27T10:11:59.873-03:00', 10, 7, 2, 1, NULL, NULL, NULL, NULL, 1, 4, '0', NULL),
(121109, 8, 'UMA RELIGIÃO SEM DEUS', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2020, 0, 0, 0, '1', '9788569980605', 12876, 1446, NULL, NULL, '137', NULL, '0.00x0.00x0.00', NULL, '181.00', NULL, '0', 783, NULL, 56, 'IN', '2019-02-25T14:13:50.327-03:00', 2, 30, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121110, 8, 'VESTÍGIOS DA TRINDADE', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 269, '2019-02-18T15:53:59.453-03:00', 0, 2018, 0, 0, 0, '1', '9788569980674', 12901, 1446, NULL, NULL, '196', NULL, '0.00x0.00x0.00', NULL, '264.00', NULL, '0', 783, NULL, 15, 'IN', '2019-02-22T02:13:30.05-03:00', 30, 13, 2, 1, NULL, NULL, NULL, NULL, 1, 4, '0', NULL),
(121111, 8, 'VIDA POR VIDA', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2021, 0, 0, 0, '1', '9788562478826', 12907, 1446, NULL, NULL, '172', NULL, '0.00x0.00x0.00', NULL, '207.00', NULL, '0', 783, NULL, 16, 'IN', '2019-02-25T14:13:50.277-03:00', 27, 14, 2, 1, NULL, NULL, NULL, NULL, 1, 2, '0', NULL),
(121112, 8, 'WILLIAM JAMES E JOHN DEWEY', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2028, 0, 0, 0, '1', '9788569980063', 12862, 1446, NULL, NULL, '146', NULL, '0.00x0.00x0.00', NULL, '223.00', NULL, '0', 783, NULL, 123, 'IN', '2019-02-25T14:13:50.413-03:00', 10, 7, 2, 1, NULL, NULL, NULL, NULL, 1, 10, '0', NULL),
(121113, 8, 'O ESCRITURALISMO DE GORDON CLARK', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2029, 0, 0, 0, '1', '9788562478642', NULL, 1446, NULL, NULL, '116', NULL, '0.00x0.00x0.00', NULL, '148.00', NULL, '0', 783, NULL, 6, 'IN', '2019-02-25T14:13:50.267-03:00', 33, NULL, 2, 1, NULL, NULL, NULL, NULL, 1, 4, 'D', NULL),
(121114, 8, 'PERSPECTIVAS BÍBLICAS SOBRE NEGÓCIOS', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2021, 0, 0, 0, '1', '9788569980629', NULL, 1446, NULL, NULL, '121', NULL, '0.00x0.00x0.00', NULL, '163.00', NULL, '0', 783, NULL, 74, 'IN', '2019-02-21T15:12:43.623-03:00', 27, NULL, 2, 1, NULL, NULL, NULL, NULL, 1, 10, 'D', NULL),
(121115, 8, 'Produtos diversos', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 0, 0, 0, 0, '1', '7896303600565', NULL, 0, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '0.00', NULL, '0', 783, NULL, 152, 'IN', '2019-02-25T16:26:19.64-03:00', 1, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, 'D', NULL),
(121116, 8, 'SEUS DIAS ESTÃO CONTADOS', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2036, 0, 0, 0, '1', '9788562478925', NULL, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '164.00', NULL, '0', 783, NULL, 87, 'IN', '2019-02-25T11:55:26.187-03:00', 3, NULL, 2, 1, NULL, NULL, NULL, NULL, 1, 7, 'D', NULL),
(121117, 8, 'UMA VISÃO CRISTÃ DOS HOMENS E DO MUNDO', NULL, NULL, 'Sem descriÃ§Ã£o para este livro', 0, NULL, 0, 2019, 0, 0, 0, '1', '9788562478727', NULL, 1446, NULL, NULL, '0', NULL, '0.00x0.00x0.00', NULL, '432.00', NULL, '0', 783, NULL, 67, 'IN', '2019-02-25T14:13:50.34-03:00', 15, NULL, 2, 1, NULL, NULL, NULL, NULL, 1, 10, 'D', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_promo_cupons`
--

CREATE TABLE IF NOT EXISTS `p_promo_cupons` (
  `id_cupom` int(10) unsigned NOT NULL,
  `id_loja` int(10) unsigned DEFAULT NULL,
  `codigo` varchar(40) DEFAULT NULL,
  `limite` int(10) unsigned DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  `deleted` enum('1','0') DEFAULT NULL,
  `vencimento` datetime DEFAULT NULL,
  `desconto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_promo_lote`
--

CREATE TABLE IF NOT EXISTS `p_promo_lote` (
  `id_promo` int(10) unsigned NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `tipo_promo` varchar(20) NOT NULL,
  `desc` decimal(10,2) DEFAULT NULL,
  `data_ini` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  `deleted` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_promo_lote_prod`
--

CREATE TABLE IF NOT EXISTS `p_promo_lote_prod` (
  `id_produto` int(10) unsigned NOT NULL,
  `id_editora` int(10) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `id_loja` int(10) unsigned NOT NULL,
  `id_promocao` int(10) unsigned NOT NULL,
  `vendas` int(10) unsigned DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Produtos das promoções em lotes';

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_promo_marketplace`
--

CREATE TABLE IF NOT EXISTS `p_promo_marketplace` (
  `id_promo` int(10) NOT NULL,
  `id_loja` int(10) NOT NULL,
  `id_produto` int(10) NOT NULL,
  `valor_capa` decimal(10,2) NOT NULL,
  `valor_promo` decimal(10,2) NOT NULL,
  `ativa` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_promo_unit`
--

CREATE TABLE IF NOT EXISTS `p_promo_unit` (
  `id_promo` int(10) unsigned NOT NULL,
  `id_loja` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `data_ini` datetime NOT NULL,
  `data_fim` datetime DEFAULT NULL,
  `val_promo` decimal(10,2) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `deleted` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_reviews`
--

CREATE TABLE IF NOT EXISTS `p_reviews` (
  `id` int(10) unsigned NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `nota` enum('1','2','3','4','5') DEFAULT NULL,
  `mensagem` text,
  `data` datetime DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `ativo` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_selos`
--

CREATE TABLE IF NOT EXISTS `p_selos` (
  `id_selo` int(10) unsigned NOT NULL,
  `id_loja` int(10) unsigned NOT NULL,
  `nome_selo` varchar(100) NOT NULL,
  `id_selo_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(50) NOT NULL,
  `status` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_tipo_autor`
--

CREATE TABLE IF NOT EXISTS `p_tipo_autor` (
  `id_tipo_autor` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `id_loja` int(10) NOT NULL,
  `id_tipo_autor_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_tipo_capa`
--

CREATE TABLE IF NOT EXISTS `p_tipo_capa` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `id_loja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_tipo_produto`
--

CREATE TABLE IF NOT EXISTS `p_tipo_produto` (
  `id_tipo_produto` int(10) unsigned NOT NULL,
  `nome` varchar(50) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `id_loja` int(11) unsigned NOT NULL,
  `id_tipo_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(50) NOT NULL,
  `data_envio_skyhub` datetime DEFAULT NULL,
  `data_atualizacao_skyhub` datetime DEFAULT NULL,
  `skyhub` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=785 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `p_tipo_produto`
--

INSERT INTO `p_tipo_produto` (`id_tipo_produto`, `nome`, `status`, `id_loja`, `id_tipo_externo`, `data_atualizacao`, `data_envio_skyhub`, `data_atualizacao_skyhub`, `skyhub`) VALUES
(783, 'LIVRO', '1', 8, 1, '2005-03-02T14:07:39.78-03:00', NULL, NULL, NULL),
(784, 'REVISTAS', '1', 8, 4, '2005-03-02T14:29:06.857-03:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `p_views`
--

CREATE TABLE IF NOT EXISTS `p_views` (
  `id_loja` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `deleted` enum('1','0') DEFAULT '0',
  `sid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `a_conf_de_para`
--
ALTER TABLE `a_conf_de_para`
  ADD PRIMARY KEY (`id_configuracao`);

--
-- Índices de tabela `a_conf_integracao`
--
ALTER TABLE `a_conf_integracao`
  ADD PRIMARY KEY (`id_config`);

--
-- Índices de tabela `a_logs_login`
--
ALTER TABLE `a_logs_login`
  ADD PRIMARY KEY (`id_l`);

--
-- Índices de tabela `a_lojas`
--
ALTER TABLE `a_lojas`
  ADD PRIMARY KEY (`id_l`);

--
-- Índices de tabela `a_lojas_cielo`
--
ALTER TABLE `a_lojas_cielo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `a_lojas_dados`
--
ALTER TABLE `a_lojas_dados`
  ADD PRIMARY KEY (`id_config`);

--
-- Índices de tabela `a_lojas_itau`
--
ALTER TABLE `a_lojas_itau`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_id_loja` (`id_loja`);

--
-- Índices de tabela `a_lojas_rede`
--
ALTER TABLE `a_lojas_rede`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `a_mails_param`
--
ALTER TABLE `a_mails_param`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `a_pages`
--
ALTER TABLE `a_pages`
  ADD PRIMARY KEY (`id_page`);

--
-- Índices de tabela `a_pages_front`
--
ALTER TABLE `a_pages_front`
  ADD PRIMARY KEY (`id_page_front`);

--
-- Índices de tabela `a_page_user_access`
--
ALTER TABLE `a_page_user_access`
  ADD PRIMARY KEY (`id_access`);

--
-- Índices de tabela `a_preferencias`
--
ALTER TABLE `a_preferencias`
  ADD PRIMARY KEY (`id_preferencia`);

--
-- Índices de tabela `a_sicronizacao_integrador`
--
ALTER TABLE `a_sicronizacao_integrador`
  ADD PRIMARY KEY (`id_sicronizacao`);

--
-- Índices de tabela `a_transportadoras`
--
ALTER TABLE `a_transportadoras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `a_users`
--
ALTER TABLE `a_users`
  ADD PRIMARY KEY (`id_u`), ADD KEY `fk_loja_id` (`loja_id`);

--
-- Índices de tabela `a_user_pref`
--
ALTER TABLE `a_user_pref`
  ADD PRIMARY KEY (`id_p`), ADD KEY `fk_id_u` (`id_u`), ADD KEY `fk_loja_id` (`id_loja`);

--
-- Índices de tabela `c_cidades`
--
ALTER TABLE `c_cidades`
  ADD UNIQUE KEY `id` (`id`), ADD KEY `id_2` (`id`);

--
-- Índices de tabela `c_clientes`
--
ALTER TABLE `c_clientes`
  ADD PRIMARY KEY (`id_cli`,`id_loja`), ADD UNIQUE KEY `email` (`email`,`id_loja`), ADD KEY `fk_loja_id` (`id_loja`), ADD KEY `fk_group_id` (`id_group`);

--
-- Índices de tabela `c_clientes_tokens`
--
ALTER TABLE `c_clientes_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `c_enderecos`
--
ALTER TABLE `c_enderecos`
  ADD PRIMARY KEY (`id_e`,`id_cli`,`id_loja`), ADD KEY `fk_loja_id` (`id_loja`);

--
-- Índices de tabela `c_estados`
--
ALTER TABLE `c_estados`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `c_grupos`
--
ALTER TABLE `c_grupos`
  ADD PRIMARY KEY (`id_g`), ADD KEY `fk_loja_id` (`loja_id`);

--
-- Índices de tabela `l_acessos`
--
ALTER TABLE `l_acessos`
  ADD PRIMARY KEY (`id_acesso`,`id_loja`,`id_cliente`);

--
-- Índices de tabela `l_avise_me`
--
ALTER TABLE `l_avise_me`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `l_banners`
--
ALTER TABLE `l_banners`
  ADD PRIMARY KEY (`id_banner`,`id_loja`);

--
-- Índices de tabela `l_carrinho`
--
ALTER TABLE `l_carrinho`
  ADD PRIMARY KEY (`id_cart`), ADD KEY `fk_loja_id` (`id_loja`);

--
-- Índices de tabela `l_carrinho_itens`
--
ALTER TABLE `l_carrinho_itens`
  ADD PRIMARY KEY (`id_item`), ADD KEY `fk_loja_id` (`id_loja`), ADD KEY `fk_produto_id` (`id_produto`), ADD KEY `fk_cart_id` (`id_cart`);

--
-- Índices de tabela `l_frete_gratis`
--
ALTER TABLE `l_frete_gratis`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `l_itens_vendas`
--
ALTER TABLE `l_itens_vendas`
  ADD PRIMARY KEY (`id_item`), ADD KEY `fk_loja_id` (`id_loja`), ADD KEY `fk_venda_id` (`id_venda`), ADD KEY `fk_prod_id` (`prod_id`);

--
-- Índices de tabela `l_log_pedido_magento`
--
ALTER TABLE `l_log_pedido_magento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `l_mail_template`
--
ALTER TABLE `l_mail_template`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `l_newsletter`
--
ALTER TABLE `l_newsletter`
  ADD PRIMARY KEY (`email`,`id_loja`);

--
-- Índices de tabela `l_range_transportadora`
--
ALTER TABLE `l_range_transportadora`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `l_vendas`
--
ALTER TABLE `l_vendas`
  ADD PRIMARY KEY (`v_id`), ADD KEY `fk_loja_id` (`id_loja`);

--
-- Índices de tabela `l_vendas_coment`
--
ALTER TABLE `l_vendas_coment`
  ADD PRIMARY KEY (`id_comment`), ADD KEY `fk_loja_id` (`id_loja`), ADD KEY `fk_user_id` (`id_user`);

--
-- Índices de tabela `l_vendas_historico`
--
ALTER TABLE `l_vendas_historico`
  ADD PRIMARY KEY (`id_h`), ADD KEY `fk_loja_id` (`id_loja`), ADD KEY `fk_venda_id` (`id_venda`);

--
-- Índices de tabela `l_vendas_historico_pag`
--
ALTER TABLE `l_vendas_historico_pag`
  ADD PRIMARY KEY (`id_hist`);

--
-- Índices de tabela `l_vendas_status`
--
ALTER TABLE `l_vendas_status`
  ADD PRIMARY KEY (`id_status`,`id_loja`);

--
-- Índices de tabela `l_visitors`
--
ALTER TABLE `l_visitors`
  ADD PRIMARY KEY (`id_v`);

--
-- Índices de tabela `l_vitrines`
--
ALTER TABLE `l_vitrines`
  ADD PRIMARY KEY (`id_vitrine`,`id_loja`);

--
-- Índices de tabela `l_vitrines_produtos`
--
ALTER TABLE `l_vitrines_produtos`
  ADD PRIMARY KEY (`id_produto`,`id_vitrine`,`id_loja`);

--
-- Índices de tabela `p_arquivos`
--
ALTER TABLE `p_arquivos`
  ADD PRIMARY KEY (`id`,`id_loja`,`id_produto`);

--
-- Índices de tabela `p_autores`
--
ALTER TABLE `p_autores`
  ADD PRIMARY KEY (`id_autor`,`id_loja`);

--
-- Índices de tabela `p_categorias`
--
ALTER TABLE `p_categorias`
  ADD PRIMARY KEY (`id_cat`), ADD KEY `fk_loja_id` (`id_loja`);

--
-- Índices de tabela `p_editoras`
--
ALTER TABLE `p_editoras`
  ADD PRIMARY KEY (`id_editora`,`id_loja`);

--
-- Índices de tabela `p_grupo_item`
--
ALTER TABLE `p_grupo_item`
  ADD PRIMARY KEY (`id_grupo_item`);

--
-- Índices de tabela `p_images`
--
ALTER TABLE `p_images`
  ADD PRIMARY KEY (`id_img`), ADD KEY `fk_loja_id` (`id_loja`), ADD KEY `p_images_ibfk_2_idx` (`id_produto`), ADD KEY `idx_1` (`default_img`,`id_loja`,`id_produto`);

--
-- Índices de tabela `p_logs_change`
--
ALTER TABLE `p_logs_change`
  ADD PRIMARY KEY (`id_log`);

--
-- Índices de tabela `p_precos`
--
ALTER TABLE `p_precos`
  ADD PRIMARY KEY (`id_preco`), ADD UNIQUE KEY `index2` (`id_loja`,`id_produto`,`valor`);

--
-- Índices de tabela `p_produtos`
--
ALTER TABLE `p_produtos`
  ADD PRIMARY KEY (`p_id`), ADD KEY `fk_loja_id` (`id_loja`), ADD KEY `fk_cat_id` (`id_cat`);

--
-- Índices de tabela `p_promo_cupons`
--
ALTER TABLE `p_promo_cupons`
  ADD PRIMARY KEY (`id_cupom`);

--
-- Índices de tabela `p_promo_lote`
--
ALTER TABLE `p_promo_lote`
  ADD PRIMARY KEY (`id_promo`);

--
-- Índices de tabela `p_promo_lote_prod`
--
ALTER TABLE `p_promo_lote_prod`
  ADD PRIMARY KEY (`id_produto`,`id_loja`,`id_promocao`,`id_editora`,`id_categoria`);

--
-- Índices de tabela `p_promo_marketplace`
--
ALTER TABLE `p_promo_marketplace`
  ADD PRIMARY KEY (`id_promo`);

--
-- Índices de tabela `p_promo_unit`
--
ALTER TABLE `p_promo_unit`
  ADD PRIMARY KEY (`id_promo`);

--
-- Índices de tabela `p_reviews`
--
ALTER TABLE `p_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `p_selos`
--
ALTER TABLE `p_selos`
  ADD PRIMARY KEY (`id_selo`,`id_loja`);

--
-- Índices de tabela `p_tipo_autor`
--
ALTER TABLE `p_tipo_autor`
  ADD PRIMARY KEY (`id_tipo_autor`);

--
-- Índices de tabela `p_tipo_capa`
--
ALTER TABLE `p_tipo_capa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `p_tipo_produto`
--
ALTER TABLE `p_tipo_produto`
  ADD PRIMARY KEY (`id_tipo_produto`);

--
-- Índices de tabela `p_views`
--
ALTER TABLE `p_views`
  ADD PRIMARY KEY (`id_loja`,`id_produto`,`sid`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `a_conf_de_para`
--
ALTER TABLE `a_conf_de_para`
  MODIFY `id_configuracao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `a_conf_integracao`
--
ALTER TABLE `a_conf_integracao`
  MODIFY `id_config` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=274;
--
-- AUTO_INCREMENT de tabela `a_logs_login`
--
ALTER TABLE `a_logs_login`
  MODIFY `id_l` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12782;
--
-- AUTO_INCREMENT de tabela `a_lojas`
--
ALTER TABLE `a_lojas`
  MODIFY `id_l` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `a_lojas_cielo`
--
ALTER TABLE `a_lojas_cielo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `a_lojas_dados`
--
ALTER TABLE `a_lojas_dados`
  MODIFY `id_config` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT de tabela `a_lojas_itau`
--
ALTER TABLE `a_lojas_itau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `a_lojas_rede`
--
ALTER TABLE `a_lojas_rede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `a_mails_param`
--
ALTER TABLE `a_mails_param`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `a_pages`
--
ALTER TABLE `a_pages`
  MODIFY `id_page` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de tabela `a_pages_front`
--
ALTER TABLE `a_pages_front`
  MODIFY `id_page_front` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `a_page_user_access`
--
ALTER TABLE `a_page_user_access`
  MODIFY `id_access` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `a_preferencias`
--
ALTER TABLE `a_preferencias`
  MODIFY `id_preferencia` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de tabela `a_sicronizacao_integrador`
--
ALTER TABLE `a_sicronizacao_integrador`
  MODIFY `id_sicronizacao` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT de tabela `a_transportadoras`
--
ALTER TABLE `a_transportadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `a_users`
--
ALTER TABLE `a_users`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10017;
--
-- AUTO_INCREMENT de tabela `a_user_pref`
--
ALTER TABLE `a_user_pref`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `c_cidades`
--
ALTER TABLE `c_cidades`
  MODIFY `id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9718;
--
-- AUTO_INCREMENT de tabela `c_clientes`
--
ALTER TABLE `c_clientes`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `c_clientes_tokens`
--
ALTER TABLE `c_clientes_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `c_enderecos`
--
ALTER TABLE `c_enderecos`
  MODIFY `id_e` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `c_estados`
--
ALTER TABLE `c_estados`
  MODIFY `id` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de tabela `c_grupos`
--
ALTER TABLE `c_grupos`
  MODIFY `id_g` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_acessos`
--
ALTER TABLE `l_acessos`
  MODIFY `id_acesso` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_avise_me`
--
ALTER TABLE `l_avise_me`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_banners`
--
ALTER TABLE `l_banners`
  MODIFY `id_banner` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_carrinho`
--
ALTER TABLE `l_carrinho`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_carrinho_itens`
--
ALTER TABLE `l_carrinho_itens`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_frete_gratis`
--
ALTER TABLE `l_frete_gratis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_itens_vendas`
--
ALTER TABLE `l_itens_vendas`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_log_pedido_magento`
--
ALTER TABLE `l_log_pedido_magento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_mail_template`
--
ALTER TABLE `l_mail_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_range_transportadora`
--
ALTER TABLE `l_range_transportadora`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_vendas`
--
ALTER TABLE `l_vendas`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_vendas_coment`
--
ALTER TABLE `l_vendas_coment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_vendas_historico`
--
ALTER TABLE `l_vendas_historico`
  MODIFY `id_h` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_vendas_historico_pag`
--
ALTER TABLE `l_vendas_historico_pag`
  MODIFY `id_hist` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_vendas_status`
--
ALTER TABLE `l_vendas_status`
  MODIFY `id_status` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_visitors`
--
ALTER TABLE `l_visitors`
  MODIFY `id_v` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `l_vitrines`
--
ALTER TABLE `l_vitrines`
  MODIFY `id_vitrine` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_arquivos`
--
ALTER TABLE `p_arquivos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_autores`
--
ALTER TABLE `p_autores`
  MODIFY `id_autor` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12925;
--
-- AUTO_INCREMENT de tabela `p_categorias`
--
ALTER TABLE `p_categorias`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2037;
--
-- AUTO_INCREMENT de tabela `p_editoras`
--
ALTER TABLE `p_editoras`
  MODIFY `id_editora` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1447;
--
-- AUTO_INCREMENT de tabela `p_grupo_item`
--
ALTER TABLE `p_grupo_item`
  MODIFY `id_grupo_item` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_images`
--
ALTER TABLE `p_images`
  MODIFY `id_img` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29382;
--
-- AUTO_INCREMENT de tabela `p_logs_change`
--
ALTER TABLE `p_logs_change`
  MODIFY `id_log` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_precos`
--
ALTER TABLE `p_precos`
  MODIFY `id_preco` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23310;
--
-- AUTO_INCREMENT de tabela `p_produtos`
--
ALTER TABLE `p_produtos`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=121118;
--
-- AUTO_INCREMENT de tabela `p_promo_cupons`
--
ALTER TABLE `p_promo_cupons`
  MODIFY `id_cupom` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_promo_lote`
--
ALTER TABLE `p_promo_lote`
  MODIFY `id_promo` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_promo_marketplace`
--
ALTER TABLE `p_promo_marketplace`
  MODIFY `id_promo` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_promo_unit`
--
ALTER TABLE `p_promo_unit`
  MODIFY `id_promo` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_reviews`
--
ALTER TABLE `p_reviews`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_selos`
--
ALTER TABLE `p_selos`
  MODIFY `id_selo` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_tipo_autor`
--
ALTER TABLE `p_tipo_autor`
  MODIFY `id_tipo_autor` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_tipo_capa`
--
ALTER TABLE `p_tipo_capa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `p_tipo_produto`
--
ALTER TABLE `p_tipo_produto`
  MODIFY `id_tipo_produto` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=785;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `a_lojas_itau`
--
ALTER TABLE `a_lojas_itau`
ADD CONSTRAINT `fk_id_loja` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`);

--
-- Restrições para tabelas `a_users`
--
ALTER TABLE `a_users`
ADD CONSTRAINT `a_users_ibfk_1` FOREIGN KEY (`loja_id`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `a_user_pref`
--
ALTER TABLE `a_user_pref`
ADD CONSTRAINT `a_user_pref_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `a_users` (`id_u`) ON UPDATE CASCADE,
ADD CONSTRAINT `a_user_pref_ibfk_2` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `c_clientes`
--
ALTER TABLE `c_clientes`
ADD CONSTRAINT `c_clientes_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `c_grupos`
--
ALTER TABLE `c_grupos`
ADD CONSTRAINT `c_grupos_ibfk_1` FOREIGN KEY (`loja_id`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `l_carrinho`
--
ALTER TABLE `l_carrinho`
ADD CONSTRAINT `l_carrinho_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `l_carrinho_itens`
--
ALTER TABLE `l_carrinho_itens`
ADD CONSTRAINT `l_carrinho_itens_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE,
ADD CONSTRAINT `l_carrinho_itens_ibfk_2` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE,
ADD CONSTRAINT `l_carrinho_itens_ibfk_3` FOREIGN KEY (`id_produto`) REFERENCES `p_produtos` (`p_id`) ON UPDATE CASCADE,
ADD CONSTRAINT `l_carrinho_itens_ibfk_4` FOREIGN KEY (`id_cart`) REFERENCES `l_carrinho` (`id_cart`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `l_itens_vendas`
--
ALTER TABLE `l_itens_vendas`
ADD CONSTRAINT `l_itens_vendas_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE,
ADD CONSTRAINT `l_itens_vendas_ibfk_2` FOREIGN KEY (`id_venda`) REFERENCES `l_vendas` (`v_id`) ON UPDATE CASCADE,
ADD CONSTRAINT `l_itens_vendas_ibfk_3` FOREIGN KEY (`prod_id`) REFERENCES `p_produtos` (`p_id`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `l_vendas`
--
ALTER TABLE `l_vendas`
ADD CONSTRAINT `l_vendas_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `l_vendas_coment`
--
ALTER TABLE `l_vendas_coment`
ADD CONSTRAINT `l_vendas_coment_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE,
ADD CONSTRAINT `l_vendas_coment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `a_users` (`id_u`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `l_vendas_historico`
--
ALTER TABLE `l_vendas_historico`
ADD CONSTRAINT `l_vendas_historico_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE,
ADD CONSTRAINT `l_vendas_historico_ibfk_3` FOREIGN KEY (`id_venda`) REFERENCES `l_vendas` (`v_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
