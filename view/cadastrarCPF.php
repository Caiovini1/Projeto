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
                        <label>Razão social:</label><input value="<?php if(isset($pessoa))echo $pessoa[0];?>" type="text" name="razaoSocialCadastro" class="form-control"  oninvalid="setCustomValidity('O campo Razão Social deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Nome fantasia:</label><input value="<?php if(isset($pessoa))echo $pessoa[1];?>" type="text" name="nomeFantasiaCadastro" class="form-control"  oninvalid="setCustomValidity('O campo Nome fantasia deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}"/>
                    </div>
                    <div class="form-group  col-md-4">
                        <label>CPF:</label><input type="text" id="cpf" name="cpfCadastro" maxlength="14" name="cpfCadastro" class="form-control" required value=<?php echo $cpf ?> readonly>
                    </div>
                    <div class="form-group  col-md-4">
                        <label>Telefone:</label><input type="text" value="<?php if(isset($pessoa))echo $pessoa[3];?>" id="telefone" required maxlength="13" name="telefoneCadastro"  class="form-control" oninvalid="setCustomValidity('O campo Telefone deve ser informado')" onkeypress="formatar_mascara(this,'## #####-####')">
                    </div>
                    <div class="form-group  col-md-4">
                        <label>RG:</label><input type="text" id="rg" value="<?php if(isset($pessoa))echo $pessoa[4];?>" name="rgCadastro" maxlength="18" class="form-control"  oninvalid="setCustomValidity('O campo RG deve ser informado')"onkeypress="formatar_mascara(this,'#.###.###')" >
                    </div>
                    <div class="form-group col-md-4">
                        <label>E-mail:</label><input type="email" value="<?php if(isset($pessoa))echo $pessoa[5];?>" name="emailCadastro" class="form-control" maxlength="200"  oninvalid="setCustomValidity('E-mail inválido')" onchange="try{setCustomValidity('')}catch(e){}"/>
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
                        <label>CPF:</label><input type="text" id="cpf" name="cpfCadastro" maxlength="14" name="cpfCadastro" class="form-control" value=<?php echo $cpf ?> readonly>
                    </div>
                    <div>
                        <label>Telefone:</label><input type="number" value="<?=$pessoa->telefone?>"  id="telefone" maxlength="18" name="telefoneCadastro" onkeypress="return somenteNumerosTel(event)" required onkeypress="formatar_mascara(this,'## #####-####')" class="form-control"/>
                    </div>
                    <div>
                        <label>RG:</label><input type="text" value="<?$pessoa->rg?>" name="rgCadastro" maxlength="14" class="form-control">
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

        
<!-- Script para máscara do Telefone -->
<script>
$(document).ready(function(){
    $('body').on('focus', '#phone', function(){
        var maskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {
            onKeyPress: function(field, options) {
                field.mask(maskBehavior.apply({}, arguments), options);

                if(field[0].value.length >= 14){
                    var val = field[0].value.replace(/\D/g, '');
                    if(/\d\d(\d)\1{7,8}/.test(val)){
                        field[0].value = '';
                        alert('Telefone Invalido');
                    }
                }
            }
        };
        $(this).mask(maskBehavior, options);
    });
});


</script>
        
        
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

