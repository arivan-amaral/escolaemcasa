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
            <label for='exampleInputEmail1'>Nota final<b class="text-danger">*</b></label>

            <input class='form-control' id='media_ou_nf' name='media_ou_nf' required='' onkeyup='somenteNumeros(this,10);'>
              
          </div>
        </div>      

        <div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Carga horária</label>

            <input class='form-control' id='carga_horaria' name='carga_horaria' required='' onkeyup='somenteNumeros(this,1000);'>
              
          </div>
        </div>

   <div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Total faltas</label>

            <input class='form-control' id='total_falta' name='total_falta'onkeyup='somenteNumeros(this,300);'>
              
          </div>
        </div>
  </div>
  <?php 
}else if($opcao=="Não"){
?> 
  <div class='col-sm-3'>
          <div class="form-group">
           <label for="exampleInputEmail1">Período</label>

           <select class="form-control" id='idperiodo' name='idperiodo' required="">
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

<div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Tipo registro</label>
            <select class='form-control' id='tipo_registro' name='tipo_registro' required=''>
                
              <option value='NF'> NF</option>
              <option value='AV1'>AV1</option>
              <option value='AV2'>AV2</option>
              <option value='AV3'>AV3</option>
                  
            
                
            </select>
            
          </div>
        </div>
      <div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Nota final<b class="text-danger">*</b></label>

            <input class='form-control' id='media_ou_nf' name='media_ou_nf' required='' onkeyup='somenteNumeros(this,10);'>
              
          </div>
        </div>      

        <div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Carga horária</label>

            <input class='form-control' id='carga_horaria' name='carga_horaria' required='' onkeyup='somenteNumeros(this,1000);'>
              
          </div>
        </div>

   <div class='col-sm-3'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Total faltas</label>

            <input class='form-control' id='total_falta' name='total_falta' onkeyup='somenteNumeros(this,300);'>
              
          </div>
        </div>
  </div>
<?php }else{
  ?>
   

<?php
}
  ?>



