<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* CONTROLADOR de autenticación: registro, login y logout.
 *
 * Cada método de formulario (registro y login) hace DOS cosas con la misma URL:
 *   1) Entrás por primera vez (GET)  -> muestra el formulario vacío
 *   2) Apretás el botón (POST)       -> valida y, si está todo bien, procesa
 * Quien decide es form_validation->run():
 *   FALSE -> no hay POST, o hay POST con errores  => mostrar el formulario
 *   TRUE  -> hay POST y pasó todas las reglas     => procesar
 */
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuario_model');
    }

    /* ---------- REGISTRO ---------- */
    public function registro() {
        // Si ya hay una sesión iniciada, no tiene sentido registrarse de nuevo.
        if ($this->session->userdata('usuario')) {
            redirect('/');
        }

        // set_rules(name del input, etiqueta, reglas separadas por |, mensajes propios)
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[80]', array(
            'required'   => 'El campo %s es obligatorio.',
            'min_length' => 'El campo %s necesita al menos 3 caracteres.',
            'max_length' => 'El campo %s admite hasta 80 caracteres.'
        ));
        // is_unique[usuarios.email] consulta la base: "¿ya existe ese email en la tabla usuarios?"
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[usuarios.email]', array(
            'required'    => 'El campo %s es obligatorio.',
            'valid_email' => 'Escribí un %s válido (ej: nombre@correo.com).',
            'is_unique'   => 'Ese email ya está registrado.'
        ));
        $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[6]', array(
            'required'   => 'El campo %s es obligatorio.',
            'min_length' => 'La %s necesita al menos 6 caracteres.'
        ));
        // matches[password] compara este campo con el campo "password"
        $this->form_validation->set_rules('password2', 'Repetir contraseña', 'required|matches[password]', array(
            'required' => 'Repetí la contraseña.',
            'matches'  => 'Las contraseñas no coinciden.'
        ));

        if ($this->form_validation->run() == FALSE) {
            $datos['titulo'] = 'Crear cuenta';
            $this->load->view('auth_registro', $datos);
        } else {
            $this->Usuario_model->crear(
                $this->input->post('nombre'),
                $this->input->post('email'),
                $this->input->post('password')
            );

            // flashdata = mensaje que se guarda en la sesión y se muestra UNA sola vez.
            $this->session->set_flashdata('exito', '¡Cuenta creada! Ya podés iniciar sesión.');
            redirect('login');   // después de un POST exitoso siempre se redirige (evita reenviar el form con F5)
        }
    }

    /* ---------- LOGIN ---------- */
    public function login() {
        if ($this->session->userdata('usuario')) {
            redirect('/');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array(
            'required'    => 'El campo %s es obligatorio.',
            'valid_email' => 'Escribí un %s válido.'
        ));
        $this->form_validation->set_rules('password', 'Contraseña', 'required', array(
            'required' => 'El campo %s es obligatorio.'
        ));

        $datos['titulo'] = 'Iniciar sesión';

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth_login', $datos);
            return;
        }

        // Los campos están bien escritos. Ahora: ¿el usuario existe y la contraseña es correcta?
        $usuario = $this->Usuario_model->obtenerPorEmail($this->input->post('email'));

        // password_verify(lo que escribió, el hash guardado) -> TRUE o FALSE
        if ($usuario && password_verify($this->input->post('password'), $usuario->password)) {
            // Cambia el id de sesión al loguearse (buena práctica de seguridad).
            $this->session->sess_regenerate(TRUE);

            // Guardamos en la sesión SOLO lo necesario (nunca el hash de la contraseña).
            $this->session->set_userdata('usuario', array(
                'id'     => $usuario->id,
                'nombre' => $usuario->nombre,
                'email'  => $usuario->email,
            ));
            redirect('/');
        }

        // Mismo mensaje si falla el email o la contraseña: no le damos pistas a un atacante.
        $datos['error'] = 'Email o contraseña incorrectos.';
        $this->load->view('auth_login', $datos);
    }

    /* ---------- LOGOUT ---------- */
    public function logout() {
        $this->session->sess_destroy();   // borra la sesión
        redirect('/');
    }
}
