<?php

include("model/Conexao.php");

class EstadoCivilFactory
{

//Função utilizada para lista os estados civis
public function listaEstadoCivil()
    {
        global $conexao;
        $tipos = array();
        $query = "SELECT descricao,id from estadocivil";
        try {
            $resultado = mysqli_query($conexao, $query);
            if (mysqli_num_rows($resultado) > 0) {
                $i = 0;
                while ($linha = mysqli_fetch_array($resultado)) {
                    $tipos[$i] = $linha['id'];
                    $tipos[$i + 1] = $linha['descricao'];
                    $i = $i + 2;

                }
                return $tipos;
            } else
                return "Nenhum tipo encontrado";

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            $result = false;
        }
    }
}

    ?>