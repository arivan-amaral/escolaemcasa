<?php 

	function calculos_media_notas($nota,$nota_rp,$nota_av3){
		$media_nota=0;
		if (!is_numeric($nota)) {
			$nota=0;
		}		
		if (!is_numeric($nota_rp)) {
			$nota_rp=0;
		}		
		if (!is_numeric($nota_av3)) {
			$nota_av3=0;
		}
		
		if ( $nota!='' && $nota_rp > $nota_av3) {

	       $media_nota=($nota-$nota_av3)+$nota_rp;
         echo "recarregue a pag:";
	     }else{
	     	$media_nota=$nota;
	     }
     return $media_nota;
	}



function gerar_media_ata($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$ano_letivo,$idserie){

    $media=0;
    for ($periodo=1; $periodo <=3 ; $periodo++) { 
            $result_nota=pesquisa_nota_por_periodo($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$periodo,$ano_letivo);
            $nota_tri=0;
            $nota_av3=0;
            $nota_rp=0;
            foreach ($result_nota as $key => $value) {
                
                if ($value['avaliacao']!='RP') {
                  $nota_tri=$nota_tri+$value['nota'];
                }else if ($value['avaliacao']=='av3') {
                  $nota_av3=$value['nota'];
                }else if ($value['avaliacao']=='RP') {
                  $nota_rp=$value['nota'];
                }


            }

            $media=$media+calculos_media_notas($nota_tri,$nota_rp,$nota_av3);
        
    }



    if (!($media >= 5)) {
        $res_conselho=buscar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno,$ano_letivo);

        $conta_aprovado=count($res_conselho);
        
        if ($conta_aprovado>0 ) {
          $media=number_format('5', 1, '.', ',');

        }else{
           
         $media=number_format($media, 1, '.', ',');

        }

    }

   if ($media>0) {
    	$media=$media/3;
    	$media=number_format($media, 1, '.', ',');
    }


    $res_hist=$conexao->query("
        SELECT * from historico where 
        aluno_id =$idaluno and 
        disciplina_id = $iddisciplina and
        serie_id= $idserie LIMIT 1

        ");

      $quantidade_hist=0;
      foreach ($res_hist as $key_h => $value_h) {
        $quantidade_hist++;

      }
      if ($quantidade_hist==0) {
       $conexao->exec("
        INSERT INTO historico (aluno_id,ano, nota_final, disciplina_id, serie_id, escola_id)
        VALUES ($idaluno,$ano_letivo, $media, $iddisciplina, $idserie, $idescola)
        ");

     }else{
 
      $conexao->exec("
        UPDATE historico SET 
        aluno_id=$idaluno,
        ano=$ano_letivo,
        nota_final=$media,
        disciplina_id=$iddisciplina,
        serie_id=$idserie, 
        escola_id=$idescola
        where
        aluno_id =$idaluno and 
        
        disciplina_id = $iddisciplina and
        serie_id= $idserie
        ");
    }

   


    return number_format($media, 1, '.', ',');

}
?>