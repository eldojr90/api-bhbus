<?php

class debito{

    private $id;
    private $idCartao;
    private $codeLinha;
    private $valor;
    private $data;

    function __construct($id, $idCartao, $codeLinha, $valor,$data){
        $this->id = $id;
        $this->idCartao = $idCartao;
        $this->codeLinha = $codeLinha;
        $this->valor = $valor;
        $this->data = $data;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of idCartao
     */ 
    public function getIdCartao()
    {
        return $this->idCartao;
    }

    /**
     * Set the value of idCartao
     *
     * @return  self
     */ 
    public function setIdCartao($idCartao)
    {
        $this->idCartao = $idCartao;

        return $this;
    }

    /**
     * Get the value of codeLinha
     */ 
    public function getCodeLinha()
    {
        return $this->codeLinha;
    }

    /**
     * Set the value of codeLinha
     *
     * @return  self
     */ 
    public function setCodeLinha($codeLinha)
    {
        $this->codeLinha = $codeLinha;

        return $this;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
    
}