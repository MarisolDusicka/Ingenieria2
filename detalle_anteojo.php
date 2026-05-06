<section style="min-height: 900px; background-color: #D5DBDB;">
    <div class="container">
        <h2 class="text-center">Detalle del Anteojo</h2>
        <hr>

        <div class="row">
            
            <!-- 🖼️ IMAGEN -->
            <div class="col-md-6 text-center">
                <?php if (!empty($anteojo['anteojo_imagen'])) { ?>
                    <img width="300px"
                         src="<?= base_url('assets/uploads/' . $anteojo['anteojo_imagen']); ?>"
                         class="img-fluid">
                <?php } else { ?>
                    <img width="300px"
                         src="<?= base_url('assets/img/sin_imagen.png'); ?>"
                         class="img-fluid">
                <?php } ?>
            </div>

            <!-- 📄 INFO -->
            <div class="col-md-6">
                <h3><?= esc($anteojo['anteojo_nombre']); ?></h3>

                <p><?= esc($anteojo['anteojo_descripcion']); ?></p>

                <h4>$ <?= number_format($anteojo['anteojo_precio'], 2); ?></h4>

                <p><strong>Stock:</strong> <?= esc($anteojo['anteojo_stock']); ?></p>

                <hr>

                <!-- ✅ MENSAJE + BOTÓN RECETA -->
                <div class="alert alert-info text-center">

                    <p><strong>¿Tenés una receta médica?</strong></p>

                    <p>
                        Podés subir la receta que te dio el profesional para 
                        solicitar un presupuesto personalizado de este anteojo.
                    </p>

                    <a href="<?= base_url('receta/' . $anteojo['id_anteojo']); ?>" class="btn btn-primary">
                        Cargar receta
                    </a>

                </div>

            </div>
        </div>
    </div>
</section>