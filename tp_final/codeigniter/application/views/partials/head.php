<?php
/* PARTIAL = un pedazo de vista que se repite en todas las páginas (cabecera, menú).
 * Cada página lo incluye con:  $this->load->view('partials/head');
 *
 * $usuario sale de la sesión: si alguien inició sesión, ya sabemos su nombre. */
$usuario = $this->session->userdata('usuario');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo html_escape(isset($titulo) ? $titulo : 'Mi Tienda'); ?> · Mi Tienda</title>
    <?php /* base_url() arma la URL absoluta del proyecto: el CSS carga bien desde cualquier página. */ ?>
    <link rel="stylesheet" href="<?php echo base_url('public/css/estilos.css'); ?>">
</head>
<body>

<header class="barra">
    <a class="marca" href="<?php echo site_url('/'); ?>">🛒 Mi Tienda</a>

    <nav class="menu">
        <a href="<?php echo site_url('/'); ?>">Inicio</a>

        <?php if ($usuario): ?>
            <span class="saludo">Hola, <?php echo html_escape($usuario['nombre']); ?></span>
            <a href="<?php echo site_url('logout'); ?>">Salir</a>
        <?php else: ?>
            <a href="<?php echo site_url('login'); ?>">Ingresar</a>
            <a href="<?php echo site_url('registro'); ?>">Registrarse</a>
        <?php endif; ?>
    </nav>
</header>

<main class="contenedor">
    <?php /* Mensaje de una sola vez (lo dejó un controlador con set_flashdata). */ ?>
    <?php if ($this->session->flashdata('exito')): ?>
        <div class="mensaje mensaje-exito"><?php echo html_escape($this->session->flashdata('exito')); ?></div>
    <?php endif; ?>
