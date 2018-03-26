<?php

require_once '../model/passageiro.php';
require_once '../dao/passageiroDAO.php';
require_once '../util/json.php';

$array_retorno;

if(isset($_GET["name"]) && isset($_GET["email"]) && isset($_GET["cardId"]) && isset($_GET["password"])){
    
    $nome = $_GET["name"];
    $email = $_GET["email"];
    $cardId = $_GET["cardId"];
    $senha = strtoupper(md5($_GET["password"]));
    $token = strtoupper(md5($email.":".$senha));
    
    $pd = new passageiroDAO();
    
    $p = new passageiro(NULL, $nome, $email, $cardId, $senha, $token, NULL, NULL, NULL);
    
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
            
            $array_retorno = ["mensagem"=>"Erro na inserção de novo passageiro."];
            
        }
    
    }

    
}else{
    
    $array_retorno = ["mensagem"=>"Informe corretamente os campos name, email, cardId e password. (Método GET)"];
    
}
 echo getJSON($array_retorno);
    
    
    
    
