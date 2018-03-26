<?php

require_once '../aux/db.php';
require_once '../model/debito.php';
require_once 'passageiroDAO.php';

class debitoDAO{

    private $connection;
    private $pd; 

    function __construct(){
        $this->connection = getConnection();
        $this->pd = new passageiroDAO();
    }

    public function insert(debito $d){

        $sql = "INSERT INTO debito(c_id,l_id,d_val) 
        VALUES (?,(select l_id from linha where l_cod = ?), ?);";

        $idCartao = $d->getIdCartao();
        $codeLinha = $d->getCodeLinha();
        $valor = $d->getValor();

        $ps = $this->connection->prepare($sql);
        $ps->bindParam(1,$idCartao);
        $ps->bindParam(2,$codeLinha);
        $ps->bindParam(3,$valor);

        return $ps->execute();

    }

    public function validaLimite($idCartao){

        $sql = "select count(*) total from debito 
        where c_id = ? and 
        date_format(d_data,'%d/%m/%y') = date_format(current_date,'%d/%m/%y');";

        $ps = $this->connection->prepare($sql);
        $ps->bindParam(1,$idCartao);
        $ps->execute();

        $row = $ps->fetch(PDO::FETCH_OBJ);

        return $row->total < 6;

    }

    public function validaDesconto($idCartao,$codeLinha){

        $sql = "select (current_timestamp - 
                    (select d_data from debito where c_id = ? and 
                        d_id = (select max(d_id) from debito where c_id = ? and
                            (select l_id from linha where l_cod = ?) <> 
                            (select l_id from debito where d_id = (select max(d_id) from debito where c_id = ?)))))
                /100 tempo;";

        $ps = $this->connection->prepare($sql);
        $ps->bindParam(1,$idCartao);
        $ps->bindParam(2,$idCartao);
        $ps->bindParam(3,$codeLinha);
        $ps->bindParam(4,$idCartao);
        $ps->execute();

        $row = $ps->fetch(PDO::FETCH_OBJ);

        $tempo = isset($row->tempo)?$row->tempo:100;

        return  $tempo <= 60;

    }
    
    public function InsertIdLast(){

        return $this->connection->lastInsertId();

    }

    public function listarDebitos($token, $dataInicio, $dataFim){

        $idCartao = $this->pd->findIdByToken($token);

        $debitosList = [];
        
        $sql = "select d_id, d_data, d_val from debito where c_id = ? and 
                d_data between str_to_date(?,'%d/%m/%Y') and 
                str_to_date(?,'%d/%m/%Y');";

        $ps = $this->connection->prepare($sql);
        $ps->bindParam(1,$idCartao);
        $ps->bindParam(2,$dataInicio);
        $ps->bindParam(3,$dataFim);

        $ps->execute();

        while($row = $ps->fetch(PDO::FETCH_OBJ)){

            $debito = [
                "id"=>$row->d_id,
                "debitedAt"=>$row->d_data,
                "value"=>number_format($row->d_val, 2, ',', '.')
            ];
            
            array_push($debitosList,$debito);

        }

        
        return $debitosList;

    }

}