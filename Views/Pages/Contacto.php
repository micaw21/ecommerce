<!DOCTYPE html>
<html lang="es">

<body>
    <main>

        <?php if(session()->get('logged_in')): ?>
            <h2> ♡ Consulta ♡ </h2>
        <?php else: ?>
            <h2> ♡ Contacto ♡ </h2>
        <?php endif; ?>

        <?php $validation = \Config\Services::validation();?>
        <?php if(!empty (session()->getFlashdata('fail'))):?>
            <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
        <?php endif?>

        <?php if(!empty (session()->getFlashdata('success'))):?>
            <div class="alert alert-success"><?=session()->getFlashdata('success');?></div>
        <?php endif?> 

        <div class="containerInfo">
            <div class="row">
                <div class="col columna justify-content-center">
                    <div class="mapa">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14159.706000469487!2d-58.820930548726764!3d-27.471547499999993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456b6ca10e6e2b%3A0xa03f567172e58c10!2sCentenario%20Shopping%20Mall!5e0!3m2!1sen!2sar!4v1713311096798!5m2!1sen!2sar" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col columna justify-content-center">
                    <div class="containerDatos">
                        <h3> Datos de la Empresa</h3>
                        <div class="datosEmpresa">
                            <p> <strong>Titular: </strong> Méndez, Gloria Elisa </p>
                            <p> <strong>Razón Social: </strong> S.R.L. </p>
                            <p> <strong>Domicilio Legal: </strong>Argentina, Corrientes, Av. Raúl Alfonsín 3225, Local 3</p>
                            <p> <strong>Teléfono: </strong> +543795192134 </p>
                            <p> <strong>Email: </strong> infoGloriaModa@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <form action="<?php echo base_url('/contactoController/enviarConsulta')?>" method="post">
                <?php if(!session()->get('logged_in')): ?>
                    <div class="row">
                        <div class="col columna">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre" aria-label="Nombre">
                        </div>
    
                        <div class="col columna">
                            <input type="text" class="form-control" name="apellido" placeholder="Apellido" aria-label="Apellido">
                        </div>
                    </div>
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
                    <div class="row">
                        <div class="col columna">
                            <input type="email" name="email" class="form-control" id="Correo" placeholder="Correo Electronico">
                        </div>
                    </div>
                    <div>
                        <!-- Error -->
                        <?php if($validation->getError('email')) {?>
                            <div class='alert alert-danger'>
                                <?= $error = $validation->getError('email'); ?>
                            </div>
                        <?php }?>
                    </div>
                <?php endif; ?>
                
                <?php if(session()->get('logged_in')): ?>
                    <input type="hidden" name="usuario_id" value="<?= session()->get('id_usuario') ?>">
                    <div class="row">
                        <div class="form-floating col columna">
                            <input class="form-control" id="floatingInputDisabled" value="<?php echo session()->get('nombre'); ?>" disabled>
                            <label class="tag" for="floatingInputDisabled">Nombre</label>
                        </div>


                        <div class="form-floating col columna">
                            <input class="form-control" id="floatingInputDisabled" value="<?php echo session()->get('apellido'); ?>" disabled>
                            <label class="tag" for="floatingInputDisabled">Apellido</label>
                        </div>

                    </div>
                        <div>
                            <input type="hidden" name="nombre" value="<?php echo session()->get('nombre'); ?>">
                        </div>
    
                        <div>
                            <input type="hidden" name="apellido" value="<?php echo session()->get('apellido'); ?>">
                        </div>

                    <div class="row">
                        <div class="form-floating col columna">
                            <input class="form-control" id="floatingInputDisabled" value="<?php echo session()->get('email'); ?>" disabled>
                            <label class="tag" for="floatingInputDisabled">Correo Electrónico</label>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="email" value="<?php echo session()->get('email'); ?>">
                    </div>
    
                <?php endif; ?>

                <div class="col columna">
                    <textarea class="form-control" name="mensaje" id="mensaje" placeholder="Mensaje" rows="3"></textarea>
                </div>
                <div>
                    <?php if($validation->getError('mensaje')) {?>
                        <div class='alert alert-danger'>
                            <?= $error = $validation->getError('mensaje'); ?>
                        </div>
                    <?php }?>
                </div>
                <div class="boton">
                    <button type="submit" class="btn btn-primary botonEnviar">Enviar</button>
                </div>
            </form>
        </div>
    </main>
    <script src="<?php echo base_url('/assets/FooterInfoScript.js'); ?>"> </script>
    <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js'); ?>"> </script>
</body>

</html>