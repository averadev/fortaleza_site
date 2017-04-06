<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class suite extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->load->view('vwRoom');
    }

    public function presidencial(){
        $arr['page']='suite/vwPresidencial';
        $this->load->view('vwRoom',$arr);
    }

    public function presidencial2(){
        $arr['page']='suite/vwPresidencial2';
        $this->load->view('vwRoom',$arr);
    }

    public function fortaleza(){
        $arr['page']='suite/vwFortaleza';
        $this->load->view('vwRoom',$arr);
    }

    public function fortaleza2(){
        $arr['page']='suite/vwFortaleza2';
        $this->load->view('vwRoom',$arr);
    }

    public function sanSebastian(){
        $arr['page']='suite/vwSanSebastian';
        $this->load->view('vwRoom',$arr);
    }

    public function sanSebastian2(){
        $arr['page']='suite/vwSanSebastian2';
        $this->load->view('vwRoom',$arr);
    }

    public function sanCristobal(){
        $arr['page']='suite/vwSanCristobal';
        $this->load->view('vwRoom',$arr);
    }

    public function sanCristobal2(){
        $arr['page']='suite/vwSanCristobal2';
        $this->load->view('vwRoom',$arr);
    }

    public function sanGate(){
        $arr['page']='suite/vwSanGate';
        $this->load->view('vwRoom',$arr);
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
