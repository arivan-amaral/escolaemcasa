<?php 
session_start();
if (!isset($_SESSION['idfuncionario'])) {
       header("location:index.php?status=0");

}else{

  $idfuncionario=$_SESSION['idfuncionario'];

}
  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";

  include 'menu.php';

  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';

  include '../Model/Aluno.php';
  include '../Model/Professor.php';

  $idserie=$_POST['serie_id']; 
  $idescola=$_POST['escola_id']; 
  $idturma=$_POST['turma_id']; 
  $aluno=$_POST['aluno_id']; 
 
?>



<script src="ajax.js?<?php echo rand(); ?>"></script>


<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-1"></div>
          <div class="col-sm-10 alert alert-warning text-center">

            <h1 class="m-0"><b>           

             <?php
             echo "$nome_escola_global"; 

             if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

          

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">
        <!-- Info boxes -->
        <!-- .row -->
  <form action="../Controller/Cadastrar_nota_fora_rede.php" method="post">
           
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <button class="btn btn-block btn-lg btn-secondary">REGISTRO DE NOTAS FORA DA REDE</button>
        </div>
      </div>
      <br>

      <div class="row">
        


        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Série</label>

            <select class="form-control" id='periodo' name='periodo' required="">
              <option></option>
              <?php 
                $resultado=listar_trimestre($conexao);
                foreach ($resultado as $key => $value) {
                  $idperiodo=$value['id'];
                  $descricao=$value['descricao'];
                  if ($idserie <3 && $idperiodo==6) {
                    echo"<option value='$idperiodo'>$descricao</option>";

                  }else if ($idperiodo !=6) {
                    echo"<option value='$idperiodo'> $descricao</option>";
                  }
                  
                }

               ?>
            </select>
          </div>
        </div>        


        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Disciplina</label>

            <select class="form-control" id='periodo' name='periodo' required="">
              <option></option>
              <?php 
                $resultado=listar_trimestre($conexao);
                foreach ($resultado as $key => $value) {
                  $idperiodo=$value['id'];
                  $descricao=$value['descricao'];
                  if ($idserie <3 && $idperiodo==6) {
                    echo"<option value='$idperiodo'>$descricao</option>";

                  }else if ($idperiodo !=6) {
                    echo"<option value='$idperiodo'> $descricao</option>";
                  }
                  
                }

               ?>
            </select>
          </div>
        </div> 

        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Média/Nota</label>

            <input class="form-control" id='nota' name='nota' required="">
            
          </div>
        </div>
 

      <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Carga horária</label>

            <input class="form-control" id='carga_horaria' name='carga_horaria' required="">
              
          </div>
        </div>

   <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Total faltas</label>

            <input class="form-control" id='total_falta' name='total_falta' required="">
              
          </div>
        </div>
  </div>
  
<div class="row">
   <div class="col-sm-2"></div>
   <div class="col-sm-8">
          <div class="form-group">
           <button type="submit" class="btn btn-block btn-primary">CADASTRAR</button>
              
          </div>
        </div>



      
      </div>


<input type="hidden" name="url_get" id="url_get" value="<?php echo $url_get; ?>">

<input type="hidden" name="idserie" id="idserie" value="<?php echo $idserie; ?>" >
<input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>">
<input type="hidden" name="idturma" id="idturma" value="<?php echo $idturma; ?>">
<input type="hidden" name="iddisciplina" id="iddisciplina" value="<?php echo $iddisciplina; ?>" readonly>




<a name="listaAlunos"></a>
  <div id="listagem_avaliacao">


  </div>

   

      <div class="row" id="botao_continuar">
        
      </div>
      
 </form>
        <!-- Main row -->

        <!-- /.row -->

      </div>

    </div>

  </section>

</div>



<script>
    function somenteNumeros(num,tamanho) {
        var er = /[^0-9.]/;
        er.lastIndex = 0;
        var campo = num;
        var valor_campo_nota=campo.value;
        campo.value=valor_campo_nota.replace(",", ".");

   
        if (er.test(campo.value)) {
          campo.value = "";
                  Swal.fire('Esse campo é permitido apenas números, consulte seu coordenador para mais informações.', '', 'info')


        }else{

            if(campo.value>tamanho){
              Swal.fire('A nota não pode ser maior que: '+tamanho+'.', '', 'info')
              campo.value = "";
            }
        }


    }


   
  </script>







 <?php 

    include 'rodape.php';

 ?>