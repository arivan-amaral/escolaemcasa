<?php
session_start();
try {
    $_SESSION['ano_letivo']=$_GET['muda_ano_letivo'];
    echo "certo";
  
} catch (Exception $e) {
     echo "erro"; 
}
?>