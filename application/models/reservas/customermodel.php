<?php

class CustomerModel extends CI_Model{

	function save($c){
		$customer = json_decode($c);
		$data = array(
			'nombre'		=> $customer->name,
			'ap_paterno'	=> $customer->aPaterno,
			'ap_materno'	=> $customer->aMaterno,
            'completo'  	=> $customer->name." ".$customer->aPaterno." ".$customer->aMaterno,
			'telefono'		=> $customer->phone,
			'email'			=> $customer->email		
		);	
		
		$this->db->insert("clientes",$data);		
		$this->db->select("LAST_INSERT_ID() as id");
		
		return $this->db->get()->first_row()->id;
	}
	
	function update(){}
	function delete(){}	
	function getAll(){}
	function getSearch(){}
	
}