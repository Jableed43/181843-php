<?php $this->load->view('partials/head'); ?>

<div class="errores-resumen">
    <p>
        ¿Seguro que querés eliminar el producto
        <strong><?php echo htmlspecialchars($producto->nombre); ?></strong>
        (ID <?php echo $producto->id; ?>)? Esta acción no se puede deshacer.
    </p>
</div>

<?php /* Esta página se pidió con GET (un link normal). El borrado en sí
         se dispara con un form que manda POST a la MISMA url — así el
         controlador sabe que ya se confirmó y recién ahí borra. */ ?>
<form action="<?php echo base_url('index.php/productos/eliminar/' . $producto->id); ?>" method="POST">
    <button type="submit" class="boton-peligro">Sí, eliminar</button>
    <a class="boton-link" href="<?php echo base_url('index.php/productos'); ?>">Cancelar</a>
</form>

<?php $this->load->view('partials/pie'); ?>
