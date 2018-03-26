<?php

require_once '../../vendor/autoload.php';

use App\Model\Passageiro,
    App\Model\DAO\PassageiroDAO,
    App\Util\JSON;

$array_retorno;

if(isset($_GET["name"]) && isset($_GET["email"]) && isset($_GET["cardId"]) && isset($_GET["password"])){
    
    $nome = $_GET["name"];
    $email = $_GET["email"];
    $cardId = $_GET["cardId"];
    $senha = strtoupper(md5($_GET["password"]));
    $token = strtoupper(md5($email.":".$senha));
    
    $p = new Passageiro(NULL, $nome, $email, $cardId, $senha, $token, NULL, NULL, NULL);
    
    $pd = new PassageiroDAO();

    if($pd->verificaEmail($email)){
        
        $array_retorno = ["mensagem"=>"E-mail já existente!"];
        
    }elseif($pd->verificaCartao($cardId)){
        
        $array_retorno = ["mensagem"=>"Cartão já existente!"];
        
    }else{ 
        
        if($pd->insert($p)){
            
            $prt = $pd->findByEmail($email);
            
            $array_retorno = [
                "id"=>$prt->getId(),
                "createdAt"=>$prt->getCreatedAt(),
                "updatedAt"=>$prt->getUpdatedAt(),
                "lastLogin"=>$prt->getLastlogin(),
                "token"=>$prt->getToken()
            ];
            
        }else{
            
            $array_retorno = ["mensagem"=>"Erro na inserção de novo Passageiro."];
            
        }
    
    }
    
    
}else{
    
    $array_retorno = ["mensagem"=>"Informe corretamente os campos name, email, cardId e password. (Método GET)"];

}

echo (new JSON())->getJSON($array_retorno);
    
    
    
    
