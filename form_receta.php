<section class="container mt-5 mb-5" style="min-height: 900px;">

    <div class="container bg-light p-4 rounded shadow-sm">

        <h2 class="text-center fw-bold">Cargar Receta Oftalmológica</h2>
        <hr>

        <div class="row">

            <!-- =============================== -->
            <!-- 📌 DETALLE DEL PRODUCTO -->
            <!-- =============================== -->
            <div class="col-md-5">

                <div class="card mb-4 shadow-sm">

                    <div class="card-body text-center">

                        <h4 class="fw-bold">
                            <?= esc($anteojo['anteojo_nombre']); ?>
                        </h4>

                        <img src="<?= base_url('assets/uploads/'.$anteojo['anteojo_imagen']); ?>"
                             width="250"
                             class="img-fluid mb-3 rounded">

                        <p>
                            <?= esc($anteojo['anteojo_descripcion']); ?>
                        </p>

                        <h4 class="text-danger">
                            $ <?= number_format($anteojo['anteojo_precio'], 2); ?>
                        </h4>

                    </div>

                </div>

            </div>

            <!-- =============================== -->
            <!-- ✅ FORMULARIO -->
            <!-- =============================== -->
            <div class="col-md-7">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <h4 class="mb-4 text-primary">
                            Subir Receta Médica
                        </h4>

                        <form action="<?= base_url('guardar_receta') ?>"
                              method="post"
                              enctype="multipart/form-data">

                            <!-- 📌 ID PRODUCTO -->
                            <input type="hidden"
                                   name="id_anteojo"
                                   value="<?= $anteojo['id_anteojo']; ?>">

                            <!-- 📌 DATOS CARRITO -->
                            <input type="hidden"
                                   name="nombre"
                                   value="<?= $anteojo['anteojo_nombre']; ?>">

                            <input type="hidden"
                                   name="precio"
                                   value="<?= $anteojo['anteojo_precio']; ?>">

                            <input type="hidden"
                                   name="imagen"
                                   value="<?= $anteojo['anteojo_imagen']; ?>">

                            <!-- 📂 ARCHIVO -->
                            <div class="mb-4">

                                <label class="form-label fw-bold">
                                    Subir receta médica
                                </label>

                                <input type="file"
                                       name="receta"
                                       class="form-control"
                                       required>

                                <small class="text-muted">
                                    Formatos permitidos: JPG, PNG, PDF.
                                </small>

                            </div>

                            <!-- 📝 OBSERVACIONES -->
                            <div class="mb-4">

                                <label class="form-label fw-bold">
                                    Observaciones
                                </label>

                                <textarea name="observaciones"
                                          class="form-control"
                                          rows="4"
                                          placeholder="Ej: aumento, distancia, antirreflejo, etc..."></textarea>

                            </div>

                            <!-- 🚀 BOTÓN -->
                            <div class="d-grid">

                                <button type="submit"
                                        class="btn btn-danger btn-lg">

                                    Enviar receta

                                </button>

                            </div>

                    

                         <!-- 👓 BOTÓN PROBADOR -->
<button type="button"
        class="btn btn-primary w-100 mt-3"
        data-bs-toggle="modal"
        data-bs-target="#modalProbador">
    👓 Probar Virtualmente
</button>

<!-- MODAL PROBADOR -->
<div class="modal fade" id="modalProbador" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Probador Virtual de Anteojos</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body text-center">

                <div class="probador-contenedor">

                    <video id="videoProbador"
                           autoplay
                           playsinline
                           muted>
                    </video>

                    <canvas id="canvasProbador"></canvas>

                </div>

                <div class="mt-4">

                    <h5 class="fw-bold">
                        <?= esc($anteojo['anteojo_nombre']); ?>
                    </h5>

                    <p class="mb-1">
                        Distancia Pupilar:
                        <strong><span id="distanciaPupilar">0</span> mm</strong>
                    </p>

                    <p>
                        Ancho del Rostro:
                        <strong><span id="anchoRostro">0</span> mm</strong>
                    </p>

                    <button type="button"
                            class="btn btn-success mt-2"
                            id="btnGuardarMedidas">
                        Guardar medidas
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<style>
    .probador-contenedor {
        position: relative;
        width: 100%;
        max-width: 640px;
        height: 480px;
        margin: auto;
        background: #000;
        border-radius: 12px;
        overflow: hidden;
    }

    #videoProbador,
    #canvasProbador {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 480px;
        object-fit: cover;
    }

    #videoProbador {
        transform: scaleX(-1);
    }

    #canvasProbador {
        transform: scaleX(-1);
        z-index: 2;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/face_mesh/face_mesh.js"></script>

<script>
    const videoProbador = document.getElementById('videoProbador');
    const canvasProbador = document.getElementById('canvasProbador');
    const ctx = canvasProbador.getContext('2d');

    let camera = null;
    let distanciaPupilar = 0;
    let anchoRostro = 0;

    /*
        Imagen del anteojo seleccionado.
        Usa la misma imagen del producto.
        Si querés usar una imagen PNG transparente específica del marco,
        guardala en assets/uploads/anteojos_probador/
    */
    const anteojoImg = new Image();
   anteojoImg.src = "<?= base_url('assets/uploads/probador/ay_not_dead.png'); ?>";
    const faceMesh = new FaceMesh({
        locateFile: function(file) {
            return `https://cdn.jsdelivr.net/npm/@mediapipe/face_mesh/${file}`;
        }
    });

    faceMesh.setOptions({
        maxNumFaces: 1,
        refineLandmarks: true,
        minDetectionConfidence: 0.6,
        minTrackingConfidence: 0.6
    });

    faceMesh.onResults(function(results) {

        canvasProbador.width = videoProbador.videoWidth;
        canvasProbador.height = videoProbador.videoHeight;

        ctx.clearRect(0, 0, canvasProbador.width, canvasProbador.height);

        if (!results.multiFaceLandmarks || results.multiFaceLandmarks.length === 0) {
            document.getElementById('distanciaPupilar').innerText = 0;
            document.getElementById('anchoRostro').innerText = 0;
            return;
        }

        const face = results.multiFaceLandmarks[0];

        /*
            Puntos importantes de MediaPipe FaceMesh:
            468 = pupila izquierda
            473 = pupila derecha
            234 = lateral izquierdo del rostro
            454 = lateral derecho del rostro
            168 = centro superior nariz/frente
        */

        const ojoIzquierdo = face[468];
        const ojoDerecho = face[473];

        const lateralIzquierdo = face[234];
        const lateralDerecho = face[454];

        const centroNariz = face[168];

        const xOjoIzq = ojoIzquierdo.x * canvasProbador.width;
        const yOjoIzq = ojoIzquierdo.y * canvasProbador.height;

        const xOjoDer = ojoDerecho.x * canvasProbador.width;
        const yOjoDer = ojoDerecho.y * canvasProbador.height;

        const xLatIzq = lateralIzquierdo.x * canvasProbador.width;
        const xLatDer = lateralDerecho.x * canvasProbador.width;

        const centroX = centroNariz.x * canvasProbador.width;
        const centroY = centroNariz.y * canvasProbador.height;

        const distanciaOjosPixeles = Math.abs(xOjoDer - xOjoIzq);
        const anchoRostroPixeles = Math.abs(xLatDer - xLatIzq);

        /*
            Cálculo aproximado:
            Se toma un ancho de rostro promedio de 140 mm.
            Con eso se estima la distancia pupilar.
        */
        const anchoRostroRealPromedio = 140;

        anchoRostro = anchoRostroRealPromedio;
        distanciaPupilar = (distanciaOjosPixeles * anchoRostroRealPromedio / anchoRostroPixeles).toFixed(2);

        document.getElementById('distanciaPupilar').innerText = distanciaPupilar;
        document.getElementById('anchoRostro').innerText = anchoRostro;

        /*
            Dibujar anteojo sobre el rostro.
            El tamaño se calcula según la distancia entre laterales del rostro.
        */
        const anchoAnteojo = anchoRostroPixeles * 0.90;
        const altoAnteojo = anchoAnteojo * 0.38;

        const xAnteojo = centroX - anchoAnteojo / 2;
        const yAnteojo = ((yOjoIzq + yOjoDer) / 2) - altoAnteojo / 2;

        ctx.drawImage(
            anteojoImg,
            xAnteojo,
            yAnteojo,
            anchoAnteojo,
            altoAnteojo
        );

        /*
            Guías opcionales para mostrar detección.
            Si no las querés, podés borrar estas líneas.
        */
        ctx.beginPath();
        ctx.arc(xOjoIzq, yOjoIzq, 4, 0, 2 * Math.PI);
        ctx.arc(xOjoDer, yOjoDer, 4, 0, 2 * Math.PI);
        ctx.fillStyle = "red";
        ctx.fill();

    });

    document.getElementById('modalProbador').addEventListener('shown.bs.modal', function() {

        camera = new Camera(videoProbador, {
            onFrame: async function() {
                await faceMesh.send({
                    image: videoProbador
                });
            },
            width: 640,
            height: 480
        });

        camera.start();

    });

    document.getElementById('modalProbador').addEventListener('hidden.bs.modal', function() {

        if (videoProbador.srcObject) {
            videoProbador.srcObject.getTracks().forEach(track => track.stop());
        }

        ctx.clearRect(0, 0, canvasProbador.width, canvasProbador.height);

    });

    document.getElementById('btnGuardarMedidas').addEventListener('click', function() {

        if (distanciaPupilar <= 0 || anchoRostro <= 0) {
            alert("Primero debe detectarse el rostro correctamente.");
            return;
        }

        fetch("<?= base_url('probador/guardar-medidas') ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify({
                id_anteojo: <?= $anteojo['id_anteojo']; ?>,
                distancia_pupilar: distanciaPupilar,
                ancho_rostro: anchoRostro
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.mensaje);
        })
        .catch(error => {
            console.error(error);
            alert("Error al guardar las medidas.");
        });

    });
</script>


</section>