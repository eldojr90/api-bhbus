<?php

namespace App\Aux;

use PDO;

class Connection{

    public static function getConnection(){
        
        $con = null;
        
        try{
        
            $con = new PDO("mysql:host=localhost; dbname=bhbus","root","");
        
        } catch (Exception $e){
            
            echo $e->getMessage();
            
        }
        
        return $con;
        
    }

}