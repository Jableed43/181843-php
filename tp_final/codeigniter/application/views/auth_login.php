<?php $this->load->view('partials/head'); ?>

<div class="formulario">
    <h2>Iniciar sesión</h2>

    <?php /* $error lo manda el controlador cuando el email o la contraseña no coinciden. */ ?>
    <?php if (isset($error)): ?>
        <div class="mensaje mensaje-error"><?php echo html_escape($error); ?></div>
    <?php endif; ?>

    <?php echo form_open('login'); ?>

        <div class="campo">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>">
            <?php echo form_error('email', '<span class="error">', '</span>'); ?>
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password">
            <?php echo form_error('password', '<span class="error">', '</span>'); ?>
        </div>

        <button type="submit" class="boton boton-ancho">Ingresar</button>

    <?php echo form_close(); ?>

    <p class="alternativa">¿No tenés cuenta? <a href="<?php echo site_url('registro'); ?>">Registrate</a></p>
</div>

<?php $this->load->view('partials/pie'); ?>
