<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class room extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->load->view('vwRoom');
    }

    public function sol(){
        $arr['page']='room/vwSol';
        $this->load->view('vwRoom',$arr);
    }

    public function luna(){
        $arr['page']='room/vwLuna';
        $this->load->view('vwRoom',$arr);
    }

    public function sanJusto(){
        $arr['page']='room/vwSanJusto';
        $this->load->view('vwRoom',$arr);
    }

    public function princesa(){
        $arr['page']='room/vwPrincesa';
        $this->load->view('vwRoom',$arr);
    }

    public function sanFelipe(){
        $arr['page']='room/vwSanFelipe';
        $this->load->view('vwRoom',$arr);
    }

    public function sanGeronimo(){
        $arr['page']='room/vwSanGeronimo';
        $this->load->view('vwRoom',$arr);
    }

    public function sanJose(){
        $arr['page']='room/vwSanJose';
        $this->load->view('vwRoom',$arr);
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
