<?php
session_start();
$_SESSION['status']=0;
$_SESSION['mensagem']='Acesso negado';
header("location:../View/");
?>