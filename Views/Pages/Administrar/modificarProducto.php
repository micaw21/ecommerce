<!DOCTYPE html>
<html lang="es">
    <body>
        <main>
            <h2>♡ Modificar producto ♡</h2>
            <?php $validation = \Config\Services::validation();?>
            <div class="container text-center">
                <form action="<?php echo base_url('editarProducto')?>" method="post">

                    <?php if(!empty (session()->getFlashdata('fail'))):?>
                        <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
                    <?php endif?>

                    <?php if(!empty (session()->getFlashdata('success'))):?>
                        <div class="alert alert-danger"><?=session()->getFlashdata('success');?></div>
                    <?php endif?>

                    <input type="hidden" name="id_productos" value="<?= $producto['id_productos']?>">

                    <!-- Error -->
                    <?php if($validation->getError('nombre')) {?>
                        <div class='alert alert-danger'>
                            <?= $error = $validation->getError('nombre'); ?>
                        </div>
                    <?php }?>

                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Nombre del Producto</span>
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" value="<?= $producto['nombre']?>">
                    </div>

                    <!-- Error -->
                    <?php if($validation->getError('precio')) {?>
                        <div class='alert alert-danger'>
                            <?= $error = $validation->getError('precio'); ?>
                        </div>
                    <?php }?>

                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Precio</span>
                        <input type="text" name="precio" class="form-control" value="<?= $producto['precio']?>">
                    </div>

                    <!-- Error -->
                    <?php if($validation->getError('stock')) {?>
                        <div class='alert alert-danger'>
                            <?= $error = $validation->getError('stock'); ?>
                        </div>
                    <?php }?>

                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Stock</span>
                        <input type="text" name="stock" class="form-control" value="<?= $producto['stock']?>">
                    </div>

                    <input type="hidden" name="url_imagen" value="<?=$producto['url_imagen']?>">
                    <div class="row">
                        <div class="col" >
                            <div class="input-group-text">
                                <label for="categoria">Categoria:</label>
                                <select class="form-select" name="categoria_id">
                                    <option selected=""> <?= $producto['categoria_id']?> </option>
                                    <?php foreach ($categorias as $categoria) { ?>
                                    <option value="<?php echo $categoria['id_categoria'];?>">
                                        <?php echo $categoria['id_categoria'], ". ", $categoria['descripcion']; }?>
                                    </option>
                                </select>
                            </div>
                        </div>
    
                        <div class="col">
                            <div class="input-group-text">
                                <label for="id_subcategoria">Sub-Categoria:</label>
                                <select class="form-select" name="id_subcategoria">
                                    <option selected=""> <?= $producto['id_subcategoria']?> </option>
                                    <?php foreach ($subcategorias as $subcategoria) { ?>
                                    <option value="<?php echo $subcategoria['id_subcategoria'];?>">
                                        <?php echo $subcategoria['id_subcategoria'], ". ", $subcategoria['descripcion']; }?>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center botones">
                        <button type="submit" value="guardar" class="btn btn-success">Modificar</button>
                        <a href="<?php echo base_url('administrarProductos');?>" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>
        <script src="<?php echo base_url('/assets/FooterInfoScript.js');?>"> </script>
        <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js');?>"> </script>
    </body>
</html> 