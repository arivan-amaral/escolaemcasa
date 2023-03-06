<?php
session_start();

include_once '../Model/Conexao.php';
 
include_once 'Conversao.php';
 
include_once '../Model/Aluno.php';
 
try {
    

$idfuncionario=$_SESSION['idfuncionario'];
$idescola=$_GET['idescola'];

$resultado=listar_aluno_da_escola_carteirinha($conexao,$idescola,$_SESSION['ano_letivo_vigente']);

  $result="";
  $conta=1;
foreach ($resultado as $key => $value) {

  $nome_aluno=($value['nome_aluno']);
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

    $result.="

        <br>
        <div class='row'>
            <div class='col-sm-5 div_carteirinha '>
                  <div class='row'>

                
                        
                        <div class='col-sm-2 imagem_perfil' >
                          <img src='$caminho_foto_carteirinha' >
                        </div>
                        
                        <div class='col-sm-10 dados_aluno'>
                            <b class='nome_aluno'>$nome_aluno</b><br>
                          <p class='outros_dados_aluno'> 
                          <b>$nome_escola</b> <br>
                          <b>TURMA: $nome_turma</b><br>
                          <b>RESPONSÁVEL: $nome_responsavel </b><br>
                          <b>DATA NASC: $data_nascimento</b><br>
                          <b>MATRÍCULA: $matricula_aluno</b><br>
                          <b>CPF/RG:</b><br>
                          <b>TIPO SANGUINEO: </b><br>
                          <b>TELEFONE: $whatsapp_responsavel</b><br>
                             <b>LINHA:$linha_transporte</b>
                        </p>
                         

                        </div>

                  </div> 

                   <div class='row'>

                        <div class='col-sm-10'></div>
                        <div class='col-sm-2 validade'> <b>".$_SESSION['ano_letivo_vigente']."</b> </div>
                        
                        
             

                  </div>
                       

            </div>             
            
            <div class='col-sm-1 '></div>

            <div class='col-sm-5 div_carteirinha '>
                  <div class='row'>

                        <div class='col-sm-1'></div>
                        
                        <div class='col-sm-3 imagem_perfil' >
                          <img src='imagens/avatar_carteirinha.png'  >
                        </div>
                        
                        <div class='col-sm-8 dados_aluno'>
                          <b >RESPONSÁVEL:</b><br>
                          <b>DATA NASC:</b><br>
                          <b>MATRÍCULA:</b><br>
                          <b>CPF/RG:</b><br>
                          <b>TIPO SANGUINEO:</b><br>
                          <b>TELEFONE:</b><br>

                        </div>

                  </div>
                       

            </div> 


            
        </div>     ";




   
    if ($conta%4==0) {
    $result.="<div class='pagebreak'> </div>";
    }
    $conta++;
  }

  echo "$result";

} catch (Exception $e) {
    
}