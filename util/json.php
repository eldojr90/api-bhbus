<?php

header("Content-Type:application/json; charset=UTF-8",true);

function getJSON($array){
    
    return html_entity_decode(json_encode($array));
    
}