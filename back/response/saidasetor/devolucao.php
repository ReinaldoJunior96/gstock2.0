<?php
require_once('../../controllers/EstoqueController.php');
require_once ('../../controllers/UsuarioController.php');
$devolucao = new EstoqueController();
$verificacao = new UsuarioController();
if(($verificacao->login($_POST['user'], $_POST['autorizacao'])) == 1 && $_POST['user'] == 'compras.hvu'){
    $devolucao->registrarDevolucao($_POST);
}else{
    header("location: ../../../views/saida/devolucao.php?status=0&idsaida=".$_POST['idsaida']);
    //echo "<script language=\"javascript\">alert(\"Autorização Inválida\")</script>";
    //echo "<script language=\"javascript\">window.history.back();</script>";
}


