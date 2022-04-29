<?php 
session_start();
if (isset($_SESSION['funcao'])) {
  if ($_SESSION['funcao'] !='Administrador') {
    header("location:index.php?status=0");
  }
}

  include "cabecalho.php";
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Funcionario.php';
  include '../Model/Conexao.php';
 
  

  if (isset($_GET['id'])) {
    $id=$_GET['id'];
  }else{
    header("Location:pesquisar_funcionario.php");
  }



  if (isset($_SESSION['resposta'])) {
    if($_SESSION['resposta']==0){
        echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Tente novamente!',
          })
      </script>"; 
      unset($_SESSION['resposta']); 
    }else {
      echo "</script>      
       Swal.fire(
        'Ação Concluida !',
        'q',
        'success'
      )
      </script>";
      unset($_SESSION['resposta']); 
    }
  }

    echo "</script>      
       Swal.fire(
        'Ação Concluida !',
        'q',
        'success'
      )
      </script>";
?>

<script src="ajax.js"></script>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-1">
        </div>
         <div class="col-md-10">
            <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">EDITANDO FUNCIONÁRIO</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="../Controller/Alterar_funcionario.php" method="POST">

                    <div class='card-body'>
                      <?php 
                          $result= pesquisa_alterar_funcionario($conexao,$id);

                          foreach ($result as $key => $value) {
                            $id=$value['id'];
                            $status=$value['status'];
                            $nome=$value['nome'];
                            $usuario=$value['usuario'];
                            $senha=$value['senha'];
                            $funcao=$value['funcao'];
                            echo "
                                <input type='hidden' class='form-control' name='id' value='$id'>

                                <div class='form-group'>
                                  <label for='exampleInputEmail1'>Nome</label>
                                  <input type='text' class='form-control' name='nome' value='$nome'>
                                </div>

                                <div class='form-group'>
                                  <label><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'>Status</font></font></label>
                                  <select class='custom-select' name='status'>";
                                    if ($status==1) {
                                      echo"<option value='$status'>Ativo</option>
                                            <option value='0'>Suspenso</option>";
                                    }else {
                                      echo"<option value='$status'>Suspenso</option>
                                            <option value='1'>Ativo</option>";
                                    }
                            echo"</select>
                                </div>

                                <div class='form-group'>
                                  <label for='exampleInputEmail1'>Usuário</label>
                                  <input type='text' class='form-control' name='usuario' value='$usuario'>
                                </div>

                                 <div class='form-group'>
                                  <label for='exampleInputEmail1'>Senha</label>
                                  <input type='text' class='form-control' name='senha' value='$senha'>
                                </div>

                                <div class='form-group'>
                                  <label><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'>Função</font></font></label>
                                  <select class='custom-select' name='funcao'>
                                    <option value='$funcao'>$funcao</option>

                                    <option value='Garçom'>Administrador</option>
                                    <option value='Garçom'>Garçom</option>
                                    <option value='Porteiro'>Porteiro</option>
                                    <option value='Cozinha'>Cozinha</option>
                                    <option value='Bar/Copa'>Bar/Copa</option>
                                  </select>
                                </div>

                                ";
                         }

                      ?>
                     
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Concluir</button>
                    </div>

                  </form>
                </div>
             </div> <!-- </div> class=col- 10 -->
      </div> <!-- </div> row  -->
</div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <script type="text/javascript">
    /* Máscaras ER */
    function mascara(o,f){

        v_obj=o

        v_fun=f

        setTimeout("execmascara()",1)

    }

    function execmascara(){

        v_obj.value=v_fun(v_obj.value)

    }

    function mtel(v){

        v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito

        v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos

        v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos

        return v;

    }
    </script>
 <?php 
    include 'rodape.php';
 ?>