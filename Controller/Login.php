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
          }else{
              $_SESSION['status']=0;

             $_SESSION['mensagem']="Selecione a caixa que comprova que você não é um robô!";
              header("location:../View/index.php?tokem=2"); 
          }


          // foreach ($_POST as $key => $value) {
          //   echo "$key =". $value."</br>";
          // }

    //************************************************************



  if(isset($_POST["email"]) && $response != null && $response->success==true){
      $email = $_POST["email"];
       $email=strtolower($email);
       $senha = $_POST["senha"];
       $email= preg_replace('/[\'\"]/', '',$email);
       $senha=preg_replace('/[\']/', '',$senha);
       $email= preg_replace('/[\=]/', '',$email);
       $senha=preg_replace('/[\=]/', '',$senha);     
       $resultado = login_funcionario($conexao, $email, $senha);
       $cont = 0;

      foreach ($resultado as $key => $row) {
                $cont++;
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

                   $_SESSION["cargo"] = $cargo;
                   $_SESSION['status']=1;
                   header("Location:../View/coordenador.php");

                }
                else if ($cargo=="Professor" || $cargo=="Professora") {

                   $_SESSION["idfuncionario"] = $id;
                   
                   $_SESSION["idprofessor"] = $id;

                   $_SESSION["nome"] = $nome;

                   $_SESSION["email"] = $email;

                   $_SESSION["cargo"] = $cargo;
                   $_SESSION['status']=1;
                   header("Location:../View/professor.php");

                }
      }



    if ($cont ==0) {
        $resultado2 = login_aluno($conexao, $email, $senha);
            $cont = 0;
              foreach ($resultado2 as $key2 => $row2) {
                        $cont++;

                        $id = $row2["idaluno"];

                        $nome = $row2["nome"];
                        $email = $row2["email"];
                        $escola_id = $row2["escola_id"];
                        $turma_id = $row2["turma_id"];
                        $serie_id = $row2["serie_id"];
                        $sexo = $row2["sexo"];

                        $_SESSION["idaluno"] = $id;
                        $_SESSION["nome"] = $nome;

                        $_SESSION["email"] = $email;


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
                        header("Location:../View/aluno.php");
            }

            if ($cont == 0) {
              $_SESSION['mensagem']="Usuário ou senha incorreta!";

              $_SESSION['status']=0;
              header("Location:../View/index.php?status=0");
            }

        
    }else{
      $_SESSION['status']=0;
      $_SESSION['mensagem']="Usuário ou senha incorreta!";

      header("Location:../View/?status=0");
    }

}else{
  $_SESSION['status']=0;
  $_SESSION['mensagem']="Selecione a caixa que comprova que você não é um robô!";
   header("location:../View/index.php?tokem=0"); 
}
        
    
} catch (Exception $e) {
    $_SESSION['status']=0;
    $_SESSION['mensagem']="Algo deu errado, confira seus dados de acesso e tente novamente!";

    header("Location:../View/?status=0");
}



?>