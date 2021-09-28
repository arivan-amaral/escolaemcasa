<?php
  if (!isset($_SESSION['mensagem'])) {
       $mensagem=$_SESSION['mensagem']="";
  }  

  if (isset($_SESSION['erro_sql'])) {
    $erro_sql=$_SESSION['erro_sql'];
      echo "
      <script>
          alert($erro_sql);
      </script>"; 
  }

  if (isset($_SESSION['status'])) {
  $mensagem='';   
  if (isset($_SESSION['mensagem'])) {
     $mensagem=$_SESSION['mensagem'];
  }
    
    if($_SESSION['status']==0){
        echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: ' $mensagem'
            
          });
      </script>"; 
     
        
    }else if($_SESSION['status']==1) {
      echo "<script>      
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Ação Concluída',
             text: ' $mensagem',
          showConfirmButton: false,
          timer: 1500
        });
      </script>"; 
      
    }

    unset($_SESSION['status']);
    unset($_SESSION['mensagem']);
   // unset($_SESSION['erro_sql']);
    
  } 
?>