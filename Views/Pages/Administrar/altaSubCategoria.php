<!DOCTYPE html>
<html lang="es">
    <body>
        <main>
            <h2>♡ Alta Sub-Categoría ♡</h2>
            <?php $validation = \Config\Services::validation();?>
            <div class="container text-center">
                <form action="<?php echo base_url('agregarSubCategoria'); ?>" method="post">
                    <?php if(!empty (session()->getFlashdata('fail'))):?>
                        <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
                    <?php endif?>

                    <?php if(!empty (session()->getFlashdata('success'))):?>
                        <div class="alert alert-success"><?=session()->getFlashdata('success');?></div>
                    <?php endif?>

                    
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Descripcion</span>
                        <input type="text" name="descripcion" class="form-control" placeholder="Ingrese la descripción de la subcategoria" aria-label="descripcion" aria-describedby="addon-wrapping">
                    </div>

                    <!-- Error -->
                    <?php if($validation->getError('descripcion')) {?>
                        <div class='alert alert-danger'>
                            <?= $error = $validation->getError('descripcion'); ?>
                        </div>
                    <?php }?>

                    <div class="text-center">
                        <button type="submit" value="guardar" class="btn btn-success">Dar de Alta</button>
                        <a href="<?php echo base_url('administrarProductos'); ?>" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>
        <script src="<?php echo base_url('/assets/FooterInfoScript.js');?>"> </script>
        <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js');?>"> </script>
    </body>
</html>