<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\WebhooksController;
use App\Http\Controllers\ExpedientesController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\RevoesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('403', function () {
    return view('errors.403');
})->name('403');

Route::get('404', function () {
    return view('errors.404');
});

Route::get('500', function () {
    return view('errors.500');
});

Route::get('check', function () {
    return view('user.components.checkout_paquetes');
});


Route::get('login', function () {
    return view('auth.login');
});


Route::get('orden', function () {
    return view('user.order');
});

Route::get('create_acount', function () {
    return view('emails.create_acount');
});

Route::get('recibo', function () {
    return view('emails.pedido_resibido_user');
});

Route::get('meet', function () {
    return view('emails.liga_meet');
});

Route::get('sede', function () {
    return view('emails.sede_del_curso');
});

Route::get('pago_exterior', function () {
    return view('emails.pago_exterior');
});

Route::get('reporte_tickets_vendidos', function () {
    return view('emails.reporte_tickets_vendidos');
});

Route::get('vistahorizontal', function () {
    return view('user.single_coursenew');
});

Auth::routes();

Route::post('/votar', [App\Http\Controllers\VotosController::class, 'votar'])->name('votar');

Route::get('/', [App\Http\Controllers\HomeUsersController::class, 'index'])->name('user.home');
Route::get('avales', [App\Http\Controllers\WebPageController::class, 'avales'])->name('user.avales');
Route::get('nuestras_instalaciones', [App\Http\Controllers\WebPageController::class, 'instalaciones'])->name('user.instalaciones');
Route::get('nosotros', [App\Http\Controllers\WebPageController::class, 'nosotros'])->name('user.nosotros');
Route::get('show', [App\Http\Controllers\WebPageController::class, 'reality'])->name('user.reality');

// =============== P A G I N A  S I N G L E  C O U R S E ===============================
Route::get('/curso/{slug}', [App\Http\Controllers\CursoUsersController::class, 'show'])->name('cursos.show');
Route::get('/calendario', [App\Http\Controllers\CursoUsersController::class, 'index_user'])->name('cursos.index_user');
Route::get('/calendario/advance', [App\Http\Controllers\CursoUsersController::class, 'advance'])->name('advance_search');
Route::post('/mensaje', [App\Http\Controllers\CursoUsersController::class, 'enviarFormulario'])->name('mensaje.form');

// =============== P A Q U E T E S ===============
Route::get('/paquetes', [App\Http\Controllers\CursoUsersController::class, 'paquetes'])->name('cursos.paquetes');

Route::post('/paquetes/resultado', [App\Http\Controllers\OrderController::class, 'resultado'])->name('carrito.resultado');
Route::post('/paquetes/resultado2', [App\Http\Controllers\OrderController::class, 'resultado'])->name('carrito.resultado2');
Route::post('/paquetes/resultado3', [App\Http\Controllers\OrderController::class, 'resultado'])->name('carrito.resultado3');
Route::post('/paquetes/resultado4', [App\Http\Controllers\OrderController::class, 'resultado'])->name('carrito.resultado4');
Route::post('/paquetes/resultado5', [App\Http\Controllers\OrderController::class, 'resultado'])->name('carrito.resultado5');
Route::get('/paquetes/resumen', [App\Http\Controllers\CursoUsersController::class, 'resumen'])->name('carrito.resumen');

// =============== P A G O S ===============================
Route::post('/clases_gratis', [OrderController::class, 'clases_gratis'])->name('clases_gratis');
Route::post('/process-payment', [OrderController::class, 'processPayment'])->name('process-payment');

Route::post('/webhooks', WebhooksController::class);

Route::get('/orders/pay', [OrderController::class, 'pay'])->name('order.pay');
Route::get('/orders/{code}/show', [OrderController::class, 'show'])->name('order.show');

Route::post('/orders/pay/stripe', [OrderController::class, 'pay_stripe'])->name('order.pay_stripe');

Route::post('/paquete/pay/stripe', [OrderController::class, 'pay_stripe_paquete'])->name('order.pay_stripe_paquete');
Route::post('/vaciar-carrito', [OrderController::class, 'vaciar_carrito'])->name('vaciar_carrito');

Route::post('/order/pay/envio', [OrderController::class, 'pagar_envio'])->name('order.pay_envio');

// =============== C A R R I T O ===============================
Route::get('add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('add.to.cart');
Route::patch('/update-cart', [OrderController::class, 'update'])->name('update.cart');
Route::delete('/remove-from-cart', [OrderController::class, 'remove'])->name('remove.from.cart');

Route::post('/cupon', [OrderController::class, 'aplicarCupon'])->name('cupon.aplicar');
Route::post('remove-coupon', [OrderController::class, 'removeCoupon'])->name('removeCoupon');

// =============== L O G I N  U S E R S ===============================
Route::get('perfil/{code}', [App\Http\Controllers\ClientsController::class, 'index'])->name('perfil.index');
Route::get('perfil/user/{id}', [App\Http\Controllers\ClientsController::class, 'show'])->name('perfil.show');

Route::patch('/perfil/update/{code}', [App\Http\Controllers\ClientsController::class, 'update'])->name('perfil.update');
Route::patch('clientes/documentos/{id}', [App\Http\Controllers\ClientsController::class, 'update_documentos_cliente'])->name('clientes.update_documentos_cliente');
Route::post('clientes/documentos/estandar/{id}', [App\Http\Controllers\ClientsController::class, 'documentos_estandares_cliente'])->name('documentos.store_cliente');
Route::patch('admin/perfil/{id}', [App\Http\Controllers\ClientsController::class, 'update_situacionfiscal'])->name('perfil.update_situacionfiscal');
Route::post('/admin/factura/store', [App\Http\Controllers\ClientsController::class, 'store_factura'])->name('factura.store');
Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::post('custom-registration', [App\Http\Controllers\CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [App\Http\Controllers\CustomAuthController::class, 'signOut'])->name('signout');



// =============== M O D U L O   C U R S O ===============================
Route::get('/nota/curso', [App\Http\Controllers\NotasCursosController::class, 'index_user'])->name('notas.index_user');

Route::group(['middleware' => ['auth']], function() {


    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/show/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::patch('/roles/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/delete/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('destroy.roles');

    Route::resource('permisos', PermisosController::class);
    Route::resource('users', UserController::class);

    // =============== M O D U L O   C U R S O S ===============================
    Route::get('/admin/cursos', [App\Http\Controllers\CursosController::class, 'index'])->name('cursos.index');
    Route::get('/admin/cursos/dia', [App\Http\Controllers\CursosController::class, 'index_dia'])->name('cursos.index_dia');
    Route::get('/admin/cursos/create', [App\Http\Controllers\CursosController::class, 'create'])->name('cursos.create');
    Route::post('/admin/cursos/store', [App\Http\Controllers\CursosController::class, 'store'])->name('cursos.store');
    Route::get('/admin/cursos/edit/{id}', [App\Http\Controllers\CursosController::class, 'edit'])->name('cursos.edit');
    Route::patch('/admin/cursos/update/{id}', [App\Http\Controllers\CursosController::class, 'update'])->name('cursos.update');
    Route::patch('/admin/cursos/link_meet/{id}', [App\Http\Controllers\CursosController::class, 'update_meet'])->name('cursos.update_meet');
    Route::patch('/admin/cursos/material_clase/{id}', [App\Http\Controllers\CursosController::class, 'update_materialclase'])->name('cursos.material_clase');
    Route::delete('/admin/cursos/delete/{id}', [App\Http\Controllers\CursosController::class, 'destroy'])->name('cursos.destroy');
    Route::get('/admin/cursos/listas/{id}', [App\Http\Controllers\CursosController::class, 'listas'])->name('cursos.listas');
    Route::post('/admin/cursos/correo/{id}', [App\Http\Controllers\CursosController::class, 'correo'])->name('cursos.correo');

    Route::post('/admin/cursos/recordatorios/store', [App\Http\Controllers\CursosController::class, 'recordatorios_store'])->name('recordatorio.store');

    Route::post('/cursos/{id}/duplicar', [App\Http\Controllers\CursosController::class, 'duplicar'])->name('cursos.duplicar');

    // =============== M O D U L O  Profesores ===============================
    Route::get('/admin/profesores', [App\Http\Controllers\ProfesoresController::class, 'index_profesores'])->name('profesores.index');
    Route::post('/admin/profesores/store', [App\Http\Controllers\ProfesoresController::class, 'store_profesores'])->name('profesores.store');
    Route::patch('/admin/profesores/update/{id}', [App\Http\Controllers\ProfesoresController::class, 'update_profesores'])->name('profesores.update');
    Route::get('/profesor/cursos', [App\Http\Controllers\ProfesoresController::class, 'index_clase'])->name('clase.index');
    Route::get('/profesor/clase/{id}', [App\Http\Controllers\ProfesoresController::class, 'index_profesor_single'])->name('single_course.index');
    Route::get('/profesor/inicio', [App\Http\Controllers\ProfesoresController::class, 'dashboard'])->name('dashboard.index');
    Route::post('/profesor/changeStatus', [App\Http\Controllers\ProfesoresController::class, 'ChangeAsistenciaStatus'])->name('ChangeAsistenciaStatus.clase');
    Route::get('fullcalender', [App\Http\Controllers\FullCalenderController::class, 'index']);
    Route::post('fullcalenderAjax', [App\Http\Controllers\FullCalenderController::class, 'ajax']);


    // =============== M O D U L O   P A G O S  P O R  F U E R A ===============================
    Route::get('/admin/pagos-por-fuera/inscripcion', [App\Http\Controllers\PagosFueraController::class, 'inscripcion'])->name('pagos.inscripcion');
    Route::post('/admin/pagos-por-fuera/inscripcion/store', [App\Http\Controllers\PagosFueraController::class, 'store'])->name('pagos.store');
    Route::patch('/admin/pagos-por-fuera/inscripcion/edit/{id}', [App\Http\Controllers\PagosFueraController::class, 'update_deudores'])->name('pagos.update_deudores');;


    Route::get('/changeStatus', [App\Http\Controllers\PagosFueraController::class, 'ChangeInscripcionStatus'])->name('ChangeInscripcionStatus.pagos');
    Route::get('/changeStatus/pago', [App\Http\Controllers\PagosFueraController::class, 'ChangePendienteStatus'])->name('ChangePendienteStatus.pagos');
    Route::get('/changeStatus/deudor', [App\Http\Controllers\PagosFueraController::class, 'ChangeDeudorStatus'])->name('ChangeDeudorStatus.pagos');

    Route::get('/admin/pagos-por-fuera/pendientes', [App\Http\Controllers\PagosFueraController::class, 'pendientes'])->name('pagos.pendientes');
    Route::get('/admin/pagos-por-fuera/deudores', [App\Http\Controllers\PagosFueraController::class, 'deudores'])->name('pagos.deudores');

    // =============== M O D U L O   O R D E N E S ===============================
    Route::post('/clientes/curso/create', [App\Http\Controllers\OrderController::class, 'pay_externo'])->name('orden.pay_externo');


    // =============== M O D U L O   I N S C R I P C I O N E S ===============================
    Route::get('/admin/pagos', [App\Http\Controllers\PagosFueraController::class, 'index_pago'])->name('pagos.index_pago');
    Route::get('/admin/pagos/edit/{id}', [App\Http\Controllers\PagosFueraController::class, 'edit_pago'])->name('pagos.edit_pago');
    Route::patch('/admin/pagos/update/{id}', [App\Http\Controllers\PagosFueraController::class, 'update_pago'])->name('pagos.update_pago');
    Route::get('/admin/pagos/pendiente', [App\Http\Controllers\PagosFueraController::class, 'index_pago_pendiente'])->name('pagos.index_pago_pendiente');

    Route::get('/admin/pagos/mercado', [App\Http\Controllers\PagosFueraController::class, 'mercado_pago'])->name('mercado.pago');

    Route::patch('/cursos/cambio/{id}', [App\Http\Controllers\PagosFueraController::class, 'cambio'])->name('cursos.cambio');
    Route::get('/admin/pagos/edit/cambio/{id}',  [App\Http\Controllers\PagosFueraController::class, 'getTicketsByCurso']);
    /*|--------------------------------------------------------------------------
    |Configuracion
    |--------------------------------------------------------------------------*/
    Route::get('/configuracion', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('index.configuracion');
    Route::patch('/configuracion/update', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('update.configuracion');

    // =============== M O D U L O   C O M E N T A R I O S ===============================
    Route::get('/admin/comentarios', [App\Http\Controllers\ComentariosController::class, 'index'])->name('comentarios.index');
    Route::get('/admin/comentarios/create', [App\Http\Controllers\ComentariosController::class, 'create'])->name('comentarios.create');
    Route::post('/admin/comentarios/store', [App\Http\Controllers\ComentariosController::class, 'store'])->name('comentarios.store');
    Route::get('/admin/comentarios/edit/{id}', [App\Http\Controllers\ComentariosController::class, 'edit'])->name('comentarios.edit');
    Route::patch('/admin/comentarios/update/{id}', [App\Http\Controllers\ComentariosController::class, 'update'])->name('comentarios.update');

    // =============== M O D U L O   R E P O R T E S ===============================
    Route::get('/admin/reporte/dia', [App\Http\Controllers\ReportesController::class, 'index_dia'])->name('reporte.index_dia');
    Route::get('/admin/reporte/semana', [App\Http\Controllers\ReportesController::class, 'index_semana'])->name('reporte.index_semana');
    Route::get('/admin/reporte/mes', [App\Http\Controllers\ReportesController::class, 'index_mes'])->name('reporte.index_mes');
    Route::get('/admin/reporte/custom', [App\Http\Controllers\ReportesController::class, 'index_custom'])->name('reporte.index_custom');
    Route::post('/admin/reporte/calculando_custom', [App\Http\Controllers\ReportesController::class, 'store_calculando_custom'])->name('reporte.store_custom');


    // =============== M O D U L O   WEB PAGE ===============================

    // Route::get('/admin/webpage', [App\Http\Controllers\WebPageController::class, 'index'])->name('webpage.index');
    Route::get('/admin/revoes', [App\Http\Controllers\RevoesController::class, 'index'])->name('revoes.index');
    Route::post('/admin/revoes/store', [App\Http\Controllers\RevoesController::class, 'store'])->name('revoes.store');
    Route::patch('/admin/revoes/update/{id}', [App\Http\Controllers\RevoesController::class, 'update'])->name('revoes.update');

    Route::get('/admin/webpage/{id}', [App\Http\Controllers\WebPageController::class, 'edit'])->name('webpage.edit');
    Route::patch('/admin/webpage/update/{id}', [App\Http\Controllers\WebPageController::class, 'update'])->name('webpage.update');
    Route::post('/admin/reality/store', [App\Http\Controllers\WebPageController::class, 'realitystore'])->name('reality.store');
    Route::patch('/admin/reality/update/{id}', [App\Http\Controllers\WebPageController::class, 'realityupdate'])->name('reality.update');

    Route::get('/admin/estandares', [App\Http\Controllers\EstandarController::class, 'index'])->name('estandares.index');
    Route::post('/admin/estandares/store', [App\Http\Controllers\EstandarController::class, 'store'])->name('estandares.store');
    Route::patch('/admin/estandares/update/{id}', [App\Http\Controllers\EstandarController::class, 'update'])->name('estandares.update');


    Route::post('/admin/reporte_email_dia/', [App\Http\Controllers\ReportesController::class, 'reporte_email_dia'])->name('reporte_email_dia.store');
    Route::post('/admin/reporte_semana/', [App\Http\Controllers\ReportesController::class, 'reporte_email_semanal'])->name('reporte_semanal.store');
    Route::post('/admin/reporte_mes/', [App\Http\Controllers\ReportesController::class, 'reporte_email_mes'])->name('reporte_mes.store');
    Route::post('/admin/reporte_custom/', [App\Http\Controllers\ReportesController::class, 'reporte_email_custom'])->name('reporte_custom.store');

 // =============== M O D U L O   WEB PAGE ===============================
    Route::get('/admin/clientes', [App\Http\Controllers\ClientsController::class, 'index_admin'])->name('clientes_admin.index');
    Route::get('admin/clientes/ajax', [App\Http\Controllers\ClientsController::class, 'getUsuarios'])->name('usuarios.json');
    Route::patch('/admin/clientes/documentos/{id}', [App\Http\Controllers\ClientsController::class, 'update_documentos'])->name('clientes.update_documentos');
    Route::post('clientes-import', [App\Http\Controllers\ClientsController::class, 'import_clientes'])->name('clientes.import');
    Route::post('/admin/clientes/documentos/estandar/{id}', [App\Http\Controllers\ClientsController::class, 'documentos_estandares'])->name('documentos.store');
    Route::get('documentos/descargar/{id}/{cliente_id}', [App\Http\Controllers\ClientsController::class, 'descargarDocumento'])->name('descargar_documento');
    Route::get('/admin/facturas', [App\Http\Controllers\FacturasController::class, 'index'])->name('facturas.index');
    Route::patch('/admin/facturas/update/{id}', [App\Http\Controllers\FacturasController::class, 'update'])->name('facturas.update');

    // =============== M O D U L O   Cupones ===============================
    Route::get('/admin/marketing/cupones', [App\Http\Controllers\MarketingController::class, 'index_cupon'])->name('cupones.index');
    Route::post('/admin/marketing/cupones/store', [App\Http\Controllers\MarketingController::class, 'store_cupon'])->name('cupones.store');
    Route::patch('/admin/marketing/cupones/update/{id}', [App\Http\Controllers\MarketingController::class, 'update_cupon'])->name('cupones.update');

    // =============== M O D U L O   C A R P E T A S ===============================
    Route::get('/admin/carpetas', [App\Http\Controllers\CarpetasController::class, 'index'])->name('carpetas.index');
    Route::post('/admin/carpetas/store', [App\Http\Controllers\CarpetasController::class, 'store'])->name('carpetas.store');
    Route::get('/admin/carpetas/edit/{id}', [App\Http\Controllers\CarpetasController::class, 'edit'])->name('carpetas.edit');
    Route::patch('/admin/carpetas/update/{id}', [App\Http\Controllers\CarpetasController::class, 'update'])->name('carpetas.update');

    Route::delete('/admin/carpetas/archivos/{id}', [App\Http\Controllers\CarpetasController::class, 'destroy'])->name('carpetas.destroy');

    // =============== M O D U L O   C A R P E T A S  E S T A N D A R E S ===============================
    Route::get('/admin/carpetas/estandares', [App\Http\Controllers\CarpetasEstandaresController::class, 'index'])->name('carpetas_estandares.index');
    Route::post('/admin/carpetas/estandares/store', [App\Http\Controllers\CarpetasEstandaresController::class, 'store'])->name('carpetas_estandares.store');
    Route::get('/admin/carpetas/estandares/edit/{id}', [App\Http\Controllers\CarpetasEstandaresController::class, 'edit'])->name('carpetas_estandares.edit');
    Route::patch('/admin/carpetas/estandares/update/{id}', [App\Http\Controllers\CarpetasEstandaresController::class, 'update'])->name('carpetas_estandares.update');

    Route::delete('/admin/carpetas/estandares/archivos/{id}', [App\Http\Controllers\CarpetasEstandaresController::class, 'destroy'])->name('carpetas_estandares.destroy');

    // =============== M O D U L O  envio ===============================
    Route::get('/admin/envios', [App\Http\Controllers\OrderController::class, 'index_envios'])->name('envios.index');
    Route::patch('/admin/envios/update/{id}', [App\Http\Controllers\OrderController::class, 'envios_update'])->name('envios.update_eestatus');

    // =============== M O D U L O   C A R P E T A S ===============================
    Route::get('/admin/publicidad', [App\Http\Controllers\PublicidadController::class, 'index'])->name('publicidad.index');
    Route::post('/admin/publicidad/store', [App\Http\Controllers\PublicidadController::class, 'store'])->name('publicidad.store');
    Route::delete('/admin/publicidad/archivos/{id}', [App\Http\Controllers\PublicidadController::class, 'destroy'])->name('publicidad.destroy');

    // =============== M O D U L O   N O T A S ===============================
    Route::get('/admin/notas/cursos', [App\Http\Controllers\NotasCursosController::class, 'index'])->name('notas_cursos.index');
    Route::post('/admin/notas/cursos/store', [App\Http\Controllers\NotasCursosController::class, 'store'])->name('notas_cursos.store');
    Route::get('/admin/notas/cursos/edit/{id}', [App\Http\Controllers\NotasCursosController::class, 'edit'])->name('notas_cursos.edit');
    Route::patch('/admin/notas/cursos/update/{id}', [App\Http\Controllers\NotasCursosController::class, 'update'])->name('notas_cursos.update');

    Route::post('/admin/notas/paquete/store', [App\Http\Controllers\NotasCursosController::class, 'store_paquete'])->name('notas_cursos.store_paquete');

    Route::get('/admin/notas/productos', [App\Http\Controllers\NotasProductosController::class, 'index'])->name('notas_productos.index');
    Route::post('/admin/notas/productos/store', [App\Http\Controllers\NotasProductosController::class, 'store'])->name('notas_productos.store');
    Route::get('/admin/notas/productos/edit/{id}', [App\Http\Controllers\NotasProductosController::class, 'edit'])->name('notas_productos.edit');
    Route::patch('/admin/notas/productos/update/{id}', [App\Http\Controllers\NotasProductosController::class, 'update'])->name('notas_productos.update');

    Route::delete('/admin/notas/productos/delete/{id}', [App\Http\Controllers\NotasProductosController::class, 'delete'])->name('notas_productos.delete');
    Route::post('/admin/productos/update/', [App\Http\Controllers\NotasProductosController::class, 'update_productos'])->name('notas_productos.productos');

    // =============== M O D U L O   C A J A ===============================
    Route::get('/admin/caja', [App\Http\Controllers\CajaController::class, 'index'])->name('caja.index');
    Route::post('/admin/caja/store', [App\Http\Controllers\CajaController::class, 'store'])->name('caja.store');
    Route::post('/caja/inicial/', [App\Http\Controllers\CajaController::class, 'caja_inicial'])->name('caja.caja_inicial');

    Route::get('/reporte/imprimir/corte', [App\Http\Controllers\CajaController::class, 'imprimir_corte'])->name('caja.print_corte');

     // =============== M O D U L O   WEB PAGE ===============================
     Route::get('/admin/products', [App\Http\Controllers\ProductsController::class, 'index'])->name('products.index');
     Route::post('/admin/products/import', [App\Http\Controllers\ProductsController::class, 'import_products'])->name('products.import');
     Route::post('/admin/products/store', [App\Http\Controllers\ProductsController::class, 'store'])->name('products.store');
     Route::patch('/admin/products/update/{id}', [App\Http\Controllers\ProductsController::class, 'update'])->name('products.update');

    // =============== M O D U L O   M A N U A L ===============================
    Route::get('/admin/manual', [App\Http\Controllers\ManualController::class, 'index'])->name('manual.index');
    Route::post('/admin/manual/store', [App\Http\Controllers\ManualController::class, 'store'])->name('manual.store');
    Route::patch('/admin/manual/update/{id}', [App\Http\Controllers\ManualController::class, 'update'])->name('manual.update');

    // =============== M O D U L O  Documentos tipos ===============================
    Route::get('/admin/documentos/tipos', [App\Http\Controllers\TipodocumentosController::class, 'index'])->name('documentos.index');
    Route::post('/admin/documentos/store', [App\Http\Controllers\TipodocumentosController::class, 'store'])->name('documentos.store');
    Route::patch('/admin/documentos/update/{id}', [App\Http\Controllers\TipodocumentosController::class, 'update'])->name('documentos.update');

    Route::post('/admin/documentos/generar', [App\Http\Controllers\DocumentosController::class, 'generar'])->name('generar.documento');


    Route::get('/admin/documentos/generar', [App\Http\Controllers\DocumentosController::class, 'index'])->name('generar_documentos.index');
    Route::get('/obtener-ordenes/{usuario}', [App\Http\Controllers\DocumentosController::class, 'obtenerOrdenes']);


    // =============== M O D U L O   R E C U R S O S ===============================
    Route::get('/recursos', [App\Http\Controllers\RecursosController::class, 'index'])->name('recursos.index');
    Route::post('/recursos/create', [App\Http\Controllers\RecursosController::class, 'store'])->name('recursos.store');
    Route::patch('/recursos/update/{id}', [App\Http\Controllers\RecursosController::class, 'update'])->name('recursos.update');

});

// Rutas para el sistema de documentos
Route::group(['prefix' => 'cam', 'middleware' => 'web'], function () {
    Route::get('login', function () {
        return view('cam.auth.login');
    });

    Route::get('evaluador', function () {
        return view('cam.usuario.evaluador');
    })->name('evaluador');

    Route::get('centro', function () {
        return view('cam.usuario.centro');
    })->name('centro');

    Route::middleware(['auth'])->group(function () {
        Route::get('/expedientes', [HomeController::class, 'index_cam'])->name('cam.dashboard');
        Route::get('/expediente', [ExpedientesController::class, 'view'])->name('view.expediente');

        Route::get('/notas/index', [App\Http\Controllers\Cam\NotasCamController::class, 'index'])->name('index.notas');
        Route::get('/notas/crear', [App\Http\Controllers\Cam\NotasCamController::class, 'crear'])->name('crear.notas');

        // =============== M O D U L O   R E C U R S O S ===============================
        Route::get('/estandares/index', [App\Http\Controllers\Cam\CamEstandaresController::class, 'index'])->name('index.estandares');
        Route::post('/estandares/crear', [App\Http\Controllers\Cam\CamEstandaresController::class, 'crear'])->name('crear.estandares');
    });
});


// Route::controller(StripePaymentController::class)->group(function(){
//     Route::get('/stripe', 'stripe');
//     Route::post('stripe', 'stripePost')->name('stripe.post');
// });


