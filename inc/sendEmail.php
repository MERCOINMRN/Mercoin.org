<?php

// Replace this with your own email address
$siteOwnersEmail = 'mercoinweb@gmail.com';


if($_POST) {

   $nombre = trim(stripslashes($_POST['nombre']));
   $apellido = trim(stripslashes($_POST['apellido']));
   $email = trim(stripslashes($_POST['email']));
   $pais = trim(stripslashes($_POST['pais']));
   $saldo = trim(stripslashes($_POST['saldo']));
   $orden = trim(stripslashes($_POST['orden']));
   $wallet = trim(stripslashes($_POST['wallet']));
   $subject = 'Solicitud de Retiro MRN';
   $mensaje = trim(stripslashes($_POST['mensaje']));

   // Check Name
	if (strlen($nombre) < 2) {
		$error['nombre'] = "Por favor, ingresa tu nombre.";
	}
	if (strlen($apellido) < 2) {
		$error['apellido'] = "Por favor, ingresa tu apellido.";
	}
	if (strlen($pais) < 2) {
		$error['pais'] = "Por favor, ingresa tu país.";
	}
	if (strlen($saldo) < 2) {
		$error['saldo'] = "Por favor, ingresa tu saldo.";
	}
	if (strlen($orden) < 2) {
		$error['orden'] = "Por favor, ingresa tu orden.";
	}
	if (strlen($wallet) < 2) {
		$error['wallet'] = "Por favor, ingresa tu wallet.";
	}
	// Check Email
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Por favor, ingrese una dirección de email válida.";
	}
	// Check Message
	// if (strlen($contact_message) < 15) {
	// 	$error['message'] = "Please enter your message. It should have at least 15 characters.";
	// }
   // Subject
	if ($subject == '') { $subject = "Contact Form Submission"; }
	$message = '';

   // Set Message
   $message .= "De: " . $apellido.' '.$nombre . "<br />";
	$message .= "Email: " . $email . "<br />";
	$message .= "Pais: " . $pais . "<br />";
	$message .= "Saldo en MRNs: " . $saldo . "<br />";
	$message .= "Orden: " . $orden . "<br />";
	$message .= "Wallet: " . $wallet . "<br />";
   $message .= "Message (opcional): <br />";
   $message .= $mensaje;
   $message .= "<br /> ----- <br />. <br />";

   // Set From: header
   $from =  $nombre . " <" . $email . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


   if (!$error) {

      ini_set("sendmail_from", $siteOwnersEmail); // for windows server
      $mail = mail($siteOwnersEmail, $subject, $message, $headers);

		if ($mail) { echo "OK"; }
      else { echo "Something went wrong. Please try again."; }
		
	} # end if - no validation error

	else {

		$response = (isset($error['nombre'])) ? $error['nombre'] . "<br /> \n" : null;
		$response .= (isset($error['apellido'])) ? $error['apellido'] . "<br /> \n" : null;
		$response .= (isset($error['pais'])) ? $error['pais'] . "<br /> \n" : null;
		$response .= (isset($error['saldo'])) ? $error['saldo'] . "<br /> \n" : null;
		$response .= (isset($error['orden'])) ? $error['orden'] . "<br /> \n" : null;
		$response .= (isset($error['wallet'])) ? $error['wallet'] . "<br /> \n" : null;
		$response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
		$response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
		
		echo $response;

	} # end if - there was a validation error

}

?>