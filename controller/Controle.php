<?php


require 'model/PessoaManager.php';
require 'model/EstadoCivilManager.php';
require 'model/UsuarioManager.php';
require_once 'dompdf/dompdf/autoload.inc.php';
use Dompdf\Dompdf;


class Controle {

    public function __construct(){

        $this->pessoaManager = new PessoaManager();
        $this->estadoCivilManager = new EstadoCivilManager();
        $this->usuarioManager = new UsuarioManager();
        $this->inicializador();

    }

    public function inicializador(){
        $f = isset($_GET['function']) ? $_GET['function'] : "default";
        session_start();
        if(isset($_SESSION['usuario'])){//Usado para verificar se a $_SESSION['usuario'] foi preenchida.

        switch ($f) {
            case 'gerarRelatorioPessoa':
            $this->gerarRelatorioPessoa();
            break;

            case 'gerarRelatorioUsuario':
            $this->gerarRelatorioUsuario();
            break;

            case 'pessoaFisicaAlteraDados':
            $this->pessoaFisicaAlteraDados();
            break;

            case 'listarPessoas':
            $this->listarPessoas();
            break;

            case 'deletarUsuario':
            $this->deletarUsuario();
            break;

            case 'deletarPessoa':
            $this->deletarPessoa();
            break;

            case 'listarUsuarios':
            $this->listarUsuarios();
            break;

            case 'cadastrarUsuarioAcao':
            $this->cadastrarUsuarioAcao();
            break;

            case 'cadastrarUsuario':
            $this->cadastrarUsuario();
            break;

            case 'cadastrarPessoa':
            $this->cadastrarPessoa();
            break;

            case 'cadastrarPessoaAcao':
            $this->cadastrarPessoaAcao();
            break;

            case 'usuarioAlteraDados':
            $this->usuarioAlteraDados();
            break;

            case 'detalharPessoa':
            $this->detalharPessoa();
            break;

            case 'detalharUsuario':
            $this->detalharUsuario();
            break;

            case 'deslogar':
            unset($_SESSION['usuario']);
            session_destroy();
            $this->inicial();
            break;

            case 'selecaoCpfCnpj':
            $this->selecaoCpfCnpj();
            break;

            case 'mostrarRelatorio':
            $this->mostrarRelatorio();
            break;

            case 'pessoaJuridicaAlteraDados':
            $this->pessoaJuridicaAlteraDados();
            break;

            default:
            $this->inicial();
            break;

        } 
    }   else {
        switch ($f) {
            case 'loginAcao':
            $this->loginAcao();
            break;

            case 'fazerLogin':
            $this->fazerLogin();
            break;

            default:
            $this->inicial();
            break;
        }
    }
    session_write_close();
}

    //Traz informações sobre uma pessoa específica selecionada
public function detalharPessoa(){
    $pessoa = $this->pessoaManager->buscaInfoPessoaDetalhe($_GET['idPessoa']);
    $listaEstadoCivil = $this->estadoCivilManager->listaEstadoCivil();
    require('view/detalhePessoa.php');
}

public function detalharPessoaErro($idPessoa){
    $pessoa = $this->pessoaManager->buscaInfoPessoaDetalhe($idPessoa);
    $listaEstadoCivil = $this->estadoCivilManager->listaEstadoCivil();
    require('view/detalhePessoa.php');
}

    //Gera o relatório de usuários
public function gerarRelatorioUsuario(){
    if(isset($_GET['html'])){
        $checkhtml = true;
    }

    $usuarios = $this->usuarioManager->selecionaUsuarios();


    $dompdf = new DOMPDF();
    $trtd = "";
    for($i = 0; $i <sizeof($usuarios);$i++){
        $trtd = $trtd .  "<tr>
        <td width='200'>" . $usuarios[$i][0] . "</td>
        <td width='200'>" . $usuarios[$i][1] . "</td>
        <td width='80'>" . $usuarios[$i][2] . "</td>
        </tr>";
    }
    $html = "
    <h1>Lista de usuários</h1>
    <table border='1'>
    <tr>
    <td style='font-weight:bold' >Nome</td>
    <td style='font-weight:bold' >Login</td>
    <td style='font-weight:bold' >Senha</td>
    </tr>
    ".$trtd."
    </table>";

    if($checkhtml){
        echo $html;
        return false;
    }

    $dompdf->load_html($html);
    $dompdf->set_paper('a4', 'portrait');
    $dompdf->render();
    $relatorio = ob_get_clean();
    if ( headers_sent()) {
        echo $relatorio; 
    }

    $dompdf->stream(
        "relatorioUsuarios.pdf",
        array("Attachment" => false)
    );
}

    //Gera o relatório de pessoas
public function gerarRelatorioPessoa(){

    if(isset($_GET['html'])){
        $checkhtml = true;
    }

    $pessoas = $this->pessoaManager->selecionaPessoas();


    $dompdf = new DOMPDF();
    $trtd = "";
    for($i = 0; $i <sizeof($pessoas);$i++){
        $trtd = $trtd .  "<tr>
        <td width='200'>" . $pessoas[$i][0] . "</td>
        <td width='200'>" . $pessoas[$i][1] . "</td>
        <td width='80'>" . $pessoas[$i][2] . "</td>
        </tr>";
    }
    $html = "
    <h1>Lista de pessoas</h1>
    <table border='1'>
    <tr>
    <td style='font-weight:bold' >Razão Social</td>
    <td style='font-weight:bold' >Nome Fantasia</td>
    <td style='font-weight:bold' >Telefone</td>
    </tr>
    ".$trtd."
    </table>";

    if($checkhtml){
        echo $html;
        return false;
    }

    $dompdf->load_html($html);
    $dompdf->set_paper('a4', 'portrait');
    $dompdf->render();
    $relatorio = ob_get_clean();
    if ( headers_sent()) {
        echo $relatorio; 
    }

    $dompdf->stream(
        "relatorioPessoas.pdf",
        array("Attachment" => false)
    );
}

    //Função utilizada para deletar uma pessoa
public function deletarPessoa(){
    $idPessoa = $_GET["idPessoa"];

    $retorno = $this->pessoaManager->deletarPEssoa($idPessoa);

    if($retorno){
        echo "<script type=\"text/javascript\">alert('A pessoa foi excluída com sucesso!');</script>";
        $this->listarPessoas();
    } else{
        echo "<script type=\"text/javascript\">alert('Não foi possível exlcuir esta pessoa');</script>";
    } 
}

public function pessoaFisicaAlteraDados(){
    if(isset($_POST['enviado'])){
        $idPessoa = $_POST['idPessoa'];
        $check = 0;
        $tamanho = 0;
        $razaoSocial = $_POST['razaoSocialPessoaAlteraDados'];
        $nomeFantasia = $_POST['nomeFantasiaAlteraDados'];
        $rg = $_POST['rgPessoaAlteraDados'];
        $cpf = $_POST['cpfPessoaAlteraDados'];
        $telefone = $_POST['telefonePessoaAlteraDados'];
        $email = $_POST['emailPessoaAlteraDados'];
        $idEstadoCivil = $_POST['idEstadoCivilAlteraDados'];
        
        if(empty($razaoSocial) || empty($nomeFantasia) || empty($rg) || empty($cpf) || empty($telefone) || empty($email) || empty($idEstadoCivil)){
            $check++;
        }
        if($check == 1){
            echo "<script type=\"text/javascript\">alert('Todos os campos são obrigatorios!');</script>";
            return false;
        }
        
        if(strlen($razaoSocial) > 130 ){
            echo "<script type=\"text/javascript\">alert('O campo razao social excedeu o limite de caracteres!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
            
        }
        
        if(strlen($nomeFantasia) > 130){
            echo "<script type=\"text/javascript\">alert('O campo Nome Fantasia excedeu o limite de caracteres!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }
        
        if(strlen($cpf) != 14){
            echo "<script type=\"text/javascript\">alert('CPF invalido!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }
        
        if(strlen($telefone) > 18){
            echo "<script type=\"text/javascript\">alert('Telefone invalido!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }
        
        if(strlen($email) > 200){
            echo "<script type=\"text/javascript\">alert('O campo E-mail excedeu o limite de caracteres!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        try {
            $this->pessoaManager->alteraDadosPF($idPessoa,$razaoSocial, $nomeFantasia, $telefone, $email, $idEstadoCivil, $rg, $cpf);
            echo "<script type=\"text/javascript\">alert('A pessoa foi alterada com sucesso!');</script>";
            $this->listarPessoas();
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }
    }
}

public function pessoaJuridicaAlteraDados(){
    if(isset($_POST['enviado'])){
        $idPessoa = $_POST['idPessoa'];
        $razaoSocial = $_POST['razaoSocialPessoaAlteraDados'];
        $nomeFantasia = $_POST['nomeFantasiaAlteraDados'];
        $cnpj = $_POST['cnpjPessoaAlteraDados'];
        var_dump($_POST['cnpjPessoaAlteraDados']);
        $telefone = $_POST['telefonePessoaAlteraDados'];
        $email = $_POST['emailPessoaAlteraDados'];
        $idEstadoCivil = $_POST['idEstadoCivilAlteraDados'];

        try {
            $this->pessoaManager->alteraDadosPJ($idPessoa,$razaoSocial, $nomeFantasia, $telefone, $email, $idEstadoCivil, $cnpj);
           echo "<script type=\"text/javascript\">alert('A pessoa foi alterada com sucesso!');</script>";
           $this->listarPessoas();
       } catch (Exception $e) {
           $msg = $e->getMessage();
       }
   }
}

    //Função chamada para listar todos os usuários do sistema
public function listarUsuarios(){
    $dados = $this->usuarioManager->listaUsuarios();
    require('view/listarUsuarios.php');
}

    //Função chamada para listar todas as pessoas do sistema
public function listarPessoas(){
    $dados = $this->pessoaManager->listarPessoas();
    require('view/listarPessoas.php');
}

    //traz informações sobre um usuário específico selecionado    
public function detalharUsuario()
{
    $usuario = $this->usuarioManager->buscaInfoUsuarioDetalhe($_GET['idUsuario']);
    require('view/detalheUsuario.php');
}

    //Função chamada para enviar o usuário para a página inicial
public function inicial(){
    require('view/homePage.php');
}

    //Função utilizada para enviar o usuário para a página inicil(que contém o login) ao clicar no botão Login
public function loginAcao(){
    require('view/homePage.php');
}

    //Função utilizada para enviar o usuário para a página que possibilita cadastrar uma Pessoa Física ou Jurídica
public function cadastrarPessoaAcao(){
    $listaEstadoCivil = $this->estadoCivilManager->listaEstadoCivil();
    require('view/cadastrar.php');
}

    //Função primária utilizada para verificar se o cadastro é de Pessoa Física ou Jurídica

    //Função para realizar o login
public function fazerLogin(){   
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    $usuario = $this->usuarioManager->validarUsuario($login,$senha);
    $_SESSION['usuario'] = $usuario;
    if($_SESSION['usuario']['idUsuario']){
        session_write_close(); 
        require('view/homePage.php');

    } else{
        $msgLogin = true;
        require('view/homePage.php');
    }

}    

    //Função para cadastrar uma pessoa no sistema
public function cadastrarPessoa(){
    if (isset($_POST['enviado'])){
        
        var_dump($_POST);
        
        if(empty ($_POST['cpfCadastro']) && empty($_POST['cnpjCadastro'])){
            echo "<script type=\"text/javascript\">alert(\"Existem campos em branco!\");</script>";            
            require("view/cadastrar.php");
        } else if(isset($_POST['cpfCadastro'])){
            $cpfCadastro = $_POST['cpfCadastro'];
            $rgCadastro = $_POST['rgCadastro'];
            
        } else if(isset($_POST['cnpjCadastro'])){
            $cnpjCadastro = $_POST['cnpjCadastro'];
                        
        }
        unset($_POST['cpfCadastro']);
        unset($_POST['rgCadastro']);
        unset($_POST['cnpjCadastro']);
        echo "aaaa \n ";
        var_dump($_POST);
        //Código para validar campos em branco
        $erro = false;
        $i = 0;
                // Cria uma variável com cada indice do $_POST
        foreach ( $_POST as $chave => $valor ) {
            $pessoa[$i] = $_POST[$chave];
                // Verifica se tem algum valor em branco
            if ( empty ( $valor ) ) {

                $erro = true;
            }
            $i++;
        }
        if($erro){
            echo "<script type=\"text/javascript\">alert(\"Existem campos em branco!\");</script>";            
            require("view/cadastrar.php");

        } else{
            $razaoSocial = $_POST['razaoSocialCadastro'];
            $idEstadoCivil = $_POST ['estadoCivilCadastro'];
            $nomeFantasia = $_POST['nomeFantasiaCadastro'];
            $telefoneCadastro = $_POST['telefoneCadastro'];
            $emailCadastro = $_POST['emailCadastro'];

            if(isset($cpfCadastro)){
                try{
                    $idGerado = $this->pessoaManager->cadastrarPessoa($razaoSocial, $nomeFantasia, $telefoneCadastro, $emailCadastro, $idEstadoCivil);
                    if($idGerado != null){
                        $result = $this->pessoaManager->cadastrarPessoaFisica($idGerado, $rgCadastro, $cpfCadastro);
                        if($result){
                            echo "<script type=\"text/javascript\">alert(\"Pessoa cadastrada com sucesso.\");</script>";
                            $this->inicial();
                        } else{
                            echo "<script type=\"text/javascript\">alert(\"Pessoa não cadastrada.\");</script>";
                        }
                    }

                }catch (Excetpion $e) {
                    $msg = $e->getMessage();
                }
            } else if(isset ($cnpjCadastro)){
                try{
                    $idGerado = $this->pessoaManager->cadastrarPessoa($razaoSocial, $nomeFantasia, $telefoneCadastro, $emailCadastro, $idEstadoCivil);
                    if($idGerado != null){
                        $result = $this->pessoaManager->cadastrarPessoaJuridica($idGerado, $cnpjCadastro);
                        if($result){
                            echo "<script type=\"text/javascript\">alert(\"Pessoa cadastrada com sucesso.\");</script>";
                            $this->inicial();
                        } else{
                            echo "<script type=\"text/javascript\">alert(\"Pessoa não cadastrada.\");</script>";
                        }
                    }

                }catch (Excetpion $e) {
                    $msg = $e->getMessage();
                }
            }
        }
    }
}

//Função para alterar dados de um usuário
public function usuarioAlteraDados(){
    if (isset($_POST['enviado'])) {
        $idUsuario = $_POST['idUsuario'];
        $nomeAlterado = $_POST['nomeAlteraDados'];
        $loginAlterado = $_POST['loginAlteraDados'];
        $senhaAlterada = $_POST['senhaAlteraDados'];
        try {
            $this->usuarioManager->alteraDados($idUsuario,$nomeAlterado, $loginAlterado, $senhaAlterada);
            echo "<script type=\"text/javascript\">alert('O usuário foi alterado com sucesso!');</script>";
            $this->listarUsuarios();
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }

    }


}

//Função para enviar o usuário ao formulário de cadastro ao clicar no botão Cadastrar novo usuário
public function cadastrarUsuarioAcao(){
    require('view/cadastrarUsuario.php');
}

//Função para deletar um usuário
public function deletarUsuario(){
    $idUsuario = $_GET["idUsuario"];

    $retorno = $this->usuarioManager->deletarUsuario($idUsuario);

    if($retorno){
        echo "<script type=\"text/javascript\">alert('O usuário foi excluído com sucesso!');</script>";
        $this->listarUsuarios();
    } else{
        echo "<script type=\"text/javascript\">alert('Não foi possível exlcuir este usuário');</script>";
    }   
}

//Função que cadastra um usuário
public function cadastrarUsuario(){
    if(isset($_POST['enviado'])){
        $login = $_POST['loginUsuarioCadastro'];
        $nome = $_POST['nomeUsuarioCadastro'];
        $senha = $_POST['senhaUsuarioCadastro'];

        $retorno = $this->usuarioManager->cadastrarUsuario($nome, $login, $senha);
        if($retorno){
            echo "<script type=\"text/javascript\">alert('O usuário foi cadastrado com sucesso!');</script>";
            $this->listarUsuarios();
        } else{
            echo "<script type=\"text/javascript\">alert('Não foi possível cadastrar este usuário');</script>";
        }  
    }
}
}