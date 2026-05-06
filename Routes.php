 <?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('principal', 'Home::principal');
$routes->get('/nosotros', 'Home::nosotros');
$routes->get('/contacto', 'Home::contacto');
$routes->get('/terminos', 'Home::terminos');
$routes->get('/pagos', 'Home::pagos');


/* Rutas  Consultas */

$routes->get('/contacto', 'Home::contacto');

$routes->get('ver_consulta', 'UsuarioController::ver_consulta');

$routes->post('guardarConsulta', 'UsuarioController::guardarConsulta');


$routes->get('Visto/(:any)', 'UsuarioController::ver_mensaje/$1');

$routes->get('No_Visto/(:any)', 'UsuarioController::mensaje_no_leido/$1');



/* Rutas  de UsuariosController */

$routes->get('/usuarios', 'UsuarioController::index');

$routes->get('/menuAdmin', 'UsuarioController::Administrador');

$routes->get('lista_ClientesRegistrado', 'UsuarioController::lista_ClientesRegistrado');

$routes->get('/registrarse', 'Home::registrarse');

$routes->post('/registrarCliente', 'UsuarioController::registrarCliente');

$routes->get('/editarCliente', 'UsuarioController::guardar');


$routes->get('/activo/(:any)', 'UsuarioController::activo_persona/$1');

$routes->get('/inactivo/(:any)', 'UsuarioController::persona_no_activo/$1');

$routes->get('/login', 'Home::iniciar_sesion');

$routes->post('login_usuario', 'UsuarioController::login_usuario');


$routes->get('salir', 'UsuarioController::salir');


/* Rutas  categoria */


$routes->get('/categoria', 'CategoriaController::index');

$routes->get('/categoria', 'MarcasController::listar_por_categoria');


$routes->get('/lectura', 'ProductoController::lentesReceta');
$routes->get('/sol', 'ProductoController::lentesSol');
$routes->get('/lentesContacto', 'ProductoController::lentesContacto');


/* Rutas  marcas */

$routes->get('/marcas', 'MarcasController::index');

$routes->get('/marcas', 'MarcasController::listar_por_marcas');


$routes->get('/lectura_aynotdead', 'MarcasController::lectura_aynotdead');
$routes->get('/lectura_infinity', 'MarcasController::lectura_infinity');
$routes->get('/lectura_loren', 'MarcasController::lectura_loren');
$routes->get('/lectura_mazza', 'MarcasController::lectura_mazza');
$routes->get('/lectura_rayban', 'MarcasController::lectura_rayban');

$routes->get('/sol_aynotdead', 'MarcasController::sol_aynotdead');
$routes->get('/sol_infinity', 'MarcasController::sol_infinity');
$routes->get('/sol_loren', 'MarcasController::sol_loren');
$routes->get('/sol_mazza', 'MarcasController::sol_mazza');
$routes->get('/sol_rayban', 'MarcasController::sol_rayban');




/* rutas de productos anteojos*/


$routes->get('/productos', 'ProductoController::index');

$routes->get('/catalogo_anteojos', 'ProductoController::lista_productos');



$routes->get('/listar_anteojos', 'ProductoController::gestionar_anteojo');

$routes->get('/agregar_anteojo', 'ProductoController::agregar_anteojo');

$routes->post('/registrar_anteojo', 'ProductoController::registrar_anteojo');


$routes->get('/editar/(:any)', 'ProductoController::editar_anteojo/$1');

$routes->post('/actualizar', 'ProductoController::actualizar_anteojo');



$routes->get('/eliminar_anteojo/(:any)', 'ProductoController::eliminar_anteojo/$1');


$routes->get('/activar_anteojo/(:any)', 'ProductoController::activar_anteojo/$1');



/*rutas del carrito */

$routes->get('/ver_carrito', 'CarritoController::ver_carrito');

$routes->post('/add_cart', 'CarritoController::agregar_carrito');


$routes->get('/eliminar_item/(:any)', 'CarritoController::borrar/$1');

$routes->get('/vaciar_carrito/(:any)', 'CarritoController::borrar/$1');


$routes->get('ver_pago', 'formaPago_Controller::ver_pago'); // Ruta para mostrar el formulario de pago (GET)

$routes->post('procesar_pago', 'formaPago_Controller::procesar_pago'); // Ruta para procesar el pago (POST)




/*rutas de ventas */

$routes->get('ventas', 'CarritoController::guardar_venta');

$routes->get('listar_ventas', 'CarritoController::listar_ventas');

$routes->get('detalle_venta/(:any)', 'CarritoController::detalle_ventas/$1');

$routes->get('mi_compra', 'CarritoController::ver_compra_cliente');

$routes->get('compra_detalle/(:any)', 'CarritoController::mi_compra_detalle/$1');



$routes->get('detalle_anteojo', 'ProductoController::ver');
$routes->get('receta/(:num)', 'ProductoController::form_receta/$1');


$routes->get('anteojo/(:num)', 'ProductoController::ver/$1');



$routes->get('receta/exito', 'Receta::exito');


// rutas vendedor 


$routes->get('receta/(:num)', 'Receta::form_receta/$1');
$routes->post('guardar_receta', 'Receta::guardar_receta');
$routes->get('ver_recetas', 'Receta::ver_recetas');


// FORM RECETA
$routes->get('receta/create/(:num)', 'Receta::create/$1');

// GUARDAR
$routes->post('guardar_receta', 'Receta::guardar_receta');

// ADMIN
$routes->get('ver_recetas', 'Receta::ver_recetas');

// CAMBIAR ESTADO
$routes->get('receta_estado/(:num)/(:any)', 'Receta::cambiar_estado/$1/$2');


$routes->get('receta_estado/(:num)/(:any)', 'Receta::cambiar_estado/$1/$2');


$routes->get('receta/editar/(:num)', 'Receta::editar/$1');
$routes->post('receta/actualizar', 'Receta::actualizar');

// 👇 NUEVA
$routes->get('receta/descargar/(:any)', 'Receta::descargar/$1');


