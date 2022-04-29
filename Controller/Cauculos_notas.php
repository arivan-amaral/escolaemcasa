<?php 
	function calculos_media_notas($nota,$nota_rp,$nota_av3){
		$media_nota=0;
		if ( $nota!='' && $nota_rp >$nota_av3) {
	       $media_nota=($nota-$nota_av3)+$nota_rp;
	     }else{
	     	$media_nota=$nota;
	     }
     return $media_nota;
	}

?>