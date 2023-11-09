 <?php 

// exit;
   if (isset($_SESSION['idprofessor'])) {
        if( $_SESSION['idprofessor']==0 ) {

        }elseif (isset($_SESSION['cargo'])) {
            if (isset($_SESSION['idprofessor'])) {
                //$_SESSION['status']=0;
               // $_SESSION['mensagem']='BLOQUEADO PARA PROFESSOR!';
               // header("location: ../View/index.php?$url_get");
                // exit;
            }
        }else{
                //$_SESSION['status']=0;
               // $_SESSION['mensagem']='BLOQUEADO PARA PROFESSOR!';
             // header("location: ../View/index.php?$url_get");
                // exit;
        }
  }
    /////////////////////////////////////////////////////////