  <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
          <?php
          if (isset($_SESSION['idaluno'])) {
              echo "<a href='./aluno.php' class='nav-link'>";
          }else if (isset($_SESSION['idprofessor'])) {
              echo "<a href='./professor.php' class='nav-link'>";
          }else if (isset($_SESSION['idcoordenador'])) {
              echo "<a href='./coordenador.php' class='nav-link'>";
          }else if (isset($_SESSION['idsecretario'])) {
              echo "<a href='./secretario.php' class='nav-link'>";
          }else {
              echo "<a href='./index.php' class='nav-link'>";
              
          }
        ?>
        Início
     </a>
       

      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->




      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <select  id="ano_letivo" class="" onchange="mudar_ano_letivo(this.value);">
      <?php 
            if (isset($_SESSION['ano_letivo'])) {
              if ( $_SESSION['cargo']!="Aluno" && $_SESSION['cargo']!="Aluna") {
                $anos = array(2024,2023,2022,2021 );
                foreach ($anos as $key_a => $value_a) {
                  // code...
                     
                    if ($_SESSION['ano_letivo'] ==$value_a) {
                        echo "<option  value='$value_a' selected>$value_a</option>";
              

                    }else{
                        echo "<option  value='$value_a' >$value_a</option>";
                   


                    }
                }
              }
            }
           ?>
         
        </select>
      </li> 


      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <!-- <i class="far fa-bell"></i> -->
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge" id='quantidade_pedido_transferencia'>0</span>
        </a>

         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="pedido_transferencia">
          


   
          <div class="dropdown-divider"></div>
          <a href="lista_solicitacao_transferencia.php" class="dropdown-item dropdown-footer">Ver tudo</a>
        </div> 
      </li>

      
    </ul>
  </nav>