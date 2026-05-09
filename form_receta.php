<section class="container mt-5" style="min-height: 900px;">
 <div class="container" style="min-height:500px">
    <h2 class="text-center">Cargar Receta</h2>
    <hr>

    <!-- 📌 INFO DEL PRODUCTO -->
    <div class="card mb-4">
        <div class="card-body text-center">

            <h4><?= esc($anteojo['anteojo_nombre']); ?></h4>

            <img src="<?= base_url('assets/uploads/'.$anteojo['anteojo_imagen']); ?>" 
                 width="200" class="img-fluid mb-3">

            <p><?= esc($anteojo['anteojo_descripcion']); ?></p>

            <h5>$ <?= number_format($anteojo['anteojo_precio'], 2); ?></h5>

        </div>
    </div>

    <!-- ✅ FORMULARIO -->
    <form action="<?= base_url('guardar_receta') ?>" method="post" enctype="multipart/form-data">

        <!-- 📌 ID DEL PRODUCTO (CLAVE PARA EVITAR ERROR #1048) -->

          <input type="hidden" name="id_anteojo" value="<?= $anteojo['id_anteojo']; ?>">

        
        <!-- 📌 DATOS PARA CARRITO (IMPORTANTE) -->
        <input type="hidden" name="nombre" value="<?= $anteojo['anteojo_nombre']; ?>">
        <input type="hidden" name="precio" value="<?= $anteojo['anteojo_precio']; ?>">
        <input type="hidden" name="imagen" value="<?= $anteojo['anteojo_imagen']; ?>">

        <!-- 📂 SUBIR ARCHIVO -->
        <div class="mb-3">
            <label class="form-label"><strong>Subir receta médica</strong></label>
            <input type="file" name="receta" class="form-control" required>
        </div>

        <!-- 📝 OBSERVACIONES -->
        <div class="mb-3">
            <label class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="3"
                placeholder="Ej: aumento, distancia, etc..."></textarea>
        </div>

        <!-- 🚀 BOTÓN -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                Enviar receta
            </button>
        </div>

    </form>
</div>

</section>