<?php 
 $titulo   = 'Meu HTML gerado'; // normalmente vai pegar de DB ou formulario
 $conteudo = 'Lorem Ipsum Batatas Doces';

 // Montamos nosso HTML no PHP, da forma que quisermos
 // \t é o tab, \n a quebra de linha
 $html  = "<html>\n";
 $html .= "\t<head>\n";
 $html .= "\t\t<title>".htmlentities( $titulo )."</title>\n";
 $html .= "\t</head>\n";
 $html .= "\t<body>\n";
 $html .= "\t\t<div>".htmlentities( $conteudo )."</div>\n";
 $html .= "\t</body>\n";
 $html .= "</html>\n";

 //... e vai montando o arquivo com variáveis etc
 // e depois salva

 file_put_contents('arquivo.html', $html);

?>