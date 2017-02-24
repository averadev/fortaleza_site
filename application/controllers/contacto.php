<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contacto extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->load->view('vwContacto'.getLang());
    }
    
    /**
     * Envia email de contacto
     */
    public function sendEmail(){
        $to = "fortalezasuites@hotmail.com";
        $subject = "Email desde pagina de contacto";
        $body = "Nombre: ".$_POST['txtNombre']."\r\n";
        $body .= "Telefono: ".$_POST['txtTelefono']."\r\n";
        $body .= "Mensaje: ".$_POST['txtMsg'];
        
        $headers = "From: ".$_POST['txtEmail']."\r\n";
        $headers .= "Reply-To: ".$_POST['txtEmail']."\r\n";
        mail($to, $subject, $body, $headers);
    }
}