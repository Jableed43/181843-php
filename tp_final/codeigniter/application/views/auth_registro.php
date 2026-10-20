<?php $this->load->view('partials/head'); ?>

<div class="formulario">
    <h2>Crear cuenta</h2>

    <?php /* form_open('registro') arma <form method="post" action=".../registro">
             y agrega SOLO el campo oculto de seguridad (token CSRF). */ ?>
    <?php echo form_open('registro'); ?>

        <div class="campo">
            <label for="nombre">Nombre</label>
            <?php /* set_value('nombre') vuelve a escribir lo que el usuario había puesto
                     si el formulario falló: así no tiene que tipear todo de nuevo. */ ?>
            <input type="text" id="nombre" name="nombre" value="<?php echo set_value('nombre'); ?>">
            <?php /* form_error() muestra el mensaje de error de ese campo (si lo hay). */ ?>
            <?php echo form_error('nombre', '<span class="error">', '</span>'); ?>
        </div>

        <div class="campo">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>">
            <?php echo form_error('email', '<span class="error">', '</span>'); ?>
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <?php /* Las contraseñas NUNCA se vuelven a mostrar: por eso no hay set_value acá. */ ?>
            <input type="password" id="password" name="password">
            <?php echo form_error('password', '<span class="error">', '</span>'); ?>
        </div>

        <div class="campo">
            <label for="password2">Repetir contraseña</label>
            <input type="password" id="password2" name="password2">
            <?php echo form_error('password2', '<span class="error">', '</span>'); ?>
        </div>

        <button type="submit" class="boton boton-ancho">Registrarme</button>

    <?php echo form_close(); ?>

    <p class="alternativa">¿Ya tenés cuenta? <a href="<?php echo site_url('login'); ?>">Iniciá sesión</a></p>
</div>

<?php $this->load->view('partials/pie'); ?>
