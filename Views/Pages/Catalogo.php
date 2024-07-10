<!DOCTYPE html>
<html lang="es">

<body>
    <main>

        <?php if(uri_string() == 'catalogo'): ?>
            <div class="banner">
                <img src="<?php echo base_url('/assets/img/catalogo/Banners/catalogo.gif');?>" class="d-block w-100">
            </div>
        <?php endif; ?>

        <?php if(uri_string() == 'mostrarCatalogoHS'): ?>
            <div class="banner">
                <img src="<?php echo base_url('/assets/img/catalogo/Banners/HS.gif');?>" class="d-block w-100">
            </div>
        <?php endif; ?>

        <?php if(uri_string() == 'mostrarCatalogoTS'): ?>
            <div class="banner">
                <img src="<?php echo base_url('/assets/img/catalogo/Banners/TS.gif');?>" class="d-block w-100">
            </div>
        <?php endif; ?>

        <?php if(uri_string() == 'mostrarCatalogo5SOS'): ?>
            <div class="banner">
                <img src="<?php echo base_url('/assets/img/catalogo/Banners/5SOS.gif');?>" class="d-block w-100">
            </div>
        <?php endif; ?>

        <?php if (!empty($productos)): ?>
            <div class="tabs">
                <div class="card-header cabecera">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="tab <?= uri_string() == 'catalogo' ? 'active' : '' ?>" href="<?= base_url('catalogo') ?>">Todas las categorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="tab <?= uri_string() == 'mostrarCatalogoHS' ? 'active' : '' ?>" href="<?= base_url('mostrarCatalogoHS') ?>">Harry Styles</a>
                        </li>
                        <li class="nav-item">
                            <a class="tab <?= uri_string() == 'mostrarCatalogoTS' ? 'active' : '' ?>" href="<?= base_url('mostrarCatalogoTS') ?>">Taylor Swift</a>
                        </li>
                        <li class="nav-item">
                            <a class="tab <?= uri_string() == 'mostrarCatalogo5SOS' ? 'active' : '' ?>" href="<?= base_url('mostrarCatalogo5SOS') ?>">5 Seconds Of Summer</a>
                        </li>
                    </ul>
                </div>

                <div class="col text-center">
                    <div class="filtrarCategorias">
                        <?php $currentUrl = current_url(); ?>
                        <?php if (strpos($currentUrl, 'catalogo')) { ?>
                            <form action="<?= site_url('catalogo') ?>" method="get">
                                <label class="filtrar" for="categoria">Filtrar por categoría:</label>
                                <select name="categoria" id="categoria">
                                    <option value="">Todas las Categorias</option>
                                    <?php foreach ($categorias as $categoria) { ?>
                                        <option value="<?php echo $categoria['id_categoria'];?>">
                                            <?php echo $categoria['id_categoria'], ". ", $categoria['descripcion']; }?>
                                        </option>
                                </select>
                                <button type="submit" class="btnCategorias">Filtrar</button>
                            </form>
                        <?php } ?>

                        <?php if(strpos( $currentUrl, 'mostrarCatalogoHS')) { ?>
                            <form action="<?= site_url('mostrarCatalogoHS') ?>" method="get">
                                <label class="filtrar" for="categoria">Filtrar por categoría:</label>
                                <select name="categoria" id="categoria">
                                    <option value="">Todas las Categorias</option>
                                    <?php foreach ($categorias as $categoria) { ?>
                                        <option value="<?php echo $categoria['id_categoria'];?>">
                                            <?php echo $categoria['id_categoria'], ". ", $categoria['descripcion']; }?>
                                        </option>
                                </select>
                                <button type="submit" class="btnCategorias">Filtrar</button>
                            </form>
                        <?php } ?>

                        <?php if(strpos( $currentUrl, 'mostrarCatalogoTS')) { ?>
                            <form action="<?= site_url('mostrarCatalogoTS') ?>" method="get">
                                <label class="filtrar" for="categoria">Filtrar por categoría:</label>
                                <select name="categoria" id="categoria">
                                    <option value="">Todas las Categorias</option>
                                    <?php foreach ($categorias as $categoria) { ?>
                                        <option value="<?php echo $categoria['id_categoria'];?>">
                                            <?php echo $categoria['id_categoria'], ". ", $categoria['descripcion']; }?>
                                        </option>
                                </select>
                                <button type="submit" class="btnCategorias">Filtrar</button>
                            </form>
                        <?php } ?>

                        <?php if(strpos( $currentUrl, 'mostrarCatalogo5SOS')) { ?>
                            <form action="<?= site_url('mostrarCatalogo5SOS') ?>" method="get">
                                <label class="filtrar" for="categoria">Filtrar por categoría:</label>
                                <select name="categoria" id="categoria">
                                    <option value="">Todas las Categorias</option>
                                    <?php foreach ($categorias as $categoria) { ?>
                                        <option value="<?php echo $categoria['id_categoria'];?>">
                                            <?php echo $categoria['id_categoria'], ". ", $categoria['descripcion']; }?>
                                        </option>
                                </select>
                                <button type="submit" class="btnCategorias">Filtrar</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>    
            </div>   
            <!-- <div class="container containerPrincipal"> -->
                <div class="containerPrincipal row">
                    <?php foreach ($productos as $producto): ?>
                        <div class="col-md-3 columna">
                            <div class="card tarjeta">
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
                                <div class="card-body tarjetaCuerpo">
                                        <a style="text-decoration: none;" class="compra" href="<?= site_url('comprar/' . $producto['id_productos']) ?>">
                                        <p class="card-text texto"><?= $producto['nombre']; ?></p>
                                    </a>
                                    <p class="card-text texto">$<?= number_format($producto['precio'], 2); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <!-- </div> -->
                
                <div class="paginacion" >
                    <?= $paginacion->links('products', 'default') ?>
                </div>
        <?php else: ?>
            <div class="text-center">
                <p class="sinStock"> No hay productos disponibles :( </p>
                <a href="<?php echo base_url('catalogo');?>" class="btn btnVolver">Volver al catálogo</a>
            </div>
        <?php endif; ?>
    </main>
    <script src="<?php echo base_url('/assets/FooterInfoScript.js');?>"> </script>
    <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js'); ?>"> </script>
</body>

</html>