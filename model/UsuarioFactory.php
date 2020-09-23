<?php

include("model/Conexao.php");

class UsuarioFactory
{


    public function __construct()
    {

    }


    /**
     * Persiste objetos Contato no banco de dados.
     * @param Contato $obj - Objeto Contato a ser persistido.
     * @return boolean - se conseguiu salvar ou não.
     */


    //Função para cadastrar um novo usuário
    public function cadastrarUsuario($obj){
        global $conexao;
        $usuario = $obj;

        try{
            $query = "INSERT INTO usuario (nome,login, senha) VALUES ('"
            . $usuario->getNome() . "','"
            . $usuario->getLogin() . "','"
            . $usuario->getSenha() . "')";

            if(mysqli_query($conexao,$query)){
                $idGerado = mysqli_insert_id($conexao);
                return true;
            }else
            return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    //Seleciona os campos nome,login e senha de todos os usuários cadastrados para gerar o relatório
    public function selecionaUsuarios(){
        global $conexao;
        $usuarios = array();

        try{
            $query = "SELECT nome, login, senha from usuario";
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



    public function validaUsuario($obj)
    {
        $usuario = $obj;
        global $conexao;

        try {
            $query = "SELECT idUsuario from usuario where login = '" . $usuario->getLogin() . "' AND senha = '" . $usuario->getSenha() . "'";
            $resultado = mysqli_query($conexao, $query);

            if ($resultado) {
                $usuario = mysqli_fetch_assoc($resultado);
            } else {
                $resultado = false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
        return $usuario;
    }

    public function listarUsuarios()
    {
        global $conexao;
        $usuarios = array();

        $query = "SELECT idUsuario, nome, login, senha from usuario ";

        try {
            $resultado = mysqli_query($conexao, $query);

            if (mysqli_num_rows($resultado) > 0) {
                $manifestacoes = mysqli_fetch_all($resultado);

                return $manifestacoes;
            } else
            return NULL;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }

    public function buscaInfoUsuarioDetalhe($idUsuario)
    {
        global $conexao;
        try {
            $query = "SELECT *  from usuario where idUsuario = '$idUsuario'";
            $resultado = mysqli_query($conexao, $query);

            if ($resultado) {
                $usuario = mysqli_fetch_object($resultado);
            } else {
                $resultado = false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
        return $usuario;
    }

    public function alterarDados($obj)
    {
        global $conexao;
        $usuario = $obj;
        $idUsuario = $usuario->getIdUsuario();

        $query = "UPDATE usuario SET nome = '" . $usuario->getNome() . "',login = '" . $usuario->getLogin() . "',senha = '" . $usuario->getSenha() . "' where idUsuario = '$idUsuario'";
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

    public function cadastrarPessoaFisica($obj){
        global $conexao;
        $usuario = $obj;

        try{
            $query = "INSERT INTO pessoa (idPessoa, telefone, email) VALUES ('"
            . $pessoa->getTelefone() . "','"
            . $pessoa->getEmail() . "')'";
            if(mysqli_query($conexao,$query)){
                $idGerado = mysqli_insert_id($conexao);
                return $idGerado;
            }else
            return false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $resultado = false;
        }
    }

    public function deletaUsuario($idUsuario){
        global $conexao;
        try{
            $query = "DELETE FROM usuario where idUsuario='$idUsuario'";

            if(mysqli_query($conexao,$query)){
                return true;
            } else{
                return false;
            }
        }catch (PDOException $exc){
            echo $exc->getMessage();
            return false;
        }
    }

}
