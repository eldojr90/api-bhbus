<?php

require_once '../dao/debitoDAO.php';
require_once '../model/debito.php';
require_once '../util/json.php';

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

echo getJSON($array_retorno);