<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Productos_model');
        $this->load->library('form_validation');
    }

    /* ---------- Clase 3: ya resuelto ---------- */
    public function index() {
        $datos['titulo']    = 'Listado de Productos';
        $datos['productos'] = $this->Productos_model->obtenerTodos();
        $this->load->view('productos_listado', $datos);
    }

    /* ---------- Ver un producto ----------
     *
     * El $id NO se lee del POST: llega como TERCER SEGMENTO de la URL y
     * CodeIgniter lo pasa como parámetro del método.
     *
     *     index.php / productos / ver / 3
     *                controlador  método  parámetro  ->  ver($id = 3)
     *
     * ⚠️ Ese id también es entrada del usuario: puede escribir /ver/99999
     *    o /ver/abc. Si no existe, obtenerPorId() devuelve NULL y la vista
     *    explotaría al hacer $producto->nombre.
     */
    public function ver($id) {

        // TODO A: traer el producto con $this->Productos_model->obtenerPorId($id)
        //         (ese método lo escribieron en la Clase 3 y nunca lo usamos)

        // TODO B: si no existe, cortar con show_404();

        // TODO C: armar $datos con 'titulo' y 'producto',
        //         y cargar la vista 'productos_detalle'

    }

    /* ---------- Clase 4: el alta ----------
     *
     * ⚠️ UN SOLO MÉTODO HACE DOS COSAS:
     *    1) Entrás por primera vez (GET)  -> muestra el formulario vacío
     *    2) Apretás Guardar (POST)        -> valida y, si está bien, inserta
     *
     * ¿Quién decide cuál de las dos? form_validation->run():
     *    FALSE -> no hay POST, o hay POST con errores  => mostrar el formulario
     *    TRUE  -> hay POST y pasó todas las reglas     => procesar
     */
    public function nuevo() {

        // TODO 1: reglas de validación con set_rules()
        //   set_rules(name del input, etiqueta del mensaje, reglas separadas por |)
        //   - 'nombre' -> required | min_length[3]
        //   - 'precio' -> required | numeric
        //   - 'stock'  -> required | numeric

        // TODO 2: mensajes en español (4º parámetro de set_rules)
        //   Es un array: clave = nombre de la regla, valor = mensaje.
        //   El %s se reemplaza por la etiqueta del 2º parámetro.
        //   Ej: array('required' => 'El campo %s es obligatorio.')

        // TODO 3: el if que decide qué hacer
        //   if ($this->form_validation->run() == FALSE) {
        //       $datos['titulo'] = 'Nuevo Producto';
        //       cargar la vista 'productos_nuevo' pasándole $datos
        //   } else {
        //       armar el array $producto leyendo con $this->input->post('campo')
        //       $idInsertado = $this->Productos_model->crear($producto);
        //       armar $datos con: titulo, nombre, id_insertado y email_simulado
        //       cargar la vista 'productos_exito'
        //   }

    }

    /* ---------- Notificación por email ----------
     *
     * ⚠️ ESTO NO SE HACE EN CLASE. Ya viene resuelto, para leer.
     *
     * El envío de emails está en el material de la unidad, pero mandar un
     * mail de verdad necesita un servidor SMTP configurado (una cuenta, una
     * contraseña de aplicación, puertos). Eso no se resuelve en clase.
     *
     * MODO SIMULADO — el código es el mismo que en producción, salvo:
     *   @           evita el warning de PHP por no haber servidor de correo
     *   send(FALSE) le pide que NO limpie los datos, para poder verlos después
     *   print_debugger() devuelve el email ya armado, y lo mostramos en pantalla
     *
     * Para que envíe de verdad: configurar el bloque SMTP de
     * application/config/email.php y reemplazar las dos últimas líneas por:
     *     return $this->email->send();
     *
     * 📖 Está explicado en la tarea (instrucciones_alumno.md).
     */
    private function notificarAlta($producto, $id) {
        $this->load->library('email');

        $this->email->from('sistema@distribuidora.com', 'Sistema de Stock');
        $this->email->to('deposito@distribuidora.com');
        $this->email->subject('Nuevo producto cargado: ' . $producto['nombre']);
        $this->email->message(
            "Se cargo un producto nuevo en el sistema.\n\n" .
            "ID: {$id}\n" .
            "Nombre: {$producto['nombre']}\n" .
            "Precio: {$producto['precio']}\n" .
            "Stock: {$producto['stock']}\n"
        );

        @$this->email->send(FALSE);

        return $this->email->print_debugger(array('headers', 'subject', 'body'));
    }
}
