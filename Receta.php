<?php

namespace App\Controllers;

use App\Models\RecetaModel;
use App\Models\ProductoModel;

class Receta extends BaseController
{
    // 📌 FORMULARIO
    public function create($id)
    {
        $producto = new ProductoModel();

        $data['anteojo'] = $producto->find($id);

        return view('front/header')
            . view('front/navbar')
            . view('paginas/form_receta', $data)
            . view('front/footer');
    }

    // 📌 GUARDAR
    public function guardar_receta()
    {
        $model = new RecetaModel();

        $file = $this->request->getFile('receta');
        $archivo = null;

        if ($file && $file->isValid()) {
            $archivo = $file->getRandomName();
            $file->move('assets/recetas', $archivo);
        }

        $data = [
            'id_persona'    => session()->get('id_persona'),
            'id_anteojo'    => $this->request->getPost('id_anteojo'),
            'observaciones' => $this->request->getPost('observaciones'),
            'receta'        => $archivo,
            'fecha'         => date('Y-m-d'),
            'estado'        => 'pendiente'
        ];

        $model->insert($data);

        return redirect()->to(base_url('receta/exito'));
    }

    // 📌 LISTADO ADMIN
   public function ver_recetas()
{
    $model = new \App\Models\RecetaModel();

    $data['recetas'] = $model->getRecetas();

    return view('front/header')
        . view('backend/menuAdmin')
        . view('backend/ver_recetas', $data)
        . view('front/footer');
}
    // 📌 CAMBIAR ESTADO
    public function cambiar_estado($id, $estado)
    {
        $model = new RecetaModel();

        $model->update($id, ['estado' => $estado]);

        return redirect()->to(base_url('ver_recetas'));
    }


    // 📌 EDITAR (mostrar formulario)
public function editar($id)
{
    $model = new \App\Models\RecetaModel();

    $data['receta'] = $model->find($id);

    if (!$data['receta']) {
        return redirect()->to(base_url('ver_recetas'));
    }

    return view('front/header')
        . view('backend/menuAdmin')
        . view('backend/editar_receta', $data)
        . view('front/footer');
}


// 📌 ACTUALIZAR
public function actualizar()
{
    $model = new \App\Models\RecetaModel();

    $id = $this->request->getPost('id_receta');

    $data = [
        'observaciones' => $this->request->getPost('observaciones'),
        'estado' => $this->request->getPost('estado')
    ];

    $model->update($id, $data);

    return redirect()->to(base_url('ver_recetas'));
}


// 📌 DESCARGAR RECETA
public function descargar($nombreArchivo)
{
    $ruta = FCPATH . 'assets/recetas/' . $nombreArchivo;

    if (!file_exists($ruta)) {
        return redirect()->back()->with('error', 'Archivo no encontrado');
    }

    return $this->response->download($ruta, null);
}



public function exito()
{
    return view('front/header')
        . view('front/navbar')   // 👈 IMPORTANTE (te faltaba)
        . view('front/mensaje_receta') // 👈 tu vista correcta
        . view('front/footer');
}


}