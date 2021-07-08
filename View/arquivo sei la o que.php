
                    
                    <div class="col-md-12">
                      
                     
                      
                                  <div class="card card-default">
                                    <div class="card-header">
                                      <h3 class="card-title">
                                        <i class="fas fa-bullhorn"></i>
                                        Trabalhos 
                                      </h3>
                                    </div>

                                    <?php
                                      $res_pendencia=$conexao->query("SELECT * FROM trabalho WHERE escola_id=$idescola and turma_id=$idturma");
                                      foreach ($res_pendencia as $key => $value) {
                                        $idtrabalho=$value['id'];
                                        $titulo=$value['titulo'];
                                        $descricao=$value['descricao'];
                                        $data_entrega=$value['data_entrega'];


                                       

                                        $res=$conexao->query("SELECT * FROM trabalho_entregue WHERE trabalho_id=$idtrabalho limit 1");
                                        $cont=0;
                                        foreach ($res as $key => $value) {
                                          $cont++;
                                        }
                                        if ($cont==0) {
                                          echo"
                                            <div class='card-body'>
                                            <a href='trabalho_individual.php?idturma=$idturma&iddisciplina=$iddisciplina&idescola=$idescola'>
                                                <div class='callout callout-danger'>
                                                  <h5>$titulo</h5>
                                                  <p>$descricao</p>
                                                  <B>DATA DE ENTREGA: $data_entrega</B>
                                                </div>
                                              </a>
                                              </div>
                                              ";
                                        }else{
                                          echo"<div class='card-body'>
                                          <a href='trabalho_individual.php?idturma=$idturma&iddisciplina=$iddisciplina&idescola=$idescola'>
                                              <div class='callout callout-success'>
                                                <h5>$titulo</h5>
                                                <p>$descricao</p>
                                                <B>DATA DE ENTREGA: $data_entrega</B>
                                              </div>
                                            </a>
                                            </div>";
                                        }
                                        

                                          

                                    }                                  

                                    ?>
                                    
                                  </div>
                                  <!-- /.card -->
