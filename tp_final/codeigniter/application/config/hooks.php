<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/


/* ---------- Instalador automático de la base de datos ----------
 * Corre ANTES de que arranque CodeIgniter. Si la base "tp_ecommerce" todavía no
 * existe, la crea e importa ecommerce.sql solo. Por eso no hay que importar nada a mano. */
$hook["pre_system"][] = array(
    "class"    => "Instalador",
    "function" => "preparar",
    "filename" => "Instalador.php",
    "filepath" => "hooks"
);
