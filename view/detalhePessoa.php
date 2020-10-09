<!DOCTYPE html>
<?php ini_set('default_charset', 'UTF-8'); ?>
<html lang="pt-br">
    <head>

        <!-- scripts para utilizar mascara no Telefone-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/master/src/jquery.mask.js"></script>

        <title>Alteração de dados cadastrais</title>


        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>
    <body>

        <!--MENU SUPERIOR -->

        <?php include('menu.php');  ?>

        <!--FIM MENU SUPERIOR -->

        <!-- TELA DE CADASTRO -->
        <div style="text-align:center">
            <h1>Alteração de dados cadastrais</h1>
        </div>
        <?php
        if (end($pessoa[0]) == 0) {$check = 1;//Verifica se o ultimo campo do array é 0, se sim, significa que é uma Pessoa Física
        //Formulario para Pessoa Fi�sica
            ?>
            <div class="container mt-5">
                <form id="pessoaFisicaFrm" action="?section=Controle&function=pessoaFisicaAlteraDados" class="row" method="POST">
                    <div class="form-group col-6">
                        <label for="idPessoa">IDPessoa:</label>
                        <input id="idPessoa" name="idPessoa" value="<?= $pessoa[0][0] ?>" readonly class="form-control">
                    </div>
                    
                    <div class="form-group col-6">
                        <label for="razaoSocialPessoa">Razãao Social:</label>
                        <input id="razaoSocialPessoa"  name="razaoSocialPessoaAlteraDados" maxlength="130" type="text" value="<?= $pessoa[0][1] ?>" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="nomeFantasiaPessoa">Nome Fantasia:</label>
                        <input id="nomeFantasiaPessoa"  name="nomeFantasiaAlteraDados" maxlength="130" type="text" value="<?= $pessoa[0][2] ?>" class="form-control">
                    </div>
                    
                    <div class="form-group col-12">
                        <label for="rg">RG:</label>
                        <input id="rgPessoa"  name="rgPessoaAlteraDados" maxlength="18" type="text" value="<?= $pessoa[0][6] ?>" class="form-control">
                    </div>
                    
                    <div class="form-group col-12">
                        <label for="cpf">CPF:</label>
                        <input id="cpf" name="cpfPessoaAlteraDados" maxlength="14" onkeypress="formatar_mascara(this,'###.###.###-##')" type="text" value="<?= $pessoa[0][5] ?>" class="form-control">
                    </div>
                    
                    <div class="form-group col-12">
                        <label for="telefone">Telefone:</label><br>
                        <input id="phone" name="telefonePessoaAlteraDados" maxlength="18" type="text" value="<?= $pessoa[0][3] ?>" class="form-control">
                    </div>
                    
                    <div class="form-group col-12">
                        <label for="email">Email:</label>
                        <input id="emailPessoa" name="emailPessoaAlteraDados" maxlength="200" type="text" value="<?= $pessoa[0][4] ?>" class="form-control">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Estado Civil</label> 
                        <?php
                        //Código utilizado para alterar os 2 primeiros campos do array listaEstadoCivil inserindo o estado civil da pessoa atual, para que seja mostrado esse valor de inicio no combo box
                        for ($i = 0; $i < count($listaEstadoCivil); $i++) {
                            if ($listaEstadoCivil[$i]['id'] == $pessoa[0][7]) {
                                $aux1 = $listaEstadoCivil[0]['0'];
                                $aux2 = $listaEstadoCivil[0]['descricao'];
                                $aux3 = $listaEstadoCivil[0]['1'];
                                $aux4 = $listaEstadoCivil[0]['id'];

                                $listaEstadoCivil[0]['0'] = $pessoa[0][8];
                                $listaEstadoCivil[0]['id'] = $pessoa[0][7];
                                $listaEstadoCivil[0]['1'] = $pessoa[0][8];
                                $listaEstadoCivil[0]['descricao'] = $pessoa[0][8];
                                
                                $listaEstadoCivil[$i]['0'] = $aux1;
                                $listaEstadoCivil[$i]['descricao'] = $aux2;
                                $listaEstadoCivil[$i]['1'] = $aux3;
                                $listaEstadoCivil[$i]['id'] = $aux4;
                            }
                        }

                        echo "<select name = 'idEstadoCivilAlteraDados'>";
                        $tamanho = count($listaEstadoCivil);
                        if (isset($listaEstadoCivil)) {
                            error_log(print_r($listaEstadoCivil, true));
                            for ($i = 0; $i < $tamanho; $i = $i + 1) {
                                echo "<option value = {$listaEstadoCivil[$i]['id']}";
                                //echo "selected = 'selected'";
                                echo ">{$listaEstadoCivil[$i]['descricao']}</option>";
                            }
                        }
                        echo "</select>"
                        ?>
                    </div> 


                    <div class="form-group col-12">
                        <a class="btn btn-secondary" href="index.php?section=Controle&function=listarPessoas">Voltar</a>
                        <input name="enviado" type="submit" class="btn btn-success col-2 float-right" value="Alterar">
                    </div>
                </form>

            </div>
            <?php
        } else { $check = 0;


    //Formulario para Pessoa Juridica
            ?>
            <div class="container mt-5">
                <form id="pessoaJuridicaFrm" action="?section=Controle&function=pessoaJuridicaAlteraDados" class="row" method="POST">
                    <div class="form-group col-6">
                        <label for="idPessoa">IDPessoa:</label>
                        <input id="idPessoaJ" name="idPessoa" value="<?= $pessoa[0][0] ?>" readonly class="form-control">
                    </div>
                    
                    <div class="form-group col-6">
                        <label for="razaoSocialPessoa">Razão Social:</label>
                        <input id="razaoSocialPessoaJ" name="razaoSocialPessoaAlteraDados" type="text" maxlength="130" value="<?= $pessoa[0][1] ?>" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="nomeFantasia">Nome Fantasia:</label>
                        <input id="nomeFantasiaPessoaJ" name="nomeFantasiaAlteraDados" type="text" maxlength="130" value="<?= $pessoa[0][2] ?>" class="form-control">
                    </div>
                    
                    <div class="form-group col-12">
                        <label for="cnpj">CNPJ:</label>
                        <input id="cnpjPessoaJ" name="cnpjPessoaAlteraDados" onkeypress="formatar_mascara(this,'##.###.###/####-##')" maxlength="18" type="text" value="<?= $pessoa[0][5] ?>" class="form-control">
                    </div>
                    
                    <div class="form-group col-12">
                        <label for="telefone">Telefone:</label>
                        <input id="phone" type="text" name="telefonePessoaAlteraDados" maxlength="18" type="text" value="<?= $pessoa[0][3] ?>" class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <label for="email">Email:</label>
                        <input id="emailPessoaJ" name="emailPessoaAlteraDados" type="text" value="<?= $pessoa[0][4] ?>" class="form-control">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Estado Civil</label> 
                        <?php
                        //Código utilizado para alterar os 2 primeiros campos do array listaEstadoCivil inserindo o estado civil da pessoa atual, para que seja mostrado esse valor de inicio no combo box
                        for ($i = 0; $i < count($listaEstadoCivil); $i++) {
                            if ($listaEstadoCivil[$i]['id'] == $pessoa[0][6]) {
                                
                                $aux1 = $listaEstadoCivil[0]['0'];
                                $aux2 = $listaEstadoCivil[0]['descricao'];
                                $aux3 = $listaEstadoCivil[0]['1'];
                                $aux4 = $listaEstadoCivil[0]['id'];

                                $listaEstadoCivil[0]['0'] = $pessoa[0][7];
                                $listaEstadoCivil[0]['id'] = $pessoa[0][6];
                                $listaEstadoCivil[0]['1'] = $pessoa[0][6];
                                $listaEstadoCivil[0]['descricao'] = $pessoa[0][7];
                                
                                $listaEstadoCivil[$i]['0'] = $aux1;
                                $listaEstadoCivil[$i]['descricao'] = $aux2;
                                $listaEstadoCivil[$i]['1'] = $aux3;
                                $listaEstadoCivil[$i]['id'] = $aux4;
                                
                            }
                        }
                        error_log(print_r($listaEstadoCivil,true));

                        echo "<select name = 'idEstadoCivilAlteraDados'>";
                        $tamanho = count($listaEstadoCivil);
                        if (isset($listaEstadoCivil)) {
                            error_log(print_r($listaEstadoCivil, true));
                            for ($i = 0; $i < $tamanho; $i = $i + 1) {
                                echo "<option value = {$listaEstadoCivil[$i]['id']}";
                                //echo "selected = 'selected'";
                                echo ">{$listaEstadoCivil[$i]['descricao']}</option>";
                            }
                        }
                        echo "</select>";
                        ?>

                    </div> 


                    <div class="form-group col-12">
                        <a class="btn btn-secondary" href="index.php?section=Controle&function=listarPessoas">Voltar</a>
                        <input name="enviado" type="submit" class="btn btn-success col-2 float-right" value="Alterar">
                    </div>
                </form>

            </div>
        <?php } ?>
        
    <!-- Scripts --> 
    
    <!-- Script para validar os campos -->
    <script type="text/javascript">
            
        function null_or_empty(str) {
        var v = document.getElementById(str).value;
        return v == null || v == "";
        }
        //Pega a variavel check do PHP para verificar se é PF ou PJ
        var check = "<?php echo $check;?>"; 
        if(check == 1){//1=PF e 0=PJ
            var form = document.getElementById("pessoaFisicaFrm");
            var razaoSocialPF = document.getElementById("razaoSocialPessoa");
            var nomeFantasiaPF = document.getElementById("nomeFantasiaPessoa");
            var rgPF = document.getElementById("rgPessoa");
            var cpfPF = document.getElementById("cpf");
            var telefonePF = document.getElementById("phone");
            var emailPF = document.getElementById("emailPessoa");


            form.addEventListener('submit', function(e) {
            // Verifica se os campos estão vazios

            if (!razaoSocialPF.value) {
            alert('Informe uma razão social!');
            //Impede o envio do form
            e.preventDefault();
            return 0;
            }

            if (!nomeFantasiaPF.value) {
            alert('Informe um nome fantasia!');
            //Impede o envio do form
            e.preventDefault();
            return 0;
            }

            //Retira a pontuação do RG
            rg = rgPF.value.replace(/\.|\-/g, '');

            if (!rg || isNaN(rg)) {
            alert('Informe um RG válido.');
            //Impede o envio do form
            e.preventDefault();
            return 0;
            }

            if (!cpfPF.value || cpfPF.value.length !== 14) {
            alert('Informe um CPF válido.');
            //Impede o envio do form
            e.preventDefault();
            return 0;
            }

            if (!telefonePF.value || telefonePF.value.length < 8) {
            alert('Informe um telefone válido.');
            //Impede o envio do form
            e.preventDefault();
            return 0;
            }

            if (!emailPF.value || emailPF.value==""|| emailPF.value.indexOf('@')==-1 || emailPF.value.indexOf('.')==-1) {
            alert('Informe um e-mail válido.');
            //Impede o envio do form
            e.preventDefault();
            return 0;
            }

        });

        } 
        else if(check == 0){
            var form = document.getElementById("pessoaJuridicaFrm");
            var razaoSocialPJ = document.getElementById("razaoSocialPessoaJ");
            var nomeFantasiaPJ = document.getElementById("nomeFantasiaPessoaJ");
            var cnpjPJ = document.getElementById("cnpjPessoaJ");
            var telefonePJ = document.getElementById("phone");
            var emailPJ = document.getElementById("emailPessoaJ");

            form.addEventListener('submit', function(e) {
                // Verifica se os campos estão vazios

                if (!razaoSocialPJ.value) {
                alert('Informe uma razao social!');
                //Impede o envio do form
                e.preventDefault();
                return 0;
                }

                if (!nomeFantasiaPJ.value) {
                alert('Informe um nome fantasia!');
                //Impede o envio do form
                e.preventDefault();
                return 0;
                }

                //Retira a pontuação do CNPJ
                cnpj = cnpjPJ.value.replace(/([\u0300-\u036f]|[^0-9a-zA-Z])/g, '');

                if (!cnpj || cnpj.length !== 14) {
                alert('Informe um cnpj valido!');
                //Impede o envio do form
                e.preventDefault();
                return 0;
                }

                if (!telefonePJ.value) {
                alert('Informe um telefone!');
                //Impede o envio do form
                e.preventDefault();
                return 0;
                }

                if (!emailPJ.value || emailPJ.value=="" || emailPJ.value.indexOf('@')==-1 || emailPJ.value.indexOf('.')==-1) {
                alert('Informe um e-mail valido!');
                //Impede o envio do form
                e.preventDefault();
                return 0;
                }

            });
        }

    </script>

    <!-- Função para máscara do telefone -->
    <script type="text/javascript">
        $(document).ready(function ( ){
                $('body').on('focus', '#phone', function(){
        var maskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
                options = {
                onKeyPress: function(field, options) {
                field.mask(maskBehavior.apply({}, arguments), options);
                if (field[0].value.length >= 14){
                var val = field[0].value.replace(/\D/g, '');
                if (/\d\d(\d)\1{7,8}/.test(val)){
                field[0].value = '';
                alert('Telefone Invalido');
                }
                }
                }
                };
        $(this).mask(maskBehavior, options);
        });
            } );

    </script>
                
    <!-- Função para máscara do CPF e CNPJ -->
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

    <!-- Estilo utilizado para remover as setas do input Number -->
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none;margin: 0;}
    </style>
</body