<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <?php $pagina_actual = $_SERVER['REQUEST_URI']; ?>
                <ul class="lista-nav">
                    <?php if(session()->get('logged_in')): ?>
                        <li> 
                            <button type="button" class="btn botonHeader <?php echo ($pagina_actual === '/proyecto_wolkowyski/carrito') ? 'active' : ''; ?>">
                                <div class="text-center">
                                    <a href="http://localhost/proyecto_wolkowyski/carrito">
                                        <img class="iconos" src="<?php echo base_url('/assets/img/carrito-compra.png');?>" alt="Carrito de Compra"/>
                                    </a>
                                </div>
                            </button>
                        </li>   
                        
                        <li class="nav-item">
                            <a class="nav nav-link botones" href="<?=site_url('loginController/logout')?>">Cerrar Sesión</a>
                        </li>
                    <?php endif; ?>

                    <?php if(!session()->get('logged_in')): ?>
                        <li class="nav-item">
                            <a class="nav nav-link botones <?php echo ($pagina_actual === '/proyecto_wolkowyski/login') ? 'active' : ''; ?>" href="http://localhost/proyecto_wolkowyski/login">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav nav-link botones <?php echo ($pagina_actual === '/proyecto_wolkowyski/registrarse') ? 'active' : ''; ?>" href="http://localhost/proyecto_wolkowyski/registrarse">Registrarse</a>
                        </li>
                    <?php endif; ?>

                    
                </ul>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (($pagina_actual === '/proyecto_wolkowyski/') || ($pagina_actual === '/proyecto_wolkowyski/index.php')) ? 'active' : ''; ?>" href="http://localhost/proyecto_wolkowyski">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo (($pagina_actual === '/proyecto_wolkowyski/catalogo') || ($pagina_actual === '/proyecto_wolkowyski/mostrarCatalogoHS') || ($pagina_actual === '/proyecto_wolkowyski/mostrarCatalogoTS') || ($pagina_actual === '/proyecto_wolkowyski/mostrarCatalogo5SOS')) ? 'active' : ''; ?>"  href="http://localhost/proyecto_wolkowyski/catalogo">Catálogo</a>
                    </li>

                    <?php if(session()->get('logged_in')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (($pagina_actual === '/proyecto_wolkowyski/contacto') || ($pagina_actual === '/proyecto_wolkowyski/contactoController/enviarConsulta')) ? 'active' : ''; ?>" href="http://localhost/proyecto_wolkowyski/contacto">Consulta</a>
                        </li>
                    <?php endif; ?>

                    <?php if(!session()->get('logged_in')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (($pagina_actual === '/proyecto_wolkowyski/contacto') || ($pagina_actual === '/proyecto_wolkowyski/contactoController/enviarConsulta')) ? 'active' : ''; ?>" href="http://localhost/proyecto_wolkowyski/contacto">Contacto</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina_actual === '/proyecto_wolkowyski/quienesSomos') ? 'active' : ''; ?>" href="http://localhost/proyecto_wolkowyski/quienesSomos">Quiénes Somos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina_actual === '/proyecto_wolkowyski/comercializacion') ? 'active' : ''; ?>" href="http://localhost/proyecto_wolkowyski/comercializacion">Comercialización</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina_actual === '/proyecto_wolkowyski/terminosycondiciones') ? 'active' : ''; ?>" href="http://localhost/proyecto_wolkowyski/terminosycondiciones">Términos y Condiciones</a>
                    </li>

                    <?php if (session()->get('logged_in') && session()->get('perfil_id') == 1): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administrar
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item <?php echo ($pagina_actual === '/proyecto_wolkowyski/administrarUsuario') ? 'active' : ''; ?>" href="http://localhost/proyecto_wolkowyski/administrarUsuario">Usuarios</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item <?php echo ($pagina_actual === '/proyecto_wolkowyski/administrarProductos') ? 'active' : ''; ?>"" href="http://localhost/proyecto_wolkowyski/administrarProductos">Productos</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item <?php echo ($pagina_actual === '/proyecto_wolkowyski/administrarConsultas') ? 'active' : ''; ?>"" href="http://localhost/proyecto_wolkowyski/administrarConsultas">Consultas</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item <?php echo ($pagina_actual === '/proyecto_wolkowyski/administrarFacturas') ? 'active' : ''; ?>"" href="http://localhost/proyecto_wolkowyski/administrarFacturas">Compras</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php if(session()->get('logged_in')): ?>
        <p class="bienvenida">Bienvenid@, <?= session()->get('nombre')?>!</>        
    <?php endif; ?>
</header>