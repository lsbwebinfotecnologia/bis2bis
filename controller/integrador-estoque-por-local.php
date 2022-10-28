<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$configuracao = new Configuracoes();

//DADOS EMPRESA E FILIAL
$codEmpresa = $configuracao->getDadosConfig('codEmpresa');
$codFilial = $configuracao->getDadosConfig('codFilial');


$estoqueHorus = new EstoqueHorus($codEmpresa, $codFilial);

$saldoDoLocal = $estoqueHorus->getSaldoPorLocal(3, 2629);

var_dump($saldoDoLocal);
die;
