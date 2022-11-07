<?php 
session_start();
if (!isset($_SESSION['idcoordenador'])) {
  header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

}
  include "cabecalho.php";
  include "alertas.php";
  
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Coordenador.php';
  include_once '../Model/Conexao.php';

  $idfuncionario=$_REQUEST['idfuncionario'];

  $res_coordenador=pesquisar_coordenador_por_id($conexao,$idfuncionario);
  $nome='';
  $email='';
  $coordenador="";
  $secretario="";
  $diretor="";
  $whatsapp="";

  foreach ($res_coordenador as $key => $value) {
      $nome=$value['nome'];
      $email=$value['email'];
      if ($value['descricao_funcao']=="Coordenador") {
        $coordenador="selected";
        // code...
      }  
      if ($value['descricao_funcao']=="Secretário") {
        $secretario="selected";
        // code...
      }  
      if ($value['descricao_funcao']=="Diretor") {
        $diretor="selected";
        // code...
      }
      $whatsapp=$value['whatsapp'];
  }
  
  
?>

<script src="ajax.js?<?php echo rand(); ?>"></script>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-1">
        </div>
         <div class="col-md-10">
            <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">EDITANDO  COORDENADOR / SECRETARIA</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="../Controller/Editar_coordenador.php" method="POST">
                    <input type="hidden" name="idfuncionario" value="<?php echo $idfuncionario; ?>">
                    <div class="card-body">

                      <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="nome" placeholder="Nome" required="" value="<?php echo $nome; ?>">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">E-MAIL ou Usuário</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="email" placeholder="E-mail ou Usuário" required="" value="<?php echo $email; ?>">
                      </div>

                      <!--< div class="form-group">
                        <label for="exampleInputEmail1">Sexo</label>
                          <select class="form-control" name="sexo" required="">
                            <option></option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                      </div> -->

                      <div class="form-group">
                        <label for="exampleInputEmail1">Função</label>
                          <select class="form-control" name="funcao" required="">
                          <option ></option>
                          <option value="Diretor" <?php echo $diretor; ?>  >Diretor</option>
                          <option value="Coordenador" <?php echo $coordenador; ?>  >Coordenador</option>
                          <option value="Secretário" <?php echo $secretario; ?>  >Secretário</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Whatsapp</label>
                        <input type="text" id="phone" name="whatsapp" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" class="form-control" placeholder="(xx)x xxxx-xxxx" required="" value="<?php echo $whatsapp; ?>">
                      </div>
                      

                 <!--      <div class="form-group">
                        <label for="exampleInputEmail1">Criar Senha</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="senha" placeholder="Criar Senha" required="">
                      </div> -->
                      
                    

                      
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
        
     function mask(o, f) {
       setTimeout(function() {
         var v = mphone(o.value);
         if (v != o.value) {
           o.value = v;
         }
       }, 1);
     }

     function mphone(v) {
       var r = v.replace(/\D/g, "");
       r = r.replace(/^0/, "");
       if (r.length > 10) {
         r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
       } else if (r.length > 5) {
         r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
       } else if (r.length > 2) {
         r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
       } else {
         r = r.replace(/^(\d*)/, "($1");
       }
       return r;
     }

  </script>









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