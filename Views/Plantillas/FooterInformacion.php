<section>
    <div class="containerInfo text-center">
        <div class="row">
            <div class="col">
                <img class="iconosinfo" src="<?php echo base_url('/assets/img/footerInfo/envios.png');?>">
                <p class="textoInfo">Envíos gratis a cualquier sucursal del país </p>
                <p class="info">con la compra de cualquier remera</p>
            </div>
            <div class="col">
                <img class="iconosinfo" src="<?php echo base_url('/assets/img/footerInfo/pagos.png');?>">
                <p class="textoInfo">Hasta 12 cuotas </p>
                <p class="info">con todas las tarjetas</p>
            </div>
            <div class="col">
                <img class="iconosinfo" src="<?php echo base_url('/assets/img/footerInfo/datosSeguros.png');?>">
                <p class="textoInfo">Compra segura </p>
                <p class="info">protegemos tus datos</p>
            </div>
        </div>
    </div>
    <div class="row text-center containerNavegacion">
        <div class="col">
            <p class="textoInfo">Navegacion</p>
            <div class="navegacion">
                <a class="infoNavegacion" href="http://localhost/proyecto_wolkowyski">Inicio</a>

                <?php if(!session()->get('logged_in')): ?>
                    <a class="infoNavegacion" href="http://localhost/proyecto_wolkowyski/login">Iniciar Sesión</a>
                    <a class="infoNavegacion" href="http://localhost/proyecto_wolkowyski/registrarse">Registrarse</a>
                <?php endif; ?>

                <a class="infoNavegacion" href="http://localhost/proyecto_wolkowyski/catalogo">Catálogo</a>

                <?php if(session()->get('logged_in')): ?>
                    <a class="infoNavegacion" href="http://localhost/proyecto_wolkowyski/contacto">Consulta</a>
                <?php else: ?>
                    <a class="infoNavegacion" href="http://localhost/proyecto_wolkowyski/contacto">Contacto</a>
                <?php endif; ?>

                <a class="infoNavegacion" href="http://localhost/proyecto_wolkowyski/quienesSomos">Quiénes Somos</a>
                <a class="infoNavegacion" href="http://localhost/proyecto_wolkowyski/comercializacion">Comercialización</a>
                <a class="infoNavegacion" href="http://localhost/proyecto_wolkowyski/terminosycondiciones">Términos y Condiciones</a>
            </div>
        </div>
        <div class="col">
            <p class="textoInfo">Contáctanos</p>
            <a onclick="abrirEnNuevaPestana('https://web.whatsapp.com/')" >
                <p class="info click"> +5437940298373</p>
            </a>
            <a onclick="abrirEnNuevaPestana('https://web.whatsapp.com/')" >
                <p class="info click"> +543795192134</p>
            </a>
            <div class="container-fluid">
                <a onclick="abrirEnNuevaPestana('https://www.instagram.com/')">
                    <img class="iconsFooter click" src="<?php echo base_url('/assets/img/footerInfo/instagram.png');?>">
                </a>
                <a onclick="abrirEnNuevaPestana('https://www.tiktok.com/en/')">
                    <img class="iconsFooter click" src="<?php echo base_url('assets/img/footerInfo/tiktok.png');?>">
                </a>
                <a onclick="abrirEnNuevaPestana('https://twitter.com/?lang=en')">
                    <img class="iconsFooter click" src="<?php echo base_url('/assets/img/footerInfo/x.png');?>">
                </a>
            </div>
        </div>
    </div>
</section>



