<?php

//include("model/DBManager.php");
include_once("model/DBManager.php");

class UsuarioFactory
{


    public function __construct(){

        $this->dbManager = new DBManager();

    }


    /**
     * Persiste objetos Contato no banco de dados.
     * @param Contato $obj - Objeto Contato a ser persistido.
     * @return boolean - se conseguiu salvar ou não.
     */


    //Função para cadastrar um novo usuario
    public function cadastrarUsuario($usuario){
        $query = "INSERT INTO usuario (nome,login, senha) VALUES ('"
            . $usuario->getNome() . "','"
            . $usuario->getLogin() . "','"
            . $usuario->getSenha() . "')";

        return $this->dbManager->cadastraUsuario($query);

    }

    //Seleciona os campos nome,login e senha de todos os usuarios cadastrados para gerar o relatario
    public function selecionaUsuarios(){
        $query = "SELECT nome, login, senha from usuario";
        
        return $this->dbManager->execSelect($query);

    }


    public function validaUsuario($usuario)
    {
        $dados = Array();
        $dados[0] = $usuario->getLogin();
        $dados[1] = $usuario->getSenha();
        
        return $this->dbManager->validarUsuario($dados,"SELECT idUsuario from usuario where login =? and senha =?");

    }

    public function listarUsuarios()
    {
        $query = "SELECT idUsuario, nome, login from usuario";
        
        return $this->dbManager->execSelect($query);

    }

    public function buscaInfoUsuarioDetalhe($idUsuario)
    {
        $query = "SELECT *  from usuario where idUsuario = '$idUsuario'";
        
        return $this->dbManager->execSelect($query);

    }

    public function alterarDados($usuario)
    {
        $idUsuario = $usuario->getIdUsuario();

        $query = "UPDATE usuario SET nome = '" . $usuario->getNome() . "',login = '" . $usuario->getLogin() . "',senha = '" . $usuario->getSenha() . "' where idUsuario = '$idUsuario'";
        
        return $this->dbManager->alterarDados($query);
        
    } 

    public function deletaUsuario($idUsuario){
        $query = "DELETE FROM usuario where idUsuario='$idUsuario'";
        
        return $this->dbManager->deletarRegistro($query);
        
    }

}
