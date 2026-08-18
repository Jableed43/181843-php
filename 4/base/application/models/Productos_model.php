<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

    /* ---------- Clase 3: ya resuelto ---------- */

    public function obtenerTodos() {
        $query = $this->db->get('productos');   // SELECT * FROM productos
        return $query->result();
    }

    public function obtenerPorId($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('productos');
        return $query->row();
    }

    /* ---------- Clase 4: escribir ---------- */

    public function crear($datos) {
        // TODO 1: insertar con $this->db->insert('productos', $datos)
        //   Recibe la tabla y un array asociativo:
        //   clave = nombre de la columna, valor = dato a guardar.
        // insertamos-creamos el registro del producto
        $this->db->insert('productos', $datos);
        // insert_id es el id generado al crear el producto
        return $this->db->insert_id();
        // TODO 2: retornar el id que quedó, con $this->db->insert_id()
    }

    /* ---------- Tarea: repaso del material ---------- */

    /* TAREA 1 — el where() va ANTES del update() */
    public function actualizar($id, $datos) {
        // TODO: $this->db->where('id', $id);
        //       return $this->db->update('productos', $datos);
    }

    /* TAREA 2 — ⚠️ sin el where(), delete() borra TODA la tabla */
    public function eliminar($id) {
        // TODO: $this->db->where('id', $id);
        //       return $this->db->delete('productos');
    }
}
