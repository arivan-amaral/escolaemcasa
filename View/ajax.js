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


function pesquisa_relatorio_busca_ativa(){
        var xmlreq = CriaRequest();
        var result=document.getElementById('resultado_busca');
        var escola_id=document.getElementById('idescola').value;
        var turma_id=document.getElementById('idturma').value;
        var data_inicial=document.getElementById('data_inicial').value;
        var data_final=document.getElementById('data_final').value;

        var url = "escola_id="+escola_id+"&turma_id="+turma_id+"&data_inicial="+data_inicial+"&data_final="+data_final;
    // alert();
        result.innerHTML="<center><img src='imagens/carregando.gif'></center>";
        xmlreq.open("GET", "../Controller/Pesquisa_relatorio_busca_ativa.php?"+url, true);
        xmlreq.onreadystatechange = function(){
         if (xmlreq.readyState == 4) {           
             if (xmlreq.status == 200) {
               result.innerHTML = xmlreq.responseText;              
             }else{
                alert('Erro desconhecido, verifique sua conexão com a internet');               
             }
         }
     };
     xmlreq.send(null);
}


function pesquisa_registro_ligacao(){
        var xmlreq = CriaRequest();
        var result=document.getElementById('resultado');
        var escola_id=document.getElementById('idescola').value;
        var turma_id=document.getElementById('idturma').value;
        var ficai=document.getElementById('ficai').value;

        var url = "escola_id="+escola_id+"&turma_id="+turma_id+"&ficai="+ficai;
    // alert();
        result.innerHTML="<center><img src='imagens/carregando.gif'></center>";
        xmlreq.open("GET", "../Controller/Pesquisa_registro_ligacao.php?"+url, true);
        xmlreq.onreadystatechange = function(){
         if (xmlreq.readyState == 4) {           
             if (xmlreq.status == 200) {
               result.innerHTML = xmlreq.responseText;              
             }else{
                alert('Erro desconhecido, verifique sua conexão com a internet');               
             }
         }
     };
     xmlreq.send(null);
}


// function aumenta_limite_pag(novolimite){
//     console.log("teste"+novolimite);
//      var limite_antigo = document.getElementById('limite_antigo');
//      var limite_novo = document.getElementById('limite_novo');
     
//      if (parseInt(novolimite) > parseInt(limite_novo.value)) {
//         limite_antigo.value= parseInt(limite_novo.value) +parseInt(novolimite);
//         limite_novo.value= parseInt(novolimite);

//      }else{
//         limite_antigo.value= parseInt(limite_novo.value)-parseInt(novolimite);
//         limite_novo.value= parseInt(novolimite);
//      }

// }
// 
// 

function alterar_input_linha_transporte(valor,id) {
    // alert(id);
    //  document.getElementById(id).value=valor;
 }

function criar_linha_para_cada_aluno_carteirinha() {
     document.getElementById('carteirinha_linha_transporte').innerHTML="";
    // Seleciona todos os checkboxes que possuem id iniciado por "idaluno"
    let checkboxes = document.querySelectorAll('[id^="idaluno_carterinha"]:checked');
   
    let label = document.getElementById("nome_aluno");
    
    // Cria um input para cada checkbox selecionado
    checkboxes.forEach(function(checkbox) {
        let input = document.createElement('input');
        input.type = 'text';
        input.name = checkbox.id;
        input = checkbox.id + '_input';
        nome = document.getElementById(checkbox.id + '_nome').value;
        linha_transporte = document.getElementById(checkbox.id + '_nome_linha').value;

       document.getElementById('carteirinha_linha_transporte').innerHTML+="<div class='form-group'><label for='exampleInputEmail1'>Linha transporte para: "+nome+"</label>"+
                           "<input type='text' class='form-control' id='"+input+"' name='linha_transporte_aluno[]' placeholder='Linha do transporte' readonly value='"+linha_transporte+"' oninput=alterar_input_linha_transporte(this.value,"+input+"); >"+
                     "</div>";
    });

    // Adiciona um listener para cada checkbox que remove o input correspondente quando ele é desmarcado
    let allCheckboxes = document.querySelectorAll('[id^="idaluno_carterinha"]');
    allCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                
        document.getElementById('carteirinha_linha_transporte').innerHTML="<div class='form-group'><label for='exampleInputEmail1'>Endereço</label>"+
                            "<input type='text' class='form-control' id='"+input+"' name='endereco_escola' placeholder='Endereço da escola' required='>"+
                      "</div>";
            } else {
                let input_campo = document.getElementById(input);
                if (input_campo) {
                    input_campo.remove();
                }
            }
        });
    });
}





function limpa_pesquisa_aluno(){
    var result=document.getElementById('tabela_pesquisa');
    result.innerHTML ="";
}


function lista_espera(){


  var result = document.getElementById('tabela_lista_espera');
  var pesquisa = document.getElementById('escola_associada').value;
  result.innerHTML = "<img src='imagens/carregando.gif'>";  
  var xmlreq = CriaRequest();
  xmlreq.open("GET", "../Controller/Pesquisa_lista_espera.php?pesquisa="+pesquisa, true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;

           }else{
              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
}


function buscar_dados_editar_lista(id){


  var result = document.getElementById('form_lista_espera_editar');
  result.innerHTML="";
  result.innerHTML = "<img src='imagens/carregando.gif'>";  
  var xmlreq = CriaRequest();
  xmlreq.open("GET", "../Controller/Pesquisa_editar_lista_espera.php?id="+id, true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;

           }else{
              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
}


function aceita_recusar_lista_espera(id,status){


  
  var xmlreq = CriaRequest();
  xmlreq.open("GET", "../Controller/Aceita_lista_espera.php?id="+id+"&status="+status, true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                alert('Ação concluída');
                lista_espera();
           }else{
                alert('Erro');

              // result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
}

function buscar_datas_conteudos(idperiodo){
  var inicio = document.getElementById('periodo_inicio'+idperiodo).value;
  var fim = document.getElementById('periodo_fim'+idperiodo).value;
  var periodo = document.getElementById('periodo'+idperiodo)
  var result = document.getElementById('resultado'+idperiodo);
console.log("teste:"+periodo.value);
 

  var iddisciplina = document.getElementById('iddisciplina').value;
  var idserie = document.getElementById('idserie').value;
  var seguimento = document.getElementById('seguimento').value;
  var idturma = document.getElementById('idturma').value;
  var idescola = document.getElementById('idescola').value;
 
  var idfuncionario = document.getElementById('idfuncionario').value;


var url="idfuncionario="+idfuncionario+"&iddisciplina="+iddisciplina+"&idserie="+idserie+"&seguimento="+seguimento+"&idturma="+idturma+"&idescola="+idescola+"&inicio="+inicio+"&fim="+fim;
 
    if (parseInt(periodo.value)=='0') {
      periodo.value=1;
      result.innerHTML = "<img src='imagens/carregando.gif'>";  
      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Buscar_datas_conteudos.php?"+url, true);

          xmlreq.onreadystatechange = function(){
        
           if (xmlreq.readyState == 4) {
               if (xmlreq.status == 200) {
                     result.innerHTML = xmlreq.responseText;

               }else{
                  result.innerHTML ="Erro ao receber dados";                 
               }
           }
          };
       xmlreq.send(null);
    }
}




function submit_post_generico(caminho,formulario,botao){     
      console.log(caminho);   
      var array_pes= caminho.split(',');
      caminho= array_pes[0];
      formulario= array_pes[1];
      botao= array_pes[2];


      var formData = new FormData(document.getElementById(formulario));   
      $.ajax({
              type: 'POST',
              url: ''+caminho,
              data: formData,
              contentType: false,
              cache: false,
              processData:false,
              beforeSend: function(){
                    $('#'+botao+'').attr("disabled","disabled");
                    $('#'+formulario+'').css("opacity",".5");
              },
              success: function(msg){  
              console.log(msg);               
                  if(msg == 'certo')
                  {
                      $('#'+formulario+'')[0].reset();
                      
                      Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Ação Concluída',
                           text: ' ',
                        showConfirmButton: false,
                        timer: 3000
                      });
                     // setTimeout(function(){window.location.href="pesquisa_aluno.php";},1500);

                  }
                  else
                  {
                      alert(msg);
                  }
                  $('#'+formulario+'').css("opacity","");
                  $("#"+botao+"").removeAttr("disabled");
              }
          });
    }




function ValidaCPF(cpf_recebido){  
    var RegraValida=document.getElementById(cpf_recebido).value; 

    var r=document.getElementById("status_cpf"); 
    r.innerHTML="";  
    var cpfValido = /^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2})|([0-9]{11}))$/;     
    if (RegraValida.length==14) {

        if (cpfValido.test(RegraValida) == true && isValidCPF(RegraValida)){ 
               // r.innerHTML="<br><b>CPF Válido</b>";  
            } else  {    
               alert("CPF Inválido, verifique e preencha novamente!");
                document.getElementById(cpf_recebido).value=""; 

            }
        }
}

function fMasc(objeto,mascara) {
obj=objeto
masc=mascara
setTimeout("fMascEx()",1)
}


function fMascEx() {
obj.value=masc(obj.value)
}

function mCPF(cpf){
cpf=cpf.replace(/\D/g,"")
cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
return cpf
}



function isValidCPF(cpf) {
    if (typeof cpf !== "string") return false
    cpf = cpf.replace(/[\s.-]*/igm, '')
    if (
        !cpf ||
        cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999" 
    ) {
        return false
    }
    var soma = 0
    var resto
    for (var i = 1; i <= 9; i++) 
        soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i)
    resto = (soma * 10) % 11
    if ((resto == 10) || (resto == 11))  resto = 0
    if (resto != parseInt(cpf.substring(9, 10)) ) return false
    soma = 0
    for (var i = 1; i <= 10; i++) 
        soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i)
    resto = (soma * 10) % 11
    if ((resto == 10) || (resto == 11))  resto = 0
    if (resto != parseInt(cpf.substring(10, 11) ) ) return false
    return true
}


function idade_aluno() {
    var data_nascimento=document.getElementById('data_nascimento').value;
    console.log("teste:"+data_nascimento);

    var ano_aniversario;
    var mes_aniversario;
    var dia_aniversario;
    
    var array_pes= data_nascimento.split('-');
    ano_aniversario= array_pes[0];
    mes_aniversario= array_pes[1];
    dia_aniversario= array_pes[2];


     var d = new Date,
         ano_atual = d.getFullYear(),
         mes_atual = d.getMonth() + 1,
         dia_atual = d.getDate(),

         ano_aniversario = +ano_aniversario,
         mes_aniversario = +mes_aniversario,
         dia_aniversario = +dia_aniversario,

         quantos_anos = ano_atual - ano_aniversario;

     if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
         quantos_anos--;
     }
    document.getElementById('idade').value=quantos_anos;
    
    console.log("teste:"+quantos_anos);

    // return quantos_anos < 0 ? 0 : quantos_anos;
}

function  questionar_chamada(id_chamado,id_funcionario,id_setor){
    var mensagem=document.getElementById('mensagem').value;
    var texto = document.getElementById('mudar_mensagem');
    if(mensagem == "" || mensagem == null){
       Swal.fire({
                  position: 'center',
                  icon: 'info',
                  title: 'ATENÇÃO',
                  text:  'Preencha a mensagem',
                   });
    }else{
      var chamada= id_chamado;
      var funcionario =id_funcionario;
      var setor =id_setor;

        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Questionar_chamada.php?chamada="+chamada+"&funcionario="+funcionario+"&mensagem="+mensagem+"&setor="+setor, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                  texto.innerHTML="<textarea type='text' class='form-control' rows='3' name='mensagem' id='mensagem' required='' disabled></textarea><br>";
                  Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Ação Concluída',
                   text: 'Questionamento Realizado com sucesso',
                showConfirmButton: false,
                timer: 1500
              });

             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
        };
     xmlreq.send(null);
    }
    
}

function  verificar_atraso(){

    
      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Verificar_atraso.php", true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 if(xmlreq.responseText != 'nada'){
                      Swal.fire({
                  position: 'center',
                  icon: 'info',
                  title: 'ATENÇÃO',
                  text:  xmlreq.responseText,
                   });
                 }
               
           }else{
                 alert('Erro desconhecido, verifique sua conexão com a internet');

              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
}

function total_notas(id) {
    document.getElementById('total'+id).value=0;

    var nota_av1= document.getElementById('nota_av1'+id);
    var nota_av2= document.getElementById('nota_av2'+id);
    var nota_av3= document.getElementById('nota_av3'+id);
    var nota_rp= document.getElementById('nota_rp'+id);
    
    if (isNaN(nota_av1.value)!=false) {
        nota_av1.value=0;
    }    
    if (isNaN(nota_av2.value)!=false) {
        nota_av2.value=0;
    }    
    if (isNaN(nota_av3.value)!=false) {
        nota_av3.value=0;
    }    
    if (isNaN(nota_rp.value)!=false) {
        nota_rp.value=0;
    }

    var media_nota=0;

    var nota =parseFloat(nota_av1.value) + parseFloat(nota_av2.value) + parseFloat(nota_av3.value) ;

        if (parseFloat(nota_rp.value) > parseFloat(nota_av3.value)) {
           media_nota= (parseFloat(nota)- parseFloat(nota_av3.value) )+ parseFloat(nota_rp.value);
         
         }else{
            media_nota=parseFloat(nota);
         }

    if (isNaN(media_nota)==false) {
        
        var x = media_nota.toFixed(1);
        n = parseFloat(x);
        document.getElementById('total'+id).value=n;
        
     

    } 
}

function pesquisa_chamado(){


  var result = document.getElementById('resultado');
  var pesquisa = document.getElementById('pesquisa').value;


      result.innerHTML = "<img src='imagens/carregando.gif'>";  
      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Pesquisa_chamado.php?pesquisa="+pesquisa, true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;

           }else{
                 alert('Erro desconhecido, verifique sua conexão com a internet');

              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
}

function pesquisa_chamado_setor_escola(){


  var result = document.getElementById('resultado');
  var pesquisa = document.getElementById('pesquisa').value;
  var data_inicial = document.getElementById('data_inicial').value;
  var data_final = document.getElementById('data_final').value;
  var obj_filtro = document.getElementById('filtro');
  var filtro = obj_filtro.options[obj_filtro.selectedIndex].value;
    if(data_inicial != '' && data_final != '' || data_inicial == '' && data_final == ''){
        result.innerHTML = "<img src='imagens/carregando.gif'>";  
          var xmlreq = CriaRequest();
          xmlreq.open("GET", "../Controller/Pesquisa_chamado_escola_status.php?pesquisa="+pesquisa+"&data_inicial="+data_inicial+"&data_final="+data_final+"&filtro="+filtro, true);

          xmlreq.onreadystatechange = function(){
        
           if (xmlreq.readyState == 4) {
               if (xmlreq.status == 200) {
                     result.innerHTML = xmlreq.responseText;

               }else{
                     alert('Erro desconhecido, verifique sua conexão com a internet');

                  result.innerHTML ="Erro ao receber mensagens";                 
               }
           }
          };
       xmlreq.send(null);
   }else{
    Swal.fire({
        icon: 'error',
        title: 'Atenção',
        text: 'Se for utilizar uma consulta com datas, por favor insira nas duas datas inicial e final.'
      });
   }
      
}

function relatorio_rendimento_funcao(){

    // Obtém todos os checkboxes com classe iniciada por "idtuma"
    const checkboxes = document.querySelectorAll('input[type="checkbox"].idturma');

    // Variável para armazenar os valores selecionados
    let valoresSelecionados = '';

    // Itera sobre os checkboxes
    checkboxes.forEach(function(checkbox) {
      // Verifica se o checkbox está marcado
      if (checkbox.checked) {
        // Concatena o valor na variável
        valoresSelecionados += checkbox.value + ',';
      }
    });

    // Remove a última vírgula, se houver
    valoresSelecionados = valoresSelecionados.replace(/,$/, '');

    // Exibe os valores selecionados
    console.log("valores check"+valoresSelecionados);

  var result = document.getElementById('resultado');
  var data_inicial ="";
  var data_final = "";  
  // var data_inicial = document.getElementById('data_inicial').value;
  // var data_final = document.getElementById('data_final').value;
  var idescola = document.getElementById('idescola').value;
  var idturma =""+valoresSelecionados;
  var periodo = document.getElementById('periodo').value;
  var serie ="";
  // var serie = document.getElementById('serie').value;
    // if(data_inicial != '' && data_final != ''){
        result.innerHTML = "<img src='imagens/carregando.gif'>";  
          var xmlreq = CriaRequest();
          xmlreq.open("GET", "../Controller/Relatorio_rendimento_funcao.php?idescola="+idescola+"&idturma="+idturma+"&periodo="+periodo, true);

          xmlreq.onreadystatechange = function(){
        
           if (xmlreq.readyState == 4) {
               if (xmlreq.status == 200) {
                     result.innerHTML = xmlreq.responseText;

               }else{
                     alert('Erro desconhecido, verifique sua conexão com a internet');

                  result.innerHTML ="Erro ao receber mensagens";                 
               }
           }
          };
       xmlreq.send(null);
   // }else{
    // Swal.fire({
    //     icon: 'error',
    //     title: 'Atenção',
    //     text: 'por favor insira nas duas datas inicial e final.'
    //   });
   // }
      
}
function pesquisa_matricula_mensal(){

  const baixar_excel = document.querySelector('#baixar_excel');
  if (baixar_excel.checked) {
   var excel=1;
  } else {
      var excel=0;

  }

  var result = document.getElementById('resultado');
  var data_inicial = document.getElementById('data_inicial').value;
  var data_final = document.getElementById('data_final').value;
  var escola = document.getElementById('escola').value;
  var serie = document.getElementById('serie').value;

    if(data_inicial != '' && data_final != ''){
      
      if (excel !=1) {

        result.innerHTML = "<img src='imagens/carregando.gif'>";  
          var xmlreq = CriaRequest();
          xmlreq.open("GET", "../Controller/Pesquisa_matricula_mensal.php?excel="+excel+"&serie="+serie+"&data_inicial="+data_inicial+"&data_final="+data_final+"&escola="+escola, true);

          xmlreq.onreadystatechange = function(){
        
           if (xmlreq.readyState == 4) {
               if (xmlreq.status == 200) {
                     result.innerHTML = xmlreq.responseText;

               }else{
                     alert('Erro desconhecido, verifique sua conexão com a internet');

                  result.innerHTML ="Erro ao receber mensagens";                 
               }
           }
          };
       xmlreq.send(null);
    }else{
           window.open("../Controller/Pesquisa_matricula_mensal.php?excel="+excel+"&serie="+serie+"&data_inicial="+data_inicial+"&data_final="+data_final+"&escola="+escola+"", "_blank");
    }




   }else{
    Swal.fire({
        icon: 'error',
        title: 'Atenção',
        text: 'por favor insira nas duas datas inicial e final.'
      });
   }
      
}


function pesquisa_relatorio_filtros(){
 
  const baixar_excel = document.querySelector('#baixar_excel');
  if (baixar_excel.checked) {
   var excel=1;
  } else {
      var excel=0;

  }

  var contador = 0;
  var texto = "";
  var parametro = "";
  var titulo = "";
  var result = document.getElementById('resultado_busca');
  var escola = document.getElementById('escola').value;
  var sexo = document.getElementById('sexo').value;

  var idaluno = document.getElementById('idaluno');
  var nome = document.getElementById('nome');
  var filiacao1 = document.getElementById('filiacao1');
  var filiacao2 = document.getElementById('filiacao2');
  var cartao_sus = document.getElementById('cartao_sus');
  var whatsapp = document.getElementById('whatsapp');
  var whatsapp_responsavel = document.getElementById('whatsapp_responsavel');
  var bairro = document.getElementById('bairro');
  var endereco = document.getElementById('endereco');
  var nome_escola = document.getElementById('nome_escola');
  var nome_turma = document.getElementById('nome_turma');
  var bolsa_familia = document.getElementById('bolsa_familia');
  var data_nascimento = document.getElementById('data_nascimento');
  var cpf_aluno = document.getElementById('cpf');
  var ordenacao = document.getElementById('ordenacao');
  var necessidade_especial = document.getElementById('necessidade_especial').value;

  var operacao_cond_idade = document.getElementById('operacao_cond_idade').value;
  var operacao_idade = document.getElementById('operacao_idade').value;

  var cep_endereco = document.getElementById('cep_endereco');
  var raca_aluno = document.getElementById('raca_aluno');
 
  if(idaluno.checked) {
     if(contador == 0){
      texto+=idaluno.value;
      titulo+="ID Aluno";
      parametro+="idaluno";
      contador++;
     }else{
      texto+=","+idaluno.value;
      titulo+="-ID Aluno";
      parametro+="-idaluno";
      contador++;
     }
  }
  if(nome.checked) {
    if(contador == 0){
    texto+=nome.value;
    titulo+="Nome";
    parametro+="nome";
    contador++;
   }else{
    texto+=","+nome.value;
    titulo+="-Nome";
    parametro+="-nome";
    contador++;
   }
}

if(cpf_aluno.checked) {
  if(contador == 0){
  texto+=cpf_aluno.value;
  titulo+="Cpf Aluno";
  parametro+="cpf";
  contador++;
 }else{
  texto+=","+cpf_aluno.value;
  titulo+="-Cpf aluno";
  parametro+="-cpf";
  contador++;
 }
}
  if(filiacao1.checked) {
      if(contador == 0){
      texto+=filiacao1.value;
      titulo+="1° Filiação";
      parametro+="filiacao1";
      contador++;
     }else{
      texto+=","+filiacao1.value;
      titulo+="-1° Filiação";
      parametro+="-filiacao1";
      contador++;
     }
  }
  if(filiacao2.checked) {
      if(contador == 0){
      texto+=filiacao2.value;
      titulo+="2° Filiação";
      parametro+="filiacao2";
      contador++;
     }else{
      texto+=","+filiacao2.value;
      titulo+="-2° Filiação";
      parametro+="-filiacao2";
      contador++;
     }
  }
  if(cartao_sus.checked) {
     if(contador == 0){
      texto+=cartao_sus.value;
      titulo+="Cartão Sus";
      parametro+="cartao_sus";
      contador++;
     }else{
      texto+=","+cartao_sus.value;
      titulo+="-Cartão Sus";
      parametro+="-cartao_sus";
      contador++;
     }
  }
  if(whatsapp.checked) {
      if(contador == 0){
      texto+=whatsapp.value;
      titulo+="Whatsapp";
      parametro+="whatsapp";
      contador++;
     }else{
      texto+=","+whatsapp.value;
      titulo+="-Whatsapp";
      parametro+="-whatsapp";
      contador++;
     }
  }
  if(whatsapp_responsavel.checked) {
      if(contador == 0){
      texto+=whatsapp_responsavel.value;
      titulo+="Whatsapp do Responsável";
      parametro+="whatsapp_responsavel";
      contador++;
     }else{
      texto+=","+whatsapp_responsavel.value;
      titulo+="-Whatsapp do Responsável";
      parametro+="-whatsapp_responsavel";
      contador++;
     }
  }
  if(bairro.checked) {
     if(contador == 0){
      texto+=bairro.value;
      titulo+="Bairro";
      parametro+="bairro_endereco";
      contador++;
     }else{
      texto+=","+bairro.value;
      titulo+="-Bairro";
      parametro+="-bairro_endereco";
      contador++;
     }
  }
  if(endereco.checked) {
     if(contador == 0){
      texto+=endereco.value;
      titulo+="Endereço";
      parametro+="endereco";
      contador++;
     }else{
      texto+=","+endereco.value;
      titulo+="-Endereço";
      parametro+="-endereco";
      contador++;
     }
  }  
  if(cep_endereco.checked) {
     if(contador == 0){
      texto+=cep_endereco.value;
      titulo+="Cep";
      parametro+="cep_endereco";
      contador++;
     }else{
      texto+=","+cep_endereco.value;
      titulo+="-Endereço";
      parametro+="-cep_endereco";
      contador++;
     }
  }  
  if(raca_aluno.checked) {
     if(contador == 0){
      texto+=cep_endereco.value;
      titulo+="raca_aluno";
      parametro+="raca_aluno";
      contador++;
     }else{
      texto+=","+raca_aluno.value;
      titulo+="-raca_aluno";
      parametro+="-raca_aluno";
      contador++;
     }
  }

  if(nome_escola.checked) {
     if(contador == 0){
      texto+=nome_escola.value;
      titulo+="Nome da Escola";
      parametro+="nome_escola";
      contador++;
     }else{
      texto+=","+nome_escola.value;
      titulo+="-Nome da Escola";
      parametro+="-nome_escola";
      contador++;
     }
  }

  if(nome_turma.checked) {
      if(contador == 0){
      texto+=nome_turma.value;
      titulo+="Nome da Turma";
      parametro+="nome_turma";
      contador++;
     }else{
      texto+=","+nome_turma.value;
      titulo+="-Nome da Turma";
      parametro+="-nome_turma";
      contador++;
     }
  }
  if(bolsa_familia.checked) {
      if(contador == 0){
      texto+=bolsa_familia.value;
      titulo+="Recebe Bolsa Familia";
      parametro+="bolsa_familia";
      contador++;
     }else{
      texto+=","+bolsa_familia.value;
      titulo+="-Recebe Bolsa Familia";
      parametro+="-bolsa_familia";
      contador++;
     }
  }
  if(data_nascimento.checked) {
      if(contador == 0){
      texto+=data_nascimento.value;
      titulo+="Data de Nascimento";
      parametro+="data_nascimento";
      contador++;
     }else{
      texto+=","+data_nascimento.value;
      titulo+="-Data de Nascimento";
      parametro+="-data_nascimento";
      contador++;
     }
  }
  if(texto == ""){
     Swal.fire({
                icon: 'warning',
                title: 'ATENÇÃO',
                text: 'Marque pelo menos um campo para pesquisar'
                
              });  
  }else if(excel !=1){

    result.innerHTML = "<img src='imagens/carregando.gif'>";  
      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Pesquisa_relatorio_filtro.php?excel="+excel+"&operacao_cond_idade="+operacao_cond_idade+"&operacao_idade="+operacao_idade+"&necessidade_especial="+necessidade_especial+"&ordenacao="+ordenacao.value+"&texto="+texto+"&escola="+escola+"&sexo="+sexo+"&titulo="+titulo+"&parametro="+parametro, true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
                 contador = 0;
           }else{
                 alert('Erro desconhecido, verifique sua conexão com a internet');

              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
  }else{
          window.open("../Controller/Pesquisa_relatorio_filtro.php?excel="+excel+"&operacao_cond_idade="+operacao_cond_idade+"&operacao_idade="+operacao_idade+"&necessidade_especial="+necessidade_especial+"&ordenacao="+ordenacao.value+"&texto="+texto+"&escola="+escola+"&sexo="+sexo+"&titulo="+titulo+"&parametro="+parametro+"", "_blank");

  }

 
      
}
function cadastrar_resposta_mensagem(id_mensagem,id_funcionario,mensagem){

    var mensagem = document.getElementById('mensagem'+id_mensagem).value;

      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Cadastrar_resposta_mensagem.php?mensagem="+mensagem+"&id_funcionario="+id_funcionario+"&id_mensagem="+id_mensagem, true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 
                Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Ação Concluída',
                 text: 'Cadastro Realizado com sucesso',
              showConfirmButton: false,
              timer: 1500
            });
           }else{
                 alert('Erro desconhecido, verifique sua conexão com a internet');

              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
}
function cadastrar_mensagem(id_chamada,enviado){

    var mensagem = document.getElementById('mensagem').value;

      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Cadastrar_mensagem.php?mensagem="+mensagem+"&enviado="+enviado+"&id_chamada="+id_chamada, true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 
                Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Ação Concluída',
                 text: 'Cadastro Realizado com sucesso',
              showConfirmButton: false,
              timer: 1500
            });
           }else{
                 alert('Erro desconhecido, verifique sua conexão com a internet');

              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
}

function relatorio_rendimento_turma_funcao(){

    var result = document.getElementById('idturma');
    var idescola = document.getElementById('idescola').value;

      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Listar_turma_relatorio_rendimento.php?idescola="+idescola, true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
              result.innerHTML =xmlreq.responseText;                 
           
           }else{
      
              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
}



function cadastrar_mensagem(id_chamada,enviado){

    var mensagem = document.getElementById('mensagem').value;

      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Cadastrar_mensagem.php?mensagem="+mensagem+"&enviado="+enviado+"&id_chamada="+id_chamada, true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 
                Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Ação Concluída',
                 text: 'Cadastro Realizado com sucesso',
              showConfirmButton: false,
              timer: 1500
            });
           }else{
                 alert('Erro desconhecido, verifique sua conexão com a internet');

              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
}

function alterar_situacao_aluno(matricula,element){
    var xmlreq = CriaRequest();
   Swal.fire({
      title: 'Insira a Data de Saida:',
      html: `<input type="date" id="login" class="swal2-input" placeholder="Username">`,
      confirmButtonText: 'Mudar',
      focusConfirm: false,
      preConfirm: () => {
        const login = Swal.getPopup().querySelector('#login').value
        
        if (!login) {
          Swal.showValidationMessage(`Insira uma data`)
        }
        return { login: login }
      }
    }).then((result) => {
        data = result.value.login; 
        status= element.options[element.selectedIndex].value;
        xmlreq.open("GET", "../Controller/Mudar_situacao_aluno.php?data="+data+"&matricula="+matricula+"&status="+status, true);
        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                Swal.fire({
               position: 'center',
               icon: 'success',
               title: 'Ação Concluída',
                  text: ' ',
               showConfirmButton: false,
               timer: 2500
             });
              
             }else{
                 Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: ' ocorreu um erro'
                
              });                
             }
         }
        };
     xmlreq.send(null);
    });
}

function ver_resolvidos(setor_id){
    var result= document.getElementById('tabela_chamados');
    var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Listar_chamados_resolvidos.php?setor_id="+setor_id, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                  
                result.innerHTML = xmlreq.responseText;
             }else{
                 Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: ' $mensagem'
                
              });                
             }
         }
        };
     xmlreq.send(null);
}

 function licitalem_webhook(){
   var xmlreq = CriaRequest();   
    xmlreq.open("POST", "https://educalem.com.br/licitalem/Controller/Api_licitacao.php", true);
     xmlreq.onreadystatechange = function(){      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
               

             }else{
                
             }
         }
     };
     xmlreq.send(null);
 }


 
 function licitalem_webhook(){
   var xmlreq = CriaRequest();   
    xmlreq.open("POST", "../Controller/Notificacao_ocorrencia_whatsapp.php", true);
     xmlreq.onreadystatechange = function(){      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
               

             }else{
               
             }
         }
     };
     xmlreq.send(null);
 }


 

var data = new Date();
var hora    = data.getHours();           
var min     = data.getMinutes();         


// setTimeout("licitalem_webhook()",10000);



function cadastrar_nota_fora_rede_ano_finalizado() {
   // var result= document.getElementById('lista_notas_cadastrada_fora');
    var xmlreq = new XMLHttpRequest();
   
    xmlreq.open("POST", "../Controller/Cadastrar_nota_fora_rede.php", true);
    xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    var aluno_finalizou=document.getElementsByName('aluno_finalizou')[0].value;
    if (aluno_finalizou=="Sim") {
        idturma=1000;
        idperiodo=7;
    }else{
        var idturma=document.getElementsByName('idturma')[0].value;
        var idperiodo=document.getElementsByName('idperiodo')[0].value;
    }
    var escola_origem=document.getElementsByName('escola_origem')[0].value; //de onde o aluno vei)[0].value;

    var idescola =document.getElementsByName('idescola')[0].value; // escola da rede a qual a nota está sendo inseri)[0].value;
    var iddisciplina=document.getElementsByName('iddisciplina')[0].value;
    var idaluno=document.getElementsByName('idaluno')[0].value;
    var tipo_registro=document.getElementsByName('tipo_registro')[0].value;

    var ano_referencia=document.getElementsByName('ano_referencia')[0].value;
    var idserie=document.getElementsByName('idserie')[0].value;
   
    var media_ou_nf=document.getElementsByName('media_ou_nf')[0].value;
    var carga_horaria=document.getElementsByName('carga_horaria')[0].value;
    var total_falta=document.getElementsByName('total_falta')[0].value;
    var estado=document.getElementsByName('estado').value;


 xmlreq.send(
 "aluno_finalizou="+aluno_finalizou+
 "&idperiodo="+idperiodo+
 "&idturma="+idturma+
 "&iddisciplina="+iddisciplina+
 "&estado="+estado+
 
 "&escola_origem="+escola_origem+
 "&idescola="+idescola+
 "&idaluno="+idaluno+
 "&tipo_registro="+tipo_registro+
 "&media_ou_nf="+media_ou_nf+
 "&ano_referencia="+ano_referencia+
 "&idserie="+idserie+
 "&carga_horaria="+carga_horaria+
 "&total_falta="+total_falta
 );
   // if (!!document.getElementsByName('etapa')) 
   xmlreq.onreadystatechange = function() {
     // Caso o state seja 4 e o http.status for 200, é porque a requisiçõe deu certo.
     if (xmlreq.readyState == 4 && xmlreq.status == 200) {
         var data = xmlreq.responseText;
           if(data == 'certo'){
             Swal.fire({
               position: 'center',
               icon: 'success',
               title: 'Ação Concluída',
                  text: ' ',
               showConfirmButton: false,
               timer: 2500
             });
        document.getElementsByName('iddisciplina')[0].value="";
          document.getElementsByName('media_ou_nf')[0].value="";
          document.getElementsByName('carga_horaria')[0].value="";
          document.getElementsByName('total_falta')[0].value="";
         lista_notas_cadastrada_fora();
           }else{
             Swal.fire({
               position: 'center',
               icon: 'error',
               title: 'Preencha todos os campos obrigatorios',
                  text: ' ',
               showConfirmButton: false,
               timer: 1500
             });

         lista_notas_cadastrada_fora();
             
           }
     }
   }
  


}




function excluir_notas_cadastrada_fora(idnota) {

   Swal.fire({
  title: 'Tem certeza?',
  text: "os dados desta linha serão apagados",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sim!'
}).then((result) => {
  if (result.isConfirmed) {
    var xmlreq = CriaRequest();   
   
    xmlreq.open("GET", "../Controller/Excluir_notas_cadastrada_fora.php?idnota="+idnota, true);
    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                // result.innerHTML = xmlreq.responseText;
                 if(xmlreq.responseText=="certo"){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Ação concluída',
                         text: ' ',
                      showConfirmButton: false,
                      timer: 1500
                    });
                   var node = document.getElementById(idnota);
                   if (node.parentNode) {
                     node.parentNode.removeChild(node);
                   }


                 }else{
                    Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Alguma coisa deu errado',
                         text: ' ',
                      showConfirmButton: false,
                      timer: 1500
                    });
                 }

             }else{
                result.innerHTML = 'Erro desconhecido, verifique sua conexão com a internet';

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
    xmlreq.send(null);
  }
})
   
    
}



function mudar_ano_letivo(ano) {
   
    var xmlreq = CriaRequest();   
   
    xmlreq.open("GET", "../Controller/Muda_ano_letivo.php?muda_ano_letivo="+ano, true);
    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                // result.innerHTML = xmlreq.responseText;
                 if(xmlreq.responseText=="certo"){
                    
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Ação concluída',
                         text: ' ',
                      showConfirmButton: false,
                      timer: 1500
                    });
         
                    location.reload();
                 }else{
                    Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Alguma coisa deu errado',
                         text: ' ',
                      showConfirmButton: false,
                      timer: 1500
                    });
                 }

             }else{
                //result.innerHTML = 'Erro desconhecido, verifique sua conexão com a internet';

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}


function finalizar_chat(chamada) {
    var id_chamado = chamada;
    var xmlreq = CriaRequest();   
   
    xmlreq.open("GET", "../Controller/Finalizar_chamado.php?id_chamado="+id_chamado, true);
    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                // result.innerHTML = xmlreq.responseText;
                 if(xmlreq.responseText=="certo"){
                    
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Ação concluída',
                         text: ' ',
                      showConfirmButton: false,
                      timer: 1500
                    });
         
                    location.reload();
                 }else{
                    Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Alguma coisa deu errado',
                         text: ' ',
                      showConfirmButton: false,
                      timer: 1500
                    });
                 }

             }else{
                //result.innerHTML = 'Erro desconhecido, verifique sua conexão com a internet';

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}



function lista_notas_cadastrada_fora() {
    var result= document.getElementById('lista_notas_cadastrada_fora');
    var xmlreq = CriaRequest();   
    var idaluno= document.getElementById('idaluno').value;

    xmlreq.open("GET", "../Controller/Lista_notas_cadastrada_fora.php?idaluno="+idaluno, true);

   xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
             }else{
                result.innerHTML = 'Erro desconhecido, verifique sua conexão com a internet';

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}



function view_nota_fora_rede_ano_finalizado(opcao) {
    var result= document.getElementById('aluno_finalizado_ano');
    var xmlreq = CriaRequest();   

    xmlreq.open("GET", "../Controller/View_registro_nota_fora_rede.php?opcao="+opcao, true);

   xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                   result.innerHTML = xmlreq.responseText;
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}


function pesquisar_municipio(idestado,campo){
        var xmlreq = CriaRequest();
        var result=document.getElementById(campo);
        var url = "nome_campo_id="+campo+"&idestado="+idestado;
        result.innerHTML="<center><img src='imagens/carregando.gif'></center>";
        xmlreq.open("GET", "../Controller/Lista_municipio_ajax.php?"+url, true);
        xmlreq.onreadystatechange = function(){
         if (xmlreq.readyState == 4) {           
             if (xmlreq.status == 200) {
               result.innerHTML = xmlreq.responseText;              
             }else{
                alert('Erro desconhecido, verifique sua conexão com a internet');               
             }
         }
     };
     xmlreq.send(null);
}




function pesquisar_solicitacao_transferencia_por_escola(){
    var quantidade_pedido_transferencia=document.getElementById('quantidade_pedido_transferencia');
    var pedido_transferencia=document.getElementById('pedido_transferencia');
     
        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Pesquisar_solicitacao_transferencia_por_escola.php", true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             

             if (xmlreq.status == 200) {

               var texto = xmlreq.responseText;
               
               var array_pes= texto.split('*');
                pedido_transferencia.innerHTML = array_pes[0];
                quantidade_pedido_transferencia.innerHTML = array_pes[1];
        
             }else{
                   //alert('Erro desconhecido, verifique sua conexão com a internet');

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}







function alert_preencha_todos_campos(mensagem) {
 Swal.fire({
          position: 'center',
          icon: 'info',
          title: mensagem,
             text: ' ',
          showConfirmButton: false,
          timer: 3000
        });
}

function bloquear_botao_concluir(botao){
    setTimeout(function(){
        document.getElementById(botao).disabled = true;
        document.getElementById(botao).innerHTML="AGUARDE 20 SEGUNDOS, PARA CLICAR NOVAMENTE ";

    },50);

 

    setTimeout(function(){
        document.getElementById(botao).disabled = false;
        document.getElementById(botao).innerHTML="Concluir";

    },20000);

}


// function cadastro_aluno(){
//   var ajax = new XMLHttpRequest();
//     bloquear_botao_concluir("btn_cadastro_aluno");
//   // Seta tipo de requisição: Post e a URL da API
//   ajax.open("POST", "../Controller/Cadastro_aluno.php", true);
//   ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   // Seta paramêtros da requisição e envia a requisição
//   var tudo_certo=true;
//   var escola =document.getElementById('escola').value;
//   var data_matricula =document.getElementById('data_matricula').value;
//   var serie =document.getElementsByName('serie')[0].value;
//   var turma =document.getElementsByName('idturma')[0].value;

//    if (!!document.getElementsByName('etapa')) {
//     var etapa ="";
//   }else{
//      var etapa =document.getElementsByName('etapa')[0].value;
//   }
  

//    if (!!document.getElementsByName('uf_identidade')) {
//     var uf_identidade="";

//    }else{
//     var uf_identidade=document.getElementsByName('uf_identidade')[0].value;

//    }   

//    if (!!document.getElementsByName('uf_municipio_cartorio')) {
//     var uf_municipio_cartorio="";

//    }else{
//     var uf_municipio_cartorio=document.getElementsByName('uf_municipio_cartorio')[0].value;

//    }   

//    if (!!document.getElementsByName('uf_cartorio')) {
//     var uf_cartorio="";

//    }else{
//     var uf_cartorio=document.getElementsByName('uf_cartorio')[0].value;

//    }   

//    if (!!document.getElementsByName('municipio_endereco')) {
//     var municipio_endereco="";
//    }else{
//     var municipio_endereco=document.getElementsByName('municipio_endereco')[0].value;

//    }
// var data_nascimento=document.getElementsByName('data_nascimento')[0].value;
// var cpf_filiacao1=document.getElementsByName('cpf_filiacao1')[0].value;
// var cpf_filiacao2=document.getElementsByName('cpf_filiacao2')[0].value;
// var nome_responsavel=document.getElementsByName('nome_responsavel')[0].value;
// var cpf_responsavel=document.getElementsByName('cpf_responsavel')[0].value;
// var filiacao1=document.getElementsByName('filiacao1')[0].value;
// var filiacao2=document.getElementsByName('filiacao2')[0].value;
// if (escola =='' || serie =='' || turma =='' || data_nascimento =='' 
//     || nome_responsavel =='' || data_matricula == '') {
//     //alert(escola +"- "+ serie+"-"+turma)
//         tudo_certo=false;
//        alert_preencha_todos_campos('Preencha corretamente todos os campos de curso');
//   }

//  ajax.send(

//  "nome="+document.getElementsByName('nome')[0].value+
//  "&escola="+ escola+
//  "&serie="+serie+
//  "&turma="+turma+
//  "&etapa="+etapa+
//  "&data_matricula="+data_matricula+
//  "&etapa="+etapa+
//  "&sexo="+document.getElementsByName('sexo')[0].value+
//   "&email="+document.getElementsByName('email')[0].value+
//   "&filiacao1="+document.getElementsByName('filiacao1')[0].value+
//   "&filiacao2="+document.getElementsByName('filiacao2')[0].value+
//   "&senha="+document.getElementsByName('senha')[0].value+
//   "&whatsapp="+document.getElementsByName('whatsapp')[0].value+
//   "&whatsapp_responsavel="+document.getElementsByName('whatsapp_responsavel')[0].value+
//   "&data_nascimento="+document.getElementsByName('data_nascimento')[0].value+
//   "&numero_nis="+document.getElementsByName('numero_nis')[0].value+
//   "&codigo_inep="+document.getElementsByName('codigo_inep')[0].value+
//   "&bolsa_familia="+document.getElementsByName('bolsa_familia')[0].value+
//   "&tipo_responsavel="+document.getElementsByName('tipo_responsavel')[0].value+
//   "&raca_aluno="+document.getElementsByName('raca_aluno')[0].value+
//   "&estado_civil_aluno="+document.getElementsByName('estado_civil_aluno')[0].value+
//   "&tipo_sanguinio_aluno="+document.getElementsByName('tipo_sanguinio_aluno')[0].value+
//   "&profissao="+document.getElementsByName('profissao')[0].value+
//   "&situacao_documentacao="+document.getElementsByName('situacao_documentacao')[0].value+
//   "&tipo_certidao="+document.getElementsByName('tipo_certidao')[0].value+
//   "&numero_termo="+document.getElementsByName('numero_termo')[0].value+
//   "&folha="+document.getElementsByName('folha')[0].value+
//   "&uf_cartorio="+uf_cartorio+
//   "&uf_municipio_cartorio="+uf_municipio_cartorio+
//   "&cartorio="+document.getElementsByName('cartorio')[0].value+
//   "&numero_indentidade="+document.getElementsByName('numero_indentidade')[0].value+
//   "&uf_identidade="+uf_identidade+
//   "&orgao_emissor_indentidade="+document.getElementsByName('orgao_emissor_indentidade')[0].value+
//   "&data_expedicao="+document.getElementsByName('data_expedicao')[0].value+
//   "&numero_cnh="+document.getElementsByName('numero_cnh')[0].value+
//   "&categoria_cnh="+document.getElementsByName('categoria_cnh')[0].value+
//   "&cpf="+document.getElementsByName('cpf')[0].value+
//   "&cartao_sus="+document.getElementsByName('cartao_sus')[0].value+
//   "&observacao="+document.getElementsByName('observacao')[0].value+

// "&necessidade_especial="+document.getElementsByName('necessidade_especial')[0].value+
//  "&apoio_pedagogico="+document.getElementsByName('apoio_pedagogico')[0].value+
//  "&tipo_diagnostico="+document.getElementsByName('tipo_diagnostico')[0].value+
//  "&cpf_filiacao1="+document.getElementsByName('cpf_filiacao1')[0].value+
//  "&cpf_filiacao2="+document.getElementsByName('cpf_filiacao2')[0].value+
//  "&endereco="+document.getElementsByName('endereco')[0].value+
//  "&complemento="+document.getElementsByName('complemento')[0].value+
//  "&numero_endereco="+document.getElementsByName('numero_endereco')[0].value+
//  "&uf_endereco="+document.getElementsByName('uf_endereco')[0].value+
//  "&municipio_endereco="+municipio_endereco+
//  "&bairro_endereco="+document.getElementsByName('bairro_endereco')[0].value+
//  "&zona_endereco="+document.getElementsByName('zona_endereco')[0].value+
//  "&cep_endereco="+document.getElementsByName('cep_endereco')[0].value+
//  "&nacionalidade="+document.getElementsByName('nacionalidade')[0].value+
//  "&pais="+document.getElementsByName('pais')[0].value+
//  "&naturalidade="+document.getElementsByName('naturalidade')[0].value+
//  "&localidade="+document.getElementsByName('localidade')[0].value+
//  "&transposte_escolar="+document.getElementsByName('transposte_escolar')[0].value+
//  "&poder_publico_responsavel="+document.getElementsByName('poder_publico_responsavel')[0].value+
//  "&recebe_escolaridade_outro_espaco="+document.getElementsByName('recebe_escolaridade_outro_espaco')[0].value+
//  "&matricula_certidao="+document.getElementsByName('matricula_certidao')[0].value+

//  "&cartorio="+document.getElementsByName('cartorio')[0].value+
//  "&turno="+document.getElementsByName('turno')[0].value+
//  "&nome_responsavel="+document.getElementsByName('nome_responsavel')[0].value+
//  "&cpf_responsavel="+document.getElementsByName('cpf_responsavel')[0].value+
//  "&quantidade_vagas_restante="+document.getElementsByName('quantidade_vagas_restante')[0].value



//   );



//     if (tudo_certo==true) {
//          aguarde();
//         // Cria um evento para receber o retorno.
//           ajax.onreadystatechange = function() {
//             // Caso o state seja 4 e o http.status for 200, é porque a requisiçõe deu certo.
//             if (ajax.readyState == 4 && ajax.status == 200) {
//                 var data = ajax.responseText;
//                   if(data == 'certo'){
//                     Swal.fire({
//                       position: 'center',
//                       icon: 'success',
//                       title: 'Ação Concluída',
//                          text: ' ',
//                       showConfirmButton: false,
//                       timer: 2500
//                     });
//                     setTimeout(function(){window.location.href="cadastro_aluno.php";},1500);
                    
//                   }else{
//                     Swal.fire({
//                       position: 'center',
//                       icon: 'error',
//                       title: 'Alguma coisa deu errado',
//                          text: data,
//                       showConfirmButton: true
//                     });
//                   }
//             }
//           }
//     }
// }





function cadastro_aluno(){

      var serie =document.getElementsByName('serie')[0].value;
      var data_nascimento=document.getElementsByName('data_nascimento')[0].value;
      var turma=document.getElementsByName('turma')[0].value;
      var nome_responsavel=document.getElementsByName('nome_responsavel')[0].value;
      var data_matricula=document.getElementsByName('data_matricula')[0].value;



      if (!!document.getElementsByName('etapa')) {
        var etapa ="";
      }else{
         var etapa = document.getElementsByName('etapa')[0].value;
      } 
      
    console.log("etapa:"+etapa);

       if (!!document.getElementsByName('uf_identidade')) {
        var uf_identidade="";

       }else{
        var uf_identidade=document.getElementsByName('uf_identidade')[0].value;

       }   

       if (!!document.getElementsByName('uf_municipio_cartorio')) {
        var uf_municipio_cartorio="";

       }else{
        var uf_municipio_cartorio=document.getElementsByName('uf_municipio_cartorio')[0].value;

       }   

       if (!!document.getElementsByName('uf_cartorio')) {
        var uf_cartorio="";

       }else{
        var uf_cartorio=document.getElementsByName('uf_cartorio')[0].value;

       }   

       if (!!document.getElementsByName('municipio_endereco')) {
        var municipio_endereco="";
       }else{
        var municipio_endereco=document.getElementsByName('municipio_endereco')[0].value;

       }


       if (escola =='' || serie =='' || turma =='' || data_nascimento =='' 
    || nome_responsavel =='' || data_matricula == '') {
        tudo_certo=false;
       alert_preencha_todos_campos('Preencha corretamente todos os campos de curso');
       return;
  }

    var formData = new FormData(document.getElementById("form1"));      
    $.ajax({
            type: 'POST',
            url: '../Controller/Cadastro_aluno.php',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                  $('#btnSend').attr("disabled","disabled");
                  $('#form1').css("opacity",".5");
            },
            success: function(msg){  
            console.log(msg);               
                if(msg == 'certo')
                {
                    $('#form1')[0].reset();
                    
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Ação Concluída',
                         text: ' ',
                      showConfirmButton: false,
                      timer: 3000
                    });
                    
                    refresh();
                }
                else
                {
                    $('#form1').css("opacity","");
                    $("#btnSend").removeAttr("disabled");
                    
                    Swal.fire({
                         position: 'center',
                         icon: 'error',
                         title: 'Erro: '+msg,
                            text: ' ',
                         showConfirmButton: true
                       });
                }
            }
        });
}


 


function refresh() {    
    setTimeout(function () {
      window.location.reload()

    }, 2000);
}

function listar_vagas_turma_transferencia_aluno(){
    var result=document.getElementById('resultado');
    var escola = document.getElementById('escola').value;
    var serie = document.getElementById('serie').value;
     
            result.innerHTML="<center><img src='imagens/carregando.gif'></center>";
        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Listar_vagas_turma_transferencia_aluno.php?escola="+escola+"&serie="+serie, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {

             if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
        
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}


function pesquisa_aluno(){
    var result=document.getElementById('tabela_pesquisa');
    var paginacao=document.getElementById('paginacao');
    var escola = document.getElementById('escola').value;
    var pesquisa = document.getElementById('pesquisa').value;
    
  
        var xmlreq = CriaRequest();
        result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

        xmlreq.open("GET", "../Controller/Pesquisar_aluno.php?pesquisa="+pesquisa+"&escola="+escola, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
                paginacao.innerHTML ="<button onclick='pesquisa_aluno_paginacao();' class='btn btn-block btn-default btn-sm'>Ver mais resultados</button> ";
                
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}





function pesquisa_aluno_paginacao(){
    var result=document.getElementById('tabela_pesquisa');
    var paginacao=document.getElementById('paginacao');
    var escola = document.getElementById('escola').value;
    var pesquisa = document.getElementById('pesquisa').value;
    
    var valor_paginacao=document.getElementById('valor_paginacao');
  
        var xmlreq = CriaRequest();
        paginacao.innerHTML="<center><img src='imagens/carregando.gif'></center>";

        xmlreq.open("GET", "../Controller/Pesquisar_aluno.php?pesquisa="+pesquisa+"&escola="+escola+"&valor_paginacao="+valor_paginacao.value, true);
    valor_paginacao.value=parseInt(valor_paginacao.value)+25;

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
              result.innerHTML += xmlreq.responseText;
                paginacao.innerHTML ="<button onclick='pesquisa_aluno_paginacao();' class='btn btn-block btn-default btn-sm'>Ver mais resultados</button> ";
                
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}

function aprovar_concelho(idaluno){
    aguarde_acao(3000);
    var result=document.getElementById('btn_apc'+idaluno);
    var idescola = document.getElementById('escola_apc'+idaluno).value;

    var idturma = document.getElementById('turma_apc'+idaluno).value;
    var iddisciplina = document.getElementById('disciplina_apc'+idaluno).value;
 
    var url="idescola="+idescola+"&idturma="+idturma+"&iddisciplina="+iddisciplina+"&idaluno="+idaluno;
    
        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Aprovar_concelho.php?"+url, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                if(xmlreq.responseText=="certo"){
                    result.innerHTML="<a class='btn btn-success'> APC </A> <a class='btn btn-danger' onclick='cancelar_aprovacao_concelho("+idaluno+");'> Cancelar APC</a>";
                }else{
                    alert("Erro, tente novamente");
                    result.innerHTML="<a class='btn btn-primary' onclick='aprovar_concelho("+idaluno+");'> Aprovar pelo conselho</a>";
                }

             }else{
                   alert('Atenção: '+xmlreq.responseText);

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}



function marcar_aluno_evadido(matricula){
    aguarde_acao(3000);
    var result = document.getElementById('evadido_btn'+matricula);

    var url="matricula="+matricula+"&matricula_situacao=EVADIDO";
    
        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Marcar_aluno_evadido.php?"+url, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                if(xmlreq.responseText=="certo"){
                    result.innerHTML="<a class='btn btn-danger' onclick='desmarcar_aluno_evadido("+matricula+");'>DESMARCAR DE EVADIDO </a>";
                }else{
                    alert("Erro, tente novamente");
                    result.innerHTML="<a class='btn btn-primary' onclick='marcar_como_evadido("+matricula+");'>MARCAR COMO EVADIDO </a>";
                }

             }else{
                   alert('Atenção: '+xmlreq.responseText);

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}


function desmarcar_aluno_evadido(matricula){
    aguarde_acao(3000);
    var result = document.getElementById('evadido_btn'+matricula);

    var url="matricula="+matricula+"&matricula_situacao=MATRICULADO";
    
        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Marcar_aluno_evadido.php?"+url, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                if(xmlreq.responseText=="certo"){
                    result.innerHTML="<a class='btn btn-primary' onclick='marcar_aluno_evadido("+matricula+");'>MARCAR COMO EVADIDO </a>";
                }else{
                    alert("Erro, tente novamente");
                    result.innerHTML="<a class='btn btn-danger' onclick='desmarcar_aluno_evadido("+matricula+");'>DESMARCAR DE EVADIDO </a>";
                }

             }else{
                   alert('Atenção: '+xmlreq.responseText);

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}



function cancelar_aprovacao_concelho(idaluno){
    aguarde_acao(3000);

    var result=document.getElementById('btn_apc'+idaluno);
    var idescola = document.getElementById('escola_apc'+idaluno).value;

    var idturma = document.getElementById('turma_apc'+idaluno).value;
    var iddisciplina = document.getElementById('disciplina_apc'+idaluno).value;
 
    var url="idescola="+idescola+"&idturma="+idturma+"&iddisciplina="+iddisciplina+"&idaluno="+idaluno;
    
        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Cancelar_aprovacao_conselho.php?"+url, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                if(xmlreq.responseText=="certo"){
                    result.innerHTML="<a class='btn btn-primary' onclick='aprovar_concelho("+idaluno+");'> Aprovar pelo conselho</a>";
                }else{
                    alert("Erro, tente novamente");
                    result.innerHTML="<a class='btn btn-success'> APC </A> <a class='btn btn-danger' onclick='cancelar_aprovacao_concelho("+idaluno+");'> Cancelar APC</a>";
                }

             }else{
                   alert('Atenção: '+xmlreq.responseText);

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}


// ################################## MIGRAÇAO ECIDADE ######################################

function adicinar_campo_conteudo(idcampo){
    var conteudos=document.getElementById('conteudos');
    var valor = true;
    var valor = document.getElementById('customCheckbox'+idcampo).checked;
    var label = document.getElementById('label'+idcampo).innerHTML;
    if (valor==true) {

        var valor_input = document.getElementById('customCheckbox'+idcampo).value;
        var data = document.getElementById('data_frequencia').value;
        var aula = document.getElementById('aula').value;
       
        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Verifica_conteudo.php?aula="+aula+"&data="+data+"&valor_input="+valor_input, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                  // result.innerHTML = xmlreq.responseText;
                    conteudos.innerHTML+= xmlreq.responseText;
                    //Swal.fire('Ação concluída', '', 'success');
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);

    }else{
       document.getElementById('campo_inputs'+idcampo).innerHTML="";
    }


}






function muda_etapa(idaluno) {
    // var result= document.getElementById('etapa'+idaluno);
    var etapa= document.getElementById('etapa'+idaluno).value;
    var xmlreq = CriaRequest();   

    xmlreq.open("GET", "../Controller/Muda_etapa_multissereada.php?etapa="+etapa+"&idaluno="+idaluno, true);

   xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                  // result.innerHTML = xmlreq.responseText;
                    Swal.fire('Ação concluída', '', 'success');
                
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}

function listar_etapas_cad_aluno() {
    var result= document.getElementById('etapa');
    var idserie= document.getElementById('idserie').value;
    var idturma= document.getElementById('idturma').value;
    var xmlreq = CriaRequest();   

    xmlreq.open("GET", "../Controller/Lista_etapa_multissereada.php?idserie="+idturma+"/"+idserie, true);

   xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                  result.innerHTML = xmlreq.responseText;
                
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
}


function listar_etapas(idserie) {
    var result= document.getElementById('etapa');
    var xmlreq = CriaRequest();   

    xmlreq.open("GET", "../Controller/Lista_etapa_multissereada.php?idserie="+idserie, true);

   xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                  result.innerHTML = xmlreq.responseText;
                
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
     };
     xmlreq.send(null);
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


 function mudar_escola_simulado(id) {
    var idescola= document.getElementById('idescola'+id).value;
    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Mudar_escola_simulado.php?idescola="+idescola+"&idquestionario="+id, true);


    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 // result.innerHTML = xmlreq.responseText;
                 if (xmlreq.responseText =='certo') {

                    Swal.fire('Ação concluída', '', 'success');
                }else{
                    Swal.fire('Erro desconhecido, verifique sua conexão com a internet', '', 'error');

                }

             }else{
                    alert('Erro desconhecido, verifique sua conexão com a internet');

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
     
        // var descricao_conteudo = document.getElementById("descricao_conteudo");
         // descricao_conteudo.value = descricao_conteudo.value +" "+conteudo;  
         navigator.clipboard.writeText(conteudo);
         
        Swal.fire('Texto copiado para área de transferência! Ctrl+V em algum local para colar.', '', 'info')
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
    var local = document.getElementById("local").value; 
 
    var url="local="+local+"&conteudo_aula_id="+conteudo_aula_id+"&"+url_get;
  Swal.fire({
    title: 'Deseja continuar com a exclusão, conteúdo/frequência?',
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


function listar_conteudo_cadastrado(data){


  var select = document.getElementById('data_ja_lancada');
  var option = select.options[select.selectedIndex];

  var valor= option.value; //data
  var texto = option.text; //descricao data +  aula ...

  var data_frequencia = document.getElementById("data_frequencia").value=valor;
  var array_d=texto.split(' - ');
  var texto_aux=array_d[1];

  var a =document.getElementById("aula");

   a.innerHTML= "<option value='"+texto_aux+"'>"+
  texto_aux+"</option>"+ a.innerHTML+"";


  lista_conteudo_aluno();
}




function limpa_data_frequencia_ja_cadastrada(){
  var data_frequencia = document.getElementById("data_ja_lancada").value='';
}


function limpa_avaliacao(){
   document.getElementById("listagem_avaliacao").innerHTML='';
   document.getElementById("botao_continuar").innerHTML='';
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
                  "<button type='submit' class='btn btn-block btn-primary' onclick='aguarde_tempo_dinamico(60000);'>Concluir</button>"+
                "</div>";
                
            }else{
                   result.innerHTML = xmlreq.responseText;
                
                
            }
        }
    };
    xmlreq.send(null);
}





function liberar_questionario(idaluno,idquestionario){
  var resultado = document.getElementById(idaluno);
  var xmlreq = CriaRequest();   
  Swal.fire({
    title: 'Deseja continuar com essa ação?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      
           xmlreq.open("GET", "../Controller/Liberar_questionario.php?idaluno="+idaluno+"&idquestionario="+idquestionario, true);
            xmlreq.onreadystatechange = function(){     
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                        // result.innerHTML =  xmlreq.responseText;
                        resultado.innerHTML ="<b class='text-danger'>Questionário não finalizado.</b><br>";

                        
                    }else{
                        resultado.innerHTML = xmlreq.responseText;
                    }
                }
            };
            xmlreq.send(null);
                 


    } else if (result.isDenied) {
     // Swal.fire('Ação cancelada', '', 'info')
    }
  })

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
    console.log('Inicio ocorrencias');

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
  var idprofessor = document.getElementById("idprofessor").value;

   var data_frequencia = document.getElementById("data_frequencia").value;
   var aula = document.getElementById("aula").value;

    if (aula !="" && data_frequencia !="" ) {
        result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

          
      var url="idprofessor="+idprofessor+"&idserie="+idserie+"&aula="+aula+"&data_frequencia="+data_frequencia+"&idescola="+idescola+"&idturma="+idturma+"&iddisciplina="+iddisciplina;
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
                   // Swal.fire('ATENÇÃO, SÓ É PERMITIDO O LANÇAMENTO DA FREQUÊNCIA SE JÁ HOUVER CONTEÚDO CADASTRADO NA MESMA DATA.', '', 'info');

                    
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

function lista_conteudo_aluno(){
  var result = document.getElementById("listagem_frequencia");

  var botao_continuar = document.getElementById("botao_continuar");
  var xmlreq = CriaRequest();   

  var idserie = document.getElementById("idserie").value;
  var idprofessor = document.getElementById("idprofessor").value;
  var idescola = document.getElementById("idescola").value;
  var idturma = document.getElementById("idturma").value;
  var iddisciplina = document.getElementById("iddisciplina").value;
  var descricao_escola_turma = document.getElementById("descricao_escola_turma").innerHTML;

   var data_frequencia = document.getElementById("data_frequencia").value;
   var aula = document.getElementById("aula").value;

    if (aula !="" && data_frequencia !="" ) {
        result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

          
      var url="idprofessor="+idprofessor+"&descricao_escola_turma="+descricao_escola_turma+"&idserie="+idserie+"&aula="+aula+"&data_frequencia="+data_frequencia+"&idescola="+idescola+"&idturma="+idturma+"&iddisciplina="+iddisciplina;
       xmlreq.open("GET", "../Controller/Lista_conteudo_cadastrados.php?"+url, true);
        xmlreq.onreadystatechange = function(){      
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {
                    result.innerHTML =  xmlreq.responseText;
                    botao_continuar.innerHTML=""+
                    "<div class='col-sm-1'></div>"+
                    "<div class='col-sm-10'>"+
                      "<button type='submit' class='btn btn-block btn-primary'>Concluir</button>"+
                    "</div>";
                      //Swal.fire('ATENÇÃO, SE FOR LANÇAR O CONTEÚDO PARA MAIS DE UMA TURMA AO MESMO TEMPO, FIQUE ATENTO A DATA DE REGISTRO, POIS O CONTEÚDO A SER CADASTRADO NAS OUTRAS TURMAS IRÃO FICAR COM A MESMA DATA.', '', 'info');
                    
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
                          "<button type='submit' class='btn btn-block btn-primary' >Concluir</button>"+
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


function lista_avaliacao_aluno_por_data() {
    document.getElementById("listagem_avaliacao").innerHTML="";
    document.getElementById("botao_continuar").innerHTML="";

}



function lista_avaliacao_aluno_por_data(){

  var botao_continuar = document.getElementById("botao_continuar");
  var result = document.getElementById("listagem_avaliacao");
  var xmlreq = CriaRequest();   

  var idserie = document.getElementById("idserie").value;
  var idescola = document.getElementById("idescola").value;
  var idturma = document.getElementById("idturma").value;
  var iddisciplina = document.getElementById("iddisciplina").value;
  var idperiodo = document.getElementById("periodo").value;
 

   if ( idperiodo !="" &&  iddisciplina !=""  ) {
        result.innerHTML="<center><img src='imagens/carregando.gif'></center>";
          var url="idserie="+idserie+"&idperiodo="+idperiodo+"&idescola="+idescola+"&idturma="+idturma+"&iddisciplina="+iddisciplina;
           xmlreq.open("GET", "../Controller/Lista_avaliacao_aluno_por_data.php?"+url, true);
            xmlreq.onreadystatechange = function(){      
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                        result.innerHTML =  xmlreq.responseText;
                        botao_continuar.innerHTML=""+
                        "<div class='col-sm-1'></div>"+
                        "<div class='col-sm-10'>"+
                          "<button type='submit' id='btn_diario_avaliacao' class='btn btn-block btn-primary'  onclick='enviar_notas();'>Concluir</button>"+
                        "</div>";
                        
                    }else{
                           result.innerHTML = xmlreq.responseText;
                        
                        
                    }
                }
            };
        xmlreq.send(null);
  

    }else{
        
             Swal.fire({
                      icon: 'info',
                      title: 'Atenção...',
                      text: 'Selecione o período e a disciplina!',
                      showConfirmButton: false,
                      timer: 2000
                      
                    });
 
    }
}



function enviar_notas(){

  var botao_continuar = document.getElementById("botao_continuar");
  var iddisciplina = document.getElementById("iddisciplina").value;
  var idperiodo = document.getElementById("periodo").value;
 

   if ( idperiodo !="" &&  iddisciplina !=""  ) {
        aguarde_acao(60000);bloquear_botao();
  
    }else{
        
             Swal.fire({
                      icon: 'info',
                      title: 'Atenção...',
                      text: 'Selecione o período e a disciplina!',
                      showConfirmButton: false,
                      timer: 2000
                      
                    });
 
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


function lista_turma_escola_por_serie(campo_listagem){
  var result = document.getElementById(campo_listagem);
  var quantidade_vagas_restante = document.getElementById("quantidade_vagas_restante");
   if (!!document.getElementById('lista_de_turmas_rematricula')) {
        var turma_id =0;
    }else{
        var turma_id =document.getElementById('lista_de_turmas_rematricula').value;
            
    }

  if (campo_listagem=="turmas") {
    var escola_id = document.getElementById("rematricula_escola_id").value;
    var id = document.getElementById("idserie").value;
    var turno = document.getElementById("turno").value;

  }else if (campo_listagem=='troca_turma') {
    var escola_id = document.getElementById("rematricula_escola_id").value;
    var id = document.getElementById("troca_turma_serie_id").value;
    var turno = document.getElementById("troca_turma_turno").value;

  }else{
      var escola_id = document.getElementById("rematricula_escola_id").value;
      var id = document.getElementById("rematricula_nova_serie").value;
      var turno = document.getElementById("rematricula_turno").value;


  }
  var xmlreq = CriaRequest();   
  // result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/Lista_de_turmas_por_escola_serie.php?turma_id="+turma_id+"&rematricula=sim&turno="+turno+"&escola_id="+escola_id+"&serie_id="+id, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                var recebe =xmlreq.responseText;

                var vetor=recebe.split("|#|");
                 quantidade_vagas_restante.value=0;                 
                result.innerHTML =  vetor[0];
                // result.innerHTML =  xmlreq.responseText;
                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}

function pesquisar_por_nome_carteirinha_escola(){

 
  var nome_aluno = document.getElementById("nome_aluno").value;
  var result = document.getElementById("resultado_carteirinha");
   

  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/Pesquisar_por_nome_carteirinha_escola.php?nome_aluno="+nome_aluno, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                var recebe =xmlreq.responseText;
                result.innerHTML =  xmlreq.responseText;

                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}
function lista_carteirinha_escola(){

  var idescola = document.getElementById("idescola").value;
  var idturma = document.getElementById("turma_carterinha").value;
  var result = document.getElementById("resultado_carteirinha");
   

  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/Lista_carteirinha_escola.php?idescola="+idescola+"&idturma="+idturma, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                var recebe =xmlreq.responseText;
                result.innerHTML =  xmlreq.responseText;

                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}


function lista_turma_escola_por_serie_escola_individual(idaluno){
  var quantidade_vagas_restante = document.getElementById("quantidade_vagas_restante"+idaluno);
  var result = document.getElementById("lista_de_turmas_rematricula"+idaluno);
   
      var escola_id = document.getElementById("rematricula_escola_id"+idaluno).value;
      var id = document.getElementById("rematricula_nova_serie"+idaluno).value;
      var turno = document.getElementById("rematricula_turno"+idaluno).value;
      var turma_id = document.getElementById("lista_de_turmas_rematricula"+idaluno).value;

  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/Lista_de_turmas_cadastrada_por_escola_serie_cadastro_aluno.php?turma_id="+turma_id+"&rematricula=sim&turno="+turno+"&escola_id="+escola_id+"&serie_id="+id, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                var recebe =xmlreq.responseText;

                var vetor=recebe.split("|#|");
                 quantidade_vagas_restante.value=0;                 
                 result.innerHTML =  vetor[0];
                // result.innerHTML =  xmlreq.responseText;
                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}


function quantidade_vaga_turma(campo_listagem){
    var result = document.getElementById(campo_listagem);

    var turma_id =document.getElementById('lista_de_turmas_rematricula').value;
     if (campo_listagem=='troca_turma') {    
        var quantidade_vagas_restante = document.getElementById("quantidade_vagas_restante_troca_turma");
        var turma_id =document.getElementById('lista_de_turmas_troca_turma').value;

    }else{
        var turma_id =document.getElementById('lista_de_turmas_rematricula').value;
        var quantidade_vagas_restante = document.getElementById("quantidade_vagas_restante");

    }

  if (campo_listagem=="turmas") {
    var escola_id = document.getElementById("rematricula_escola_id").value;
    var id = document.getElementById("idserie").value;
    var turno = document.getElementById("turno").value;

  }else if (campo_listagem=='troca_turma') {
    var escola_id = document.getElementById("rematricula_escola_id").value;
    var id = document.getElementById("troca_turma_serie_id").value;
    var turno = document.getElementById("troca_turma_turno").value;

  }else{
      var escola_id = document.getElementById("rematricula_escola_id").value;
      var id = document.getElementById("rematricula_nova_serie").value;
      var turno = document.getElementById("rematricula_turno").value;


  }
  var xmlreq = CriaRequest();   

   xmlreq.open("GET", "../Controller/Lista_de_turmas_por_escola_serie.php?turma_id="+turma_id+"&rematricula=sim&turno="+turno+"&escola_id="+escola_id+"&serie_id="+id, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                var recebe =xmlreq.responseText;

                var vetor=recebe.split("|#|");
                quantidade_vagas_restante.value=vetor[2];                 
                // result.innerHTML =  vetor[0];
                // result.innerHTML =  xmlreq.responseText;
                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}


function lista_turma_cadastrada_escola_por_serie(campo_listagem){
  var result = document.getElementById(campo_listagem);
  var escola_id = document.getElementById("escola").value;
  var id = document.getElementById("idserie").value;
  var turno = document.getElementById("turno").value;

  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/Lista_de_turmas_cadastrada_por_escola_serie.php?turno="+turno+"&escola_id="+escola_id+"&serie_id="+id, true);
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



function remover_turma_escola(id){
    var tabela = document.getElementById('tabela');
    var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Excluir_turma_escola.php?id="+id, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                   //result.innerHTML = xmlreq.responseText;

             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                //result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
        };
     xmlreq.send(null);
    lista_turma_cadastrada_escola_por_serie('tabela');
}


function adicionar_turma_escola(){

    var tabela = document.getElementById('tabela');
    var escola=document.getElementById('escola').value;
    var turno=document.getElementById('turno').value;
    var serie=document.getElementById('idserie').value;
    var turma=document.getElementById('idturma').value;
    var ano=document.getElementById('ano').value;
    var vagas =document.getElementById('quantidade_vaga').value;

    
    if (escola=="" || turno =="" || serie =="" || turma=="" || ano=="" || vagas=="") {
        Swal.fire({
          icon: 'info',
          title: 'Atenção...',
          text: 'Preencha todos os campos!',
          showConfirmButton: false,
          timer: 1500
        });

    }else{
            var xmlreq = CriaRequest(); 
            xmlreq.open("GET", "../Controller/Cadastrar_turma_escola.php?escola="+escola+"&turno="+turno+"&serie="+serie+"&turma="+turma+"&ano="+ano+"&quantidade_vaga="+vagas, true);
            xmlreq.onreadystatechange = function(){      
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {                
                             
                        if (xmlreq.responseText=='certo') {
                            document.getElementById('idturma').value = "";
                            document.getElementById('quantidade_vaga').value = "";

                            lista_turma_cadastrada_escola_por_serie('tabela');
                             Swal.fire({
                              icon: 'success',
                              title: 'Ação concluída',
                              text: '',
                              showConfirmButton: false,
                              timer: 1500
                            });
                        }else{
                             Swal.fire({
                              icon: 'error',
                              title: 'Atenção...',
                              text: xmlreq.responseText,
                              showConfirmButton: true,
                            
                            });
                        }

                    }else{
                          
                        alert('Verifique sua conexão com a internet!');
                        
                    }
                }
            };
            xmlreq.send(null);
            lista_turma_cadastrada_escola_por_serie('tabela');

    }

}

function alterar_valor_vagas(id,escola_id,ano_letivo_vigente,idturma,quantidade_vaga,valor){
    if (valor==0) {
        valor=-1;

    }else{
        valor=1;
    }

    var vagas = document.getElementById('quantidade'+id);
    
    var xmlreq = CriaRequest(); 
    xmlreq.open("GET", "../Controller/Alterar_vagas.php?escola="+escola_id+"&id="+id+"&turma="+idturma+"&ano="+ano_letivo_vigente+"&valor="+valor, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {                
                     
                vagas.innerHTML=xmlreq.responseText;
            
               Swal.fire({
                icon: 'success',
                title: 'Ação concluída',
                text: '',
                showConfirmButton: false,
                timer: 1500
              });

            }else{
                  
                alert('Verifique sua conexão com a internet!');
                
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

//
function alterar_status_questionario_simulado(id,status) {
  Swal.fire({
    title: 'Deseja continuar com essa ação?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      window.location.href = "../Controller/Alterar_status_questionario_simulado.php?id="+id+"&status="+status+"";
    } else if (result.isDenied) {
     // Swal.fire('Ação cancelada', '', 'info')
    }
  })
}


//
function alterar_status_questionario(id,status) {
  Swal.fire({
    title: 'Deseja continuar com essa ação?',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      window.location.href = "../Controller/Alterar_status_questionario.php?id="+id+"&status="+status+"";
    } else if (result.isDenied) {
     // Swal.fire('Ação cancelada', '', 'info')
    }
  })
}



//
function excluir_questionario(id) {
  Swal.fire({
    title: 'Deseja continuar com a EXCLUSÃO?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      //window.location.href = "../Controller/Excluir_questionario.php?id="+id;
   
   var xmlreq = CriaRequest();   
   xmlreq.open("GET", "../Controller/Excluir_questionario.php?id="+id, true);
   xmlreq.onreadystatechange = function(){             
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                if (xmlreq.responseText !="erro") {
                    document.getElementById("linha"+id).innerHTML=xmlreq.responseText;

                    Swal.fire('Ação concluída', '', 'success');
                }else{
                    Swal.fire('Verifique sua conexão com a internet', '', 'error');

                   // alert('Verifique sua conexão com a internet!');
                    
                 }
               // alert('Ação concluída com sucesso!');                                             
                
            }else{
                Swal.fire('Verifique sua conexão com a internet', '', 'error');

               // alert('Verifique sua conexão com a internet!');
                
            }
        }
    };
    xmlreq.send(null);


    } else if (result.isDenied) {
      //Swal.fire('Ação cancelada', '', 'info')
    }
  })
}



//
function excluir_nota_duplicada(id) {
  Swal.fire({
    title: 'Deseja continuar com a EXCLUSÃO dessa nota? Favor deixar ao menos uma nota sem excluir!',
    showDenyButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      //window.location.href = "../Controller/Excluir_questionario.php?id="+id;
   
   var xmlreq = CriaRequest();   
   xmlreq.open("GET", "../Controller/Excluir_nota_duplicada.php?id="+id, true);
   xmlreq.onreadystatechange = function(){             
        if (xmlreq.readyState == 4){
            if (xmlreq.status == 200) {
                if (xmlreq.responseText !="erro") {
                    document.getElementById("nota_excluir"+id).innerHTML='';
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Ação Concluída',
                       text: '',
                    showConfirmButton: false,
                    timer: 1500
                  });
                  
                }else{
                    Swal.fire('Verifique sua conexão com a internet', '', 'error');
                   // alert('Verifique sua conexão com a internet!');     
                 }
               // alert('Ação concluída com sucesso!');                                             
                
            }else{
                //Swal.fire('Verifique sua conexão com a internet', '', 'error');

                alert('Verifique sua conexão com a internet!'+id);
                
            }
        }
    };
    xmlreq.send(null);


    } else if (result.isDenied) {
      //Swal.fire('Ação cancelada', '', 'info')
    }
  })
}



//
function excluir_questionario_simulado(id) {
  Swal.fire({
    title: 'Deseja continuar com a EXCLUSÃO?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      //window.location.href = "../Controller/Excluir_questionario.php?id="+id;
   
   var xmlreq = CriaRequest();   
   xmlreq.open("GET", "../Controller/Excluir_questionario_simulado.php?id="+id, true);
   xmlreq.onreadystatechange = function(){             
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                if (xmlreq.responseText !="erro") {
                    document.getElementById("linha"+id).innerHTML=xmlreq.responseText;

                    Swal.fire('Ação não concluída', '', 'success');
                }else{
                    Swal.fire('Verifique sua conexão com a internet', '', 'error');

                   // alert('Verifique sua conexão com a internet!');
                    
                 }
               // alert('Ação concluída com sucesso!');                                             
                
            }else{
                Swal.fire('Verifique sua conexão com a internet', '', 'error');

               // alert('Verifique sua conexão com a internet!');
                
            }
        }
    };
    xmlreq.send(null);


    } else if (result.isDenied) {
      //Swal.fire('Ação cancelada', '', 'info')
    }
  })
}


//
function excluir_questao(id) {
  Swal.fire({
    title: 'Deseja continuar com a EXCLUSÃO?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      //window.location.href = "../Controller/Excluir_questionario.php?id="+id;
   
   var xmlreq = CriaRequest();   
   xmlreq.open("GET", "../Controller/Excluir_questao.php?id="+id, true);
   xmlreq.onreadystatechange = function(){             
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                if (xmlreq.responseText !="erro") {
                    document.getElementById("linha"+id).innerHTML=xmlreq.responseText;

                    Swal.fire('Ação não concluída', '', 'success');
                }else{
                    Swal.fire('Verifique sua conexão com a internet', '', 'error');

                   // alert('Verifique sua conexão com a internet!');
                    
                 }
               // alert('Ação concluída com sucesso!');                                             
                
            }else{
                Swal.fire('Verifique sua conexão com a internet', '', 'error');

               // alert('Verifique sua conexão com a internet!');
                
            }
        }
    };
    xmlreq.send(null);


    } else if (result.isDenied) {
      //Swal.fire('Ação cancelada', '', 'info')
    }
  })
}//


function excluir_questao_simulado(id) {
  Swal.fire({
    title: 'Deseja continuar com a EXCLUSÃO?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Sim`,
    denyButtonText: `Não`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      //window.location.href = "../Controller/Excluir_questionario.php?id="+id;
   
   var xmlreq = CriaRequest();   
   xmlreq.open("GET", "../Controller/Excluir_questao_simulado.php?id="+id, true);
   xmlreq.onreadystatechange = function(){             
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                if (xmlreq.responseText !="erro") {
                    document.getElementById("linha"+id).innerHTML=xmlreq.responseText;

                    Swal.fire('Ação não concluída', '', 'success');
                }else{
                    Swal.fire('Verifique sua conexão com a internet', '', 'error');

                   // alert('Verifique sua conexão com a internet!');
                    
                 }
               // alert('Ação concluída com sucesso!');                                             
                
            }else{
                Swal.fire('Verifique sua conexão com a internet', '', 'error');

               // alert('Verifique sua conexão com a internet!');
                
            }
        }
    };
    xmlreq.send(null);


    } else if (result.isDenied) {
      //Swal.fire('Ação cancelada', '', 'info')
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








 function resultado_questao_simulado() {

    var result = document.getElementById("resultado_questao");
    var paginacao = document.getElementById("paginacao").style.display = "block";
    //result.innerHTML="<img src='imagens/carregando.gif'>";
aguarde();
    var questionario = document.getElementById("questionario").value;
    var aluno = document.getElementById("aluno").value;
    var escola_id = document.getElementById("escola_id").value;
    var serie_id = document.getElementById("serie_id").value;

    // var indice = document.getElementById("indice").value;
    var indice = document.getElementById("indice");

    var pagina=parseInt(indice.value);
    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Lista_aluno_baixar_simulado.php?indice="+pagina+"&serie_id="+serie_id+"&escola_id="+escola_id+"&aluno="+aluno+"&questionario="+questionario, true);


    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 result.innerHTML +=  xmlreq.responseText;
                 indice.value=parseInt(pagina)+50;
                 
             }else{

                alert('Erro, verifique sua conexão com a internet');
                 
             }
         }
     };
     xmlreq.send(null);
 }



 function resultado_questao() {

    var result = document.getElementById("resultado_questao");
    result.innerHTML="<img src='imagens/carregando.gif'>";

    var questionario = document.getElementById("questionario").value;
    var aluno = document.getElementById("aluno").value;
    
    var disciplina_id = document.getElementById("disciplina_id").value;
    var turma_id = document.getElementById("turma_id").value;
    var escola_id = document.getElementById("escola_id").value;


    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Lista_aluno_baixar_prova.php?escola_id="+escola_id+"&aluno="+aluno+"&questionario="+questionario+"&disciplina_id="+disciplina_id+"&turma_id="+turma_id, true);


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

                if (xmlreq.responseText =="certo") {
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

            }else{
                alert("ERRO, POR FAVOR, VERIFIQUE SUA CONEXÃO COM A INTERNET !");
            }


          }
      };
      xmlreq.send(null);
  } 
  

function resposta_multipla_professor(id) {
    var origem_questionario_id =  document.getElementById('origem_questionario_id').value;
    var texto_alternativa =  document.getElementById('alternativa'+id).value;
    var xmlreq = CriaRequest();
    xmlreq.open("GET", "../Controller/Responder_questionario_discursiva_professor.php?origem_questionario_id="+origem_questionario_id+"&id="+id+"&texto_alternativa="+texto_alternativa, true);
    xmlreq.onreadystatechange = function(){
       
          if (xmlreq.readyState == 4) {
              if (xmlreq.status == 200) {
                if (xmlreq.responseText=="certo") {
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
          else{
            alert("Erro, verifique sua conexão com a internet!");
            }
        }
    };
      xmlreq.send(null);
  } 
  

  

function resposta_multipla_professor_simulado(id) {
    var origem_questionario_id =  document.getElementById('origem_questionario_id').value;
    var texto_alternativa =  document.getElementById('alternativa'+id).value;
    var link_erro =  document.getElementById('link'+id);
    var questao_alternativa =  document.getElementById('questao_alternativa'+id).value;
    var xmlreq = CriaRequest();
    xmlreq.open("GET", "../Controller/Responder_questionario_discursiva_professor_simulado.php?questao_alternativa="+questao_alternativa+"&origem_questionario_id="+origem_questionario_id+"&id="+id+"&texto_alternativa="+texto_alternativa, true);
    xmlreq.onreadystatechange = function(){
       
          if (xmlreq.readyState == 4) {
              if (xmlreq.status == 200) {
                if (xmlreq.responseText=="certo") {
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
          else{
            alert("Erro, verifique sua conexão com a internet!");
            link_erro.innerHTML="Ocorreu um erro, acesse o link abaixo, vai aparecer uma mensagem (CERTO) <BR> <a target='_blank' href='../Controller/Responder_questionario_discursiva_professor_simulado.php?questao_alternativa="+questao_alternativa+"&origem_questionario_id="+origem_questionario_id+"&id="+id+"&texto_alternativa="+texto_alternativa+"'> Clique aqui para Marcar essa questão</a>";
            }
        }
    };
      xmlreq.send(null);
  } 
  

function resposta_multipla_simulado(id,questao_id) {
    var origem_questionario_id = "";
    var texto_alternativa =  "";
    var questao_id =  document.getElementById('questao_id'+questao_id).value;
    var xmlreq = CriaRequest();
    xmlreq.open("GET", "../Controller/Responder_questionario_discursiva_simulado.php?texto=&questao_id="+questao_id+"&idalternativa="+id+"&texto_alternativa="+texto_alternativa, true);
    xmlreq.onreadystatechange = function(){
       
          if (xmlreq.readyState == 4) {
              if (xmlreq.status == 200) {
                if (xmlreq.responseText=="certo") {
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
          else{
            alert("Erro, verifique sua conexão com a internet!");
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

      // numbersList.forEach((number, index, array) => {
      //   myHTML += `<li>${number}</li>`;
      // });


      xmlreq.open("GET", "../Controller/Responder_questionario_discursiva.php?texto="+texto+"&id="+idalternativa+"&disciplina_id="+disciplina_id+"&turma_id="+turma_id+"&questao_id="+questao_id, true);
      
      xmlreq.onreadystatechange = function(){
       
          if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {

                if (xmlreq.responseText=="certo") {
                  // Swal.fire({
                  //   position: 'center',
                  //   icon: 'success',
                  //   title: 'Ação Concluída',
                  //   showConfirmButton: false,
                  //   timer: 1500
                  // });
                  
                }else{
                //  Swal.fire({
                //   icon: 'error',
                //   title: 'Oops...',
                //   text: 'Alguma Coisa deu Errado!',
                  
                // });
                  
              }
            }
            else{
             alert("Erro, verifique sua conexão com a internet!");
            }
        }

      };
      xmlreq.send(null);
  }

  
  


  function resposta_justificada_simulado(id) {
     
     var idalternativa =id;
    var result = document.getElementById("rd"+id);
     

    var turma_id= document.getElementById('idturma').value;
    var disciplina_id =  document.getElementById('iddisciplina').value;
     
    var questao_id =  document.getElementById('questao_id'+id).value;

     var texto = document.getElementById(id).value;
      var xmlreq = CriaRequest();

      // numbersList.forEach((number, index, array) => {
      //   myHTML += `<li>${number}</li>`;
      // });


      xmlreq.open("GET", "../Controller/Responder_questionario_discursiva_professor_simulado.php?texto="+texto+"&id="+idalternativa+"&disciplina_id="+disciplina_id+"&turma_id="+turma_id+"&questao_id="+questao_id, true);
      
      xmlreq.onreadystatechange = function(){
       
          if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {

                if (xmlreq.responseText=="certo") {
                  // Swal.fire({
                  //   position: 'center',
                  //   icon: 'success',
                  //   title: 'Ação Concluída',
                  //   showConfirmButton: false,
                  //   timer: 1500
                  // });
                  
                }else{
                //  Swal.fire({
                //   icon: 'error',
                //   title: 'Oops...',
                //   text: 'Alguma Coisa deu Errado!',
                  
                // });
                  
              }
            }
            else{
             alert("Erro, verifique sua conexão com a internet!");
            }
        }

      };
      xmlreq.send(null);
  }

  
  
function alterar_data_questionario(id) {
    var data = document.getElementById("data"+id).value;
    var data_fim = document.getElementById("data_fim"+id).value;
    var result = document.getElementById("resposta_alteracao_data"+id);
    
    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Alterar_data_questionario.php?id="+id+"&data="+data+"&data_fim="+data_fim, true);

    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 //alert('Data alterada');
                 if (xmlreq.responseText =="certo") {
                     result.innerHTML =  "Ação concluída!";
                 }else{
                alert('verifique sua conexão com a internet!');
                // Swal.fire({
                //   icon: 'error',
                //   title: 'Oops...',
                //   text: 'Alguma Coisa deu Errado!',
                  
                // });
             }
                 
             }else{
                alert('verifique sua conexão com a internet!');
                // Swal.fire({
                //   icon: 'error',
                //   title: 'Oops...',
                //   text: 'Alguma Coisa deu Errado!',
                  
                // });
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


  
  
function alterar_data_simulado(id) {
    var data = document.getElementById("data"+id).value;
    var data_fim = document.getElementById("data_fim"+id).value;
    var result = document.getElementById("resposta_alteracao_data"+id);
    
    var xmlreq = CriaRequest();   
    xmlreq.open("GET", "../Controller/Alterar_data_simulado.php?id="+id+"&data="+data+"&data_fim="+data_fim, true);

    xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 //alert('Data alterada');
                 if (xmlreq.responseText =="certo") {
                     result.innerHTML =  "Ação concluída!";
                 }else{
                alert('verifique sua conexão com a internet!');
                // Swal.fire({
                //   icon: 'error',
                //   title: 'Oops...',
                //   text: 'Alguma Coisa deu Errado!',
                  
                // });
             }
                 
             }else{
                alert('verifique sua conexão com a internet!');
                // Swal.fire({
                //   icon: 'error',
                //   title: 'Oops...',
                //   text: 'Alguma Coisa deu Errado!',
                  
                // });
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


  function bloquear_botao(){
    setTimeout(function () {
        document.getElementById('btn_diario_avaliacao').disabled = true;
        // body...
    },1000);

  }
  function aguarde_acao(tempo){
         let timerInterval
         Swal.fire({
           title: 'Aguarde, sua ação está sendo realizada!',
           html: ' ',
           timer: tempo,
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

  function aguarde_tempo_dinamico_simulado(id){
         let timerInterval
         Swal.fire({
           title: 'Aguarde, sua ação está sendo realizada!',
            html: '<b></b> ',
           timer: 10000,
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
           
           Swal.fire({
             title: 'BOM TRABALHO 👏👏',
             text:'ESCOLHA UMA OPÇÃO ',
             showDenyButton: true,
             confirmButtonText: `ENTREGAR SIMULADO`,
             denyButtonText: `EDITAR RESPOSTAS`,

             imageUrl: 'sucesso.gif',
             imageAlt: 'Obrigado',
             imageWidth: 400,
             imageHeight: 200

           }).then((result) => {
             /* Read more about isConfirmed, isDenied below */
             if (result.isConfirmed) {
               window.location.href ='aluno.php?simulado_id='+id;

             } else if (result.isDenied) {
               window.refresh();
              

             }
           })
           


           }
         }).then((result) => {
           /* Read more about handling dismissals below */
           if (result.dismiss === Swal.DismissReason.timer) {
             console.log('I was closed by the timer')
           }
         })
   }



  function aguarde_tempo_dinamico(id){
         let timerInterval
         Swal.fire({
           title: 'Aguarde, sua ação está sendo realizada!',
            html: '<b></b> ',
           timer: 10000,
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
           
           Swal.fire({
             title: 'BOM TRABALHO 👏👏',
             text:'ESCOLHA UMA OPÇÃO ',
             showDenyButton: true,
             confirmButtonText: `ENTREGAR PROVA`,
             denyButtonText: `EDITAR RESPOSTAS`,

             imageUrl: 'sucesso.gif',
             imageAlt: 'Obrigado',
             imageWidth: 400,
             imageHeight: 200

           }).then((result) => {
             /* Read more about isConfirmed, isDenied below */
             if (result.isConfirmed) {
               window.location.href ='aluno.php?idquestionario='+id;

             } else if (result.isDenied) {
               window.refresh();
              

             }
           })
           


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


 function listar_turma_escola_relatorio() {
    var result = document.getElementById("idturma");
    var idescola = document.getElementById("idescola").value;
    var xmlreq = CriaRequest();   
    result.innerHTML="<img src='imagens/carregando.gif'>";
    xmlreq.open("GET", "../Controller/Listar_turma_escola_carterinha.php?idescola="+idescola, true);


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



 function listar_turma_escola_relatorio_faltas() {
    var result = document.getElementById("resultado");
    var idescola = document.getElementById("idescola").value;
    var xmlreq = CriaRequest();   
    result.innerHTML="<img src='imagens/carregando.gif'>";
    xmlreq.open("GET", "../Controller/Listar_turma_relatorio_rendimento.php?idescola="+idescola, true);


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




 function listar_turma_escola_carterinha() {
    var result = document.getElementById("turma_carterinha");
    var idescola = document.getElementById("idescola").value;
    var xmlreq = CriaRequest();   
    result.innerHTML="<img src='imagens/carregando.gif'>";
    xmlreq.open("GET", "../Controller/Listar_turma_escola_carterinha.php?idescola="+idescola, true);


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

 function listar_turmas_por_serie(idserie) {
    var result = document.getElementById("turmas");
    var xmlreq = CriaRequest();   
    result.innerHTML="<img src='imagens/carregando.gif'>";
    xmlreq.open("GET", "../Controller/Listar_turmas_por_serie.php?idserie="+idserie, true);


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



 // ##############################################################VML
 

function lista_turma_escola_por_serie_cadatro_aluno(){

   
   var result = document.getElementById("idturma");
   var quantidade_vagas_restante = document.getElementById("quantidade_vagas_restante");
 
    var escola_id = document.getElementById("escola").value;
    var idserie = document.getElementById("idserie").value;
    var turno = document.getElementById("turno").value;
    var turma_id = document.getElementById("idturma").value;

    var etapa = document.getElementById("etapa").innerHTML='';

  var xmlreq = CriaRequest();   
  result.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/Lista_de_turmas_cadastrada_por_escola_serie_cadastro_aluno.php?turma_id="+turma_id+"&rematricula=não&turno="+turno+"&escola_id="+escola_id+"&serie_id="+idserie, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                var recebe =xmlreq.responseText;

                var vetor=recebe.split("|#|");
                 quantidade_vagas_restante.value=0;                 
                result.innerHTML =  vetor[0];
                // result.innerHTML =  xmlreq.responseText;
                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}


function quantidade_vaga_turma_cadastro_aluno(){

   
   var result = document.getElementById("idturma");
   var quantidade_vagas_restante = document.getElementById("quantidade_vagas_restante");
 
    var escola_id = document.getElementById("escola").value;
    var idserie = document.getElementById("idserie").value;
    var turno = document.getElementById("turno").value;
    var turma_id = document.getElementById("idturma").value;


  var xmlreq = CriaRequest();   
  // quantidade_vagas_restante.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/Quantidade_vaga_turma.php?turma_id="+turma_id+"&rematricula=não&turno="+turno+"&escola_id="+escola_id+"&serie_id="+idserie, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                var recebe =xmlreq.responseText;

                var vetor=recebe.split("|#|");
                 quantidade_vagas_restante.value=0;                 
                 quantidade_vagas_restante.value =  vetor[1];
                // result.innerHTML =  xmlreq.responseText;
                
            }else{
                   quantidade_vagas_restante.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}

function quantidade_vaga_turma_rematricula_individual(idaluno){

   
   var result = document.getElementById("idturma");
   var quantidade_vagas_restante = document.getElementById("quantidade_vagas_restante"+idaluno);

    var escola_id = document.getElementById("rematricula_escola_id"+idaluno).value;
    var idserie = document.getElementById("rematricula_nova_serie"+idaluno).value;
    var turno = document.getElementById("rematricula_turno"+idaluno).value;
    var turma_id = document.getElementById("lista_de_turmas_rematricula"+idaluno).value;

  var xmlreq = CriaRequest();   
  // quantidade_vagas_restante.innerHTML="<center><img src='imagens/carregando.gif'></center>";

   xmlreq.open("GET", "../Controller/Quantidade_vaga_turma.php?turma_id="+turma_id+"&rematricula=não&turno="+turno+"&escola_id="+escola_id+"&serie_id="+idserie, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                var recebe =xmlreq.responseText;

                var vetor=recebe.split("|#|");
                 quantidade_vagas_restante.value=0;                 
                 quantidade_vagas_restante.value =  vetor[1];
                // result.innerHTML =  xmlreq.responseText;
                
            }else{
                   quantidade_vagas_restante.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}


function rematricular_aluno_individual(idaluno){

       setTimeout(function () {
        document.getElementById('botao_continuar').disabled = true;
        // body...
    },10);

  var turma_id_anterior=document.getElementById("turma_id_anterior"+idaluno).value;
  var quantidade_vagas_restante=document.getElementById("quantidade_vagas_restante"+idaluno).value;
  var turma_id=document.getElementById("lista_de_turmas_rematricula"+idaluno).value;
  var rematricula_nova_serie=document.getElementById("rematricula_nova_serie"+idaluno).value;
  var rematricula_serie_id=document.getElementById("rematricula_serie_id"+idaluno).value;
  var turma_escola=document.getElementById("rematricula_escola_id"+idaluno).value;
  var turno_nome=document.getElementById("rematricula_turno"+idaluno).value;
  var matricula=document.getElementById("matricula_aluno"+idaluno).value;

  var xmlreq = CriaRequest();   
    var url="turma_id_anterior="+turma_id_anterior;
    url+="&quantidade_vagas_restante="+quantidade_vagas_restante;

    url+="&matricula="+matricula;
    url+="&idaluno="+idaluno;
    url+="&turma_id="+turma_id;
    url+="&rematricula_nova_serie="+rematricula_nova_serie;
    url+="&rematricula_serie_id="+rematricula_serie_id;
    url+="&turma_escola="+turma_escola;
    url+="&turno_nome="+turno_nome;

   xmlreq.open("GET", "../Controller/Rematricular_aluno_individual.php?"+url, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                
                if (xmlreq.responseText=="Ação Concluída") {
                   Swal.fire({
                     position: 'center',
                     icon: 'success',
                     title: 'Ação Concluída',
                        text: ' ',
                     showConfirmButton: false,
                     timer: 2500
                   });

                    setTimeout(function () {
                       document.getElementById('botao_continuar').disabled = false;
                       // body...
                   },1000);

                }else{
                        Swal.fire({
                       position: 'center',
                       icon: 'info',
                       title: 'Atenção',
                          text: ''+xmlreq.responseText,
                       showConfirmButton: true
                     });
                }

            }else{
                 alert("Erro desconhecido");  
            }
        }
    };
    xmlreq.send(null);
}


function excluir_aluno(idaluno){
  var result=document.getElementById("linha"+idaluno);
  var xmlreq = CriaRequest();   
  var url="idaluno="+idaluno;
   xmlreq.open("GET", "../Controller/Excluir_aluno.php?"+url, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                
                if (xmlreq.responseText=="Ação concluída") {
                   Swal.fire({
                     position: 'center',
                     icon: 'success',
                     title: 'Ação concluída',
                        text: ' ',
                     showConfirmButton: false,
                     timer: 2500
                   });

                   if (result.parentNode) {
                     result.parentNode.removeChild(result);
                   }

                }else{
                        Swal.fire({
                       position: 'center',
                       icon: 'info',
                       title: 'Alguma coisa deu errado',
                          text: ''+xmlreq.responseText,
                       showConfirmButton: true
                     });
                }

            }else{
                 alert("Erro desconhecido");  
            }
        }
    };
    xmlreq.send(null);
}


function excluir_aluno_matriculado(idaluno) {
   
    var matricula = document.getElementById("matricula"+idaluno).value;
    var xmlreq = CriaRequest();   
   

   Swal.fire({
     title: 'Tem certeza que deseja excluir ?',
     showDenyButton: true,
     confirmButtonText: `Sim`,
     denyButtonText: `Não`,
   }).then((result) => {
     /* Read more about isConfirmed, isDenied below */
     if (result.isConfirmed) {

        xmlreq.open("GET", "../Controller/Excluir_aluno_matriculado.php?idaluno="+idaluno+"&matricula="+matricula, true);
        xmlreq.onreadystatechange = function(){
          
             if (xmlreq.readyState == 4) {
                 if (xmlreq.status == 200) {
                    // result.innerHTML = xmlreq.responseText;
                     if(xmlreq.responseText=="Ação concluída"){
                        Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: 'Ação concluída!',
                             text: ' ',
                          showConfirmButton: false,
                          timer: 1500
                        });

                       var node = document.getElementById("linha"+idaluno);
                       if (node.parentNode) {
                         node.parentNode.removeChild(node);
                       }


                     }else{
                        Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: 'Alguma coisa deu errado',
                             text: '',
                          showConfirmButton: true
                        });
                     }

                 }else{
                    alert('Erro desconhecido, verifique sua conexão com a internet');

                    //result.innerHTML ="Erro ao receber mensagens";                 
                 }
             }
         };
         xmlreq.send(null);

      } else if (result.isDenied) {
      }

    });
}






function excluir_conteudo(excluir_conteudo,idconteudo){
  
  console.log(excluir_conteudo+"=t="+idconteudo);
     Swal.fire({
     title: 'Tem certeza que deseja excluir o conteúdo ?',
     showDenyButton: true,
     confirmButtonText: `Sim`,
     denyButtonText: `Não`,
   }).then((result) => {
     /* Read more about isConfirmed, isDenied below */
     if (result.isConfirmed) {
              var result=document.getElementById("campo_inputs"+excluir_conteudo);
              var xmlreq = CriaRequest();   
              var url="idconteudo="+idconteudo;
               xmlreq.open("GET", "../Controller/Excluir_conteudo.php?"+url, true);
                xmlreq.onreadystatechange = function(){      
                    if (xmlreq.readyState == 4) {
                        if (xmlreq.status == 200) {
                            
                            if (xmlreq.responseText=="Ação concluída") {
                               Swal.fire({
                                 position: 'center',
                                 icon: 'success',
                                 title: 'Ação concluída',
                                    text: ' ',
                                 showConfirmButton: false,
                                 timer: 2500
                               });

                               if (result.parentNode) {
                                 result.parentNode.removeChild(result);
                               }

                            }else{
                                    Swal.fire({
                                   position: 'center',
                                   icon: 'info',
                                   title: 'Alguma coisa deu errado',
                                      text: ''+xmlreq.responseText,
                                   showConfirmButton: true
                                 });
                            }

                        }else{
                             alert("Erro desconhecido");  
                        }
                    }
                };
                xmlreq.send(null);
        } else if (result.isDenied) {
        }

        });
}





function cancelar_rematricula(idaluno) {
   
    var matricula = document.getElementById("matricula"+idaluno).value;
    var xmlreq = CriaRequest();   
   

   Swal.fire({
     title: 'Tem certeza que deseja cancelar a REMATRICULA ?',
     showDenyButton: true,
     confirmButtonText: `Sim`,
     denyButtonText: `Não`,
   }).then((result) => {
     /* Read more about isConfirmed, isDenied below */
     if (result.isConfirmed) {

        xmlreq.open("GET", "../Controller/Cancelar_rematricula.php?idaluno="+idaluno+"&matricula="+matricula, true);
        xmlreq.onreadystatechange = function(){
          
             if (xmlreq.readyState == 4) {
                 if (xmlreq.status == 200) {
                    // result.innerHTML = xmlreq.responseText;
                     if(xmlreq.responseText=="Ação concluída"){
                        Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: 'Ação concluída!',
                             text: ' ',
                          showConfirmButton: false,
                          timer: 1500
                        });

                       var node = document.getElementById("linha"+idaluno);
                       if (node.parentNode) {
                         node.parentNode.removeChild(node);
                       }


                     }else{
                        Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: 'Alguma coisa deu errado',
                             text: '',
                          showConfirmButton: true
                        });
                     }

                 }else{
                    alert('Erro desconhecido, verifique sua conexão com a internet');

                    //result.innerHTML ="Erro ao receber mensagens";                 
                 }
             }
         };
         xmlreq.send(null);

      } else if (result.isDenied) {
      }

    });
}
function cancelar_transferencia(idaluno,matricula) {
   
    
    var xmlreq = CriaRequest();   
   
   Swal.fire({
     title: 'Tem certeza que deseja cancelar a Transferência ?',
     showDenyButton: true,
     confirmButtonText: `Sim`,
     denyButtonText: `Não`,
   }).then((result) => {
     /* Read more about isConfirmed, isDenied below */
     if (result.isConfirmed) {

        xmlreq.open("GET", "../Controller/Cancelar_transferencia.php?idaluno="+idaluno+"&matricula="+matricula, true);
        xmlreq.onreadystatechange = function(){
          
             if (xmlreq.readyState == 4) {
                 if (xmlreq.status == 200) {
                    // result.innerHTML = xmlreq.responseText;
                     if(xmlreq.responseText=="Ação concluída"){
                        Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: 'Ação concluída!',
                             text: ' ',
                          showConfirmButton: false,
                          timer: 1500
                        });

                       // var node = document.getElementById("linha"+idaluno);
                       // if (node.parentNode) {
                       //   node.parentNode.removeChild(node);
                       // }
                         refresh();
                     }else{
                        Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: 'Alguma coisa deu errado',
                             text: '',
                          showConfirmButton: true
                        });
                     }

                 }else{
                    alert('Erro desconhecido, verifique sua conexão com a internet');

                    //result.innerHTML ="Erro ao receber mensagens";                 
                 }
             }
         };
         xmlreq.send(null);

      } else if (result.isDenied) {
      }

    });
}

// #########################################################################


function troca_de_turma_escola_por_serie(){
  var quantidade_vagas_restante = document.getElementById("quantidade_vagas_restante_troca_turma");
  var result = document.getElementById("lista_de_turmas_troca_turma");
   
      var escola_id = document.getElementById("rematricula_escola_id").value;
      var idserie = document.getElementById("troca_turma_serie_id").value;
      var turno = document.getElementById("troca_turma_turno").value;
     
  var xmlreq = CriaRequest();   

   xmlreq.open("GET", "../Controller/Lista_de_turmas_cadastrada_por_escola_serie_cadastro_aluno.php?turma_id=&rematricula=não&turno="+turno+"&escola_id="+escola_id+"&serie_id="+idserie, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                var recebe =xmlreq.responseText;

                var vetor=recebe.split("|#|");
                 quantidade_vagas_restante.value=0;                 
                 result.innerHTML =  vetor[0];
                // result.innerHTML =  xmlreq.responseText;
                
            }else{
                   result.innerHTML = "Erro ao pesquisar";
                
                
            }
        }
    };
    xmlreq.send(null);
}



function editar_aluno(){     
      var formData = new FormData(document.getElementById("form1"));      
      $.ajax({
              type: 'POST',
              url: '../Controller/Editar_aluno.php',
              data: formData,
              contentType: false,
              cache: false,
              processData:false,
              beforeSend: function(){
                    $('#btnSend').attr("disabled","disabled");
                    $('#form1').css("opacity",".5");
              },
              success: function(msg){  
              console.log(msg);               
                  if(msg == 'certo')
                  {
                      $('#form1')[0].reset();
                      
                      Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Ação Concluída',
                           text: ' ',
                        showConfirmButton: false,
                        timer: 3000
                      });
                      setTimeout(function(){window.location.href="pesquisa_aluno.php";},1500);

                  }
                  else
                  {
                      alert('Problemas no envio');
                  }
                  $('#form1').css("opacity","");
                  $("#btnSend").removeAttr("disabled");
              }
          });
    }


  
function mudar_bloqueio_funcionario(campo){
  var status = document.getElementById("status"+campo).value;
  var idcalendario = document.getElementById("idcalendario"+campo).value;
  var idfuncionario = document.getElementById("idfuncionario"+campo).value;
  
  var result = document.getElementById("aguarde"+idcalendario+""+idfuncionario);
  var input = document.getElementById("calendario"+idcalendario+""+idfuncionario);
  var campo_status = document.getElementById("status"+idcalendario+""+idfuncionario);
   
  var xmlreq = CriaRequest();   
  url="status="+status+"&idcalendario="+idcalendario+"&idfuncionario="+idfuncionario;
   xmlreq.open("GET", "../Controller/Mudar_bloqueio_funcionario.php?"+url, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
               result.innerHTML =xmlreq.responseText;
               
               if (status=='1') {
                    campo_status.value='0';
               }else{
                    campo_status.value='1';
               }

            }else{
                alert("Erro, tente novamente");
            }
        }
    };
    xmlreq.send(null);
}


  
function listar_turma_aceita_transferencia(idsolicitacao){
  
  var aceitar_idescola_destino =document.getElementById("aceitar_idescola_destino"+idsolicitacao).value;
  var aceitar_ano_letivo=document.getElementById("aceitar_ano_letivo"+idsolicitacao).value;
  var aceitar_turno=document.getElementById("aceitar_turno"+idsolicitacao).value;
  var aceitar_idserie_destino=document.getElementById("aceitar_idserie_destino"+idsolicitacao).value;
  var vaga_escola=document.getElementById("vaga_escola"+idsolicitacao);
  var aceitar_nova_turma=document.getElementById("aceitar_nova_turma"+idsolicitacao);

  var xmlreq = CriaRequest();   
  url="aceitar_idescola_destino="+aceitar_idescola_destino;
  url+="&aceitar_ano_letivo="+aceitar_ano_letivo;
  url+="&aceitar_turno="+aceitar_turno;
  url+="&idsolicitacao="+idsolicitacao;
  url+="&aceitar_idserie_destino="+aceitar_idserie_destino;

   xmlreq.open("GET", "../Controller/Listar_turma_aceita_transferencia.php?"+url, true);
    xmlreq.onreadystatechange = function(){      
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
               aceitar_nova_turma.innerHTML =xmlreq.responseText;
               vaga_escola.value=0;

            }else{
                alert("Erro, tente novamente");
            }
        }
    };
    xmlreq.send(null);
}




function aceitar_solicitacao_transferencia(form1){     
      var formData = new FormData(document.getElementById("aceita_solicitacao"+form1));      
      $.ajax({
              type: 'POST',
              url: '../Controller/Aceitar_solicitacao_transferencia.php',
              data: formData,
              contentType: false,
              cache: false,
              processData:false,
              beforeSend: function(){
                    $('#btnSendaceita_solicitacao'+form1).attr("disabled","disabled");
                    $('#aceita_solicitacao'+form1).css("opacity",".5");
              },
              success: function(msg){  
              console.log(msg);               
                  if(msg == 'Ação concluída')
                  {
                      $('#aceita_solicitacao'+form1)[0].reset();
                      
                      Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Ação Concluída',
                           text: ' '+msg,
                        showConfirmButton: false,
                        timer: 3000
                      });
                       setTimeout(function(){window.location.href="lista_solicitacao_transferencia.php";},1000);

                  }
                  else
                  {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'ATENÇÃO: '+msg,
                           text: ' ',
                        showConfirmButton: false,
                        timer: 3000
                      });
                  }
                  $('#aceita_solicitacao'+form1).css("opacity","");
                  $("#btnSendaceita_solicitacao"+form1).removeAttr("disabled");
              }
          });
    }



    function rejeitar_solicitacao_transferencia(form1){     
      var formData = new FormData(document.getElementById("rejeita_solicitacao"+form1));      
      var descricao_regeitar_solicitacao =  document.getElementById("descricao_regeitar_solicitacao"+form1).value;      
      
      if (descricao_regeitar_solicitacao.length < 5) {
        Swal.fire({
          position: 'center',
          icon: 'info',
          title: 'ATENÇÃO',
             text: 'Descreva o motivo ',
          showConfirmButton: true
        });

      }else{

      $.ajax({
              type: 'POST',
              url: '../Controller/Rejeitar_solicitacao_transferencia.php',
              data: formData,
              contentType: false,
              cache: false,
              processData:false,
              beforeSend: function(){
                    $('#btnSendrejeita_solicitacao'+form1).attr("disabled","disabled");
                    $('#rejeita_solicitacao'+form1).css("opacity",".5");
              },
              success: function(msg){  
              console.log(msg);               
                  if(msg == 'Ação concluída')
                  {
                      $('#rejeita_solicitacao'+form1)[0].reset();
                      
                      Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Ação Concluída',
                           text: ' '+msg,
                        showConfirmButton: false,
                        timer: 3000
                      });
                       setTimeout(function(){window.location.href="lista_solicitacao_transferencia.php";},1000);

                  }
                  else
                  {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'ATENÇÃO: '+msg,
                           text: ' ',
                        showConfirmButton: false,
                        timer: 3000
                      });
                  }
                  $('#rejeita_solicitacao'+form1).css("opacity","");
                  $("#btnSendrejeita_solicitacao"+form1).removeAttr("disabled");
              }
          });
      }

    }





    function quantidade_vaga_restante_transferencia_turma(idsolicitacao){
        var result = document.getElementById("vaga_escola"+idsolicitacao);
        var xmlreq = CriaRequest();   
        var aceitar_idescola_destino = document.getElementById("aceitar_idescola_destino"+idsolicitacao).value;
        var aceitar_ano_letivo = document.getElementById("aceitar_ano_letivo"+idsolicitacao).value;
        var aceitar_turno = document.getElementById("aceitar_turno"+idsolicitacao).value;
        var aceitar_nova_turma = document.getElementById("aceitar_nova_turma"+idsolicitacao).value;
 
        var url="aceitar_idescola_destino="+aceitar_idescola_destino;
         url+="&aceitar_ano_letivo="+aceitar_ano_letivo;
         url+="&aceitar_turno="+aceitar_turno;
         url+="&aceitar_nova_turma="+aceitar_nova_turma;

       xmlreq.open("GET", "../Controller/Quantidade_vaga_restante_transferencia_turma.php?"+url, true);
        xmlreq.onreadystatechange = function(){      
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {
                      result.value =  xmlreq.responseText;
                }else{
                    alert("Erro ao pesquisar");                   
                    
                }
            }
        };
        xmlreq.send(null);
    }



    function verifica_dia_letivo(campo){
        var result = document.getElementById(campo);
        var xmlreq = CriaRequest();   
      
        var data = document.getElementById(campo).value;
 
        var url="data="+data;

    var data_1 = new Date(data);
    var data_2 = new Date('2021-01-01');
    if (data_1 > data_2) {
        
        console.log(data);
 
           xmlreq.open("GET", "../Controller/Verifica_dia_letivo.php?"+url, true);
            xmlreq.onreadystatechange = function(){      
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                          
                    if (xmlreq.responseText !='certo') {

                          result.value='';
                          Swal.fire({
                              position: 'center',
                              icon: 'info',
                              title: 'ATENÇÃO',
                                 text: 'A data informada não corresponde a um dia letivo ',
                              showConfirmButton: false,
                              timer: 1500
                            });
                    }

                    }else{
                        alert("Erro ao pesquisar");                   
                        
                    }
                }
            };
            xmlreq.send(null);
        } 
    }


function pesquisa_frequencia(){

    var result = document.getElementById('resultado');
    var falta = document.getElementById('falta').value;
    var data_inicial = document.getElementById('data_inicial').value;
    var data_final = document.getElementById('data_final').value;
    var idturma = document.getElementById('idturma').value;
    var idescola = document.getElementById('idescola').value;
      
    result.innerHTML = "<img src='imagens/carregando.gif'>";  
    var xmlreq = CriaRequest();
    xmlreq.open("GET", "../Controller/Relatorio_de_frequencia.php?idescola="+idescola+"&idturma="+idturma+"&falta="+falta+"&data_inicial="+data_inicial+"&data_final="+data_final, true);

    xmlreq.onreadystatechange = function(){
  
     if (xmlreq.readyState == 4) {
         if (xmlreq.status == 200) {
               result.innerHTML = xmlreq.responseText;

         }else{
               alert('Erro desconhecido, verifique sua conexão com a internet');

            result.innerHTML ="Erro ao receber mensagens";                 
         }
     }
    };
     xmlreq.send(null);
}

// function pesquisa_relatorio_faltas_aluno(){

//     var result = document.getElementById('resultado');
//     var falta = document.getElementById('falta').value;
//     var data_inicial = document.getElementById('data_inicial').value;
//     var data_final = document.getElementById('data_final').value;
//     var idturma = document.getElementById('idturma').value;
//     var idescola = document.getElementById('idescola').value;
      
//     result.innerHTML = "<img src='imagens/carregando.gif'>";  
//     var xmlreq = CriaRequest();
//     xmlreq.open("GET", "../Controller/Pesquisa_relatorio_faltas_aluno.php?idescola="+idescola+"&idturma="+idturma+"&falta="+falta+"&data_inicial="+data_inicial+"&data_final="+data_final, true);

//     xmlreq.onreadystatechange = function(){
  
//      if (xmlreq.readyState == 4) {
//          if (xmlreq.status == 200) {
//                result.innerHTML = xmlreq.responseText;

//          }else{
//                alert('Erro.');

//             result.innerHTML ="Erro ao receber mensagens";                 
//          }
//      }
//     };
//      xmlreq.send(null);
// }
// 


function pesquisa_relatorio_faltas_aluno(){

    // Obtém todos os checkboxes com classe iniciada por "idtuma"
    const checkboxes = document.querySelectorAll('input[type="checkbox"].idturma');

    // Variável para armazenar os valores selecionados
    let valoresSelecionados = '';

    // Itera sobre os checkboxes
    checkboxes.forEach(function(checkbox) {
      // Verifica se o checkbox está marcado
      if (checkbox.checked) {
        // Concatena o valor na variável
        valoresSelecionados += checkbox.value + ',';
      }
    });

    // Remove a última vírgula, se houver
    valoresSelecionados = valoresSelecionados.replace(/,$/, '');

    // Exibe os valores selecionados
    console.log("valores check"+valoresSelecionados);

  var result = document.getElementById('resultado_busca');
  var falta = document.getElementById('falta').value;
  var data_inicial = document.getElementById('data_inicial').value;
  var data_final = document.getElementById('data_final').value;
  var idescola = document.getElementById('idescola').value;
  var idturma =""+valoresSelecionados;
 
  var serie ="";
 
        result.innerHTML = "<img src='imagens/carregando.gif'>";  
          var xmlreq = CriaRequest();
         xmlreq.open("GET", "../Controller/Pesquisa_relatorio_faltas_aluno.php?idescola="+idescola+"&idturma="+idturma+"&falta="+falta+"&data_inicial="+data_inicial+"&data_final="+data_final, true);

          xmlreq.onreadystatechange = function(){
        
           if (xmlreq.readyState == 4) {
               if (xmlreq.status == 200) {
                     result.innerHTML = xmlreq.responseText;

               }else{
                     alert('Erro desconhecido, verifique sua conexão com a internet');

                  result.innerHTML ="Erro ao receber mensagens";                 
               }
           }
          };
       xmlreq.send(null);
 
      
}