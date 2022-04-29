<?php 
function lista_disciplina($conexao){
    try{
        $result = $conexao->query("SELECT * FROM disciplina  ORDER BY iddisciplina asc");
    } catch (PDOException $e){
        print "Erro!: ". $e -> getMessage(). "<br>";
    }
    return $result;
}

function lista_disciplina_nao_facultativa($conexao){
        $result = $conexao->query("SELECT * FROM disciplina where abreviacao IS NOT NULL and facultativo=0 ORDER BY iddisciplina asc");
    
    return $result;
}

function cadastrar_disciplina($conexao,$nome_disciplina){
    $result = $conexao->exec("INSERT INTO disciplina(nome_disciplina) VALUES ('$nome_disciplina')");
}

function pesquisar_disciplina_id($conexao,$id){
    $result = $conexao->query("SELECT * FROM disciplina where iddisciplina=$id");
    return $result;
}

function cadastrar_minhas_turmas($conexao,$turma,$disciplina,$id_funcionario){
    try{
        $result = $conexao->exec("INSERT into ministrada(turma_id,disciplina_id,professor_id, escola_id) values ($turma,$disciplina,$id_funcionario,1)");
    } catch (PDOException $e){
        print "Erro!: ". $e -> getMessage(). "<br>";
    }
    return $result;
}
?>