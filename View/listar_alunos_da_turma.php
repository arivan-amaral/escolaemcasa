<?php 

session_start();
if (!isset($_SESSION['idfuncionario'])) {
       header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];
  $idfuncionario=$_SESSION['idfuncionario'];
 
}
  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";

  include 'menu.php';

  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';

  include '../Model/Aluno.php';
  include '../Model/Coordenador.php';
  include '../Model/Escola.php';
  include '../Model/Serie.php';

  $idturma=$_GET['idturma']; 
  $idescola=$_GET['idescola']; 
  $serie_id=$_GET['idserie']; 

?>



<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-12 alert alert-warning">
<center>
            <h1 class="m-0"><b>

             <?php
              if (isset($nome_escola_global)) {
                echo $nome_escola_global; 
              }
              ?>

             <?php if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

            } 

             ?></b></h1>
</center>

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



      <div class="row">
          <div class="col-sm-3">
            <a  class="btn btn-block btn-primary" onclick="procedimento_transferencia();"  data-toggle='modal' data-target='#modal_transferencia'>Transferir selecionados</a>
          </div>

          <div class="col-sm-3">
            <a href="" class="btn btn-block btn-success">Rematricular selecionados</a>
          </div>   

          <div class="col-sm-3">
            <a href="" class="btn btn-block btn-success">Trocar de turma os selecionados</a>
          </div>


      </div>


 
<form action=" " name="procedimentos" id="procedimentos" method="post">

 


      <div class="row">

       <div class="card-body">

        <table class="table table-bordered">

          <thead>
            <tr>
              <th style="width: 20px">
                Todos
               <input type='checkbox' id='checkTodos' class='checkbox' name='checkTodos' onclick='seleciona_todos_alunos();'> 
              </th>

              
              <th>Dados do Aluno</th>
              <th>Opção</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $conta_aluno=1; 
            $matricula="";
            $res_alunos=array();
            // $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
             foreach ($res_alunos as $key => $value) {

              $idaluno=$value['idaluno'];
              $nome_aluno=$value['nome_aluno'];
              $matricula=$value['matricula'];

              $res_movimentacao=array();
            // pesquisar_aluno_da_turma_ata_resultado_final
              // $res_movimentacao=pesquisar_aluno_da_turma_listagem($conexao,$matricula);

              $data_evento="";
              $descricao_procedimento="";
              $procedimento="";
              $datasaida="";
            
              foreach ($res_movimentacao as $key => $value) {
                  $datasaida=($value['datasaida']);
                  $procedimento=$value['procedimento'];
                  
                  if ($datasaida!="") {
                    $datasaida=converte_data($datasaida);
                  }
              }
  // <b class='text-primary'> $nome_turma</b><BR>
          // <b class='text-danger'>$email  </b><BR>
          // <b class='text-danger'>Senha: $senha  </b><BR>
    echo "

       <tr>
    

        <td> 
          <b class='text-success'> $nome_aluno </b> <BR>
          <b class='text-danger'> $procedimento $datasaida  </b> <BR>
        
        </td>
        <td > ";
        if ($procedimento=='EVADIDO') {

            // echo"<div class='form-group' id='evadido_btn$matricula'>
            //   <a class='btn btn-danger' onclick='desmarcar_aluno_evadido($matricula);'>DESMARCAR DE EVADIDO </a>
            // </div>";  
            
          //  echo"<div class='form-group'>
          //   <div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success '>
          //     <input type='checkbox' class='custom-control-input' id='customSwitch3$id' onclick='mudar_status_aluno(1,$id)'>

          //     <label class='custom-control-label' for='customSwitch3$id'></label>
          //   </div>
          // </div>";
        }elseif ( $procedimento=='MATRICULADO'){
           // echo"<div class='form-group'  id='evadido_btn$matricula'>
           //    <a class='btn btn-primary' onclick='marcar_aluno_evadido($matricula);'>MARCAR COMO EVADIDO </a>
           //  </div>";  
            
           
           //  // echo"<div class='form-group'>
           //    <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
           //      <input type='checkbox' class='custom-control-input' id='customSwitch3$idaluno' onclick='mudar_status_aluno(0,$idaluno)' checked>

           //      <label class='custom-control-label' for='customSwitch3$idaluno' id='customSwitch3$idaluno' ></label>
           //    </div>
           //  </div>";
          
        }
        

        echo"</td>

      </tr>
    ";


          }
?>



            <?php 
               //$result= array();
                $result= listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);

               foreach ($result as $key => $value) {
                $nome_aluno=utf8_decode($value['nome_aluno']);
                $nome_turma=($value['nome_turma']);
                $id=$value['idaluno'];
                $status_aluno=$value['status_aluno'];
                $email=$value['email'];
                $senha=$value['senha'];

                  echo "
                     <tr>
                     <td><p><input type='checkbox' class='checkbox' name='aluno$id '  value='$id'  >   </p></td>
              
                      <td>$id -
                        <b class='text-primary'> $nome_turma</b><BR>
                        <b class='text-success'> $nome_aluno </b> <BR>
                        <b class='text-danger'>$email  </b><BR>
                        <b class='text-danger'>Senha: $senha  </b><BR>


                      </td>
                      <td> ";
                      if ($status_aluno =='Ativo') {
                          echo"<div class='form-group'>
                            <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
                              <input type='checkbox' class='custom-control-input' id='customSwitch3$id' onclick='mudar_status_aluno(0,$id)' checked>

                              <label class='custom-control-label' for='customSwitch3$id' id='customSwitch3$id' ></label>
                            </div>
                          </div>";
                      }else{
                        echo"<div class='form-group'>
                          <div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success '>
                            <input type='checkbox' class='custom-control-input' id='customSwitch3$id' onclick='mudar_status_aluno(1,$id)'>

                            <label class='custom-control-label' for='customSwitch3$id'></label>
                          </div>
                        </div>";
                      }
                      

                      echo"</td>

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

    function seleciona_todos_alunos(){

      var checkBoxes = document.querySelectorAll('.checkbox');
      var selecionados = 0;
      checkBoxes.forEach(function(el) {
         if(el.checked) {
             //selecionados++;
             console.log(el.value);
            el.checked=false;
         }else{
           
            el.checked=true;
         }
        
      });
     // console.log(selecionados);

    }

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


<!--   <script>
    function removerChecked(id) {
        var ele = document.getElementByName(id);
        for(var i=0;i<ele.length;i++){
           ele[i].checked = false;
        }
    }

    function addChecked(id) {
        var ele = document.getElementByName(id);
        for(var i=0;i<ele.length;i++){
           ele[i].checked = true;
        }
    }
  </script> -->


  <div class="modal fade bd-example-modal-lg" id="modal_transferencia">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">PROCEDIMENTO TRANSFERÊNCIA</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">    
          
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Escola pretendida</label>
                      <select class="form-control"  name="escola_id" id="escola" required onchange="listar_vagas_turma_transferencia_aluno()">
                        <option></option>
                        <option value='ESCOLA FORA DO MUNICÍPIO' style='color: black; background-color:#8B0000;'>ESCOLA FORA DO MUNICÍPIO </option>
                        <?php 
                        $res_turma=escola_associada($conexao,$idfuncionario); 
                        $array_escolas_coordenador=array();
                        $conta_escolas=0;
                        foreach ($res_turma as $key => $value) {
                          $array_escolas_coordenador[$conta_escolas]=$value['idescola'];
                          $conta_escolas++;
                        }

                        $res_escola=lista_escola($conexao);
                        foreach ($res_escola as $key => $value) {
                         $idescola=$value['idescola'];
                         $nome_escola=$value['nome_escola'];
                         
                          if (in_array($idescola, $array_escolas_coordenador) ) { 
                            echo"<option value='$idescola' style='color: white; background-color:#A9A9A9;'>$nome_escola </option>";
                          }else{
                              echo"<option value='$idescola'>$nome_escola </option>";
                          }

                         
                        }
                       ?>
                     </select>
                   </div>
                 </div>
                 <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Série</label>
                    <select class="form-control"  name="serie_id" id="serie" >
              

                      <?php 
                      $res_serie=pesquisar_serie_por_id($conexao,$serie_id);
                      foreach ($res_serie as $key => $value) {
                        $id=$value['id'];
                        $nome_serie=$value['nome'];
                        echo "<option value='$id'>$nome_serie </option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>       
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Observação</label>
                    <textarea class="form-control"  name="observacao" ></textarea>
                  </div>
                </div>

              </div>
            

                 
                   <div class="modal-footer justify-content-between">
                       <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                       <div id="botao_continuar" onclick='carregando_login()'>
                         <button type="submit" class="btn btn-primary" >TRANSFERIR SELECIONADOS</button>
                       </div>
                  </div>

                <!-- /corpo -->
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

  </form>

  <script>
    function procedimento_transferencia(){
      document.procedimentos.action = "../Controller/Tranferir_aluno.php";
    }
  </script>

 <?php 

    include 'rodape.php';

 ?>