<!DOCTYPE html>
<?php ini_set('default_charset', 'UTF-8'); ?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Acessar</title>

        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    </head>


    
    <body>

        <?php include('menu.php');  ?>

        <?php 
        if(isset($_SESSION['usuario'])){
    }
    else{ ?>

        <div class="row mt-5">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
            <h3>Acessar</h3>
            <!--INICIO DO FORMULÁRIO -->
            <form id="formLogin" action="?section=Controle&function=fazerLogin" method="POST">
                <label>Login:</label>
                <input name="login" type="text" id="login" class="form-control" maxlength="100" />
                <br>
                <label>Senha:</label>
                <input name="senha" id="senha" type="password" class="form-control" maxlength="100"/>
                <?php if(isset($msgLogin) && $msgLogin): ?> <span style='color:red;' role="alert">Login ou senha incorretos!</span> <br> <?php endif; ?>
                <br>
                <input type="submit" value="Acessar" class="btn btn-outline-success btn-lg active float-right"/>
            </form>
            <!--FIM DO FORMULÁRIO -->
            </div>
        </div>

        <?php }?>


        <script type="text/javascript">

            function null_or_empty(str) {
                var v = document.getElementById(str).value;
                return v == null || v == "";
            }
            
            //Verifica se os campos Nome, Login e Senha estão vazios
            
            var form = document.getElementById("formLogin");
            var login = document.getElementById("login");
            var senha = document.getElementById("senha");
            

            form.addEventListener('submit', function (e) {
                // Verifica se os campos estão vazios

                if (!login.value) {
                    alert('Informe um login!');
                    //Impede o envio do form
                    e.preventDefault();
                    return 0;
                }

                if (!senha.value) {
                    alert('Informe uma senha!');
                    //Impede o envio do form
                    e.preventDefault();
                    return 0;
                }

            });
        </script>

    </body>

    
</html>