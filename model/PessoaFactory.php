<?php

include("model/Conexao.php");

class PessoaFactory
{


    public function __construct()
    {

    }

    public function cadastrarPessoa($obj){
        global $conexao;
        $pessoa = $obj;

        try{

            //Query utilizada para inserir uma linha na tabela Pessoa
            $query = "INSERT INTO pessoa (razaoSocial, nomeFantasia, telefone, email, idEstadoCivil) VALUES ('"
            . $pessoa->getRazaoSocial() . "','"
            . $pessoa->getNomeFantasia() . "','"
            . $pessoa->getTelefone() . "','"
            . $pessoa->getEmail() . "','"
            . $pessoa->getIdEstadoCivil() . "')";

            $resultado = mysqli_query($conexao, $query);//Executa o comando SQL

            if($resultado){//Verifica se o comando SQL deu certo

                $idGerado = mysqli_insert_id($conexao);//Captura o id do Insert anterior para usar posteriormente

                if($idGerado){//Se existir ID, retorna o ID para uso posterior
                    return $idGerado;
                }
            }else{
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    public function cadastrarPessoaFisica($obj)
    {
        global $conexao;
        $pessoaf = $obj;

        try{

            //Query utilizada para inserir uma linha na tabela Pessoa Fisica
            $query = "INSERT INTO pessoafisica (idPessoa, RG, CPF) VALUES ("
            . $pessoaf->getIdPessoa() . ",'"
            . $pessoaf->getrg() . "','"
            . $pessoaf->getCpf() . "')";

            $resultado = mysqli_query($conexao, $query);//Executa o comando SQL

            if($resultado){//Verifica se o comando SQL deu certo
                return true;
            }else{
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    public function cadastrarPessoaJuridica($obj){
        global $conexao;
        $pessoaJ = $obj;

        try{

            //Query utilizada para inserir uma linha na tabela Pessoa Juridica
            $query = "INSERT INTO pessoajuridica (idPessoa, cnpj) VALUES ("
            . $pessoaJ->getIdPessoa() . ",'"
            . $pessoaJ->getCnpj() . "')";

            $resultado = mysqli_query($conexao, $query);//Executa o comando SQL

            if($resultado){
                return true;
            } else{
                return false;
            }
        }catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    //Função utilizada para listar as pessoas(fisicas e juridicas)
    public function listarPessoas(){
        global $conexao;
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

        try {
                $resultado = mysqli_query($conexao, $query);//Executa o comando SQL
                $resultado2 = mysqli_query($conexao, $query2);//Executa o comando SQL

                if (mysqli_num_rows($resultado) > 0) {//verifica se existe PF
                    $pf = mysqli_fetch_all($resultado);//Retira os dados do Object para um array
                }
                if(mysqli_num_rows($resultado2) > 0){//verifica se existe PJ
                    $pj = mysqli_fetch_all($resultado2);//Retira os dados do Object para um array
                }

                //Código utilizado para acrescentar uma posição no array PF, correspondente ao campo CNPJ, deixando-o zerado pois, por ser uma PF, não possui CNPJ

                if(isset($pf)){
                    for($i = 0; $i < sizeof($pf);$i++){
                        array_splice($pf[$i],3,0,'');
                    }
                }
                

                //Código utilizado para acrescentar duas posições  no array PJ, correspondentes aos campos RG e CPF, deixando-os zerados pois, por ser uma PJ, não possui RG e CPF

                if(isset($pj)){
                    for($i = 0; $i < sizeof($pj);$i++){
                        array_splice($pj[$i],1,0,'');
                        array_splice($pj[$i],1,0,'');
                    }
                }
                

                if(isset($pf) && isset($pj)){//Verifica se existem dados nos arrays PF e PJ
                    $pessoas = array_merge($pf,$pj);//Merge os arrays PF e PJ para um único array de pessoas

                } else if(isnotset(!$pf) && isset($pj)){//Verifica se só existe dado no array PJ
                    return $pj;

                } else if(isset($pf) && isnotset($pj)){//Verifica se só existe dado no array PF
                    return $pf;

                } else{//Caso não existam PF nem PJ
                    var_dump($pf);
                    return false;

                }

                return $pessoas;//Retorna o array de pessoas

            } catch (PDOException $exc) {
                echo $exc->getMessage();
                $result = false;
            }
        }


        public function buscaInfoPessoaDetalhe($idPessoa)
        {
            global $conexao;

            try {
            //Código utilizado para verificar se o iDPessoa é de uma Pessoa física
                $query = "SELECT pf.cpf from pessoa as p
                inner join pessoafisica as pf on ( p.idPessoa = pf.idPessoa)
                where p.idPessoa = $idPessoa";
                $resultado = mysqli_query($conexao,$query);
            $cpfCNPJ = mysqli_fetch_all($resultado);//Se não estiver vazio, significa que o idPessoa pertence a uma PF

            if ($cpfCNPJ) {

                //Código utilizado para selecionar as informações da Pessoa desejada
                $query = "SELECT p.idPessoa, p.razaoSocial, p.nomeFantasia, p.telefone, p.email, pf.cpf, pf.rg, p.idEstadoCivil, ec.descricao from pessoa as p
                inner join pessoafisica as pf on (p.idPessoa = pf.idPessoa)
                inner join estadocivil as ec on (p.idEstadoCivil = ec.id)
                where p.idPessoa = $idPessoa";
                $resultado = mysqli_query($conexao,$query);
                $pessoa = mysqli_fetch_all($resultado);

                array_push($pessoa[0], 0);//Adicion uma posição no final com valor 0 para indicar que é uma Pessoa Física

                return $pessoa;//Retorna um array com todos os dados da pessoa selecionada

            } else {
                //Código utilizado para verificar se o iDPessoa é de uma Pessoa Jurídica
                $query = "SELECT pj.cnpj from pessoa as p
                inner join pessoajuridica as pj on (pj.idPessoa = p.idPessoa)
                where p.idPessoa = $idPessoa";
                $resultado = mysqli_query($conexao,$query);
                $cpfCNPJ = mysqli_fetch_all($resultado);//Se não estiver vazio, significa que o idPessoa pertence a uma PJ

                if($cpfCNPJ){

                    //Código utilizado para selecionar as informações da Pessoa desejada
                    $query = "SELECT p.idPessoa, p.razaoSocial, p.nomeFantasia, p.telefone, p.email, pj.cnpj, p.idEstadoCivil, ec.descricao from pessoa as p
                    inner join pessoajuridica as pj on (p.idPessoa = pj.idPessoa)
                    inner join estadocivil as ec on (p.idEstadoCivil = ec.id)
                    where p.idPessoa = $idPessoa";
                    $resultado = mysqli_query($conexao,$query);
                    $pessoa = mysqli_fetch_all($resultado);


                    array_push($pessoa[0], 1);//Adicion uma posição no final com valor 1 para indicar que é uma Pessoa Jurídica

                    return $pessoa;//Retorna um array com todos os dados da pessoa selecionada
                } else{
                    return false;//Se a pessoa não for encontrada, retorna false
                }
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
        return $usuario;
    }

    //Função utilizada para alterar os dados da Pessoa Fisica(alterando também a tabela Pessoa)
    public function alteraDadosPessoaF($obj){

        global $conexao;
        $pessoa = $obj;
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


        try {

            if (mysqli_query($conexao, $query)) {
                return true;
            } else
            return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    //Função utilizada para alterar os dados da Pessoa Juridica(alterando também a tabela Pessoa)
    public function alteraDadosPessoaJ($obj){
        global $conexao;
        $pessoa = $obj;
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


        try {

            if (mysqli_query($conexao, $query)) {
                return true;
            } else
            return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    //Função utilizada para deletar uma pessoa específica
    public function deletarPessoa($idPessoa){
        global $conexao;

        try{
            $query = "DELETE FROM pessoa where idPessoa=$idPessoa";

            $resultado = mysqli_query($conexao,$query);
            if($resultado){
                return true;
            } else{
                return false;
            }
        }catch (PDOException $exc){
            echo $exc->getMessage();
            return false;
        }
    }

    //Função utilizada para retornar, de todas as pessoas, a Razão Social, nome Fantasia e Telefone para gerar o relatório
    public function selecionaPessoas(){
        global $conexao;
        $pessoas = array();

        try{
            $query = "SELECT razaoSocial, nomeFantasia, telefone from pessoa";
            $resultado = mysqli_query($conexao,$query);
            if($resultado){
                $pessoas = mysqli_fetch_all($resultado);
                return $pessoas;
            } else{
                return $pessoas;
            }
        }catch (PDOException $exc){
            echo $exc->getMessage();
            return false;
        }

    
}
}