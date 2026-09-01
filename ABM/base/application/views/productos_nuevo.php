<?php $this->load->view('partials/head'); ?>

<?php /* validation_errors() imprime TODOS los errores juntos: es el resumen de arriba.
         Después cada campo muestra el suyo con form_error(). */ ?>
<?php if (validation_errors()): ?>
    <div class="errores-resumen">
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>

<?php /* El form apunta al MISMO método que lo mostró: productos/nuevo.
         Por eso el controlador tiene que distinguir "mostrame el formulario"
         de "procesá lo que te mandé". Eso lo resuelve form_validation->run(). */ ?>
<form action="<?php echo base_url('index.php/productos/nuevo'); ?>" method="POST">

    <div class="campo">
        <label for="nombre">Nombre</label>
        <?php /* set_value() repuebla el campo con lo que el usuario ya había escrito,
                 para que un error de validación no le borre todo el formulario. */ ?>
        <input type="text" id="nombre" name="nombre" value="<?php echo set_value('nombre'); ?>">
        <div class="error"><?php echo form_error('nombre'); ?></div>
    </div>

    <div class="campo">
        <label for="precio">Precio</label>
        <input type="text" id="precio" name="precio" value="<?php echo set_value('precio'); ?>">
        <div class="error"><?php echo form_error('precio'); ?></div>
    </div>

    <div class="campo">
        <label for="stock">Stock</label>
        <input type="text" id="stock" name="stock" value="<?php echo set_value('stock'); ?>">
        <div class="error"><?php echo form_error('stock'); ?></div>
    </div>

    <button type="submit">Guardar</button>
</form>

<p><a href="<?php echo base_url('index.php/productos'); ?>">&larr; Volver al listado</a></p>

<?php $this->load->view('partials/pie'); ?>
