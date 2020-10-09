<?php
ini_set('default_charset', 'UTF-8');
if (isset($_SESSION['usuario'])) {
    $logado = true;
} else
    $logado = false;
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar navbar-dark navbar-expand-lg bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            
            <?php if ($logado){ ?>
                <ul class="navbar-nav mr-auto">

                <li class="nav-item"><a class="nav-link" href="index.php?section=Controle&function=cadastrarPessoaAcao">Cadastrar</a>
                <li class="nav-item"><a class="nav-link" href="?section=Controle&function=listarUsuarios">Listar Usuários</a>
                <li class="nav-item"><a class="nav-link" href="?section=Controle&function=listarPessoas">Listar Pessoas</a>
            </ul>
            <?php } ?>
        </ul>
    </div>

    <div id="botao-login">
        <?php if ($logado) { ?>
            <div class="btn-group"> 
            <a class="btn btn-danger" href="index.php?section=Controle&function=deslogar">Sair</a>
            </div>
        <?php }else {
            ?><a  href="index.php?section=Controle&function=loginAcao" class="btn btn-outline-success btn-lg active" role="button" aria-pressed="true">Login</a> <?php } ?>

    </div>

    </div>
    

</nav>