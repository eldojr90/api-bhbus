<?php

require_once '../../vendor/autoload.php';

use App\Model\Debito,
    App\Model\DAO\DebitoDAO,
    App\Model\DAO\LinhaDAO,
    App\Model\DAO\PassageiroDAO,
    App\Util\JSON;

$array_retorno;

if(isset($_GET["token"]) && isset($_GET["codLin"]) && isset($_GET["val"])){

    $dd = new debitoDAO();
    $pd = new passageiroDAO();
    $ld = new linhaDAO();

    $token = $_GET["token"];
    $codLin = $_GET["codLin"];
    $val = $_GET["val"];
    
    $cardId = $pd->findIdByToken($token);

    if($dd->validaLimite($cardId)){

        if($dd->validaDesconto($cardId,$codLin)){

            $val = $val * 0.5;

        }

        $d = new debito(null,$cardId, $codLin, $val,null);

        if($ld->verificaLinha($codLin)){

            if($dd->insert($d)){

                $id = $dd->InsertIdLast();

                $array_retorno = ["id"=>$id];

            }else{
                
                $array_retorno = ["mensagem"=>"Erro na inserção do débito."];    

            }
        
        }else{

            $array_retorno = ["mensagem"=>"Linha inexistente."];    

        }    
    
    }else{

        $array_retorno = ["mensagem"=>"Limite de passagens/dia atingido!"];

    }

}else{

    $array_retorno = ["mensagem"=>"Informe corretamente os campos token, codLin e val. (Método GET)"];

}

echo (new JSON)->getJSON($array_retorno);