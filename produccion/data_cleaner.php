<?php

	//Windows
	 function clear_email($email){
	 		$ruta = "python C:\\laragon\\www\\clean\\produccion\\clear_emails.py";
			exec("$ruta"." "."$email", $salida);

			/*ASI VEO LO QUE DEVUELVE LA FUNCION, POSICIONES DE ARRAY*/
			echo sizeof($salida) .' ';

			if (sizeof($salida) == 9) {
				$email_validado = $salida[8];
			}
			else if (sizeof($salida) == 10) {
				$email_validado = $salida[9];
			}
			else if (sizeof($salida) == 25) {
				$email_validado = $salida[24];
			}
			else if (sizeof($salida) == 22) {
				$email_validado = $salida[21];
			}
			else if(sizeof($salida) == 30){
				$email_validado = $salida[29];
			}else{
				$email_validado = $salida[18];
			}
			return $email_validado;
		}

	function clear_phone($phone){
			$tel_corregido = exec("python C:\\xampp\\htdocs\\data_cleanermcc\\produccion\\clear_phone.py '".$phone."'");

			return $tel_corregido;
		}

	function phone_code($phone){
			$code = exec("python C:\\xampp\\htdocs\\data_cleanermcc\\produccion\\phone_code.py '".$phone."'");

			return $code;
		}


	/// Linux
	 /*function clear_email($email){

			exec("python cleaner_emails.py '".$email."'",$salida);
			$email_validado = $salida[0];
			return $email_validado;

		}

	function clear_phone($phone){
			$tel_corregido = exec("python clear_phone.py '".$phone."'");

			return $tel_corregido;
		}

	function phone_code($phone){
			$code = exec("python phone_code.py '".$phone."'");

			return $code;
		}*/


?>