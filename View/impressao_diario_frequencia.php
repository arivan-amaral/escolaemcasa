<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

set_time_limit(0);
session_start();
session_write_close();

include_once"../Controller/Conversao.php";
include_once"../Model/Conexao.php";
include_once"../Model/Coordenador.php";
include_once"../Model/Aluno.php";
include_once"../Model/Escola.php";

include_once"diarioFrequencia_infantil.php";
include_once"diarioFrequencia_fund1.php";
include_once"diarioFrequencia_fund2.php";

include_once"diarioFrequenciaPaginaFinal_infantil.php";
include_once"diarioFrequenciaPaginaFinal_fund1.php";
include_once"diarioFrequenciaPaginaFinal_fund2.php";
 
$ano_letivo=$_SESSION['ano_letivo'];
?>

<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta charset="UTF-8">
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">
<link rel=File-List href="pla_arquivos/filelist.xml">
<link rel=Edit-Time-Data href="pla_arquivos/editdata.mso">

<style>
.Namerotate {

    transform: rotate(-90deg);


    /* Legacy vendor prefixes that you probably don't need... */

    /* Safari */
    -webkit-transform: rotate(-90deg);

    /* Firefox */
    -moz-transform: rotate(-90deg);

    /* IE */
    -ms-transform: rotate(-90deg);

    /* Opera */
    -o-transform: rotate(-90deg);

    /* Internet Explorer */
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);

 /* display:inline-block;
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
  -webkit-transform: rotate(270deg);
  -ms-transform: rotate(270deg);
  transform: rotate(270deg);*/
  
}
 
.tblborder, .tblborder td, .tblborder th{
  border-collapse:collapse;
  border:1px solid #000;
}

.tblborder td, .tblborder th{
  padding:20px 10px;
}

.positionRi {
  position: absolute;
  top: 10px;
  left: 5px;
  /*right:0; */
  width: 200px;
  height: 150px;
  /*border: 3px solid #73AD21;*/
}
 
</style>

<link rel=dataStoreItem href="pla_arquivos/item0001.xml"
target="pla_arquivos/props002.xml">
<link rel=themeData href="pla_arquivos/themedata.thmx">
<link rel=colorSchemeMapping href="pla_arquivos/colorschememapping.xml">

<style type="text/css">
    
        table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        thead { display:table-header-group }
        tfoot { display:table-footer-group }


    @media print {
        .no-print, .no-print *
        {
            display: none !important;
        }
        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
      }
</style>

</head>

<body lang=PT-BR style='tab-interval:35.4pt;word-wrap:break-word'>




<!-- <center>
    
    
   
 <div class="box">
     <h1 style="color: red;">Página em manutenção</h1>
     <p>Estamos melhorando a velocidade e o desempenho da exibição dos dados. Seus dados seguem seguros e não serão afetados.</p>
 </div>


</center> -->






    <p class="no-print">
      <br>
      <br>
      
    <button style="width: 100%;height: 6%; font-size: large; background: #0275d8;color: white;" onclick='print();'>IMPRIMIR</button> 

    </p>

<?php 
$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$iddisciplina=$_GET['iddisciplina'];
$idserie=$_GET['idserie'];
$res_seg=$conexao->query("SELECT * FROM turma WHERE idturma=$idturma LIMIT 1");
  $seguimento=0;
$nome_turma="";
foreach ($res_seg as $key => $value) {
  $nome_turma=$value['nome_turma'];
  $seguimento=$value['seguimento'];
  // code...
}
$seguimento = $seguimento ?? 0;

$inicio=0;
$fim=36;

$conta_aula=1;
$conta_data=1;

$limite_data=36;
$limite_aula=36;

$periodo_id=$_GET['periodo_id'];
$idserie=$_GET['idserie'];

$descricao_trimestre="";
$data_inicio_trimestre="";
$data_fim_trimestre="";



  $res_calendario=listar_data_por_periodo($conexao,$ano_letivo,$periodo_id);
  foreach ($res_calendario as $key => $value) {
    $descricao_trimestre=$value['descricao'];
    $data_inicio_trimestre=$value['inicio'];
    $data_fim_trimestre=$value['fim'];
        
  }

if ($idserie<3) {
  
        //linha 409 508 
    $mapa_total_faltas = diario_frequencia_infantil($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento); 
            echo "<div class='pagebreak'> </div>";
     

        $inicio=36;
        $conta_aula=36;

        $limite_data=41;//$fim= 34;
        $limite_aula=30;//23

 
        $conta_data=1; //não existia
        $fim= 41;//$fim= 34;
 
        //linha 428 600 760
        diario_frequencia_pagina_final_infantil($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,
            $conta_aula+0,
            $conta_data+0,
            $limite_data+0,
            $limite_aula+0,
            $periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento, $mapa_total_faltas);
        
}elseif ($idserie>=3 && $idserie<8) {

        //linha 409 508 
           $mapa_total_faltas= diario_frequencia_fund1($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento); 
            echo "<div class='pagebreak'> </div>";
     
      $inicio=36;
        $conta_aula=36;

             $limite_data=41;//$fim= 34;
        $limite_aula=30;//23

 
        $conta_data=1; //não existia
        $fim= 41;//$fim= 34;
 
 var_dump($mapa_total_faltas);

        //linha 428 600 760
        diario_frequencia_pagina_final_fund1($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,
            $conta_aula+0,
            $conta_data+0,
            $limite_data+0,
            $limite_aula+0,
            $periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento,$mapa_total_faltas);
        
}elseif ($seguimento==1) {
  
        //linha 409 508 
        $mapa_total_faltas = diario_frequencia_infantil($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento); 
            echo "<div class='pagebreak'> </div>";
     




              $inicio=36;
        $conta_aula=36;

            $limite_data=41;//$fim= 34;
        $limite_aula=30;//23

 
        $conta_data=1; //não existia
        $fim= 41;//$fim= 34;
        
        //linha 428 600 760
        diario_frequencia_pagina_final_infantil($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento, $mapa_total_faltas);
        
}elseif ($seguimento==2) {
  
    
    //linha 409 508 
    diario_frequencia_fund1($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento); 
        echo "<div class='pagebreak'> </div>";
    

        $inicio=36;
        $conta_aula=36;

          $limite_data=41;//$fim= 34;
        $limite_aula=30;//23

 
        $conta_data=1; //não existia
        $fim= 41;//$fim= 34;

    //linha 428 600 760
    diario_frequencia_pagina_final_fund1($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,
        $conta_aula+0,
        $conta_data+0,
        $limite_data+0,
        $limite_aula+0,
        $periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento);
        
}elseif ($seguimento==3) {

        diario_frequencia_fund2($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento); 
        echo "<div class='pagebreak'> </div>";


        $inicio=36;//36;
        // $conta_aula=36;
        $conta_aula=37;

        // $limite_data=26;
        // $limite_aula=26;    
         $limite_data=31; //30
        $limite_aula=31; //30

        $conta_data=1; //não existia
        $fim= 30; //era 29 tirei para teste
        
        // diario_frequencia_pagina_final($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie)


        //linha 428 600 760
        diario_frequencia_pagina_final_fund2($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,
            $conta_aula+0,
            $conta_data+0,
            $limite_data+0,
            $limite_aula+0,

            $periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento);
}




else{
    //linha 409 508 
    
    if (isset($_GET['coordenacao'])) {
        
            $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);

            foreach ($pes as $chave => $linha) {
              $idprofessor=($linha['idprofessor']);
              $nome_disciplina=($linha['nome_disciplina']);
              $iddisciplina=$linha['iddisciplina'];
              // $nome_disciplina=$linha['nome'];

              $inicio=0;
              $fim=36;

              $conta_aula=1;
              $conta_data=1;

              $limite_data=36;
              $limite_aula=36;

              
                echo "
                <br>
                <br>      
                <button style='width: 100%;height: 6%; font-size: large; background: #0FDEC2;color: black;' class='no-print' >
                    $nome_disciplina
                </button> ";


                diario_frequencia_fund2($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento); 
                echo "<div class='pagebreak'> </div>";

                $inicio=36;
                $conta_aula=37;
                 $limite_data=31; //30
                $limite_aula=31; //30

                $conta_data=1; 
                $fim= 30; 
                

                //linha 428 600 760
                diario_frequencia_pagina_final_fund2($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,
                    $conta_aula+0,
                    $conta_data+0,
                    $limite_data+0,
                    $limite_aula+0,

                    $periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento);


            }
    }else{
        diario_frequencia_fund2($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento); 
        echo "<div class='pagebreak'> </div>";

        $inicio=36;
        $conta_aula=37;
         $limite_data=31; //30
        $limite_aula=31; //30

        $conta_data=1; 
        $fim= 30; 
        

        //linha 428 600 760
        //
        diario_frequencia_pagina_final_fund2($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,
            $conta_aula+0,
            $conta_data+0,
            $limite_data+0,
            $limite_aula+0,

            $periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento);
    }

}

 ?>
</body>
</html>