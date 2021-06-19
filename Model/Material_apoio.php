<?php
    function cadastrar_material_apoio($conexao, $titulo,$arquivo, $extensao, $escola_id, $turma_id, $disciplina_id) {
    	$conexao->exec("INSERT INTO material_apoio(titulo,arquivo, extensao, escola_id, turma_id, disciplina_id) VALUES (
            '$titulo','$arquivo', '$extensao', $escola_id, $turma_id, $disciplina_id
    )");
	}    

    function listar_material_apoio_turma_disciplina($conexao, $escola_id, $turma_id, $disciplina_id) {
        $result=$conexao->query("SELECT * FROM  material_apoio WHERE  escola_id=$escola_id and  turma_id=$turma_id and disciplina_id= $disciplina_id");
        return $result;
    }

	
?>