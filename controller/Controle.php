<?php

require 'model/PessoaManager.php';
require 'model/EstadoCivilManager.php';
require 'model/UsuarioManager.php';
require_once 'dompdf/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Controle {

    public function __construct() {

        $this->pessoaManager = new PessoaManager();
        $this->estadoCivilManager = new EstadoCivilManager();
        $this->usuarioManager = new UsuarioManager();
        $this->inicializador();
    }

    public function inicializador() {
        $f = isset($_GET['function']) ? $_GET['function'] : "default";
        session_start();
        if (isset($_SESSION['usuario'])) {//Usado para verificar se a $_SESSION['usuario'] foi preenchida.
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
    } else {
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
public function detalharPessoa() {
        //$listaEstadoCivil = array();
    $pessoa = $this->pessoaManager->buscaInfoPessoaDetalhe($_GET['idPessoa']);
    $listaEstadoCivil = $this->estadoCivilManager->listaEstadoCivil();

    require('view/detalhePessoa.php');
}

public function detalharPessoaErro($idPessoa) {
    $pessoa = $this->pessoaManager->buscaInfoPessoaDetalhe($idPessoa);
    $listaEstadoCivil = $this->estadoCivilManager->listaEstadoCivil();

    require('view/detalhePessoa.php');
}

    //Gera o relatório de usuários
public function gerarRelatorioUsuario() {
    if (isset($_GET['html'])) {
        $checkhtml = true;
    }

    $usuarios = $this->usuarioManager->selecionaUsuarios();

    $dompdf = new DOMPDF();

    if(empty($usuarios)){
        $html = "Nenhum registro encontrado!";
        $dompdf->load_html($html);
        $dompdf->set_paper('a4', 'portrait');
        $dompdf->render();
        $relatorio = ob_get_clean();
        if (headers_sent()) {
            echo $relatorio;
        }

        $dompdf->stream(
            "relatorioUsuarios.pdf",
            array("Attachment" => false)
        );
    }



    $trtd = "";
    for ($i = 0; $i < sizeof($usuarios); $i++) {
        $trtd = $trtd . "<tr>
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
    " . $trtd . "
    </table>";

    if ($checkhtml) {
        echo $html;
        return false;
    }

    $dompdf->load_html($html);
    $dompdf->set_paper('a4', 'portrait');
    $dompdf->render();
    $relatorio = ob_get_clean();
    if (headers_sent()) {
        echo $relatorio;
    }

    $dompdf->stream(
        "relatorioUsuarios.pdf",
        array("Attachment" => false)
    );
}

    //Gera o relatório de pessoas
public function gerarRelatorioPessoa() {

    if (isset($_GET['html'])) {
        $checkhtml = true;
    }

    $pessoas = $this->pessoaManager->selecionaPessoas();


    $dompdf = new DOMPDF();

    if(empty($pessoas)){
        $html = "Nenhum registro encontrado!";
        $dompdf->load_html($html);
        $dompdf->set_paper('a4', 'portrait');
        $dompdf->render();
        $relatorio = ob_get_clean();
        if (headers_sent()) {
            echo $relatorio;
        }

        $dompdf->stream(
            "relatorioUsuarios.pdf",
            array("Attachment" => false)
        );
    }
    $trtd = "";
    for ($i = 0; $i < sizeof($pessoas); $i++) {
        $trtd = $trtd . "<tr>
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
    " . $trtd . "
    </table>";

    if ($checkhtml) {
        echo $html;
        return false;
    }

    $dompdf->load_html($html);
    $dompdf->set_paper('a4', 'portrait');
    $dompdf->render();
    $relatorio = ob_get_clean();
    if (headers_sent()) {
        echo $relatorio;
    }

    $dompdf->stream(
        "relatorioPessoas.pdf",
        array("Attachment" => false)
    );
}

    //Função utilizada para deletar uma pessoa
public function deletarPessoa() {
    $idPessoa = $_GET["idPessoa"];

    $retorno = $this->pessoaManager->deletarPEssoa($idPessoa);

    if ($retorno) {
        echo "<script type=\"text/javascript\">alert('A pessoa foi excluída com sucesso!');</script>";
        $this->listarPessoas();
    } else {
        echo "<script type=\"text/javascript\">alert('Não foi possível exlcuir esta pessoa');</script>";
    }
}

public function pessoaFisicaAlteraDados() {
    if (isset($_POST['enviado'])) {
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

        if (empty($razaoSocial) || empty($nomeFantasia) || empty($rg) || empty($cpf) || empty($telefone) || empty($email) || empty($idEstadoCivil)) {
            $check++;
        }
        if ($check == 1) {
            echo "<script type=\"text/javascript\">alert('Todos os campos são obrigatórios!');</script>";
            return false;
        }

        if (strlen($razaoSocial) > 130) {
            echo "<script type=\"text/javascript\">alert('O razão social excedeu o limite de caracteres!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        if (strlen($nomeFantasia) > 130) {
            echo "<script type=\"text/javascript\">alert('O Nome Fantasia excedeu o limite de caracteres!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        var_dump(strlen($cpf));
        if (strlen($cpf) != 14) {
            echo "<script type=\"text/javascript\">alert('CPF inválido!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        if (strlen($rg) < 5) {
            echo "<script type=\"text/javascript\">alert('RG inválido!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        if (strlen($telefone) > 18) {
            echo "<script type=\"text/javascript\">alert('Telefone inválido!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        if (strlen($email) > 200) {
            echo "<script type=\"text/javascript\">alert('O E-mail excedeu o limite de caracteres!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        try {
            $this->pessoaManager->alteraDadosPF($idPessoa, $razaoSocial, $nomeFantasia, $telefone, $email, $idEstadoCivil, $rg, $cpf);
            echo "<script type=\"text/javascript\">alert('A pessoa foi alterada com sucesso!');</script>";
            $this->listarPessoas();
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }
    }
}

public function pessoaJuridicaAlteraDados() {
    if (isset($_POST['enviado'])) {
        $idPessoa = $_POST['idPessoa'];
        $razaoSocial = $_POST['razaoSocialPessoaAlteraDados'];
        $nomeFantasia = $_POST['nomeFantasiaAlteraDados'];
        $cnpj = $_POST['cnpjPessoaAlteraDados'];
        $telefone = $_POST['telefonePessoaAlteraDados'];
        $email = $_POST['emailPessoaAlteraDados'];
        $idEstadoCivil = $_POST['idEstadoCivilAlteraDados'];
        $check = 0;

        if (empty($razaoSocial) || empty($nomeFantasia) || empty($cnpj) || empty($telefone) || empty($email) || empty($idEstadoCivil)) {
            $check++;
        }
        if ($check == 1) {
            echo "<script type=\"text/javascript\">alert('Todos os campos são obrigatórios!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        if (strlen($razaoSocial) > 130) {
            echo "<script type=\"text/javascript\">alert('O razão social excedeu o limite de caracteres!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        if (strlen($nomeFantasia) > 130) {
            echo "<script type=\"text/javascript\">alert('O nome Fantasia excedeu o limite de caracteres!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        if (strlen($cnpj) != 18) {
            echo "<script type=\"text/javascript\">alert('CNPJ inválido!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        if (strlen($telefone) < 10) {
            echo "<script type=\"text/javascript\">alert('Telefone inválido!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        if (strlen($email) > 200) {
            echo "<script type=\"text/javascript\">alert('O campo E-mail excedeu o limite de caracteres!');</script>";
            $this->detalharPessoaErro($idPessoa);
            return false;
        }

        try {
            $this->pessoaManager->alteraDadosPJ($idPessoa, $razaoSocial, $nomeFantasia, $telefone, $email, $idEstadoCivil, $cnpj);
            echo "<script type=\"text/javascript\">alert('A pessoa foi alterada com sucesso!');</script>";
            $this->listarPessoas();
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }
    }
}

    //Função chamada para listar todos os usuários do sistema
public function listarUsuarios() {
    $dados = $this->usuarioManager->listaUsuarios();
    
    require('view/listarUsuarios.php');
}

    //Função chamada para listar todas as pessoas do sistema
public function listarPessoas() {
    $dados = $this->pessoaManager->listarPessoas();
    require('view/listarPessoas.php');
}

    //Traz informações sobre um usuário específico selecionado    
public function detalharUsuario() {
    $usuario = $this->usuarioManager->buscaInfoUsuarioDetalhe($_GET['idUsuario']);
    require('view/detalheUsuario.php');
}

public function detalharUsuarioErro($idUsuario) {
    $usuario = $this->usuarioManager->buscaInfoUsuarioDetalhe($idUsuario);

    require('view/detalheUsuario.php');
}

    //Funcao chamada para enviar o usuario para a pagina inicial
public function inicial() {
    require('view/homePage.php');
}

    //Função utilizada para enviar o usuário para a página inicil(que contém o login) ao clicar no botão Login
public function loginAcao() {
    require('view/homePage.php');
}

    //Função utilizada para enviar o usuário para a página que possibilita cadastrar uma Pessoa Física ou Jurídica
public function cadastrarPessoaAcao() {
    $listaEstadoCivil = $this->estadoCivilManager->listaEstadoCivil();
    require('view/cadastrar.php');
}

    //Função para realizar o login
public function fazerLogin() {
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $check = 0;

    if (empty($login) || empty($senha)) {
        $check++;
    }
    if ($check == 1) {
        echo "<script type=\"text/javascript\">alert('Insira o Login e Senha!');</script>";
        $this->loginAcao();
        return false;
    }

    if (strlen($login) > 100) {
        echo "<script type=\"text/javascript\">alert('O login excedeu o limite de caracteres!');</script>";
        $this->loginAcao();
        return false;
    }

    if (strlen($senha) > 100){
        echo "<script type=\"text/javascript\">alert('O senha excedeu o limite de caracteres!');</script>";
        $this->loginAcao();
        return false;
    }

    $usuario = $this->usuarioManager->validarUsuario($login, $senha);

    if ($usuario > 0) {
        $_SESSION['usuario'] = base64_encode($usuario);
        //error_log(print_r($_SESSION['usuario'],true));
        session_write_close();
        require('view/homePage.php');
    } else {
        $msgLogin = true;
        require('view/homePage.php');
    }
}

    //Função para cadastrar uma pessoa no sistema
public function cadastrarPessoa() {
    if (isset($_POST['enviado'])) { 
        $razaoSocial = $_POST['razaoSocialCadastro'];
        $idEstadoCivil = $_POST ['estadoCivilCadastro'];
        $nomeFantasia = $_POST['nomeFantasiaCadastro'];
        $telefoneCadastro = $_POST['telefoneCadastro'];
        $emailCadastro = $_POST['emailCadastro'];
        $cpfCadastro = $_POST['cpfCadastro'];
        $rgCadastro = $_POST['rgCadastro'];
        $cnpjCadastro = $_POST['cnpjCadastro'];
        $check = 0;

        if (empty($_POST['cpfCadastro']) && empty($_POST['cnpjCadastro'])) {
            echo "<script type=\"text/javascript\">alert(\"Preencha um CPF ou CNPJ!\");</script>";
            $this->cadastrarPessoaAcao();
            return false;
        }

        if (strlen($cpfCadastro) > 0 && strlen($cpfCadastro) !== 14 ) {
            echo "<script type=\"text/javascript\">alert('CPF inválido!');</script>";
            $this->cadastrarPessoaAcao();
            return false;
            
        }
        if (strlen($cnpjCadastro) > 0 && strlen($cnpjCadastro) !== 18) {
            echo "<script type=\"text/javascript\">alert('CNPJ inválido!');</script>";
            $this->cadastrarPessoaAcao();
            return false;
        }

        if (strlen($rgCadastro) < 4 && strlen($cnpjCadastro) < 1) {
            echo "<script type=\"text/javascript\">alert('RG inválido!');</script>";
            $this->cadastrarPessoaAcao();
            return false;
        }

        if (empty($razaoSocial) || empty($nomeFantasia) || empty($telefoneCadastro) || empty($emailCadastro) || empty($idEstadoCivil)) {
            $check++;
        }
        if ($check == 1) {
            echo "<script type=\"text/javascript\">alert('Todos os campos são obrigatorios!');</script>";
            $this->cadastrarPessoaAcao();
            return false;
        }

        if (strlen($razaoSocial) > 130) {
            echo "<script type=\"text/javascript\">alert('O razao social excedeu o limite de caracteres!');</script>";
            $this->cadastrarPessoaAcao();
            return false;
        }

        if (strlen($nomeFantasia) > 130) {
            echo "<script type=\"text/javascript\">alert('O Nome Fantasia excedeu o limite de caracteres!');</script>";
            $this->cadastrarPessoaAcao();
            return false;
        }

        if (strlen($telefoneCadastro) < 8) {
            echo "<script type=\"text/javascript\">alert('Telefone inválido!');</script>";
            $this->cadastrarPessoaAcao();
            return false;
        }

        if (strlen($emailCadastro) > 200) {
            echo "<script type=\"text/javascript\">alert('O E-mail excedeu o limite de caracteres!');</script>";
            $this->cadastrarPessoaAcao();
            return false;
        }
        //var_dump($cpfCadastro);
        //var_dump($cnpjCadastro);

        if (strlen($cpfCadastro) > 1) {
            //echo"teste";

            try {
                $idGerado = $this->pessoaManager->cadastrarPessoa($razaoSocial, $nomeFantasia, $telefoneCadastro, $emailCadastro, $idEstadoCivil);
                if ($idGerado != null) {
                    $result = $this->pessoaManager->cadastrarPessoaFisica($idGerado, $rgCadastro, $cpfCadastro);
                    if ($result) {
                        echo "<script type=\"text/javascript\">alert(\"Pessoa cadastrada com sucesso.\");</script>";
                        $this->inicial();
                    } else {
                        echo "<script type=\"text/javascript\">alert(\"Pessoa não cadastrada.\");</script>";
                    }
                }
            } catch (Excetpion $e) {
                $msg = $e->getMessage();
            }
        } else if (strlen($cnpjCadastro) > 1) {
            //echo"teste2";
            try {
                $idGerado = $this->pessoaManager->cadastrarPessoa($razaoSocial, $nomeFantasia, $telefoneCadastro, $emailCadastro, $idEstadoCivil);
                if ($idGerado != null) {
                            //echo $cnpjCadastro;
                    $result = $this->pessoaManager->cadastrarPessoaJuridica($idGerado, $cnpjCadastro);
                    if ($result) {
                        echo "<script type=\"text/javascript\">alert(\"Pessoa cadastrada com sucesso.\");</script>";
                        $this->inicial();
                    } else {
                        echo "<script type=\"text/javascript\">alert(\"Pessoa não cadastrada.\");</script>";
                    }
                }
            } catch (Excetpion $e) {
                $msg = $e->getMessage();
            }

        }
    }
}

//Função para alterar dados de um usuario
public function usuarioAlteraDados() {
    if (isset($_POST['enviado'])) {
        $idUsuario = $_POST['idUsuario'];
        $nomeAlterado = $_POST['nomeAlteraDados'];
        $loginAlterado = $_POST['loginAlteraDados'];
        $senhaAlterada = $_POST['senhaAlteraDados'];
        $check = 0;

        if (empty($nomeAlterado) && empty($loginAlterado) || empty($senhaAlterada)) {
            $check++;
        }
        if ($check == 1) {
            echo "<script type=\"text/javascript\">alert('Todos os campos são obrigatorios!');</script>";
            $this->detalharUsuarioErro($idUsuario);
            return false;
        }

        if (strlen($nomeAlterado) > 130) {
            echo "<script type=\"text/javascript\">alert('O nome excedeu o limite de caracteres!');</script>";
            $this->detalharUsuarioErro($idUsuario);
            return false;
        }

        if (strlen($loginAlterado) > 100) {
            echo "<script type=\"text/javascript\">alert('O login excedeu o limite de caracteres!');</script>";
            $this->detalharUsuarioErro($idUsuario);
            return false;
        }

        if (strlen($senhaAlterada) >100 ) {
            echo "<script type=\"text/javascript\">alert('A senha excedeu o limite de caracteres!');</script>";
            $this->detalharUsuarioErro($idUsuario);
            return false;
        }



        try {
            $this->usuarioManager->alteraDados($idUsuario, $nomeAlterado, $loginAlterado, $senhaAlterada);
            echo "<script type=\"text/javascript\">alert('O usuário foi alterado com sucesso!');</script>";
            $this->listarUsuarios();
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }
    }
}

//Função para enviar o usuário ao formulário de cadastro ao clicar no botão Cadastrar novo usuário
public function cadastrarUsuarioAcao() {
    require('view/cadastrarUsuario.php');
}

//Função para deletar um usuário
public function deletarUsuario() {
    $idUsuario = $_GET["idUsuario"];

    if(base64_encode($idUsuario) === $_SESSION['usuario']){
        echo "<script type=\"text/javascript\">alert('Não é possível excluir seu próprio usuário!');</script>";
        $this->listarUsuarios();
        return false;
    }
    $retorno = $this->usuarioManager->deletarUsuario($idUsuario);

    if ($retorno) {
        echo "<script type=\"text/javascript\">alert('O usuário foi excluído com sucesso!');</script>";
        $this->listarUsuarios();
        return true;
    } else {
        echo "<script type=\"text/javascript\">alert('Não foi possível exlcuir este usuário');</script>";
        $this->listarUsuarios();
        return false;
    }
}

//Função que cadastra um usuário
public function cadastrarUsuario() {
    if (isset($_POST['enviado'])) {
        $login = $_POST['loginUsuarioCadastro'];
        $nome = $_POST['nomeUsuarioCadastro'];
        $senha = $_POST['senhaUsuarioCadastro'];

        $retorno = $this->usuarioManager->cadastrarUsuario($nome, $login, $senha);

        if ($retorno) {
            echo "<script type=\"text/javascript\">alert('O usuário foi cadastrado com sucesso!');</script>";
            $this->listarUsuarios();
        } else {
            echo "<script type=\"text/javascript\">alert('Não foi possível cadastrar este usuário');</script>";
        }
    }
}

}
