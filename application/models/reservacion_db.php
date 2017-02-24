
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class reservacion_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($id){
        $this->db->from('reservacion');
        $this->db->where('id', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        $this->db->from('reservacion');
        $this->db->where('estadoReservacionId > 0');
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la busqueda de los registros activos del catalogo
     */
    public function getSearch($texto, $showCo, $fechaIni, $fechaFin, $pagina){
        $this->db->select('clientes.completo');
        $this->db->select('reservacion.id, reservacion.codigo, reservacion.fechaLlegada');
        $this->db->select('reservacion.fechaSalida, cat_status_reservacion.nombre as estado');
        $this->db->from('reservacion');
        $this->db->join('clientes', 'reservacion.clienteId = clientes.id');
        $this->db->join('cat_status_reservacion', 'reservacion.estadoReservacionId = cat_status_reservacion.id');
        $this->db->where('reservacion.estadoReservacionId > 0');
        $this->db->where("(clientes.completo like '%".$texto."%' OR reservacion.codigo like '%".$texto."%' )");
        if ($fechaIni != ""){
            $this->db->where("reservacion.fechaSalida > '".$fechaIni."'");
        }if ($fechaFin != ""){
            $this->db->where("reservacion.fechaLlegada < '".$fechaFin."'");
        }if ($showCo != "true"){
            $this->db->where('reservacion.estadoReservacionId <> 4');
        }if ($pagina > 0){
            $this->db->limit(10, (($pagina - 1)*10));
        }
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la cuenta de registros de la consulta
     */
    public function getCount($texto, $showCo, $fechaIni, $fechaFin){
        $this->db->select('count(reservacion.id) as total');
        $this->db->from('reservacion');
        $this->db->join('clientes', 'reservacion.clienteId = clientes.id');
        $this->db->join('cat_status_reservacion', 'reservacion.estadoReservacionId = cat_status_reservacion.id');
        $this->db->where('reservacion.estadoReservacionId > 0');
        $this->db->where("(clientes.completo like '%".$texto."%' OR reservacion.codigo like '%".$texto."%' )");
        if ($showCo != "true"){
            $this->db->where('reservacion.estadoReservacionId <> 4');
        }
        return  $this->db->get()->result();
    }
 
    /**
     * Guarda el registro
     */
    public function insert($data){
        $this->db->insert('reservacion', $data);
    }
 
    /**
     * Actualiza el registro
     */
    public function update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('reservacion', $data);
    }
 
    /**
     * Eliminar el registro
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->update('reservacion',  array('status' => 0));
    }
    
    public function getReserHabitacion($id){
        $this->db->select('xref_habitacion_reservacion.precio, xref_habitacion_reservacion.cantidad');
        $this->db->select('habitacion.nombre');
        $this->db->from('xref_habitacion_reservacion');
        $this->db->join('habitacion', 'xref_habitacion_reservacion.habitacionId = habitacion.id');
        $this->db->where('reservacionId', $id);
        return  $this->db->get()->result();
    }
 
}
//end model