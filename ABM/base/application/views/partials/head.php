<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($titulo) ? $titulo : 'Distribuidora'; ?></title>

    <?php /* base_url() viene del helper 'url' (autocargado en autoload.php).
             Arma la URL absoluta del proyecto, así el CSS carga bien sin importar
             desde qué URL se entre (/productos o /productos/nuevo). */ ?>
    <link rel="stylesheet" href="<?php echo base_url('public/css/estilos.css'); ?>">
</head>
<body>
<div class="contenedor">
    <header class="barra">
        <img src="<?php echo base_url('public/images/logo.svg'); ?>" alt="Logo Distribuidora">
        <h1><?php echo isset($titulo) ? $titulo : 'Distribuidora'; ?></h1>
    </header>
