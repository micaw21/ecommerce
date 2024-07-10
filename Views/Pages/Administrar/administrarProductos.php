<!DOCTYPE html>
<html lang="es">

<body>
    <main>
        <h2> ♡ Administrar Productos ♡</h2>

        <?php if (!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>

        <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>

        
        
        <div class="row">
            <div class="col text-center">
                <div class="filtrarCategorias">
                    <form action="<?= site_url('administrarProductos') ?>" method="get">
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
                </div>
            </div>
            <div class="col text-center">
                <div class="filtrarSubcategorias">
                    <form action="<?= site_url('administrarProductos') ?>" method="get">
                        <label for="subcategoria">Filtrar por subcategoria:</label>
                        <select name="subcategoria" id="subcategoria">
                            <option value="">Todos las subcategorias</option>
                            <?php foreach ($subcategorias as $subcategoria) { ?>
                                <option value="<?php echo $subcategoria['id_subcategoria'];?>">
                                    <?php echo $subcategoria['id_subcategoria'], ". ", $subcategoria['descripcion']; }?>
                                </option>
                        </select>
                        <button class="btnSubcategoria" type="submit">Filtrar</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <div class="btn-group-vertical altaProducto" role="group">
                    <a href="<?= site_url('altaCategoria') ?>" class="btn btnCategoria">Añadir Categoría</a>
                    <button type="button" class="btn btnSubcat" data-bs-toggle="modal" data-bs-target="#categoriasModal">
                        Eliminar Categoría
                    </button>
                </div>
            </div>
            <div class="col">
                <div class="btn-group-vertical altaProducto" role="group">
                    <a href="<?= site_url('altaSubCategoria') ?>" class="btn btnCategoria">Añadir Subcategoría</a>
                    <button type="button" class="btn btnSubcat" data-bs-toggle="modal" data-bs-target="#subcategoriasModal">
                        Eliminar Subcategoría
                    </button>
                </div>
            </div>
            <div class="col">
                <div class="btn-group-vertical altaProducto" role="group">
                    <a href="<?= site_url('altaProducto') ?>" class="btn btnProducto">Añadir producto</a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="categoriasModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="categoriasModalLabel">Eliminar Categoría</h3>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('bajaCategoria') ?>" method="get">
                        <div class="mb-3">
                            <label for="categoriaSelect" class="form-label">Selecciona una categoría:</label>
                            <select class="form-select" id="categoriaSelect" name="id_categoria" required>
                                <?php foreach($categorias as $categoria): ?>
                                    <option value="<?= $categoria['id_categoria']; ?>"><?= $categoria['descripcion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btnProducto">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="subcategoriasModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="subcategoriasModalLabel">Eliminar Sub-Categoría</h3>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('BajaSubCategoria') ?>" method="get">
                        <div class="mb-3">
                            <label for="categoriaSelect" class="form-label">Selecciona una categoría:</label>
                            <select class="form-select" id="categoriaSelect" name="id_subcategoria" required>
                                <?php foreach($subcategorias as $subcategoria): ?>
                                    <option value="<?= $subcategoria['id_subcategoria']; ?>"><?= $subcategoria['descripcion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btnProducto">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
                </div>
            </div>
        </div>


        
        <?php if (!empty($productosActivos)) : ?>
            <div class="tabla">
                <table class="table text-center border border-secondary">
                    <thead>
                        <tr>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">ID</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Nombre</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc;">Imagen</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Categoría</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc;">SubCategoría</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Precio</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Stock</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc;">Baja</th>
                            <th class="border border-secondary" style="background-color: #f0b8d1;">Administrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productosActivos as $producto) : ?>
                            <tr>
                                <td class="border border-secondary"><?= esc($producto['id_productos']) ?></td>
                                <td class="border border-secondary"><?= esc($producto['nombre']) ?></td>
                                <td class="border border-secondary d-none d-sm-table-cell">
                                    <?php
                                    $categoria_id = $producto['categoria_id'];
                                    $url_imagen = $producto['url_imagen'];
                                    $subcategoria_id = $producto['id_subcategoria'];
                                    $ruta_imagen = '';

                                    // Determinar la ruta de la imagen según la categoría
                                    if ($categoria_id == 1) { // Buzos
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

                                    <img src="<?= base_url($ruta_imagen)?>" alt="Imagen del producto" class="imagenes">
                                </td>
                                <td class="border border-secondary">
                                    <?php if ($producto['categoria_id'] == 1) : ?>
                                        Buzos
                                    <?php elseif ($producto['categoria_id'] == 2) : ?>
                                        Jeans
                                    <?php elseif ($producto['categoria_id'] == 3) : ?>
                                        Remeras
                                    <?php endif; ?>
                                </td>
                                <td class="border border-secondary d-none d-sm-table-cell">
                                    <?php if ($producto['id_subcategoria'] == 1) : ?>
                                        Harry Styles
                                    <?php elseif ($producto['id_subcategoria'] == 2) : ?>
                                        Taylor Swift
                                    <?php elseif ($producto['id_subcategoria'] == 3) : ?>
                                        5 Seconds Of Summer
                                    <?php elseif ($producto['id_subcategoria'] == 4) : ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td class="border border-secondary">$ <?= esc($producto['precio']) ?></td>
                                <td class="border border-secondary"><?= esc($producto['stock']) ?></td>
                                <td class="border border-secondary d-none d-sm-table-cell"><?= esc($producto['baja']) ?></td>
                                <td class="border border-secondary">
                                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                        <a href="<?= site_url('modificarProducto/' . $producto['id_productos']) ?>" class="btn btn-outline-warning">Modificar datos</a>
                                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $producto['id_productos'] ?>">
                                            Modificar Imagen
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop<?= $producto['id_productos'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?= $producto['id_productos'] ?>" aria-hidden="true">
                                            <div class="modal-dialog custom-modal">
                                                <div class="modal-content modal-dialog-centered">
                                                <form action="<?= site_url('modificarImagen') ?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_productos" value="<?= $producto['id_productos'] ?>">

                                                    <div class="modal-header">
                                                        <h2 class="modal-title" id="staticBackdropLabel<?= $producto['id_productos']?>">Cambiar imagen</h2>
                                                    </div>

                                                    <div class="modal-body">
                                                        <label for="currentImage">Imagen actual del producto: </label><br>
                                                        <img src="<?= base_url($ruta_imagen)?>" alt="Imagen actual del producto" id="currentImage" class="imagenActual"><br>
                                                        <div class="input-group-text">
                                                            <label for="fotoProducto">Foto del Producto: </label>
                                                            <input type="file" name="imagen" class="form-control" id="fotoProducto">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary botonCambiar">Cambiar</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?= site_url('bajaProducto/' . $producto['id_productos']) ?>" class="btn btn-outline-danger">Dar de Baja</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginacion">
                <?= $paginacion->links('productsAlta', 'default') ?>
            </div>
        <?php else: ?>
            <div class="text-center">
                <p class="sinStock"> No hay productos dados de alta :( </p>
                <a href="<?php echo base_url('administrarProductos');?>" class="btn btnVolver">Volver al catálogo</a>
            </div>
        <?php endif; ?>

        <h2> ♡ Productos dados de baja ♡</h2>
        
        <?php if (!empty($productosBaja)) : ?>
            <div class="tabla">
                <table class="table text-center border border-secondary">
                    <thead>
                        <tr>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">ID</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Nombre</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc;">Imagen</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Categoría</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc;">SubCategoría</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Precio</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Stock</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc;">Baja</th>
                            <th class="border border-secondary" style="background-color: #f0b8d1;">Administrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productosBaja as $producto) : ?>
                            <tr>
                                <td class="border border-secondary"><?= esc($producto['id_productos']) ?></td>
                                <td class="border border-secondary"><?= esc($producto['nombre']) ?></td>
                                <td class="border border-secondary d-none d-sm-table-cell">
                                    <?php
                                    $categoria_id = $producto['categoria_id'];
                                    $url_imagen = $producto['url_imagen'];
                                    $subcategoria_id = $producto['id_subcategoria'];
                                    $ruta_imagen = '';

                                    // Determinar la ruta de la imagen según la categoría
                                    if ($categoria_id == 1) { // Buzos
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

                                    <img src="<?= base_url($ruta_imagen)?>" alt="Imagen del producto" class="imagenes">
                                </td>
                                <td class="border border-secondary">
                                    <?php if ($producto['categoria_id'] == 1) : ?>
                                        Buzos
                                    <?php elseif ($producto['categoria_id'] == 2) : ?>
                                        Jeans
                                    <?php elseif ($producto['categoria_id'] == 3) : ?>
                                        Remeras
                                    <?php endif; ?>
                                </td>
                                <td class="border border-secondary d-none d-sm-table-cell">
                                    <?php if ($producto['id_subcategoria'] == 1) : ?>
                                        Harry Styles
                                    <?php elseif ($producto['id_subcategoria'] == 2) : ?>
                                        Taylor Swift
                                    <?php elseif ($producto['id_subcategoria'] == 3) : ?>
                                        5 Seconds Of Summer
                                    <?php elseif ($producto['id_subcategoria'] == 4) : ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td class="border border-secondary">$ <?= esc($producto['precio']) ?></td>
                                <td class="border border-secondary"><?= esc($producto['stock']) ?></td>
                                <td class="border border-secondary d-none d-sm-table-cell"><?= esc($producto['baja']) ?></td>
                                <td class="border border-secondary">
                                    <div class="btn-group" role="group" aria-label="Vertical button group">
                                        <a href="<?= site_url('anularBajaProducto/' . $producto['id_productos']) ?>" class="btn btn-outline-success">Dar de Alta</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginacion">
                <?= $paginacion->links('productsBaja', 'default') ?>
            </div>
        <?php else: ?>
        <div class="text-center">
            <p class="sinStock"> No hay productos dados de baja :( </p>
        </div>
        <?php endif; ?>
    </main>
    <script src="<?= base_url('/assets/FooterInfoScript.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>

</html>
