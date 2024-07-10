<!DOCTYPE html>
<html lang="es">

<body>
    <main>
        <h2> ♡ Administrar Usuarios ♡</h2>

        <?php if(!empty (session()->getFlashdata('fail'))):?>
            <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
        <?php endif?>

        <?php if(!empty (session()->getFlashdata('success'))):?>
            <div class="alert alert-success"><?=session()->getFlashdata('success');?></div>
        <?php endif?>

        <?php if (!empty($usuarios)): ?>
            <div class="tabla">
                <table class="table text-center border border-secondary">
                    <thead>
                        <tr>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>ID</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Nombre</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Apellido</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Email</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc";>Nombre de Usuario</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc";>Rol</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc";>Baja</th>
                            <th class="border border-secondary" style="background-color: #f0b8d1">Administrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <?php if ($usuario['baja'] == 'NO'): ?>
                                <tr>
                                    <td class="border border-secondary"><?= esc($usuario['id_usuario']) ?></td>
                                    <td class="border border-secondary"><?= esc($usuario['nombre']) ?></td>
                                    <td class="border border-secondary"><?= esc($usuario['apellido']) ?></td>
                                    <td class="border border-secondary"><?= esc($usuario['email']) ?></td>
                                    <td class="border border-secondary d-none d-sm-table-cell"><?= esc($usuario['usuario']) ?></td>
                                    <td class="border border-secondary">
                                        <?php if ($usuario['perfil_id'] == 1) : ?>
                                            Administrador
                                        <?php elseif ($usuario['perfil_id'] == 2) : ?>
                                            Cliente
                                        <?php endif; ?>
                                    </td>
                                    <td class="border border-secondary d-none d-sm-table-cell"><?= esc($usuario['baja']) ?></td>
                                    <td class="border border-secondary"> 
                                        <div class="btn-group" role="group" aria-label="Vertical button group">
                                            <?php if ($usuario['id_usuario'] != session()->get('id_usuario')): ?>
                                                <a href="<?= site_url('bajaUsuario/'.$usuario['id_usuario']) ?>" class="btn btn-outline-danger botonBaja">Dar de Baja</a>
                                            <?php else: ?>
                                                <button class="btn btn-outline-danger botonBaja" disabled>Dar de Baja</button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginacion" >
                <?= $paginacion->links('usuariosActivos', 'default') ?>
            </div>
        <?php else: ?>
        <div class="text-center">
            <p class="sinUsuarios"> No hay usuarios disponibles :( </p>
        </div>
        <?php endif; ?>
        
        <h2>Usuarios dados de baja</h2>
        <?php if (!empty($usuariosDadosDeBaja)) : ?>
            <div class="tabla">
                <table class="table text-center border border-secondary">
                    <thead>
                        <tr>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">ID</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Nombre</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Apellido</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Email</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc;">Nombre de Usuario</th>
                            <th class="border border-secondary" style="background-color: #e1bbcc;">Rol</th>
                            <th class="border border-secondary d-none d-sm-table-cell" style="background-color: #e1bbcc;">Baja</th>
                            <th class="border border-secondary" style="background-color: #f0b8d1;">Administrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuariosDadosDeBaja as $usuario) : ?>
                            <tr>
                                <td class="border border-secondary"><?= esc($usuario['id_usuario']) ?></td>
                                <td class="border border-secondary"><?= esc($usuario['nombre']) ?></td>
                                <td class="border border-secondary"><?= esc($usuario['apellido']) ?></td>
                                <td class="border border-secondary"><?= esc($usuario['email']) ?></td>
                                <td class="border border-secondary d-none d-sm-table-cell"><?= esc($usuario['usuario']) ?></td>
                                <td class="border border-secondary">
                                    <?php if ($usuario['perfil_id'] == 1) : ?>
                                        Administrador
                                    <?php elseif ($usuario['perfil_id'] == 2) : ?>
                                        Cliente
                                    <?php endif; ?>
                                </td>
                                <td class="border border-secondary d-none d-sm-table-cell"><?= esc($usuario['baja']) ?></td>
                                <td class="border border-secondary">
                                    <div class="btn-group" role="group" aria-label="Vertical button group">
                                        <a href="<?= site_url('anularBaja/'.$usuario['id_usuario']) ?>" class="btn btn-outline-success botonBaja">Anular baja</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginacion" >
                <?= $paginacion->links('usuariosBaja', 'default') ?>
            </div>
        <?php else: ?>
        <div class="text-center">
            <p class="sinUsuarios"> No hay usuarios disponibles :( </p>
        </div>
        <?php endif; ?>
    </main>
    <script src="<?php echo base_url('/assets/FooterInfoScript.js'); ?>"> </script>
    <script src="<?php echo base_url('/assets/js/bootstrap.bundle.min.js'); ?>"> </script>
</body>

</html>