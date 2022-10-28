<?php

class Config {

    //INFORMACOES BASICAS
    //const SITE_URL = '';
    //const SITE_PASTA = '';
    const SITE_URL = 'https://localhost';
    const SITE_PASTA = '/bis2bis';
    const DIR_FRONT = '';
    const DIR_ADMIN = '';
    const DIR_IMGS = 'http://10.20.2.3:9785/capas';
    const URL_IMGS = 'http://10.20.2.3:9785/capas';
    const SITE_NOME = 'Cronuz - Integrador';
    const ID_LOJA = 17;
    const SITE_EMAIL_ADM = '';
    const BD_LIMIT_POR_PAG = 25;
    const PESO_DEFAULT = 300;
    const ALTURA_DEFAULT = '2.00';
    const LARGURA_DEFAULT = '14.00';
    const COMPRIMENTO_DEFAULT = '21.00';
    //PARAMETROS DA TRAY
    const CODE = '';
    const URL_API_ADDRESS = 'https://api.commerce.tray.com.br';
    //PARAMETROS LOJA INTEGRADA
    const CHAVE_API = '';
    const CHAVE_APP = '';
    //PARAMETROS WOOCOMMERCE MINO EDITORA
    const WS_KEY_CONSUMER = '';
    const WS_SECRET_CONSUMER = '';
    const WS_URL_LOJA = '';
//
//    //INFORMACEOS DB MYSQL
//    const BD_HOST = "localhost";
//    const BD_USER = "root";
//    const BD_PASS = "";
//    const BD_NAME = "woocommerce";
//    const BD_PREFIX = "";
//    const BD_PREFIXO_PASS = 'ECHP-';
//    
    //INFORMACEOS DB MYSQL
    const BD_HOST = "mysql.cronuz.com.br";
    const BD_USER = "cronuz0303_add1";
    const BD_PASS = "Rkhul7mekZkj";
    const BD_NAME = "cronuz03";
    const BD_PREFIX = "";
    const BD_PREFIXO_PASS = 'ECHP-';
    const PESQUISA_ITEM = '';
    const FTP_HOST = "ftp.cronuz.com.br";
    const FTP_USER = "cronuz";
    const FTP_PASS = "";
    //INFORMACEOS DB SQL
    const DB_HOST = '',
            DB_USER = '',
            DB_PASSWORD = '',
            DB_NAME = '',
            DB_DRIVER = '';
    //INFORMACOES EMAIL PHP MAILER
    const EMAIL_SMTP = 'smtp.cronuz.com.br';
    const EMAIL_USER = 'notificacao@cronuz.com.br';
    const EMAIL_NAME = 'Notificacao Cronuz Bi2Bis - IDLOJA ' . self::ID_LOJA;
    const EMAIL_PASS = 'n1o2t34@9182';
    const EMAIL_PORT = 587;
    const EMAIL_SMTPAUTH = true;
    const EMAIL_SECURITY = '';
    const EMAIL_COPY = 'licivando@lsbwebinfo.com.br';
    //CONFIGURAÇÕES SKYHUB
    const SKYHUB_EMAIL = '';
    const SKYHUB_KEY = '';
    const SKYHUB_ACOUNT_KEY = '';
    const SKYHUB_DIR_IMG = '';
    const SKYHUB_STORE_PRAZO_CROSDOCKING = 3;
    //CONSTANTE PARA ATUALIZAÇÃO DE PEDIDOS
    const ID_STATUS_APROVADO = '1';
    const ID_STATUS_FATURADO = '4';
    const ID_STATUS_CANCELADO = '3';

}
