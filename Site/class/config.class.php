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

/*	require "conexao.php";
	
		@session_start();
		$_SESSION['nome_usuario'] = $nome_usuario;
		$_SESSION['nome_completo'] = $nome_completo;
		$_SESSION['senha'] = $senha;
		$_SESSION['tipo_usuario'] = $tipo_usuario;
	
		if($nome_usuario == '')
		{
			echo "<script language='javascript'>window.location='../index.php';</script>";	
		}
		else if($nome_completo == '')
		{
			echo "<script language='javascript'>window.location='../index.php';</script>";	
		}
		else if($senha == '')
		{
			echo "<script language='javascript'>window.location='../index.php';</script>";
		}
		else if($usuario_atual != $tipo_usuario)
		{
			echo "<script language='javascript'>window.location='../index.php';</script>";
		} */
	

//@session_start();
//$tipo_usuario = @$_SESSION['tipo_usuario'];
//
//if (($tipo_usuario == 'PROFESSOR') || ($tipo_usuario == 'ADMINISTRADOR')) {
//    
//    echo $tipo_usuario . '</br></br>';    
//    $_SESSION['nome_usuario'];
//    @$_SESSION['vazia'];
//    
//    echo $retorno = is_null(@$_SESSION['vazia']) ? 'Session "vazia" é NULL' : 'Session "Vazia" não é NULL';
//    
//} else {
//    echo $tipo_usuario;
//    //header("location:index.php");
//}

//    echo "<script language='javascript'>window.location='../index.php';</script>";
//} else if ($nome_completo == '') {
//    echo "<script language='javascript'>window.location='../index.php';</script>";
//} else if ($senha == '') {
//    echo "<script language='javascript'>window.location='../index.php';</script>";
//} else if ($usuario_atual != $tipo_usuario) {
//    echo "<script language='javascript'>window.location='../index.php';</script>";
//}