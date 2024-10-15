<?php

$host = "MySql";
$db = "crud_clientes";
$user = "root";
$pass = "1q2w3e4r5t";

$mysqli = new mysqli($host, $user, $pass, $db);
if($mysqli->connect_errno) {
    die("Falha na conexão com o banco de dados");
}

function formatar_data($data){
    return implode('/', array_reverse(explode('-', $data)));
}

function formatar_telefone($telefone){
    $ddd = substr ($telefone, 0, 2);
    $parte1 = substr ($telefone, 2, 5);
    $parte2 = substr ($telefone, 7);
    return "($ddd) $parte1-$parte2";
}