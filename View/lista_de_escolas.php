<?php
include_once "cabecalho.php";
include_once "barra_horizontal.php";
include_once 'menu.php';
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";

?>






<div class="content-wrapper" style="min-height: 529px;">
 
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
  <div class="col-sm-12 alert alert-secondary">
    <h1 class="m-0" align="center"><b>LISTA DE ESCOLAS</b></h1>
  </div>
</div>

    
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <table class="table-responsive">
                        <thead>
                          <tr>
                            
                            <th>Escola</th>
                            <th>Endereco</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          
                        
        <?php 
        $res=$conexao->query("select * from escola");
        foreach ($res as $key => $value) {
          $nome=$value['nome'];
          $contato=$value['telefone'];
          $endereco=$value['endereco'];
          $email=$value['email'];

          echo "<tr>";
          echo"<td>$nome</td>";
          echo "<td>$endereco<br></td>";
          echo "<td> $contato</td>";
          echo "<td> $email</td>";
          echo "</tr>";

        }
        ?>
           </tbody>
                      </table>
      </div>
        <!-- /.col -->
    </div>
            <!-- Main row -->
            <!-- /.row -->
  

</section>
</div>
</div>
</div>








<?php

include_once 'rodape.php';
?>