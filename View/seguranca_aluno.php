<?php 
session_start();
if (!isset($_SESSION['idaluno']) || !isset($_SESSION['cargo']) ) {
    $_SESSION['status']=0;
    header("location:index.php?status=0");

}else{
  $idaluno=$_SESSION['idaluno'];

} ?>