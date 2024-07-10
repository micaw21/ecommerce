<!DOCTYPE html>
<html lang="es">
<body>
    <main>
        <h2> ♡ Administrar Compras ♡</h2>

        <script>
            // Verificar si hay un mensaje flash de éxito
            <?php if(session()->getFlashdata('success')): ?>
                // Configuración personalizada de SweetAlert para el mensaje de éxito
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?= session()->getFlashdata('success') ?>',
                    showCloseButton: true,
                    showConfirmButton: false,
                    timer: 3000, // Mostrar el mensaje durante 3 segundos
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
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

        <div class="container">
            <?php if (empty($facturasCompletas)) : ?>
                <h3 class="text-center">No hay facturas para mostrar</h3>
            <?php else: ?>
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>ID Factura</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Cliente</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Fecha</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Importe</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Ver Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($facturasCompletas as $facturaCompleta): ?>
                            <tr>
                                <td><?php echo $facturaCompleta['factura']['id_factura']; ?></td>
                                <td><?php echo $facturaCompleta['cliente']['nombre']; ?></td>
                                <td><?php echo $facturaCompleta['factura']['fecha']; ?></td>
                                <td>$<?php echo number_format($facturaCompleta['factura']['importe_total'], 2); ?></td>
                                <td>
                                    <!-- Botón para abrir el modal -->
                                    <button type="button" class="btn btnDetalle" data-bs-toggle="modal" data-bs-target="#modal_<?php echo $facturaCompleta['factura']['id_factura']; ?>">Detalles</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="paginacion">
                    <?= $paginacion->links('facturas', 'default') ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Modales fuera de la tabla -->
        <?php foreach($facturasCompletas as $facturaCompleta): ?>
            <div class="modal fade" id="modal_<?php echo $facturaCompleta['factura']['id_factura']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_<?php echo $facturaCompleta['factura']['id_factura']; ?>Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="modal_<?php echo $facturaCompleta['factura']['id_factura']; ?>Label">Detalles de factura #<?php echo $facturaCompleta['factura']['id_factura']; ?></h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <table class="table table-bordered text-center tablaDetalle">
                                    <thead>
                                        <tr>
                                            <th class="border border-secondary" style="background-color: #e1bbcc;">ID Detalle</th>
                                            <th class="border border-secondary" style="background-color: #e1bbcc;">Producto</th>
                                            <th class="border border-secondary" style="background-color: #e1bbcc;">Categoría</th>
                                            <th class="border border-secondary" style="background-color: #e1bbcc;">Subcategoría</th>
                                            <th class="border border-secondary" style="background-color: #e1bbcc;">Cantidad</th>
                                            <th class="border border-secondary" style="background-color: #e1bbcc;">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($facturaCompleta['detalle'] as $detalle): ?>
                                            <tr>
                                                <td><?php echo $detalle['id_detalle_factura']; ?></td>
                                                <td><?php echo $detalle['nombre_producto']; ?></td>
                                                <td><?php echo $detalle['categoria']; ?></td>
                                                <td><?php echo $detalle['subcategoria']; ?></td>
                                                <td><?php echo $detalle['cantidad']; ?></td>
                                                <td>$<?php echo number_format($detalle['subtotal'], 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </main>

    <!-- Scripts al final del body -->
    <script> var baseURL = "<?php echo base_url(); ?>"; </script>
    <script src="<?php echo base_url('/assets/FooterInfoScript.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/carrito.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>