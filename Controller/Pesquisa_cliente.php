<?php
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Cliente.php");

try {
  sleep(1);
  
    $pesquisa = $_GET["pesquisa"];
    $result=pesquisa_cliente($conexao,$pesquisa);
    
    $return="<div class='row'>
           <div class='col-1'></div>
           <div class='col-10'>
             <div class='card'>
               <div class='card-header'>
                 <h3 class='card-title'>Confira os Resultados Encontrados</h3>

                 <div class='card-tools'>
                
                 </div>
               </div>
               <!-- /.card-header -->
               <div class='card-body table-responsive p-0'>
                 <table class='table table-hover text-nowrap'>
                   <thead>
                     <tr>
                       <th>Dados Cliente</th>
                       <th>Opções</th>

                     </tr>
                   </thead>
                   <tbody>";

                    foreach ($result as $key => $value) {
                      $id=$value['id'];
                      $status=$value['status'];
                      $nome=$value['nome'];
                      $cpf=$value['cpf'];
                      $usuario=$value['usuario'];
                      $senha=$value['senha'];
                      $codigo_cartao=$value['codigo_cartao'];
                      $saldo=$value['saldo'];

                      $return.="<tr>
                        <td>
                          $nome<br>
                          <b>Usuário:</b> $usuario<br>
                          <b>CPF:</b> $cpf<br>
                          <b>Código:</b> $codigo_cartao<br>
                          <b>Senha:</b> $senha<br><br>";
                          if ($saldo==0) {
                            $return.="<b class='alert alert-danger'>Saldo R$: $saldo </b><br>";
                          }else if($saldo > 20){
                            $return.="<b class='alert alert-primary'>Saldo R$: $saldo </b><br>";
                          }else{
                            $return.="<b class='alert alert-warning'>Saldo R$: $saldo </b><br>";
                          }
                          
                          $return.="<br>
                          <br>
                          ";
                        if ($status==1) {
                          $return.="<span class='alert alert-success'>Ativo</span></td>";
                        }else {
                          $return.="<span class='alert alert-danger'>Bloqueado</span></td>";
                        }

                        $return.="
                         <td>
                             <a href='../View/alterar_cliente.php?id=$id' class='btn btn-app'>
                               <i class='fas fa-edit'></i><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'> Editar Dados
                               </font></font>
                             </a><br>
                              
                              <a href='../View/alterar_cliente.php?id=$id' class='btn btn-app'>
                                <i class='fas fa-plus'></i><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'> Add Créditos
                                </font></font>
                              </a><br>

                              <a href='../View/alterar_cliente.php?id=$id' class='btn btn-app'>
                                <i class='fas fa-chart-pie'></i><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'> Relatórios
                                </font></font>
                              </a>
                         </td>";
                      $return.="</tr>";    
                    }
$return.="
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
</div>";

echo $return;
  
} catch (Exception $e) {
    echo "erro desconhecido";
}
?>