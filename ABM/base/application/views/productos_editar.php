<?php $this->load->view('partials/head'); ?>

<?php if (validation_errors()): ?>
    <div class="errores-resumen">
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>

<?php /* El form apunta al MISMO método que lo mostró: productos/editar/{id}.
         Igual que en el alta, form_validation->run() distingue "mostrame
         el formulario" de "procesá lo que mandaste". */ ?>
<form action="<?php echo base_url('index.php/productos/editar/' . $producto->id); ?>" method="POST">

    <div class="campo">
        <label for="nombre">Nombre</label>
        <?php /* set_value('campo', $valor_por_defecto) — la diferencia con el
                 alta: acá SÍ hay un valor por defecto, el que ya tiene el
                 producto en la base. set_value() lo usa solo la primera vez;
                 si ya hubo un POST con error, prioriza lo que el usuario
                 tipeó, para no perderle la corrección. */ ?>
        <input type="text" id="nombre" name="nombre" value="<?php echo set_value('nombre', $producto->nombre); ?>">
        <div class="error"><?php echo form_error('nombre'); ?></div>
    </div>

    <div class="campo">
        <label for="precio">Precio</label>
        <input type="text" id="precio" name="precio" value="<?php echo set_value('precio', $producto->precio); ?>">
        <div class="error"><?php echo form_error('precio'); ?></div>
    </div>

    <div class="campo">
        <label for="stock">Stock</label>
        <input type="text" id="stock" name="stock" value="<?php echo set_value('stock', $producto->stock); ?>">
        <div class="error"><?php echo form_error('stock'); ?></div>
    </div>

    <button type="submit">Guardar cambios</button>
</form>

<p><a href="<?php echo base_url('index.php/productos'); ?>">&larr; Volver al listado</a></p>

<?php $this->load->view('partials/pie'); ?>
