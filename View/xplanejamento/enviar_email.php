<?php
header('Content-Type: text/html; charset=utf-8');
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include "../../Model/Conexao.php";

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'valleteclablem@gmail.com';                     //SMTP username
    $mail->Password   = 'MudancaValle!';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`



   $res=$conexao->query("SELECT * from xplanejamento where enviado=0  limit 3");

    foreach ($res as $key => $value) {
        $id=$value['id'];
        $descr_tipoprocesso=$value['descr_tipoprocesso'];
        $id_pro =$value['id_pro'];
        $tautor =$value['tautor'];
        $descr_situacaoprojeto=$value['descr_situacaoprojeto'];
        $descr_situacaoprojeto2 =$value['descr_situacaoprojeto2'];
        $obsgerais=$value['obsgerais'];
        $tusuario =$value['tusuario'];
        $pagina=$value['pagina'];

        $mail->setFrom('from@example.com', 'Prefeitura de Luis Eduardo Magalhães - XPlanejamento');
        $mail->addAddress("$tusuario", "$tautor");  
        $mail->isHTML(true);
        $mail->Subject = "Analise de Processo [ $descr_tipoprocesso ]";
        $mail->Body    = "
        [ E-mail resposta, por favor não responda esse e-mail ] <br />
         Prezado(a) Senhor(a),<br/>
                <br/><br/>
                Status de processo de <strong>$descr_tipoprocesso</strong>, Protocolo: $id_pro<br/> 
                <strong>Autor da análise:</strong> $tautor <br/>
                <strong>Situação do projeto:</strong><br/>
                $descr_situacaoprojeto
                <br/>
                <b>$descr_situacaoprojeto2</b>
                <br/>
                <strong>Observações:</strong><br/>
                $obsgerais
                <br/>
                <br/>
                  www.luiseduardomagalhaes.ba.gov.br/planejamento <br/>
                <br/><br/>
                Agradecemos o contato!
        ";
        $mail->send();
       $conexao->exec("UPDATE xplanejamento SET enviado=1 WHERE id =$id");
       echo "certo<br>";
    }

} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
