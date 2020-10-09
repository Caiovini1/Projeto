<?php

class PessoaFisica extends Pessoa
{
    protected $idPessoa;
    protected $rg;
    protected $cpf;


    function __construct($idPessoa, $rg, $cpf)
    {
        $this->idPessoa = $idPessoa;
        $this->rg = $rg;
        $this->cpf = $cpf;
    }


    //Setters e Getters da classe PessoaFisica

    public function getIdPessoa(){
        return $this->idPessoa;
    }

    public function setIdPessoa($idPessoa){
        $this->idPessoa = $idPessoa;
    }

    public function getRg(){
        return $this->rg;
    }

    public function setRg($rg){
        $this->rg = $rg;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }
} 

?>