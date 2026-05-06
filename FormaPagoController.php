<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\ProductoModel;
use App\Models\CategoriaModel;
use App\Models\MarcaModel;
use App\Models\UsuarioModel;


use App\Models\FormaPago_Model;





class formaPagoController extends BaseController {

    public function ver_pago() {

        $data['titulo'] = "ver_pago";
        $vistas = view('front/header', $data).
                  view('front/navbar').
                  view('paginas/forma_pago_view').
                  view('front/footer');
        return $vistas;
    }


public function procesar_pago()
{
    $cart = \Config\Services::cart();

    if ($this->request->getMethod() === 'post') {

        $forma_pago = $this->request->getPost('forma_pago');

        if (!$forma_pago) {
            return redirect()->back()->with('error', 'Seleccione un método de pago');
        }

        // 🔥 SIMULACIÓN DE PAGO EXITOSO

        // Vaciar carrito
        $cart->destroy();

        // Mensaje de éxito
        return redirect()->to(base_url('ver_carrito'))
            ->with('success', '✅ Pago realizado correctamente. El producto será entregado pronto.');
    }

    return redirect()->to('/');
}

}
