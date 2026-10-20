<?php $this->load->view('partials/head'); ?>

<div class="detalle">
    <h1><?php echo html_escape($producto->nombre); ?></h1>

    <table>
        <tr><th>Nombre</th><td><?php echo html_escape($producto->nombre); ?></td></tr>
        <tr><th>Precio</th><td>$<?php echo number_format($producto->precio, 2, ',', '.'); ?></td></tr>
        <tr>
            <th>Stock</th>
            <td>
                <?php if ($producto->stock == 0): ?>
                    <span class="stock stock-agotado">Agotado</span>
                <?php else: ?>
                    <?php echo $producto->stock; ?> unidades
                <?php endif; ?>
            </td>
        </tr>
        <tr><th>Código</th><td><?php echo html_escape($producto->codigo); ?></td></tr>
    </table>

    <a class="boton" href="<?php echo site_url('/'); ?>">&larr; Volver a los productos</a>
</div>

<?php $this->load->view('partials/pie'); ?>
