<?php

class Usuario
{
    protected $idUsuario;
    protected $nome;
    protected $login;
    protected $senha;

    function __construct($login,$senha)
    {
        $this->login = $login;
        $this->senha = $senha;
    }


    //Setters e Getters da classe Pessoa

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getLogin(){
        return $this->login;
    }

    public function setLogin($login){
        $this->login = $login;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    } 
}
?>