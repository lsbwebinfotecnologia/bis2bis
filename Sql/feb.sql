-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Maio-2019 às 23:42
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `a_conf_de_para`
--

CREATE TABLE `a_conf_de_para` (
  `id_configuracao` int(11) NOT NULL,
  `id_loja` int(10) NOT NULL,
  `tipo_configuracao` varchar(100) NOT NULL,
  `de` varchar(100) NOT NULL,
  `para` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `a_conf_integracao`
--

CREATE TABLE `a_conf_integracao` (
  `id_config` int(10) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(250) NOT NULL,
  `detalhesdaconfiguracao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `a_conf_integracao`
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
(262, 8, 'nomeStatPedidoEnvErp', '\'Aprovado\'', ''),
(263, 8, 'codStatusAoEnviarParaErp', '0', ''),
(264, 8, 'nomeStatPedidoSincronizacaoERP', '\'Enviado para o Horus\', \'Ag Faturamento\', \'Faturado\', \'Em Expedicao\',  \'Pre - venda Aprovado\'', 'Informe no valor entre aspas simples e separado por virgula os status dos pedidos que deverão sincronizar no ERP.\nEssa configuração, determina quais status de pedidos o Eros deverá buscar para sincronização com o ERP.'),
(265, 8, 'nomeStatusFaturadoBuscaNfRastreio', 'FAT', 'Configuração define Status do Pedido ERP para que o Eros busque informações de Codigo de Rastreio e Nota fiscal. Esta configuração é vinculada a tela status_pedido.php (Sincronização de Status de Pedidos no ADMIN)'),
(266, 8, 'qtdDiasCron', '30', 'Quantidade de dias para sincronização dos Status dos pedidos. Essa configuração esta sendo utilizada na tela de status_pedidos.php.'),
(267, 8, 'nomeWSCapas', 'http://189.6.53.200:8081/ws/capas-web/', ''),
(268, 8, 'codStatusBoletoAguardandoPagamento', '0', 'Esta configuração é necessário para configurar o código do status do pedido quando finaliza uma compra com o boleto.\r\nPaginas onde se encontra a chamada dessa informação: (/Webservices/creatOrder.php)'),
(269, 8, 'nomeStatusFaturadoBuscaNfRastreioEros', '\'Faturado\'', 'Configuração define Status do Pedido do Eros, para que busque informações de Codigo de Rastreio e Nota fiscal. Esta configuração é vinculada a tela status_pedido.php (Sincronização de Status de Pedidos no ADMIN)'),
(270, 8, 'nomeArquivoCapa', 'isbn', 'Configuração necessária para buscar o nome das imagens por codigo interno ou codigo de barras'),
(271, 8, 'estoqueEm', 'quantidade', 'Configuração necessária para validar o tipo de pesquisa do saldo do estoque'),
(272, 8, 'statusPreVendaNaoConf', '\'Pre - venda Ag pagamento\'', 'Configuração para atribuir vendas com o metodo com itens em Pre venda'),
(273, 8, 'statusPreVendaConf', '\'Pre - venda Aprovado\'', 'Configuração para atribuir vendas com o metodo com itens em Pre venda onde o pagamento foi confirmado.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `a_lojas`
--

CREATE TABLE `a_lojas` (
  `id_l` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `ativo` int(11) NOT NULL,
  `data_cad` datetime NOT NULL,
  `token` varchar(40) DEFAULT NULL,
  `domain` varchar(100) DEFAULT NULL,
  `domain_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `a_lojas`
--

INSERT INTO `a_lojas` (`id_l`, `nome`, `ativo`, `data_cad`, `token`, `domain`, `domain_ip`) VALUES
(8, 'FEB', 1, '2019-02-15 00:00:00', NULL, 'www.feb.com.br', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `a_lojas_dados`
--

CREATE TABLE `a_lojas_dados` (
  `id_config` int(10) UNSIGNED NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `a_pages`
--

CREATE TABLE `a_pages` (
  `id_page` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `a_preferencias`
--

CREATE TABLE `a_preferencias` (
  `id_preferencia` int(10) NOT NULL,
  `id_loja` int(10) NOT NULL,
  `preferencia` varchar(150) NOT NULL,
  `value` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `a_preferencias`
--

INSERT INTO `a_preferencias` (`id_preferencia`, `id_loja`, `preferencia`, `value`) VALUES
(41, 8, 'utilizarIntegracaoErp', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `a_sicronizacao_integrador`
--

CREATE TABLE `a_sicronizacao_integrador` (
  `id_sicronizacao` int(10) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `tipo_sicronizacao` varchar(50) NOT NULL,
  `data_sicronizacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `a_sicronizacao_integrador`
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
-- Estrutura da tabela `a_transportadoras`
--

CREATE TABLE `a_transportadoras` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` enum('valorxpeso','retiranaloja','internacional','terceiros','40010','41106','retiranaloja2','speed','04162','04669') DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `a_users`
--

CREATE TABLE `a_users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `c_cidades`
--

CREATE TABLE `c_cidades` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `estado` int(2) UNSIGNED ZEROFILL NOT NULL DEFAULT '00',
  `uf` varchar(4) NOT NULL DEFAULT '',
  `nome` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `c_clientes`
--

CREATE TABLE `c_clientes` (
  `id_cli` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `apelido` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `id_group` tinyint(10) UNSIGNED NOT NULL,
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
-- Estrutura da tabela `c_enderecos`
--

CREATE TABLE `c_enderecos` (
  `id_e` int(11) NOT NULL,
  `nome_end` varchar(150) DEFAULT NULL,
  `id_cli` int(11) NOT NULL,
  `tipo` enum('Principal','Entrega','Comercial','Outro','Casa','Apartamento') DEFAULT NULL,
  `logradouro` varchar(200) NOT NULL,
  `bairro` varchar(70) DEFAULT NULL,
  `numero` varchar(50) NOT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `cidade` smallint(100) UNSIGNED DEFAULT NULL,
  `estado` tinyint(3) UNSIGNED NOT NULL,
  `cep` char(9) NOT NULL,
  `id_loja` int(11) UNSIGNED NOT NULL,
  `principal` enum('0','1') NOT NULL COMMENT '1: SIM - 0: NAO',
  `ativo` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `c_estados`
--

CREATE TABLE `c_estados` (
  `id` int(2) UNSIGNED ZEROFILL NOT NULL,
  `uf` varchar(10) NOT NULL DEFAULT '',
  `nome` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `l_itens_vendas`
--

CREATE TABLE `l_itens_vendas` (
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
-- Estrutura da tabela `l_mail_template`
--

CREATE TABLE `l_mail_template` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `html` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `l_range_transportadora`
--

CREATE TABLE `l_range_transportadora` (
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
-- Estrutura da tabela `l_vendas`
--

CREATE TABLE `l_vendas` (
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
  `id_status_prod` int(10) UNSIGNED DEFAULT '0' COMMENT 'Status da produção -> l_vendas_status',
  `id_cupom` int(11) UNSIGNED DEFAULT NULL,
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
-- Estrutura da tabela `l_vendas_historico`
--

CREATE TABLE `l_vendas_historico` (
  `id_h` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `id_loja` int(11) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT '-1: System (uso interno)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `l_vendas_historico_pag`
--

CREATE TABLE `l_vendas_historico_pag` (
  `id_hist` int(10) UNSIGNED NOT NULL,
  `id_loja` int(10) UNSIGNED DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `obs` text,
  `id_venda` int(11) DEFAULT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `l_vendas_status`
--

CREATE TABLE `l_vendas_status` (
  `id_status` int(10) UNSIGNED NOT NULL,
  `id_loja` int(10) UNSIGNED NOT NULL,
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
-- Estrutura da tabela `p_autores`
--

CREATE TABLE `p_autores` (
  `id_autor` int(10) UNSIGNED NOT NULL,
  `id_tipo_autor` int(10) NOT NULL,
  `id_loja` int(10) UNSIGNED NOT NULL,
  `nome_autor` varchar(100) DEFAULT NULL,
  `ativo` enum('1','0') DEFAULT NULL,
  `id_autor_externo` int(10) NOT NULL,
  `id_tipo_autor_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_categorias`
--

CREATE TABLE `p_categorias` (
  `id_cat` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `id_loja` int(11) NOT NULL,
  `id_categoria_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_editoras`
--

CREATE TABLE `p_editoras` (
  `id_editora` int(10) UNSIGNED NOT NULL,
  `id_loja` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `id_editora_externo` int(10) NOT NULL,
  `vlr_desconto_editora` decimal(5,2) NOT NULL,
  `nom_fantasia` varchar(150) NOT NULL,
  `data_atualizacao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_grupo_item`
--

CREATE TABLE `p_grupo_item` (
  `id_grupo_item` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `id_loja` int(11) UNSIGNED NOT NULL,
  `id_grupo_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(50) NOT NULL,
  `data_envio_skyhub` datetime DEFAULT NULL,
  `data_atualizacao_skyhub` datetime DEFAULT NULL,
  `skyhub` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_images`
--

CREATE TABLE `p_images` (
  `id_img` int(11) UNSIGNED NOT NULL,
  `id_loja` int(11) UNSIGNED NOT NULL,
  `id_produto` int(11) UNSIGNED NOT NULL,
  `default_img` enum('0','1') NOT NULL COMMENT '1: IMAGEM PADRAO, 0: DEMAIS IMAGENS',
  `dir_name` varchar(300) NOT NULL,
  `deleted` enum('0','1') DEFAULT '0',
  `data_modificacao` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_precos`
--

CREATE TABLE `p_precos` (
  `id_preco` int(10) UNSIGNED NOT NULL,
  `id_loja` varchar(45) DEFAULT NULL,
  `id_produto` varchar(45) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `deleted` enum('1','0') DEFAULT '0',
  `id_item_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_produtos`
--

CREATE TABLE `p_produtos` (
  `p_id` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `sub_titulo` varchar(200) DEFAULT NULL,
  `mini_desc` text,
  `full_desc` text,
  `unidades` int(11) UNSIGNED NOT NULL,
  `dat_ult_atl_saldo` varchar(150) DEFAULT NULL,
  `estoq_min` int(11) UNSIGNED NOT NULL,
  `id_cat` int(11) UNSIGNED NOT NULL,
  `views` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `added_cart` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `was_purchased` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ativo` enum('0','1') NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `id_autor` int(10) UNSIGNED DEFAULT NULL,
  `id_editora` int(10) UNSIGNED DEFAULT NULL,
  `lanc_data` date DEFAULT NULL,
  `edicao` tinyint(3) UNSIGNED DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_promo_unit`
--

CREATE TABLE `p_promo_unit` (
  `id_promo` int(10) UNSIGNED NOT NULL,
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
-- Estrutura da tabela `p_selos`
--

CREATE TABLE `p_selos` (
  `id_selo` int(10) UNSIGNED NOT NULL,
  `id_loja` int(10) UNSIGNED NOT NULL,
  `nome_selo` varchar(100) NOT NULL,
  `id_selo_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(50) NOT NULL,
  `status` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_tipo_autor`
--

CREATE TABLE `p_tipo_autor` (
  `id_tipo_autor` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `id_loja` int(10) NOT NULL,
  `id_tipo_autor_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_tipo_produto`
--

CREATE TABLE `p_tipo_produto` (
  `id_tipo_produto` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `id_loja` int(11) UNSIGNED NOT NULL,
  `id_tipo_externo` int(10) NOT NULL,
  `data_atualizacao` varchar(50) NOT NULL,
  `data_envio_skyhub` datetime DEFAULT NULL,
  `data_atualizacao_skyhub` datetime DEFAULT NULL,
  `skyhub` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a_conf_de_para`
--
ALTER TABLE `a_conf_de_para`
  ADD PRIMARY KEY (`id_configuracao`);

--
-- Indexes for table `a_conf_integracao`
--
ALTER TABLE `a_conf_integracao`
  ADD PRIMARY KEY (`id_config`);

--
-- Indexes for table `a_lojas`
--
ALTER TABLE `a_lojas`
  ADD PRIMARY KEY (`id_l`);

--
-- Indexes for table `a_lojas_dados`
--
ALTER TABLE `a_lojas_dados`
  ADD PRIMARY KEY (`id_config`);

--
-- Indexes for table `a_pages`
--
ALTER TABLE `a_pages`
  ADD PRIMARY KEY (`id_page`);

--
-- Indexes for table `a_preferencias`
--
ALTER TABLE `a_preferencias`
  ADD PRIMARY KEY (`id_preferencia`);

--
-- Indexes for table `a_sicronizacao_integrador`
--
ALTER TABLE `a_sicronizacao_integrador`
  ADD PRIMARY KEY (`id_sicronizacao`);

--
-- Indexes for table `a_transportadoras`
--
ALTER TABLE `a_transportadoras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_users`
--
ALTER TABLE `a_users`
  ADD PRIMARY KEY (`id_u`),
  ADD KEY `fk_loja_id` (`loja_id`);

--
-- Indexes for table `c_cidades`
--
ALTER TABLE `c_cidades`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `c_clientes`
--
ALTER TABLE `c_clientes`
  ADD PRIMARY KEY (`id_cli`,`id_loja`),
  ADD UNIQUE KEY `email` (`email`,`id_loja`),
  ADD KEY `fk_loja_id` (`id_loja`),
  ADD KEY `fk_group_id` (`id_group`);

--
-- Indexes for table `c_enderecos`
--
ALTER TABLE `c_enderecos`
  ADD PRIMARY KEY (`id_e`,`id_cli`,`id_loja`),
  ADD KEY `fk_loja_id` (`id_loja`);

--
-- Indexes for table `c_estados`
--
ALTER TABLE `c_estados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_itens_vendas`
--
ALTER TABLE `l_itens_vendas`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_loja_id` (`id_loja`),
  ADD KEY `fk_venda_id` (`id_venda`),
  ADD KEY `fk_prod_id` (`prod_id`);

--
-- Indexes for table `l_mail_template`
--
ALTER TABLE `l_mail_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_range_transportadora`
--
ALTER TABLE `l_range_transportadora`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_vendas`
--
ALTER TABLE `l_vendas`
  ADD PRIMARY KEY (`v_id`),
  ADD KEY `fk_loja_id` (`id_loja`);

--
-- Indexes for table `l_vendas_historico`
--
ALTER TABLE `l_vendas_historico`
  ADD PRIMARY KEY (`id_h`),
  ADD KEY `fk_loja_id` (`id_loja`),
  ADD KEY `fk_venda_id` (`id_venda`);

--
-- Indexes for table `l_vendas_historico_pag`
--
ALTER TABLE `l_vendas_historico_pag`
  ADD PRIMARY KEY (`id_hist`);

--
-- Indexes for table `l_vendas_status`
--
ALTER TABLE `l_vendas_status`
  ADD PRIMARY KEY (`id_status`,`id_loja`);

--
-- Indexes for table `p_autores`
--
ALTER TABLE `p_autores`
  ADD PRIMARY KEY (`id_autor`,`id_loja`);

--
-- Indexes for table `p_categorias`
--
ALTER TABLE `p_categorias`
  ADD PRIMARY KEY (`id_cat`),
  ADD KEY `fk_loja_id` (`id_loja`);

--
-- Indexes for table `p_editoras`
--
ALTER TABLE `p_editoras`
  ADD PRIMARY KEY (`id_editora`,`id_loja`);

--
-- Indexes for table `p_grupo_item`
--
ALTER TABLE `p_grupo_item`
  ADD PRIMARY KEY (`id_grupo_item`);

--
-- Indexes for table `p_images`
--
ALTER TABLE `p_images`
  ADD PRIMARY KEY (`id_img`),
  ADD KEY `fk_loja_id` (`id_loja`),
  ADD KEY `p_images_ibfk_2_idx` (`id_produto`),
  ADD KEY `idx_1` (`default_img`,`id_loja`,`id_produto`);

--
-- Indexes for table `p_precos`
--
ALTER TABLE `p_precos`
  ADD PRIMARY KEY (`id_preco`),
  ADD UNIQUE KEY `index2` (`id_loja`,`id_produto`,`valor`);

--
-- Indexes for table `p_produtos`
--
ALTER TABLE `p_produtos`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `fk_loja_id` (`id_loja`),
  ADD KEY `fk_cat_id` (`id_cat`);

--
-- Indexes for table `p_promo_unit`
--
ALTER TABLE `p_promo_unit`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indexes for table `p_selos`
--
ALTER TABLE `p_selos`
  ADD PRIMARY KEY (`id_selo`,`id_loja`);

--
-- Indexes for table `p_tipo_autor`
--
ALTER TABLE `p_tipo_autor`
  ADD PRIMARY KEY (`id_tipo_autor`);

--
-- Indexes for table `p_tipo_produto`
--
ALTER TABLE `p_tipo_produto`
  ADD PRIMARY KEY (`id_tipo_produto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a_conf_de_para`
--
ALTER TABLE `a_conf_de_para`
  MODIFY `id_configuracao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `a_conf_integracao`
--
ALTER TABLE `a_conf_integracao`
  MODIFY `id_config` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `a_lojas`
--
ALTER TABLE `a_lojas`
  MODIFY `id_l` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `a_lojas_dados`
--
ALTER TABLE `a_lojas_dados`
  MODIFY `id_config` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `a_pages`
--
ALTER TABLE `a_pages`
  MODIFY `id_page` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `a_preferencias`
--
ALTER TABLE `a_preferencias`
  MODIFY `id_preferencia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `a_sicronizacao_integrador`
--
ALTER TABLE `a_sicronizacao_integrador`
  MODIFY `id_sicronizacao` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `a_transportadoras`
--
ALTER TABLE `a_transportadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `a_users`
--
ALTER TABLE `a_users`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10017;

--
-- AUTO_INCREMENT for table `c_cidades`
--
ALTER TABLE `c_cidades`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9718;

--
-- AUTO_INCREMENT for table `c_clientes`
--
ALTER TABLE `c_clientes`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_enderecos`
--
ALTER TABLE `c_enderecos`
  MODIFY `id_e` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_estados`
--
ALTER TABLE `c_estados`
  MODIFY `id` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `l_itens_vendas`
--
ALTER TABLE `l_itens_vendas`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `l_mail_template`
--
ALTER TABLE `l_mail_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `l_range_transportadora`
--
ALTER TABLE `l_range_transportadora`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `l_vendas`
--
ALTER TABLE `l_vendas`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `l_vendas_historico`
--
ALTER TABLE `l_vendas_historico`
  MODIFY `id_h` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `l_vendas_historico_pag`
--
ALTER TABLE `l_vendas_historico_pag`
  MODIFY `id_hist` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `l_vendas_status`
--
ALTER TABLE `l_vendas_status`
  MODIFY `id_status` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p_autores`
--
ALTER TABLE `p_autores`
  MODIFY `id_autor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12925;

--
-- AUTO_INCREMENT for table `p_categorias`
--
ALTER TABLE `p_categorias`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2037;

--
-- AUTO_INCREMENT for table `p_editoras`
--
ALTER TABLE `p_editoras`
  MODIFY `id_editora` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1447;

--
-- AUTO_INCREMENT for table `p_grupo_item`
--
ALTER TABLE `p_grupo_item`
  MODIFY `id_grupo_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p_images`
--
ALTER TABLE `p_images`
  MODIFY `id_img` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29382;

--
-- AUTO_INCREMENT for table `p_precos`
--
ALTER TABLE `p_precos`
  MODIFY `id_preco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23310;

--
-- AUTO_INCREMENT for table `p_produtos`
--
ALTER TABLE `p_produtos`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121118;

--
-- AUTO_INCREMENT for table `p_promo_unit`
--
ALTER TABLE `p_promo_unit`
  MODIFY `id_promo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p_selos`
--
ALTER TABLE `p_selos`
  MODIFY `id_selo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p_tipo_autor`
--
ALTER TABLE `p_tipo_autor`
  MODIFY `id_tipo_autor` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p_tipo_produto`
--
ALTER TABLE `p_tipo_produto`
  MODIFY `id_tipo_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=785;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `a_users`
--
ALTER TABLE `a_users`
  ADD CONSTRAINT `a_users_ibfk_1` FOREIGN KEY (`loja_id`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `c_clientes`
--
ALTER TABLE `c_clientes`
  ADD CONSTRAINT `c_clientes_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `l_itens_vendas`
--
ALTER TABLE `l_itens_vendas`
  ADD CONSTRAINT `l_itens_vendas_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE,
  ADD CONSTRAINT `l_itens_vendas_ibfk_2` FOREIGN KEY (`id_venda`) REFERENCES `l_vendas` (`v_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `l_itens_vendas_ibfk_3` FOREIGN KEY (`prod_id`) REFERENCES `p_produtos` (`p_id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `l_vendas`
--
ALTER TABLE `l_vendas`
  ADD CONSTRAINT `l_vendas_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `l_vendas_historico`
--
ALTER TABLE `l_vendas_historico`
  ADD CONSTRAINT `l_vendas_historico_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `a_lojas` (`id_l`) ON UPDATE CASCADE,
  ADD CONSTRAINT `l_vendas_historico_ibfk_3` FOREIGN KEY (`id_venda`) REFERENCES `l_vendas` (`v_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
