  
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->

  <a href="index.php" class="brand-link">
    <img src="imagens/logo.png" alt="educalem" style=" " height="100">
    <!-- <span class="brand-text font-weight-light">EDUCA LEM</span> -->
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
      </div>
      <div class="info">
        <a href="#" class="d-block">
          <?php
          if (isset($_SESSION['cargo'])){
            echo $_SESSION['nome'];

          } 
          ?>
        </a>

      </div>
    </div>
    <!-- SidebarSearch Form -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
          <a href="./index.php" class="nav-link active">

            <i  class="nav-icon fas fa-tachometer-alt"></i>
            <p>Principal <i class="right fas fa-angle-left"></i></p>
          </a>


          <?php 


          echo "<ul class='nav nav-treeview'>
          <li class='nav-item'>";
          if (isset($_SESSION['idaluno'])) {
            echo "<a href='./aluno.php' class='nav-link'>";
          }else if (isset($_SESSION['idprofessor'])) {
            echo "<a href='./professor.php' class='nav-link'>";
          }else if (isset($_SESSION['idcoordenador'])) {
            echo "<a href='./coordenador.php' class='nav-link'>";
          }else {
            echo "<a href='./index.php' class='nav-link'>";

          }
          echo "<i class='far fa-circle nav-icon text-warning'></i>
          <p>Início</p>
          </a>
          </li>
          </ul>";





          $res_acesso=$conexao->query("SELECT * FROM menu_opcao  ORDER BY titulo asc");
          foreach ($res_acesso as $key => $value) {


            if ($_SESSION['nivel_acesso_id']==100) {
              // echo $value['id']."<br>";

            }
                echo $value['opcao'];



            if ($_SESSION['cargo']=='Professor' || $_SESSION['cargo']=='Professora' ){


            }else if ($_SESSION['cargo']=='Aluno' || $_SESSION['cargo']=='Aluna') {



            }


        }// fim do IF que verifica se tem sessão FUNÇÃO ativa...


        if (isset($_SESSION['cargo'])) {
         echo" <li class='nav-item'>
         <a href='./logout.php' class='nav-link'>
         <i class='far fa-circle nav-icon text-danger'></i>
         <p>SAIR</p>
         </a>
         </li>";
       } else{
        echo "
        <li class='nav-item' id='entrar'>
        <a href='./index.php' class='nav-link' data-toggle='modal' data-target='#modal-default'>
        <i class='far fa-circle nav-icon text-success'></i>
        <p>Entrar</p>
        </a>
        </li>";
      }
      ?>
      <!-- ********************************************* -->
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->

</aside>
