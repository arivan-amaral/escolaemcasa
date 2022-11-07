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

  include_once '../Model/Conexao.php';

  include '../Model/Aluno.php';
  include '../Model/Professor.php';
  include '../Model/Serie.php';
  include '../Model/Disciplina.php';
  include '../Model/Estado.php';

  $idserie=$_REQUEST['serie_id']; 
  $idescola=$_REQUEST['escola_id']; 
  $idturma=$_REQUEST['turma_id']; 
  $idaluno=$_REQUEST['aluno_id']; 
 
?>



<script src="ajax.js?<?php echo rand(); ?>"></script>


<div class="content-wrapper" style="min-height: 529px;">



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">
        <!-- Info boxes -->
        <!-- .row -->
  <!-- <form action="../Controller/Cadastrar_nota_fora_rede.php" method="post">  -->
       
           <input type="hidden" name="idescola" value="<?php echo $idescola; ?>">
           <input type="hidden" name="idturma" value="<?php echo $idturma; ?>">
           <input type="hidden" name="idaluno" id="idaluno" value="<?php echo $idaluno; ?>">

 

<?php 

$res_aluno=meus_dados_aluno($conexao,$idaluno);
$nome_aluno="";
foreach ($res_aluno as $key => $value) {
  $nome_aluno=$value['nome'];
}

 ?>
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-12">
            <button class="btn btn-block btn-lg btn-success">REGISTRO DE NOTAS FORA DA REDE<br>ALUNO: <?php echo "$nome_aluno"; ?></button>
        </div>
      </div>
      <br>

      <div class="row">
        
        <div class='col-sm-3'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Escola de origem<b class="text-danger">*</b></label>
                  <input class='form-control' id='escola_origem' name='escola_origem' required=''>
                    
                </div>
              </div>  
        <div class="col-sm-2">
          <div class="form-group">
            <label for="exampleInputEmail1">Estado<b class="text-danger">*</b></label>


            <select class="form-control" id='estado' name='estado' required="">
              <option value=''>Selecione</option>
              <?php 
                $res_estado = listar_estado($conexao);
                foreach ($res_estado as $key => $value) {
                  $sigla = $value['uf'];
                  echo "<option value='$sigla'>$sigla</option>";
                }

                
               ?>
            </select>
          </div>
        </div>  

        <div class="col-sm-2">
          <div class="form-group">
            <label for="exampleInputEmail1">Ano de referência<b class="text-danger">*</b></label>


            <select class="form-control" id='ano_referencia' name='ano_referencia' required="">
           
              <?php 
               for ($i=(date("Y")); $i > 2000 ; $i--) { 
                echo "<option value='$i'>$i</option>";
                }
               ?>
            </select>
          </div>
        </div>         

        <div class="col-sm-2">
          <div class="form-group">
            <label for="exampleInputEmail1">Série<b class="text-danger">*</b></label>

            <select class="form-control" id='idserie' name='idserie' required="">
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


        <div class="col-sm-2">
          <div class="form-group">
            <label for="exampleInputEmail1">Disciplina<b class="text-danger">*</b></label>

            <select class="form-control" id='iddisciplina' name='iddisciplina' required="">
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

            <select class="form-control" id='aluno_finalizou' name='aluno_finalizou' required="" onchange="view_nota_fora_rede_ano_finalizado(this.value);">
              <option value="Sim">Sim</option>
              <option value="Não">Não</option>
              <!-- <option value="Não">Não</option> -->
              </select>
          </div>
        </div> 

</div>
  <div class="row" id='aluno_finalizado_ano'>
      

  </div>



<div class="row">
   <div class="col-sm-2"></div>
   <div class="col-sm-8">
          <div class="form-group">
           <button class="btn btn-block btn-primary" onclick="cadastrar_nota_fora_rede_ano_finalizado();">CADASTRAR</button>
              
          </div>
        </div>
  </div>

<script type="text/javascript">
          setTimeout("view_nota_fora_rede_ano_finalizado('Sim');",100);
          setTimeout("lista_notas_cadastrada_fora();",200);
</script>


      

    
 <!-- </form> -->


       
        <div class="row" id='lista_notas_cadastrada_fora'>
                              
        </div>


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