<?php

//var_dump($_POST);
$action = $_POST['action'];

$idStatus = isset($_POST['id']) ? $_POST['id'] : null;
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$color = isset($_POST['color']) ? $_POST['color'] : null;


$evento = new EventosCronus();

if($action == 'new'){
    
    $columnsInserts = [
        "nome" => $nome,
        "color" => $color,
        "id_loja" => Config::ID_LOJA
    ];
    
    $evento->insertTable("l_vendas_status", $columnsInserts);
    
    echo '<span class="label label-success">Status criado com Sucesso</span>';
    Rotas::redirecionar(1, Rotas::pagina_PedidosStatus());
    
}elseif($action == 'update'){
    
    $dataSet = [
        "nome" => $nome,
        "color"=> $color
    ];
    $dataWhere = [
        "id_status" =>$idStatus
    ];
    $evento->updateTable("l_vendas_status", $dataSet, $dataWhere);
    echo '<span class="label label-success">Status atualizado com Sucesso</span>';
    Rotas::redirecionar(1, Rotas::pagina_PedidosStatus().'/update/'.$idStatus);
    
}

