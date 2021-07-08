<?php


function listar_video_individual($conexao,$idvideo) {
    $result = $conexao->query("SELECT * FROM video where id=$idvideo");
    return $result;
}

	function cadastrar_video_gt($conexao,$link, $titulo, $descricao, $id_funcionario,$iddisciplina,$data_visivel,$hora,$idserie,$setor) {

	    $result = $conexao->exec("INSERT INTO
	     video( titulo, id_funcionario, id_disciplina, link, descricao,data_visivel,serie_id,setor) 
	     VALUES ('$titulo',$id_funcionario,$iddisciplina,'$link','$descricao','$data_visivel',$idserie,'$setor')");
	    $id_video = $conexao->lastInsertId();
	    // $retorno =  array('1' => $result, '2' => $id_produto);
	    return $result;
	}

	function cadastrar_video($conexao,$link, $titulo, $descricao, $id_funcionario,$idturma,$iddisciplina,$data_visivel,$hora,$idescola,$idserie) {

	    $result = $conexao->exec("INSERT INTO
	     video( titulo, id_funcionario, id_turma, id_disciplina, link, descricao,data_visivel,escola_id,serie_id) 
	     VALUES ('$titulo',$id_funcionario,$idturma,$iddisciplina,'$link','$descricao','$data_visivel',$idescola,$idserie)");

	    $id_video = $conexao->lastInsertId();
	    // $retorno =  array('1' => $result, '2' => $id_produto);
	    return $result;
	}

	function visualizacao_video($conexao,$video_id,$aluno_id){
	    $result = $conexao->exec("INSERT INTO
	     visualizacao_video(aluno_id,video_id) 
	     VALUES ($aluno_id,$video_id)");	   
	    return $result;
	}


	 function listar_videos_assistidos_coordenador($conexao,$idaluno){

	    $result = $conexao->query("SELECT video.id as 'idvideo',video.titulo, COUNT(*) AS 'quantidade', disciplina.nome_disciplina FROM `visualizacao_video`,video,turma,disciplina,aluno WHERE video.id_turma= turma.idturma AND 
			video.id_disciplina=disciplina.iddisciplina AND visualizacao_video.video_id=video.id AND  visualizacao_video.aluno_id=aluno.idaluno AND aluno.idaluno=$idaluno GROUP BY visualizacao_video.video_id order by disciplina.nome_disciplina ");
	    return $result;
	}


	function listar_videos_assistidos($conexao,$idaluno,$iddisciplina,$idturma){
	    $result = $conexao->query("SELECT video.id as 'idvideo',video.titulo, COUNT(*) AS 'quantidade', disciplina.nome_disciplina FROM `visualizacao_video`,video,turma,disciplina,aluno WHERE video.id_turma= turma.idturma AND 
			video.id_disciplina=disciplina.iddisciplina AND visualizacao_video.video_id=video.id AND  visualizacao_video.aluno_id=aluno.idaluno AND disciplina.iddisciplina=$iddisciplina AND turma.idturma=$idturma AND aluno.idaluno=$idaluno GROUP BY visualizacao_video.video_id ");
	    return $result;
	}

	function listar_videos_assistidos_aluno($conexao,$idaluno,$idvideo){
	    $result = $conexao->query("SELECT * FROM `visualizacao_video` WHERE aluno_id=$idaluno and video_id=$idvideo ");
	    return $result;
	}
	// function listar_videos_assistidos_aluno($conexao,$idaluno,$idvideo){
	//     $result = $conexao->query("SELECT video.id as 'idvideo',video.titulo, COUNT(*) AS 'quantidade', disciplina.nome_disciplina FROM `visualizacao_video`,video,turma,disciplina,aluno WHERE video.id_turma= turma.idturma AND 
	// 		video.id_disciplina=disciplina.iddisciplina AND visualizacao_video.video_id=video.id AND  visualizacao_video.aluno_id=aluno.idaluno AND video.id=$idvideo AND aluno.idaluno=$idaluno GROUP BY visualizacao_video.video_id ");
	//     return $result;
	// }


	function listar_video_aulas_aluno($conexao,$escola_id,$idturma,$iddisciplina,$data) {
	    $result = $conexao->query("SELECT * FROM video where id_turma=$idturma and id_disciplina=$iddisciplina and escola_id=$escola_id and data_visivel <='$data' order by data_visivel desc   ");
	    return $result;
	}	

	function listar_video_aulas($conexao,$idturma,$iddisciplina,$data) {
	    $result = $conexao->query("SELECT * FROM video where id_turma=$idturma and  serie_id='' and id_disciplina=$iddisciplina and data_visivel <='$data' order by data_visivel desc   ");
	    return $result;
	}

	function listar_video_aulas_gt_nao_visualisado_aluno($conexao,$idserie,$data) {
	    $result = $conexao->query("SELECT * FROM video where setor='Secretaria' and serie_id=$idserie and data_visivel <='$data' order by data_visivel desc   ");
	    return $result;
	}

	function listar_video_aulas_gt_aluno($conexao,$idserie,$iddisciplina,$data) {
	    $result = $conexao->query("SELECT * FROM video where serie_id=$idserie and id_disciplina=$iddisciplina and data_visivel <='$data' and setor='Secretaria' order by data_visivel desc   ");
	    return $result;
	}


	function listar_video($conexao,$id_turma,$id_disciplina) {
	    $result = $conexao->query("SELECT * FROM video where  id_turma=$id_turma and id_disciplina=$id_disciplina order by data_visivel desc   ");
	    return $result;
	}	

	function listar_video_coordenador($conexao,$id_turma,$id_disciplina,$escola_id) {
	    $result = $conexao->query("SELECT * FROM video where  id_turma=$id_turma and id_disciplina=$id_disciplina and escola_id=$escola_id order by data_visivel desc   ");
	    return $result;
	}

	function listar_video_coordenador_por_serie($conexao,$iddisciplina,$idserie) {
	    $result = $conexao->query("SELECT * FROM video where  serie_id=$idserie and id_disciplina=$iddisciplina and id_turma IS NULL order by data_visivel desc   ");
	    return $result;
	}

	function listar_video_professor($conexao, $idprofessor,$idturma,$iddisciplina,$idescola) {
	    $result = $conexao->query("SELECT * FROM video where id_funcionario=$idprofessor  and id_turma=$idturma and id_disciplina=$iddisciplina and escola_id=$idescola order by data_visivel desc   ");
	    return $result;
	}
	
	function listar_video_gt_coordenador($conexao) {
	    $result = $conexao->query("SELECT * FROM video where setor ='Secretaria' order by id desc, data_visivel desc limit 10 ");
	    return $result;
	}		

	function conta_video_gt($conexao) {
	    $result = $conexao->query("SELECT count(*) as 'quantidade' FROM video where setor ='Secretaria' order by data_visivel desc  ");
	    return $result;
	}	

	function listar_video_gt_professor($conexao, $idserie) {
	    $result = $conexao->query("SELECT * FROM video where serie_id=$idserie and setor='Secretaria' order by data_visivel desc   ");
	    return $result;
	}



	function listar_video_aluno_atual($conexao,$id_turma,$id_disciplina) {
		$dataAtual=date("Y-m-d H:i:s");

	    $result = $conexao->query("SELECT * FROM video where  id_turma=$id_turma and id_disciplina=$id_disciplina and   data_visivel <= '$dataAtual' and status='Ativo'  order by id desc LIMIT 1   ");
	    return $result;
	}



	function listar_video_aluno($conexao,$id_turma,$id_disciplina) {
		$dataAtual=date("Y-m-d H:i:s");

	    $result = $conexao->query("SELECT * FROM video where  id_turma=$id_turma and id_disciplina=$id_disciplina and   data_visivel <= '$dataAtual' and status='Ativo'  order by data_visivel desc   ");
	    return $result;
	}

	// function listar_video_coordenador($conexao,$id_turma,$id_disciplina) {
	// 	    $result = $conexao->query("SELECT * FROM video where  id_turma=$id_turma and id_disciplina=$id_disciplina and status='Ativo'  order by data_visivel asc   ");
	//     return $result;
	// }

	function alterar_status_video($conexao, $id,$status) {
	    $result = $conexao->query("UPDATE  video SET status='$status' WHERE id=$id");
	    return $result;
	}

	function alterar_data_hora_video($conexao, $data, $idvideo){
	    $result = $conexao->exec("UPDATE video SET data_visivel='$data' WHERE id=$idvideo");
	    return $result;
	}


	function excluir_video($conexao, $id) {
	    $result = $conexao->query("DELETE FROM video WHERE id=$id");
	    return $result;
	}


	function quantidade_video($conexao,$id_turma,$id_disciplina, $mesinicio, $mesfim) {


	    $result = $conexao->query("SELECT count(*) as 'quantidade_aula' FROM video where  id_turma=$id_turma and id_disciplina=$id_disciplina and   
	    	(data_visivel between '$mesinicio' and   '$mesfim' ) and status='Ativo'    order by data_visivel desc   ");
	    return $result;
	}

?>