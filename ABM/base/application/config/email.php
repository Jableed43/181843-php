<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CONFIGURACIÓN DE EMAIL
| -------------------------------------------------------------------------
| CodeIgniter lee este archivo automáticamente al hacer:
|     $this->load->library('email');
| No hay que pasarle nada a mano.
|
| ⚠️ MODO CLASE (SIMULADO)
| En clase NO enviamos emails de verdad: XAMPP no trae servidor SMTP y
| configurar uno real (Gmail, contraseña de aplicación, puertos) es una
| fuente de problemas que no aporta al tema.
|
| El código del controlador es EXACTAMENTE el que se usaría en producción.
| Lo único que cambia es que, en vez de mirar el resultado de send(),
| mostramos por pantalla el email que se habría enviado, con print_debugger().
|
| -------------------------------------------------------------------------
| PARA QUE ENVÍE DE VERDAD (fuera de clase)
| -------------------------------------------------------------------------
| Descomentar el bloque SMTP de abajo y completar con datos reales.
| Con Gmail hace falta una "contraseña de aplicación", no la del usuario:
|     https://myaccount.google.com/apppasswords
*/

$config['protocol']   = 'mail';   // 'mail' | 'sendmail' | 'smtp'
$config['mailtype']   = 'text';   // 'text' | 'html'
$config['charset']    = 'UTF-8';
$config['wordwrap']   = TRUE;
$config['newline']    = "\r\n";
$config['crlf']       = "\r\n";

// --- Configuración SMTP real (comentada) ---
// $config['protocol']  = 'smtp';
// $config['smtp_host'] = 'smtp.gmail.com';
// $config['smtp_port'] = 587;
// $config['smtp_crypto'] = 'tls';
// $config['smtp_user'] = 'tu_cuenta@gmail.com';
// $config['smtp_pass'] = 'la_contrasenia_de_aplicacion';
// $config['smtp_timeout'] = 10;
