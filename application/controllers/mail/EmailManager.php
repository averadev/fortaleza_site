
<?php

/**
 * Componente encargado del envio de Correos
 *
 * @author     Alberto Vera Espitia <avera@geekbucket.com.mx>
 * @copyright  2013 GeekBucket
 * @version    SVN: $Id$
 *
 */

require_once("mail/class.phpmailer.php");

class EmailManager {

	private $name = "";
	private $email = "";
	private $tel = "";
	private $comments = "";
	private $sendTo = "";
	private $sendPass = "";
	private $subject = "";


    function __construct() {
		$this->email = "ventas@geekbucket.com.mx";
		$this->sendPass = "ventasg33k";
		$this->subject = "Confirmacion de compra en Geek Bucket";
    }

    function buildCustomerMail($nombre, $emailTo, $productos, $liteProductos){
    	$message = "Buenos dias ".$nombre.". <br/><br/>";
		$message = $message."Permitanos agradecer su preferencia por la compra de uno de nuestros productos. <br/>";
		$message = $message.$productos;
		$message = $message."<br/> INFORMACION IMPORTANTE: ";
		$message = $message."<br/> Al momento de instalar el sistema, se instalará tambien la base de datos.  ";
		$message = $message."<br/> Es de suma importancia que al instalarla asigne el password correcto a su base de datos, el cual es admin (todo en minúsculas). ";
		$message = $message."<br/> Una vez instalado su punto de venta, la contraseña temporal para entrar es el numero 0 (cero). Esta podra ser cambiada una vez dentro del sistema. ";
		$message = $message."<br/> <br/> Favor de Leer el archivo IMPORTANTE- INSTALACION Y CONFIGURACION DE SISTEMA.pdf que se incluye en la carpeta de instalación del sistema para ver las instrucciones completas. ";
		$message = $message."<br/> A la brevedad alguno de nuestro agentes se pondra en contacto con usted.";

		$mail = new PHPMailer();
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;  // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465; 
		$mail->IsHTML(true);
		$mail->Username = $this->email;  
		$mail->Password = $this->sendPass;           
		$mail->SetFrom($this->email, "Ventas Geek Bucket");
		$mail->Subject = $this->subject;
		$mail->Body = $message;
		$mail->AddAddress($emailTo);
	    
	    /* Envio del mensaje */
	    if(!$mail->Send()) {
	        echo "El mensaje no pudo ser enviado.";
	        echo "Error: " . $mail->ErrorInfo;
	    }
	    $this->buildAdviseMail($nombre, $emailTo, $productos, $liteProductos);
    }
}

?>