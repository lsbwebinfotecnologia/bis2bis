<?php

class ConexaoSQL extends Config
{
   protected $obj, $itens=array();
   
   function __construct() {
       //parent::__construct();
       try{
           if($this->getConnection() == null){
               $this->getConnection();
           }
       }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
   }
    
   private function getConnection() {
  
       $pdoConfig  = self::DB_DRIVER . ":". "Server=" . self::DB_HOST . ";";
       $pdoConfig .= "Database=".self::DB_NAME.";";
       
       try {
           if(!isset($connection)){
               $connection =  new PDO($pdoConfig, self::DB_USER, self::DB_PASSWORD);
               $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           }
           return $connection;
       } catch (PDOException $e) {
           $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
           $mensagem .= "\nErro: " . $e->getMessage();
           throw new Exception($mensagem);
       }
   }
   
   function ExecuteSQL($query, array $params = NULL){
        $this->obj = $this->getConnection()->prepare($query);
        return $this->obj->execute();
    }
    
    function ListarDados(){
        return $this->obj->fetchall(PDO::FETCH_ASSOC);
    }
    
    function getDadoUnico(){
        return $this->obj->fetch(PDO::FETCH_ASSOC);
    }
    
    function TotalDados(){
        return $this->obj->rowCount();
    }
    
    function GetDados(){
        return $this->itens;
    }
}
?>
