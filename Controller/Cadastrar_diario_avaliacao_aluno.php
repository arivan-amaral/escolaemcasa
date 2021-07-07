<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    
    $professor_id=$_SESSION['idfuncionario'];

    $idescola=$_POST['idescola'];
    $idturma=$_POST['idturma'];
    $iddisciplina=$_POST['iddisciplina'];

    $periodo=$_POST['periodo'];
    $data=$_POST['data_avaliacao'];
    $avaliacao=$_POST['avaliacao'];

try {


    $sigla=null;
    $parecer_disciplina_id=0;
      $nota=0;

    $url_get=$_POST['url_get'];
    

//$conteudo_aula_id= $conexao->lastInsertId();


// foreach ($_POST['aluno_id'] as $key => $value) {
//       $aluno_id=$_POST['aluno_id'][$key];

//     limpa_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,$data,$avaliacao);

//       $parecer_descritivo='';
//       if (isset($_POST["parecer_descritivo$aluno_id"])) {
//         $parecer_descritivo=$_POST["parecer_descritivo$aluno_id"];
//       }
      
//       $nota=0;
//       if (isset($_POST["nota$aluno_id"])) {
//         if ($_POST["nota$aluno_id"] !="") {
//             $nota=trim($_POST["nota$aluno_id"]);
//             $nota=str_replace(',','.',$nota);
//         }else{

//         }
//       }

//       if (isset($_POST["parecer_sigla$aluno_id"])) {
         
//           foreach ($_POST["parecer_sigla$aluno_id"] as $key => $value) {
//               $sigla=null;
//               if (isset($_POST["parecer_sigla$aluno_id"][$key])) {
//                 $sigla=$_POST["parecer_sigla$aluno_id"][$key];
//               }      

//               $parecer_disciplina_id=0;
//               if (isset($_POST["descricao_parecer$aluno_id"][$key])) {
//                 $parecer_disciplina_id=$_POST["descricao_parecer$aluno_id"][$key];
//               }

//     limpa_parecer_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,$data,$parecer_disciplina_id,$avaliacao);

//               cadastro_nota($conexao,$nota, 
//                 $parecer_disciplina_id, $parecer_descritivo, $sigla,$idescola, $idturma, $iddisciplina, $aluno_id, $periodo, $data,$avaliacao);
//           }

//     }else{
//         cadastro_nota($conexao,$nota, 
//                 $parecer_disciplina_id, $parecer_descritivo, $sigla,$idescola, $idturma, $iddisciplina, $aluno_id, $periodo, $data,$avaliacao);
//     }

    
// }
echo "e: $idescola,t: $idturma,d: $iddisciplina,a: $aluno_id,p: $periodo,d: $data,a: $avaliacao <br>";

    $_SESSION['status']=1;
    //header("location: ../View/diario_avaliacao.php?$url_get");
} catch (Exception $e) {

echo "<h1>sistema está em manuteção previsão de normalização 17:00 turma: $idturma</h1><br>
$e";
    $_SESSION['status']=0;
   //header("location: ../View/diario_avaliacao.php?$url_get");;

}
?>