<!DOCTYPE html>
<html lang="es">
    <body>
    <main>
            <h2>♡ Alta producto ♡</h2>
            <div class="container text-center">
                <form action="<?php echo base_url('darAltaProducto')?>" method="post" enctype="multipart/form-data">
                    
                    <?php $validation = \Config\Services::validation();?>

                    <?php if(!empty(session()->getFlashdata('fail'))):?>
                        <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
                    <?php endif?>

                    <?php if(!empty(session()->getFlashdata('success'))):?>
                        <div class="alert alert-success"><?=session()->getFlashdata('success');?></div>
                    <?php endif?>

                    <!-- Error -->
                    <?php if($validation->getError('nombre')) {?>
                        <div class='alert alert-danger'>
                            <?= $error = $validation->getError('nombre'); ?>
                        </div>
                    <?php }?>

                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Nombre</span>
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" aria-label="nombre" aria-describedby="addon-wrapping" value="<?= set_value('nombre'); ?>">
                    </div>

                    <!-- Error -->
                    <?php if($validation->getError('precio')) {?>
                        <div class='alert alert-danger'>
                            <?= $error = $validation->getError('precio'); ?>
                        </div>
                    <?php }?>

                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Precio</span>
                        <input type="text" name="precio" class="form-control" placeholder="Precio del producto" aria-label="precio" aria-describedby="addon-wrapping" value="<?= set_value('precio'); ?>">
                    </div>

                    <!-- Error -->
                    <?php if($validation->getError('stock')) {?>
                        <div class='alert alert-danger'>
                            <?= $error = $validation->getError('stock'); ?>
                        </div>
                    <?php }?>

                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Stock</span>
                        <input type="text" name="stock" class="form-control" placeholder="Stock del producto" aria-label="stock" aria-describedby="addon-wrapping" value="<?= set_value('stock'); ?>">
                    </div>

                    <div class="row elegir">
                        <div class="col">
                            <div class="input-group-text">
                                <label for="fotoProducto">Foto del Producto: </label>
                                <input type="file" name="url_imagen" class="form-control" id="fotoProducto">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group-text select">
                                <label for="categoria_id">Categoria:</label>
                                <select name="categoria_id" class="form-select">
                                    <?php foreach ($categorias as $categoria) { ?>
                                        <option value="<?php echo $categoria['id_categoria'];?>" <?= set_select('categoria_id', $categoria['id_categoria']); ?>>
                                            <?php echo $categoria['id_categoria'], ". ", $categoria['descripcion']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group-text select">
                                <label for="id_subcategoria">Sub-Categoria:</label>
                                <select class="form-select" name="id_subcategoria">
                                    <?php foreach ($subcategorias as $subcategoria) { ?>
                                        <option value="<?php echo $subcategoria['id_subcategoria'];?>" <?= set_select('id_subcategoria', $subcategoria['id_subcategoria']); ?>>
                                            <?php echo $subcategoria['id_subcategoria'], ". ", $subcategoria['descripcion']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" value="guardar" class="btn btn-success">Dar de Alta</button>
                        <a href="<?php echo base_url('administrarProductos');?>" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>
        <script src="<?php echo base_url('/assets/FooterInfoScript.js');?>"> </script>
        <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js');?>"> </script>
    </body>
</html> 