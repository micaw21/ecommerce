<!DOCTYPE html>
<html lang="es">
    <body>
        <main>
            <h2>♡ Registrarse ♡</h2>
            <?php $validation = \Config\Services::validation();?>
            <div class="container text-center">
                <form action="<?php echo base_url('/UsuarioController/formValidation')?>" method="post">
                    
                    <?php if(!empty (session()->getFlashdata('fail'))):?>
                        <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
                    <?php endif?>

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

                    <div class="row">
                        <div class="col">
                            <!-- Error -->
                            <?php if($validation->getError('nombre')) {?>
                                <div class='alert alert-danger'>
                                    <?= $error = $validation->getError('nombre'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="col">
                            <!-- Error -->
                            <?php if($validation->getError('apellido')) {?>
                                <div class='alert alert-danger'>
                                    <?= $error = $validation->getError('apellido'); ?>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-group-text">Nombre y Apellido</span>
                        <input type="text" name="nombre" placeholder="Nombre" aria-label="Nombre" class="form-control" value="<?= set_value('nombre'); ?>">
                        <input type="text" name="apellido" placeholder="Apellido" aria-label="Apellido" class="form-control" value="<?= set_value('apellido'); ?>">
                    </div>
                    
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Usuario</span>
                        <input type="text" name="usuario" class="form-control" placeholder="Nombre de Usuario" aria-label="Usuario" aria-describedby="addon-wrapping" value="<?= set_value('usuario'); ?>">
                    </div>

                    <div>
                        <!-- Error -->
                        <?php if($validation->getError('usuario')) {?>
                            <div class='alert alert-danger'>
                                <?= $error = $validation->getError('usuario'); ?>
                            </div>
                        <?php }?>
                    </div>
                    
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Correo Electrónico</span>
                        <input type="text" name="email" class="form-control" placeholder="Correo Electrónico" aria-label="Correo" aria-describedby="addon-wrapping" value="<?= set_value('email'); ?>">
                    </div>

                    <div>
                        <!-- Error -->
                        <?php if($validation->getError('email')) {?>
                            <div class='alert alert-danger'>
                                <?= $error = $validation->getError('email'); ?>
                            </div>
                        <?php }?>
                    </div>

                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Contraseña</span>
                        <input type="password" name="pass" class="form-control" placeholder="Contraseña" aria-label="Contraseña" aria-describedby="addon-wrapping">
                    </div>

                    <div>
                        <!-- Error -->
                        <?php if($validation->getError('pass')) {?>
                            <div class='alert alert-danger'>
                                <?= $error = $validation->getError('pass'); ?>
                            </div>
                        <?php }?>
                    </div>

                    <div class="text-center">
                        <p> ¿Ya posee una cuenta? Inicie sesión 
                            <a style="cursor: pointer; color: #C88EA7; text-decoration: none;" href="<?php echo base_url('/login');?>"> aquí! </a> 
                        </p> 
                    </div>

                    <div class="text-center">
                        <button type="submit" value="guardar" class="btn btn-sucess botonRegistro">Registrarse</button>
                        <a href="<?php echo base_url('/'); ?>" class="btn btn-danger botonRegistro">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>
        <script src="<?php echo base_url('/assets/FooterInfoScript.js');?>"> </script>
        <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js');?>"> </script>
    </body>
</html> 