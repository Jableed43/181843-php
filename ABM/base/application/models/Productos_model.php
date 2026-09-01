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

    /* ---------- Crear (Alta) ---------- */

    /*
     * insert() recibe la tabla y un array asociativo:
     *   clave = nombre de la columna, valor = dato a guardar.
     * Los valores se escapan solos: es inmune a inyección SQL.
     */
    public function crear($datos) {
        $this->db->insert('productos', $datos);   // INSERT INTO productos (...) VALUES (...)
        return $this->db->insert_id();             // el id autoincremental que quedó
    }

    /* ---------- Modificar ---------- */

    /* El where() va ANTES del update(), igual que en obtenerPorId(). */
    public function actualizar($id, $datos) {
        $this->db->where('id', $id);
        return $this->db->update('productos', $datos);   // UPDATE productos SET ... WHERE id = ?
    }

    /* ---------- Borrar (Baja) ----------
     * ⚠️ Sin el where(), delete() borra TODA la tabla. */
    public function eliminar($id) {
        $this->db->where('id', $id);
        return $this->db->delete('productos');            // DELETE FROM productos WHERE id = ?
    }
}
