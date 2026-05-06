<section style="min-height: 900px; background-color: #D5DBDB;"> 
<div class="container py-5">

<h2 class="text-center">Recetas recibidas</h2>
<hr>

<table class="table table-bordered table-striped">

<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Cliente</th>
    <th>Anteojo</th>
    <th>Receta</th>
    <th>Observaciones</th>
    <th>Estado</th>
    <th>Acciones</th>
</tr>
</thead>

<tbody>

<?php foreach ($recetas as $r) { ?>
<tr>

    <!-- ID -->
    <td><?= $r['id_receta']; ?></td>

    <!-- 👤 CLIENTE -->
    <td>
        <?= $r['persona_nombre'] . ' ' . $r['persona_apellido']; ?>
    </td>

    <!-- 👓 ANTEOJO -->
    <td><?= $r['anteojo_nombre']; ?></td>

    <!-- 📎 ARCHIVO -->
    <td>
        <a href="<?= base_url('assets/recetas/'.$r['receta']); ?>" target="_blank" class="btn btn-info btn-sm">
            Ver
        </a>

        <a href="<?= base_url('receta/descargar/'.$r['receta']); ?>" class="btn btn-secondary btn-sm">
            Descargar
        </a>
    </td>

    <!-- 📝 OBS -->
    <td><?= $r['observaciones']; ?></td>

    <!-- 📊 ESTADO -->
    <td>
        <span class="badge bg-info"><?= $r['estado']; ?></span>
    </td>

    <!-- ⚙️ ACCIONES -->
    <td>
        <a href="<?= base_url('receta/editar/'.$r['id_receta']); ?>" class="btn btn-warning btn-sm">
            Editar
        </a>

        <a href="<?= base_url('receta_estado/'.$r['id_receta'].'/aprobado'); ?>" class="btn btn-success btn-sm">
            Aprobar
        </a>

        <a href="<?= base_url('receta_estado/'.$r['id_receta'].'/rechazado'); ?>" class="btn btn-danger btn-sm">
            Rechazar
        </a>
    </td>

</tr>
<?php } ?>

</tbody>
</table>

</div>
</section>