<?php

include("model/Conexao.php");

class DBManager {

    //protected $conexao;


    public function execSelect($query) {
        global $conexao;

        $dados = array();
        //error_log(print_r($query,true));
        try {
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                $i = 0;
                while ($i < mysqli_num_rows($resultado)) {
                    $dados[$i] = mysqli_fetch_array($resultado);
                    $i = $i + 1;
                }
                return $dados;
            } else
                return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }

    public function validarUsuario($dados, $query) {
        global $conexao;
        try {
            $stmt = mysqli_prepare($conexao, $query);
            $stmt->bind_param("ss", $dados[0], $dados[1]);
            $stmt->execute();
            $stmt->bind_result($idUsuario);
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->fetch();
                //echo $idUsuario;
                return $idUsuario;
            } else {
                return 0;
            }
        } catch (Exception $ex) {
            
        }
    }

    public function cadastraUsuario($query) {
        global $conexao;
        
        try {
            if (mysqli_query($conexao, $query)) {
                return true;
            } else
                return false;
        } catch (Exception $ex) {
            
        }
    }

    public function alterarDados($query) {
        global $conexao;

        try {
            if (mysqli_query($conexao, $query)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    public function deletarRegistro($query) {
        global $conexao;

        try {
            if (mysqli_query($conexao,$query)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    } 



    public function cadastrarPessoa($query){
        global $conexao;

        try{

            $resultado = mysqli_query($conexao, $query);//Executa o comando SQL

            if($resultado){//Verifica se o comando SQL deu certo

                $idGerado = mysqli_insert_id($conexao);//Captura o id do Insert anterior para usar posteriormente

                if($idGerado){//Se existir ID, retorna o ID para uso posterior
                    return $idGerado;
                } else{
                    return false;
                }
            }else{
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    public function cadastrarPessoaFisica($query){
        global $conexao;

        try{            

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

    public function cadastrarPessoaJuridica($query){
        global $conexao;


        error_log(print_r($query,true));
        try{

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
}

?>