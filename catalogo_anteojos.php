<section style="min-height: 900px; background-color: #D5DBDB;">
    <div class="container">
        <h3>Listado de Anteojos</h3><hr>

        <div class="row row-cols-1 row-cols-md-3 g-4">
           <?php foreach ($anteojos as $row) { ?>
<div class="col">
    <div class="card h-100">

        <img width="100%" height="250px"
             src="<?= base_url('assets/uploads/' . $row['anteojo_imagen']); ?>"
             class="card-img-top"
             style="object-fit: cover;">

        <div class="card-body">

            <h5 class="text-center">
                Marca: <?= $row['anteojo_nombre']; ?>
            </h5>

            <p><?= $row['anteojo_descripcion']; ?></p>

            <p class="text-center">
                <strong>$ <?= $row['anteojo_precio']; ?></strong>
            </p>

            <p class="text-center">
                Stock: <?= $row['anteojo_stock']; ?>
            </p>

            <!-- ✅ BOTÓN CORRECTO -->
           <div class="text-center">
    <a href="<?= base_url('anteojo/'.$row['id_anteojo']) ?>" class="btn btn-primary">
    Ver artículo
</a>
</div>
        </div>
    </div>
</div>
<?php } ?>
                        <!-- ✅ BOTÓN AGREGAR AL CARRITO -->
                        <?php if(session('login')){ ?>
                            <?php echo form_open('add_cart'); ?>

                            <?php echo form_hidden('id', $row['id_anteojo']); ?>
                            <?php echo form_hidden('nombre', $row['anteojo_nombre']); ?>
                            <?php echo form_hidden('precio', $row['anteojo_precio']); ?>
                            <?php echo form_hidden('imagen', $row['anteojo_imagen']); ?>

                            <div class="text-center">
                                <?php echo form_submit('comprar', 'Agregar al carrito', "class='btn btn-success'"); ?>
                            </div>

                            <?php echo form_close(); ?>
                        <?php } else { ?>

                            <div class="text-center">
                                <a href="<?php echo base_url('login'); ?>" class="btn btn-warning">
                                    Iniciar sesión para comprar
                                </a>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
           
        </div>
    </div><br>

    <!-- PAGINACIÓN -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">

            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span>&laquo;</span>
                </a>
            </li>

            <li class="page-item">
                <a class="page-link" href="#">1</a>
            </li>

            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span>&raquo;</span>
                </a>
            </li>

        </ul>
    </nav>
</section>