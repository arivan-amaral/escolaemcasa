  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
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
        <a class="nav-link" data-toggle="dropdown" href="#">
          <!-- <i class="far fa-bell"></i> -->
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge" id='quantidade_pedido_transferencia'>0</span>
        </a>

         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="pedido_transferencia">
          


   
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Ver tudo</a>
        </div> 
      </li>

      
    </ul>
  </nav>