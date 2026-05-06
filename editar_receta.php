<section class="container mt-5">

<h2>Editar Receta</h2>
<hr>

<form action="<?= base_url('receta/actualizar') ?>" method="post">

    <input type="hidden" name="id_receta" value="<?= $receta['id_receta']; ?>">

    <!-- 📄 OBSERVACIONES -->
    <div class="mb-3">
        <label>Observaciones</label>
        <textarea name="observaciones" class="form-control" rows="4">
<?= $receta['observaciones']; ?>
        </textarea>
    </div>

    <!-- 📊 ESTADO -->
    <div class="mb-3">
        <label>Estado</label>
        <select name="estado" class="form-control">
            <option value="pendiente" <?= ($receta['estado']=='pendiente')?'selected':''; ?>>Pendiente</option>
            <option value="aprobado" <?= ($receta['estado']=='aprobado')?'selected':''; ?>>Aprobado</option>
            <option value="rechazado" <?= ($receta['estado']=='rechazado')?'selected':''; ?>>Rechazado</option>
        </select>
    </div>

    <!-- 📎 ARCHIVO -->
    <div class="mb-3">
        <label>Receta subida</label><br>

        <?php if(!empty($receta['receta'])){ ?>

            <!-- 👁️ VER -->
            <a href="<?= base_url('assets/recetas/'.$receta['receta']); ?>" target="_blank" class="btn btn-info btn-sm">
                Ver
            </a>

            <!-- ⬇️ DESCARGAR -->
            <a href="<?= base_url('receta/descargar/'.$receta['receta']); ?>" class="btn btn-secondary btn-sm">
                Descargar
            </a>

        <?php } else { ?>
            <span class="text-danger">No hay archivo</span>
        <?php } ?>

    </div>

    <!-- 💾 BOTÓN -->
    <button type="submit" class="btn btn-primary">
        Guardar cambios
    </button>

</form>

</section>