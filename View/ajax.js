function CriaRequest() {

     try{

         request = new XMLHttpRequest();        

     }catch (IEAtual){

          
 
         try{

             request = new ActiveXObject("Msxml2.XMLHTTP");       

         }catch(IEAntigo){

          

             try{

                 request = new ActiveXObject("Microsoft.XMLHTTP");          

             }catch(falha){

                 request = false;

             }

         }

     }
 
      

     if (!request) 

         alert("Seu Navegador não suporta Ajax!");

     else

         return request;

 }


 function receber_resenha() {
    var result = document.getElementById("resenha");

    var trabalho_entregue_id = document.getElementById("trabalho_entregue_id").value;
    var aluno_id = document.getElementById("aluno_id").value;
    var url ="trabalho_entregue_id="+trabalho_entregue_id+"&aluno_id="+aluno_id;

    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Resenha_trabalho_entregue_receber.php?"+url, true);


    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                  result.innerHTML = xmlreq.responseText;
                
             }else{
                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
 }


 function enviar_resenha() {
    var resposta = document.getElementById("resposta").value;
    var trabalho_entregue_id = document.getElementById("trabalho_entregue_id").value;
    var funcionario_id = document.getElementById("funcionario_id").value;
    var aluno_id = document.getElementById("aluno_id").value;
    var url ="resposta="+resposta+"&trabalho_entregue_id="+trabalho_entregue_id+"&funcionario_id="+funcionario_id+"&aluno_id="+aluno_id;
    
    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Resenha_trabalho_entregue_enviar.php?"+url, true);


    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 // result.innerHTML = xmlreq.responseText;
                 document.getElementById("resposta").value="";
                 receber_resenha();
             }else{
                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
 }




function atalho() {

    var select = document.getElementById('atalho');
    var option = select.options[select.selectedIndex];
    var texto = option.text; //descricao data +  aula ...


      Swal.fire({
        title: ''+texto+'?',
        showDenyButton: true,
        confirmButtonText: `Sim`,
        denyButtonText: `Não`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
         aguarde();
         var url = document.getElementById("atalho").value;  
         window.location.href = url;
        } else if (result.isDenied) {
        }
      })

   
}

function colar_conteudo_ja_cadastrados(conteudo) {

  Swal.fire({
    title: 'Deseja COLAR  o conteúdo selecionado nessa FREQUÊNCIA a ser cadastrada/editada?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
     
        var descricao_conteudo = document.getElementById("descricao_conteudo");
         descricao_conteudo.value = descricao_conteudo.value +" "+conteudo;  
        Swal.fire('O CONTÉUDO SELECIONADO FOI COLADO NO CAMPO DO CONTEÚDO DESSA FREQUÊNCIA A SER CADASTRADA/EDITADA.', '', 'info')
    } else if (result.isDenied) {
    }
  })
}

function excluir_mural(idmural) {
    var idmural = document.getElementById("idmural"+idmural).value;  
    var url_get = document.getElementById("url_get").value; 
    var pagina = document.getElementById("pagina").value; 

    var url=""+url_get+"&idmural="+idmural+"&pagina="+pagina;
  Swal.fire({
    title: 'Deseja continuar com a exclusão?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      window.location.href = "../Controller/Excluir_mural.php?"+url+"";
    } else if (result.isDenied) {
     // Swal.fire('Ação cancelada', '', 'info')
    }
  })
}

function excluir_frequencia(id) {
    var conteudo_aula_id = document.getElementById("conteudo_aula_id"+id).value;  
    var url_get = document.getElementById("url_get").value; 

    var url="conteudo_aula_id="+conteudo_aula_id+"&"+url_get;
  Swal.fire({
    title: 'Deseja continuar com a exclusão?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      window.location.href = "../Controller/Excluir_frequencia.php?"+url+"";
    } else if (result.isDenied) {
     // Swal.fire('Ação cancelada', '', 'info')
    }
  })
}


function excluir_avaliacao(id) {
    var data_nota = document.getElementById("data_nota"+id).value; 
    var turma_id = document.getElementById("turma_id"+id).value; 
    var disciplina_id = document.getElementById("disciplina_id"+id).value; 
    var escola_id = document.getElementById("escola_id"+id).value; 
    var periodo_id = document.getElementById("periodo_id"+id).value; 
    var avaliacao = document.getElementById("avaliacao"+id).value; 
    var url_get = document.getElementById("url_get").value; 

    var url="data_nota="+data_nota+"&turma_id="+turma_id
    +"&disciplina_id="+disciplina_id+"&escola_id="+escola_id+"&periodo_id="+periodo_id+"&avaliacao="+avaliacao+"&"+url_get;
  Swal.fire({
    title: 'Deseja continuar com a exclusão?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      window.location.href = "../Controller/Excluir_avaliacao.php?"+url+"";
    } else if (result.isDenied) {
     // Swal.fire('Ação cancelada', '', 'info')
    }
  })
}










// function marcarDesmarcarChecbox(){
//     $(document).ready(function() {
//     $('#marcartodos').click(function(event) {  //on click 
//         if(this.checked) { // check select status
//             $('.checkbox1').each(function() { //loop through each checkbox
//                 this.checked = true;  //select all checkboxes with class "checkbox1"               
//             });
//         }else{
//             $('.checkbox1').each(function() { //loop through each checkbox
//                 this.checked = false; //deselect all checkboxes with class "checkbox1"                       
//             });         
//         }
//     });
    
// }); 
// }





function chamando_notificacoes(){
  var xmlreq = CriaRequest();   
   xmlreq.open("GET", "notificacoes.php", true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {                
              var result = document.getElementById("log_conexao");        
              result.innerHTML += "chamando_notificacoes<br>";
            }else{
                console.log('erro chamando notificacões')
                   
                
                
            }
        }
    };
    xmlreq.send(null);
}


function notificacao_mural_whatsapp(cont){
  var turma_id=document.getElementById("turma_id"+cont).value;
  var serie_id=document.getElementById("serie_id"+cont).value;
  var escola_id=document.getElementById("escola_id"+cont).value;

  var xmlreq = CriaRequest();   
   xmlreq.open("GET", "../Controller/Notificacao_mural_whatsapp.php?turma_id="+turma_id+"&escola_id="+escola_id+"&serie_id="+serie_id, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {                
                   
                
            }else{
                  var result = document.getElementById("log_conexao");        
                  result.innerHTML += "erro mural<br>";
                
            }
        }
    };
    xmlreq.send(null);
}

function notificacao_trabalho_whatsapp(cont){
  var turma_id=document.getElementById("turma_id"+cont).value;
  var serie_id=document.getElementById("serie_id"+cont).value;
  var escola_id=document.getElementById("escola_id"+cont).value;

  var xmlreq = CriaRequest();   
   xmlreq.open("GET", "../Controller/Notificacao_trabalho_whatsapp.php?turma_id="+turma_id+"&escola_id="+escola_id+"&serie_id="+serie_id, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {                
                   
                
            }else{
                 var result = document.getElementById("log_conexao");        
                  result.innerHTML += "erro trabalho<br>";
                
                
            }
        }
    };
    xmlreq.send(null);
}

function notificacao_video_whatsapp(cont){
  var turma_id=document.getElementById("turma_id"+cont).value;
  var serie_id=document.getElementById("serie_id"+cont).value;
  var escola_id=document.getElementById("escola_id"+cont).value;

  var xmlreq = CriaRequest();   
   xmlreq.open("GET", "../Controller/Notificacao_video_whatsapp.php?turma_id="+turma_id+"&escola_id="+escola_id+"&serie_id="+serie_id, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {                
                   
                
            }else{
                   var result = document.getElementById("log_conexao");        
                   result.innerHTML += "erro video<br>";
                
                
                
            }
        }
    };
    xmlreq.send(null);
}

// ******************************************************************************
function data_frequencia_ja_cadastrada(data){


  var select = document.getElementById('data_ja_lancada');
  var option = select.options[select.selectedIndex];

  var valor= option.value; //data
  var texto = option.text; //descricao data +  aula ...

  var data_frequencia = document.getElementById("data_frequencia").value=data;
  var array_d=texto.split(' - ');
  var texto_aux=array_d[1];

  var a =document.getElementById("aula");

   a.innerHTML= "<option value='"+texto_aux+"'>"+
  texto_aux+"</option>"+ a.innerHTML+"";


  lista_frequencia_aluno();
}

function limpa_data_frequencia_ja_cadastrada(){
  var data_frequencia = document.getElementById("data_ja_lancada").value='';
}


function lista_avaliacao_ja_cadastrada_por_periodo(periodo){
  document.getElementById("data_frequencia").value='';

  var botao_continuar = document.getElementById("botao_continuar");
  var result = document.getElementById("listagem_frequencia");
  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

  var idescola = document.getElementById("idescola").value;
  var idturma = document.getElementById("idturma").value;
  var iddisciplina = document.getElementById("iddisciplina").value;

  var url="periodo="+periodo+"&idescola="+idescola+"&idturma="+idturma+"&iddisciplina="+iddisciplina;
   xmlreq.open("GET", "../Controller/Lista_avaliacao_aluno_por_periodo.php?"+url, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                result.innerHTML =  xmlreq.responseText;
                botao_continuar.innerHTML=""+
                "<div class='col-sm-1'></div>"+
                "<div class='col-sm-10'>"+
                  "<button type='submit' class='btn btn-block btn-primary'>Concluir</button>"+
                "</div>";
                
            }else{
                   result.innerHTML = xmlreq.responseText;
                
                
            }
        }
    };
    xmlreq.send(null);
}





// function limpa_periodo_avaliacao_ja_cadastrada(){
//    document.getElementById("periodo").value='';
// }
// *********************************************************


function lista_ocorrencia_aluno(){
  var botao_continuar = document.getElementById("botao_continuar");
  var result = document.getElementById("listagem_ocorrencia");
  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

  var data_ocorrencia = document.getElementById("data_ocorrencia").value;
  var data_ocorrencia_lancada = document.getElementById("data_ocorrencia_lancada").value;
  document.getElementById("data_ocorrencia_lancada").value="";

  if (data_ocorrencia_lancada !="") {
     document.getElementById("data_ocorrencia").value=data_ocorrencia_lancada;
     data_ocorrencia=data_ocorrencia_lancada;//EDITADO
  }

  var idescola = document.getElementById("idescola").value;
  var idturma = document.getElementById("idturma").value;
  var iddisciplina = document.getElementById("iddisciplina").value;

  var url="data_ocorrencia_lancada="+data_ocorrencia_lancada+"&data_ocorrencia="+data_ocorrencia+"&idescola="+idescola+"&idturma="+idturma+"&iddisciplina="+iddisciplina;
   xmlreq.open("GET", "../Controller/Lista_ocorrencia_aluno.php?"+url, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                result.innerHTML =  xmlreq.responseText;
                botao_continuar.innerHTML=""+
                "<div class='col-sm-1'></div>"+
                "<div class='col-sm-10'>"+
                  "<button type='submit' class='btn btn-block btn-primary'>Concluir</button>"+
                "</div>";
                
            }else{
                   result.innerHTML = xmlreq.responseText;
                
                
            }
        }
    };
    xmlreq.send(null);
}


function lista_frequencia_aluno(){
  var result = document.getElementById("listagem_frequencia");

  var botao_continuar = document.getElementById("botao_continuar");
  var xmlreq = CriaRequest();   

  var idserie = document.getElementById("idserie").value;
  var idescola = document.getElementById("idescola").value;
  var idturma = document.getElementById("idturma").value;
  var iddisciplina = document.getElementById("iddisciplina").value;

   var data_frequencia = document.getElementById("data_frequencia").value;
   var aula = document.getElementById("aula").value;

    if (aula !="" && data_frequencia !="" ) {
        result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

          
      var url="idserie="+idserie+"&aula="+aula+"&data_frequencia="+data_frequencia+"&idescola="+idescola+"&idturma="+idturma+"&iddisciplina="+iddisciplina;
       xmlreq.open("GET", "../Controller/Lista_frequencia_aluno.php?"+url, true);
        xmlreq.onreadystatechange = function(){      
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {
                    result.innerHTML =  xmlreq.responseText;
                    botao_continuar.innerHTML=""+
                    "<div class='col-sm-1'></div>"+
                    "<div class='col-sm-10'>"+
                      "<button type='submit' class='btn btn-block btn-primary'>Concluir</button>"+
                    "</div>";
                    
                }else{
                       result.innerHTML = xmlreq.responseText;
                    
                    
                }
            }
        };
        xmlreq.send(null);
    }else{

        if (aula=="") {
            Swal.fire({
                      icon: 'info',
                      title: 'Atenção...',
                      text: 'Selecione a aula!',
                      showConfirmButton: false,
                      timer: 1500
                      
                    });
        }else if (data_frequencia=="") {
            Swal.fire({
                      icon: 'info',
                      title: 'Atenção...',
                      text: 'Selecione a data!',
                      showConfirmButton: false,
                      timer: 1500
                      
                    });
        }

    }
}




function editar_avaliacao_aluno_por_data(conta){

  var botao_continuar = document.getElementById("botao_continuar");
  var result = document.getElementById("listagem_avaliacao");
  var xmlreq = CriaRequest();   

  var idserie = document.getElementById("idserie").value;
  var idescola = document.getElementById("idescola").value;
  var idturma = document.getElementById("idturma").value;
  var iddisciplina = document.getElementById("iddisciplina").value;

  var data_avaliacao = document.getElementById("data_nota"+conta).value;
  var idperiodo = document.getElementById("periodo_id"+conta).value;
  var avaliacao = document.getElementById("avaliacao"+conta).value;



  // var select = document.getElementById('periodo');
  // var option = select.options[select.selectedIndex];
  // var valor= option.value; //data
  // var texto = option.text; //descricao data +  aula ...

  // var array_d=texto.split(' - ');
  // var texto_aux=array_d[1];

  // var a =document.getElementById("aula");

  var periodo = document.getElementById("periodo");
  var select_avaliacao = document.getElementById("avaliacao");

  
  var data_avaliacao = document.getElementById("data_avaliacao").value=data_avaliacao;
   periodo.innerHTML= "<option value='"+idperiodo+"'>"+idperiodo+"</option>"+periodo.innerHTML;
   select_avaliacao.innerHTML= "<option value='"+avaliacao+"'>"+avaliacao+"</option>"+select_avaliacao.innerHTML;


   if (data_avaliacao !="" && idperiodo !="" && avaliacao !="") {
        result.innerHTML="<center><img src='imagens/carregando.gif'></center>";
          var url="idserie="+idserie+"&avaliacao="+avaliacao+"&idperiodo="+idperiodo+"&data_avaliacao="+data_avaliacao+"&idescola="+idescola+"&idturma="+idturma+"&iddisciplina="+iddisciplina;
           xmlreq.open("GET", "../Controller/Lista_avaliacao_aluno_por_data.php?"+url, true);
            xmlreq.onreadystatechange = function(){      
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                        result.innerHTML =  xmlreq.responseText;
                        botao_continuar.innerHTML=""+
                        "<div class='col-sm-1'></div>"+
                        "<div class='col-sm-10'>"+
                          "<button type='submit' class='btn btn-block btn-primary'>Concluir</button>"+
                        "</div>";
                        
                    }else{
                           result.innerHTML = xmlreq.responseText;
                        
                        
                    }
                }
            };
        xmlreq.send(null);
  

    }else{
        
       
    }
}




function lista_avaliacao_aluno_por_data(){

  var botao_continuar = document.getElementById("botao_continuar");
  var result = document.getElementById("listagem_avaliacao");
  var xmlreq = CriaRequest();   

  var idserie = document.getElementById("idserie").value;
  var idescola = document.getElementById("idescola").value;
  var idturma = document.getElementById("idturma").value;
  var iddisciplina = document.getElementById("iddisciplina").value;

  var data_avaliacao = document.getElementById("data_avaliacao").value;
  var idperiodo = document.getElementById("periodo").value;
  var avaliacao = document.getElementById("avaliacao").value;

   if (data_avaliacao !="" && idperiodo !="" && avaliacao !="") {
        result.innerHTML="<center><img src='imagens/carregando.gif'></center>";
          var url="idserie="+idserie+"&avaliacao="+avaliacao+"&idperiodo="+idperiodo+"&data_avaliacao="+data_avaliacao+"&idescola="+idescola+"&idturma="+idturma+"&iddisciplina="+iddisciplina;
           xmlreq.open("GET", "../Controller/Lista_avaliacao_aluno_por_data.php?"+url, true);
            xmlreq.onreadystatechange = function(){      
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                        result.innerHTML =  xmlreq.responseText;
                        botao_continuar.innerHTML=""+
                        "<div class='col-sm-1'></div>"+
                        "<div class='col-sm-10'>"+
                          "<button type='submit' class='btn btn-block btn-primary'>Concluir</button>"+
                        "</div>";
                        
                    }else{
                           result.innerHTML = xmlreq.responseText;
                        
                        
                    }
                }
            };
        xmlreq.send(null);
  

    }else{
        
        if (data_avaliacao =="") {
            Swal.fire({
                      icon: 'info',
                      title: 'Atenção...',
                      text: 'Selecione a data da avaliação!',
                      showConfirmButton: false,
                      timer: 1500
                      
                    });
        }else if (idperiodo =="") {
            Swal.fire({
                      icon: 'info',
                      title: 'Atenção...',
                      text: 'Selecione o período!',
                      showConfirmButton: false,
                      timer: 1500
                      
                    });
        }else if (avaliacao =="") {
            Swal.fire({
                      icon: 'info',
                      title: 'Atenção...',
                      text: 'Selecione a avalicão desejada (av1,av2 ou av3)!',
                      showConfirmButton: false,
                      timer: 1500
                      
                    });
        }




    }
}


function lista_de_turmas(id){
  var result = document.getElementById("lista_de_turmas");
  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/Lista_de_turmas_por_serie.php?serie_id="+id, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {

                   result.innerHTML =  xmlreq.responseText;
                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}

function listar_opcao_associacao_coordenador(id){
  var result = document.getElementById("tabela_pesquisa_coordenador");
  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/View_associar_coordenador_a_escola.php?idcoordenador="+id, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {                
                   result.innerHTML =  xmlreq.responseText;
                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}

function listar_opcao_associacao_professor(id){
  var result = document.getElementById("tabela_pesquisa_professor");
  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/View_associar_professor_turma_disciplina.php?idprofessor="+id, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {                
                   result.innerHTML =  xmlreq.responseText;
                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}

function pesquisar_coordenador_associacao(){
  var pesquisa = document.getElementById("pesquisa_coordenador").value;
  var result = document.getElementById("tabela_pesquisa_coordenador");
  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/Pesquisar_coordenador_associacao.php?pesquisa="+pesquisa, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {                
                   result.innerHTML =  xmlreq.responseText;
                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}

function pesquisar_professor_associacao(){
  var result = document.getElementById("tabela_pesquisa_professor");
  var pesquisa = document.getElementById("pesquisa").value;
  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/Pesquisar_professor_associacao.php?pesquisa="+pesquisa, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {                
                   result.innerHTML =  xmlreq.responseText;
                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}


function alterar_status_questionario(id,status) {
  Swal.fire({
    title: 'Deseja continuar com essa ação?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      window.location.href = "../Controller/Alterar_status_questionario.php?id="+id+"&status="+status+"";
    } else if (result.isDenied) {
      Swal.fire('Ação cancelada', '', 'info')
    }
  })
}


function excluir_professor(id) {
  var nome_professor = document.getElementById("nome_professor"+id).value;

  Swal.fire({
    title: 'Tem certeza que deseja EXCLUIR o professor(a): '+nome_professor+'?',

    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      window.location.href = "../Controller/Excluir_professor.php?id="+id+"";
    } else if (result.isDenied) {
      //Swal.fire('Ação não concluída', '', 'info')
    }
  })
}

function excluir_coordenador(id) {
  Swal.fire({
    title: 'Deseja continuar com essa ação?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      window.location.href = "../Controller/Excluir_coordenador.php?id="+id+"";
    } else if (result.isDenied) {
      //Swal.fire('Ação não concluída', '', 'info')
    }
  })
}

function cancelar_associacao_coordenador(id) {
  Swal.fire({
    title: 'Deseja continuar com essa ação?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      window.location.href = "../Controller/Desassociar_coordenador.php?idrelacionamento_funcionario_escola="+id+"";
    } else if (result.isDenied) {
      //Swal.fire('Ação não concluída', '', 'info')
    }
  })
}



function cancelar_associacao_professor(id) {
  Swal.fire({
    title: 'Deseja continuar com essa ação?',
    showDenyButton: true,
  
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
           // window.location.href = "../Controller/Desassociar_professor.php?id="+id+"";

           var xmlreq = CriaRequest();   
           xmlreq.open("GET", "../Controller/Desassociar_professor.php?id="+id, true);
           xmlreq.onreadystatechange = function(){             
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                        document.getElementById("linha"+id).innerHTML=xmlreq.responseText;

                        alert('Ação concluída com sucesso!');                                             
                        
                    }else{
                        alert('Verifique sua conexão com a internet!');
                        
                    }
                }
            };
            xmlreq.send(null);

    } else if (result.isDenied) {
      //Swal.fire('Ação não concluída', '', 'info')
    }
  })
}


function excluir_link_video_chamada(id) {
  Swal.fire({
    title: 'Deseja continuar com essa ação?',
    showDenyButton: true,
  
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
           // window.location.href = "../Controller/Desassociar_professor.php?id="+id+"";

           var xmlreq = CriaRequest();   
           xmlreq.open("GET", "../Controller/Excluir_link_video_chamada.php?id="+id, true);
           xmlreq.onreadystatechange = function(){             
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                        document.getElementById("linha"+id).innerHTML=xmlreq.responseText;

                        alert('Ação concluída com sucesso!');                                             
                        
                    }else{
                        alert('Verifique sua conexão com a internet!');
                        
                    }
                }
            };
            xmlreq.send(null);

    } else if (result.isDenied) {
      //Swal.fire('Ação não concluída', '', 'info')
    }
  })
}



function excluir_trabalho(id) {
  Swal.fire({
    title: 'Deseja continuar com essa ação?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      window.location.href = "../Controller/Excluir_trabalho.php?id="+id+"";
    } else if (result.isDenied) {
     // Swal.fire('Não foi excluido', '', 'info')
    }
  })
}

function excluir_trabalho_aluno(id) {
  var url_get = document.getElementById("url_get").value;

  Swal.fire({
    title: 'Deseja continuar com essa ação?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {

      window.location.href = "../Controller/Excluir_trabalho_aluno.php?id="+id+"&"+url_get;
    } else if (result.isDenied) {
     // Swal.fire('Não foi excluido', '', 'info')
    }
  })
}

function excluir_material_apoio(id) {
  var url_get = document.getElementById("url_get").value;

  Swal.fire({
    title: 'Deseja continuar com essa ação?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {

      window.location.href = "../Controller/Excluir_material_apoio.php?id="+id+"&"+url_get;
    } else if (result.isDenied) {
     // Swal.fire('Não foi excluido', '', 'info')
    }
  })
}








 function resultado_questao() {

    var result = document.getElementById("resultado_questao");
    result.innerHTML="<img src='imagens/carregando.gif'>";

    var questionario = document.getElementById("questionario").value;
    var aluno = document.getElementById("aluno").value;
    
    var disciplina_id = document.getElementById("disciplina_id").value;
    var turma_id = document.getElementById("turma_id").value;


    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Resultado_questao.php?aluno="+aluno+"&questionario="+questionario+"&disciplina_id="+disciplina_id+"&turma_id="+turma_id, true);


    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 result.innerHTML =  xmlreq.responseText;
                 
                 
             }else{

                alert('Erro');
                 
             }
         }
     };
     xmlreq.send(null);
 }


   function resposta_discursiva(id) {

     var result = document.getElementById("rd"+id);
     var nao_salvo = document.getElementById("erro_rd"+id);
     
     result.innerHTML='Editando..';

     var idalternativa =id;
     var texto = document.getElementById(id).value;

    var turma_id= document.getElementById('idturma').value;
    
    var disciplina_id =  document.getElementById('iddisciplina').value;
     
     var questao_id =  document.getElementById('questao_id'+id).value;

     
      var xmlreq = CriaRequest();   

      xmlreq.open("GET", "../Controller/Responder_questionario_discursiva.php?texto="+texto+"&id="+idalternativa+"&disciplina_id="+disciplina_id+"&turma_id="+turma_id+"&questao_id="+questao_id, true);
      xmlreq.onreadystatechange = function(){
       
          if (xmlreq.readyState == 4) {
              if (xmlreq.status == 200) {
                  result.innerHTML = "Salvo";
                  nao_salvo.innerHTML = "";
                  // result.innerHTML = "" + xmlreq.statusText;
                 
                  
              }else{
                  nao_salvo.innerHTML = "Erro ao Salvar, verifique sua conexão com a internet!";
                  result.innerHTML = "";

                 //alert('Erro');
                  
              }
          }
      };
      xmlreq.send(null);
  }



   function resposta_multipla(id) {
     
     var idalternativa =id;
    var result = document.getElementById("rd"+id);
     

    var turma_id= document.getElementById('idturma').value;
    var disciplina_id =  document.getElementById('iddisciplina').value;
    
    var questao_id =  document.getElementById('questao_id'+id).value;

     var texto = " ";
      

      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Responder_questionario_discursiva.php?texto="+texto+"&id="+idalternativa+"&disciplina_id="+disciplina_id+"&turma_id="+turma_id+"&questao_id="+questao_id, true);
      
      xmlreq.onreadystatechange = function(){
       
          if (xmlreq.readyState == 4) {
              if (xmlreq.status == 200) {
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Ação Concluída',
                    showConfirmButton: false,
                    timer: 1500
                  });
                  
              }else{
                 Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Alguma Coisa deu Errado!',
                  
                });
                  
              }
          }
      };
      xmlreq.send(null);
  } 
  
  function resposta_justificada(id) {
     
     var idalternativa =id;
    var result = document.getElementById("rd"+id);
     

    var turma_id= document.getElementById('idturma').value;
    var disciplina_id =  document.getElementById('iddisciplina').value;
     
    var questao_id =  document.getElementById('questao_id'+id).value;

     var texto = document.getElementById(id).value;
      

      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Responder_questionario_discursiva.php?texto="+texto+"&id="+idalternativa+"&disciplina_id="+disciplina_id+"&turma_id="+turma_id+"&questao_id="+questao_id, true);
      
      xmlreq.onreadystatechange = function(){
       
          if (xmlreq.readyState == 4) {
              if (xmlreq.status == 200) {
                 //alert("Alternativa Marcada");
                  
              }else{
                 alert('Erro');
                  
              }
          }
      };
      xmlreq.send(null);
  }

  
  
function alterar_data_questionario(id) {
    var data = document.getElementById("data"+id).value;
    var result = document.getElementById("resposta_alteracao_data");
    
    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Alterar_data_questionario.php?id="+id+"&data="+data, true);

    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 alert('Data alterada');
                 result.innerHTML =  "Ação concluída!";
                 
             }else{
                // alert('Erro');
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Alguma Coisa deu Errado!',
                  
                });
             }
         }
     };
     xmlreq.send(null);
 }


 function alterar_horario_individual_questionario(idaluno) {

    var result= document.getElementById("horario_alterado"+idaluno);
    var idquestionario= document.getElementById("idquestionario").value;
    var hora_inicio= document.getElementById("hora_inicio"+idaluno).value;
    var hora_fim= document.getElementById("hora_fim"+idaluno).value;
    result.innerHTML="";
    var url = "idaluno="+idaluno+"&hora_inicio="+hora_inicio+"&hora_fim="+hora_fim+"&idquestionario="+idquestionario;
     
     var xmlreq = CriaRequest();
     xmlreq.open("GET", "../Controller/Alterar_horario_individual_questionario.php?"+url, true);     
     xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                result.innerHTML="<b class='text-success'>Alterado</b><br>";
                 
             }else{
                result.innerHTML="<b class='text-danger'>Erro ao alterar horário</b><br>";
                
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Alguma Coisa deu Errado!',
                  
                });
                 
             }
         }
     };
     xmlreq.send(null);
 }


  function cadastra_horario_individual_questionario(idaluno) {

    var idquestionario= document.getElementById("idquestionario").value;

    var hora_inicio= document.getElementById("hora_inicio"+idaluno).value;
    var hora_fim= document.getElementById("hora_fim"+idaluno).value;
    
    var url = "idaluno="+idaluno+"&hora_inicio="+hora_inicio+"&hora_fim="+hora_fim+"&idquestionario="+idquestionario;
    

    var xmlreq = CriaRequest();
     xmlreq.open("GET", "../Controller/Cadastrar_horario_individual_questionario.php?idaluno="+idaluno+"&hora_inicio="+hora_inicio+"&hora_fim="+hora_fim+"&idquestionario="+idquestionario, true);
     xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                //alert('Alterado Com Sucesso');          
                 
             }else{
                alert('erro' );
                 
             }
         }
     };
     xmlreq.send(null);
 }




function alterar_pergunta_discursiva(id) {

    var result = document.getElementById('res'+id);
    var texto_questao = document.getElementById(id).value;  

    
     var xmlreq = CriaRequest();   

     xmlreq.open("GET", "../Controller/Alterar_pergunta_discursiva.php?texto_questao="+texto_questao+"&id="+id, true);
     xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 result.innerHTML = "<b class='alert alert-success'>Editado com Sucesso!</b>";                
             }else{
                //alert('Erro');
             }
         }
     };
     xmlreq.send(null);
 }


function gerar_questao(tipo) {
    var result = document.getElementById("gerar_questao");
    

    if (tipo=="multipla") {

          // result.innerHTML = " <div class='card card-outline card-info'>"+
          //   "<div class='card-header'>"+
          //     "<h3 >"+
          //    "Alternativa 1"+
          //    " </h3>"+
          //   "</div>"+
          //   "<div class='card-body'>"+
          //    " <textarea name='alternativa1' id='summernote' style='height: 245.719px;'></textarea>"+
          //   "</div>"+
          //   "<div class='card-footer'>"+
          //  " </div>"+
          // "</div>";

        result.innerHTML = "<div class='form-group'>"+
        "<h2 >Múltipla Escolha </h2>"+
            "<h5 >Alternativa 1</h5>"+
            "<input type='text' name='alternativa1' placeholder='Alternativa 1' class='form-control' required>"+

             "<h5 >Alternativa 2</h5>"+
            "<input type='text' name='alternativa2' placeholder='Alternativa 2' class='form-control' required>"+

             "<h5 >Alternativa 3</h5>"+
            "<input type='text' name='alternativa3' placeholder='Alternativa 3' class='form-control' required>"+

             "<h5 >Alternativa 4</h5>"+
            "<input type='text' name='alternativa4' placeholder='Alternativa 4' class='form-control' required>"+

             "<h5 >Alternativa 5</h5>"+
            "<input type='text' name='alternativa5' placeholder='Alternativa 5' class='form-control' required>"+

        "</div>";

    }else if (tipo=="multipla_justificada"){

         result.innerHTML = "<div class='form-group'>"+
         "<h2 >Múltipla Escolha Justificada </h2>"+
            "<h5 >Alternativa 1 </h5>"+
            "<input type='text' name='alternativa1' placeholder='Alternativa 1' class='form-control' required>"+

             "<h5 >Alternativa 2</h5>"+
            "<input type='text' name='alternativa2' placeholder='Alternativa 2' class='form-control' required>"+

             "<h5 >Alternativa 3</h5>"+
            "<input type='text' name='alternativa3' placeholder='Alternativa 3' class='form-control' required>"+

             "<h5 >Alternativa 4</h5>"+
            "<input type='text' name='alternativa4' placeholder='Alternativa 4' class='form-control' required>"+

             "<h5 >Alternativa 5</h5>"+
            "<input type='text' name='alternativa5' placeholder='Alternativa 5' class='form-control' required>"+

        "</div>";

    }else{
        result.innerHTML = "";
    }

 
 } 


 function relatorio_de_visualizacao_video_coordenador(idaluno) {
     
     var result = document.getElementById("relatorio_de_visualizacao_video"+idaluno);
      result.innerHTML = "";

    
     var xmlreq = CriaRequest();

     aguarde();

     xmlreq.open("GET", "../Controller/Relatorio_de_visualizacao_video_coordenador.php?idaluno="+idaluno, true);     
     xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
                
             }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Alguma Coisa deu Errado!',
                  
                });
                 
             }
         }
     };
     xmlreq.send(null);
 }




function relatorio_de_visualizacao_video(idaluno,idturma,iddisciplina) {
     
     var result = document.getElementById("relatorio_de_visualizacao_video"+idaluno);
      result.innerHTML = "<center> <img src='imagens/carregando.gif'> </center> ";

    
     var xmlreq = CriaRequest();

     aguarde();

     xmlreq.open("GET", "../Controller/Relatorio_de_visualizacao_video.php?idaluno="+idaluno+"&idturma="+idturma+"&iddisciplina="+iddisciplina, true);     
     xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
             }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Alguma Coisa deu Errado!',
                  
                });
                 
             }
         }
     };
     xmlreq.send(null);
 }





  function visualizacao_video(idvideo,id_aluno) {
 
    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Visualizacao_video.php?idvideo="+idvideo+"&id_aluno="+id_aluno, true);

    xmlreq.onreadystatechange = function(){
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                console.log(idvideo+',alu '+id_aluno);
                 // result.innerHTML =  xmlreq.responseText;                
             }else{
                //alert('Erro');
             }
         }
     };
     xmlreq.send(null);
 }




 function listar_alunos_trabalho(idtrabalho,idturma,iddisciplina) {
     
     var result = document.getElementById("listar_alunos");
     var idescola = document.getElementById("idescola").value;
      result.innerHTML = "";

    
     var xmlreq = CriaRequest();

     aguarde();

     xmlreq.open("GET", "../Controller/Listar_alunos_trabalho.php?idescola="+idescola+"&idtrabalho="+idtrabalho+"&idturma="+idturma+"&iddisciplina="+iddisciplina, true);     
     xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
             }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Alguma Coisa deu Errado!',
                  
                });
                 
             }
         }
     };
     xmlreq.send(null);
 }


  function aguarde(){
         let timerInterval
         Swal.fire({
           title: 'Aguarde, sua ação está sendo realizada!',
           html: ' ',
           timer: 3000,
           timerProgressBar: true,
           didOpen: () => {
             Swal.showLoading()
             timerInterval = setInterval(() => {
               const content = Swal.getContent()
               if (content) {
                 const b = content.querySelector('b')
                 if (b) {
                   b.textContent = Swal.getTimerLeft()
                 }
               }
             }, 100)
           },
           willClose: () => {
             clearInterval(timerInterval)
           }
         }).then((result) => {
           /* Read more about handling dismissals below */
           if (result.dismiss === Swal.DismissReason.timer) {
             console.log('I was closed by the timer')
           }
         })
   }



 function atualiza_data_hora_video(idvideo) {
     
     var result = document.getElementById(idvideo);

     var data = document.getElementById("data"+idvideo).value;
     var hora = document.getElementById("hora"+idvideo).value;
     
     var xmlreq = CriaRequest();

     aguarde();

     xmlreq.open("GET", "../Controller/Alterar_data_video.php?idvideo="+idvideo+"&data="+data+"&hora="+hora, true);     
     xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Ação Concluída',
                  showConfirmButton: false,
                  timer: 1500
                });
                 
             }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Alguma Coisa deu Errado!',
                  
                });
                 
             }
         }
     };
     xmlreq.send(null);
 }



 function mudar_status_aluno(status,id) {
     var result = document.getElementById("customSwitch3"+id);
     var xmlreq = CriaRequest();

         xmlreq.open("GET", "../Controller/Mudar_status_aluno.php?id=" + id+"&status="+status, true);
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {

                    Swal.fire(

                      'Ação concluída',

                      '.',

                      'success'
                    )            
                    // result.innerHTML ="";
             }else{
                 Swal.fire({
                   icon: 'error',
                   title: 'Oops...',
                   text: 'Alguma Coisa deu Errado!',
                   
                 })

             }

         }

     };

     xmlreq.send(null);

 }




 function pesquisa_cliente(pesquisa) {
     var result = document.getElementById("resposta_pesquisa");
     var xmlreq = CriaRequest();
       
        result.innerHTML ="<center><div class='overlay'><i class='fas fa-3x fa-sync-alt'></i></div></center>";

     xmlreq.open("GET", "../Controller/Pesquisa_cliente.php?pesquisa=" + pesquisa, true);

     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)

         if (xmlreq.readyState == 4) {

              

             // Verifica se o arquivo foi encontrado com sucesso

             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;

             }else{

                 // result.innerHTML = "Erro: " + xmlreq.responseText;;
                 Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Alguma Coisa deu Errado!',
                  
                });

             }

         }

     };

     xmlreq.send(null);

 }

 function pesquisa_funcionario(pesquisa) {
     var result = document.getElementById("resposta_pesquisa");
     var xmlreq = CriaRequest();  
        result.innerHTML ="<center><div class='overlay'><i class='fas fa-3x fa-sync-alt'></i></div></center>";

     xmlreq.open("GET", "../Controller/Pesquisa_funcionario.php?pesquisa=" + pesquisa, true);

     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)

         if (xmlreq.readyState == 4) {

             // Verifica se o arquivo foi encontrado com sucesso

             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;

             }else{

                 result.innerHTML = "Erro: " + xmlreq.responseText;;

             }

         }

     };

     xmlreq.send(null);

 }


  function pesquisa_produto(pesquisa) {
     var result = document.getElementById("resposta_pesquisa");
     var xmlreq = CriaRequest();  
        result.innerHTML ="<center><div class='overlay'><i class='fas fa-3x fa-sync-alt'></i></div></center>";

     xmlreq.open("GET", "../Controller/Pesquisa_produto.php?pesquisa=" + pesquisa, true);

     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)

         if (xmlreq.readyState == 4) {

             // Verifica se o arquivo foi encontrado com sucesso

             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;

             }else{

                 result.innerHTML = "Erro: " + xmlreq.responseText;;

             }

         }

     };

     xmlreq.send(null);

 }


// ***********************************************************************************************
 function chat_receber() {

    var result = document.getElementById("messages");
    var id_mensagem = document.getElementById("id_mensagem");
    
    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Chat_receber.php", true);

    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                var recebe=xmlreq.responseText;
                var vetor=recebe.split("#§");
                if (id_mensagem.value != vetor[1]) {
                 result.innerHTML = result.innerHTML+""+vetor[0];
                 id_mensagem.value=vetor[1];
                 rolar();
                 if (vetor[2]==0) {
                    playaudio();
                 }


                }
             }else{

                 result.innerHTML ="Erro ao receber mensagens";
               
                 
             }
         }
     };
     xmlreq.send(null);
 }

 function chat_receber_professor() {

    var result = document.getElementById("messages");
    var id_mensagem = document.getElementById("id_mensagem");

    var turma_id = document.getElementById("turma_id").value;
    var escola_id = document.getElementById("escola_id").value;
    
    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Chat_receber_professor.php?turma_id="+turma_id+"&escola_id="+escola_id, true);

    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                var recebe=xmlreq.responseText;
                var vetor=recebe.split("#§");
                if (id_mensagem.value != vetor[1]) {
                 result.innerHTML = result.innerHTML+""+vetor[0];
                 id_mensagem.value=vetor[1];
                 rolar();
                 if (vetor[2]==0) {
                    playaudio();
                 }


                }
             }else{

                 result.innerHTML ="Erro ao receber mensagens";
               
                 
             }
         }
     };
     xmlreq.send(null);
 }



 function chat_enviar() {

    var result = document.getElementById("messages");
    var mensagem_enviar = document.getElementById("mensagem_enviar").value;
    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Chat_enviar.php?mensagem="+mensagem_enviar, true);


    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
                 document.getElementById("mensagem_enviar").value="";
                 chat_receber();
                 rolar();
             }else{

                 result.innerHTML ="Erro ao receber mensagens";
               
                 
             }
         }
     };
     xmlreq.send(null);
 }


 function chat_enviar_professor() {


    var result = document.getElementById("messages");
    var mensagem_enviar = document.getElementById("mensagem_enviar").value;
    var xmlreq = CriaRequest();   

    var turma_id = document.getElementById("turma_id").value;
    var escola_id = document.getElementById("escola_id").value;
    xmlreq.open("GET", "../Controller/Chat_enviar_professor.php?mensagem="+mensagem_enviar+"&turma_id="+turma_id+"&escola_id="+escola_id, true);


    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
                 document.getElementById("mensagem_enviar").value="";
                 chat_receber_professor();
                 rolar();
             }else{

                 result.innerHTML ="VERIFIQUE SUA CONEXÃO COM A INTERNET";
               
                 
             }
         }
     };
     xmlreq.send(null);
 }


function rolar() {
    var objDiv = document.getElementById("messages");
    objDiv.scrollTop = objDiv.scrollHeight;
}

 function playaudio() {
    document.getElementById('myAudio').play();
}


 function listar_turmas_coordenador(idescola) {
    var result = document.getElementById("accordion");
    var xmlreq = CriaRequest();   
    result.innerHTML="<img src='imagens/carregando.gif'>";
    xmlreq.open("GET", "../Controller/Listar_turmas_coordenador.php?idescola="+idescola, true);


    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
                 
             }else{

                 result.innerHTML ="Verifique sua conexão com a internet!";
               
                 
             }
         }
     };
     xmlreq.send(null);
 }