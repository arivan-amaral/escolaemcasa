<?php
session_start();

if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
 
include_once 'Conversao.php';
 
include_once '../Model/Aluno.php';
 
try {
    

$idfuncionario=$_SESSION['idfuncionario'];
$nome_aluno=$_GET['nome_aluno'];

 

$resultado=pesquisar_por_nome_carteirinha_escola($conexao,$nome_aluno, $_SESSION['ano_letivo_vigente']);

  $result="";
  $conta=1;
foreach ($resultado as $key => $value) {

  $nome_aluno=verificarNome($value['nome_aluno']);
  $nome_turma=($value['nome_turma']);
  $nome_escola=($value['nome_escola']);
  $id=$value['idaluno'];
  $idaluno=$value['idaluno'];
  $status_aluno=$value['status_aluno'];
  $email=$value['email'];
  $whatsapp_responsavel=$value['whatsapp_responsavel'];
  $nome_responsavel=$value['nome_responsavel'];
  $data_nascimento=converte_data($value['data_nascimento']);
 
  $matricula_aluno=$value['matricula'];
  $linha_transporte=$value['linha_transporte'];
  
  $caminho_foto_carteirinha="".$value['imagem_carteirinha_transporte'];

if ($caminho_foto_carteirinha !="") {
    // code...
  $caminho_foto_carteirinha="imagem_carteirinha_transporte/".$caminho_foto_carteirinha;
}else{
   $caminho_foto_carteirinha="imagens/avatar_carteirinha.png"; 

}
if ($conta%2!=0) {

    $result.="<br>
        <div class='row'>";
}



    $result.="<div class='col-sm-6 div_carteirinha '>
                <div class='row'>

                  <div class='col-sm-6' ></div>
                
                  <div class='col-sm-6 nome_linha' >
                     LINHA: $linha_transporte
                  </div>
                </div>

                  <div class='row'>

                
                        
                        
                        <div class='col-sm-2 imagem_perfil' >
                          <img src='$caminho_foto_carteirinha' >
                        </div>
                        <div class='col-sm-1' ></div>
                        <div class='col-sm-9 dados_aluno'>
                            <b class='nome_aluno'>$nome_aluno</b><br>
                          <p class='outros_dados_aluno'> 
                          <b>$nome_escola</b> <br>
                          <b>TURMA: $nome_turma</b><br>
                          <b>RESPONSÁVEL: $nome_responsavel </b><br>
                          <b>DATA NASC: $data_nascimento</b><br>
                          <b>MATRÍCULA: $matricula_aluno</b><br>
                          <b>CPF/RG:</b><br>
                          <b>TIPO SANGUINEO: </b><br>
                          <b>TELEFONE: $whatsapp_responsavel</b>
                        </p>
                         

                        </div>

                  </div> 
          
          <label class='custom-checkbox no-print'>
            <input type='checkbox' class='no-print carterinha_aluno' name='carterinha_aluno' value='$id'>
            <span class='checkmark'></span>Selecionar
        </label>

        
            </div>";            

                      
            


if ($conta%2==0) {
   $result.="       
        </div> "; // code...
}






   
    if ($conta%8==0) {
    $result.="<div class='pagebreak'> </div>";
    }



    $conta++;
  }

  echo "$result";

} catch (Exception $e) {
    echo "$e";
}