<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Acessar</title>

        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    </head>


    
    <body>

        <?php include('menu.php'); ?>

        <?php 
        if(isset($_SESSION['usuario'])){
    }
    else{ ?>

        <div class="row mt-5">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
            <h3>Acessar</h3>
            <!--INICIO DO FORMULÁRIO -->
            <form action="?section=Controle&function=fazerLogin" method="POST">
                <label>Login:</label>
                <input name="login" type="text" id="login" class="form-control" maxlength="100" required oninvalid="setCustomValidity('O campo Login não pode estar vazio')" onchange="try{setCustomValidity('')}catch(e){}"/>
                <br>
                <label>Senha:</label>
                <input name="senha" type="password" class="form-control" maxlength="100" required oninvalid="setCustomValidity('O campo senha não pode estar vazio')" onchange="try{setCustomValidity('')}catch(e){}"/>
                <?php if(isset($msgLogin) && $msgLogin): ?> <span style='color:red;' role="alert">Login ou senha incorretos!</span> <br> <?php endif; ?>
                <br>
                <input type="submit" value="Acessar" class="btn btn-outline-success btn-lg active float-right"/>
            </form>
            <!--FIM DO FORMULÁRIO -->
            </div>
        </div>

        <?php }?>
    </body>
</html>