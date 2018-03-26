<?php

namespace App\Model\DAO;

use App\Aux\Connection,
    App\Model\Passageiro,
    PDO;

class PassageiroDAO {
    
    private $connection;

    function __construct() {
        
        $this->connection = Connection::getConnection();
        
    }
    
    public function insert(Passageiro $p){
        
        $sql = "insert into passageiro "
                . "(p_nome, p_email, p_senha, p_token, c_id) "
                . "values (?,?,?,?,?)";
        
        $nome = $p->getNome();
        $email = $p->getEmail();
        $senha = $p->getPassword();
        $toekn = $p->getToken();
        $idCartao = $p->getCardId();
        
        $ps = $this->connection->prepare($sql);
        $ps->bindParam(1, $nome);
        $ps->bindParam(2, $email);
        $ps->bindParam(3, $senha);
        $ps->bindParam(4, $toekn);
        $ps->bindParam(5, $idCartao);
        
        return $ps->execute();
    
    }
   
    public function verificaCartao($idCartao){
        
        $sql = "select * from passageiro where c_id = ?";
        
        $ps = $this->connection->prepare($sql);
        $ps->bindParam(1,$idCartao);
        $ps->execute();
        
        return $ps->rowCount()==1;
        
    }

    public function verificaEmail($email){
        
        $sql = "select * from passageiro where p_email = ?;";
        
        $ps = $this->connection->prepare($sql);
        $ps->bindParam(1, $email);
        $ps->execute();
        
        return $ps->rowCount()==1;
        
    }
    
    public function findByEmail($email){
        
        $passageiro = null;
        
        $sql = "select * from passageiro where p_email = ?";
        
        $ps = $this->connection->prepare($sql);
        $ps->bindParam(1, $email);
        $ps->execute();
        
        if($ps->rowCount() == 1){
            
            $row = $ps->fetch(PDO::FETCH_OBJ);
            
            $passageiro = new Passageiro($row->p_id, $row->p_nome, $row->p_email, $row->c_id, $row->p_senha, $row->p_token, $row->p_createdAt, $row->p_updatedAt, $row->p_lastlogin);
            
        }
        
        return $passageiro;
    }

    public function validaToken($token){

        $validacao = false;

        $sql = "select p_id, p_nome, p_senha from passageiro;";

        $st = $this->connection->query($sql);

        while($row = $st->fetch(PDO::FETCH_OBJ)){

            if(strtoupper(md5($row->p_nome.":".$row->p_senha)) === $token){
                $validacao = true;
            }

        }

        return $validacao;

    }

    public function findIdByToken($token){

        $id = -1;

        $sql = "select p_id, p_email, p_senha from passageiro;";

        $st = $this->connection->query($sql);

        while($row = $st->fetch(PDO::FETCH_OBJ)){

            $tokenTest = strtoupper(md5($row->p_email.":".$row->p_senha));
        
            if($tokenTest == $token){
             
                $id = $row->p_id;
        
            }

        }

        return $id;

    }    
    
}
