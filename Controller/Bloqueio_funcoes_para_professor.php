 <?php 
 /////////////////////////////////////////////////////////

// $fallback = 'index.php';

// $anterior = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $fallback;

// header("location: {$anterior}");
exit;
   if (isset($_SESSION['idprofessor'])) {
        if(
         $_SESSION['idprofessor']==382  ||
         $_SESSION['idprofessor']==411  ||
         $_SESSION['idprofessor']==379  ||
         $_SESSION['idprofessor']==277  ||
         $_SESSION['idprofessor']==388  ||
         $_SESSION['idprofessor']==1365 ||
         $_SESSION['idprofessor']==1025 ||
         $_SESSION['idprofessor']==486  ||
         $_SESSION['idprofessor']==1032 ||
         $_SESSION['idprofessor']==1020 ||
         $_SESSION['idprofessor']==401  ||
         $_SESSION['idprofessor']==339  ||
         $_SESSION['idprofessor']==1030 ||
         $_SESSION['idprofessor']==504  ||
         $_SESSION['idprofessor']==409 ||
         $_SESSION['idprofessor']==523 ||
         $_SESSION['idprofessor']==772 ||
         $_SESSION['idprofessor']==1401 ||
         $_SESSION['idprofessor']==733 ||
         $_SESSION['idprofessor']==767 ||
         $_SESSION['idprofessor']==575 ||
         $_SESSION['idprofessor']==768 ||
         $_SESSION['idprofessor']==523 ||
         $_SESSION['idprofessor']==769 ||
         $_SESSION['idprofessor']==1394 ||
         $_SESSION['idprofessor']==337 ||
         $_SESSION['idprofessor']==586 ||
         $_SESSION['idprofessor']==578 ||
         $_SESSION['idprofessor']==516 ||

         $_SESSION['idprofessor']==1074 ||
         $_SESSION['idprofessor']==1001 ||
         $_SESSION['idprofessor']==585 ||
         $_SESSION['idprofessor']==584 ||
         $_SESSION['idprofessor']==576 ||
         $_SESSION['idprofessor']==570 ||
         $_SESSION['idprofessor']==582 ||
         $_SESSION['idprofessor']==505 ||
         $_SESSION['idprofessor']==517 ||
         $_SESSION['idprofessor']==376 ||
         
         $_SESSION['idprofessor']==645 ||
         $_SESSION['idprofessor']==281 ||
         $_SESSION['idprofessor']==325 ||
         $_SESSION['idprofessor']==514 ||
         $_SESSION['idprofessor']==485 || 
         $_SESSION['idprofessor']==467 || 
         $_SESSION['idprofessor']==718 || 
         $_SESSION['idprofessor']==1416 || 
         $_SESSION['idprofessor']==895 ||
         $_SESSION['idprofessor']==972 ||
         $_SESSION['idprofessor']==679 ||
         $_SESSION['idprofessor']==686 || 
         $_SESSION['idprofessor']==305 ||
         $_SESSION['idprofessor']==722 ||
         $_SESSION['idprofessor']==907 ||
         $_SESSION['idprofessor']==867 ||
         $_SESSION['idprofessor']==501
     ) {

        }elseif (isset($_SESSION['cargo'])) {
            if (isset($_SESSION['idprofessor'])) {
                $_SESSION['status']=0;
                $_SESSION['mensagem']='BLOQUEADO PARA PROFESSOR!';
                header("location: ../View/index.php?$url_get");
                exit;
            }
        }else{
                $_SESSION['status']=0;
                $_SESSION['mensagem']='BLOQUEADO PARA PROFESSOR!';
              header("location: ../View/index.php?$url_get");
                exit;
        }
  }
    /////////////////////////////////////////////////////////