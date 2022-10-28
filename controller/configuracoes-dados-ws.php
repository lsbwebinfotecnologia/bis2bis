<?php


$configuracoes = new Configuracoes();



foreach ($_POST as $key => $value) {
    $name = $key;
    $configuracoes->updateConfiguracoesWS($name, $value);    
}

echo '<div class="alert alert-success alert-block"> <h4 class="alert-heading">Atualizado com sucesso!</h4></div>';

if($_POST['pagina'] == 'configuracao-erp'){
    Rotas::redirecionar(2, Rotas::pagina_ConfiguracoesErp());
}elseif($_POST['pagina'] == 'configuracao-loja'){
    Rotas::redirecionar(2, Rotas::pagina_ConfiguracoesLoja());
}elseif($_POST['pagina'] == 'configuracao-erp-ws'){
    Rotas::redirecionar(2, Rotas::get_SiteHome().'/configuracao-erp-ws');
}








