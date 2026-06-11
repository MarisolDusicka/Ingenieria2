<section style="min-height: 900px; background-color: #D5DBDB;">

    <div class="container">

        <h3>Listado de Anteojos</h3>
        <hr>

        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php foreach ($anteojos as $row) { ?>

                <div class="col">

                    <div class="card h-100">

                        <!-- IMAGEN -->
                        <img width="100%"
                             height="250px"
                             src="<?= base_url('assets/uploads/' . $row['anteojo_imagen']); ?>"
                             class="card-img-top"
                             style="object-fit: cover;">

                        <div class="card-body">

                            <!-- NOMBRE -->
                            <h5 class="text-center">
                                Marca: <?= $row['anteojo_nombre']; ?>
                            </h5>

                            <!-- DESCRIPCIÓN -->
                            <p>
                                <?= $row['anteojo_descripcion']; ?>
                            </p>

                            <!-- PRECIO -->
                            <p class="text-center">
                                <strong>
                                    $ <?= number_format($row['anteojo_precio'], 2); ?>
                                </strong>
                            </p>

                            <!-- STOCK -->
                            <p class="text-center">
                                Stock: <?= $row['anteojo_stock']; ?>
                            </p>

                            <!-- BOTÓN VER -->
                            <div class="text-center mb-2">

                                <a href="<?= base_url('anteojo/' . $row['id_anteojo']) ?>"
                                   class="btn btn-primary">

                                    Ver artículo

                                </a>

                            </div>

                            <!-- AGREGAR AL CARRITO -->
                            <?php if(session('login')){ ?>

                                <form action="<?= base_url('add_cart'); ?>"
                                      method="post">

                                    <input type="hidden"
                                           name="id"
                                           value="<?= $row['id_anteojo']; ?>">

                                    <input type="hidden"
                                           name="nombre"
                                           value="<?= $row['anteojo_nombre']; ?>">

                                    <input type="hidden"
                                           name="precio"
                                           value="<?= $row['anteojo_precio']; ?>">

                                    <input type="hidden"
                                           name="imagen"
                                           value="<?= $row['anteojo_imagen']; ?>">

                                    <div class="text-center">

                                        <button type="submit"
                                                class="btn btn-success">

                                            Agregar al carrito

                                        </button>

                                    </div>

                                </form>

                            <?php } else { ?>

                                <div class="text-center">

                                    <a href="<?= base_url('login'); ?>"
                                       class="btn btn-warning">

                                        Iniciar sesión para comprar

                                    </a>

                                </div>

                            <?php } ?>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

    <br>

    <!-- PAGINACIÓN -->
    <nav aria-label="Page navigation example">

        <ul class="pagination justify-content-center">

            <li class="page-item">

                <a class="page-link"
                   href="#"
                   aria-label="Previous">

                    <span>&laquo;</span>

                </a>

            </li>

            <li class="page-item">
                <a class="page-link" href="#">1</a>
            </li>

            <li class="page-item">

                <a class="page-link"
                   href="#"
                   aria-label="Next">

                    <span>&raquo;</span>

                </a>

            </li>

        </ul>

    </nav>

</section>