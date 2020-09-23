<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Detalhe Pessoa</title>


    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>

    <!--MENU SUPERIOR -->

    <?php ; include('menu.php');?>

    <!--FIM MENU SUPERIOR -->

    <!-- TELA DE CADASTRO -->
    <br>
    <br>
<?php
if(end($pessoa[0]) == 0 ){//Verifica se o ultimo campo do array é 0, se sim, significa que é uma Pessoa Física

//Formulário para Pessoa Física
    ?>
    <div class="container mt-5">
        <form id="pessoaFisicaFrm" action="?section=Controle&function=pessoaFisicaAlteraDados" class="row" method="POST">
            <div class="form-group col-6">
                <label for="idPessoa">IDPessoa:</label>
                <input id="idPessoa" name="idPessoa" value="<?=$pessoa[0][0]?>" readonly class="form-control">
            </div>
            <div class="form-group col-6">
                <label for="razaoSocialPessoa">Razão Social:</label>
                <input id="razaoSocialPessoa" name="razaoSocialPessoaAlteraDados" required oninvalid="setCustomValidity('O campo Razão Social deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" value="<?=$pessoa[0][1]?>" class="form-control">
            </div>

            <div class="form-group col-12">
                <label for="nomeFantasia">Nome Fantasia:</label>
                <input id="nomeFantasia" name="nomeFantasiaAlteraDados" required oninvalid="setCustomValidity('O campo Nome Fantasia deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" value="<?=$pessoa[0][2]?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="rg">RG:</label>
                <input id="rgPessoa" name="rgPessoaAlteraDados" required oninvalid="setCustomValidity('O campo RG deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" type="text" value="<?=$pessoa[0][6]?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="cpf">CPF:</label>
                <input id="cpfPessoa" name="cpfPessoaAlteraDados" required oninvalid="setCustomValidity('O campo CPF deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" type="text" value="<?=$pessoa[0][5]?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="telefone">Telefone:</label>
                <input id="telefonePessoa" name="telefonePessoaAlteraDados" required oninvalid="setCustomValidity('O campo Telefone deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" type="text" value="<?=$pessoa[0][3]?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="email">Email:</label>
                <input id="emailPessoa" name="emailPessoaAlteraDados" required oninvalid="setCustomValidity('O campo Email deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" type="text" value="<?=$pessoa[0][4]?>" class="form-control">
            </div>
            <div class="form-group col-md-4">
                        <label>Estado Civil</label> 
                        <?php 

                        //Código utilizado para alterar os 2 primeiros campos do array listaEstadoCivil inserindo o estado civil da pessoa atual, para que seja mostrado esse valor de inicio no combo box
                        for($i = 0; $i < count($listaEstadoCivil);$i++){
                            if($listaEstadoCivil[$i] == $pessoa[0][7]){
                                $aux = $listaEstadoCivil[0];
                                $aux2 = $listaEstadoCivil[1];

                                $listaEstadoCivil[0] = $pessoa[0][7];
                                $listaEstadoCivil[1] = $pessoa[0][8];

                                $listaEstadoCivil[$i] = $aux;
                                $listaEstadoCivil[$i+1] = $aux2;
                            }
                        }

                        echo "<select name = 'idEstadoCivilAlteraDados'>";
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
            
            
            <div class="form-group col-12">
                <a class="btn btn-secondary" href="index.php?section=Controle&function=listarPessoas">Voltar</a>
                <input name="enviado" type="submit" class="btn btn-success col-2 float-right" value="Alterar">
            </div>
        </form>

    </div>
<?php } else{


//Formulário para Pessoa Jurídica
    ?>
<div class="container mt-5">
        <form id="pessoaFisicaFrm" action="?section=Controle&function=pessoaJuridicaAlteraDados" class="row" method="POST">
            <div class="form-group col-6">
                <label for="idPessoa">IDPessoa:</label>
                <input id="idPessoa" name="idPessoa" value="<?=$pessoa[0][0]?>" readonly class="form-control">
            </div>
            <div class="form-group col-6">
                <label for="razaoSocialPessoa">Razão Social:</label>
                <input id="razaoSocialPessoa" name="razaoSocialPessoaAlteraDados" required oninvalid="setCustomValidity('O campo Razão Social deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" value="<?=$pessoa[0][1]?>" class="form-control">
            </div>

            <div class="form-group col-12">
                <label for="nomeFantasia">Nome Fantasia:</label>
                <input id="nomeFantasia" name="nomeFantasiaAlteraDados" required oninvalid="setCustomValidity('O campo Nome Fantasia deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" value="<?=$pessoa[0][2]?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="cnpj">CNPJ:</label>
                <input id="cnpjPessoa" name="cnpjPessoaAlteraDados" required maxlength="18" oninvalid="setCustomValidity('O campo CNPJ deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" type="text" value="<?=$pessoa[0][5]?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="telefone">Telefone:</label>
                <input id="telefonePessoa" name="telefonePessoaAlteraDados" required oninvalid="setCustomValidity('O campo Telefone deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" type="text" value="<?=$pessoa[0][3]?>" class="form-control">
            </div>
            <div class="form-group col-12">
                <label for="email">Email:</label>
                <input id="emailPessoa" name="emailPessoaAlteraDados" required oninvalid="setCustomValidity('O campo Email deve ser informado')" onchange="try{setCustomValidity('')}catch(e){}" type="text" value="<?=$pessoa[0][4]?>" class="form-control">
            </div>
            <div class="form-group col-md-4">
                        <label>Estado Civil</label> 
                        <?php 

                        //Código utilizado para alterar os 2 primeiros campos do array listaEstadoCivil inserindo o estado civil da pessoa atual, para que seja mostrado esse valor de inicio no combo box
                        for($i = 0; $i < count($listaEstadoCivil);$i++){
                            if($listaEstadoCivil[$i] == $pessoa[0][6]){
                                $aux = $listaEstadoCivil[0];
                                $aux2 = $listaEstadoCivil[1];

                                $listaEstadoCivil[0] = $pessoa[0][6];
                                $listaEstadoCivil[1] = $pessoa[0][7];

                                $listaEstadoCivil[$i] = $aux;
                                $listaEstadoCivil[$i+1] = $aux2;
                            }
                        }

                        echo "<select name = 'idEstadoCivilAlteraDados'>";
                        $tamanho = count($listaEstadoCivil);
                        if(isset($listaEstadoCivil)){
                            for($i = 0; $i < $tamanho; $i = $i + 2){
                                echo "<option value = {$listaEstadoCivil[$i]}";
                            //echo "selected = 'selected'";
                                echo ">{$listaEstadoCivil[$i+1]}</option>";
                            }
                        }
                        echo "</select>";?>

                    </div> 
            
            
            <div class="form-group col-12">
                <a class="btn btn-secondary" href="index.php?section=Controle&function=listarPessoas">Voltar</a>
                <input name="enviado" type="submit" class="btn btn-success col-2 float-right" value="Alterar">
            </div>
        </form>

    </div>
<?php } ?>

</body>