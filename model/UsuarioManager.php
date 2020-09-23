<?php
require_once("model/Usuario.php");
require_once("model/UsuarioFactory.php");

class UsuarioManager
{

	public function __construct(){
		$this->factory = new UsuarioFactory();
		
	}

	
	public function cadastrarUsuario($nome,$login, $senha){
		$usuario = new Usuario($login, $senha);
		$usuario->setNome($nome);
		return $this->factory->cadastrarUsuario($usuario);
	}

    public function selecionaUsuarios(){
        return $this->factory->selecionaUsuarios();
    }

	public function validarUsuario($login,$senha){
		$usuario = new Usuario($login,$senha);
		return $this->factory->validaUsuario($usuario);
	}

	public function listaUsuarios()
    {
        return $this->factory->listarUsuarios();
    }

    public function buscaInfoUsuarioDetalhe($idUsuario)
    {
        return $this->factory->buscaInfoUsuarioDetalhe($idUsuario);
    }

    public function alteraDados($idUsuario,$nomeAlterado, $loginAlterado, $senhaAlterada)
    {
        $usuario = new Usuario($loginAlterado, $senhaAlterada);
        $usuario->setNome($nomeAlterado);
        $usuario->setIdUsuario($idUsuario);

        return $this->factory->alterarDados($usuario);
    }

    public function deletarUsuario($idUsuario){
    	return $this->factory->deletaUsuario($idUsuario);
    }
}