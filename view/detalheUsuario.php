<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Detalhe Usuário</title>


    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>

<!--MENU SUPERIOR -->

<?php include('menu.php');?>

<!--FIM MENU SUPERIOR -->

<!-- TELA DE CADASTRO -->
<br>
<br>
<div class="container mt-5">
        <form id="usuarioFormulario" action="?section=Controle&function=usuarioAlteraDados" class="row" method="POST">
            <div class="form-group col-6">
                <label for="idUsuario">idUsuario:</label>
                <input id="idUsuario" name="idUsuario" value="<?=$usuario->idUsuario?>" readonly class="form-control">
            </div>
            <div class="form-group col-6">
                <label for="nome">Nome:</label>
                <input id="nome" name="nomeAlteraDados" required oninvalid="setCustomValidity('O campo nome deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" value="<?=$usuario->nome?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="login">Login:</label>
                <input id="login" name="loginAlteraDados" required oninvalid="setCustomValidity('O campo login deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" value="<?=$usuario->login?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="senha">Senha:</label>
                <input id="senha" name="senhaAlteraDados" required oninvalid="setCustomValidity('O campo senha deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" type="password" value="<?=$usuario->senha?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <a class="btn btn-secondary" href="index.php?section=Controle&function=listarUsuarios">Voltar</a>
                <input name="enviado" type="submit" class="btn btn-success col-2 float-right" value="Alterar">
            </div>
        </form>

</div>
</body>