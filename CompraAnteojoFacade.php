<?php

namespace App\Libraries;

use App\Models\RecetaModel;

class CompraAnteojoFacade
{
    public function procesarCompraConReceta(
        $idPersona,
        $idAnteojo,
        $observaciones,
        $archivo,
        $nombre,
        $precio,
        $imagen
    )
    
    {
        // 1) Guardar receta
        $ruta = FCPATH . 'assets/uploads/recetas/';

        if (!is_dir($ruta)) {
            mkdir($ruta, 0777, true);
        }

        $nuevoNombre = $archivo->getRandomName();
        $archivo->move($ruta, $nuevoNombre);

        // 2) Registrar receta
        $recetaModel = new RecetaModel();

        $recetaModel->insert([
            'id_persona'    => $idPersona,
            'id_anteojo'    => $idAnteojo,
            'receta'        => $nuevoNombre,
            'observaciones' => $observaciones,
            'fecha'         => date('Y-m-d H:i:s'),
            'estado'        => 'Pendiente'
        ]);

        // 3) Agregar al carrito
        $cart = \Config\Services::cart();

        $cart->insert([
            'id'    => $idAnteojo,
            'qty'   => 1,
            'price' => $precio,
            'name'  => $nombre,
            'img'   => $imagen
        ]);

        return true;
    }
}