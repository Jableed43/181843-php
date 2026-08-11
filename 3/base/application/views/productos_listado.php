<h1>Listado de Productos</h1>
<table border="1">
    <tr>
        <th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th>
    </tr>
    <?php foreach ($productos as $producto): ?>
        <tr>
            <td> <?php echo $producto->id; ?> </td>
            <td> <?php echo htmlspecialchars($producto->nombre); ?> </td>
            <td> <?php echo $producto->precio; ?> </td>
            <td> <?php echo $producto->stock; ?> </td>
        </tr>
        <?php endforeach; ?>
</table>
