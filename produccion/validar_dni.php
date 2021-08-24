<?php 

function validar_dni($dni){
	$letra = substr($dni, -1);
	$numeros = substr($dni, 0, -1);
	if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 7 && strlen ($numeros) == 8 ){ // dni argentina  8 caracteres
		return true;
	}else{
		return false;
	}
}

?>