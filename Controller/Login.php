<?php
session_start();
include'../Model/Conexao.php';
include'../Model/Login.php';
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
      header("location:../View/index.php?tokem=1"); 
      exit();

  }else{
    $_SESSION['status']=0;

    $_SESSION['mensagem']="Selecione a caixa que comprova que você não é um robô!";
    header("location:../View/index.php?tokem=2"); 
    exit();
  }



  //************************************************************

 //comentar apos colocar em produção
  $response = true;
 // $response->success=true;
 //comentar apos colocar em produção =>  \^/

  if(isset($_POST["email"]) && $response != null && $response->success==true){  //&& $response != null && $response->success==true){

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

            if ($cargo=="Coordenador") {

             $_SESSION["idfuncionario"] = $id;

             $_SESSION["idcoordenador"] = $id;
             $_SESSION["nivel_acesso_id"] = $nivel_acesso_id;

             $_SESSION["nome"] = $nome;

             $_SESSION["email"] = $email;

             $_SESSION["cargo"] = "Coordenador";

             $login_coordenador++;


           }else if ($cargo=="Secretário") {

             $_SESSION["idfuncionario"] = $id;

             $_SESSION["idsecretario"] = $id;
             $_SESSION["nivel_acesso_id"] = $nivel_acesso_id;

             $_SESSION["nome"] = $nome;

             $_SESSION["email"] = $email;

             $_SESSION["cargo"] = 'Secretário';

             $login_secretario++;

           }
           else if ($cargo=="Professor" || $cargo=="Professora") {

             $_SESSION["idfuncionario"] = $id;

             $_SESSION["idprofessor"] = $id;

             $_SESSION["nome"] = $nome;

             $_SESSION["email"] = $email;

             $_SESSION["cargo"] = 'Professor';

             $login_professor++;

           }
         }
      ####################### FUNCIONARIO ###############################




      ####################### ALUNO ####################################
         $login_aluno=0;
         $ano_letivo=date("Y");
         $resultado2 = login_aluno($conexao, $email, $senha,$ano_letivo);

         foreach ($resultado2 as $key2 => $row2) {
          $id = $row2["idaluno"];
          $nome = $row2["nome"];
          $nome_escola = $row2["nome_escola"];
          $email = $row2["email"];
          $escola_id = $row2["escola_id"];
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

          $conexao->exec("INSERT INTO acesso (aluno_id) values($id)");
          $_SESSION['status']=1;
          $login_aluno++;

        }
      ####################### ALUNO ####################################

      if ($login_aluno>0){
          $_SESSION['status']=1;
          header("Location:../View/aluno.php");
    exit();

      }else if ($login_professor>0){
          $_SESSION['status']=1;
          header("Location:../View/professor.php");
    exit();

      }else if ($login_secretario>0){
          $_SESSION['status']=1;
          header("Location:../View/secretario.php");
    exit();

      }else if ($login_coordenador>0){
          $_SESSION['status']=1;
          header("Location:../View/coordenador.php");
    exit();

      }else{
          $_SESSION['status']=0;
          $_SESSION['mensagem']="Tente novamente!";
          header("location:../View/index.php?tokem=0"); 
    exit();

      }



}else{
    $_SESSION['status']=0;
    $_SESSION['mensagem']="Selecione a caixa que comprova que você não é um robô!";
    header("location:../View/index.php?tokem=0"); 
    exit();

}



} catch (Exception $e) {
  $_SESSION['status']=0;
  $_SESSION['mensagem']="Algo deu errado, confira seus dados de acesso e tente novamente!";
 // echo "$e";
  header("Location:../View/?status=0");
    exit();
  
}



?>