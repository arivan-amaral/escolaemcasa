<?php 
session_start();
if (!isset($_SESSION['idfuncionario'])) {
 header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];
  $idfuncionario=$_SESSION['idfuncionario'];

}
// echo "página em manutenção para o professor!!";
// exit();

include_once "cabecalho.php";
include_once "alertas.php";
include_once "barra_horizontal.php";

include_once 'menu.php';

include_once '../Controller/Conversao.php';
include_once '../Controller/Cauculos_notas.php';

if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";

include_once '../Model/Aluno.php';
include_once '../Model/Coordenador.php';
include_once '../Model/Escola.php';
include_once '../Model/Serie.php';
include_once '../Model/Nota.php';
include_once '../Model/Turma.php';

$idturma=$_GET['idturma']; 
$idescola=$_GET['idescola'];
  $ano_letivo=$_SESSION['ano_letivo'];

$rematricula_escola_id=$_GET['idescola']; 
$serie_id=$_GET['idserie']; 
$idserie=$_GET['idserie']; 
$idserie_atual=$_GET['idserie']; 

$array_url=explode('php?', $_SERVER["REQUEST_URI"]);
$url_get=$array_url[1];

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
              echo $_SESSION['NOME_APLICACAO']; 
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
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <button class="btn btn-block btn-lg btn-secondary">
          <?php
          $nome_turma='';
          $nome_disciplina='';
          $res_turma=lista_de_turmas_por_id($conexao,$idturma);

          foreach ($res_turma as $key => $value) {
            $nome_turma=$value['nome_turma'];
          }           

          $nome_escola='';
    $res_escola=buscar_escola_por_id($conexao,$idescola);
    $nome_escola="";
    foreach ($res_escola as $key => $value) {
      $nome_escola=$value['nome_escola'];
    }    


          echo "$nome_escola - <b class='text-warning'>$nome_turma </b>"  ; ?></button>
        </div>
      </div>
      <br>


    



    <div class="row">

     <div class="card-body">

      <table class="table table-bordered">

        <thead>
          <tr>
            <th style="width: 20px">
              Todos
              <input type='checkbox' id='checkTodos' class='checkbox' name='checkTodos' onclick='seleciona_todos_alunos();'> 
            </th>


            <th style="width: 50px">Situação Matrícula</th>
            <th>Dados do Aluno</th>
            <th>Arquivo</th>
            <th>Enviar pdf laudo </th>
          </tr>
        </thead>

        <tbody>
          <?php
          $conta_aluno=1; 
          $matricula="";

          if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
            $result=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
          }else{
            $result=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
          }

          foreach ($result as $key => $value) {
            $nome_aluno=($value['nome_aluno']);
            $nome_laudo=($value['laudo']);
            $nome_turma=($value['nome_turma']);
            $id=$value['idaluno'];
            $idaluno=$value['idaluno'];
            $status_aluno=$value['status_aluno'];
            $email=$value['email'];
            $data_nascimento=converte_data($value['data_nascimento']);
            $senha=$value['senha'];
            $matricula_aluno=$value['matricula'];

            $res_movimentacao=pesquisar_aluno_da_turma_ata_resultado_final($conexao,$matricula_aluno,$_SESSION['ano_letivo']);

            $data_evento="";
            $descricao_procedimento="";
            $procedimento="";
            // $matricula="";
            foreach ($res_movimentacao as $key => $value) {
              $datasaida=($value['datasaida']);     
              $procedimento=$value['procedimento'];

              if ($datasaida!="") {
                $datasaida=converte_data($datasaida);
              }
            }
            $res_solicitacao_trasferencia=pesquisar_solicitacao_transferencia_por_aluno($conexao,$matricula_aluno,0);

            $verificar_aluno_na_turna_rematricula=verificar_aluno_na_turna_rematricula($conexao,$idaluno,$_SESSION['ano_letivo_vigente']);
            
          echo "<tr id='linha$idaluno'>
              <input type='hidden' id='matricula$idaluno' name='matricula$idaluno' value='$matricula_aluno'>
              ";
            if ($procedimento!="") {
             echo "

             <td>
             $conta_aluno
             </td>        
             <td>
             $procedimento 
             </td>
             <td  valign=top style='border:solid black 1.0pt;
             $conta_aluno -  
             padding:0cm 0cm 0cm 0cm;height:11.3pt; '>
             $nome_aluno
             Data nascimento: $data_nascimento <BR>
             </td>


             <td colspan='100%' valign=top style='border:solid black 1.0pt;
             ;padding:0cm 0cm 10pt 0cm;height:11.3pt; '>
             $datasaida 
             </td> ";


           }else{
           
           
            if (count($res_solicitacao_trasferencia)==0 && count($verificar_aluno_na_turna_rematricula)==0) {

              echo " <td>$conta_aluno - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='$idaluno'>   </p></td>";
              echo "<td><B>MATRICULADO</B</td>";

            }else{

              if ( count($verificar_aluno_na_turna_rematricula)>0 && $_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) {
                echo "<td>$conta_aluno -  <p><input type='checkbox' class='checkbox' name='idaluno[]' value='$idaluno'></p> </td>";
                echo "<td><B>ALUNO REMATRICULADO</B></td>";

              }elseif ( count($res_solicitacao_trasferencia)>0) {
                echo "<td>$conta_aluno - </td>";
                echo "<td>  <B>SOLICITADO TRANSFERÊNCIA</B</td>";

              }
    
              elseif (count($verificar_aluno_na_turna_rematricula)>0 && $_SESSION['ano_letivo_vigente']) {

                echo"<td>
                $conta_aluno - 
                </td>";
                echo "<td><B>REMATRICULADO</B</td>";

              }
              elseif (count($verificar_aluno_na_turna_rematricula)==0) {
                echo"<td>
                $conta_aluno - 
                </td>";
                echo "<td><B>MATRICULADO</B</td>";

              }
            }


            echo"
            <td>$id -
            <b class='text-success'> $nome_aluno </b> <BR>
            Data nascimento: $data_nascimento <BR>

            <b class='text-primary'> $nome_turma</b><BR>
            <b class='text-danger'>$email  </b><BR>
            <b class='text-danger'>Senha: $senha  </b><BR>


            </td>";

          
            
          echo"<td> "; 
if ($nome_laudo !="") {
  echo "<a href='laudo/$nome_laudo'>Ver Arquivo</a>";
}

          echo"</td> ";



echo"<td> 
 

        <td><button class='btn btn-primary btn-enviar' data-id='$idaluno' data-nome='$nome_aluno'>Enviar PDF</button></td>
 

</td>

</tr>
";
            }//procedimento ==""
            $conta_aluno++;
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



<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formUpload" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Aluno:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <p id="nome_destinatario" class="fw-bold text-primary"></p> <!-- Nome do destinatário -->
        <input type="file" name="arquivo_pdf" id="arquivo_pdf" accept="application/pdf" class="form-control mb-2" required>
        <input type="hidden" id="id_registro" name="id_registro" value="<?php echo $idaluno; ?>">
        <div id="mensagem" class="text-center text-info small"></div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Enviar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

 <script>
   // Função para abrir o modal com os dados do cliente
   document.querySelectorAll('.btn-enviar').forEach(botao => {
     botao.addEventListener('click', function () {
       const id = this.getAttribute('data-id');
       const nome = this.getAttribute('data-nome');

       document.getElementById('id_registro').value = id;
       document.getElementById('arquivo_pdf').value = '';
       document.getElementById('mensagem').textContent = '';
       document.getElementById('nome_destinatario').textContent = `Enviando laudo do aluno: ${nome}`;

       // Atualiza o título da aba do navegador
       document.title = `Aluno: ${nome}`;

       // Abre o modal
       const modal = new bootstrap.Modal(document.getElementById('uploadModal'));
       modal.show();
     });
   });

   // Restaura o título original ao fechar o modal
   document.getElementById('uploadModal').addEventListener('hidden.bs.modal', function () {
     document.title = 'Upload PDF por Registro';
   });

   // Envia o formulário via AJAX
   document.getElementById('formUpload').addEventListener('submit', async function (e) {
     e.preventDefault();

     const arquivo = document.getElementById('arquivo_pdf').files[0];
     const id = document.getElementById('id_registro').value;
     const mensagem = document.getElementById('mensagem');

     if (!arquivo) {
       mensagem.textContent = 'Selecione um PDF.';
       return;
     }

     const formData = new FormData();
     formData.append('arquivo_pdf', arquivo);
     formData.append('id_registro', id);

     mensagem.textContent = 'Enviando...';

     try {
       const response = await fetch('teste_laudo_upload.php', {
         method: 'POST',
         body: formData
       });

       const texto = await response.text();
       mensagem.textContent = texto;

       // Fechar o modal após o envio bem-sucedido
           $('#uploadModal').modal('hide');

     } catch (error) {
       mensagem.textContent = 'Erro ao enviar o arquivo.'+ error;
     }
   });
 </script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php 

include_once 'rodape.php';

?>