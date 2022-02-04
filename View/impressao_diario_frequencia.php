<?php 
session_start();
try {
    
echo "certo";

} catch (Exception $e) {
    echo "erro: $e";
}
 ?>