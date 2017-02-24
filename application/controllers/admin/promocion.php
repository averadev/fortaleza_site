<?php
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class promocion extends CI_Controller {
/**
 * The Saving coupon
 * Author: Alberto Vera Espitia
 * GeekBucket 2014
 *
 */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database('default');
        $this->load->model('promocion_db');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
        $arr['page'] = 'promocion';
        $this->load->view('admin/vwPromocion',$arr);
    }

    /**
     * Obtiene el registro seleccionado
     */
    public function get(){
        if($this->input->is_ajax_request()){
            $data = $this->promocion_db->get($_POST['id']);
            echo json_encode($data);
        }
    }

    /**
     * Eliminar el registro
     */
    public function delete(){
        if($this->input->is_ajax_request()){
            $data = $this->promocion_db->delete($_POST['id']);
            echo json_encode($data);
        }
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        if($this->input->is_ajax_request()){
            $data = $this->promocion_db->getAll();
            echo json_encode($data);
        }
    }

    /**
     * Obtiene la busqueda de los registros activos del catalogo
     */
    public function getSearch(){
        if($this->input->is_ajax_request()){
            // Consulta tamaño consulta
            $pagina = $_POST['pagina'];
            $total = $this->promocion_db->getCount($_POST['texto'])[0];
            $data = $this->promocion_db->getSearch($_POST['texto'], $pagina);
            // Formato a fechas
            foreach ($data as $obj){
                $obj->fechaInicio = strftime("%d de %B de %Y", strtotime($obj->fechaInicio));
                $obj->fechaFin = strftime("%d de %B de %Y", strtotime($obj->fechaFin));
            }
            echo json_encode(array(
                'pagina'=>$pagina,
                'total'=>$total->total,
                'data'=>$data));
        }
    }

    /**
     * Guarda el registro
     */
    public function save(){
        if($this->input->is_ajax_request()){
            
            $data = $this->promocion_db->verifyDates($_POST['fechaInicio'], $_POST['fechaFin'], $_POST['id']);
            
            if  (count($data) > 0){
                $data = $data[0];
                $data->fechaInicio = strftime("%d/%B/%Y", strtotime($data->fechaInicio));
                $data->fechaFin = strftime("%d/%B/%Y", strtotime($data->fechaFin));
                echo json_encode(array('error'=>1, 'data'=>$data));
            }else{
                if ($_POST['id'] == '0'){
                    unset($_POST['id']);
                    $_POST['id'] = $this->promocion_db->insert($_POST);
                }else{
                    $this->promocion_db->update($_POST);
                }
                echo json_encode(array('id'=>$_POST['id']));
            }
            
        }
    }
    
    
    /**
     * Guarda el registro de nuevos precios
     */
    public function saveHabitacion(){
        if($this->input->is_ajax_request()){
            // Eliminamos anteriores
            $this->promocion_db->deleteRoom($_POST['id']);
            // Actualizamos precios
            $rooms = preg_split("/-/", $_POST['arrayId']);
            $arrayStd = preg_split("/-/", $_POST['arrayStd']);
            $arrayAdulto = preg_split("/-/", $_POST['arrayAdulto']);
            $arrayNino = preg_split("/-/", $_POST['arrayNino']);
            for ($i = 0; $i < count($rooms); $i++) {
                if (is_numeric($arrayStd[$i]) || 
                   is_numeric($arrayAdulto[$i]) || 
                   is_numeric($arrayNino[$i])){
                    
                    $update = array('promocionId'=>$_POST['id'], 
                                'habitacionId'=>$rooms[$i],
                                'precioStd'=>is_numeric($arrayStd[$i])?$arrayStd[$i]:null,
                                'precioAdultoExtra'=>is_numeric($arrayAdulto[$i])?$arrayAdulto[$i]:null,
                                'precioNinioExtra'=>is_numeric($arrayNino[$i])?$arrayNino[$i]:null);
                    $this->promocion_db->saveRoom($update);
                }
                
            }
        }
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getHabitaciones(){
        if($this->input->is_ajax_request()){
            $data = $this->promocion_db->getHabitaciones($_POST['id']);
            echo json_encode($data);
        }
    }
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */