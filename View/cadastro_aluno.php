<?php 
session_start();
if (!isset($_SESSION['idcoordenador'])) {
  header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

}
  include "cabecalho.php";
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Conexao.php';
  include '../Model/Turma.php';
  include '../Model/Escola.php';
?>

<script src="ajax.js"></script>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-1">
        </div>
         <div class="col-md-10">
            <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">CADASTRO DO ALUNO</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="../Controller/Cadastro_aluno.php" method="POST">
                    <div class="card-body">

                      <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="nome" placeholder="Nome do aluno" required="">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Qual a Escola?</label>
                        <select class="form-control" name="escola" required="">
                            <option></option>
                            <?php 
                              $res_turma= lista_escola($conexao);
                              foreach ($res_turma as $key => $value) {
                                  $id=$value['idescola'];
                                  $nome_escola=($value['nome_escola']);
                                  echo "
                                      <option value='$id'>$nome_escola </option>

                                  ";
                              }
                            ?>
                        </select>
                      </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Qual a Turma?</label>
                        <select class="form-control" name="turma" required="">
                            <option></option>
                            <?php 
                              $res_turma= lista_turma($conexao);
                              foreach ($res_turma as $key => $value) {
                                  $id=$value['idturma'];
                                  $nome_turma=($value['nome_turma']);
                                  echo "
                                      <option value='$id'>$nome_turma </option>

                                  ";
                              }
                            ?>
                        </select>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputEmail1">Data de nascimento</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" name="data_nascimento"  required="">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">E-MAIL ou Usuário</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="email" placeholder="E-mail ou Usuário" required="">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Gênero</label>
                        <select class="form-control" name="sexo" required="">
                            <option></option>
                            <option value="Masculino">Masculino </option>
                            <option value="Feminina">Feminino</option>
                        </select>
                      </div>


                      <div class="form-group">
                        <label for="exampleInputEmail1">Whatsapp</label>
                        <input type="tel" id="phone" name="whatsapp" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" class="form-control" placeholder="(xx)x xxxx-xxxx" required="" />
                        
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Documento: CPF, RG ou Nº de Certidão de Nascimento </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="documento" placeholder="Documento" required="">
                      </div>
                      

                      <div class="form-group">
                        <label for="exampleInputEmail1">Criar Senha</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="senha" placeholder="Criar Senha" required="">
                      </div>
                      
                    

                      
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





  
<?php
  include 'rodape.php';
?>