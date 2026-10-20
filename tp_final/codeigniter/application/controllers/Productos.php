<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* CONTROLADOR de productos = decide QUÉ mostrar.
 *   Home    -> index()   URL: /                (ruta por defecto, ver config/routes.php)
 *   Detalle -> ver($id)  URL: /producto/3      (ruta definida en config/routes.php)
 */
class Productos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Producto_model');
    }

    /* HOME: listado de productos. */
    public function index() {
        $datos['titulo']    = 'Productos';
        $datos['productos'] = $this->Producto_model->obtenerTodos();   // 1) pido los datos al MODELO
        $this->load->view('productos_listado', $datos);                // 2) se los paso a la VISTA
    }

    /* DETALLE: un producto. El $id llega desde la URL (/producto/3 -> $id = 3). */
    public function ver($id) {
        $producto = $this->Producto_model->obtenerPorId($id);

        // Si el id no existe en la base, mostramos la página 404 en vez de romper.
        if (!$producto) {
            show_404();
        }

        $datos['titulo']   = $producto->nombre;
        $datos['producto'] = $producto;
        $this->load->view('productos_detalle', $datos);
    }
}
