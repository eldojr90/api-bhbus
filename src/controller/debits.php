<?php

require_once '../../vendor/autoload.php';

use App\Model\Debito,
    App\Model\DAO\DebitoDAO,
    App\Util\JSON;
    
$array_retorno;

if(isset($_GET["token"]) && isset($_GET["initialDate"]) && isset($_GET["finalDate"])){

    $dd = new debitoDAO();

    $token = $_GET["token"];
    $iniDate = $_GET["initialDate"];
    $finDate = $_GET["finalDate"];
    
    $array_retorno = $dd->listarDebitos($token,$iniDate,$finDate);
    

}else{

    $array_retorno = ["mensagem"=>"Informe corretamente os campos token, initialDate (DD/MM/AAAA) e finalDate (DD/MM/AAAA). (Método GET)"];

}

echo (new JSON)->getJSON($array_retorno);