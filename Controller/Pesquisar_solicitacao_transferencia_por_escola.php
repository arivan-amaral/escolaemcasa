<?php session_start();
include'../Model/Conexao.php';
include'../Model/Escola.php';
include'../Model/Coordenador.php';
include'Conversao.php';


try {
 

$idfuncionario=$_SESSION['idfuncionario'];
$visualizada=0;
$aceita=0;
$res_escola= escola_associada($conexao,$idfuncionario);
$sql_escolas="AND ( escola_id = -1 ";
foreach ($res_escola as $key => $value) {
    $id=$value['idescola'];
    $sql_escolas.=" OR escola_id = $id ";
}
 
 $result ="";
 $quantidade=0;
$res= pesquisar_solicitacao_transferencia_por_escola($conexao,$visualizada,$aceita,$sql_escolas);
  foreach ($res as $key => $value) {
    $nome_aluno=$value['nome'];
    $nome_escola=$value['nome_escola'];
    $data_solicitacao= converte_data_hora($value['data_solicitacao']);

     $result .="
    <a href='lista_solicitacao_transferencia.php' class='dropdown-item'>
       <div class='media'>
         <img src='fotos/user.png' alt='Profissional' class='img-size-50 mr-3 img-circle'>
         
         <div class='media-body'>
      
            <p class='text-sm'> Aluno:  $nome_aluno </p>
            <p class='text-sm'> Da escola:  $nome_escola </p>
             <span class='float-right text-sm text-danger'><i class='fas fa-star'></i></span>
       
           <p class='text-sm'>Solicitação de transferência</p>
           <p class='text-sm text-muted'><i class='far fa-clock mr-1'></i> $data_solicitacao</p>
         </div>
       </div>
       
     </a>";
     $quantidade++;

  }

echo $result."*".$quantidade;
 
} catch (Exception $e) {
  echo "Buscando informações";
 
}
?>