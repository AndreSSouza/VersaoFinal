<?php

date_default_timezone_set('America/Sao_Paulo');

require 'CRUD.class.php';

$crud = new CRUD();

session_start();
@$tipo_usuario = @$_SESSION['tipo_usuario'];
if (@$usuario_atual) {
    if (@$tipo_usuario != @$usuario_atual) {
        header("location:../index.php");
    }
}

if (@$_GET['pg'] == 'sair') {
    session_destroy();
    $_SESSION['cpf'];
    $_SESSION['tipo_usuario'];       
    $_SESSION['cod_professor'];

    header("location:../index.php");
}	