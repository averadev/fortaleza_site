<?php

class  RoomsTypeModel extends CI_Model{
	
	function getAllTypes(){
		$query = $this->db->where("status","1");
		$query = $this->db->get("habitacion");
		$list = array();
		$list["0"] = "Todos"; 
		foreach($query->result() as $row){			
			$list[$row->id] = $row->nombre;			
		}		
		return $list;	
	}
		
	function getAllState(){
		$data = array();		
		$query = $this->db->query("SELECT * FROM cat_estado");
		foreach ($query->result() as $row){
			$data[$row->id] = $row->nombre;
		}
		return $data;
	}	
	
	/**
	 * tipoPrecio :
	 *  1 - promosional
	 *  2 - temporada
	 *  3 - regular
	 * Enter description here ...
	 */
	function getRoomsAvailability($arriveDate,$departuDate){
		$data = array();
		
		$query = $this->db->query("
        	SELECT
			    th.id,
			    th.nombre as name,			   
			    th.descripcion as description,
			    IF(p.id is not null,p.id,IF(t.id is not null,t.id,th.id)) as priceTypeId,
					IF(p.id is not null,'1',IF(t.id is not null,'2','3')) as priceType,
					IFNULL(th.capacidadStd,0) as capacity,

			    CASE (IF(xp.precioStd is not null,1,IF(xtp.precioStd is not null,2,3)))
	                WHEN 1 THEN 'Precio Promocional'
	                WHEN 2 THEN 'Precio de Temporada'
	                WHEN 3 THEN 'Precio Regular'
        		END as priceTypeName,
        		
				CASE (IF(xp.precioStd is not null,1,IF(xtp.precioStd is not null,2,3)))
	                WHEN 1 THEN IF(t.id is not null,xtp.precioStd,th.precioStd)
	                WHEN 2 THEN xtp.precioStd
	                WHEN 3 THEN th.precioStd
        		END as regularPrice,
	
        		CASE (IF(xp.precioStd is not null,1,IF(xtp.precioStd is not null,2,3)))
	                WHEN 1 THEN xp.precioStd
	                WHEN 2 THEN xtp.precioStd
	                WHEN 3 THEN th.precioStd
        		END as price,

			    CASE (IF(xp.precioAdultoExtra is not null,1,IF(xtp.precioAdultoExtra is not null,2,3)))
	                WHEN 1 THEN xp.precioAdultoExtra
	                WHEN 2 THEN xtp.precioAdultoExtra
	                WHEN 3 THEN th.precioAdultoExtra
        		END as pAdultExtra,

			    CASE (IF(xp.precioNinioExtra is not null,1,IF(xtp.precioNinioExtra is not null,2,3)))
	                WHEN 1 THEN xp.precioNinioExtra
	                WHEN 2 THEN xtp.precioNinioExtra
	                WHEN 3 THEN th.precioNinioExtra
        		END as pChildExtra
      
				FROM habitacion th

				LEFT JOIN xref_habitacion_promocion xp ON xp.habitacionId = th.id and 
		                xp.promocionId = (SELECT max(id) FROM promocion WHERE STR_TO_DATE('".$arriveDate."','%d/%m/%Y') BETWEEN fechaInicio and date_add(fechaFin, INTERVAL 1 DAY)	AND
										date_add(STR_TO_DATE('".$departuDate."','%d/%m/%Y'), INTERVAL -1 DAY) BETWEEN fechaInicio and date_add(fechaFin, INTERVAL 1 DAY) )
				LEFT JOIN promocion p ON p.id = xp.promocionId and p.status = 1 			

				LEFT JOIN xref_habitacion_temporada xtp ON xtp.habitacionId = th.id and 
		                xtp.temporadaId = (SELECT max(id) FROM temporada WHERE STR_TO_DATE('".$arriveDate."','%d/%m/%Y') BETWEEN fechaInicio and date_add(fechaFin, INTERVAL 1 DAY)	AND
										date_add(STR_TO_DATE('".$departuDate."','%d/%m/%Y'), INTERVAL -1 DAY) BETWEEN fechaInicio and date_add(fechaFin, INTERVAL 1 DAY) )
				LEFT JOIN temporada t ON t.id = xtp.temporadaId and t.status = 1 

				WHERE th.status = 1 
			GROUP BY th.id
			ORDER BY th.id ASC
		");
		
		foreach($query->result() as $row){	
			$data[] = $row;
		}
		
		return $data;
	}
	
	
	/**
	 * Obtiene el total de habitaciones libres por tipo de habitacion
	 * @param string $startDate
	 * @param string $endDate
	 * @return Array()
	 */
	function getRoomsFree($startDate, $endDate){
		$rooms = array();
		
		$query = $this->db->query("
			SELECT(
                th.disponibilidad - 
				IFNULL((
						SELECT SUM(x.cantidad) as reserved
						FROM reservacion r LEFT JOIN xref_habitacion_reservacion x ON x.reservacionId = r.id
						WHERE 
								(date(STR_TO_DATE('".$startDate."','%d/%m/%Y')) BETWEEN DATE(r.fechaLlegada) and DATE(r.fechaSalida)	OR
								date_add(date(STR_TO_DATE('".$endDate."','%d/%m/%Y')), INTERVAL -1 DAY) BETWEEN DATE(r.fechaLlegada) and DATE(r.fechaSalida))
						AND x.habitacionId = th.id)
				,0)) as available
			FROM habitacion th WHERE th.status = 1
		");
		
		foreach($query->result() as $row){	
			$rooms[] = $row;		
		}
			
		return $rooms;	
	}
}