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
  include '../Model/Serie.php';
  include '../Model/Disciplina.php';

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
            <label for="exampleInputEmail1">Ano de referência</label>


            <select class="form-control" id='periodo' name='periodo' required="">
           
              <?php 
               for ($i=date("Y"); $i > 2000 ; $i--) { 
                echo "<option value='$i'>$i</option>";
                }
               ?>
            </select>
          </div>
        </div>         

        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Série</label>

            <select class="form-control" id='periodo' name='periodo' required="">
              <option></option>
              <?php 
                $resultado=lista_todas_series($conexao);
                foreach ($resultado as $key => $value) {
                  $idserie_bd=$value['id'];
                  $descricao=$value['nome'];
                  
                    echo"<option value='$idserie_bd'> $descricao</option>";
                  
                  
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
                $resultado=lista_disciplina_nao_facultativa($conexao);
                foreach ($resultado as $key => $value) {
                  $iddisciplina_bd=$value['iddisciplina'];
                  $nome_disciplina=$value['nome_disciplina'];
                   
                    echo"<option value='$iddisciplina_bd'> $nome_disciplina</option>";
                  
                  
                }

               ?>
            </select>
          </div>
        </div>         

        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Aluno já finalizou a série?</label>

            <select class="form-control" id='aluno_finalizou' name='aluno_finalizou' required="" onchange="registra_nota_fora_rede_ano_finalizado(this.value);">
              <option value="Sim">Sim</option>
              <option value="Não">Não</option>
              </select>
          </div>
        </div> 

<div class="row" id='aluno_finalizado_ano'>
  
   <div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Tipo registro</label>
            <select class='form-control' id='tipo_registro' name='tipo_registro' required=''>
                <option value='Nota Final'>Nota final</option>
            
                
            </select>
            
          </div>
        </div>
      <div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Nota final</label>

            <input class='form-control' id='nota_final' name='nota_final' required='' onkeyup='somenteNumeros(this,10);'>
              
          </div>
        </div>      

        <div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Carga horária</label>

            <input class='form-control' id='carga_horaria' name='carga_horaria' required='' onkeyup='somenteNumeros(this,300);'>
              
          </div>
        </div>

   <div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Total faltas</label>

            <input class='form-control' id='total_falta' name='total_falta' required=''onkeyup='somenteNumeros(this,200);'>
              
          </div>
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
                  Swal.fire('Esse campo é permitido apenas números.', '', 'info')


        }else{

            if(campo.value>tamanho){
              Swal.fire('O valor não pode ser maior que: '+tamanho+'.', '', 'info')
              campo.value = "";
            }
        }


    }


   
  </script>







 <?php 

    include 'rodape.php';

 ?>