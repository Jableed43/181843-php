<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* MODELO = el único lugar que "habla" con la base de datos.
 * Los controladores le piden datos al modelo; nunca escriben SQL ellos. */
class Producto_model extends CI_Model {

    /* Para el HOME: todos los productos. */
    public function obtenerTodos() {
        $query = $this->db->get('productos');   // SELECT * FROM productos
        return $query->result();                // array de objetos (uno por fila)
    }

    /* Para el DETALLE: un solo producto, o NULL si no existe. */
    public function obtenerPorId($id) {
        $this->db->where('id', $id);            // WHERE id = ?   (se escapa solo: sin inyección SQL)
        $query = $this->db->get('productos');
        return $query->row();                   // una sola fila (o NULL)
    }
}
