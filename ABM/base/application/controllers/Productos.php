<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ABM de Productos — CodeIgniter 3
 *
 * Las 4 operaciones y su método:
 *   A - Alta         -> nuevo()
 *   B - Baja         -> eliminar($id)
 *   M - Modificación -> editar($id)
 *   (lectura)        -> index() / ver($id)
 *
 * Patrón que se repite en nuevo() y editar(): un mismo método atiende
 * GET (mostrar el formulario) y POST (procesar lo que se mandó).
 * ¿Quién decide? form_validation->run():
 *   FALSE -> no hay POST, o hay POST con errores  => mostrar el formulario
 *   TRUE  -> hay POST y pasó todas las reglas     => procesar
 *
 * Después de crear/editar/eliminar, SIEMPRE se hace un redirect() en vez de
 * cargar una vista directamente. Es el patrón POST-Redirect-GET: evita que,
 * si el usuario refresca la página, el navegador reenvíe el mismo POST y
 * duplique la operación.
 */
class Productos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Productos_model');
        $this->load->library('form_validation');
    }

    /* ==================== LEER ==================== */

    public function index() {
        $datos['titulo']    = 'Listado de Productos';
        $datos['productos'] = $this->Productos_model->obtenerTodos();

        /* El mensaje de éxito viaja como parámetro GET después del redirect
         * de nuevo() / editar() / eliminar(). Por eso puede faltar: por eso
         * el isset(). */
        $datos['mensaje'] = $this->input->get('msg');

        $this->load->view('productos_listado', $datos);
    }

    /*
     * El $id NO se lee del POST: llega como TERCER SEGMENTO de la URL y
     * CodeIgniter lo pasa como parámetro del método.
     *
     *     index.php / productos / ver / 3
     *                controlador  método  parámetro  ->  ver($id = 3)
     *
     * Ese id también es entrada del usuario: puede escribir /ver/99999
     * o /ver/abc. Si no existe, obtenerPorId() devuelve NULL y la vista
     * explotaría al hacer $producto->nombre. Por eso el if.
     */
    public function ver($id) {
        $producto = $this->Productos_model->obtenerPorId($id);

        if (!$producto) {
            show_404();
        }

        $datos['titulo']   = 'Detalle del producto';
        $datos['producto'] = $producto;
        $this->load->view('productos_detalle', $datos);
    }

    /* ==================== ALTA ==================== */

    public function nuevo() {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]', array(
            'required'   => 'El campo %s es obligatorio.',
            'min_length' => 'El campo %s necesita al menos 3 caracteres.'
        ));
        $this->form_validation->set_rules('precio', 'Precio', 'required|numeric', array(
            'required' => 'El campo %s es obligatorio.',
            'numeric'  => 'El campo %s tiene que ser un número.'
        ));
        $this->form_validation->set_rules('stock', 'Stock', 'required|numeric', array(
            'required' => 'El campo %s es obligatorio.',
            'numeric'  => 'El campo %s tiene que ser un número.'
        ));

        if ($this->form_validation->run() == FALSE) {
            // Primera visita o errores: se vuelve a mostrar el formulario.
            // set_value() y form_error(), dentro de la vista, se encargan
            // de repoblar los campos y mostrar los mensajes.
            $datos['titulo'] = 'Nuevo Producto';
            $this->load->view('productos_nuevo', $datos);

        } else {
            // Datos válidos. input->post() es la forma segura de leer el
            // POST: si el campo no existe devuelve NULL en vez de warning.
            $producto = array(
                'nombre' => $this->input->post('nombre'),
                'precio' => $this->input->post('precio'),
                'stock'  => $this->input->post('stock'),
            );

            $this->Productos_model->crear($producto);

            redirect('productos?msg=creado');
        }
    }

    /* ==================== MODIFICACIÓN ==================== */

    public function editar($id) {
        $producto = $this->Productos_model->obtenerPorId($id);

        if (!$producto) {
            show_404();
        }

        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]', array(
            'required'   => 'El campo %s es obligatorio.',
            'min_length' => 'El campo %s necesita al menos 3 caracteres.'
        ));
        $this->form_validation->set_rules('precio', 'Precio', 'required|numeric', array(
            'required' => 'El campo %s es obligatorio.',
            'numeric'  => 'El campo %s tiene que ser un número.'
        ));
        $this->form_validation->set_rules('stock', 'Stock', 'required|numeric', array(
            'required' => 'El campo %s es obligatorio.',
            'numeric'  => 'El campo %s tiene que ser un número.'
        ));

        if ($this->form_validation->run() == FALSE) {
            // Primera visita (todavía sin POST) o errores de validación.
            // En los dos casos hay que mostrar el formulario con datos:
            // el del producto que ya existe, o el que el usuario tipeó mal.
            // Por eso $producto se pasa siempre: set_value('campo', valor)
            // usa ese valor SOLO si todavía no hubo un intento de POST.
            $datos['titulo']   = 'Editar Producto';
            $datos['producto'] = $producto;
            $this->load->view('productos_editar', $datos);

        } else {
            $datosActualizados = array(
                'nombre' => $this->input->post('nombre'),
                'precio' => $this->input->post('precio'),
                'stock'  => $this->input->post('stock'),
            );

            $this->Productos_model->actualizar($id, $datosActualizados);

            redirect('productos?msg=editado');
        }
    }

    /* ==================== BAJA ====================
     *
     * Borrar es la única operación de las 4 que NO se hace con un solo
     * clic: primero se pide confirmación.
     *
     *   GET  /productos/eliminar/3  -> muestra "¿Seguro que querés borrar?"
     *   POST /productos/eliminar/3  -> ahí sí, borra de verdad
     *
     * ¿Por qué? Un link normal (<a href>) siempre dispara un GET, y un GET
     * jamás debería cambiar datos por sí solo -algo puede precargar esa URL
     * sin que el usuario lo pida (un antivirus, un buscador, el botón
     * "adelante" del navegador). Separar "mostrar la confirmación" de
     * "ejecutar el borrado" evita borrar algo por accidente.
     */
    public function eliminar($id) {
        $producto = $this->Productos_model->obtenerPorId($id);

        if (!$producto) {
            show_404();
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->Productos_model->eliminar($id);
            redirect('productos?msg=eliminado');

        } else {
            $datos['titulo']   = 'Eliminar Producto';
            $datos['producto'] = $producto;
            $this->load->view('productos_eliminar', $datos);
        }
    }
}
