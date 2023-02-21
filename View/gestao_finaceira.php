<?php 

session_start();
  include_once "cabecalho.php";
  include_once "alertas.php";
  include_once "barra_horizontal.php";
  include_once 'menu.php';
  include_once '../Model/Conexao.php';
  include_once '../Controller/Conversao.php';
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
                <h3 class="card-title">CADASTRO DE MOVIMENTAÇÃO FINACEIRA </h3>
              </div> 
              <div class="container-fluid">
           

                <div class="row">
                  <div class="col-md-12">
                    <br>
                <form action=""  method="POST">

                  <div class="card-body">
                    <div class="row">


                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">DATA E HORA DA MOVIMENTAÇÃO</label>
                          <input type="datetime-local" name="data_movimentacao" required>
                        </div>
                      </div>  

                     <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">TIPO DA MOVIMENTAÇÃO</label>
                         <select class="form-control"  name='tipo_movimentacao' id='tipo_movimentacao' required onchange="">
                          <option></option>
                          <option style="background-color: #66CDAA ;" value='ENTRADA DE CAPITAL'>ENTRADA DE CAPITAL</option>
                          <option style="background-color: #FA8072  ;" value='SAÍDA DE CAPITAL'>SAÍDA DE CAPITAL</option>
                       
                         </select>
                        </div>
                      </div>  

                  

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1" class="text-danger">VALOR DA MOVIMENTAÇÃO</label>
                         <input class="form-control" name="valor_movimentacao" required placeholder="00.00" onkeyup='somenteNumeros(this,100000);'>
                       
                         </select>
                        </div>
                      </div>      
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">ARQUIVO ANEXO</label>
                         <input class="form-control" name="arquivo" type="file">
                       
                         </select>
                        </div>
                      </div>      
                      
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">DESCRIÇÃO DA MOVIMENTAÇÃO</label>
                         <textarea class="form-control" name="descricao_movimentacao" placeholder="descricao_movimentacao"></textarea>
                       
                         </select>
                        </div>
                      </div>                      
                      <div class="col-sm-3">
                         <BR>
                         <BR>
                          
                          <button type="submit" class="btn btn-block btn-success" >CONCLUIR</button>
                       
                        
                         
                      </div>  
                      
                     
                                  
                    </div>  

                                  
                    </form> 
                    <br>
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">ARQUIVO</th>
                              <th scope="col">TIPO MOVIMENTAÇÃO</th>
                              <th scope="col">VALOR</th>
                              <th scope="col">DATA E HORA</th>
                              <th scope="col">OPÇÕES</th>
                               
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
<script type="text/javascript">
  
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

    include_once 'rodape.php';

 ?>