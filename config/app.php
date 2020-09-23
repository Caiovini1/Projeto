<?php



class App {
    const CONTROLE = 'Controle';

    public function __construct (){
        $this->handleRequest ();
    }

    private function handleRequest (){
        $section = isset($_GET['section']) ? $_GET['section'] : 'default';
        switch ($section){
            case self::CONTROLE:
                new Controle();
                break;
            default:
                session_start();
                require('view/homePage.php');
                break;
        }
    }
}