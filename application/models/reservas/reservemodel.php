<?php

class ReserveModel extends CI_Model{
	
	var $REG_PRICE = 3;
	var $TEMP_PRICE = 2;
	var $PROMO_PRICE = 1;
	
	/************************************************************************************************
	 *  Consultas
	 ************************************************************************************************/
	
	public function getReserveCode ($reserveId){
		$this->db->select("codigo as code")->from("reservacion")->where("id",$reserveId)->limit(1);
		return $this->db->get()->first_row()->code;
	}
	
	public function getTotalAllReserve($starDate,$endDate,$roomType){
		
		$option = "";
		if($roomType != 0)
			$option = " AND x.tipos_habitacion_id = $roomType";
		
		$query = $this->db->query("			
			SELECT
			    r.codigo as reserveCode,    
			    concat(c.nombre, ' ', c.ap_paterno,' ', c.ap_materno) as customer,
			    c.telefono,
			    c.email,
			    DATE_FORMAT(r.fechaLlegada,'%d/%m/%Y') as arriveDate,
			    DATE_FORMAT(r.fechaSalida,'%d/%m/%Y') as departureDate ,
			    GROUP_CONCAT((SELECT nombre FROM tipos_habitacion WHERE id = x.tipos_habitacion_id ) SEPARATOR '\n') as roomType,    
			    GROUP_CONCAT(x.cantidad SEPARATOR '\n') as nRoom,
			    GROUP_CONCAT('$ ',FORMAT(x.precio,2), ' ".CURREN."' SEPARATOR '\n') as price,       
			    GROUP_CONCAT( IF(x.promociones_id != 0,
			        (SELECT nombre FROM promociones WHERE id = x.promociones_id),
			        '-'
			    ) SEPARATOR '\n') as promoCode,  
			    (SELECT nombre FROM cat_status_reservas WHERE id = r.estadoReservacionId ) reserveStatus   
			    
			FROM reservacion r
			INNER JOIN xref_habitacion_reservacion x ON x.reservaciones_id = r.id
			INNER JOIN clientes c ON c.id = r.reservaciones
			WHERE r.fechaLlegada BETWEEN STR_TO_DATE('$starDate','%d/%m/%Y') and STR_TO_DATE('$endDate','%d/%m/%Y')".$option."
			GROUP BY r.codigo
			ORDER BY r.fechaLlegada ASC
		");		
		
		return $query->num_rows();
	}
	
	public function getAllReserve($pager,$starDate,$endDate,$roomType){
		$res = array();
		
		$option = "";
		if($roomType != 0)
			$option = " AND x.tipos_habitacion_id = $roomType";
		
		$query = $this->db->query("
			SELECT
			    r.codigo as reserveCode,    
			    concat(c.nombre, ' ', c.ap_paterno,' ', c.ap_materno) as customer,
			    c.telefono,
			    c.email,
			    DATE_FORMAT(r.fechaLlegada,'%d/%m/%Y') as arriveDate,
			    DATE_FORMAT(r.fechaSalida,'%d/%m/%Y') as departureDate ,
			    GROUP_CONCAT((SELECT nombre FROM tipos_habitacion WHERE id = x.tipos_habitacion_id ) SEPARATOR '\n') as roomType,    
			    GROUP_CONCAT(x.cantidad SEPARATOR '\n') as nRoom,
			    GROUP_CONCAT('$ ',FORMAT(x.precio,2), ' ".CURREN."' SEPARATOR '\n') as price,       
			    GROUP_CONCAT( IF(x.promociones_id != 0,
			        (SELECT nombre FROM promociones WHERE id = x.promociones_id),
			        '-'
			    ) SEPARATOR '\n') as promoCode,  
			    (SELECT nombre FROM cat_status_reservas WHERE id = r.estadoReservacionId ) reserveStatus   
			    
			FROM reservacion r
			INNER JOIN xref_habitacion_reservacion x ON x.reservaciones_id = r.id
			INNER JOIN clientes c ON c.id = r.reservaciones
			WHERE r.fechaLlegada BETWEEN STR_TO_DATE('$starDate','%d/%m/%Y')	and STR_TO_DATE('$endDate','%d/%m/%Y')".$option."				
			GROUP BY r.codigo
			ORDER BY r.fechaLlegada ASC
			LIMIT $pager->start,$pager->limit		
		");
		
		foreach($query->result() as $row){	
			$res[] = $row;
		}
		
		return $res;		
	}
	
	
	
	/************************************************************************************************
	 *  Altas
	 ************************************************************************************************/
	
	public function save($arriveDate, $departureDate, $customerId){
		// Remplazar / por - ya que el metodo strtotime() no reconoce formato dd/mm/yyyy
		$arriveDate = str_replace("/", "-", $arriveDate);
		$departureDate = str_replace("/", "-", $departureDate);
		
		$data = array(
			'codigo'			=> 1,
			'estadoReservacionId'	=> 1,
			'clienteId'				=> $customerId,
			'fechaLlegada'				=> date( 'Y-m-d', strtotime( $arriveDate ) ),
			'fechaSalida'				=> date( 'Y-m-d', strtotime( $departureDate) ),
		);
		
		$this->db->insert("reservacion",$data);		
		$this->db->select("LAST_INSERT_ID() as id");
		$reserveId = $this->db->get()->first_row()->id;
		$this->setReserveCode($reserveId);
		
		return $reserveId;
	}
	
	public function saveXrefRoom($reserveId, $json){
		$xref = json_decode($json);		 
		
		foreach($xref as $item){
			
			$data = array(
				'reservacionId'		=> $reserveId,
				'habitacionId'	=> $item->roomId,
				'precio'				=> $item->price	,
				'cantidad'				=> $item->quantity,
				'promocionId'		=> ($item->priceType == $this->PROMO_PRICE) ? $item->priceTypeId : 0 			
			);
			$this->db->insert("xref_habitacion_reservacion",$data);					
		}	
	}
	
	/************************************************************************************************
	 *  Actualizaciones
	 ************************************************************************************************/
	
	/**
	 * Actualiza el estatus de una reservaciones
	 * Enter description here ...
	 */
	public function updateStatus($reserveCode,$statusId){
		
		$this->db->update(
			"reservacion",
			array("estadoReservacionId" => $statusId),
			array("codigo" => $reserveCode)
		);		
	}
	
	private function setReserveCode($reserveId){
				
		$code = $reserveId + 1000;
		$this->db->update(
			"reservacion",
			array("codigo" => $code),
			array("id"=> $reserveId)
		);
		return $code;				
	}	
	
	public function updateTxnId($reserveCode){
		
		$this->db->update(
			"reservacion",
			array("codigo" => $reserveCode),
			array("estadoReservacionId" => '1002')
		);		
	}
	
}