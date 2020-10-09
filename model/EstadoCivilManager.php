<?php
require_once("model/EstadoCivilFactory.php");


class EstadoCivilManager
{

    public function __construct(){
        $this->factory = new EstadoCivilFactory();
    }

    public function listaEstadoCivil(){
        return $this->factory->listaEstadoCivil();
    } 
}