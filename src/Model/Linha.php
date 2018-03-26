<?php

namespace App\Model;

class Linha{
    
    private $id;
    private $code;
    private $origin;
    private $destination;

    function __construct($id, $code, $origin, $destination){
        $this->id = $id;
        $this->code = $code;
        $this->origin = $origin;
        $this->destination = $destination;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;

        return $this;
    }

    public function getCode(){
        return $this->code;
    }

    public function setCode($code){
        $this->code = $code;

        return $this;
    }

    public function getOrigin(){
        return $this->origin;
    }

    public function setOrigin($origin){
        $this->origin = $origin;

        return $this;
    }

    public function getDestination(){
        return $this->destination;
    }

    public function setDestination($destination){
        $this->destination = $destination;

        return $this;
    }

}