<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}



if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Login.php';
include_once '../Model/Chamada.php';
include_once '../Model/Setor.php';
  

  
// incluir a funcionalidade do recaptcha
require_once "recaptchalib.php";
try {
      // definir a chave secreta
  $secret = "6LfEhacaAAAAAFH2EK2jnloZadoJmLfX2Xh7BYTl";

        // verificar a chave secreta
  $response = null;
  $reCaptcha = new ReCaptcha($secret);

  if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
  }

        // deu tudo certo?
  if ($response != null && $response->success==true) {

  }else if ($_POST["g-recaptcha-response"] =="" ) {
    $_SESSION['status']=0;
    $_SESSION['mensagem']="Selecione a caixa que comprova que você não é um robô!";
              //header("location:../View/index.php?tokem=1"); 
  }else{
    $_SESSION['status']=0;

    $_SESSION['mensagem']="Selecione a caixa que comprova que você não é um robô!";
              //header("location:../View/index.php?tokem=2"); 
  }



  //************************************************************

 //comentar apos colocar em produção
  $response = true;
 // $response->success=true;
 //comentar apos colocar em produção =>  \^/

  $ano_letivo=date("Y");


  if(isset($_POST["email"]) ){  //&& $response != null && $response->success==true){
      

      $_SESSION['whatsapp']="educalem";


      $email = $_POST["email"];
      $email=($email);
      $senha = $_POST["senha"];
      $email= preg_replace('/[\'\"]/', '',$email);
      $senha=preg_replace('/[\']/', '',$senha);
      $email= preg_replace('/[\=]/', '',$email);
      $senha=preg_replace('/[\=]/', '',$senha);     
      $resultado = login_funcionario($conexao, $email, $senha);

      $login_coordenador=0;
      $login_professor=0;
      $login_secretario=0;




      ####################### FUNCIONARIO ####################################
          foreach ($resultado as $key => $row) {
            $id = $row["idfuncionario"];
            $nome = ($row["nome"]);
            $email = $row["email"];
            $cargo = $row["descricao_funcao"];               
            $nivel_acesso_id = $row["nivel_acesso_id"];               
          if ($cargo=="Diretor") {

             $_SESSION["idfuncionario"] = $id;

             $_SESSION["idsecretario"] = $id;
             $_SESSION["nivel_acesso_id"] = $nivel_acesso_id;

             $_SESSION["nome"] = $nome;

             $_SESSION["email"] = $email;

             $_SESSION["cargo"] = "Diretor";
             $_SESSION["ano_letivo"] = $ano_letivo;
             $_SESSION["ano_letivo_vigente"] = $ano_letivo;
             
             $_SESSION['usuariobd']='coordenador';
             $login_diretor++;


           }else if ($cargo=="Coordenador") {

             $_SESSION["idfuncionario"] = $id;

             $_SESSION["idcoordenador"] = $id;
             $_SESSION["nivel_acesso_id"] = $nivel_acesso_id;

             $_SESSION["nome"] = $nome;

             $_SESSION["email"] = $email;

             $_SESSION["cargo"] = "Coordenador";
             $_SESSION["ano_letivo"] = $ano_letivo;
             $_SESSION["ano_letivo_vigente"] = $ano_letivo;
             $_SESSION['usuariobd']='coordenador';


             $login_coordenador++;


           }else if ($cargo=="Secretário") {

             $_SESSION["idfuncionario"] = $id;

             $_SESSION["idsecretario"] = $id;
             $_SESSION["nivel_acesso_id"] = $nivel_acesso_id;

             $_SESSION["nome"] = $nome;

             $_SESSION["email"] = $email;

             $_SESSION["cargo"] = 'Secretário';
             $_SESSION["ano_letivo"] = $ano_letivo;
             $_SESSION["ano_letivo_vigente"] = $ano_letivo;
             $_SESSION['usuariobd']='secretario';

             
             $login_secretario++;

           }
           else if ($cargo=="Professor" || $cargo=="Professora") {

             $_SESSION["idfuncionario"] = $id;

             $_SESSION["idprofessor"] = $id;

             $_SESSION["nome"] = $nome;

             $_SESSION["email"] = $email;

             $_SESSION["cargo"] = 'Professor';
             $_SESSION["ano_letivo"] = $ano_letivo;
             $_SESSION["ano_letivo_vigente"] = $ano_letivo;
             $_SESSION['usuariobd']='professor';


             $login_professor++;

           }
         }
      ####################### FUNCIONARIO ###############################




      ####################### ALUNO ####################################
         $login_aluno=0;
         $resultado2 = array();
          $resultado2 = login_aluno($conexao, $email, $senha,$ano_letivo);

         foreach ($resultado2 as $key2 => $row2) {
          $id = $row2["idaluno"];
          $nome = $row2["nome"];
          $nome_escola = $row2["nome_escola"];
          $email = $row2["email"];
          $escola_id = $row2["turma_escola"];
          $turma_id = $row2["turma_id"];
          $serie_id = $row2["serie_id"];
          $sexo = $row2["sexo"];
          $etapa_id = $row2["etapa_id"];

          $_SESSION["idaluno"] = $id;
          $_SESSION["nome"] = $nome;
          $_SESSION["etapa_id"] = $etapa_id;

          $_SESSION["email"] = $email;
          $_SESSION["nome_escola"] = $nome_escola;


          if ($sexo=='Masculino') {
            $_SESSION["cargo"] = "Aluno";
          }else{
            $_SESSION["cargo"] = "Aluna";

          }

          $_SESSION["escola_id"] = $escola_id;
          $_SESSION["turma_id"] = $turma_id;
          $_SESSION["serie_id"] = $serie_id;
             $_SESSION["ano_letivo"] = $ano_letivo;
             $_SESSION["ano_letivo_vigente"] = $ano_letivo;
             $_SESSION['usuariobd']='aluno';

          

          $conexao->exec("INSERT INTO acesso (aluno_id) values($id)");
          $_SESSION['status']=1;
          $login_aluno++;

        }
      ####################### ALUNO ####################################

      if ($login_aluno>0){
          $_SESSION['status']=0;
          $_SESSION['mensagem']="ACESSO DE ALUNO ESTÁ SUSPENSO TEMPORARIAMENTE, ESTAMOS EM MANUTENÇÃO!";

         header("Location:../View/aluno.php");
          header("Location:../View/");
          exit();

      }else if ($login_professor>0){
          $_SESSION['status']=1;
          header("Location:../View/professor.php");

      }else if ($login_secretario>0){
          $_SESSION['status']=1;
          header("Location:../View/secretario.php");

      }else if ($login_diretor>0){
          $_SESSION['status']=1;
          header("Location:../View/secretario.php");

      }else if ($login_coordenador>0){
          $_SESSION['status']=1;
          header("Location:../View/coordenador.php");
      }else{
          $_SESSION['status']=0;
          $_SESSION['mensagem']="Tente novamente!";
          header("location:../View/index.php"); 
      }



}else{
    $_SESSION['status']=0;
    $_SESSION['mensagem']="Selecione a caixa que comprova que você não é um robô!";
   // header("location:../View/index.php?tokem=0"); 
}



} catch (Exception $e) {
  $_SESSION['status']=0;
  $_SESSION['mensagem']="Algo deu errado, confira seus dados de acesso e tente novamente!";
  //echo "ESTAMOS EM MANUTENÇÃO:";
  //echo "<img src='../View/imagens/estamos-em-manutencao.png'>";
  header("Location:../View/");
}



?>