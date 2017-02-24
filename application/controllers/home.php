<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->load->view('vwHome'.getLang());
    }
    
    public function setLang(){
        if ($_POST['type'] == 'eng')
            $this->session->set_userdata('LANG', '');
        else
            $this->session->set_userdata('LANG', '_ESP');
    }
    
}