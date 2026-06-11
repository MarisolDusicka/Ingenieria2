<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/* =====================================================
| HOME / PÁGINAS ESTÁTICAS
===================================================== */
$routes->get('/', 'Home::index');
$routes->get('principal', 'Home::principal');
$routes->get('nosotros', 'Home::nosotros');
$routes->get('contacto', 'Home::contacto');
$routes->get('terminos', 'Home::terminos');
$routes->get('pagos', 'Home::pagos');

/* =====================================================
| USUARIOS Y AUTENTICACIÓN
===================================================== */
$routes->get('usuarios', 'UsuarioController::index');
$routes->get('admin', 'UsuarioController::Administrador'); 
$routes->get('menuAdmin', 'UsuarioController::Administrador'); // Alias mantenido por compatibilidad
$routes->get('lista_ClientesRegistrado', 'UsuarioController::lista_ClientesRegistrado');
$routes->get('registrarse', 'Home::registrarse');
$routes->post('registrarCliente', 'UsuarioController::registrarCliente');
$routes->get('editarCliente', 'UsuarioController::guardar');
$routes->get('login', 'Home::iniciar_sesion');
$routes->post('login_usuario', 'UsuarioController::login_usuario');
$routes->get('salir', 'UsuarioController::salir');

// Estados de Clientes (Se unificó a (:num) para IDs de usuario)
$routes->get('activo/(:num)', 'UsuarioController::activar_cliente/$1');
$routes->get('inactivo/(:num)', 'UsuarioController::desactivar_cliente/$1');

/* =====================================================
| CONSULTAS DE CONTACTO / MENSAJES
===================================================== */
$routes->get('ver_consultas', 'ContactoController::listar_consultas'); 
$routes->get('ver_consulta', 'UsuarioController::ver_consulta'); // Mantengo por si usas ambos paneles
$routes->post('guardarConsulta', 'UsuarioController::guardarConsulta');
$routes->get('Visto/(:num)', 'ContactoController::marcar_visto/$1');
$routes->get('No_Visto/(:num)', 'ContactoController::marcar_novisto/$1');

/* =====================================================
| GESTIÓN DE PRODUCTOS / ANTEOJOS (ADMINISTRADOR)
===================================================== */
$routes->get('productos', 'ProductoController::index');
$routes->get('listar_anteojos', 'ProductoController::listar_anteojos'); 
$routes->get('agregar_anteojo', 'ProductoController::agregar_anteojo');  
$routes->post('registrar_anteojo', 'ProductoController::registrar_anteojo');  

// EL placeholder (:num) captura el ID numérico (en este caso el "1" de editar/1)
$routes->get('editar/(:num)', 'ProductoController::editar_anteojo/$1');      

$routes->post('actualizar', 'ProductoController::actualizar_anteojo');        
$routes->get('eliminar_anteojo/(:num)', 'ProductoController::eliminar_anteojo/$1'); 
$routes->get('activar_anteojo/(:num)', 'ProductoController::activar_anteojo/$1');  

/* =====================================================
| PRODUCTOS / CATÁLOGO (CLIENTE)
===================================================== */
$routes->get('catalogo_anteojos', 'ProductoController::lista_productos');
$routes->get('anteojo/(:num)', 'ProductoController::ver/$1');
$routes->get('detalle_anteojo', 'ProductoController::ver'); // Fallback sin ID por si acaso
$routes->get('form_receta/(:num)', 'ProductoController::form_receta/$1');

/* =====================================================
| CATEGORÍAS Y MARCAS
==================================================== */
// Categorías
$routes->get('categoria', 'CategoriaController::index');
$routes->get('lectura', 'ProductoController::lentesReceta');
$routes->get('sol', 'ProductoController::lentesSol');
$routes->get('lentesContacto', 'ProductoController::lentesContacto');

// Marcas
$routes->get('marcas', 'MarcasController::index');
$routes->get('lectura_aynotdead', 'MarcasController::lectura_aynotdead');
$routes->get('lectura_infinity', 'MarcasController::lectura_infinity');
$routes->get('lectura_loren', 'MarcasController::lectura_loren');
$routes->get('lectura_mazza', 'MarcasController::lectura_mazza');
$routes->get('lectura_rayban', 'MarcasController::lectura_rayban');
$routes->get('sol_aynotdead', 'MarcasController::sol_aynotdead');
$routes->get('sol_infinity', 'MarcasController::sol_infinity');
$routes->get('sol_loren', 'MarcasController::sol_loren');
$routes->get('sol_mazza', 'MarcasController::sol_mazza');
$routes->get('sol_rayban', 'MarcasController::sol_rayban');


// =============================
// PROBADOR VIRTUAL
// =============================

$routes->get('probador_virtual', 'Probador_controller::index');
$routes->get('probador_virtual/(:num)', 'Probador_controller::index/$1');


$routes->post('probador/guardar-medidas', 'Probador_controller::guardarMedidas');


/* =====================================================
| RECETAS
===================================================== */
$routes->post('guardar_receta', 'Receta::guardar_receta');
$routes->get('receta/exito', 'Receta::exito');

$routes->get('ver_recetas', 'Receta::ver_recetas');

$routes->get('receta/editar/(:num)', 'Receta::editar/$1'); 
$routes->post('receta/actualizar', 'Receta::actualizar');
$routes->get('receta_estado/(:num)/(:any)', 'Receta::cambiar_estado/$1/$2');
$routes->get('receta/descargar/(:any)', 'Receta::descargar/$1');

/* =====================================================
| CARRITO DE COMPRAS
===================================================== */
$routes->get('ver_carrito', 'CarritoController::ver_carrito');
$routes->post('add_cart', 'CarritoController::agregar_carrito');
$routes->get('eliminar_item/(:any)', 'CarritoController::borrar/$1');
$routes->get('vaciar_carrito', 'CarritoController::borrar'); // Vaciar todo
$routes->get('vaciar_carrito/all', 'CarritoController::borrar/all'); // Variación por parámetro

/* =====================================================
| FLUJO DE COMPRA Y PASARELA
===================================================== */
$routes->get('datos_entrega', 'CompraController::datos_entrega');
$routes->post('continuar_pago', 'FormaPagoController::ver_pago');
$routes->get('ver_pago', 'FormaPagoController::ver_pago'); 
$routes->post('procesar_pago', 'FormaPagoController::procesar_pago'); // Se priorizó FormaPagoController
$routes->get('ventas', 'CarritoController::guardar_venta'); // Ruta alternativa de procesamiento

// Respuestas de la pasarela
$routes->get('pago_exitoso', 'FormaPagoController::pago_exitoso');
$routes->get('pago_fallido', 'FormaPagoController::pago_fallido');
$routes->get('pago_pendiente', 'FormaPagoController::pago_pendiente');

/* =====================================================
| HISTORIAL DE VENTAS (ADMIN Y CLIENTE)
===================================================== */
$routes->get('listar_ventas', 'CarritoController::listar_ventas');
$routes->get('detalle_venta/(:any)', 'CarritoController::detalle_ventas/$1');
$routes->get('mi_compra', 'CarritoController::ver_compra_cliente');
$routes->get('compra_detalle/(:any)', 'CarritoController::mi_compra_detalle/$1');


