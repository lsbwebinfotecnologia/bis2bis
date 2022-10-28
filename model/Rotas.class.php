<?php

class Rotas {

    public static $pag;
    private static $pasta_controller_front = 'controller';
    private static $pasta_controller_admin = 'controller';
    private static $pasta_view_front = 'view' . Config::DIR_FRONT . '';
    private static $pasta_view_admin = 'view' . Config::DIR_ADMIN . '';

    static function get_Pagina() {//FUNCAO PARA SABER SE A PAGINA EXISTE E MOSTRA OS DADOS DELA
        if (isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
            self::$pag = explode('/', $pagina);
            //DIRETORIO ONDE FICARÁ OS CONTROLLERS
            $pagina = 'controller/' . self::$pag[0] . '.php';

            if (file_exists($pagina)) {  //VERIFICA SE A PAGINA EXISTE                 
                include $pagina;
            } else {//SE NAO EXISTE MOSTRA A PAGINA DE ERRO 
                //die(var_dump($pagina));
                include 'error.php';
            }
        } else {
            include 'controller/home.php'; //SE NÃO ENCONTRAR NENHUMA PAGINA, IRÁ TRAZER A PAGINA HOME
        }
    }

    static function ignorarIncludes($controller) {
        
    }

    static function get_SiteHome() {//FUNCAO PAGINA HOME DO SITE
        return Config::SITE_URL . '' . Config::SITE_PASTA;
    }

    static function get_SiteError() {//FUNCAO PAGINA HOME DO SITE
        return Config::SITE_URL . '/' . Config::SITE_PASTA . '/error.php';
    }

    static function get_SiteRaiz() {// FUNCAO PASTA RAIZ AMBAS ESTAO NA CONSTANTE DENTRO DA CLASS CONFIG
        return $_SERVER['DOCUMENT_ROOT'] . '' . Config::SITE_PASTA;
    }

    static function get_URLFront() {
        return self::get_SiteHome() . '/' . self::$pasta_view_front;
    }

    static function pagina_ConfiguracoesErp() {
        return self::get_SiteHome() . '/configuracoes-erp';
    }

    static function pagina_ConfiguracoesLoja() {
        return self::get_SiteHome() . '/configuracoes-loja';
    }

    static function pagina_Integradores() {
        return self::get_SiteHome() . '/integradores-erp';
    }

    static function pagina_Produtos() {
        return self::get_SiteHome() . '/produto';
    }

    static function pagina_PedidosStatus() {
        return self::get_SiteHome() . '/pedidos-status';
    }

    static function pagina_Categorias() {
        return self::get_SiteHome() . '/categorias';
    }

    static function pagina_ProdutosGestao() {
        return self::get_SiteHome() . '/produtos-gestao';
    }

    static function pagina_PedidosGestao() {
        return self::get_SiteHome() . '/pedidos-gestao';
    }

    static function pagina_ActionProduto() {
        return self::get_SiteHome() . '/action-produto';
    }

    static function pagina_ActionImportProdutoPrecosSkyhub() {
        return self::get_SiteHome() . '/controller/action-import-produto-preco-skyhub.php';
    }

    static function pagina_ActionEmportProdutosSkyhub() {
        return self::get_SiteHome() . '/controller/action-export-produto-skyhub.php';
    }
    
    static function pagina_ActionProdutoGestao() {
        return self::get_SiteHome() . '/action-produto-gestao';
    }
    
    static function pagina_ActionSkyhubPedidos() {
        return self::get_SiteHome() . '/action-skyhub-pedidos';
    }

    static function pagina_ActionImportProdutoSkyhub() {
        return self::get_SiteHome() . '/controller/action-import-produto-skyhub.php';
    }

    static function pagina_ActionPedidosStatus() {
        return self::get_SiteHome() . '/action-pedidos-status';
    }

    static function get_DirTemaFront() {
        return self::get_SiteRaiz() . '/' . self::$pasta_view_front . '/';
    }

    static function get_DirControllerFront() {
        return self::get_SiteRaiz() . '/' . self::$pasta_controller_front;
    }

    static function get_UrlFilesSkyhub() {
        return self::get_SiteRaiz() . '/files/skyhub';
    }

    static function get_DirControllerAdmin() {
        return self::get_SiteRaiz() . '/' . self::$pasta_controller_admin;
    }

    static function get_NameSite() {
        return Config::SITE_NOME;
    }

    static function get_HeadFront() {//FUNCAO PARA DAR UM INCLUDE NA PAGINA DA HEAD NA IDEX        
        include self::get_DirControllerFront() . '/head.php';
    }

    static function get_FooterFront() {//FUNCAO PARA DAR UM INCLUDE NA PAGINA DA HEAD NA IDEX        
        include self::get_DirControllerFront() . '/footer.php';
    }

    static function get_ImageUrlBooks() {
        //return self::get_SiteHome().Config::DIR_IMGS;//ESTA EM PRODUCAO NA HOSPEGADE
        return Config::DIR_IMGS; //PROVISORIO
    }

    static function image_LinkBook($img, $width, $height) {

        $image = self::get_ImageUrlBooks() . "thumb.php?src={$img}&w={$width}&h=$height&zc=1";
        return $image;
    }

    static function get_DirImagesCapas() {
        return $_SERVER['DOCUMENT_ROOT'] . Config::SITE_PASTA .'/images/catalog/'. Config::ID_LOJA;
    }
    
    static function get_DirFileEstoque() {
        return self::get_SiteRaiz() . '/files/estoque';
    }
    
    static function get_DirFilePostagem() {
        return self::get_SiteRaiz() . '/files/postagem';
    }
    
    static function get_DirFileImgs() {
        return self::get_SiteRaiz() . '/files/imgs';
    }

    static function get_ImageUrlBanners() {
        return self::get_SiteHome() . '/' . get_ImagePastaBanners();
    }

    //MÉTODO PARA REDIRECIONAR
    static function redirecionar($tempo, $pagina) {
        $url = '<meta http-equiv="refresh" content="' . $tempo . '; url=' . $pagina . '">';
        echo $url;
    }

    static function pagina_Login() {
        return self::get_SiteHome() . '/login';
    }

    static function pagina_Logoff() {
        return self::get_SiteHome() . '/logoff';
    }

    static function pagina_Usuarios() {
        return self::get_SiteHome() . '/usuarios';
    }

    static function get_Title() {
        
    }

}

?>