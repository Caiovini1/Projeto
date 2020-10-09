<?php

if (!defined("HOST")) {
    define('HOST', '127.0.0.1');
}
if (!defined("USER")) {
    define('USER', 'root');
}
if (!defined("PASSWORD")) {
    define('PASSWORD', 'root');
}
if (!defined("DB")) {
    define('DB', 'cadastros');
}


$conexao = mysqli_connect(HOST, USER, PASSWORD, DB) or die ('Nao foi possível conectar');
mysqli_query($conexao, "SET NAMES utf8");
mysqli_query($conexao, "SET CHARACTER_SET utf8");
?>