<?php $this->load->view('partials/head'); ?>

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
                     index.php / productos / ver / 3
                                controlador  método  parámetro */ ?>
            <td><a href="<?php echo base_url('index.php/productos/ver/' . $producto->id); ?>">Ver</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php $this->load->view('partials/pie'); ?>
