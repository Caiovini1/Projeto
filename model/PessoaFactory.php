<?php

//include("model/DBManager.php");
include_once("model/DBManager.php");


class PessoaFactory{


    public function __construct(){

        $this->dbManager = new DBManager();

    }

    public function cadastrarPessoa($pessoa){

        //Query utilizada para inserir uma linha na tabela Pessoa
        $query = "INSERT INTO pessoa (razaoSocial, nomeFantasia, telefone, email, idEstadoCivil) VALUES ('"
        . $pessoa->getRazaoSocial() . "','"
        . $pessoa->getNomeFantasia() . "','"
        . $pessoa->getTelefone() . "','"
        . $pessoa->getEmail() . "','"
        . $pessoa->getIdEstadoCivil() . "')";


        return $this->dbManager->cadastrarPessoa($query);
        
    }

    public function cadastrarPessoaFisica($pessoaf){
        //Query utilizada para inserir uma linha na tabela Pessoa Fisica
        $query = "INSERT INTO pessoafisica (idPessoa, RG, CPF) VALUES ("
        . $pessoaf->getIdPessoa() . ",'"
        . $pessoaf->getrg() . "','"
        . $pessoaf->getCpf() . "')";

        return $this->dbManager->cadastrarPessoaFisica($query);

    }

    public function cadastrarPessoaJuridica($pessoaJ){

        //Query utilizada para inserir uma linha na tabela Pessoa Juridica
        $query = "INSERT INTO pessoajuridica (idPessoa, cnpj) VALUES ("
        . $pessoaJ->getIdPessoa() . ",'"
        . $pessoaJ->getCnpj() . "')";

        return $this->dbManager->cadastrarPessoaJuridica($query);

    }

    //Função utilizada para listar as pessoas(fisicas e juridicas)
    public function listarPessoas(){
        $pessoas = array();
        $pf = array();
        $pj = array();

        //Query utilizada para selecionar as PF
        $query = "SELECT p.IdPessoa, pf.rg, pf.cpf, p.razaoSocial, p.nomefantasia, p.telefone, p.email, ec.descricao
        from pessoa as p  
        inner join pessoafisica as pf on (p.idPessoa = pf.idPessoa) 
        inner join estadocivil as ec on(p.idestadocivil = ec.id)
        ";

        //Query utilizada para selecionar as PJ
        $query2 = "SELECT p.IdPessoa, pj.cnpj, p.razaoSocial, p.nomefantasia, p.telefone, p.email, ec.descricao
        from pessoa as p   
        inner join pessoajuridica as pj on(p.idPessoa = pj.idPessoa) 
        inner join estadocivil as ec on(p.idestadocivil = ec.id)";

        $pf = $this->dbManager->execSelect($query);
        $pj = $this->dbManager->execSelect($query2);

        //error_log("Pessoa Física = " . print_r($pf,true) . "\n");
        //error_log("Pessoa Jurídica = " . print_r($pj,true) . "\n");

        //Código utilizado para acrescentar uma posição no array PF, correspondente ao campo CNPJ, deixando-o zerado pois, por ser uma PF, não possui CNPJ

        if(!empty($pf)){
            for($i = 0; $i < sizeof($pf);$i++){
                array_splice($pf[$i],5,0,'');
            }
        }      

        //Código utilizado para acrescentar duas posições  no array PJ, correspondentes aos campos RG e CPF, deixando-os zerados pois, por ser uma PJ, não possui RG e CPF

        if(!empty($pj)){
            for($i = 0; $i < sizeof($pj);$i++){
                array_splice($pj[$i],1,0,'');
                array_splice($pj[$i],1,0,'');
            }
        }


        if(!empty($pf) && !empty($pj)){//Verifica se existem dados nos arrays PF e PJ
            $pessoas = array_merge($pf,$pj);//Merge os arrays PF e PJ para um único array de pessoas
            //echo "1";
            return $pessoas;//Retorna o array de pessoas

        } else if(empty($pf) && !empty($pj)){//Verifica se só existe dado no array PJ
            //echo "2";
            return $pj;

        } else if(!empty($pf) && empty($pj)){//Verifica se só existe dado no array PF
            //echo "3";
            return $pf;

        } else{//Caso não existam PF nem PJ
            //echo "4";
            return false;

        }
    }


    public function buscaInfoPessoaDetalhe($idPessoa){
            //Código utilizado para verificar se o iDPessoa é de uma Pessoa física
        $query = "SELECT pf.cpf from pessoa as p
        inner join pessoafisica as pf on ( p.idPessoa = pf.idPessoa)
        where p.idPessoa = $idPessoa";

        $cpfCNPJ = $this->dbManager->execSelect($query);

            if (strlen($cpfCNPJ[0][0]) > 0) { //Se não estiver vazio, significa que o idPessoa pertence a uma PF

                //Código utilizado para selecionar as informações da Pessoa desejada
                $query = "SELECT p.idPessoa, p.razaoSocial, p.nomeFantasia, p.telefone, p.email, pf.cpf, pf.rg, p.idEstadoCivil, ec.descricao from pessoa as p
                inner join pessoafisica as pf on (p.idPessoa = pf.idPessoa)
                inner join estadocivil as ec on (p.idEstadoCivil = ec.id)
                where p.idPessoa = $idPessoa";

                $pessoa = $this->dbManager->execSelect($query);

                array_push($pessoa[0], 0);//Adicion uma posição no final com valor 0 para indicar que é uma Pessoa Física

                return $pessoa;//Retorna um array com todos os dados da pessoa selecionada

            } else {

                //Código utilizado para verificar se o iDPessoa é de uma Pessoa Jurídica
                $query = "SELECT pj.cnpj from pessoa as p
                inner join pessoajuridica as pj on (pj.idPessoa = p.idPessoa)
                where p.idPessoa = $idPessoa";

                $cpfCNPJ = $this->dbManager->execSelect($query);

                if(strlen($cpfCNPJ[0][0]) > 0){ //Se não estiver vazio, significa que o idPessoa pertence a uma PJ

                    //Código utilizado para selecionar as informações da Pessoa desejada
                    $query = "SELECT p.idPessoa, p.razaoSocial, p.nomeFantasia, p.telefone, p.email, pj.cnpj, p.idEstadoCivil, ec.descricao from pessoa as p
                    inner join pessoajuridica as pj on (p.idPessoa = pj.idPessoa)
                    inner join estadocivil as ec on (p.idEstadoCivil = ec.id)
                    where p.idPessoa = $idPessoa";

                    $pessoa = $this->dbManager->execSelect($query);          

                    array_push($pessoa[0], 1);//Adicion uma posição no final com valor 1 para indicar que é uma Pessoa Jurídica

                    return $pessoa;//Retorna um array com todos os dados da pessoa selecionada
                } else{
                    return false;//Se a pessoa não for encontrada, retorna false
                }
            }
        }

    //Função utilizada para alterar os dados da Pessoa Fisica(alterando também a tabela Pessoa)
        public function alteraDadosPessoaF($pessoa){
            $idPessoa = $pessoa->getIdPessoa();

            $query = "UPDATE pessoa p

            INNER JOIN pessoafisica as pf 
            ON p.idPessoa = pf.idPessoa 

            SET 
            p.razaoSocial = '" . $pessoa->getRazaoSocial() ."',
            p.nomeFantasia = '" . $pessoa->getNomeFantasia() . "',
            p.telefone = '" . $pessoa->getTelefone() . "',
            p.email = '" . $pessoa->getEmail() . "',
            p.idEstadoCivil = '" . $pessoa->getIdEstadoCivil() . "',
            pf.rg = '" . $pessoa->getRg() . "',
            pf.cpf = '" . $pessoa->getCpf() . "'

            where p.IdPessoa = $idPessoa"; 


            return $this->dbManager->alterarDados($query);

        }

    //Função utilizada para alterar os dados da Pessoa Juridica(alterando também a tabela Pessoa)
        public function alteraDadosPessoaJ($pessoa){
            $idPessoa = $pessoa->getIdPessoa();

            $query = "UPDATE pessoa p

            INNER JOIN pessoajuridica as pj 
            ON p.idPessoa = pj.idPessoa 

            SET 
            p.razaoSocial = '" . $pessoa->getRazaoSocial() ."',
            p.nomeFantasia = '" . $pessoa->getNomeFantasia() . "',
            p.telefone = '" . $pessoa->getTelefone() . "',
            p.email = '" . $pessoa->getEmail() . "',
            p.idEstadoCivil = '" . $pessoa->getIdEstadoCivil() . "',
            pj.cnpj = '" . $pessoa->getCnpj() . "'

            where p.IdPessoa = $idPessoa"; 


            return $this->dbManager->alterarDados($query);

        } 

    //Função utilizada para deletar uma pessoa específica
        public function deletarPessoa($idPessoa){

            $query = "DELETE FROM pessoa where idPessoa=$idPessoa";

            return $this->dbManager->deletarRegistro($query);

        }

    //Função utilizada para retornar, de todas as pessoas, a Razão Social, nome Fantasia e Telefone para gerar o relatório
        public function selecionaPessoas(){
            global $conexao;

            $query = "SELECT razaoSocial, nomeFantasia, telefone from pessoa";

            return $this->dbManager->execSelect($query);

        }
    }