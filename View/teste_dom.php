<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/canvas2image@1.0.5/canvas2image.min.js"></script>

</head>
<body>


<script>

(function($){
    $.fn.createPdf = function(parametros) {
        
        var config = {              
            'fileName':'html-to-pdf'
        };
        
        if (parametros){
            $.extend(config, parametros);
        }                            

        var quotes = document.getElementById($(this).attr('id'));

        html2canvas(quotes, {
            onrendered: function(canvas) {
                var pdf = new jsPDF('p', 'pt', 'letter');

                for (var i = 0; i <= quotes.clientHeight/980; i++) {
                    var srcImg  = canvas;
                    var sX      = 0;
                    var sY      = 980*i;
                    var sWidth  = 900;
                    var sHeight = 980;
                    var dX      = 0;
                    var dY      = 0;
                    var dWidth  = 900;
                    var dHeight = 980;

                    window.onePageCanvas = document.createElement("canvas");
                    onePageCanvas.setAttribute('width', 900);
                    onePageCanvas.setAttribute('height', 980);
                    var ctx = onePageCanvas.getContext('2d');
                    ctx.drawImage(srcImg,sX,sY,sWidth,sHeight,dX,dY,dWidth,dHeight);

                    var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);
                    var width         = onePageCanvas.width;
                    var height        = onePageCanvas.clientHeight;

                    if (i > 0) {
                        pdf.addPage(612, 791);
                    }

                    pdf.setPage(i+1);
                    pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width*.62), (height*.62));
                }

                pdf.save(config.fileName);
            }
        });
    };
})(jQuery);
 

function createPDF() {
    $('#renderPDF').createPdf({
        'fileName' : 'testePDF'
    });
}
</script>

<button type="button" class="btn btn-success" onclick="createPDF();">pdf</button>
 
<div id="renderPDF" class="container">
	
	<div class="WordSection1">

	<table class="MsoNormalTable" style="width: 100%;">

	 <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:20.25pt">
	  <td width="936" nowrap="" colspan="7" valign="bottom" style="width:701.7pt;border:
	  solid windowtext 1.0pt;border-bottom:none;mso-border-top-alt:solid windowtext .5pt;
	  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:20.25pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:20.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>PREFEITURA DE LUÍS EDUARDO MAGALHÃES</b></span><span style="mso-ascii-font-family:Calibri;mso-fareast-font-family:&quot;Times New Roman&quot;;
	  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
	  mso-fareast-language:PT-BR;mso-no-proof:yes"> </span>

	  <span style="mso-ignore:vglayout;
	  position:absolute;z-index:251660288;left:0px;margin-left:15px;margin-top:
	  9px;width:49px;height:53px"><img width="49" height="53" src="regitro_conteudo_arquivos/image002.jpg" v:shapes="Imagem_x0020_2"></span><span style="mso-ascii-font-family:Calibri;mso-fareast-font-family:&quot;Times New Roman&quot;;
	  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
	  mso-fareast-language:PT-BR"><o:p></o:p></span></p>
	  </td>
	 </tr>
	 <tr style="mso-yfti-irow:1;height:15.0pt">
	  <td width="936" colspan="7" style="width:701.7pt;border-top:none;border-left:
	  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
	  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:15.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>SECRETARIA MUNICIPAL DE EDUCAÇÃO</b><o:p></o:p></span></p>
	  </td>
	 </tr>
	 <tr style="mso-yfti-irow:2;height:18.75pt">
	  <td width="936" colspan="7" style="width:701.7pt;border-top:none;border-left:
	  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
	  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:18.75pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:16.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>OBJETOS DE CONHECIMENTOS</b><o:p></o:p></span></p>
	  </td>
	 </tr>
	 <tr style="mso-yfti-irow:3;height:15.0pt">
	  <td width="936" colspan="7" style="width:701.7pt;border-top:none;border-left:
	  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
	  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:14.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR">&nbsp;<o:p></o:p></span></p>
	  </td>
	 </tr>
	 <tr style="mso-yfti-irow:4;height:15.0pt">
	  <td width="936" colspan="7" valign="bottom" style="width:701.7pt;border:solid windowtext 1.0pt;
	  mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>ESCOLA MUNICIPAL: ESCOLA MUNICIPAL ONERO COSTA DA ROSA - INEP 29001358</b> <o:p></o:p></span></p>
	  </td>
	 </tr>
	 <tr style="mso-yfti-irow:5;height:15.0pt">
	  <td width="936" colspan="7" valign="bottom" style="width:701.7pt;border:solid windowtext 1.0pt;
	  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>PERÍODO: 03/05/2021 - 09/07/2021</b><o:p></o:p></span></p>
	  </td>
	 </tr>
	 <tr style="mso-yfti-irow:6;height:15.0pt">
	    <td width="161" colspan="2" valign="bottom" style="width:120.5pt;border:solid windowtext 1.0pt;
	      border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
	      padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	      <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	      mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	      color:black;mso-fareast-language:PT-BR"><b>ANO:</b><span style="mso-spacerun:yes">
	      </span><o:p></o:p></span></p>
	    </td>
	  <td width="406" colspan="2" valign="bottom" style="width:304.75pt;border-top:none;
	  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
	  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>TURMA: 6 ANO E</b> <o:p></o:p></span></p>
	  </td>
	  <td width="369" colspan="3" valign="bottom" style="width:276.45pt;border-top:none;
	  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
	  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>TURNO:</b><span style="mso-spacerun:yes"></span><o:p></o:p></span></p>
	  </td>
	 </tr>
	 <tr style="mso-yfti-irow:7;height:15.0pt">
	  <td width="936" colspan="7" valign="bottom" style="width:701.7pt;border:solid windowtext 1.0pt;
	  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal"><span style="font-size:8.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR">&nbsp;<o:p></o:p></span></p>
	  </td>
	 </tr>
	 <tr style="mso-yfti-irow:8;height:15.0pt">
	  <td width="567" nowrap="" colspan="4" style="width:15.0cm;border:solid windowtext 1.0pt;
	  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal"><span style="font-size:10.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>COMPONENTE CURRICULAR:</b><o:p></o:p></span></p>
	  </td>
	  <td width="180" nowrap="" colspan="2" valign="bottom" style="width:134.7pt;border-top:
	  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
	  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:10.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>AULAS PREVISTAS:</b><o:p></o:p></span></p>
	  </td>
	  <td width="189" nowrap="" style="width:5.0cm;border-top:none;border-left:none;
	  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
	  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:10.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>AULAS DADAS:</b> <o:p></o:p></span></p>
	  </td>
	 </tr>
	 <tr style="mso-yfti-irow:9;height:15.0pt">
	  <td width="161" nowrap="" colspan="2" style="width:120.5pt;border:solid windowtext 1.0pt;
	  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal"><span style="font-size:10pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>UNIDADE: 

	      I TRIMESTRE
	  </b><o:p></o:p></span></p>
	  </td>
	  <td width="406" nowrap="" colspan="2" style="width:304.75pt;border-top:none;
	  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
	  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" style="margin-bottom:0cm;line-height:normal"><span style="font-size:10.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR">PROFESSOR (A): Sara Silva De Barros<o:p></o:p></span></p>
	  </td>
	  <td width="180" nowrap="" colspan="2" style="width:134.7pt;border-top:none;
	  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
	  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  background:#BFBFBF;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR">&nbsp;<o:p></o:p></span></p>
	  </td>
	  <td width="189" nowrap="" valign="bottom" style="width:5.0cm;border-top:none;
	  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
	  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  background:#D0CECE;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:10.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR">&nbsp;<o:p></o:p></span></p>
	  </td>
	 </tr>


	 <tr style="mso-yfti-irow:10;height:15.75pt">
	  <td width="66" nowrap="" style="width:49.65pt;border:solid windowtext 1.0pt;
	  border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
	  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
	  0cm 3.5pt 0cm 3.5pt;height:15.75pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR">Nº Aula<o:p></o:p></span></p>
	  </td>
	  <td width="94" nowrap="" style="width:70.85pt;border-top:none;border-left:none;
	  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR">Data<o:p></o:p></span></p>
	  </td>
	  <td width="406" nowrap="" colspan="5" style=" border-top:1.0pt;
	  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
	  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR">
	ARTE  <o:p></o:p></span></p>
	  </td>
	 
	 </tr>

	 


	 <tr style="mso-yfti-irow:15;height:15.0pt">
	  <td width="356" nowrap="" colspan="3" valign="bottom" style="width:266.85pt;
	  border:none;border-left:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR">_____________________&nbsp;<o:p></o:p></span></p>
	  </td>
	  <td width="248" nowrap="" colspan="2" valign="bottom" style="width:186.15pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR">_____/______/_______<o:p></o:p></span></p>
	  </td>
	  <td width="332" nowrap="" colspan="2" valign="bottom" style="width:248.7pt;border:
	  none;border-right:solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt"><span style="margin-left: 80px;">______________________</span></td>
	 </tr>
	 <tr style="mso-yfti-irow:16;mso-yfti-lastrow:yes;height:15.0pt">
	  <td width="356" nowrap="" colspan="3" valign="bottom" style="width:266.85pt;
	  border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
	  border-right:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
	  solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>ASSINATURA DO COORDENADOR</b><o:p></o:p></span></p>
	  </td>
	  <td width="248" nowrap="" colspan="2" valign="bottom" style="width:186.15pt;
	  border:none;border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>DATA</b><o:p></o:p></span></p>
	  </td>
	  <td width="332" nowrap="" colspan="2" valign="bottom" style="width:248.7pt;border-top:
	  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
	  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt">
	  <p class="MsoNormal" align="center" style="margin-bottom:0cm;text-align:center;
	  line-height:normal"><span style="font-size:9.0pt;font-family:&quot;Tw Cen MT Condensed&quot;,sans-serif;
	  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-bidi-font-family:Calibri;
	  color:black;mso-fareast-language:PT-BR"><b>ASSINATURA DO PROFESSOR</b><o:p></o:p></span></p>
	  </td>
	 </tr>
	 <!--[if !supportMisalignedColumns]-->
	 <tr height="0">
	  <td width="66" style="border:none"></td>
	  <td width="94" style="border:none"></td>
	  <td width="195" style="border:none"></td>
	  <td width="211" style="border:none"></td>
	  <td width="37" style="border:none"></td>
	  <td width="143" style="border:none"></td>
	  <td width="189" style="border:none"></td>
	 </tr>
	 
	</tbody></table>

	<p class="MsoNormal"><o:p>&nbsp;</o:p></p>

	</div>
	
	</div>
</div>



</body>
</html>