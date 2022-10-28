<?php

//$ambiente = 'teste';
$ambiente = 'teste';

$trayToken = new TrayToken($ambiente);
$trayToken->gerarToken();

$config = new TrayConfig();

$dataConfig = $config->getConfigs($ambiente);

//VALIDAR A GERACAO DO TOKEN DEPOIS

if ($dataConfig['access_token']) {

    $expiraEm = strtotime(substr($dataConfig['date_expiration_access_token'], -8, 5));
//    $horaAtual = strtotime(date('H:i'));
    $horaAtual = strtotime("02:37");

    if($horaAtual > $expiraEm){
        echo Sistema::msgSucess("Hora do token atualizada com sucesso!");
    }else{
        echo Sistema::msgSucess("O toke expira às ". substr($dataConfig['date_expiration_access_token'], -8, 5));
    }


    switch ($horaAtual) {
        case $horaAtual > $expiraEm:
            if ($trayToken->gerarToken()) {
                echo Sistema::msgSucess("Hora do token atualizada com sucesso!");
            }
            break;
        case $horaAtual < $expiraEm:
            echo Sistema::msgSucess("O toke expira às " . substr($dataConfig['date_expiration_access_token'], -8, 5));
            break;
    }
} else {
    
}


//verificar se a data expirou
//$dt_atual		= date("Y-m-d"); // data atual
//$timestamp_dt_atual 	= strtotime($dt_atual); // converte para timestamp Unix
// 
//$dt_expira		= "2012-10-05"; // data de expiração do anúncio
//$timestamp_dt_expira	= strtotime($dt_expira); // converte para timestamp Unix
// 
//// data atual é maior que a data de expiração
//if ($timestamp_dt_atual > $timestamp_dt_expira) // true
//  echo  "Seu anuncio expirou! Deseja renovar?";
//else // false
//  echo "Anuncio ativo";