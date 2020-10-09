<?php

include_once("model/DBManager.php");


class EstadoCivilFactory
{

    public function __construct(){

        $this->dbManager = new DBManager();

    }
    
//Função utilizada para lista os estados civis
public function listaEstadoCivil()
    {
        global $conexao;
        $query = "SELECT descricao,id from estadocivil";
        return $this->dbManager->execSelect($query);        
        
    } 
}

    ?>