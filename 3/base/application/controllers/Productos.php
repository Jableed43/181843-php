<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // TODO 1: cargar el modelo Productos_model
        $this->load->model("Productos_model");
    }

    public function index() {
        // TODO 2: armar $datos['productos'] llamando al método del modelo
        // TODO 3: cargar la vista 'productos_listado' pasando $datos
        $datos['productos'] = $this->Productos_model->obtenerTodos();
        $this->load->view('productos_listado', $datos);
    }
}
