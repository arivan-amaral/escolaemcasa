<?php 

session_start();
if (!isset($_SESSION['idprofessor'])) {

       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idprofessor'];

}
 include_once "cabecalho.php";
  include_once "alertas.php";

  include_once "barra_horizontal.php";

  include_once 'menu.php';

  include_once '../Controller/Conversao.php';

  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";

  include_once '../Model/Disciplina.php';

  include_once '../Model/Turma.php';
  include_once '../Model/Escola.php';

  

  

?>



<script src="ajax.js"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>

             <?php
              if (isset($nome_escola_global)) {
                echo $_SESSION['NOME_APLICACAO']; 
              }
              ?>
             <?php if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

 <!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        <!-- Info boxes -->





        <!-- .row -->

        

      <div class="row">

        <div class="col-md-1">

        </div>

         <div class="col-md-10">

            <div class="card card-primary">

                  <div class="card-header">

                    <h3 class="card-title">Cadastrar Minhas Turmas</h3>

                  </div>

                  

                  <form action="../Controller/Associar_disciplina.php" method="post">

                    <div class='card-body'>

                      <label>Selecione a escola</label>

                      <select name='escola'  class="custom-select rounded-0" required>

                        <option></option>

                        <?php

                        $res_turma=lista_escola($conexao); 

                        foreach ($res_turma as $key => $value) {

                            $idescola= $value['idescola'];

                            $nome = ($value['nome_escola']);

                            echo "<option value='$idescola' class='text-black'>$nome</option>";

                          

                        }



                        ?>

                      </select>


                      <label>Selecione a Turma</label>

                      <select name='turma'  class="custom-select rounded-0" required>

                        <option></option>

                        <?php

                        $res_turma=lista_turma($conexao); 

                        foreach ($res_turma as $key => $value) {

                            $idturma = $value['idturma'];

                            $turma = ($value['nome_turma']);

                            echo "<option value='$idturma' class='text-black'>$turma</option>";

                          

                        }



                        ?>

                      </select>



                     <label>Selecione a Disciplina </label>

                      <select name='disciplina'  class="custom-select rounded-0" required>

                        <option></option>

                        <?php

                        $res_disciplina=lista_disciplina($conexao); 

                        foreach ($res_disciplina as $key => $value) {

                            $iddisciplina = $value['iddisciplina'];

                            $disciplina = ($value['nome_disciplina']);

                            echo "<option value='$iddisciplina' class='text-black'>$disciplina</option>";

                          

                        }



                        ?>

                      </select>

                       



                                

                      <div class="card-footer">

                        <button type="submit" class="btn btn-primary">Associar a Turma </button>

                      </div>



                    </div>

                </form>



                </div>

             </div> <!-- </div> class=col- 10 -->

      </div> <!-- </div> row  -->







      <div class="row">

       <div class="card-body">

        <table class="table table-bordered">

          <thead>

            <tr>

              <th style="width: 10px">#id</th>

              <th>Disciplina/Turma</th>

              <th>Opção</th>

              

            </tr>

          </thead>

          <tbody>

            <?php 
               $result_associacoes= lista_minhas_turmas($conexao,$idprofessor,$_SESSION['ano_letivo']);
               foreach ($result_associacoes as $key => $value) {
                $nome_disciplina=$value['nome_disciplina'];
                $nome_turma=$value['nome_turma'];
                $id=$value['idministrada'];

                  echo "
                     <tr>
                      <td>$id</td>

                      <td> 

                        <b class='text-primary'> $nome_disciplina </b> <b class='text-danger'> =>  </b>

                        <b class='text-primary'> $nome_turma</b>

                      </td>
                      <td> <a href='../Controller/Desassociar_professor.php?id=$id' class='btn btn-danger'> Cancelar </a> </td>

                    </tr>
                  ";
               }
            ?>



            </tbody>

          </table>

        </div>

        

      </div>

 

        <!-- Main row -->

        <!-- /.row -->

      </div>





    </div>

  </section>

</div>

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

    include_once 'rodape.php';

 ?>