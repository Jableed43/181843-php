<?php $this->load->view('partials/head'); ?>

<h1>Productos</h1>

<div class="grilla-productos">
    <?php foreach ($productos as $producto): ?>
        <?php /* Cada tarjeta es un link a /producto/<id> (ruta definida en config/routes.php). */ ?>
        <a class="tarjeta-producto" href="<?php echo site_url('producto/' . $producto->id); ?>">
            <span class="codigo"><?php echo html_escape($producto->codigo); ?></span>
            <h3><?php echo html_escape($producto->nombre); ?></h3>
            <span class="precio">$<?php echo number_format($producto->precio, 2, ',', '.'); ?></span>

            <?php /* Etiqueta de stock según la cantidad */ ?>
            <?php if ($producto->stock == 0): ?>
                <span class="stock stock-agotado">Agotado</span>
            <?php elseif ($producto->stock <= 10): ?>
                <span class="stock stock-bajo">¡Últimas <?php echo $producto->stock; ?> unidades!</span>
            <?php else: ?>
                <span class="stock stock-ok">Stock: <?php echo $producto->stock; ?></span>
            <?php endif; ?>
        </a>
    <?php endforeach; ?>
</div>

<?php $this->load->view('partials/pie'); ?>
