<?php

namespace App\Model\DAO;

use App\Aux\Connection,
    App\Model\Linha,
    PDO;

class LinhaDAO {
    
    private $connection;

    function __construct() {
        
        $this->connection = Connection::getConnection();
        
    }
    
    public function insert(Linha $l){
        
        $sql = "INSERT INTO linha (l_cod,l_org,l_dest) VALUES (?,?,?)";
        
        $code = $l->getCode();
        $origin = $l->getOrigin();
        $dest = $l->getDestination();
        
        
        $ps = $this->connection->prepare($sql);
        $ps->bindParam(1, $code);
        $ps->bindParam(2, $origin);
        $ps->bindParam(3, $dest);
        
        
        return $ps->execute();
    
    }
   
    public function verificaLinha($code){
        
        $sql = "select * from linha where l_cod = ?";
        
        $ps = $this->connection->prepare($sql);
        $ps->bindParam(1,$code);
        $ps->execute();

        return $ps->rowCount()==1;
        
    }

    public function findIdLinha($code){

        $id = -1;

        $sql = "select l_id from linha where l_cod = ?";

        $ps = $this->connection->prepare($sql);
        $ps->bindParam(1,$code);
        $ps->execute();
        
        if($ps->rowCount() == 1){
           $row = $ps->fetch(PDO::FETCH_OBJ);
           $id = $row->l_id;
        }    
        
        return $id;

    }

    
}