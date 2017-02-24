<?php

class reserveController extends CI_Controller{
	
	function __construct(){		
		parent::__construct();		
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('reservas/RoomsTypeModel','roomsType');
		$this->load->model('reservas/CustomerModel','customer');
		$this->load->model('reservas/ReserveModel','reserve');
	}

	// Funcion principal
	function index(){	
				
		$this->load->view(
			"vwBookMeIn",
			array(
				'selRoomsType'	=> $this->roomsType->getAllTypes(),
				'allState'		=> $this->roomsType->getAllState()
			)
		);		
	}

	function saveReserve(){
		// Se guarda el cliente
		$customerId = $this->customer->save($this->input->post("customer", TRUE));
		// Se guarda los datos generales de reserva
		$reserveId = $this->reserve->save($this->input->post("arriveDate"),$this->input->post("departureDate"),$customerId);
		//Se guadan la habitaciones seleccionadas
		$this->reserve->saveXrefRoom($reserveId,$this->input->post("xrefRooms",TRUE));
		$reserveCode = $this->reserve->getReserveCode($reserveId);
        
        
        $this->preRegisterEmail($this->input->post("customer", TRUE));
        
		
		header('Content-Type: application/json',true);
    	echo json_encode(array(
    		'code' => $reserveCode,
    		'idReserve' => $reserveId    	
    	)); 
	}
	
	
	/**
	 * Obtiene la disponibilidad de las habitaciones
	 * return application/json
	 */
	function getRoomsAvaliable() {
    	$arriveDate = $this->input->post('arriveDate');
    	$departureDate= $this->input->post('departureDate');    	
    	
    	$roomsInfo = $this->roomsType->getRoomsAvailability($arriveDate,$departureDate);
    	$roomsAvailable =  $this->roomsType->getRoomsFree($arriveDate,$departureDate);
    	
    	$array = array(
    		'result' => $roomsInfo,
    		'available' => $roomsAvailable
    	);
    	
    	header('Content-Type: application/json',true);
    	echo json_encode($array);    	
   }
	
	/**
	 * Obtiene la disponibilidad de las habitaciones
	 * return application/json
	 */
	function paySuccess() {
		
    	$txn_id = $_POST['item_number'];
		$this->reserve->updateStatus($txn_id, 2);
   }
    
    
    function preRegisterEmail($c){
    	
        // título
        $título = 'Confirmación de Reservacion';
        
        $customer = json_decode($c);
        
        // mensaje
        $mensaje = '
        <html>
            <body>
                <div style="width:100%; height:80px; background: #212121;"></div>

                <div style="width:100%; margin: 20px 0;">
                    <h3>CONFIRMACI&Oacute;N DE RESERVACION</h3>
                    
                    <p>Nombre: '.$customer->name . ' ' . $customer->aPaterno . ' ' . $customer->aMaterno.'</p>
                    <p>Correo: '.$customer->email.'</p>
                    <p>Tel: '.$customer->phone.'</p>
                </div>

                <div style="width:100%; height:5px; background: #5ec62b;"></div>
                <div style="width:100%; height:60px; background: #212121; font-size:18px; font-weight: bold; color:#ffffff;"></div>
            </body>
        </html>
        ';

        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: No Reply <noreply@fortalezasuitessanjuan.com>';

        // Enviarlo
        mail('fortalezasuites@hotmail.com, reservaciones@fortalezasuitessanjuan.com', $título, $mensaje, $cabeceras);
    }
  
}
