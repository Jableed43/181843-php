<?php $this->load->view('partials/head'); ?>

<table>
    <tr><th>ID</th><td><?php echo $producto->id; ?></td></tr>
    <tr><th>Nombre</th><td><?php echo htmlspecialchars($producto->nombre); ?></td></tr>
    <tr><th>Precio</th><td>$<?php echo number_format($producto->precio, 2); ?></td></tr>
    <tr><th>Stock</th><td><?php echo $producto->stock; ?></td></tr>
</table>

<p>
    <a class="boton-link" href="<?php echo base_url('index.php/productos'); ?>">&larr; Volver al listado</a>
</p>

<?php $this->load->view('partials/pie'); ?>
