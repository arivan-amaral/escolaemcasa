  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    
    <a href="index.php" class="brand-link">
      <img src="imagens/logo.png" alt="educalem" style=" " height="100">
      <!-- <span class="brand-text font-weight-light">EDUCA LEM</span> -->
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <?php
            if (isset($_SESSION['cargo'])){
              echo $_SESSION['nome'];

            } 
            ?>
          </a>
          
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="./index.php" class="nav-link active">

              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Principal <i class="right fas fa-angle-left"></i></p>
            </a>


            <?php 

            echo "<ul class='nav nav-treeview'>
            <li class='nav-item'>";
            if (isset($_SESSION['idaluno'])) {
              echo "<a href='./aluno.php' class='nav-link'>";
            }else if (isset($_SESSION['idprofessor'])) {
              echo "<a href='./professor.php' class='nav-link'>";
            }else if (isset($_SESSION['idcoordenador'])) {
              echo "<a href='./coordenador.php' class='nav-link'>";
            }else {
              echo "<a href='./index.php' class='nav-link'>";

            }
            echo "<i class='far fa-circle nav-icon text-warning'></i>
            <p>Início</p>
            </a>
            </li>
            </ul>";



            if (isset($_SESSION['cargo'])) {



              if ($_SESSION['cargo']=='Secretário' || $_SESSION['cargo']=='Coordenador' || $_SESSION['cargo']=='Coordenadora'){

                

                echo "<ul class='nav nav-treeview'>
                <li class='nav-item'>
                <a href='alterar_dados_funcionario.php' class='nav-link'>
                <i class='far fa-circle nav-icon text-primary'></i>
                <p>Alterar Meus Dados</p>
                </a>
                </li>
                </ul>";
                
             echo "<ul class='nav nav-treeview'>
              <li class='nav-item'>
              <a href='alterar_foto_funcionario.php' class='nav-link'>
              <ion-icon name='images-outline'></ion-icon>
              <p>Alterar Foto</p>
              </a>
              </li>
              </ul>";
              

               echo"<li class='nav-item menu'>
               <a href='./index.php' class='nav-link'>
               <ion-icon name='apps-outline'></ion-icon>
               <p>Turmas <i class='right fas fa-angle-left'></i></p>
               </a>

               <ul class='nav nav-treeview'>
               <li class='nav-item'>
               <a href='cadastro_turma_escola.php' class='nav-link'>
               <i class='far fa-circle nav-icon text-primary'></i>
               <p>Associar turmas</p>
               </a>
               </li>
               </ul>

               </li>";  


               
            //    DANIEL
                // echo"<li class='nav-item menu'>
                //     <a href='./index.php' class='nav-link'>
                //     <ion-icon name='caret-forward-circle-sharp'></ion-icon>
                //     <p>Setor<i class='right fas fa-angle-left'></i></p>
                //     </a>
                    
                //     <ul class='nav nav-treeview'>
                //     <li class='nav-item'>
                //     <a href='cadastro_setor.php' class='nav-link'>
                //     <i class='far fa-circle nav-icon text-primary'></i>
                //     <p>Cadastrar Novo Setor</p>
                //     </a>
                //     </li>
                //     </ul>
                //     </li>";

            //     echo"<li class='nav-item menu'>
            // <a href='./index.php' class='nav-link'>
            // <ion-icon name='caret-forward-circle-sharp'></ion-icon>
            // <p>Chamadas <i class='right fas fa-angle-left'></i></p>
            // </a>
            
            // <ul class='nav nav-treeview'>
            // <li class='nav-item'>
            // <a href='cadastrar_chamada.php' class='nav-link'>
            // <i class='far fa-circle nav-icon text-primary'></i>
            // <p>Criar chamada </p>
            // </a>
            // </li>
            // <li class='nav-item'>
            // <a href='chamada.php' class='nav-link'>
            // <i class='far fa-circle nav-icon text-primary'></i>
            // <p>Ver chamadas</p>
            // </a>
            // </li>
            // </ul>
            // </li>";

            //     echo"<li class='nav-item menu'>
            //         <a href='./index.php' class='nav-link'>
            //         <ion-icon name='easel-outline'></ion-icon>
            //         <p>Setor<i class='right fas fa-angle-left'></i></p>
            //         </a>
                    
            //         <ul class='nav nav-treeview'>
            //         <li class='nav-item'>
            //         <a href='cadastro_setor.php' class='nav-link'>
            //         <i class='far fa-circle nav-icon text-primary'></i>
            //         <p>Cadastrar Novo Setor</p>
            //         </a>
            //         </li>
            //         </ul>
            //         </li>";

            //     echo"<li class='nav-item menu'>
            // <a href='./index.php' class='nav-link'>
            // <ion-icon name='chatbox-outline'></ion-icon>
            // <p>Chamadas <i class='right fas fa-angle-left'></i></p>
            // </a>
            
            // <ul class='nav nav-treeview'>
            // <li class='nav-item'>
            // <a href='cadastrar_chamada.php' class='nav-link'>
            // <i class='far fa-circle nav-icon text-primary'></i>
            // <p>Criar chamado </p>
            // </a>
            // </li>
            // <li class='nav-item'>
            // <a href='lista_minhas_chamadas.php' class='nav-link'>
            // <i class='far fa-circle nav-icon text-primary'></i>
            // <p>Ver meus chamados</p>
            // </a>
            // </li>
            // <li class='nav-item'>
            // <a href='chamada.php' class='nav-link'>
            // <i class='far fa-circle nav-icon text-primary'></i>
            // <p>Ver chamados</p>
            // </a>
            // </li>
            // </ul>
            // </li>";


               echo "
               <ul class='nav nav-treeview'>
               <li class='nav-item'>
               <a href='alterar_foto_funcionario.php' class='nav-link'>
               <ion-icon name='images-outline'></ion-icon>
               <p>Alterar Foto</p>
               </a>
               </li>
               </ul>

               <ul class='nav nav-treeview'>
               <li class='nav-item'>
               <a href='alterar_dados_funcionario.php' class='nav-link'>
               <i class='far fa-circle nav-icon text-primary'></i>
               <p>Alterar Meus Dados</p>
               </a>
               </li>
               </ul>"; 


               echo"
               <li class='nav-item menu'>
               <a href='./index.php' class='nav-link'>
               <ion-icon name='people-outline'></ion-icon>
               <p>Aluno <i class='right fas fa-angle-left'></i></p>
               </a>

               <ul class='nav nav-treeview'>
               <li class='nav-item'>
               <a href='cadastro_aluno.php' class='nav-link'>
               <i class='far fa-circle nav-icon text-primary'></i>
               <p>Cadastrar aluno</p>
               </a>
               </li>
               </ul>

               <ul class='nav nav-treeview'>
               <li class='nav-item'>
               <a href='pesquisa_aluno.php' class='nav-link'>
               <i class='far fa-circle nav-icon text-primary'></i>
               <p>Pesquisar aluno</p>
               </a>
               </li>
               </ul> 
               </li>";





             }

             if ($_SESSION['cargo']=='Coordenador' || $_SESSION['cargo']=='Coordenadora' ){
      

            echo"<li class='nav-item menu'>
            <a href='./index.php' class='nav-link'>
            <ion-icon name='caret-forward-circle-sharp'></ion-icon>
            <p>Vídeos GT <i class='right fas fa-angle-left'></i></p>
            </a>
            
            <ul class='nav nav-treeview'>
            <li class='nav-item'>
            <a href='cadastro_video_gt.php' class='nav-link'>
            <i class='far fa-circle nav-icon text-primary'></i>
            <p>Cadastrar vídeos </p>
            </a>
            </li>
            </ul>
            </li>";

           
            echo"<li class='nav-item menu'>
            <a href='./index.php' class='nav-link'>
            <ion-icon name='megaphone-sharp'></ion-icon>
            <p>Mural <i class='right fas fa-angle-left'></i></p>
            </a>
            
            <ul class='nav nav-treeview'>
            <li class='nav-item'>
            <a href='cadastro_mural_geral.php' class='nav-link'>
            <i class='far fa-circle nav-icon text-primary'></i>
            <p>Mural geral </p>
            </a>
            </li>
            </ul>
 
            
            </li>";


        

            }else if ($_SESSION['cargo']=='Professor' || $_SESSION['cargo']=='Professora' ){

              echo"

              <ul class='nav nav-treeview'>
              <li class='nav-item'>
              <a href='pesquisa_aluno.php' class='nav-link'>
              <i class='far fa-circle nav-icon text-primary'></i>
              <p>Pesquisar aluno</p>
              </a>
              </li>
              </ul> 
              ";

              echo "
              <ul class='nav nav-treeview'>
              <li class='nav-item'>
              <a href='professor.php' class='nav-link'>
              <i class='far fa-circle nav-icon text-success'></i>
              <p>Minhas Turmas</p>
              </a>
              </li>
              </ul> 
              <ul class='nav nav-treeview'>
              <li class='nav-item'>
              <a href='alterar_foto_funcionario.php' class='nav-link'>
              <ion-icon name='images-outline'></ion-icon>
              <p>Alterar Foto</p>
              </a>
              </li>
              </ul>

              <ul class='nav nav-treeview'>
              <li class='nav-item'>
              <a href='alterar_dados_funcionario.php' class='nav-link'>
              <i class='far fa-circle nav-icon text-primary'></i>
              <p>Alterar Meus Dados</p>
              </a>
              </li>
              </ul>

              ";
            }else if ($_SESSION['cargo']=='Aluno' || $_SESSION['cargo']=='Aluna') {
              echo"
              <ul class='nav nav-treeview'>
              <li class='nav-item'>
              <a href='alterar_foto.php' class='nav-link'>
              <ion-icon name='images-outline'></ion-icon>
              <p>Alterar Foto</p>
              </a>
              </li>
              </ul>

              <ul class='nav nav-treeview'>
              <li class='nav-item'>
              <a href='alterar_dados_aluno.php' class='nav-link'>
              <i class='far fa-circle nav-icon text-primary'></i>
              <p>Alterar Meus Dados</p>
              </a>
              </li>
              </ul> ";
            }


        }// fim do IF que verifica se tem sessão FUNÇÃO ativa...

        ?>


        <?php 

        if (isset($_SESSION['cargo'])) {
          if ($_SESSION['cargo']=='Coordenador' || $_SESSION['cargo']=='Coordenadora' ){


            if (isset($_SESSION['nivel_acesso_id'])) {
              if ($_SESSION['nivel_acesso_id']==2 || $_SESSION['nivel_acesso_id']==100) {



                                  // echo"<li class='nav-item menu'>
                                  //     <a href='./index.php' class='nav-link'>
                                  //        <i class='far fa-bell'></i>
                                  //         <p>Avisos<i class='right fas fa-angle-left'></i></p>
                                  //     </a>

                                  //      <ul class='nav nav-treeview'>
                                  //        <li class='nav-item'>
                                  //           <a href='cadastro_aviso.php' class='nav-link'>
                                  //             <i class='far fa-circle nav-icon text-primary'></i>
                                  //             <p>Cadastrar</p>
                                  //           </a>
                                  //         </li>
                                  //     </ul>


                                  // </li>";





                echo"<li class='nav-item menu'>
                <a href='./index.php' class='nav-link'>
                <ion-icon name='git-network-outline'></ion-icon>
                <p>Coordenador/Secretário <i class='right fas fa-angle-left'></i></p>
                </a>

                <ul class='nav nav-treeview'>
                <li class='nav-item'>
                <a href='cadastro_coordenador.php' class='nav-link'>
                <i class='far fa-circle nav-icon text-primary'></i>
                <p>Cadastrar</p>
                </a>
                </li>
                </ul>

                <ul class='nav nav-treeview'>
                <li class='nav-item'>
                <a href='pesquisar_coordenador_associar.php' class='nav-link'>
                <i class='far fa-circle nav-icon text-primary'></i>
                <p>Pesquisar </p>
                </a>
                </li>
                </ul>       
                </li>";
              }


            }
                              // echo"<li class='nav-item'>
                              //     <a href='./index.php' class='nav-link'>
                              //         <i class='fa fa-book'></i>
                              //         <p>Disciplina <i class='right fas fa-angle-left'></i></p>
                              //     </a>

                              //     <ul class='nav nav-treeview'>
                              //       <li class='nav-item'>
                              //         <a href='cadastro_disciplina.php' class='nav-link'>
                              //           <i class='far fa-circle nav-icon text-primary'></i>
                              //           <p>Cadastrar disciplinas</p>
                              //         </a>
                              //       </li>
                              //     </ul>

                              //     <ul class='nav nav-treeview'>
                              //       <li class='nav-item'>
                              //         <a href='pesquisa_aluno.php' class='nav-link'>
                              //           <i class='far fa-circle nav-icon text-primary'></i>
                              //           <p>Pesquisar disciplina</p>
                              //         </a>
                              //       </li>
                              //     </ul> 


                              // </li>";


                              // echo"<li class='nav-item menu'>
                              //     <a href='./index.php' class='nav-link'>
                              //         <ion-icon name='home-outline'></ion-icon>
                              //         <p>Escolas <i class='right fas fa-angle-left'></i></p>
                              //     </a>


                              //     <ul class='nav nav-treeview'>
                              //       <li class='nav-item'>
                              //         <a href='cadastro_escola.php' class='nav-link'>
                              //           <i class='far fa-circle nav-icon text-primary'></i>
                              //           <p>Cadastrar escolas</p>
                              //         </a>
                              //       </li>
                              //     </ul>  
                              //     <ul class='nav nav-treeview'>
                              //       <li class='nav-item'>
                              //         <a href='gerenciar_escola.php' class='nav-link'>
                              //           <i class='far fa-circle nav-icon text-primary'></i>
                              //           <p>Pesquisar escolas</p>
                              //         </a>
                              //       </li>
                              //     </ul> 



                              // </li>";




            echo"<li class='nav-item menu'>
            <a href='./index.php' class='nav-link'>
            <ion-icon name='people-outline'></ion-icon>
            <p>Professor <i class='right fas fa-angle-left'></i></p>
            </a>

            <ul class='nav nav-treeview'>
            <li class='nav-item'>
            <a href='cadastro_professor.php' class='nav-link'>
            <i class='far fa-circle nav-icon text-primary'></i>
            <p>Cadastrar professores</p>
            </a>
            </li>
            </ul>

            <ul class='nav nav-treeview'>
            <li class='nav-item'>
            <a href='pesquisar_professor_associar.php' class='nav-link'>
            <i class='far fa-circle nav-icon text-primary'></i>
            <p>Pesquisar professores</p>
            </a>
            </li>
            </ul> 

            </li>";






                        // echo"<li class='nav-item menu'>
                        //           <a href='./index.php' class='nav-link'>
                        //               <ion-icon name='git-pull-request-outline'></ion-icon>
                        //               <p>Associações <i class='right fas fa-angle-left'></i></p>
                        //           </a>
                        //           <ul class='nav nav-treeview'>
                        //             <li class='nav-item'>
                        //               <a href='pesquisar_professor_associar.php' class='nav-link'>
                        //                 <i class='far fa-circle nav-icon text-primary'></i>
                        //                 <p>Professor a turmas</p>
                        //               </a>
                        //             </li>
                        //           </ul> 


                        //           <!-- <ul class='nav nav-treeview'>
                        //             <li class='nav-item'>
                        //               <a href='relatorio_por_escola.php' class='nav-link'>
                        //                 <i class='far fa-circle nav-icon text-primary'></i>
                        //                 <p>Turmas a escolas</p>
                        //               </a>
                        //             </li>
                        //           </ul> -->





                        //       </li>";


                       /* echo"<li class='nav-item menu'>
                                  <a href='./index.php' class='nav-link'>
                                      <i class='nav-icon fas fa-chart-pie'></i>
                                      <p>Relatórios <i class='right fas fa-angle-left'></i></p>
                                  </a>
                                  
                                   <ul class='nav nav-treeview'>
                                    <li class='nav-item'>
                                      <a href='relatorio_por_escola.php' class='nav-link'>
                                        <i class='far fa-circle nav-icon text-primary'></i>
                                        <p>Relatório por escolas</p>
                                      </a>
                                    </li>
                                  </ul> 

                                  <ul class='nav nav-treeview'>
                                    <li class='nav-item'>
                                      <a href='relatorio_por_escola.php' class='nav-link'>
                                        <i class='far fa-circle nav-icon text-primary'></i>
                                        <p>Relatório por série</p>
                                      </a>
                                    </li>
                                  </ul> 

                                   <ul class='nav nav-treeview'>
                                    <li class='nav-item'>
                                      <a href='relatorio_por_turma.php' class='nav-link'>
                                        <i class='far fa-circle nav-icon text-primary'></i>
                                        <p>Relatórios por Turmas</p>
                                      </a>
                                    </li>
                                  </ul> 
                                  

                                   
                              </li>";
                              */




                            }
                          }




                          if (isset($_SESSION['cargo'])) {
                           echo" <li class='nav-item'>
                           <a href='./logout.php' class='nav-link'>
                           <i class='far fa-circle nav-icon text-danger'></i>
                           <p>SAIR</p>
                           </a>
                           </li>";
                         } else{
                          echo "
                          <li class='nav-item' id='entrar'>
                          <a href='./index.php' class='nav-link' data-toggle='modal' data-target='#modal-default'>
                          <i class='far fa-circle nav-icon text-success'></i>
                          <p>Entrar</p>
                          </a>
                          </li>";
                        }
                        ?>
                        <!-- ********************************************* -->
                      </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                  </div>
                  <!-- /.sidebar -->
                </aside>