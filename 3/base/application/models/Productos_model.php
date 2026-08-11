<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

    public function obtenerTodos() {
        $query = $this->db->get('productos');
        // SELECT * FROM clase3.productos
        // Con $query->result(); traigo todos los registros
        return $query->result();
    }

    public function obtenerPorId($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('productos');
        // $query->row(); -> trae solo el registro que coincide con el ID
        return $query->row();
    }
}
