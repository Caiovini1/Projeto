<!DOCTYPE html>
<?php ini_set('default_charset', 'UTF-8'); ?>
<html lang="pt-br">
    <head> 
        <title>Detalhe Usuário</title>


        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>
    <body>

        <!--MENU SUPERIOR -->

        <?php include('menu.php');  ?>

        <!--FIM MENU SUPERIOR -->

        <!-- TELA DE CADASTRO -->
        <br>
        <br>
        <div class="container mt-5">
            <form id="usuarioFormulario" action="?section=Controle&function=usuarioAlteraDados" class="row" method="POST">
                <div class="form-group col-6">
                    <label for="idUsuario">idUsuario:</label>
                    <input id="idUsuario" name="idUsuario" type="text" value="<?= $usuario[0]['idUsuario'] ?>" readonly class="form-control">
                </div>
                <div class="form-group col-6">
                    <label for="nome">Nome:</label>
                    <input id="nomeAlteraDados" name="nomeAlteraDados" maxlength="130" type="text" value="<?= $usuario[0]['nome'] ?>" class="form-control">
                </div>
                <div class="form-group col-12">
                    <label for="login">Login:</label>
                    <input id="loginAlteraDados" name="loginAlteraDados" maxlength="100" type="text" value="<?= $usuario[0]['login'] ?>" class="form-control">
                </div>
                <div class="form-group col-12">
                    <label for="senha">Senha:</label>
                    <input id="senhaAlteraDados" name="senhaAlteraDados" maxlength="100" type="password" value="<?= $usuario[0]['senha'] ?>" class="form-control">
                </div>
                <div class="form-group col-12">
                    <a class="btn btn-secondary" href="index.php?section=Controle&function=listarUsuarios">Voltar</a>
                    <input name="enviado" type="submit" class="btn btn-success col-2 float-right" value="Alterar">
                </div>
            </form>

        </div>

        <script type="text/javascript">

            function null_or_empty(str) {
                var v = document.getElementById(str).value;
                return v == null || v == "";
            }
            
            //Verifica se os campos Nome, Login e Senha estão vazios
            
            var form = document.getElementById("usuarioFormulario");
            var nomeAlteraDados = document.getElementById("nomeAlteraDados");
            var loginAlteraDados = document.getElementById("loginAlteraDados");
            var senhaAlteraDados = document.getElementById("senhaAlteraDados");
            

            form.addEventListener('submit', function (e) {
                // Verifica se os campos estão vazios

                if (!nomeAlteraDados.value) {
                    alert('Informe um nome!');
                    //Impede o envio do form
                    e.preventDefault();
                    return 0;
                }

                if (!loginAlteraDados.value) {
                    alert('Informe um login!');
                    //Impede o envio do form
                    e.preventDefault();
                    return 0;
                }

                if (!senhaAlteraDados.value) {
                    alert('Informe uma senha!');
                    //Impede o envio do form
                    e.preventDefault();
                    return 0;
                }

            });
        </script>

    </body>