<?php 
include_once"../Controller/Conversao.php";
include_once"../Model/Conexao.php";
include_once"../Model/Coordenador.php";
include_once"../Model/Aluno.php";

include_once"diarioFrequencia.php";
include_once"diarioFrequenciaPaginaFinal.php";
include_once"diarioFrequenciaPaginaFinal_fund1.php";

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
  display:inline-block;
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
  -webkit-transform: rotate(270deg);
  -ms-transform: rotate(270deg);
  transform: rotate(270deg);
  
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

        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
      }
</style>
</head>

<body lang=PT-BR style='tab-interval:35.4pt;word-wrap:break-word'>



<?php 
$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$iddisciplina=$_GET['iddisciplina'];
$idserie=$_GET['idserie'];

$inicio=0;
$fim=36;

$conta_aula=1;
$conta_data=1;

$limite_data=36;
$limite_aula=36;

$periodo_id=$_GET['periodo_id'];
$idserie=$_GET['idserie'];

$data_inicio_trimestre="";
$data_fim_trimestre="";

if ($periodo_id==1) {
    $data_inicio_trimestre="2021-05-03";
    $data_fim_trimestre="2021-07-09";
    
    // code...
}elseif ($periodo_id==2) {
    $data_inicio_trimestre="2021-07-27";
    $data_fim_trimestre="2021-10-01";
    // code...
}elseif ($periodo_id==3) {
    $data_inicio_trimestre="2021-10-04";
    $data_fim_trimestre="2021-12-21";
    // code...
}


if ($idserie<8) {

        //linha 409 508 
        diario_frequencia($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$data_inicio_trimestre,$data_fim_trimestre); 
            echo "<div class='pagebreak'> </div>";
     

        $inicio=35;
        // $conta_aula=36;
        $conta_aula=36;

        $limite_data=18;
        $limite_aula=18;

        // $limite_data=18;
        // $limite_aula=18; 
        $conta_data=1; //não existia
        $fim= 17;
        // diario_frequencia_pagina_final($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie)


        //linha 428 600 760
        diario_frequencia_pagina_final_fund1($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,
            $conta_aula+0,
            $conta_data+0,
            $limite_data+0,
            $limite_aula+0,
            $periodo_id,$idserie,$data_inicio_trimestre,$data_fim_trimestre);
        
}else{
    //linha 409 508 
        diario_frequencia($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$data_inicio_trimestre,$data_fim_trimestre); 
        echo "<div class='pagebreak'> </div>";


        $inicio=36;//36;
        // $conta_aula=36;
        $conta_aula=36;

        // $limite_data=26;
        // $limite_aula=26;    
         $limite_data=30;
        $limite_aula=30;

        $conta_data=1; //não existia
        $fim= 29; //era 25 tirei para teste
        
        // diario_frequencia_pagina_final($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie)


        //linha 428 600 760
        diario_frequencia_pagina_final($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,
            $conta_aula+0,
            $conta_data+0,
            $limite_data+0,
            $limite_aula+0,

            $periodo_id,$idserie,$data_inicio_trimestre,$data_fim_trimestre);

}

 ?>
</body>
</html>