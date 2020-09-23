<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listar Pessoas</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">

<body>
<?php include('menu.php');?>



<div class="container-fluid mt-3">
    <h2>Lista de Pessoas</h2>
    <div>
    <a class="float-right btn btn-outline-success active" href="index.php?section=Controle&function=cadastrarPessoaAcao">Cadastrar nova pessoa</a>  
    <a class="float-right btn btn-secondary" href="index.php?section=Controle&function=gerarRelatorioPessoa">Gerar PDF</a>
    </div>


    <table id="minhaTabela" style="font-size: 15px" class="table-hover table-bordered" data-searching="false">
        <thead>
        <tr>
            <th>ID Pessoa</th>
            <th>RG</th>
            <th>CPF</th>
            <th>CNPJ</th>
            <th>Razão Social</th>
            <th>Nome Fantasia</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Estado Civil</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        if (!is_null($dados)) {
            for ($i = 0; $i < count($dados); $i++): ?>
                <tr>
                    <td><?= $dados[$i][0] ?></td>
                    <td><?= $dados[$i][1] ?></td>
                    <td><?= $dados[$i][2] ?></td>
                    <td><?= $dados[$i][3] ?></td>
                    <td><?= $dados[$i][4] ?></td>
                    <td><?= $dados[$i][5] ?></td>
                    <td><?= $dados[$i][6] ?></td>
                    <td><?= $dados[$i][7] ?></td>
                    <td><?= $dados[$i][8] ?></td>

                    <td><a class="btn btn-warning" href="?section=Controle&function=detalharPessoa&idPessoa=<?= $dados[$i][0] ?>">
                    Detalhar</a>
                    <a class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este registro?')" href="?section=Controle&function=deletarPessoa&idPessoa=<?= $dados[$i][0] ?>">Excluir</a>
                    </td>

                </tr>
            <?php endfor;
        } ?>
        </tbody>
    </table>
</div>


<!-- Código para fazer a lista de usuários com paginação -->
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#minhaTabela').DataTable({
            "responsive": true,
            "language": {
                "lengthMenu": "",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "paginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
            }
        });
    });
</script>
</body>
</html>