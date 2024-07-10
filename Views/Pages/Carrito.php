<!DOCTYPE html>
<html lang="es">
<body>
    <main>
        <h2> ♡ Carrito de Compras ♡</h2>

        <script>
            <?php if(session()->getFlashdata('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?= session()->getFlashdata('success') ?>',
                    showCloseButton: true,
                    showConfirmButton: false,
                    timer: 3000, 
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

        <script>
            <?php if(session()->getFlashdata('compraRealizada')): ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Compra realizada con éxito!',
                    showCloseButton: true,
                    showConfirmButton: false,
                    timer: 3000, 
                    timerProgressBar: true,
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

        <script>
            <?php if(session()->getFlashdata('fail')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?= session()->getFlashdata('fail') ?>',
                    width: '300px',
                    padding: '1em',
                    customClass: {
                        popup: 'small-swal-popup'
                    }
                });
            <?php endif; ?>
        </script>

        <?php
            $session = session();
            $cart = \Config\Services::cart();
            $cart = $cart->contents();
        ?>
        <div class="text-center">
            <?php if (empty($cart)) : ?>
                <h4> No hay productos en el carrito :( </h4>
                <a href="<?php echo base_url('catalogo'); ?>" class="btn btnVolver">Volver al catálogo</a>
                <a href="#" class="btn btnHistorial" data-bs-toggle="offcanvas" data-bs-target="#offcanvasHistorial" aria-controls="offcanvasHistorial">Ver Historial de Compras</a>

                <!-- Offcanvas para mostrar detalles de compra -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasHistorial" aria-labelledby="offcanvasHistorialLabel">
            <div class="offcanvas-header">
                <h2 class="offcanvas-title" id="offcanvasHistorialLabel">Historial de Compras</h2>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php foreach ($facturasCompletas as $compra): ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col text-center">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Compra #<?php echo $compra['factura']['id_factura']; ?></h5>
                                    <h5 class="card-title">Fecha <?php echo $compra['factura']['fecha']; ?></h5>
                                    <p class="card-text">
                                        Detalles de la compra: 
                                    </p>
                                    <div class="offcanvas-body text-center">
                                        <ul>
                                            <?php foreach ($compra['detalle'] as $producto): ?>
                                                <div class="row products text-center">
                                                    <div class="col-md-4">
                                                        <?php
                                                            $categoria_id = $producto['categoria_id'];
                                                            $url_imagen = $producto['url_imagen'];
                                                            $subcategoria_id = $producto['id_subcategoria'];
                                                            $ruta_imagen = '';
                                                            if ($categoria_id == 1) {
                                                                if ($subcategoria_id == 1) {
                                                                    $ruta_imagen = 'assets/img/catalogo/Buzos/HS/' . $url_imagen;
                                                                } elseif ($subcategoria_id == 2) {
                                                                    $ruta_imagen = 'assets/img/catalogo/Buzos/TS/' . $url_imagen;
                                                                } elseif ($subcategoria_id == 3) {
                                                                    $ruta_imagen = 'assets/img/catalogo/Buzos/5SOS/' . $url_imagen;
                                                                } else {
                                                                    $ruta_imagen = 'assets/img/catalogo/Buzos/' . $url_imagen;
                                                                }
                                                            } elseif ($categoria_id == 2) {
                                                                $ruta_imagen = 'assets/img/catalogo/Jeans/' . $url_imagen;
                                                            } elseif ($categoria_id == 3) {
                                                                if ($subcategoria_id == 1) {
                                                                    $ruta_imagen = 'assets/img/catalogo/Remeras/HS/' . $url_imagen;
                                                                } elseif ($subcategoria_id == 2) {
                                                                    $ruta_imagen = 'assets/img/catalogo/Remeras/TS/' . $url_imagen;
                                                                } elseif ($subcategoria_id == 3) {
                                                                    $ruta_imagen = 'assets/img/catalogo/Remeras/5SOS/' . $url_imagen;
                                                                } else {
                                                                    $ruta_imagen = 'assets/img/catalogo/Remeras/' . $url_imagen;
                                                                }
                                                            } 
                                                            ?>
                                                        <img src="<?= base_url($ruta_imagen)?>" alt="Imagen del producto" class="card-img-top img-f">
                                                    </div>
                                                    <div class="col">
                                                        <li class="listarDetalles"><?php echo $producto['nombre_producto']; ?></li>
                                                        <li class="listarDetalles">Cantidad: <?php echo $producto['cantidad']; ?></li>
                                                        <li class="listarDetalles">Subtotal: $ <?php echo $producto['subtotal']; ?></li>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="text-center" style="margin-right: 50px;" >
                                                <strong> Total: $ <?php echo $compra['factura']['importe_total']; ?></strong>
                                            </div>
                                        </ul>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
            <?php else : ?>
                <div class="container datos">
                    <table class="table text-center border border-secondary">
                        <tr>
                            <td class="border border-secondary" style="background-color: #e1bbcc;">ID</td>
                            <td class="border border-secondary" style="background-color: #e1bbcc;">Nombre</td>
                            <td class="border border-secondary" style="background-color: #e1bbcc;">Precio</td>
                            <td class="border border-secondary" style="background-color: #e1bbcc;">Cantidad</td>
                            <td class="border border-secondary" style="background-color: #e1bbcc;">Total</td>
                            <td class="border border-secondary" style="background-color: #e1bbcc;"></td>
                        </tr>
                            <?php 
                                echo form_open('actualizarCarrito');
                                $granTotal = 0;
                                foreach($cart as $item):
                                    echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                    echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                    echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                    echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                    echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                            ?>

                        <tr>
                            <td class="border border-secondary"><?php echo $item['id']; ?></td>
                            <td class="border border-secondary"><?php echo $item['name']; ?></td>
                            <td class="border border-secondary"> $ <?php echo number_format($item['price'], 2); ?></td>

                            <td class="border border-secondary">
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity('<?php echo $item['rowid']; ?>', -1, <?php echo $item['options']['stock']; ?>)">-</button>
                                        <input type="text" class="form-control text-center" value="<?php echo $item['qty']; ?>" id="qty-<?php echo $item['rowid']; ?>" readonly>
                                    <button id="btn-increment-<?php echo $item['rowid']; ?>" class="btn btn-outline-secondary" type="button" onclick="changeQuantity('<?php echo $item['rowid']; ?>', 1, <?php echo $item['options']['stock']; ?>)">+</button>
                                </div>
                            </td>

                            <td class="border border-secondary">$<?php echo number_format($item['subtotal'], 2); ?></td>
                            <td class="border border-secondary"> 
                                <button type="button" onclick="quitarDelCarrito('<?php echo $item['rowid']; ?>')" style="border: none; background: none;">
                                    <img src="<?php echo base_url('/assets/img/carrito/eliminar.png');?>" alt="Quitar del carrito" class="borrarCart">
                                </button>
                            </td>
                        </tr>
                        <?php 
                            $granTotal += $item['subtotal'];
                            endforeach; 
                        ?>
                        <tr>
                            <td class="border border-secondary" style="background-color: #e1bbcc;"><b>Total:</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b> $ <?php echo number_format($granTotal, 2); ?></b></td>
                            <td></td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col text-center">
                            <a href="<?php echo base_url('catalogo'); ?>" class="btn btnVolver cancelar">Volver al catálogo</a>
                        </div>

                        <div class="col text-center">
                            <a href="<?php echo base_url('comprarCarrito'); ?>" class="btn btn-success">Comprar</a>
                        </div>

                        <div class="col text-center">
                            <a class="btn btn-danger" onclick="quitarDelCarrito('all')">Cancelar</a>
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
            <?php endif; ?>
        </div>
    </main>

    <script> var baseURL = "<?php echo base_url(); ?>"; </script>
    <script src="<?php echo base_url('/assets/FooterInfoScript.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/carrito.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
