<?php

header("Content-Type: text/html; charset=utf-8", true);
require_once 'class/config.class.php';

$erro = NULL;
$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];

if (empty($login)) {
    $erro = "Por favor, digite o nome de usuário!";
} else if (empty($senha)) {
    $erro = "Por favor, digite sua senha!";
} else {
    $senha = md5($senha);
    $select = $crud->select('COUNT(*) quantidade, tipo_usuario tipo, status_login', 'login', 'WHERE nome_usuario = :login AND senha = :senha')->run([':login' => $login, ':senha' => $senha]);
    $valores = $select->fetch(PDO::FETCH_ASSOC);

    if ($valores['quantidade'] == 1) {
        if ($valores['status_login'] == 0) {
            $erro = 'Login Inativo';
        }
    } else {
        $erro = 'Usuário ou Senha Incorretos';
    }
}
if ($erro) {
    header("location:login.php?erro=$erro");
} else {    
    @session_start();
    $_SESSION['cpf'] = $login;
    $_SESSION['tipo_usuario'] = $valores['tipo'];
    $select_id_professor = $crud->select('p.id_professor', 'professor p', 'WHERE p.cpf = ?')->run([$login]);
    $val = $select_id_professor->fetch(PDO::FETCH_ASSOC);
    $_SESSION['cod_professor'] = $val['id_professor'];

    if ($_SESSION['tipo_usuario'] == 'ADMINISTRADOR') {
        header("location:admin/index.php");
    } else if ($_SESSION['tipo_usuario'] == 'DATASHOW') {
        header("location:datashow/index.php");
    } else {
        header("location:professor/index.php");
    }
}
     