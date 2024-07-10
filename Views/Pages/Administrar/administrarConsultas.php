<!DOCTYPE html>
<html lang="es">

<body>
    <main>
        <h2>♡ Administrar Consultas ♡</h2>

        <?php if(!empty (session()->getFlashdata('fail'))):?>
            <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
        <?php endif?>

        <?php if(!empty (session()->getFlashdata('success'))):?>
            <div class="alert alert-success"><?=session()->getFlashdata('success');?></div>
        <?php endif?>
        
        <?php if (!empty($consultasActivas)) : ?>
            <div class="tabla">
                <table class="table text-center border border-secondary">
                    <thead>
                        <tr>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">ID</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Nombre</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Apellido</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Email</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Mensaje</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc;">Activo</th>
                            <th class="border border-secondary" style="background-color: #f0b8d1;">Administrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($consultasActivas as $consulta) : ?>
                            <tr>
                                <td class="border border-secondary"><?= esc($consulta['id_consulta']) ?></td>
                                <td class="border border-secondary"><?= esc($consulta['nombre']) ?></td>
                                <td class="border border-secondary"><?= esc($consulta['apellido']) ?></td>
                                <td class="border border-secondary"><?= esc($consulta['email']) ?></td>
                                <td class="border border-secondary">
                                    <?php
                                    $mensaje = esc($consulta['mensaje']);
                                    $longitud_fragmento = 90;
                                    $mensaje = wordwrap($mensaje, $longitud_fragmento, "\n", true);
                                    $parrafos = explode("\n", $mensaje);

                                    foreach ($parrafos as $parrafo) {
                                        echo "<p>" . $parrafo . "</p>";
                                    }
                                    ?>
                                </td>
                                <td class="border border-secondary d-none d-sm-table-cell"><?= esc($consulta['activo']) ?></td>
                                <td class="border border-secondary">
                                    <div class="btn-group" role="group" aria-label="Vertical button group">
                                        <a href="<?= site_url('marcarLeido/' . $consulta['id_consulta']) ?>" class="btn btn-outline-warning botonLeer">Marcar como leído</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginacion" >
                <?= $paginacion->links('consultasActivas', 'default') ?>
            </div>
        <?php else: ?>
            <div class="text-center">
                <p class="consultasCant"> No hay consultas disponibles :( </p>
            </div>
        <?php endif; ?>

        <h2>♡ Consultas leídas ♡</h2>

        <?php if (!empty($consultasLeidas)) : ?>
            <div class="tabla">
                <table class="table text-center border border-secondary">
                    <thead>
                        <tr>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">ID</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Nombre</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Apellido</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Email</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Mensaje</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc;">Activo</th>
                            <th class="border border-secondary" style="background-color: #f0b8d1;">Administrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($consultasLeidas as $consulta) : ?>
                            <tr>
                                <td class="border border-secondary"><?= esc($consulta['id_consulta']) ?></td>
                                <td class="border border-secondary"><?= esc($consulta['nombre']) ?></td>
                                <td class="border border-secondary"><?= esc($consulta['apellido']) ?></td>
                                <td class="border border-secondary"><?= esc($consulta['email']) ?></td>
                                <td class="border border-secondary">
                                    <?php
                                    $mensaje = esc($consulta['mensaje']);
                                    $longitud_fragmento = 90;
                                    $mensaje = wordwrap($mensaje, $longitud_fragmento, "\n", true);
                                    $parrafos = explode("\n", $mensaje);

                                    foreach ($parrafos as $parrafo) {
                                        echo "<p>" . $parrafo . "</p>";
                                    }
                                    ?>
                                </td>
                                <td class="border border-secondary d-none d-sm-table-cell"><?= esc($consulta['activo']) ?></td>
                                <td class="border border-secondary">
                                    <div class="btn-group" role="group" aria-label="Vertical button group">
                                        <a href="<?= site_url('marcarNoLeido/' . $consulta['id_consulta']) ?>" class="btn btn-outline-success botonLeer">Marcar como no leído</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginacion" >
                <?= $paginacion->links('consultasInactivas', 'default') ?>
            </div>
        <?php else: ?>
            <div class="text-center">
                <p class="consultasCant"> No hay consultas leídas disponibles :( </p>
            </div>
        <?php endif; ?>
    </main>
    <script src="<?php echo base_url('/assets/FooterInfoScript.js'); ?>"> </script>
    <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js'); ?>"> </script>
</body>

</html>