<!DOCTYPE html>
<html lang="es">

<body>
    <main>
        <?php if(!empty (session()->getFlashdata('fail'))):?>
            <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
        <?php endif?>

        <?php if(!empty (session()->getFlashdata('success'))):?>
            <div class="alert alert-success"><?=session()->getFlashdata('success');?></div>
        <?php endif?> 
        
        <section class='container'>
            <div id="carouselPrincipal" class="carousel carousel-dark slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselPrincipal" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselPrincipal" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselPrincipal" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="<?php echo base_url('/assets/img/carousel/slide1.gif');?>" class="d-block w-100">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="<?php echo base_url('/assets/img/carousel/slide2.gif');?>" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo base_url('/assets/img/carousel/slide3.gif');?>" class="d-block w-100">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPrincipal"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselPrincipal"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </section>

        <h3>♡ Destacados ♡</h3>

        <section class="containerPrincipal">
            <div class="grilla">
                <div class="columna">
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/principal/remera1.jpg');?> " class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <a <p class="card-text"> Remeras TS Eras</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/principal/jean1.jpg');?> " class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <a <p class="card-text"> Jean Butterfly </p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/principal/buzo1.jpg');?> " class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <a <p class="card-text">Buzo TS The Eras Tour Black </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grilla">
                <div class="columna">
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/principal/remera2.jpeg');?> " class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <a <p class="card-text"> Remera 5SOS Easier</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/principal/jean2.jpg');?> " class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <a <p class="card-text"> Jean Butterflies </p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/principal/buzo2.jpg');?> " class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <a <p class="card-text"> Buzo Harry Styles Pink </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grilla">
                <div class="columna">
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/principal/remera3.jpg');?> " class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <a <p class="card-text"> Remera HS Love On Tour </p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/principal/jean3.jpg');?> " class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <a <p class="card-text"> Jean Yellow </p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/principal/buzo3.jpg');?> " class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <a <p class="card-text"> Buzo 5SOS Show </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="botonMas" class="d-grid gap-2 col-4 mx-auto">
            <button class="boton" type="button" class="btn btn-primary">
                <a href="http://localhost/proyecto_wolkowyski/catalogo" <p class="link"> Ver más </p>
                </a>
            </button>
        </div>
    </main>
    <script src="<?php echo base_url('/assets/FooterInfoScript.js');?>"> </script>
    <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js');?>"> </script>
</body>

</html> 