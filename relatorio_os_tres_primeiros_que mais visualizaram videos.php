<div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
 <div class="row">

        <?php 

            $res_video=$conexao->query("SELECT * FROM visualizacao_video order by data_hora asc");
            $minuto_aux=0;
            foreach ($res_video as $key => $value) {
              $minuto_aux=$minuto_aux+($value['minuto']/2); 
             

            }
    ?>


        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-danger">

          <a href="mural.php" class="small-box-footer">
            <div class="inner">
              <h5><?php echo number_format(($minuto_aux), 2, '.', ''); ?> Minutos assistidos</h5>
            </div>
            <div class="icon">
              <!-- <i class="fas fa-tag"></i> -->
            </div>
            Total de minutos assistidos em toda a rede <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>         



             <?php 

                $pes_aluno=$conexao->query("SELECT aluno_id ,(SELECT DISTINCT SUM(minuto) ) AS 'minutos' FROM visualizacao_video GROUP BY aluno_id ORDER by minutos DESC limit 3");
              $nome_aluno="";
              $minutos_aluno=0;
              $conta_colocacao=1;
              $array_cores=array('1'=>'success','2'=>'primary','3'=>'info');
                foreach ($pes_aluno as $key => $value) {
                  $aluno_id=$value['aluno_id'];
                  $minutos_aluno=$value['minutos']/2;

                  $res_dados_aluno=$conexao->query("SELECT nome FROM aluno WHERE idaluno= $aluno_id limit 1");
                  foreach ($res_dados_aluno as $key2 => $value2) {
                    $nome_aluno=$value2['nome'];
                  }  
                  $cor=$array_cores[$conta_colocacao];
                  echo"

                  <div class='col-lg-3 col-6'>
                    <!-- small card -->
                    <div class='small-box bg-$cor'>

                    <a href='mural.php' class='small-box-footer'>
                      <div class='inner'>
                        <h5>$conta_colocacao ° lugar com ". number_format(($minutos_aluno), 2, '.', '')." Min assistidos</h5>
                      </div>
                      <div class='icon'>
                        <!-- <i class='fas fa-tag'></i> -->
                      </div>
                       $nome_aluno
                      <i class='fas fa-arrow-circle-right'></i>
                      </a>
                    </div>
                  </div>
                  ";              
                  $conta_colocacao++;
                }
        ?>



      </div>

  </div>
</div>