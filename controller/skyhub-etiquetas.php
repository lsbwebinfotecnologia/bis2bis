<?php

$etiquetas = new SkyhubEtiquetas();
$orders = ["158265528", "158265526"];
//$orders2 = ["158013882", "158013883"];

//PLP 64243

//$etiquetas->recuperarPLP("64243");
//die;
$plp = $etiquetas->confirmColeta($orders);

//var_dump($plp);
//die;

//var_dump($etiquetas->recuperarPLP('64217'));

die;

$c = 1;
foreach ($plp->orders as $order) {
    var_dump($order);
    //die;
    if($c <= 3){
        array_push($orders, $order->code);
    }else{
        break;
    }
    $c++;
}



var_dump($orders);

var_dump($etiquetas->agroupOrderInPLP($orders));


