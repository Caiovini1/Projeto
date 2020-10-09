<?php
require_once("model/Pessoa.php");
require_once("model/PessoaFisica.php");
require_once("model/PessoaJuridica.php");
require_once("model/PessoaFactory.php");

class PessoaManager
{

    public function __construct(){
        $this->factory = new PessoaFactory();
    }

    public function selecionaPessoas(){
        return $this->factory->selecionaPessoas();
    }


    public function cadastrarPessoa($razaoSocial, $nomeFantasia, $telefone, $email, $idEstadoCivil){
        $pessoa = new Pessoa($razaoSocial, $nomeFantasia, $telefone, $email, $idEstadoCivil );
        return $this->factory->cadastrarPessoa($pessoa);
        
    }

    public function cadastrarPessoaFisica($idGerado, $rg, $cpf){
        $pessoaF = new PessoaFisica($idGerado, $rg, $cpf);
        return $this->factory->cadastrarPessoaFisica($pessoaF);

    }

    public function listarPessoas()
    {
        return $this->factory->listarPessoas();
    }

    public function buscaInfoPessoaDetalhe($idPessoa){
        return $this->factory->buscaInfoPessoaDetalhe($idPessoa);
    }

    public function alteraDadosPF($idPessoa,$razaoSocial, $nomeFantasia, $telefone, $email, $idEstadoCivil, $rg, $cpf){
        $pessoaF = new PessoaFisica($idPessoa,$rg, $cpf);
        $pessoaF->setRazaoSocial($razaoSocial);
        $pessoaF->setNomeFantasia($nomeFantasia);
        $pessoaF->setTelefone($telefone);
        $pessoaF->setEmail($email);
        $pessoaF->setIdEstadoCivil($idEstadoCivil);
        return $this->factory->alteraDadosPessoaF($pessoaF);
        
    }

    public function alteraDadosPJ($idPessoa, $razaoSocial, $nomeFantasia, $telefone, $email, $idEstadoCivil, $cnpj){
        $pessoaJ = new PessoaJuridica($idPessoa,$cnpj);
        $pessoaJ->setRazaoSocial($razaoSocial);
        $pessoaJ->setNomeFantasia($nomeFantasia);
        $pessoaJ->setTelefone($telefone);
        $pessoaJ->setEmail($email);
        $pessoaJ->setIdEstadoCivil($idEstadoCivil);
        return $this->factory->alteraDadosPessoaJ($pessoaJ);
    }

    public function deletarPessoa($idPessoa){
        return $this->factory->deletarPessoa($idPessoa);
    }

    public function cadastrarPessoaJuridica($idGerado, $cnpj){
        $pessoaJ = new PessoaJuridica($idGerado, $cnpj);
        return $this->factory->cadastrarPessoaJuridica($pessoaJ);
    } 
    
}