<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

    public function obtenerTodos() {
        // TODO 1: usar $this->db->get('productos') y devolver ->result()
    }

    public function obtenerPorId($id) {
        // TODO 2: usar $this->db->where('id', $id) + get('productos') + ->row()
    }
}
