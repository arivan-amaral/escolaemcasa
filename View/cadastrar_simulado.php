<?php
session_start();
if (!isset($_SESSION['idfuncionario'])) {

   header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idfuncionario'];
  $idfuncionario=$_SESSION['idfuncionario'];

}
include_once "cabecalho.php";
include_once "alertas.php";

include_once "barra_horizontal.php";
include_once 'menu.php';
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Controller/Conversao.php';
include_once '../Model/Questionario.php';
include_once '../Model/Turma.php';
include_once '../Model/Coordenador.php';
include_once '../Model/Escola.php';



// $idescola=$_GET['idescola'];
$array_url=explode('.php', $_SERVER["REQUEST_URI"]);
$url_get=$array_url[1];



?>



<script src="ajax.js?<?php echo rand(); ?>"></script>



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

              echo $_SESSION['nome'];  

          } 

      ?></b></h1>

  </div><!-- /.col -->

  <div class="col-sm-2">

    <ol class="breadcrumb float-sm-right">

      <li class="breadcrumb-item"><a href="#">Home</a></li>

      <li class="breadcrumb-item active">simulado</li>

  </ol>

</div><!-- /.col -->

</div><!-- /.row -->

</div><!-- /.container-fluid -->

</div>

<!-- /.content-header -->



<!-- Main content -->



</section>



<!-- Main content -->

<section class="content">

  <div class="container-fluid">


    <div class="row">
      <div class="col-md-12">

          <button type="button" class="btn btn-block  btn-secondary">CADASTRO DE SIMULADOS</button>


          <form class="mt-12" action="../Controller/Cadastrar_simulado.php" method="post" enctype="multipart/form-data">
            <br>
            <b>Nome do simulado</b>
            <div class="form-group">
                <input type="text" name="nome" class="form-control" autocomplete="off"  required="">
            </div>




           
              <?php


              $idcoordenador=$_SESSION['idfuncionario'];
              
              $res_escola= escola_associada($conexao,$idprofessor);
              $result="";
              $array_serie=array();
              $sql_escola = " AND ( ";

              foreach ($res_escola as $key => $value) {
                  $idescola=$value['idescola'];

                      $res=$conexao->query("SELECT 
                       idturma,
                       serie.id as 'idserie',
                       serie.nome as 'nome_serie',
                       nome_turma,
                       idescola
                       FROM ministrada,escola,turma,funcionario,serie WHERE

                       serie.id= turma.serie_id AND
                       ministrada.escola_id= escola.idescola AND
                       ministrada.professor_id= funcionario.idfuncionario and
                       ministrada.turma_id = turma.idturma AND
                       escola_id=$idescola GROUP BY serie.id,  idturma,
                       serie.nome,
                       nome_turma,
                       idescola
                       ORDER BY turma.nome_turma
                       ");

                      $result="";
                      foreach ($res as $key => $value) {

                        $idturma=$value['idturma'];
                        $idserie=$value['idserie'];

                        $nome_serie=$value['nome_serie'];
                        $nome_turma=($value['nome_turma']);
                        $idescola=($value['idescola']);
                        $array_serie[$idserie]=$nome_serie;
                        
                    }
                  
                  $sql_escola  .= " escola_id = $idescola OR ";
                }

                  $sql_escola  .= " escola_id = -1 ";

                ?>




                <b>Selecione a série</b>
                <div class="form-group">

                <select name='idserie'  class="custom-select rounded-0"  onchange='listar_etapas(this.value);' required>
                  <option></option>

                <?php
                foreach ($array_serie as $key => $value) {
                    $idserie=$key;
                    if ($idserie !=16) {
                        echo"
                        <option value='$idserie'>$value</option>
                        ";
                    }
                }


                $res_multi=$conexao->query("SELECT * FROM turma WHERE serie_id=16");
                foreach ($res_multi as $key_m => $value_m) {
                    $idturma=$value_m['idturma'];
                    $serie_id=$value_m['serie_id'];
                    $nome_turma=$value_m['nome_turma'];
                    echo "<option value='$idturma/$serie_id'>Multisseriada - $nome_turma</option>";
                }

            ?>
        </div>
        </select>


            <div class="form-group">
                <label for="exampleInputEmail1">Escolha a escola</label>
                <select class="form-control" name="idescola"  required>
                    <option></option>
                        <?php 
                          $res_escola= escola_associada($conexao,$idcoordenador);
                          foreach ($res_escola as $key => $value) {
                              $id=$value['idescola'];
                              $nome_escola=($value['nome_escola']);
                              echo "
                                  <option value='$id'>$nome_escola </option>

                              ";
                          }
                        ?>
                    </select>
                  </div>


            <div class="form-group" id="etapa">
             
            </div>


        <b>Data de Início</b>
        <div class="form-group">
            <input type="date" name="data" class="form-control"  required="">

        </div>        

        <b>Data final</b>
        <div class="form-group">
            <input type="date" name="data_final" class="form-control"  required="">

        </div>




        <h4>Hora de Início (horários que os alunos poderão acessar)</b>
            <div class="form-group">
                <input type="time" class="form-control" name="hora_inicio" value="00:00" required>
            </div>

            <h4>Hora de Fim</b>
                <div class="form-group">
                    <input type="time" class="form-control" name="hora_fim" value="23:59" required>
                </div>



 
                <input type="hidden" name="url_get" value="<?php echo $url_get ?>" class="form-control" required="">

                
                    <button type="submit" class="btn waves-effect waves-light btn-lg btn-primary">
                      Cadastrar
                  </button>
              

          </form>


      </div>
  </div>
  </div>



  <div class="row">
      <div class="col-md-12">

          <br>      
          <div class="table">
            <a class="btn btn-block btn-info" name="#questionario">Lista de simulados Enviados</a>

            <table id="zero_config" class="table">
                <thead>
                    <tr>

                       <th>Título</th>

                       <th>Opção</th>


                   </tr>
               </thead>
               <tbody>


        <?php 
        $conta=0;
        $cor='#DCDCDC';
          

            foreach ($array_serie as $key2 => $value2) {
                // arivan
                $res_simulado=listar_simulado($conexao,$key2,$sql_escola);
                foreach ($res_simulado as $key => $value) {
                    $idquestionario=$value['id'];
                    $escola_id=$value['escola_id'];
                    $idserie=$value['serie_id'];
                    $nome=$value['nome'];

                    $data=data_simples($value['data'])."T".hora($value['data']);
                    $data_fim=data_simples($value['data_fim'])."T".hora($value['data_fim']);
                    
                    $status=$value['status'];
                    $origem_questionario_id=$value['origem_questionario_id'];
                    if ($conta%2==0) {
                        $cor="#DCDCDC";
                    }else{
                        $cor="";

                    }
                    echo "

                    <tr style='background-color:$cor' id='linha$id'>

                    <td>
                    id: $idquestionario<br>

           

                    <b style='background-color:#CD853F'>$nome</b><br>


                    <div class='form-group'>
                        <label for='exampleInputEmail1'>Escolha a escola</label>
                        <select class='form-control' name='idescola' id='idescola$idquestionario' onchange='mudar_escola_simulado($idquestionario);'  required>
                             ";

                             $nome_escola="";
                             if ($escola_id!="") {
                             $escolas=buscar_escola_por_id($conexao,$escola_id);
                             foreach ($escolas as $key_escola => $value_escola) {
                                 $idescola=$value_escola['idescola'];
                                 $nome_escola=$value_escola['nome_escola'];
                                 echo"<option value='$idescola'>$nome_escola</option>";

                             }
                                 // code...
                             }
                             if ($nome_escola=="") {
                                 echo"<option></option>";
                             }
                                  $res_escola= escola_associada($conexao,$idcoordenador);
                                  foreach ($res_escola as $key => $value) {
                                      $id=$value['idescola'];
                                      $nome_escola=($value['nome_escola']);
                                      echo "
                                          <option value='$id'>$nome_escola </option>

                                      ";
                                  }
                        echo "
                            </select>
                          </div>

                    Data início<br>
                    <input type='datetime-local' value='$data' onchange='alterar_data_simulado($idquestionario);' id='data$idquestionario' > 
                    <br>
                    Data final<br>
                    <input type='datetime-local' value='$data_fim' onchange=' alterar_data_simulado($idquestionario)' id='data_fim$idquestionario' >
                    <span class='alert-success' id='resposta_alteracao_data$idquestionario'></span>
                    <br>

                    ";

                    if ($status==1) {
                      echo"
                      <b class='text-success'>
                      Ativo
                      </b>
                      <br>
                      ";
                  }else{
                    echo"
                    <b class='text-danger'>
                    Desativado
                    </b>
                    <br>";
                }




             if ($status==1) {
                  echo"
                  <a  onclick='alterar_status_questionario_simulado($idquestionario,$status);'>

                  <span class='btn btn-primary'>
                  Desativar
                  </span>
                  </a>
                  <br>
                  <br>
                  ";
              }else if ($status==0) {
                  echo"
                  <a onclick='alterar_status_questionario_simulado($idquestionario,$status);'>

                  <span class='btn btn-warning'>
                  Ativar
                  </span>
                  </a>  

                  <a onclick='excluir_questionario_simulado($idquestionario);'>

                  <span class='btn btn-danger'>
                  Excluir definitivamente?
                  </span>
                  </a>
                  <br>
                  <br>
                  ";
              }

              echo "
              </td>

              <td>

              <a  href='resultado_questionario_simulado.php?escola_id=$escola_id&idserie=$idserie' class='btn btn-info btn-block btn-flat'>

              <ion-icon name='eye'></ion-icon>

              Acompanhar simulado                                          

              </a> 
              <br>
              <a href='adicionar_questao_simulado.php?nome=$nome&origem_questionario_id=$origem_questionario_id&questionario_id=$idquestionario'>
              <span class='btn btn-primary btn-block btn-flat'>
              Adicionar Questões
              </span>
              </a>
              <br></td>
              </tr>                                                                          

              ";
              $conta++;
        }
      }

      ?>
  </tbody>


</table>

</div>               



<!-- /.content -->

</div>        

</div>

</div>

</section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

<!-- /.control-sidebar -->

<script type="text/javascript">

    function carregando() {

        checkBoxes = document.getElementsByClassName("check")
        noCheckedBoxes = true
        for (i = 0; i< checkBoxes.length; ++i) {
            if(checkBoxes[i].checked) {
                noCheckedBoxes = false
            }
        }

        if(noCheckedBoxes) {
            document.getElementById("testa").value="";
            Swal.fire({
              icon: 'info',
              title: 'Atenção',
              text: 'Marque todos os campo obrigatórios e  pelo menos uma disciplina, para cadastrar o simulado!',

          });


        }else{
            document.getElementById("testa").value=" ";

        }

    }





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