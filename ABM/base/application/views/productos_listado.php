<?php $this->load->view('partials/head'); ?>

<?php /* $mensaje llega por GET después de un redirect (crear/editar/eliminar).
         Es el patrón POST-Redirect-GET: si el usuario refresca esta página,
         solo se repite el GET, nunca se duplica la operación. */ ?>
<?php if ($mensaje === 'creado'): ?>
    <div class="banner-ok">✅ Producto creado correctamente.</div>
<?php elseif ($mensaje === 'editado'): ?>
    <div class="banner-ok">✅ Producto actualizado correctamente.</div>
<?php elseif ($mensaje === 'eliminado'): ?>
    <div class="banner-ok">🗑️ Producto eliminado correctamente.</div>
<?php endif; ?>

<a class="boton-link" href="<?php echo base_url('index.php/productos/nuevo'); ?>">+ Nuevo Producto</a>

<table>
    <tr>
        <th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th>
    </tr>
    <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?php echo $producto->id; ?></td>
            <td><?php echo htmlspecialchars($producto->nombre); ?></td>
            <td>$<?php echo number_format($producto->precio, 2); ?></td>
            <td><?php echo $producto->stock; ?></td>
            <?php /* El id viaja como TERCER SEGMENTO de la URL:
                     index.php / productos / editar / 3
                                controlador  método    parámetro */ ?>
            <td class="acciones">
                <a href="<?php echo base_url('index.php/productos/ver/' . $producto->id); ?>">Ver</a>
                <a href="<?php echo base_url('index.php/productos/editar/' . $producto->id); ?>">Editar</a>
                <a class="link-borrar" href="<?php echo base_url('index.php/productos/eliminar/' . $producto->id); ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php $this->load->view('partials/pie'); ?>
