<!DOCTYPE html>
<?php ini_set('default_charset', 'UTF-8'); ?>
<html lang="pt-br">
<head>
    <title>Cadastrar Usuário</title>
    <meta charset="utf-8">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>


    <!-- Menu -->
    <?php include('menu.php'); ?>

    <br>

    <!-- TELA DE CADASTRO -->


    <div style="margin-left: 1cm">
        <h1> Cadastro de Usuários </h1>
        <br>
            <div>
                <form name="formularioCadastroUsuario" action="?section=Controle&function=cadastrarUsuario" method="POST">
                    <div class="form-group col-md-4">
                        <label>Nome:</label><input value="<?php if(isset($usuario))echo $usuario[0];?>" type="text" name="nomeUsuarioCadastro" maxlength="130" class="form-control" required oninvalid="setCustomValidity('O campo Nome deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    </div>
                    <div class="form-group  col-md-4">
                        <label>Login:</label><input type="text" id="loginUsuarioCadastro" name="loginUsuarioCadastro" maxlength="100" class="form-control" required oninvalid="setCustomValidity('O campo Login deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}">
                    </div>
                    <div class="form-group  col-md-4">
                        <label>Senha:</label><input type="password" value="<?php if(isset($usuario))echo $usuario[3];?>" id="senhaUsuarioCadastro" maxlength="100" name="senhaUsuarioCadastro" required class="form-control" oninvalid="setCustomValidity('O campo Senha deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}">
                    </div>
                    <div class="form-group col-md-4">
                        <a class="btn btn-secondary" href="index.php?section=Controle&function=listarUsuarios">Voltar</a>
                        <input  type="submit" value="Enviar"  name="enviado" class="float-right btn btn-outline-success active"/>
                    </div>
                </form>
                <br><br>
            </div>

        <!-- FIM DA TELA DE CADASTRO -->

    </body>


    <!-- Estilo utilizado para remover as setas do input Number -->
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
          -webkit-appearance: none; 
          margin: 0; 
      }
  </style>

  <!-- Função utilizada para inserir mascara nos campos -->

  <script type="text/javascript">
    function formatar_mascara(src, mascara) {
        var campo = src.value.length;
        var saida = mascara.substring(0,1);
        var texto = mascara.substring(campo);
        if(texto.substring(0,1) != saida) {
            src.value += texto.substring(0,1);
        }
    }
</script>