<?php include './header.php'; 

include '../DAO/conexao.php';
include '../DAO/Questionario.php';
include '../DAO/Aluno.php';

if (isset($_SESSION['id_funcionario']))  {
    $id_funcionario=$_SESSION['id_funcionario'];
}else{
  header("Location:../blog/?resposta=Erro, tente novamente!!.&situacao=alert alert-danger");
}

$disciplina_id = $_GET['disc'];
$turma_id = $_GET['turm'];
$idturma = $_GET['turm'];
$idescola = $_GET['idescola'];
?>
<script type="text/javascript" src="ajax.js">
  
</script>

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Relatório de Questionário</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-muted">Perfil</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Adicionar Relatório de Questionário</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <?php
                                if(isset($_GET["resposta"])){
                                  $resposta=$_GET["resposta"];
                                  $situacao=$_GET["situacao"];
                                  echo "
                                  <div class='$situacao' role='alert'>
                                  $resposta
                                  </div>
                                  ";
                            }?>
                       

                                <button type="button" class="btn btn-block btn-xs btn-success"><?php echo $_GET['nome_turma']."  - ".$_GET['nome_disciplina']; ?></button>
                                <br>
                                <form class="mt-12" action="../Controller/Relatorio_questionario.php" method="post" enctype="multipart/form-data">


                                    <h4 class="card-title">Aluno</h4>
                                    <div class="form-group">
                                        <select class="form-control" name="aluno_id" required="">
                                          <option></option>
                                          <?php 
                                              //$listar_aluno=listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
                                              $listar_aluno=listar_aluno($conexao,$id_funcionario,$disciplina_id,$turma_id);
                                              $conta=1;
                                              foreach ($listar_aluno as $key => $value) {
                                                $idaluno=$value['idaluno'];
                                                $nome_aluno=$value['nome'];
                                                echo "
                                                  <option value='$idaluno' >$nome_aluno</option>
 
                                                ";
                                              }

                                          ?>

                                        </select>
                                    </div>

                                    <h4 class="card-title">Arquivo</h4>

                                    <div class="form-group">
                                        <input type="file" name="imagem" class="form-control" required="">
                                    </div>

                                    <h4 class="card-title">Nota</h4>
                                    <div class="form-group">
                                        <input type="text" name="nota" class="form-control" required="" >
                                    </div>

                                    <h4 class="card-title">Data visível</h4>
                                    <div class="form-group">
                                        <input type="date" name="data_visivel" class="form-control" required="" >
                                    </div>    

                               
                                    <h4 class="card-title">Descrição</h4>
                                    
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" name="descricao" placeholder="Descrição do Relatório de Questionário" required=""></textarea>
                                    </div>

                                    

                                    <input type="hidden" name="turma_id" value="<?php echo $_GET['turm'] ?>" class="form-control" required="" >

                                    <input type="hidden" name="disciplina_id" value="<?php echo $_GET['disc']; ?>" class="form-control" required="">

                                    <button type="submit" class="btn waves-effect waves-light btn-lg btn-primary">Enviar Relatório </button>

                                </form>
                            </div>
                       <br>
                       <br>
                       <br>


                    <div class="table">
                        <h3 class="card-title">Lista de Relatórios</h3>

                        <table id="zero_config" class="table">
                            <thead>
                                <tr>

                                   <th>Título</th>
                                   <!-- <th>Opção</th> -->

                               </tr>
                           </thead>
                           <tbody>
                
               <?php
                               
                                function data_hora($data){
                                   return date("d/m/Y H:i", strtotime($data));
                               }
                             


                               $result=listar_relatorio_questionario($conexao, $id_funcionario,$_GET['turm'],$_GET['disc']);

                               $modal=1;
                               foreach ($result as $key => $linha) {

                                   $id=$linha['idrelatorio_questionario'];
                                   $arquivo=$linha['arquivo'];
                                   $nome_aluno=$linha['nome_aluno'];
                                   $data=$linha['data'];
                                   $descricao=$linha['descricao'];
                                   $nome_disciplina=$linha['nome_disciplina'];
                                   $nome_turma=$linha['nome_turma'];
                                   
                                   $data_visivel=$linha['data_visivel'];
                                   
 
                                   echo"<tr>
                                   <td>
                                   id: $id <br>
                                     <input type='date' id='data$id' class='form-control' value='$data_visivel' onchange='alterar_data_relatorio($id);'>
                      <p id='res$id'>

                      </p>
                                   <a href='https://educalem.com.br/views/relatorio_questionario/$arquivo'>
                                     <b>$nome_aluno</b><br>
                                      <img src='relatorio_questionario/relatorio.jpg' width='60' height='60'>";
                                   
                                     echo"
                                     <br>
                                     <b>". utf8_encode($nome_turma)."</b> - <b>".utf8_encode($nome_disciplina)."</b><br>

                                     <b>Data Postagem:</b>
                                     <span class='text-green'>".data_hora($data)."</span>                    
                                   </a>        <br>    
                                   <a href='../Controller/Cancelar_relatorio.php?id=$id' class='btn btn-danger'>Cancelar</a>

                                 </td>
                                 </tr>";
                                 $modal++;
                             }
                             ?>


                         </tbody>


                     </table>

                 </div>
             </div>
         </div>
     </div>
 </div>
</div>

<?php include 'rodape.php'; ?>