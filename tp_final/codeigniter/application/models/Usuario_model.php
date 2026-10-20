<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* MODELO de usuarios: guardar (registro) y buscar (login). */
class Usuario_model extends CI_Model {

    /* REGISTRO: inserta un usuario nuevo.
     *
     * ⚠️ La contraseña NO se guarda como la escribió el usuario.
     * password_hash() la convierte en un "hash" (texto ilegible e irreversible).
     * Si alguien robara la base de datos, no vería las contraseñas reales.
     * Para comprobarla después se usa password_verify() (ver Auth::login). */
    public function crear($nombre, $email, $password) {
        $datos = array(
            'nombre'   => $nombre,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        );
        $this->db->insert('usuarios', $datos);   // INSERT INTO usuarios (...) VALUES (...)
        return $this->db->insert_id();           // el id que se le asignó
    }

    /* LOGIN: busca un usuario por email (o NULL si no existe). */
    public function obtenerPorEmail($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('usuarios');
        return $query->row();
    }
}
