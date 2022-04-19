
  <script src='ajax.js?<?php echo rand(); ?>'></script>

<div class='content-wrapper' style='min-height: 529px;'>

  <!-- Content Header (Page header) -->

  <div class='content-header'>

    <div class='container-fluid'>

      <div class='row mb-2'>

        <div class='col-sm-12 alert alert-warning'>
          <center>
            <h1 class='m-0'><b>EDUCA LEM - Cadu </b></h1>
        </center>

      </div><!-- /.col -->

      

    </div><!-- /.row -->

  </div><!-- /.container-fluid -->

</div>

<!-- /.content-header -->



<!-- Main content -->

<section class='content'>

  <div class='container-fluid'>
    <!-- Info boxes -->
    <!-- .row -->
    <div class='row'>
      <div class='col-sm-1'></div>
      <div class='col-sm-10'>
        <button class='btn btn-block btn-lg btn-secondary'>CEMEI - CLEUSA SANTOS SILVA E SILVA - INEP 29464749-<b class='text-warning'>MATERNAL I A </b></button>
        </div>
      </div>
      <br>
        <div class='row'>
          <div class='col-sm-3'>
            <a  class='btn btn-block btn-danger' onclick="mudar_action_form('Solicitacao_transferencia.php');"  data-toggle='modal' data-target='#modal_transferencia'>Transferir selecionados</a>
          </div>
         
       <div class='col-sm-3'>
        <a href='' class='btn btn-block btn-primary' onclick=
        "mudar_action_form(
        'Troca_aluno_de_turma.php');"data-toggle='modal' data-target='#modal_troca_de_turma'>Trocar de turma os selecionados</a>
      </div>
      
  </div>



  <form action='' name='procedimentos' id='procedimentos' method='post'>




    <div class='row'>

     <div class='card-body'>

      <table class='table table-bordered'>

        <thead>
          <tr>
            <th style='width: 20px'>
              Todos
              <input type='checkbox' id='checkTodos' class='checkbox' name='checkTodos' onclick='seleciona_todos_alunos();'> 
            </th>


            <th style='width: 50px'>Situação Matrícula</th>
            <th>Dados do Aluno</th>
            <th>Resultado</th>
            <th>Opção</th>
          </tr>
        </thead>

        <tbody><tr id='linha110027'>
              <input type='hidden' id='matricula110027' name='matricula110027' value='164116'>
                <td>1 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='110027'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>110027 -
            <b class='text-success'> Alice Gomes dos Santos </b> <BR>
            Data nascimento: 04/10/2019 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Alice.Gomes62  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno110027' value='Alice Gomes dos Santos'><input type='hidden' name='matricula_aluno110027' value='164116'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3110027' onclick='mudar_status_aluno(0,110027)' checked>

  <label class='custom-control-label' for='customSwitch3110027' id='customSwitch3110027' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha109920'>
              <input type='hidden' id='matricula109920' name='matricula109920' value='163442'>
                <td>2 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='109920'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>109920 -
            <b class='text-success'> Alicía Santos Alves </b> <BR>
            Data nascimento: 20/01/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Alicía.Santos31  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno109920' value='Alicía Santos Alves'><input type='hidden' name='matricula_aluno109920' value='163442'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3109920' onclick='mudar_status_aluno(0,109920)' checked>

  <label class='custom-control-label' for='customSwitch3109920' id='customSwitch3109920' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha110006'>
              <input type='hidden' id='matricula110006' name='matricula110006' value='163914'>
                <td>3 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='110006'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>110006 -
            <b class='text-success'> Anna Laura Maia dos Santos </b> <BR>
            Data nascimento: 20/11/2019 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Anna.Laura88  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno110006' value='Anna Laura Maia dos Santos'><input type='hidden' name='matricula_aluno110006' value='163914'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3110006' onclick='mudar_status_aluno(0,110006)' checked>

  <label class='custom-control-label' for='customSwitch3110006' id='customSwitch3110006' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha109873'>
              <input type='hidden' id='matricula109873' name='matricula109873' value='162858'>
                <td>4 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='109873'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>109873 -
            <b class='text-success'> Antonella Aguiar Batista </b> <BR>
            Data nascimento: 24/02/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Antonella.Aguiar23  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno109873' value='Antonella Aguiar Batista'><input type='hidden' name='matricula_aluno109873' value='162858'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3109873' onclick='mudar_status_aluno(0,109873)' checked>

  <label class='custom-control-label' for='customSwitch3109873' id='customSwitch3109873' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha112081'>
              <input type='hidden' id='matricula112081' name='matricula112081' value='173219'>
                <td>5 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='112081'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>112081 -
            <b class='text-success'> Bernardo Macário da Macena </b> <BR>
            Data nascimento: 23/02/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Bernardo.Macário0  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno112081' value='Bernardo Macário da Macena'><input type='hidden' name='matricula_aluno112081' value='173219'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3112081' onclick='mudar_status_aluno(0,112081)' checked>

  <label class='custom-control-label' for='customSwitch3112081' id='customSwitch3112081' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha111323'>
              <input type='hidden' id='matricula111323' name='matricula111323' value='169688'>
                <td>6 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='111323'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>111323 -
            <b class='text-success'> Carlos Arthur da Silva </b> <BR>
            Data nascimento: 17/02/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Carlos.Arthur63  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno111323' value='Carlos Arthur da Silva'><input type='hidden' name='matricula_aluno111323' value='169688'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3111323' onclick='mudar_status_aluno(0,111323)' checked>

  <label class='custom-control-label' for='customSwitch3111323' id='customSwitch3111323' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha113665'>
              <input type='hidden' id='matricula113665' name='matricula113665' value='178589'>
                <td>7 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='113665'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>113665 -
            <b class='text-success'> Cristal Esther Meira Alves </b> <BR>
            Data nascimento: 13/03/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Cristal.Esther95  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno113665' value='Cristal Esther Meira Alves'><input type='hidden' name='matricula_aluno113665' value='178589'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3113665' onclick='mudar_status_aluno(0,113665)' checked>

  <label class='custom-control-label' for='customSwitch3113665' id='customSwitch3113665' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha109853'>
              <input type='hidden' id='matricula109853' name='matricula109853' value='162506'>
                <td>8 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='109853'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>109853 -
            <b class='text-success'> Emanoel Lucas dos Anjos Pereira </b> <BR>
            Data nascimento: 13/01/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Emanoel.Lucas38  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno109853' value='Emanoel Lucas dos Anjos Pereira'><input type='hidden' name='matricula_aluno109853' value='162506'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3109853' onclick='mudar_status_aluno(0,109853)' checked>

  <label class='custom-control-label' for='customSwitch3109853' id='customSwitch3109853' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha109857'>
              <input type='hidden' id='matricula109857' name='matricula109857' value='162597'>
                <td>9 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='109857'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>109857 -
            <b class='text-success'> Hendy Bernardo Alves da Cruz </b> <BR>
            Data nascimento: 07/11/2019 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Hendy.Bernardo60  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno109857' value='Hendy Bernardo Alves da Cruz'><input type='hidden' name='matricula_aluno109857' value='162597'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3109857' onclick='mudar_status_aluno(0,109857)' checked>

  <label class='custom-control-label' for='customSwitch3109857' id='customSwitch3109857' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha110001'>
              <input type='hidden' id='matricula110001' name='matricula110001' value='163850'>
                <td>10 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='110001'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>110001 -
            <b class='text-success'> Henzo Brito Profeta </b> <BR>
            Data nascimento: 16/11/2019 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Henzo.Brito99  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno110001' value='Henzo Brito Profeta'><input type='hidden' name='matricula_aluno110001' value='163850'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3110001' onclick='mudar_status_aluno(0,110001)' checked>

  <label class='custom-control-label' for='customSwitch3110001' id='customSwitch3110001' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha109869'>
              <input type='hidden' id='matricula109869' name='matricula109869' value='162792'>
                <td>11 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='109869'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>109869 -
            <b class='text-success'> Henzo Miguel dos Santos Pereira </b> <BR>
            Data nascimento: 26/01/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Henzo.Miguel27  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno109869' value='Henzo Miguel dos Santos Pereira'><input type='hidden' name='matricula_aluno109869' value='162792'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3109869' onclick='mudar_status_aluno(0,109869)' checked>

  <label class='custom-control-label' for='customSwitch3109869' id='customSwitch3109869' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha110011'>
              <input type='hidden' id='matricula110011' name='matricula110011' value='164047'>
                <td>12 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='110011'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>110011 -
            <b class='text-success'> Isaac Uriel Jesus de Araújo </b> <BR>
            Data nascimento: 09/10/2019 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Isaac.Uriel69  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno110011' value='Isaac Uriel Jesus de Araújo'><input type='hidden' name='matricula_aluno110011' value='164047'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3110011' onclick='mudar_status_aluno(0,110011)' checked>

  <label class='custom-control-label' for='customSwitch3110011' id='customSwitch3110011' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha109989'>
              <input type='hidden' id='matricula109989' name='matricula109989' value='163790'>
                <td>13 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='109989'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>109989 -
            <b class='text-success'> Jhonatan Elias Guedes Borges </b> <BR>
            Data nascimento: 07/03/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Jhonatan.Elias15  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno109989' value='Jhonatan Elias Guedes Borges'><input type='hidden' name='matricula_aluno109989' value='163790'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3109989' onclick='mudar_status_aluno(0,109989)' checked>

  <label class='custom-control-label' for='customSwitch3109989' id='customSwitch3109989' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha111328'>
              <input type='hidden' id='matricula111328' name='matricula111328' value='169701'>
                <td>14 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='111328'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>111328 -
            <b class='text-success'> João Pedro Valentino de Souza </b> <BR>
            Data nascimento: 17/03/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>João.Pedro75  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno111328' value='João Pedro Valentino de Souza'><input type='hidden' name='matricula_aluno111328' value='169701'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3111328' onclick='mudar_status_aluno(0,111328)' checked>

  <label class='custom-control-label' for='customSwitch3111328' id='customSwitch3111328' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha109931'>
              <input type='hidden' id='matricula109931' name='matricula109931' value='163526'>
                <td>15 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='109931'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>109931 -
            <b class='text-success'> Kaio Levi Carvallho Nunes </b> <BR>
            Data nascimento: 07/03/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Kaio.Levi64  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno109931' value='Kaio Levi Carvallho Nunes'><input type='hidden' name='matricula_aluno109931' value='163526'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3109931' onclick='mudar_status_aluno(0,109931)' checked>

  <label class='custom-control-label' for='customSwitch3109931' id='customSwitch3109931' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha110037'>
              <input type='hidden' id='matricula110037' name='matricula110037' value='164131'>
                <td>16 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='110037'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>110037 -
            <b class='text-success'> Levy Vaz Barbosa </b> <BR>
            Data nascimento: 25/03/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Levy.Vaz49  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno110037' value='Levy Vaz Barbosa'><input type='hidden' name='matricula_aluno110037' value='164131'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3110037' onclick='mudar_status_aluno(0,110037)' checked>

  <label class='custom-control-label' for='customSwitch3110037' id='customSwitch3110037' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha109862'>
              <input type='hidden' id='matricula109862' name='matricula109862' value='162649'>
                <td>17 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='109862'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>109862 -
            <b class='text-success'> Maria Luiza Melgaço dos Santos </b> <BR>
            Data nascimento: 13/12/2019 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Maria.Luiza2  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno109862' value='Maria Luiza Melgaço dos Santos'><input type='hidden' name='matricula_aluno109862' value='162649'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3109862' onclick='mudar_status_aluno(0,109862)' checked>

  <label class='custom-control-label' for='customSwitch3109862' id='customSwitch3109862' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha109913'>
              <input type='hidden' id='matricula109913' name='matricula109913' value='163408'>
                <td>18 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='109913'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>109913 -
            <b class='text-success'> Paulo Vitor Almeida Santos </b> <BR>
            Data nascimento: 05/03/2020 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Paulo.Vitor3  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno109913' value='Paulo Vitor Almeida Santos'><input type='hidden' name='matricula_aluno109913' value='163408'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3109913' onclick='mudar_status_aluno(0,109913)' checked>

  <label class='custom-control-label' for='customSwitch3109913' id='customSwitch3109913' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha110022'>
              <input type='hidden' id='matricula110022' name='matricula110022' value='164085'>
                <td>19 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='110022'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>110022 -
            <b class='text-success'> Raquel Lopes da Silva </b> <BR>
            Data nascimento: 10/10/2019 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Raquel.Lopes91  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno110022' value='Raquel Lopes da Silva'><input type='hidden' name='matricula_aluno110022' value='164085'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3110022' onclick='mudar_status_aluno(0,110022)' checked>

  <label class='custom-control-label' for='customSwitch3110022' id='customSwitch3110022' ></label>
  </div>
  </div></td> </td>

</tr>
<tr id='linha112891'>
              <input type='hidden' id='matricula112891' name='matricula112891' value='176003'>
                <td>20 - <p><input type='checkbox' class='checkbox' name='idaluno[]' value='112891'>   </p></td> <td><B>MATRICULADO</B></td>
            <td>112891 -
            <b class='text-success'> Uine Santos Ribeiro </b> <BR>
            Data nascimento: 11/08/2019 <BR>

            <b class='text-primary'> MATERNAL I A</b><BR>
            <b class='text-danger'>Uine.Santos0  </b><BR>
            <b class='text-danger'>Senha: lem12345  </b><BR>


            </td><td><input type='hidden' name='nome_aluno112891' value='Uine Santos Ribeiro'><input type='hidden' name='matricula_aluno112891' value='176003'><input type='hidden' name='idturma' value='6288'><input type='hidden' name='url_get' value='idturma=6288&nome_turma=MATERNAL%20I%20A&idescola=227&idserie=1'></td><td><div class='form-group'>
  <div class='custom-control custom-switch custom-switch-on-success custom-switch-off-danger'>
  <input type='checkbox' class='custom-control-input' id='customSwitch3112891' onclick='mudar_status_aluno(0,112891)' checked>

  <label class='custom-control-label' for='customSwitch3112891' id='customSwitch3112891' ></label>
  </div>
  </div></td> </td>

</tr>

        </tbody>

      </table>

    </div>

    

  </div>



  <!-- Main row -->

  <!-- /.row -->

</div>





</div>

</section>

</div>

<aside class='control-sidebar control-sidebar-dark'>

  <!-- Control sidebar content goes here -->

</aside>

<!-- /.control-sidebar -->

<script type='text/javascript'>

  function seleciona_todos_alunos(){

    var checkBoxes = document.querySelectorAll('.checkbox');
    var selecionados = 0;
    checkBoxes.forEach(function(el) {
     if(el.checked) {
         //selecionados++;
         console.log(el.value);
         el.checked=false;
       }else{

        el.checked=true;
      }

    });
 // console.log(selecionados);

}

function mascara(o,f){

  v_obj=o

  v_fun=f

  setTimeout('execmascara()',1)

}

function execmascara(){

  v_obj.value=v_fun(v_obj.value)

}

function mtel(v){

    v=v.replace(/\D/g,'');             //Remove tudo o que não é dígito

    v=v.replace(/^(\d{2})(\d)/g,'($1) $2'); //Coloca parênteses em volta dos dois primeiros dígitos

    v=v.replace(/(\d)(\d{4})$/,'$1-$2');    //Coloca hífen entre o quarto e o quinto dígitos

    return v;

  }



</script>

<div class='modal fade bd-example-modal-lg' id='modal_transferencia'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header alert alert-danger'>
        <h4 class='modal-title'>PROCEDIMENTO TRANSFERÊNCIA</h4>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>    

        <div class='row'>
            <input type='hidden' name='escola_id_origem' id='escola_id_origem' value='<?php echo 227; ?>'>  
            <input type='hidden' name='turma_id_origem' id='turma_id_origem' value='<?php echo 6288; ?>'>
                 <div class='col-sm-2'>
                  <div class='form-group'>
                    <label for='exampleInputEmail1'>Ano letivo</label>
                    <select  id='ano_letivo' class='form-control' onchange='mudar_ano_letivo(this.value);'><option value='2022' selected>2022</option>

                  </select>
                </div>
              </div> 


          <div class='col-sm-6'>
            <div class='form-group'>
              <label for='exampleInputEmail1'>Escola pretendida</label>
              <select class='form-control'  name='escola_id' id='escola'  onchange='listar_vagas_turma_transferencia_aluno()'>
                <option></option>
                <!-- ESCOLA FORA DO MUNICÍPIO -->
                <option value='0' style='color: black; background-color:#D2691E;'>ESCOLA FORA DA REDE </option><option value='161' style='color: white; background-color:#A9A9A9;'>CEMEI - PATRICIA OSHIRO BRENTAN - INEP 29460875 </option><option value='229' style='color: white; background-color:#A9A9A9;'>CEMEI VITORIA FONTANA - INEP 29460972 </option><option value='35' style='color: white; background-color:#A9A9A9;'>CENTRO MUNICIPAL DE EDUCACAO INFANTIL MIMOSO - INEP 29442680  </option><option value='23' style='color: white; background-color:#A9A9A9;'>COLEGIO MUNICIPAL ANGELO BOSA - INEP 29451868 </option><option value='228' style='color: white; background-color:#A9A9A9;'>CRECHE MUNICIPAL MENINO JESUS - INEP 29420695 </option><option value='38' style='color: white; background-color:#A9A9A9;'>CRECHE MUNICIPAL PEQUENO PRINCIPE - INEP 29433258 </option><option value='24' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL ALDORI LUIZ TOLAZZI - INEP 29655625 </option><option value='26' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL AMABILIO VIEIRA DOS SANTOS - INEP 29433339 </option><option value='13' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL AMELIO GATTO - INEP 29404517 </option><option value='15' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL CEZER PELISSARI - 29433290 </option><option value='268' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL CORNELIO DIAS DOS SANTOS </option><option value='45' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL DOM RICARDO JOSEF WEBERBERGER - 29455847 </option><option value='25' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL EDALEIO BARBOSA DE SOUSA - 29395836 </option><option value='27' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL HERMINIO CARLOS BRANDAO - 29654629 </option><option value='22' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL IRANI LEITE MATUTINO SANTOS - INEP 29451841 </option><option value='14' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL IVO HERING - INEP 29420130 </option><option value='30' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL JARDIM PARAISO - 29399840 </option><option value='11' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL JOSE CARDOSO DE LIMA - INEP 29001269 </option><option value='32' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL LUZIA DA ROSA FONTANA INEP 29395844 </option><option value='44' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL MARLEI TEREZINHA PRETTO - INEP 29399858 </option><option value='16' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL MOZART FELICIANO - INEP 29675626 </option><option value='10' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL ONERO COSTA DA ROSA - INEP 29001358  </option><option value='12' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL OTTOMAR SCHWENGBER - INEP 29002028 </option><option value='21' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL VANIA APARECIDA SANTOS RIBEIRO -INEP 29433231 </option><option value='243' style='color: white; background-color:#A9A9A9;'>ESCOLA MUNICIPAL VEREADOR LUCIR FICANHA - INEP 29473136 </option><option value='267' style='color: white; background-color:#A9A9A9;'>ESCOLA TESTE </option><option value='254' style='color: white; background-color:#A9A9A9;'>SEED - ESCOLA MUNICIPAL FABIO JOHNER - INEP 29001781 </option><option value='19' style='color: white; background-color:#A9A9A9;'>SEED - ESCOLA MUNICIPAL HENRIQUE DE FREITAS MOREIRA - INEP 29366496 </option><option value='31' style='color: white; background-color:#A9A9A9;'>SEED - ESCOLA MUNICIPAL SAO FRANCISCO - INEP 29002214 </option><option value='20' style='color: white; background-color:#A9A9A9;'>SEED - ESCOLA MUNICIPAL SAO PAULO - INEP 29001552 </option><option value='242' style='color: white; background-color:#A9A9A9;'>SEED- ESCOLA MUNICIPAL VEREADOR MARDONIO DA ROCHA CARVALHO - INEP 29473144 </option><option value='231' style='color: white; background-color:#A9A9A9;'>SEED-CEMEI MAURILIO COMPARIN - INEP 29445604 </option><option value='238' style='color: white; background-color:#A9A9A9;'>SEED-CEMEI ZILDA ARNS NEUMANN - 29399831 </option><option value='241' style='color: white; background-color:#A9A9A9;'>SEED-CENTRO INFANTIL DE APRENDIZADO SEMENTES DO FUTURO - INEP 29471168 </option><option value='39' style='color: white; background-color:#A9A9A9;'>SEED-CRECHE ESPERANCA MARIA AMALIA UCHOUA SANTA CRUZ - INEP 29395852 </option><option value='266' style='color: white; background-color:#A9A9A9;'>SEED-ESC MUNICIPAL TIAGO ALFREDO LIESENFELD - INEP 29477557  </option><option value='232' style='color: white; background-color:#A9A9A9;'>SEED-ESCOLA MUN PEDRO PAULO CORTE FILHO - 29471400 </option><option value='162' style='color: white; background-color:#A9A9A9;'>SEED-ESCOLA MUNICIPAL CECILIA MEIRELES - 29468841 </option><option value='264' style='color: white; background-color:#A9A9A9;'>SEED-ESCOLA MUNICIPAL IVANILDE DOS SANTOS CEDRO - INEP 29404550 </option>
            </select>
          </div>
        </div>
    <div class='col-sm-3'>
      <div class='form-group'>
        <label for='exampleInputEmail1'>Série</label>
        <select class='form-control'  name='serie_id' id='serie' ><option value='1'>Creche </option>
        </select>
      </div>
    </div>       
    <div class='col-sm-8'>
      <div class='form-group'>
        <label for='exampleInputEmail1'>Observação <b class='text-danger'> ( Obrigatório )</b></label>
        <textarea class='form-control'  name='observacao' rows='5'><?php echo 'Solicito a aceitação da transferência do aluno que está sendo transferido da ESCOLA: CEMEI - CLEUSA SANTOS SILVA E SILVA - INEP 29464749 e TURMA: MATERNAL I A'; ?></textarea>
      </div>
    </div>

  </div>
  <div class='row'>
    <div class='col-sm-12' id='resultado'>
    </div>
  </div>




  <div class='modal-footer justify-content-between'>
   <button type='button' class='btn btn-default' data-dismiss='modal'>FECHAR</button>
   <!-- onclick='carregando_login()' -->
   <div id='botao_continuar'>
     <button type='submit' class='btn btn-primary' >TRANSFERIR SELECIONADOS</button>
   </div>
 </div>

 <!-- /corpo -->
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>



<div class='modal fade bd-example-modal-lg' id='modal_rematricula'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header alert alert-success'>
        <h4 class='modal-title'>PROCEDIMENTO REMATRÍCULA</h4>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>    

        <div class='row'>

         <div class='col-sm-2'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Ano letivo</label>
            <select  id='ano_letivo' class='form-control' onchange='mudar_ano_letivo(this.value);'><option value='2022' selected>2022</option>
          </select>
        </div>
      </div>  
      <div class='col-sm-2'>
        <div class='form-group'>
          <input type='hidden' name='rematricula_escola_id' id='rematricula_escola_id' value='<?php echo 227; ?>'>
          <label for='exampleInputEmail1'>Série atual</label>
          <select class='form-control'  name='rematricula_serie_id' id='serie' ><option value='1'>Creche </option>
          </select>
        </div>
      </div>    

      <div class='col-sm-3'>
        <div class='form-group'>

          <label for='exampleInputEmail1'>Turno</label>
          <select class='form-control' onchange='lista_turma_escola_por_serie(lista_de_turmas_rematricula);' name='rematricula_turno' id='rematricula_turno' >
            <option></option>
            <option value='MATUTINO'>MATUTINO</option>
            <option value='VESPERTINO'>VESPERTINO</option>
            <option value='NOTURNO'>NOTURNO</option>
            <option value='INTEGRAL'>INTEGRAL</option>
          </select>
        </div>
      </div>              

      <div class='col-sm-2'>
        <div class='form-group'>
          <label for='exampleInputEmail1' class='text-danger'>Nova Série</label>
          <select class='form-control'  name='rematricula_nova_serie' id='rematricula_nova_serie'  onchange='lista_turma_escola_por_serie(lista_de_turmas_rematricula);' >
            <option></option><option value='1'>Creche </option><option value='2'>Pré Escola </option>
          </select>
        </div>
      </div>



      <div class='col-sm-3'>
        <div class='form-group' id=''>
         <label for='exampleInputEmail1' class='text-danger'>Turma pretendida</label>
         <select class='form-control' name='rematricula_turma' id='lista_de_turmas_rematricula' onchange='quantidade_vaga_turma(lista_de_turmas_rematricula);'>
         </select>

       </div>
     </div>       

     <div class='col-sm-6'>
      <div class='form-group' >
        <label for='exampleInputEmail1' class='text-danger'>Vagas restantes na turma</label>

        <input type='text'  name='quantidade_vagas_restante' id='quantidade_vagas_restante' value='0' readonly class='alert alert-secondary'>

      </div>
    </div>
  </div>



  <div class='modal-footer justify-content-between'>
   <button type='button' class='btn btn-default' data-dismiss='modal'>FECHAR</button>
   <!-- onclick='carregando_login()' -->
   <div id='botao_continuar' >
     <button type='submit' class='btn btn-primary' >REMATRICULAR SELECIONADOS</button>
   </div>
 </div>

 <!-- /corpo -->
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>  


<div class='modal fade bd-example-modal-lg' id='modal_troca_de_turma'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title'>PROCEDIMENTO TROCA DE TURMA</h4>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>    

        <div class='row'>
          <div class='col-sm-3'>
            <div class='form-group'>
              <label for='exampleInputEmail1'>Ano letivo</label>
              <select  id='ano_letivo' class='form-control' onchange='mudar_ano_letivo(this.value);'><option value='2022' selected>2022</option>

            </select>
          </div>
        </div>   

        <div class='col-sm-2'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Série atual</label>
            <select class='form-control'  name='troca_turma_serie_id_antiga' id='' ><option value='1'>Creche </option>
            </select>
          </div>
        </div>    




        <div class='col-sm-3'>
         <div class='form-group'>

           <label for='exampleInputEmail1' class='text-danger'>Novo Turno</label>
           <select class='form-control' onchange='troca_de_turma_escola_por_serie(troca_turma);' name='troca_turma_turno' id='troca_turma_turno'  >
             <option></option>
             <option value='MATUTINO'>MATUTINO</option>
             <option value='VESPERTINO'>VESPERTINO</option>
             <option value='NOTURNO'>NOTURNO</option>
             <option value='INTEGRAL'>INTEGRAL</option>
           </select>
         </div>
       </div> 


       <div class='col-sm-2'>
         <div class='form-group'>
           <label for='exampleInputEmail1' class='text-danger'>Nova Série</label>
           <select class='form-control'  name='troca_turma_serie_id' id='troca_turma_serie_id'  onchange='troca_de_turma_escola_por_serie();' >
             <option></option><option value='1'>Creche </option><option value='2'>Pré Escola </option>
           </select>
         </div>
       </div>
       <div class='col-sm-3'>
         <div class='form-group' >
            <label class='text-danger'>Nova turma</label>
            <select id='lista_de_turmas_troca_turma' name='lista_de_turmas_troca_turma' class='form-control' onchange='quantidade_vaga_turma(troca_turma);'>

            </select>
         </div>
       </div> 
        <div class='col-sm-4'>
         <div class='form-group' >
           <label for='exampleInputEmail1' class='text-danger'>Vagas restantes na turma</label>

           <input type='text'  name='quantidade_vagas_restante_troca_turma' id='quantidade_vagas_restante_troca_turma' value='0' readonly class='alert alert-secondary'>

         </div>
       </div>

     </div>



     <div class='modal-footer justify-content-between'>
       <button type='button' class='btn btn-default' data-dismiss='modal'>FECHAR</button>
       <!-- onclick='carregando_login()' -->
       <div id='botao_continuar' >
         <button type='submit' class='btn btn-primary' >TOCAR DE TURMA ALUNOS SELECIONADOS</button>
       </div>
     </div>

     <!-- /corpo -->
   </div>
 </div>
 <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

</form>

<script>
  function mudar_action_form(procedimento){
    document.procedimentos.action = '../Controller/'+procedimento+'';
  }  


</script>

