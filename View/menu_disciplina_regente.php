<?php
$array_turma_regente_creche[$conta] = $idturma;

$iddisciplina = 1000;
$disciplina = "DISCIPLINAS REGENTES";
 
echo "

<div class='card card-secondary'>

  <div class='card-header'>

    <h4 class='card-title w-100'>";

echo " <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne$iddisciplina$idturma$idescola' aria-expanded='false'><b class='text-white'>$idescola - $nome_escola -></b>" . ($turma) . " - <b>" .

  ($disciplina)

  . "</b> <i class='right fas fa-angle-left'></i>

      </a>

    </h4>

  </div>

  <div id='collapseOne$iddisciplina$idturma$idescola' class='collapse' data-parent='#accordion' style=''>

    <div class='card-body'>

      <div class='row'>
        <div class='col-lg-3 col-6'>
          <!-- small card -->
          <div class='small-box bg-info'>
            <div class='inner'>
              <h3></h3>

              <p>Conteúdo</p>
            </div>
            <div class='icon'>

            </div>
            <a href='cadastrar_conteudo.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer'>
              Cadastrar conteúdo <ion-icon name='document-text'></ion-icon>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class='col-lg-3 col-6'>
          <!-- small card -->
          <div class='small-box bg-success'>
            <div class='inner'>
              <h3> </h3>

              <p>Frequência</p>
            </div>
            <div class='icon'>
              <i class='ion ion-stats-bars'></i>
            </div>
            <a href='diario_frequencia.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer'>
              Cadastrar frequência <i class='fa fa-calendar'></i>
            </a>
          </div>
        </div>

        <div class='col-lg-3 col-6'>
          <!-- small card -->
          <div class='small-box bg-danger'>
            <div class='inner'>
              <h3></h3>

              <p>Avaliação</p>
            </div>
            <div class='icon'>

            </div>
            <a href='diario_avaliacao.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer'>
              Cadastrar avaliação <i class='fas fa-chart-pie'></i>
            </a>
          </div>
        </div>

      </div>
      <a href='listar_alunos_da_turma_professor.php?iddisciplina=$iddisciplina&turma=$turma&disciplina=$disciplina&idturma=$idturma&nome_disciplina=$disciplina&nome_turma=$turma&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>
        <i class='fa fa-users'></i>
        Lista de alunos
      </a>



      <a class='btn btn-info btn-block btn-flat' href='cadastrar_mural.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie'>



        <font style='vertical-align: inherit;'>

          <font style='vertical-align: inherit;'>

            <ion-icon name='megaphone'></ion-icon>

            Mural

          </font>

        </font>

      </a>


      <a class='btn btn-info btn-block btn-flat' href='cadastro_video.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie'>



        <font style='vertical-align: inherit;'>

          <font style='vertical-align: inherit;'>

            <i class='fa fa-play'></i>

            Videoaulas

          </font>

        </font>

      </a>

      <!-- -->
      <a class='btn btn-info btn-block btn-flat' href='cadastrar_link_video_chamada.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie'>



        <font style='vertical-align: inherit;'>

          <font style='vertical-align: inherit;'>

            <ion-icon name='link'></ion-icon>

            Link de vídeo chamadas

          </font>

        </font>

      </a>


      <a href='cadastro_trabalho.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>

        <i class='fa fa-book'></i>

        Trabalhos/Atividades

      </a>


      <a href='resultado_questionario.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>

        <ion-icon name='eye'></ion-icon>

        Acompanhar Prova/Testes

      </a>


      <a href='cadastro_material_apoio.php?disc=$iddisciplina&turm=$idturma&turma=$turma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>
        <ion-icon name='document-text'></ion-icon>
        MATERIAL DE APOIO
      </a>


      <a class='btn btn-info btn-block btn-flat' href='chat_professor.php?escola_id=$idescola&turma_id=$idturma' onclick=alert('chat desabilitado');>
        <font style='vertical-align: inherit;'>
          <font style='vertical-align: inherit;'>
            <i class='fas fa-comments'></i>
            Chat da turma
          </font>
        </font>
      </a>";
if ($idserie > 2 && $idserie < 8) {
  echo "<a href='habilidade.php?idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-warning btn-block btn-flat' target='_blank'>
                    <i class='fa fa-card'></i> 
                    HABILIDADES
                    </a>";
}
echo "<br>
        <div class='col-sm-12'>
          <div class='card card-secondary collapsed-card'>
            <div class='card-header' data-card-widget='collapse'>
              <h3 class='card-title'>RESULTADOS/CONTEÚDOS</h3>

              <div class='card-tools'>
                <button type='button' class='btn btn-tool' data-card-widget='collapse'>
                  <i class='fas fa-plus'></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class='card-body' style='display: none;'>

              <a href='diario_conteudo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat'>
                <i class='fa fa-edit'></i>
                CONTEÚDOS DE AULAS
              </a>";

if ($idserie < 3) {
  echo "<a href='parecer_descritivo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat'>
                    <i class='fa fa-edit'></i> 
                    PARECER DESCRITIVO
                    </a>";
}
echo " <a class='btn btn-secondary btn-block btn-flat' href='boletim.php?idescola=$idescola&idturma=$idturma&disciplina=$disciplina&idescola=$idescola&idserie=$idserie&tokem_teste=reee' >
                      <font style='vertical-align: inherit;'>
                       <font style='vertical-align: inherit;'> 
                         <i class='fa fa-calendar'></i>
                          BOLETIM
                          </font>
                        </font>
                </a>                                       


                <a   href='diario_rendimento.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat'>
                <i class='fa fa-calendar'></i> 
                RESULTADO ANUAL
                </a>";
if ($idserie < 8 || ($seguimento != '' && $seguimento < 3) || ($idserie == 16 && $seguimento < 3)) {
  echo "
                      <a   href='impressao_diario_frequencia.php?iddisciplina=1000&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat' target='_blank'>
                      <i class='fa fa-calendar'></i> 
                      FICHA DE RENDIMENTO TRI I
                      </a> 

                      <a   href='impressao_diario_frequencia.php?iddisciplina=1000&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=2' class='btn btn-secondary btn-block btn-flat' target='_blank'>
                      <i class='fa fa-calendar'></i> 
                      FICHA DE RENDIMENTO TRI II
                      </a>   
                      <a   href='impressao_diario_frequencia.php?iddisciplina=1000&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=3' class='btn btn-secondary btn-block btn-flat' target='_blank'>
                      <i class='fa fa-calendar'></i> 
                      FICHA DE RENDIMENTO TRI III
                      </a>  ";
} else {
  echo "<a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat'>
                  <i class='fa fa-calendar'></i> 
                  FICHA DE RENDIMENTO TRI I
                  </a> 

                  <a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=2' class='btn btn-secondary btn-block btn-flat'>
                  <i class='fa fa-calendar'></i> 
                  FICHA DE RENDIMENTO TRI II
                  </a>   
                  <a   href='impressao_diario_frequencia.php?iddisciplina=$iddisciplina&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=3' class='btn btn-secondary btn-block btn-flat'>
                  <i class='fa fa-calendar'></i> 
                  FICHA DE RENDIMENTO TRI III
                  </a>";
}
echo " </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


        </div>

    </div>

  </div>

  ";
