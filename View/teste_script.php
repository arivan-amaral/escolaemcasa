<?php 
  include '../Model/Conexao_ecidade.php';
  include '../Model/Conexao.php';
  $pdo;
  // $res=listar_alunos($pdo);
  
try {
  

  $res=$pdo->query("select ed18_i_codigo,
  ed57_i_codigo, to_ascii(ed18_c_nome,'LATIN1') as ed18_c_nome,
   ed57_i_codigo, to_ascii(ed57_c_descr,'LATIN1') as ed57_c_descr,
   ed11_i_codigo, ed11_c_descr
  from turma
      inner join escola              on ed18_i_codigo = ed57_i_escola
      inner join calendario          on ed52_i_codigo = ed57_i_calendario
      inner join turmaserieregimemat on ed220_i_turma = ed57_i_codigo
      inner join serieregimemat      on ed223_i_codigo = ed220_i_serieregimemat
      inner join serie               on ed11_i_codigo = ed223_i_serie
where ed52_i_ano   = 2021
order by ed18_i_codigo");
    
    $endereco="";
    $telefone="";
    $numero="";
    $bairro="";
    $complemento="";
    $conta=1;
    $quantidade_turmas=0;
    

  foreach ($res as $key => $value) {
    $nome_turma=$value['ed57_c_descr'];
    $idescola=$value['ed18_i_codigo'];
    $nome_escola=$value['ed18_c_nome'];

    $ed11_i_codigo=$value['ed111_i_codigo'];
    $ed11_c_descr=$value['ed11_c_descr'];

    $array = explode('-', $nome_turma);
    //$nome_turma=$array[0];
    echo "$conta - $nome_turma - $nome_escola ed11_c_descr: $ed11_c_descr<br>";
  }

echo " quantidade total= $conta";



  echo "parece que ta ok";
} catch (Exception $e) {
  echo "$e";
}
 ?>


