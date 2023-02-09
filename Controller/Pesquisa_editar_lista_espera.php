<?php 
 session_start();
 include_once '../Model/Conexao.php';
 include '../Model/Aluno.php';
 include '../Model/Coordenador.php';
 include '../Model/Serie.php';
 include 'Conversao.php';
 
try { 
    $idfuncionario=$_SESSION['idfuncionario'];

   $id=$_GET['id'];
     
 
    // $res_escola= escola_associada($conexao,$idfuncionario);
    //        $listasid = array();
    //        foreach ($res_escola as $key => $value) {
    //            $id=$value['idescola'];
    //            $listasid[$id]=$id;
    //        }
  
      

    $result="";
   $res = pesquisa_editar_lista_espera($conexao,$id);
   $conta=1;
   foreach ($res as $key => $value) {
        $id=$value['id'];
        $escola_id=$value['escola_id'];

        $nome_aluno=$value['nome_aluno'];
        $cpf_aluno=$value['cpf_aluno'];
        $cpf_responsavel=$value['cpf_responsavel'];
        $nome_responsavel=$value['nome_responsavel'];
        $nome_funcionario=$value['nome_funcionario'];
        $nome_serie=$value['nome_serie'];
        $nome_escola=$value['nome_escola'];
        $data_hora=$value['data_hora'];
        $telefone=$value['telefone'];
        $data_nascimento=$value['data_nascimento'];
        $status=$value['status'];
        $observacao=$value['observacao'];
        $endereco=$value['endereco'];

        $result.="
        <div class='row'>
                          <div class='col-sm-3'>
                            <div class='form-group'>
                              <label for='exampleInputEmail1'>Escola</label>
                              <select class='form-control'  name='escola_id' id='escola' onchange=lista_turma_cadastrada_escola_por_serie('tabela'); required>";
                           

                                $res_escola= escola_associada($conexao,$idfuncionario);
                                foreach ($res_escola as $key => $value) {
                                 $idescola=$value['idescola'];
                                 $nome_escola=$value['nome_escola'];
                                 if ($idescola==$escola_id) {
                                     $result.="<option value='$idescola'>$nome_escola </option>";

                                 }else{
                                    $result.="<option value='$idescola'>$nome_escola </option>";
                                 }

                               }
                                
                             $result.="</select>
                           </div>
                         </div>                      
                         
                         <div class='col-sm-3'>
                          <div class='form-group'>
                            <label for='exampleInputEmail1'>Série</label>
                            <select class='form-control'  name='serie_id' id='serie_id'>";

                              $res_serie=pesquisar_ordem_proxima_serie($conexao,'id=1');
                              foreach ($res_serie as $key => $value) {
                                $idserie=$value['id'];
                                $nome_serie=$value['nome'];
                               
                                $result.="<option value='$idserie'>$nome_serie </option>";
                              }
                            
                            $result.="</select>
                          </div>
                        </div> 




                <div class='col-sm-3'>
                  <div class='form-group'>
                   <label for='exampleInputEmail1'>Nome do aluno</label>
                   <input type='hidden' class='form-control' name='id' required value='$id' readonly>
                   <input type='text' class='form-control' name='nome_aluno' required value='$nome_aluno'>
                   
                 </div>

               </div> 

               
               <div class='col-sm-3'>
                <div class='form-group'>
                 <label for='exampleInputEmail1'>Data nasc. do aluno</label>
                 <input type='date' class='form-control'  name='data_nascimento' required value='$data_nascimento'>
                 
               </div>
             </div>                       

             <div class='col-sm-3'>
              <div class='form-group'>
               <label for='exampleInputEmail1'>Cpf do aluno</label>

               <input type='text' name='cpf_aluno'  id='cpf_aluno' class='form-control' placeholder='Digite seu CPF do aluno' required='  onkeyup=fMasc( this, mCPF ); ValidaCPF('cpf_aluno'); maxlength='14' value='$cpf_aluno'>
               
             </div>
           </div>

           <div class='col-sm-4'>
            <div class='form-group'>
             <label for='exampleInputEmail1'>Nome do responsável</label>
             <input type='text' class='form-control'  name='nome_responsavel' required value='$nome_responsavel'>
             </div>
            </div>

       
          <div class='form-group'>
           <label for='exampleInputEmail1'>Cpf do responsável</label>
           <div id='status_cpf'></div>
           
           <input type='text' name='cpf_responsavel'  id='cpf' class='form-control' placeholder='Digite seu CPF do responsável' required='  onkeyup=fMasc( this, mCPF ); ValidaCPF('cpf'); maxlength='14' value='$cpf_responsavel'>


           
         </div>
        </div>
</div>

   <div class='row'>
        <div class='col-sm-3'>
          <div class='form-group'>
           <label for='exampleInputEmail1'>WhatsApp do responsável</label>
           <input type='tel' class='form-control' name='telefone'    required value='$telefone'>
           
         </div>
        </div>
        <div class='col-sm-5'>
          <div class='form-group'>
           <label for='exampleInputEmail1'>Endereço</label>
           <input type='text' class='form-control' name='endereco'    required value='$endereco'>

         </div>
        </div> 
        
        <div class='col-sm-5'>
          <div class='form-group'>
           <label for='exampleInputEmail1'>Observação</label>
           <textarea class='form-control' name='observacao' rows='5'>$observacao</textarea>
           
        
          </div>
        </div>

        </div>";

          $result.='<button type="button" class="btn btn-block btn-primary" id="editar_lista_espera" onclick=submit_post_generico("../Controller/Editar_lista_espera.php,form_lista_espera_editar,editar_lista_espera"); lista_espera();> Concluir edição </button>' ;
  



        $conta++;
   }

echo "$result";
 
} catch (Exception $e) {
    echo "errado $e";
}
?>