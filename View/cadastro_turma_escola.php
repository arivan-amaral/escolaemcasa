<?php 

session_start();
  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Conexao.php';
  include '../Controller/Conversao.php';
  include_once "../Model/Serie.php"; 
  include_once "../Model/Escola.php"; 
  include_once "../Model/Estado.php"; 
  include_once "../Model/Coordenador.php"; 
  $idcoordenador=$_SESSION['idfuncionario'];

?> 

 

<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
 
          

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->



            </section>



            <!-- Main content -->

            <section class="content">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">CADASTRO DE VAGAS </h3>
              </div> 
              <div class="container-fluid">
           

                <div class="row">
                  <div class="col-md-12">
                    <br>
                <form class="mt-12"  method="GET">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Escola</label>
                         <select class="form-control"  name="escola" id="escola" onchange="lista_turma_cadastrada_escola_por_serie('tabela');" required>
                          <option></option>
                       <?php 
                         // $res_escola=lista_escola($conexao);

                        $res_escola= escola_associada($conexao,$idcoordenador);
                         foreach ($res_escola as $key => $value) {
                             $idescola=$value['idescola'];
                             $nome_escola=$value['nome_escola'];
                             echo "<option value='$idescola'>$nome_escola </option>";
                         }
                         ?>
                         </select>
                        </div>
                      </div>                      
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Turno</label>
                         <select class="form-control"  name="turno" id="turno" onchange="lista_turma_cadastrada_escola_por_serie('tabela');" required>
                          <option value="MATUTINO">MATUTINO</option>
                          <option value="VESPERTINO">VESPERTINO</option>
                          <option value="VESPERTINO">NOTURNO</option>
                         </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Série</label>
                            <select class="form-control"  name="idserie" id="idserie" onchange="lista_turma_cadastrada_escola_por_serie('tabela');listar_turmas_por_serie(this.value);">
                            <option></option>

                          <?php 
                            $res_serie=lista_todas_series($conexao);
                            foreach ($res_serie as $key => $value) {
                                $id=$value['id'];
                                $nome_serie=$value['nome'];
                                echo "<option value='$id'>$nome_serie </option>";
                            }
                            ?>
                            </select>
                        </div>
                      </div>
                      <span id="turmas">
                        <input type="hidden" name="idturma" value="">
                      </span>            
                    </div>  
                    <div class="row">
                      <div class="col-sm-3">
                         <div class="form-group">
                          <label for="exampleInputEmail1">Ano</label>
                         <select class="form-control"  name="ano" id="ano" >
                          <option value="2022">2022</option>
                         </select>
                        </div>
                      </div>
                       <div class="col-sm-3">
                          <div class="form-group">
                          <label for="exampleInputEmail1">Quantidade de Vagas</label>
                          <input type="text" class="form-control" id="quantidade_vaga" name=" quantidade_vaga">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <a style="margin-top:31px;" class="btn btn-block btn-success" onclick="adicionar_turma_escola();">ADICIONAR</a>
                        </div>
                      </div>
                    </div> 
                    <br>               
                    </form> 
                    <br>
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">ESCOLA</th>
                              <th scope="col">TURNO</th>
                              <th scope="col">SERIE</th>
                              <th scope="col">TURMA</th>
                              <th scope="col">ANO</th>
                              <th scope="col">VAGAS</th>
                              <th scope="col">OPÇÃO</th>
                            </tr>
                          </thead>
                          <tbody id="tabela">
                            
                          </tbody>
                        </table>
                      </div>
                    </div>               
                  </div>
                </div> 
              </div>
    </div>

  </section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

  <!-- /.control-sidebar -->


 <?php 

    include 'rodape.php';

 ?>