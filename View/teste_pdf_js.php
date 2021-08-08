<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
</head>
<body>

    <div id="employee_detail">
        kjlkfjgkh
    </div>

<script type="text/javascript">
	

   window.html2canvas = html2canvas;

   function demoFromHTML() {

     const html_source = document.getElementById('employee_detail'); // O id do elemento que contém o Html que quer imprimir.
     const filename = 'Test.pdf';


     html2canvas(html_source).then(function(canvas) {
       /*
       [210,297] Sao os números (largura e altura do papel a4) que eu encontrei para trabalhar com eles.
       Se você puder encontrar números oficiais do jsPDF, usa.
        */
       let imgData = canvas.toDataURL('image/png');
       let imgWidth = 210; // Largura em mm de um a4
       let pageHeight = 297; // Altura em mm de um a4

       let imgHeight = canvas.height * imgWidth / canvas.width;
       let heightLeft = imgHeight;
       let position = 0;
       let pdf = new jsPDF('p', 'mm');
       let fix_imgWidth = 15; // Vai subindo e descendo esses valores ate ficar como queres
       let fix_imgHeight = 15; // Vai subindo e descendo esses valores ate ficar como queres

       pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
       heightLeft -= pageHeight;

       while (heightLeft >= 0) {
         position = heightLeft - imgHeight;
         pdf.addPage();
         pdf.addImage(imgData, 'PNG', 0, position, imgWidth + fix_imgWidth, imgHeight + fix_imgHeight);
         heightLeft -= pageHeight;
       }

       pdf.save(filename);
     })

   }

   demoFromHTML();
</script>



</body>
</html>