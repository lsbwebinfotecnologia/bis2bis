<?php

class Sistema {

    /**
     * 
     * @return String: data atual fotmato BR
     */
    static function DataAtualBR() {

        return date('d/m/Y');
    }

    /**
     * 
     * @return String: data atual US (formato MYSQL)
     */
    static function DataAtualUS() {

        return date('Y-m-d');
    }

    /**
     * 
     * @return string: hora atual, hora , minuto e segundo
     */
    static function HoraAtual() {

        return date('H:i:s');
    }

    /*
     * 
     * @param type $valor
     * @return float - valor formatado em REal
     */

    static function MoedaBR($valor) {
        // 500.99   500,99    1500.99  1.500,99
        return number_format($valor, 2, ",", ".");
    }

    /**
     * 
     * @param string pega data americana e deixa em BR
     * @return string
     */
    public static function Fdata($data) {
        // 2017-04-23 23/04/2017
        $data_correta = explode("-", $data);
        $data = $data_correta[2] . "/" . $data_correta[1] . "/" . $data_correta[0];
        return $data;
    }

    /**
     * 
     * @param number formatado para o banco
     * @return string
     */
    static function formatNumberBanco($get_valor) {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }

    /**
     * 
     * @param type int: tamanho da senha
     * @return string: senha randonica
     */
    static function GerarSenha() {
        //2	  // fe45214qa  mqws23ma  0o z b
        $tamanho = 1;
        $string = "";

        for ($i = 0; $i < $tamanho; $i++) {

            //$string .= (rand(1, 9)) ;
            $string .= chr(rand(109, 122));
            $string .= rand(40, 99);
            $string .= chr(rand(109, 122));
            $string .= rand(20, 89);
            $string .= chr(rand(109, 122));
            $string .= chr(rand(109, 122));
            //$string .= rand(20, 89);
            //$string .= rand(20, 89);		  
        }
        $string = str_replace('o', 'z', $string);
        $string = str_replace('0', 'b', $string);

        return $string;
    }

    /**
     * validar CPF
     * @param type string: CPF 
     * @return boolean: true caso o CPF seja correto
     */
    static function ValidarCPF($cpf = false) {
        // determina um valor inicial para o digito $d1 e $d2
        $d1 = 0;
        $d2 = 0;
        // remove tudo que nÃ£o seja nÃºmero
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        // lista de cpf invÃ¡lidos que serÃ£o ignorados
        $ignore_list = array(
            '00000000000', '01234567890', '11111111111', '22222222222', '33333333333',
            '44444444444', '55555555555', '66666666666', '77777777777', '88888888888',
            '99999999999'
        );
        // se o tamanho da string for dirente de 11 ou estiver
        // na lista de cpf ignorados jÃ¡ retorna false
        if (strlen($cpf) != 11 || in_array($cpf, $ignore_list)) {
            return false;
        } else {
            // inicia o processo para achar o primeiro
            // nÃºmero verificador usando os primeiros 9 dÃ­gitos
            for ($i = 0; $i < 9; $i++) {
                // inicialmente $d1 vale zero e Ã© somando.
                // O loop passa por todos os 9 dÃ­gitos iniciais
                $d1 += $cpf[$i] * (10 - $i);
            }
            // acha o resto da divisÃ£o da soma acima por 11
            $r1 = $d1 % 11;
            // se $r1 maior que 1 retorna 11 menos $r1 se nÃ£o
            // retona o valor zero para $d1
            $d1 = ($r1 > 1) ? (11 - $r1) : 0;
            // inicia o processo para achar o segundo
            // nÃºmero verificador usando os primeiros 9 dÃ­gitos
            for ($i = 0; $i < 9; $i++) {
                // inicialmente $d2 vale zero e Ã© somando.
                // O loop passa por todos os 9 dÃ­gitos iniciais
                $d2 += $cpf[$i] * (11 - $i);
            }
            // $r2 serÃ¡ o resto da soma do cpf mais $d1 vezes 2
            // dividido por 11
            $r2 = ($d2 + ($d1 * 2)) % 11;
            // se $r2 mair que 1 retorna 11 menos $r2 se nÃ£o
            // retorna o valor zeroa para $d2
            $d2 = ($r2 > 1) ? (11 - $r2) : 0;
            // retona true se os dois Ãºltimos dÃ­gitos do cpf
            // forem igual a concatenaÃ§Ã£o de $d1 e $d2 e se nÃ£o
            // deve retornar false.
            return (substr($cpf, -2) == $d1 . $d2) ? true : false;
        }
    }

    static function copiaImagem($urlOrigem, $urlDestino) {
        $minha_curl = curl_init($urlOrigem);
        $fs_arquivo = fopen($urlDestino, "w");
        curl_setopt($minha_curl, CURLOPT_FILE, $fs_arquivo);
        curl_setopt($minha_curl, CURLOPT_HEADER, 0);
        curl_exec($minha_curl);
        curl_close($minha_curl);
        fclose($fs_arquivo);
    }

    /**
     * 
     * @return string - IP do usuario
     */
    static function GetIp() {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {

            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * mostra botÃ£o voltar com java script
     */
    static function VoltarPagina() {

        echo '<script> function goBack() {
                    window.history.back();
                    } </script>';
        echo '<button onclick="goBack()" class="btn btn-default">'
        . '<i class="glyphicon glyphicon-circle-arrow-left" ></i> Voltar </button> ';
    }

    /**
     * @return string: cria um nome para pastas e URL amigavel (SLUG)
     */
    static function GetSlug($string) {
        //    original =  Produto maÃ§Ã£ do Amor  - produto-maca-do-amor 
        if (is_string($string)) {
            $string = strtolower(trim(utf8_decode($string)));

            $before = 'Ã€Ã�Ã‚ÃƒÃ„Ã…Ã†Ã‡ÃˆÃ‰ÃŠÃ‹ÃŒÃ�ÃŽÃ�Ã�Ã‘Ã’Ã“Ã”Ã•Ã–Ã˜Ã™ÃšÃ›ÃœÃ�ÃžÃŸÃ Ã¡Ã¢Ã£Ã¤Ã¥Ã¦Ã§Ã¨Ã©ÃªÃ«Ã¬Ã­Ã®Ã¯Ã°Ã±Ã²Ã³Ã´ÃµÃ¶Ã¸Ã¹ÃºÃ»Ã½Ã½Ã¾Ã¿Rr';
            $after = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
            $string = strtr($string, utf8_decode($before), $after);

            $replace = array(
                '/[^a-z0-9.-]/' => '-',
                '/-+/' => '-',
                '/\-{2,}/' => ''
            );

            $string = preg_replace(array_keys($replace), array_values($replace), $string);
        }
        return trim(substr($string, 0, 55));
    }

    static function imgExist($isbn) {
        $file = Rotas::get_DirImagesCapas() . "/" . $isbn . '.jpg';

//        var_dump($file);
//        die;
//        var_dump($file);

        if (file_exists($file)) {
            return $isbn . '.jpg';
        } else {
            return 'semimagem.png';
        }
    }

    /**
     * URL Exists
     *
     * Verifica se o caminho URL existe.
     * Isso é útil para verificar se um arquivo de imagem num 
     * servidor remoto antes de definir um link para o mesmo.
     *
     * @param string $url           O URL a verificar.
     *
     * @return boolean
     */
    static function url_exists($url) {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($code == 200); // verifica se recebe "status OK"
    }

    /**
     * 
     * @param string $valor original 
     * @return string valor criptografado
     */
    static function Criptografia($valor) {
        return hash('SHA512', $valor);
    }
    
    static function somenteNumeros($value) {
        $somenteNumeros = preg_replace('/[^0-9]/', '', $value);
        return $somenteNumeros;
    }

    static function dataEmFormatoBrazil($dateSql) {
        $ano = substr($dateSql, 0, 4);
        $mes = substr($dateSql, 5, 2);
        $dia = substr($dateSql, 8, 2);
        return $dia . "/" . $mes . "/" . $ano;
    }

    static function CriptografiaCronEncode($valor) {
        return base64_encode($valor);
    }

    static function CriptografiaCronDecode($valor) {
        return base64_decode($valor);
    }

    static function curlExec($url, $post = NULL, array $header = array()) {

        //Inicia o cURL
        $ch = curl_init($url);

        //Pede o que retorne o resultado como string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Envia cabeçalhos (Caso tenha)
        if (count($header) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        //Envia post (Caso tenha)
        if ($post !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }

        //Ignora certificado SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);

        //Manda executar a requisição
        $data = curl_exec($ch);

        //Fecha a conexão para economizar recursos do servidor
        curl_close($ch);

        //Retorna o resultado da requisição

        return $data;
    }

    static function msgSucess($msg) {
        return '<div class="alert alert-success alert-block"> <h5 class="alert-heading">Sucesso!</h5> ' . $msg . '</div>';
    }

    static function msgDanger($msg) {
        return '<div class="alert alert-danger alert-block"> <h5 class="alert-heading">Error!</h5> ' . $msg . '</div>';
    }

    static function msgAlert($msg) {
        return '<div class="alert alert-warning alert-block"> <h5 class="alert-heading">Alerta!</h5> ' . $msg . '</div>';
    }

    static function convertStringEmVlr($string, $caracter = '.') {//UTILIZADO NA CONSTENT STUFF
        return floatval(substr($string, 0, 8) . $caracter . substr($string, 8));
    }

    static function tipoPagtoCS($codPagto) {//UTILIZADO NA CONSTENT STUFF
        $tipo = "ND";

        if ($codPagto == 1) {
            $tipo = 'creditCard';
        } elseif ($codPagto == 2) {
            $tipo = 'debitCard';
        } elseif ($codPagto == 3) {
            $tipo = 'boleto';
        }
        return $tipo;
    }

    static function bandeiraPagto($codBandeira) {//UTILIZADO NA CONSTENT STUFF
        $card = "ND";

        if ($codBandeira == 2) {
            $card = 'Visa';
        } elseif ($codBandeira == 3) {
            $card = 'Master';
        } elseif ($codBandeira == 4) {
            $card = 'amex';
        } elseif ($codBandeira == 5) {
            $card = 'dinner';
        } elseif ($codBandeira == 9) {
            $card = 'hiper';
        }
        return $card;
    }

    static function tipoEnvio($idTipoOrder) {//UTILIZADO NA CONSTENT STUFF
        $tipoPedido = "Normal";
        if ($idTipoOrder == '02') {
            $tipoPedido = "Reenvio";
        } elseif ($idTipoOrder == '03') {
            $tipoPedido = "RenvioParcial";
        }
        return $idTipoOrder . '-' . $tipoPedido;
    }

    function formataTelefone($numero) {
        if (strlen($numero) == 10) {
            $novo = substr_replace($numero, '(', 0, 0);
            $novo = substr_replace($novo, '9', 3, 0);
            $novo = substr_replace($novo, ')', 3, 0);
        } else {
            $novo = substr_replace($numero, '(', 0, 0);
            $novo = substr_replace($novo, ')', 3, 0);
        }
        return $novo;
    }

}
