<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastrar</title>

	
	<meta charset="utf-8">

	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



</head>
<body>


	<!-- Menu -->
	<?php include('menu.php'); ?>

	<br>

	<!-- Seleciona se será Pessoa física ou Jurídica -->

	<div>
		<label>Pessoa Física: </label><input id="label1" type="radio" name="selecao" data-tab="cpf" required/>
		<label>Pessoa Jurídica: </label><input id="label2" type="radio" name="selecao" data-tab="cnpj" required />
		<div>

			<form id="formulario" name="formularioSelecao" action="?section=Controle&function=selecaoCpfCnpj" method="POST">
				<div>
					<div id="cpf" data-content="" style="display: none;">
						<label>CPF:</label>
						<input type="text" id="cpf" name="inputCPF" maxlength="14" name="cpfSelecao" onkeypress="formatar_mascara(this,'###.###.###-##')"  ?>
						
					</div>
					<div id="cnpj" data-content="" style="display: none;">
						<label>CNPJ:</label>
						<input type="text" id="cnpj"  name="inputCNPJ" maxlength="18" name="cnpjSelecao" onkeypress="formatar_mascara(this,'##.###.###/####-##')" ?>
						
					</div>
					<div>
						<a class="btn btn-secondary" href="index.php?section=Controle&function=homePage">Voltar</a>
						<button type="button" onclick="validarFormulario(this)" value="Enviar"  name="enviado" class="float-left btn btn-primary"/>Enviar</button>
					</div>
				</form>
			</div>
		</form>
	</div>
</div>
</body>


<!-- script para alternar os campos CPF e CNPJ conforme seleção -->

<script type="text/javascript">

//consultando os botões responsáveis por alternar os campos CPF e CNPJ
var selecao = document.querySelectorAll("[data-tab]");

//consultando os conteudos a serem exibidos.
var conteudos = document.querySelectorAll("[data-content]");

//declarando a função que será associada a cada input:radio
var tabOnClick = function (elem) {  
	for (var indice in conteudos) {
    //verificando se o input:radio selecionado está associado ao conteudo atual.
    var display = conteudos[indice].id == elem.target.dataset.tab ? "block" : "none";
    document.getElementById('formulario').reset();//Reseta os campos quando troca
    conteudos[indice].style.display = display;

    
}
}

//associando todos os input:radio ao método declarado acima.
for (var indice in selecao) {
	selecao[indice].onclick = tabOnClick;
}
</script>


<!-- Mascara do CPF e CNPJ-->
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


<!-- Função utilizada para verificar se o campo CPF ou CNPj estão vazio, se os 2 estiverem, o submit é cancelado -->
<script type="text/javascript">
	function validarFormulario(formularioSelecao){
	erros = 0;
	var myform = document.forms['formularioSelecao'] || document.formulario;
	if(myform.inputCPF.value == "" || myform.inputCPF.selectedIndex == 0){
		erros++;
	}
	if(myform.inputCNPJ.value =="" || myform.inputCNPJ.selectedIndex ==0){
		erros ++;
		
	}
	if(erros < 2){
		myform.submit();
	} else{
		alert("Existem campos em branco!");
		return false;
	}
}
</script>