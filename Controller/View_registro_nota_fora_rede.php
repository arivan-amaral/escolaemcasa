<?php 
include_once"../Model/Conexao.php";
include_once"../Model/Aluno.php";

$opcao=$_GET['opcao'];
if ($opcao=="Sim") {
?>
     
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

  <?php 
}else{
  ?>

   <div class='col-sm-3'>
           <div class="form-group">
            <label for="exampleInputEmail1">Período</label>

            <select class="form-control" id='periodo' name='periodo' required="">
              <option></option>
              <?php 
                $resultado=listar_trimestre($conexao);
                foreach ($resultado as $key => $value) {
                  $idperiodo=$value['id'];
                  $descricao=$value['descricao'];
                  if ($idperiodo!=6) {
                    echo"<option value='$idperiodo'>$descricao</option>";

                  }
                }

               ?>
            </select>
          </div>
        </div>


      <div class='col-sm-1'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Média</label>

            <input class='form-control' id='media' name='media' required='' onkeyup='somenteNumeros(this,10);'>
              
          </div>
        </div>     

            

        <div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Carga horária</label>

            <input class='form-control' id='carga_horaria' name='carga_horaria' required='' onkeyup='somenteNumeros(this,200);'>
              
          </div>
        </div>

   <div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Total faltas</label>

            <input class='form-control' id='total_falta' name='total_falta' required='' onkeyup='somenteNumeros(this,100);'>
              
          </div>
        </div>
  </div>

<?php
}
  ?>



