<?php

namespace App\Model;

class Passageiro {
    
    private $id;
    private $nome;
    private $email;
    private $cardId;
    private $password;
    private $createdAt;
    private $updatedAt;
    private $lastlogin;
    private $token;
    
    function __construct($id, $nome, $email, $cardId, $password, $token, $createdAt, $updatedAt, $lastlogin) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->cardId = $cardId;
        $this->token = $token;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->lastlogin = $lastlogin;
    }
    
    function getId() {
        return $this->id;
    }
    
    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getCardId() {
        return $this->cardId;
    }

    function getPassword() {
        return $this->password;
    }

    function getCreatedAt() {
        return $this->createdAt;
    }

    function getUpdatedAt() {
        return $this->updatedAt;
    }

    function getLastlogin() {
        return $this->lastlogin;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
    
    function setEmail($email) {
        $this->email = $email;
    }

    function setCardId($cardId) {
        $this->cardId = $cardId;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    function setLastlogin($lastlogin) {
        $this->lastlogin = $lastlogin;
    }
    
    function getToken(){
        return $this->token;
    }
    
    function setToken($token){
        $this->token = $token;
    }
}
