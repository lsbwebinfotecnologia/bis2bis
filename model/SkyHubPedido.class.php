<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkyHubPedido
 *
 * @author licivando
 */
class SkyHubPedido {

    public function deleteOrderOfFila($idOrderSkyHub) {
        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);
        $requestHandler = $api->queue();
        /** @var \SkyHub\Api\Handler\Response\HandlerInterface $response */
        $response = $requestHandler->delete($idOrderSkyHub)->export();
        return $response;
    }

    function getFilaPedidos($qtd) {
        $i = 1;
        $pedidos = array();

        while ($i <= $qtd) :
            $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);
            $requestHandler = $api->queue();
            $response = $requestHandler->orders()->export();


            if (isset($response['body'])) {//SE TIVER RESULTADO NA BODY
                $skyhubPedidos = json_decode($response['body']);
                $dataOrderItens = array(); // ARRAY PARA GUARDAR OS ITENS DO PEDIDO MKT

                //var_dump($skyhubPedidos);
                

                $c = 0;
                foreach ($skyhubPedidos->items as $item) {//GUARDANDO OS ITENS DO PEDIDO
                    $dataOrderItens[$c]['original_price'] = $item->original_price;
                    $dataOrderItens[$c]['product_id'] = $item->product_id;
                    $dataOrderItens[$c]['qty'] = $item->qty;
                    $dataOrderItens[$c]['special_price'] = $item->special_price;
                    $dataOrderItens[$c]['id'] = $item->id;
                    $dataOrderItens[$c]['name'] = $item->name;
                    $dataOrderItens[$c]['detail'] = $item->detail;
                    $c ++;
                }

                $dataOrder = [
                    "id_ped_skyhub" => $skyhubPedidos->code,
                    "canal_skyhub" => $skyhubPedidos->channel,
                    "status_skyhub" => $skyhubPedidos->status->code,
                    "remote_code" => $skyhubPedidos->import_info->remote_code,
                    "statusTypeSkyhub" => $skyhubPedidos->status->type,
                    "statusLabelSkyhub" => $skyhubPedidos->status->label,
                    "client" => [
                        "nome" => $skyhubPedidos->customer->name,
                        "email" => $skyhubPedidos->customer->email,
                        "celular" => $skyhubPedidos->customer->phones[0],
                        "cpfCnpj" => $skyhubPedidos->customer->vat_number,
                    ],
                    "tipoFrete" => $skyhubPedidos->shipping_method,
                    "typeCalculation" => $skyhubPedidos->calculation_type,
                    "endEntrega" => [
                        "logradouro" => $skyhubPedidos->shipping_address->street,
                        "uf" => $skyhubPedidos->shipping_address->region,
                        "cep" => $skyhubPedidos->shipping_address->postcode,
                        "telefone" => $skyhubPedidos->shipping_address->phone,
                        "numero" => $skyhubPedidos->shipping_address->number,
                        "bairro" => $skyhubPedidos->shipping_address->neighborhood,
                        "complemento" => $skyhubPedidos->shipping_address->detail,
                        "cidade" => $skyhubPedidos->shipping_address->city
                    ],
                    "endFaturamento" => [
                        "logradouro" => $skyhubPedidos->billing_address->street,
                        "uf" => $skyhubPedidos->billing_address->region,
                        "cep" => $skyhubPedidos->billing_address->postcode,
                        "telefone" => $skyhubPedidos->billing_address->phone,
                        "numero" => $skyhubPedidos->billing_address->number,
                        "bairro" => $skyhubPedidos->billing_address->neighborhood,
                        "complemento" => $skyhubPedidos->billing_address->detail,
                        "cidade" => $skyhubPedidos->billing_address->city
                    ],
                    "total" => $skyhubPedidos->total_ordered,
                    "discount" => $skyhubPedidos->discount,
                    "shipping_cost" => $skyhubPedidos->shipping_cost,
                    "seller_shipping_cost" => $skyhubPedidos->seller_shipping_cost,
                    "delivery_contract_type" => $skyhubPedidos->delivery_contract_type,
                    "estimated_delivery" => $skyhubPedidos->estimated_delivery,
                    "approved_date" => $skyhubPedidos->approved_date,
                    "updated_at" => $skyhubPedidos->updated_at,
                    "itens" => $dataOrderItens
                ];
                $pedidos[$i] = $dataOrder; //GUARDANDO EM UMA ARRAY A LISTAGEM DE PEDIDOS
            } else {
                break;
            }
            $i ++;
        endwhile;

        return $pedidos;
    }

}
