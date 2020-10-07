<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Listar Usuários</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">

<body>
<?php include('menu.php');?>



<div class="container-fluid mt-3">
    <h2>Lista de Usuários</h2>
    <div>
    <a class="float-right btn btn-outline-success active" href="index.php?section=Controle&function=cadastrarUsuarioAcao">Cadastrar novo usuário</a>
    <a class="float-right btn btn-secondary" href="index.php?section=Controle&function=gerarRelatorioUsuario">Gerar PDF</a>
    </div>
    <table id="minhaTabela" class="table-hover table-striped table-bordered" data-searching="false">
        <thead>
        <tr>
            <th>idUsuario</th>
            <th>Nome</th>
            <th>Login</th>
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
                    <td><a class="btn btn-warning" href="?section=Controle&function=detalharUsuario&idUsuario=<?= $dados[$i][0] ?>">
                    Detalhar</a>
                    <a class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este registro?')" href="?section=Controle&function=deletarUsuario&idUsuario=<?= $dados[$i][0] ?>">Excluir</a>
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