<?php

namespace App\Util;

class JSON{

    public function getJSON($array){

        header("Content-Type:application/json; charset=UTF-8",true);    

        return html_entity_decode(json_encode($array));
        
    }

}