<!DOCTYPE html>
<html lang="es">

<body>
    <main>
        <h2>♡ Iniciar Sesión ♡</h2>

        <!-- Mensaje de Error -->
        <!-- <?php if(!empty (session()->getFlashdata('fail'))):?>
            <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
        <?php endif?> -->

        <!-- <?php if(!empty (session()->getFlashdata('success'))):?>
            <div class="alert alert-success"><?=session()->getFlashdata('success');?></div>
        <?php endif?>  -->
        

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

        <div class="container login">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login-container">
                        <form action="<?php echo base_url('/loginController/auth')?>" method="post">
                            <div class="form-group">
                                <label for="login">Correo Electrónico o Nombre de Usuario</label>
                                <input type="text" name="login" class="form-control" id="login" placeholder="Ingresar email o nombre de usuario:" value="<?php echo set_value('login'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" name="pass" class="form-control" id="password" placeholder="Introduce tu contraseña">
                            </div>
                            <div class="links">
                                <a class="registrarse" href="http://localhost/proyecto_wolkowyski/registrarse">Registrarse</a>
                            </div>
                            <div class="botonLogin">
                                <button type="submit" class="btn botonSesion">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="<?php echo base_url('/assets/FooterInfoScript.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>

</html>
