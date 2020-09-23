<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro de Pessoa Física</title>
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
        <h1> Cadastro de Pessoa Física </h1>
        <br>

        <?php if(!isset($pessoa->nome)){?>

            <div>
                <form name="formularioCadastro" action="?section=Controle&function=cadastrarPessoa" method="POST">
                    <div class="form-group col-md-4">
                        <label>Razão social:</label><input value="<?php if(isset($pessoa))echo $pessoa[0];?>" type="text" name="razaoSocialCadastro" class="form-control" required oninvalid="setCustomValidity('O campo Razão Social deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Nome fantasia:</label><input value="<?php if(isset($pessoa))echo $pessoa[1];?>" type="text" name="nomeFantasiaCadastro" class="form-control" required oninvalid="setCustomValidity('O campo Nome fantasia deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    </div>
                    <div class="form-group  col-md-4">
                        <label>CNPJ:</label><input type="text" id="cnpj" name="cnpjCadastro" maxlength="18" name="cnpjCadastro" class="form-control" value="<?php echo $cnpj ?>" readonly>
                    </div>
                    <div class="form-group  col-md-4">
                        <label>Telefone:</label><input type="text" value="<?php if(isset($pessoa))echo $pessoa[3];?>" id="telefone" maxlength="18" name="telefoneCadastro" required class="form-control" oninvalid="setCustomValidity('O campo Telefone deve ser informado')" onkeypress="formatar_mascara(this,'## #####-####')">
                    </div>
                    <div class="form-group col-md-4">
                        <label>E-mail:</label><input type="email" value="<?php if(isset($pessoa))echo $pessoa[5];?>" name="emailCadastro" class="form-control" maxlength="200" required oninvalid="setCustomValidity('E-mail inválido')" onchange="try{setCustomValidity('')}catch(e){}"/>
                        <?php if(isset($emailUnico) && !$emailUnico){ echo "<span style='color:red;'>E-mail inserido já cadastrado</span>"; echo "<br>";}?>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Estado Civil</label> 
                        <?php echo "<select name = 'estadoCivilCadastro'>";

                        $tamanho = count($listaEstadoCivil);
                        if(isset($listaEstadoCivil)){
                            for($i = 0; $i < $tamanho; $i = $i + 2){
                                echo "<option value = {$listaEstadoCivil[$i]}";
                            //echo "selected = 'selected'";
                                echo ">{$listaEstadoCivil[$i+1]}</option>";
                            }
                        }
                        echo "</select>" ?>
                    </div> 
                    <div class="form-group col-md-4">
                        <input  type="submit" value="Enviar"  name="enviado" class="float-right btn btn-outline-success active"/>
                    </div>
                </form>
                <br><br>
            </div>
        <?php }else{ ?>
            <div>
                <form name="formularioCadastro" name="formularioCadastro" action="?section=Controle&function=cadastrarPessoa" method="POST">
                    <div class="form-group col-md-4">
                        <label>Razão social:</label><input type="text" value="<?=$pessoa->nome?>" name="razaoSocialCadastro" class="form-control" required oninvalid="setCustomValidity('O campo Razão Social deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Nome fantasia:</label><input type="text" value="<?=$pessoa->nomeFantasia?>" name="nomeFantasiaCadastro" class="form-control" required oninvalid="setCustomValidity('O campo Nome fantasia deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    </div>
                    <div class="form-group  col-md-4">
                        <label>CNPJ:</label><input type="text" id="cnpj" name="cnpjCadastro" maxlength="18" name="cnpjCadastro" class="form-control" value=<?php echo $cnpj ?> readonly>
                    </div>
                    <div>
                        <label>Telefone:</label><input type="number" value="<?=$pessoa->telefone?>"  id="telefone" maxlength="18" name="telefoneCadastro" onkeypress="return somenteNumerosTel(event)" required onkeypress="formatar_mascara(this,'## #####-####')" class="form-control"/>
                    </div>
                    <div>
                        <label>E-mail:</label><input type="email" value="<?=$pessoa->email?>" maxlength="200" name="emailCadastro" class="form-control" required oninvalid="setCustomValidity('E-mail inválido')" onchange="try{setCustomValidity('')}catch(e){}"/>
                        <?php if(isset($emailUnico) && !$emailUnico){ echo "<span style='color:red;'>E-mail inserido já cadastrado</span>"; echo "<br>";}?>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Estado Civil</label> 
                        <?php echo "<select name = 'estadoCivilCadastro'>";

                        $tamanho = count($listaEstadoCivil);
                        if(isset($listaEstadoCivil)){
                            for($i = 0; $i < $tamanho; $i = $i + 2){
                                echo "<option value = {$listaEstadoCivil[$i]}";
                            //echo "selected = 'selected'";
                                echo ">{$listaEstadoCivil[$i+1]}</option>";
                            }
                        }
                        echo "</select>" ?>
                    </div>
                    <div class="form-group col-md-4">
                        <input  type="submit" value="Enviar"  name="enviado" class="float-right btn btn-outline-success active"/>
                    </div>
                </form>
                <br><br>
            </div>
        <?php } ?>

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