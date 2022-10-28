<?php

class Template extends SmartyBC
{
    function __construct(){
        parent:: __construct();
        
        //SETANDO O DIRETORIO DA PAGINA
        $this->setTemplateDir('view/' . Config::DIR_FRONT . '/');
        $this->setCompileDir('view/' . Config::DIR_FRONT . '/compile/');
        $this->setCacheDir('view/' . Config::DIR_FRONT . '/cache/');
    }
}
?>
