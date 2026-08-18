<?php $this->load->view('partials/head'); ?>

<div class="errores-resumen" style="background:#eafaf1;border-left-color:#27ae60;">
    <p style="color:#1e8b4d;">
        ✅ Producto <strong><?php echo htmlspecialchars($nombre); ?></strong>
        guardado con el ID <strong><?php echo $id_insertado; ?></strong>.
    </p>
</div>

<?php /* El "email" que se habría enviado.
         En clase NO se envía de verdad: no hay servidor SMTP configurado.
         Ver el comentario del controlador (metodo notificarAlta). */ ?>
<?php if (isset($email_simulado)): ?>
    <div class="email-simulado">
        <strong>📧 Email simulado</strong> — así se habría enviado la notificación.
        <br>
        <small>El aviso <em>"Unable to send email"</em> es lo esperado en clase: no hay
        servidor SMTP configurado. Debajo está el email ya armado por CodeIgniter,
        que es exactamente lo que saldría con un SMTP real.</small>
        <?php echo $email_simulado; ?>
    </div>
<?php endif; ?>

<p>
    <a class="boton-link" href="<?php echo base_url('index.php/productos'); ?>">Ver el listado</a>
    &nbsp;
    <a href="<?php echo base_url('index.php/productos/nuevo'); ?>">Cargar otro producto</a>
</p>

<?php $this->load->view('partials/pie'); ?>
