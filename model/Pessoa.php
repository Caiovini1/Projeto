<?php

class Pessoa
{
    protected $idPessoa;
    protected $razaoSocial;
    protected $nomeFantasia;
    protected $telefone;
    protected $email;
    protected $idEstadoCivil;

    function __construct($razaoSocial, $nomeFantasia, $telefone, $email, $idEstadoCivil)
    {
        $this->razaoSocial = $razaoSocial;
        $this->nomeFantasia = $nomeFantasia;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->idEstadoCivil = $idEstadoCivil;
    }


    //Setters e Getters da classe Pessoa

        public function getIdPessoa(){
        return $this->idPessoa;
    }

    public function setIdPessoa($idPessoa){
        $this->idPessoa = $idPessoa;
    }

    public function getRazaoSocial(){
        return $this->razaoSocial;
    }

    public function setRazaoSocial($razaoSocial){
        $this->razaoSocial = $razaoSocial;
    }

    public function getNomeFantasia(){
        return $this->nomeFantasia;
    }

    public function setNomeFantasia($nomeFantasia){
        $this->nomeFantasia = $nomeFantasia;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getIdEstadoCivil(){
        return $this->idEstadoCivil;
    }

    public function setIdEstadoCivil($idEstadoCivil){
        $this->idEstadoCivil = $idEstadoCivil;
    }
}
?>