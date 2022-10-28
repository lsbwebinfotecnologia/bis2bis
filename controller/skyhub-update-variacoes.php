<?php

$produtos = new SkyHubProdutoUpdate();
//$produtos->getProductsUpdateSkyhub();
//$productsData = $produtos->getDatas();

$data = [
    "sku" => "9788538071730",
    "qty" => "241",
    "specifications" => [
        [
            "key" => "Cor",
            "value" => "Vermelha"
        ],
        [
            "key" => "price",
            "value" => 70.00
        ],
        [
            "key" => "promotional_price",
            "value" => 20.00
        ]
    ]
];

//$produtos->updateVariation("9788533951457", $data);


var_dump($produtos->updateVariation("9788533951457", $data));
