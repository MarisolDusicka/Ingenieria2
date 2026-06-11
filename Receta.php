<?php

namespace App\Controllers;

use App\Models\RecetaModel;

use App\Libraries\CompraAnteojoFacade;

class Receta extends BaseController
{
    /**
     * ============================================================
     * MÉTODO: guardar_receta()
     * ============================================================
     * Función:
     * Permite al cliente subir una receta oftalmológica y asociarla
     * al anteojo seleccionado.
     *
     * Patrón aplicado:
     * Utiliza el patrón Facade mediante la librería CompraAnteojoFacade.
     *
     * Procesos realizados por la fachada:
     * - Guarda la receta en el servidor.
     * - Registra la receta en la base de datos.
     * - Agrega el producto al carrito de compras.
     *
     * Resultado:
     * La receta queda registrada con estado "Pendiente".
     * ============================================================
     */
    public function guardar_receta()
    {
        $archivo = $this->request->getFile('receta');

        $facade = new CompraAnteojoFacade();

        $facade->procesarCompraConReceta(
            session('id_persona'),
            $this->request->getPost('id_anteojo'),
            $this->request->getPost('observaciones'),
            $archivo,
            $this->request->getPost('nombre'),
            $this->request->getPost('precio'),
            $this->request->getPost('imagen')
        );

        return redirect()->to(base_url('ver_carrito'))
            ->with('mensaje', 'Receta cargada y producto agregado al carrito');
    }

    /**
     * ============================================================
     * MÉTODO: ver_recetas()
     * ============================================================
     * Función:
     * Muestra al administrador las recetas pendientes.
     *
     * Procedimiento almacenado utilizado:
     * sp_consultar_recetas_pendientes()
     *
     * Invocación:
     * Menú administrador -> Recetas -> ruta ver_recetas
     *
     * Resultado:
     * Se obtiene el listado de recetas pendientes desde la base de datos.
     * ============================================================
     */
    public function ver_recetas()
    {
        $recetaModel = new RecetaModel();

        // Invocación del procedimiento almacenado de consulta
        $data['recetas'] = $recetaModel->consultarRecetasPendientesSP();

        $data['titulo'] = "Panel de Recetas Pendientes";

        return view('front/header', $data)
            . view('backend/menuAdmin')
            . view('backend/ver_recetas', $data)
            . view('front/footer');
    }

    /**
     * ============================================================
     * MÉTODO: cambiar_estado()
     * ============================================================
     * Función:
     * Permite aprobar o rechazar una receta desde el panel administrador.
     *
     * Procedimiento almacenado utilizado:
     * sp_actualizar_estado_receta()
     *
     * Parámetros:
     * $id -> ID de la receta.
     * $nuevoEstado -> aprobado o rechazado.
     *
     * Resultado:
     * La receta cambia su estado administrativo.
     * ============================================================
     */
    public function cambiar_estado($id = null, $nuevoEstado = null)
    {
        if ($id === null || $nuevoEstado === null) {
            return redirect()->to(base_url('ver_recetas'))
                ->with('error', 'Datos incompletos para actualizar la receta.');
        }

        $recetaModel = new RecetaModel();

        if ($nuevoEstado === 'aprobado' || $nuevoEstado === 'rechazado') {
            $estadoFormateado = ucfirst($nuevoEstado);

            // Invocación del procedimiento almacenado de actualización
            $recetaModel->actualizarEstadoRecetaSP($id, $estadoFormateado);

            return redirect()->to(base_url('ver_recetas'))
                ->with('mensaje', 'Estado actualizado a ' . $estadoFormateado);
        }

        return redirect()->to(base_url('ver_recetas'))
            ->with('error', 'Estado inválido');
    }

    /**
     * ============================================================
     * MÉTODO: descargar()
     * ============================================================
     * Función:
     * Permite descargar el archivo asociado a una receta.
     *
     * Parámetros:
     * $nombreArchivo -> nombre almacenado en la base de datos.
     *
     * Resultado:
     * El administrador obtiene una copia de la receta.
     * ============================================================
     */
    public function descargar($nombreArchivo = null)
    {
        if ($nombreArchivo === null) {
            return redirect()->to(base_url('ver_recetas'))
                ->with('error', 'No se especificó ningún archivo.');
        }

        $rutaCompleta = FCPATH . 'assets/uploads/recetas/' . $nombreArchivo;

        if (file_exists($rutaCompleta)) {
            return $this->response->download($rutaCompleta, null);
        }

        return redirect()->to(base_url('ver_recetas'))
            ->with('error', 'El archivo físico no fue encontrado.');
    }

    /**
     * ============================================================
     * MÉTODO: editar()
     * ============================================================
     * Función:
     * Muestra el formulario de edición de una receta.
     *
     * Parámetros:
     * $id -> identificador de la receta.
     *
     * Resultado:
     * El administrador puede modificar observaciones y estado.
     * ============================================================
     */
    public function editar($id = null)
    {
        $recetaModel = new RecetaModel();

        $receta = $recetaModel->find($id);

        if (!$receta) {
            return redirect()->to(base_url('ver_recetas'))
                ->with('error', 'La receta solicitada no existe.');
        }

        $data['titulo'] = "Editar Receta - Óptica Floripa";
        $data['receta'] = $receta;

        return view('front/header', $data)
            . view('backend/menuAdmin')
            . view('backend/editar_receta', $data)
            . view('front/footer');
    }

    /**
     * ============================================================
     * MÉTODO: actualizar()
     * ============================================================
     * Función:
     * Guarda las modificaciones realizadas sobre una receta.
     *
     * Campos modificables:
     * - observaciones
     * - estado
     *
     * Procedimiento almacenado utilizado:
     * sp_actualizar_estado_receta()
     *
     * Resultado:
     * La receta queda actualizada correctamente.
     * ============================================================
     */
    public function actualizar()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('ver_recetas'))
                ->with('error', 'Acceso no permitido.');
        }

        $recetaModel = new RecetaModel();

        $id_receta     = $this->request->getPost('id_receta');
        $observaciones = $this->request->getPost('observaciones');
        $estado        = $this->request->getPost('estado');

        $existe = $recetaModel->find($id_receta);

        if (!$existe) {
            return redirect()->to(base_url('ver_recetas'))
                ->with('error', 'La receta que intenta modificar no existe.');
        }

        // Actualización normal de observaciones mediante el modelo
        $recetaModel->update($id_receta, [
            'observaciones' => $observaciones
        ]);

        // Actualización del estado mediante procedimiento almacenado
        $recetaModel->actualizarEstadoRecetaSP($id_receta, $estado);

        return redirect()->to(base_url('ver_recetas'))
            ->with('mensaje', '¡Receta N° ' . $id_receta . ' actualizada correctamente!');
    }
}