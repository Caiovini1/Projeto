<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastrar</title>

        <!-- scripts para utilizar mascara no CPF e Telefone-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/master/src/jquery.mask.js"></script>
	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



</head>
<body>
    


	<!-- Menu -->
	<?php include('menu.php'); ?>

	<br>
        
        <label>Pessoa Física: </label><input id="label1" type="radio" name="selecao" data-tab="cpf" required/>
        <label>Pessoa Jurídica: </label><input id="label2" type="radio" name="selecao" data-tab="cnpj" required />
        
        
        <div>
                <form id="formulario" name="formularioCadastro" action="?section=Controle&function=cadastrarPessoa" method="POST">
                    
                    <div class="form-group col-md-4" id="cpf" data-content=""  style="display: none;">
                        <label>CPF:</label><input type="text" id="cpfCadastro" name="cpfCadastro" maxlength="14" class="form-control" onkeypress="formatar_mascara(this,'###.###.###-##')"  ?>		
                        <label>RG:</label><input type="text" id="rgCadastro" name="rgCadastro" maxlength="18" class="form-control">
                    </div>
                    
                    <div class="form-group col-md-4" id="cnpj" data-content="" style="display: none;">
			<label>CNPJ:</label><input type="text" id="cnpjCadastro"  name="cnpjCadastro" maxlength="18" name="cnpjCadastro" class="form-control" onkeypress="formatar_mascara(this,'##.###.###/####-##')" ?>
						
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Razao social:</label><input id="razaoSocialCadastro" maxlength="130" type="text" name="razaoSocialCadastro" class="form-control"/>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Nome fantasia:</label><input id="nomeFantasiaCadastro" maxlength="130" type="text" name="nomeFantasiaCadastro" class="form-control"/>
                    </div>
                    
                    <div class="form-group  col-md-4">
                        <label>Telefone:</label><input id="phone" name="telefoneCadastro" class="form-control" maxlength="18" type="text">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>E-mail:</label><input id="emailCadastro" maxlength="200" type="text" name="emailCadastro" class="form-control"/>
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
    <!-- Scripts -->

    <!-- script para alternar os campos CPF/RG e CNPJ conforme seleção -->
    <script type="text/javascript">

    //consultando os botões responsáveis por alternar os campos CPF e CNPJ
    var selecao = document.querySelectorAll("[data-tab]");

    //consultando os conteudos a serem exibidos.
    var conteudos = document.querySelectorAll("[data-content]");

    //declarando a função que será associada a cada input:radio
    var tabOnClick = function (elem) {  
            for (var indice in conteudos) {
        //verificando se o input:radio selecionado está associado ao conteudo atual.
        var display = conteudos[indice].id === elem.target.dataset.tab ? "block" : "none";
        document.getElementById('formulario').reset();//Reseta os campos quando troca
        conteudos[indice].style.display = display;  
    }

    }

    //associando todos os input:radio ao método declarado acima.
    for (var indice in selecao) {
            selecao[indice].onclick = tabOnClick;
    }

    </script>
    <!-- Script para validar os campos -->
    <script type="text/javascript">
            
        function null_or_empty(str) {
        var v = document.getElementById(str).value;
        return v == null || v == "";
        }            

        var form = document.getElementById("formulario");
        var razaoSocial = document.getElementById("razaoSocialCadastro");
        var nomeFantasia = document.getElementById("nomeFantasiaCadastro");
        var rgPF = document.getElementById("rgCadastro");
        var cpfPF = document.getElementById("cpfCadastro");
        var telefone = document.getElementById("phone");
        var email = document.getElementById("emailCadastro");
        var cnpjPJ = document.getElementById("cnpjCadastro");


        form.addEventListener('submit', function(e) {
        // Verifica se os campos estão vazios ou válidos

        if(!cpfPF.value && !cnpjPJ.value){
            alert("Informe um CPF ou CNPJ");
            e.preventDefault();
            return false;
            }

        if(cpfPF.value && cpfPF.value.length === 14){
            //Retira a pontuação do RG
            rg = rgPF.value.replace(/\.|\-/g, '');
            if (!rg || isNaN(rg)) {
                alert('Informe um RG valido.');
                //Impede o envio do form
                e.preventDefault();
                return false;
            }

        } else {
            alert("Informe um CPF valido!");
            e.preventDefault();
            return false;
        }

        if(cnpjPJ.value && cnpj.value.length !== 14){
            alert("Informe um CNPJ valido!");
            e.preventDefault();
            return false;
        }            

        if (!razaoSocial.value) {
            alert('Informe uma razao social!');
            //Impede o envio do form
            e.preventDefault();
            return false;
        }

        if (!nomeFantasia.value) {
            alert('Informe um nome fantasia!');
            //Impede o envio do form
            e.preventDefault();
            return false;
        }

        if (!telefone.value) {
            alert('Informe um telefone.');
            //Impede o envio do form
            e.preventDefault();
            return false;
        }

        if (!email.value || email.value==""|| email.value.indexOf('@')==-1 || email.value.indexOf('.')==-1) {
            alert('Informe um e-mail valido.');
            //Impede o envio do form
            e.preventDefault();
            return false;
        }

       });

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