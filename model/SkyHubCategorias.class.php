<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkyHubTipoProduto
 *
 * @author licivando
 */
class SkyHubCategorias {
    public $action;
   
    
    public function insertCategory($dados=array()) {
        if($dados){
            $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);
            
            foreach ($dados as $category) {
                $api->category()->create($category['code'], $category['name']);
                echo 'Insert Category ' . $category['code'] . ' -> ' .$category['name'] . '<br>';
            }
            
        }else{
            echo 'Nenhuma categoria para ser inserida na SkyHub!';
        }
    }
    
    public function updateCategory($dados=array()) {
        if($dados){
            $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);
            
            foreach ($dados as $category) {
                $api->category()->update($category['code'], $category['name']);
                echo 'Update Category ' . $category['code'] . ' -> ' .$category['name'] . '<br>';
            }
            
        }else{
            echo 'Nenhuma categoria para ser atualizada na SkyHub!';
        }
    }
    
    public function deleteCategory($dados=array()) {
         if($dados){
            $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);
            
            foreach ($dados as $category) {
                $api->category()->delete($category['code']);
                echo 'Category Cod-> ' . $category['code'] . ' Name -> ' .$category['name'] . ' deletada com sucesso!<br>';
            }
            
        }else{
            echo 'Nenhuma categoria para ser atualizada na SkyHub!';
        }
    }
}
