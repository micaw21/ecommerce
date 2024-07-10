<!DOCTYPE html>
<html lang="es">

<body>
    <main>
        <h2> ♡ Comprar Producto ♡</h2>
        <script>
            <?php if (session()->getFlashdata('success')) : ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?= session()->getFlashdata('success') ?>',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true,
                    position: 'top-end',
                    background: '#fff',
                    width: '300px', 
                    padding: '1em', 
                    customClass: {
                        popup: 'small-swal-popup' 
                    }
                });
            <?php endif; ?>

            <?php if (session()->getFlashdata('fail')) : ?>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...!',
                    text: '<?= session()->getFlashdata('fail') ?>',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true,
                    position: 'top-end',
                    background: '#fff',
                    width: '300px', 
                    padding: '1em', 
                    customClass: {
                        popup: 'small-swal-popup' 
                    }
                });
            <?php endif; ?>
        </script>

        <div class="container">
            <div class="row">
                <div class="col">
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
                    <img src="<?= base_url($ruta_imagen) ?>" alt="Imagen del producto" class="producto">
                </div>
                <div class="col columna">
                    <div class="infoCompra">
                        <p class="titulo"> <?= $producto['nombre'] ?> </p>
                        <p class="precio"> $ <?= $producto['precio'] ?> </p>
                        <p class="descuento"> <span style="font-weight: bolder;"> 20% </span> descuento pagando por transferencia bancaria.
                        </p>
                        <form method="post" action="<?= base_url('agregarCarrito') ?>">
                        <p>Elija cantidad a agregar al carrito: </p>
                            <select class="form-select cantidad" id="cantidadSelect" aria-label="cantidad" name="cantidad">
                                <?php for ($i = 1; $i <= $producto['stock']; $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?> producto<?= $i > 1 ? 's' : '' ?></option>
                                <?php endfor; ?>
                            </select>
                            <p> Quedan <?= $producto['stock'] ?> disponibles! </p>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="id" value="<?= $producto['id_productos'] ?>">
                                        <input type="hidden" name="nombre" value="<?= $producto['nombre'] ?>">
                                        <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                                        <input type="hidden" name="stock" value="<?= $producto['stock'] ?>">
                                        <button type="submit" class="btn agregarCarr">
                                            Agregar al carrito
                                        </button>
                                    </div>
                                    <div class="col">
                                        <a href="<?php echo base_url('catalogo'); ?>" class="btn btn-danger cancelar">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>
    <script src="<?php echo base_url('/assets/FooterInfoScript.js'); ?>"> </script>
    <script src="<?php echo base_url('/assets/carritoScript.js'); ?>"> </script>
    <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js'); ?>"> </script>
</body>

</html>