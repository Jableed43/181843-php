<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* INSTALADOR AUTOMÁTICO — para que el proyecto funcione con "cero configuración".
 *
 * Un HOOK es código que CodeIgniter ejecuta en un momento fijo. Este corre ANTES de
 * arrancar (pre_system), en cada visita, y hace tres cosas:
 *   1) ¿Existe la base "tp_ecommerce" con la tabla "productos"?  -> listo, no hace nada (es muy rápido)
 *   2) Si no existe -> la crea e importa ecommerce.sql (tablas + 8 productos de ejemplo)
 *   3) Si MySQL está apagado -> muestra un aviso claro en vez de un error técnico
 *
 * Los datos de conexión se leen de application/config/database.php (los mismos que usa la app).
 */
class Instalador {

    public function preparar() {
        include APPPATH . 'config/database.php';      // define el array $db
        $c = $db['default'];

        mysqli_report(MYSQLI_REPORT_OFF);              // que no tire excepciones: manejamos los errores nosotros

        // 1) ¿Ya está instalado?
        $conexion = @new mysqli($c['hostname'], $c['username'], $c['password'], $c['database']);
        if (!$conexion->connect_errno) {
            $existe = $conexion->query("SHOW TABLES LIKE 'productos'");
            $yaInstalado = $existe && $existe->num_rows > 0;
            $conexion->close();
            if ($yaInstalado) {
                return;
            }
        }

        // 2) Todavía no: nos conectamos al servidor MySQL (sin elegir base) y corremos el SQL.
        $servidor = @new mysqli($c['hostname'], $c['username'], $c['password']);
        if ($servidor->connect_errno) {
            $this->mostrarAviso(
                'No se pudo conectar a MySQL',
                'Encendé <strong>MySQL</strong> desde el panel de XAMPP (botón <em>Start</em>) y recargá esta página.<br>
                 Si ya está encendido, revisá usuario y contraseña en <code>application/config/database.php</code>.<br>
                 <small>Detalle técnico: ' . htmlspecialchars($servidor->connect_error) . '</small>'
            );
        }

        $servidor->set_charset('utf8mb4');
        $sql = file_get_contents(FCPATH . 'ecommerce.sql');
        $servidor->multi_query($sql);
        do {
            if ($resultado = $servidor->store_result()) {
                $resultado->free();
            }
        } while ($servidor->more_results() && $servidor->next_result());

        if ($servidor->errno) {
            $this->mostrarAviso(
                'No se pudo crear la base de datos',
                'Importá a mano el archivo <code>ecommerce.sql</code> desde phpMyAdmin.<br>
                 <small>Detalle técnico: ' . htmlspecialchars($servidor->error) . '</small>'
            );
        }
        $servidor->close();
    }

    /* Página de aviso simple (se usa solo cuando algo del entorno falla). */
    private function mostrarAviso($titulo, $mensaje) {
        http_response_code(503);
        echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>' . $titulo . '</title></head>
              <body style="font-family:system-ui,Arial,sans-serif;max-width:560px;margin:70px auto;padding:0 20px;line-height:1.6">
              <h1 style="color:#b32424">⚠️ ' . $titulo . '</h1><p>' . $mensaje . '</p></body></html>';
        exit;
    }
}
