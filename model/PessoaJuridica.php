<?php

class PessoaJuridica extends Pessoa
{
    protected $idPessoa;
    protected $cnpj;

    function __construct($idPessoa, $cnpj)
    {
        $this->idPessoa = $idPessoa;
        $this->cnpj = $cnpj;
    }


    //Setters e Getters da classe PessoaJuridica

    public function getIdPessoa(){
        return $this->idPessoa;
    }

    public function setIdGerado($idPessoa){
        $this->idGerado = $idGerado;
    }

    public function getCnpj(){
        return $this->cnpj;
    }

    public function setCnpj($cnpj){
        $this->cnpj = $cnpj;
    }

}

?>