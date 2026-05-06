<?php

namespace App\Controllers;

use CodeIgniter\Controller;


use App\Models\ProductoModel;
use App\Models\CategoriaModel;
use App\Models\MarcaModel;
use App\Models\UsuarioModel;


use App\Models\FormaPago_Model;




class ProductoController extends BaseController
{
  
   public function index(): string {

      $anteojos = new ProductoModel();

      $data['anteojos'] = $anteojos->findAll();


    $data['titulo']="productos";

   return view('front/header',$data).
              view('front/navbar').
              view('productos').
              view('front/footer');
    
    
       // return view('front/principal');
    }

    public function lentesReceta(){
      $data['titulo']="lectura";

    return view('front/header',$data).
              view('front/navbar').
              view('productos/categoria/lectura').
              view('front/footer');

    }


    public function lentesSol(){

      $data['titulo']="lectura";

    return view('front/header',$data).
              view('front/navbar').
              view('productos/categoria/sol').
              view('front/footer');
        
    }

public function lentesContacto(){

      $data['titulo']="lectura";
    return view('front/header',$data).
              view('front/navbar').
              view('productos/categoria/lentesContacto').
              view('front/footer');
        
    }



    public function lista_productos(){
        $anteojos = new ProductoModel();
        $categorias = new CategoriaModel();
        $marcas = new MarcaModel();

        $search = $this->request->getGet('buscar'); // Get the search query from the URL

        if ($search) {
            $data['anteojos'] = $anteojos->like('anteojo_nombre', $search)->findAll();
        } else {
            $data['anteojos'] = $anteojos->findAll();
        }

        $data['categorias'] = $categorias->findAll();
        $data['marcas'] = $marcas->findAll();
        $data['titulo'] = "lista_productos";

        return view('front/header', $data).
               view('front/navbar').
               view('paginas/catalogo_anteojos').
               view('front/footer');
    }


public function gestionar_anteojo(){

  $anteojos = new ProductoModel();

  $categorias = new CategoriaModel();
  $data['categorias'] = $categorias->findAll();

  $marcas = new MarcaModel();
  $data['marcas'] = $marcas->findAll();

  $data['anteojos'] = $anteojos->join('categorias', 'categorias.id_categoria = anteojos.anteojo_categoria')->findAll();


$data['anteojos'] = $anteojos->join('marcas', 'marcas.id_marca = anteojos.anteojo_marca')->findAll();

   $data['titulo']="gestionar_anteojo";
   return view('front/header',$data).view('backend/menuAdmin').view('backend/listar_anteojos').view('front/footer'); 

}



public function agregar_anteojo(){


  
      $anteojos = new ProductoModel();

      $data['anteojos'] = $anteojos->orderBy('id_anteojo', 'desc')->findAll();

  $categorias = new CategoriaModel();
  $data['categorias'] = $categorias->findAll();
  $marcas = new MarcaModel();
  $data['marcas'] = $marcas->findAll();


    $data['titulo']="agregar_anteojo";
   return view('front/header',$data).view('backend/menuAdmin').view('backend/agregar_anteojo').view('front/footer'); 
                

} // cierra agregar_anteojo



public function registrar_anteojo() {
  
  $validation = \Config\Services::validation();
  $request =  \Config\Services::request();

  $validation->setRules(
  [ 
    'codigo' => 'required',
    'nombre' => 'required',
    'categorias' => 'is_unique[categorias.id_categoria]',
    'marcas' => 'is_unique[marcas.id_marca]',
    'stock'=> 'required',
    'precio'=> 'required',
    'descripcion'=> 'required',
     'imagen' =>'uploaded[imagen]|max_size[imagen, 4096]|is_image[imagen]'
    ],
    [
       "codigo" => [
          "required" => 'El campo codigo es obligatorio'],

        "nombre" => [
          "required" => 'El campo nombre es obligatorio'],

        "categorias" => [
         
           "is_unique"=>'la categoria ingresada no esta permitido!'],

        "marcas" => [
          
          "is_unique"=>'la marca ingresada no esta permitido!'],

        "stock" => [
          "required" => 'El campo stock es obligatorio'],


        "precio" => [
          "required" => 'El campo precio es obligatorio'],

        "descripcion" => [
          "required" => 'El campo descripcion es obligatorio'],

        "imagen" => [
           'uploaded' => 'EL campo imagen es obligatorio!',
           'max_size' => 'La imagen supera el tamaño minimo',
           'is_image' => 'El campo debe recibir una imagen'],

       
    ]

  ); 

  if($validation ->withRequest($request)->run())
  {

       $img = $request->getFile('imagen');
       $nombre_aleatorio = $img->getRandomName();
       $img->move(ROOTPATH.'assets/uploads/', $nombre_aleatorio);

    $data = [

      'codigo_anteojo' => $this->request->getPost('codigo'),
       'anteojo_nombre'=> $this->request->getPost('nombre'), 
       'anteojo_categoria'=> $this->request->getPost('categorias'), 
       'anteojo_marca'=> $this->request->getPost('marcas'), 
       'anteojo_stock'=> $this->request->getPost('stock'), 
       'anteojo_precio'=> $this->request->getPost('precio'), 
       'anteojo_descripcion'=> $this->request->getPost('descripcion'),
        'anteojo_imagen'=> $nombre_aleatorio, 
        'anteojo_estado' => 1

    ];

    $anteojos = new ProductoModel();
    $anteojos->insert($data);          
    return redirect()->route('agregar_anteojo')->with('mensaje', 'Producto se registro con exito!');
} else {
    $data['validation'] = $validation->getErrors();

      $data['titulo']="agregar_anteojo";
   return view('front/header',$data).view('backend/menuAdmin').view('backend/agregar_anteojo').view('front/footer'); 
}

} // cierra registrar_anteojo

    
public function editar_anteojo($id=null){

$anteojos = new ProductoModel();

  $categorias = new CategoriaModel();
  $data['categorias'] = $categorias->findAll();
  $marcas = new MarcaModel();
  $data['marcas'] = $marcas->findAll();

//echo "hola"; die();
   $data['anteojos'] = $anteojos->where('id_anteojo',$id)->first();

    $data['titulo']="editar_anteojo";
   return view('front/header',$data).view('backend/menuAdmin').view('backend/editar_anteojo').view('front/footer'); 

}
/* metodo actualizar*/

public function actualizar_anteojo() {
  
  $validation = \Config\Services::validation();
  $request =  \Config\Services::request();

  $validation->setRules(
  [ 
    'codigo' => 'required',
    'nombre' => 'required',
    'categorias' => 'is_unique[categorias.id_categoria]',
    'marcas' => 'is_unique[marcas.id_marca]',
    'stock'=> 'required',
    'precio'=> 'required',
    'descripcion'=> 'required',
     'imagen' =>'uploaded[imagen]|max_size[imagen, 4096]|is_image[imagen]'
    ],
    [
       "codigo" => [
          "required" => 'El campo codigo es obligatorio'],

        "nombre" => [
          "required" => 'El campo nombre es obligatorio'],

        "categorias" => [
         
           "is_unique"=>'la categoria ingresada no esta permitido!'],

        "marcas" => [
          
          "is_unique"=>'la marca ingresada no esta permitido!'],

        "stock" => [
          "required" => 'El campo stock es obligatorio'],


        "precio" => [
          "required" => 'El campo precio es obligatorio'],

        "descripcion" => [
          "required" => 'El campo descripcion es obligatorio'],

        "imagen" => [
           'uploaded' => 'EL campo imagen es obligatorio!',
           'max_size' => 'La imagen supera el tamaño minimo',
           'is_image' => 'El campo debe recibir una imagen'],

       
    ]

  ); 

  if($validation ->withRequest($request)->run())
  {

       $img = $request->getFile('imagen');
       $nombre_aleatorio = $img->getRandomName();
       $img->move(ROOTPATH.'assets/uploads/', $nombre_aleatorio);

      $id_anteojo= $request->getPost('id');

    $data = [

      'codigo_anteojo' => $this->request->getPost('codigo'),
       'anteojo_nombre'=> $this->request->getPost('nombre'), 
       'anteojo_categoria'=> $this->request->getPost('categorias'), 
       'anteojo_marca'=> $this->request->getPost('marcas'), 
       'anteojo_stock'=> $this->request->getPost('stock'), 
       'anteojo_precio'=> $this->request->getPost('precio'), 
       'anteojo_descripcion'=> $this->request->getPost('descripcion'),
        'anteojo_imagen'=> $nombre_aleatorio, 
        'anteojo_estado' => 1

    ];

    $anteojos = new ProductoModel();
    $anteojos->update($id_anteojo, $data);          
    return redirect()->route('editar_anteojo')->with('mensaje', 'Producto se actualizo con exito!');
} else {
    $data['validation'] = $validation->getErrors();

      $data['titulo']="actualizar_anteojo";
   return view('front/header',$data).view('backend/menuAdmin').view('backend/editar_anteojo').view('front/footer'); 
}

} // cierra actualizar


  public function upload() {
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[userfile,100]',
                    'max_dims[userfile,1024,768]',
                ],
            ],
        ];
        if (! $this->validateData([], $validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];

            return view('upload_form', $data);
        }

        $img = $this->request->getFile('userfile');

        if (! $img->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $img->store();

            $data = ['uploaded_fileinfo' => new File($filepath)];

            return view('upload_success', $data);
        }

        $data = ['errors' => 'The file has already been moved.'];

        return view('upload_form', $data);
    }



/* metoso eliminar*/
    public function eliminar_anteojo($id = null)
    {

        // Se actualiza el estado del producto
        $data = array('anteojo_estado' => '0');
        $anteojos = new ProductoModel();
        $anteojos->update($id, $data);
        return redirect()->route('listar_anteojos');
    }

/* metoso activar_anteojo*/
    public function activar_anteojo($id = null)
    {

        // Se actualizza el estado del producto
        $data = array('anteojo_estado' => '1');
        $anteojos = new ProductoModel();
        $anteojos->update($id, $data);
        return redirect()->route('listar_anteojos');
    }




public function ver($id)
{
    $model = new ProductoModel();

    $data['anteojo'] = $model->find($id);

    if (!$data['anteojo']) {
        return redirect()->to(base_url('catalogo_anteojos'));
    }

    return view('front/header', $data)
        . view('front/navbar')
        . view('paginas/detalle_anteojo', $data)
        . view('front/footer');
}

public function form_receta($id = null)
{
    if (!$id) {
        return redirect()->to(base_url('catalogo_anteojos'));
    }

    $model = new \App\Models\ProductoModel();

    $data['anteojo'] = $model->find($id);

    if (!$data['anteojo']) {
        return redirect()->to(base_url('catalogo_anteojos'));
    }

    $data['titulo'] = "Cargar Receta";

    return view('front/header', $data)
        . view('front/navbar')
        . view('paginas/form_receta', $data)
        . view('front/footer');
}
} // cierra ProductoController