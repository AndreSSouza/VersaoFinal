<?php
$usuario_atual = "DATASHOW";
require '../class/config.class.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />     
        <link href="css/topo.css" rel="stylesheet" type="text/css" />
        <script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
        <script src="../js/lightbox.js"></script>
        <link href="../css/lightbox.css" rel="stylesheet" />
        <link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript" src="../jquery.superbox-min.js"></script>
        <script type="text/javascript">
            $(function () {
                $.superbox.settings = {
                    closeTxt: "Fechar",
                    loadTxt: "Carregando...",
                    nextTxt: "Next",
                    prevTxt: "Previous"
                };
                $.superbox();
            });
        </script>   
    </head>
    <body bgcolor="#000">        
        <div id="logo">
            <img src="../img/logoEtec.png" width="100px" height="144px" style="background-color: #2c82ce;"/>
        </div>         
        <div id="box_menu">
            <div id="menu_topo">
                <ul>  				
                    <li><a href="data_show.php">Data Show</a></li>
                    <li><a href="#">Conta</a></li>                    
                </ul>
            </div>
        </div>
    </body>
</html>