<?php

namespace App\Controllers;

use App\Models\ConsultaModel;
use App\Models\UsuarioModel;

use App\libraries\PDF;

class UsuarioController extends BaseController 
{
  public function index(){
    $data['titulo']="menuAdmin";
       $vistas = view('front/header',$data).
              view('backend/menuAdmin').
              view('usuarios').
              view('front/footer');
         return $vistas;
    }


public function Administrador() {

      $data['titulo']="Administrador";
       return view('front/header',$data).
              view('backend/menuAdmin').
              view('paginas/contenidoAdmin').
              view('front/footer');
     }

   

public function lista_ClientesRegistrado() {
   $db = \Config\Database::connect(); // Obtener la instancia de la base de datos

   $personas = $db->query("SELECT * FROM personas");
   $data['personas'] = $personas->getResult(); // Obtener los resultados

  $data['titulo']="lista_ClientesRegistrado";
  $vistas = view('front/header',$data).
            view('backend/menuAdmin').
            view('backend/lista_ClientesRegistrado'). 
            view('front/footer'); 
      return $vistas;
}

public function registrarCliente() {
  
  $validation = \Config\Services::validation();
  $request =  \Config\Services::request();

  $validation->setRules(
  [ 
    'nombre' => 'required',
    'apellido' => 'required',
    'telefono' => 'required',
    'direccion' => 'required',
    'correo' => 'required|valid_email|is_unique[personas.persona_email]',
    'pass' => 'required|min_length[8]',
    'repass' => 'required|min_length[8]|matches[pass]'
    ],
    [
       "nombre" => [
          "required" => 'El campo nombre es obligatorio'],

        "apellido" => [
          "required" => 'El campo apellido es obligatorio'],

        "telefono" => [
          "required" => 'El campo teléfono es obligatorio'],

        "direccion" => [
          "required" => 'El campo direccion es obligatorio'],

        "correo" => [
          "required" => 'El campo correo electrónico es obligatorio',
          "valid_mail" => 'Debe ingresar una dirección de correo válida',
          "is_unique" => 'El usuario ya se encuentra registrado'],

          "pass" => [
          "required" => 'La contraseña es obligatoria',
          "min_length" => 'El campo contraseña debe tener al menos 8 caracteres'],

        "repass" => [
          "required" => 'El campo repetir contraseña es obligatorio',
          "min_length" => 'El campo contraseña debe tener al menos 8 caracteres',
          "matches" => 'Las contraseñas no coinciden'],
    ]

  ); 

  if($validation ->withRequest($request)->run())
  {
    $data = [

        'persona_nombre' => $this->request->getPost('nombre'),
        'persona_apellido' => $this->request->getPost('apellido'),
        'persona_telefono' => $this->request->getPost('telefono'),
        'persona_direccion' => $this->request->getPost('direccion'),
        'persona_email' => $this->request->getPost('correo'),
        'persona_password' => password_hash($request->getPost('pass'), PASSWORD_BCRYPT),
        'perfil_id' => 2,
        'persona_estado' => 1
       
    ];

    $personas = new UsuarioModel();
    $personas->insert($data);          
    return redirect()->route('registrarse')->with('mensaje', 'Usuario se registro con exito!');
} else {
    $data['validation'] = $validation->getErrors();
    $data['titulo']="registrarse";
      return view('front/header',$data).view('front/navbar'). view('backend/registrarse').view('front/footer');
}

} // cierra registrarCliente

/* metodo de clientes activos e inactivo*/

public function activo_persona($id = null) {

        // Se actualiza el estado del producto
        $data = array('personas' => '0');
        $personas = new UsuarioModel();
        $personas->update($id, $data);
        return redirect()->route('lista_ClientesRegistrado');
    }

/* metoso activar_anteojo*/
    public function persona_no_activo($id = null) {

        // Se actualizza el estado del producto
        $data = array('recibido' => '1');
        $personas = new UsuarioModel();
        $personas->update($id, $data);
        return redirect()->route('lista_ClientesRegistrado');
    }

/* metodo de consultas de clientes*/

  public function ver_consulta() {
  $db = \Config\Database::connect(); // Obtener la instancia de la base de datos
       // Ejecutar la consulta

  $consultas = $db->query("SELECT * FROM consultas");
  $data['consultas'] = $consultas->getResult(); // Obtener los resultados

  $data['titulo']="listar_consultas";
  $vistas = view('front/header',$data).
            view('backend/menuAdmin').
            view('backend/ver_consulta'). 
            view('front/footer'); 
      return $vistas;
    }

public function guardarConsulta() {
  $validation = \Config\Services::validation();
  $request =  \Config\Services::request();

  $validation->setRules(
  [ 
     'nombre' => 'required|max_length[50]',
     'correo' => 'required|valid_email',
     'motivo' => 'required|max_length[100]',
     'consulta' => 'required|max_length[250]|min_length[10]',
    ],
    [
      'nombre'=> ['required'=>'el nombre y apellido debe ser obligatorio', 
                        'max_length'=>'no debe superar los 50 caracteres.'],

       'correo'=> ['required'=>'El correo electronico debe ser obligatorio', 
                   'valid_email'=>'la direccion de correo debe ser valida.'],

       'motivo'=> ['required'=>'El asunto debe ser obligatorio', 
                'max_length'=>'el asunto de la consulta debe tener como maximo 100 caracteres.'],

       'consulta'=> ['required'=>'la consulta debe ser obligatorio', 
                'max_length'=>'el asunto de la consulta debe tener como maximo 250 caracteres',
                'min_length'=>'la consulta debe tener como minimo 10 caracteres' ],
     ]
   ); 
   if($validation ->withRequest($request)->run()) 
   {
    $data = [
         'nombre'=>$request->getPost('nombre'),
         'email'=>$request->getPost('correo'),
         'motivo'=>$request->getPost('motivo'),
         'consulta'=>$request->getPost('consulta'),
         'recibido'=> 1 
    ];
      $consulta = new ConsultaModel();
      $consulta->insert( $data);          
    return redirect()->route('contacto')->with('mensaje', 'Su consulta se envio con exito!');
} else {
    $data['validation'] = $validation->getErrors();
    $data['titulo']="contacto";
      return view('front/header',$data). view('front/navbar').view('paginas/contacto').view('front/footer');
}

} // cierra guardarConsulta


public function ver_mensaje($id = null) {

        // Se actualiza el estado del producto
        $data = array('recibido' => '0');
        $consultas = new ConsultaModel();
        $consultas->update($id, $data);
        return redirect()->route('ver_consulta');
    }

/* metoso activar_anteojo*/
    public function mensaje_no_leido($id = null) {

        // Se actualizza el estado del producto
        $data = array('recibido' => '1');
        $consultas = new ConsultaModel();
        $consultas->update($id, $data);
        return redirect()->route('ver_consulta');
    }


/* metodo login*/

public function login_usuario()
{

        $request = \Config\Services::request();
        $session = session();
        $validation = \Config\Services::validation();


    $email = $request -> getPost('email');
    $password = $request->getPost('pass');

    $personas = new UsuarioModel();
    $personas = $personas->where('persona_email', $email)->first();

    if(count($personas) > 0 ) 
      {
        $pass = $personas['persona_password'];
         $pass_verif = password_verify($password,$pass);

         if($pass_verif)
         {
        $data = [
    'id_persona' => $personas['id_persona'], // ✔ CORRECTO
    'nombre'     => $personas['persona_nombre'],
    'apellido'   => $personas['persona_apellido'],
    'perfil'     => $personas['perfil_id'],
    'login'      => true,
]; 
  $session->set($data);
             switch ($personas['perfil_id']) 
             {
                case '1':
                  return redirect()->route('menuAdmin');
                   break;
                  case '2': 
                 return redirect()->route('principal');
                    break;
               }

                } else{
                     return redirect()->to('login');
                   }
              }  // cierra if(count($persona) > 0 ) 
                else {
                    $data['errors'] = $validation->getErrors();
                   }
              $data['titulo']="Administrador";

             return view('front/header',$data). view('backend/menuAdmin').view('paginas/contenidoAdmin').view('front/footer');
     
        } // cierra login_usuario            
        
        


/* metodo salir*/
 public function salir()
 {
    $session = session();
    $session->destroy();
    return redirect()->to('login');
}




} // cierra usuarioController