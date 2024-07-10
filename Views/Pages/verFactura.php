<!DOCTYPE html>
<html lang="es">
<body>
    <main>
        <h2> ♡ Factura de Compra ♡</h2>

        <script>
            <?php if(session()->getFlashdata('compraRealizada')): ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Compra realizada con éxito!',
                    showCloseButton: true,
                    showConfirmButton: false,
                    timer: 3000, 
                    toast: true,
                    position: 'center',
                    background: '#fff',
                    customClass: {
                        title: 'sweet-title',
                        popup: 'sweet-popup',
                        icon: 'sweet-icon',
                        confirmButton: 'sweet-confirm-button'
                    }
                });
            <?php endif; ?>
        </script>   

        <h3>Factura #<?php echo $factura['id_factura']; ?></h3>

        <h4> Cabecera </h4>
        <div class="container">
            <table class="table text-center table-bordered">
                <thead>
                    <tr>
                        <th class="border border-secondary" style="background-color: #e1bbcc";>Cliente</th>
                        <th class="border border-secondary" style="background-color: #e1bbcc";>Fecha</th>
                        <th class="border border-secondary" style="background-color: #e1bbcc";>Importe Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> <?php echo $cliente['nombre']; ?> </td>
                        <td> <?php echo $factura['fecha']; ?> </td>
                        <td> $<?php echo number_format($factura['importe_total'], 2); ?> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h4>Detalles de la Factura</h4>
        <?php if (!empty($detalle)): ?>
            <div class="container datosDetalle">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>ID Producto</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Nombre Producto</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Categoría</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Subcategoría</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Cantidad</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Precio</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalle as $item): ?>
                        <tr>
                            <td><?php echo $item['id_producto']; ?></td>
                            <td><?php echo $item['nombre_producto']; ?></td>
                            <td><?php echo $item['categoria']; ?></td>
                            <td><?php echo $item['subcategoria']; ?></td>
                            <td><?php echo $item['cantidad']; ?></td>
                            <td>$<?php echo number_format($item['precio'], 2); ?></td>
                            <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No hay detalles para esta factura.</p>
        <?php endif; ?>
        <div class="container text-center">
            <a href="<?php echo base_url('catalogo'); ?>" class="btn btnVolver cancelar">Volver al catálogo</a>
        </div>
    </main>
    <script> var baseURL = "<?php echo base_url(); ?>"; </script>
    <script src="<?php echo base_url('/assets/FooterInfoScript.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/carrito.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
