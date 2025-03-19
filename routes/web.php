<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\WebhooksController;
use App\Http\Controllers\Cam\CamExpedientesController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\RevoesController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ChatController;

use App\Http\Controllers\PruebaApiController;
use App\Http\Controllers\BreadcrumbController;
use App\Http\Controllers\WhatsAppWebhookController;

Route::get('api/preparacion', [PruebaApiController::class, 'index_preparacion'])->name('index_preparacion.api');
Route::get('envia/shipments', [ShipmentController::class, 'getShipments'])->name('shipments.index');

Route::get('/admin/productos/stock/firma/{id}', [App\Http\Controllers\BodegaPedidosController::class, 'ordenes_nas_firma'])->name('ordenes_nas.firma');
Route::patch('/admin/productos/stock/firma/update/{id}', [App\Http\Controllers\BodegaPedidosController::class, 'ordenes_nas_firma_update'])->name('ordenes_nas_update.firma');

Route::get('/cosmica/admin/productos/stock/firma/{id}', [App\Http\Controllers\BodegaPedidosController::class, 'ordenes_cosmica_firma'])->name('ordenes_cosmica.firma');
Route::patch('/cosmica/admin/productos/stock/firma/update/{id}', [App\Http\Controllers\BodegaPedidosController::class, 'ordenes_cosmica_firma_update'])->name('ordenes_cosmica_update.firma');

Route::get('/reconocimiento/workshop', [App\Http\Controllers\ClientsController::class, 'reconocimiento_webinar'])->name('reconocimiento.webinar');
Route::post('/reconocimiento/workshop/store', [App\Http\Controllers\ClientsController::class, 'reconocimiento_webinar_store'])->name('reconocimiento_store.webinar');

Route::get('/admin/scanner/notas', [App\Http\Controllers\ScannerController::class, 'scanner_notas'])->name('scanner_notas.index');
Route::post('/nota/actualizar-estatus', [App\Http\Controllers\ScannerController::class, 'actualizarEstatus'])->name('nota.actualizar_estatus');
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

Route::get('sede', function () {
    return view('emails.documento_stps');
});

Route::get('fecha_aprovada', function () {
    return view('emails.fecha_aprovada');
});


Route::get('certificado_webinar', function () {
    return view('user.certificado_webinar');
});

Route::get('folio', function () {
    return view('user.folio');
});

// =============== E C O M M E R C E C O S M I C A ===============================

Route::get('/doc/cedula', [App\Http\Controllers\NewDocumentsController::class, 'cedula'])->name('doc.cedula');
Route::get('/doc/titulo', [App\Http\Controllers\NewDocumentsController::class, 'titulo'])->name('doc.titulo');
Route::get('/doc/diploma', [App\Http\Controllers\NewDocumentsController::class, 'diploma'])->name('doc.diploma');
Route::get('/doc/credencial', [App\Http\Controllers\NewDocumentsController::class, 'credencial'])->name('doc.credencial');
Route::get('/doc/tira', [App\Http\Controllers\NewDocumentsController::class, 'tira'])->name('doc.tira');
Route::get('/doc/reconocimiento', [App\Http\Controllers\NewDocumentsController::class, 'reconocimiento'])->name('doc.reconocimiento');

// =============== E C O M M E R C E C O S M I C A ===============================
Route::get('/tienda/home', [App\Http\Controllers\EcommerceCosmikaController::class, 'home'])->name('tienda.home');
Route::get('/tienda/producto/{slug}', [App\Http\Controllers\EcommerceCosmikaController::class, 'single_product'])->name('tienda.single_product');
Route::get('/tienda/cart', [App\Http\Controllers\EcommerceCosmikaController::class, 'cart'])->name('tienda.cart');
Route::get('/tienda/categories', [App\Http\Controllers\EcommerceCosmikaController::class, 'categories'])->name('tienda.categories');
Route::get('/tienda/filter', [App\Http\Controllers\EcommerceCosmikaController::class, 'filter'])->name('tienda.filter');
Route::get('/tienda/about', [App\Http\Controllers\EcommerceCosmikaController::class, 'about'])->name('tienda.about');
Route::get('/tienda/afiliadas', [App\Http\Controllers\EcommerceCosmikaController::class, 'afiliadas'])->name('tienda.afiliadas');
Route::get('/tienda/kits', [App\Http\Controllers\EcommerceCosmikaController::class, 'kits'])->name('tienda.kits');
Route::get('/tienda/kits/{id}', [App\Http\Controllers\EcommerceCosmikaController::class, 'view_kit'])->name('tienda.view_kit');

Route::get('/tienda/productos', [App\Http\Controllers\EcommerceCosmikaController::class, 'productos'])->name('tienda.productos');
Route::get('/tienda/productos_faciales', [App\Http\Controllers\EcommerceCosmikaController::class, 'productos_faciales'])->name('tienda.productos_faciales');
Route::get('/tienda/productos_corporales', [App\Http\Controllers\EcommerceCosmikaController::class, 'productos_corporales'])->name('tienda.productos_corporales');
Route::get('/tienda/aviso_privacidad', [App\Http\Controllers\EcommerceCosmikaController::class, 'aviso'])->name('tienda.aviso');
Route::get('/tienda/terminos_y_condciones', [App\Http\Controllers\EcommerceCosmikaController::class, 'terminos'])->name('tienda.terminos');

Route::get('/tienda/buscar/productos', [App\Http\Controllers\EcommerceCosmikaController::class, 'buscar'])->name('productos.buscar');
Route::get('/tienda/busqueda', [App\Http\Controllers\EcommerceCosmikaController::class, 'buscarProductos'])->name('tienda_online.buscar');

Route::get('tienda/curso/{slug}', [App\Http\Controllers\EcommerceCosmikaController::class, 'show'])->name('cursos_cosmica.show');

// =============== E C O M M E R C E  C A J A ===============================

Route::post('/agregar-al-carrito', [App\Http\Controllers\CartController::class, 'agregar'])->name('carrito.agregar');
Route::post('/actualizar-carrito', [App\Http\Controllers\CartController::class, 'actualizar'])->name('carrito.actualizar');
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/process-payment', [App\Http\Controllers\CartController::class, 'processPayment'])->name('process-payment_cosmica');
Route::post('/cart/processPaymentMeli', [App\Http\Controllers\CartController::class, 'processPaymentMeli'])->name('processPaymentMeli');
Route::get('/cart/thankyou/{id}', [App\Http\Controllers\CartController::class, 'thankYouPage'])->name('thankyou.page');

Route::get('/cart/orders/pay', [App\Http\Controllers\CartController::class, 'pay'])->name('order_cosmica.pay');
Route::get('/cart/orders/{code}/show', [App\Http\Controllers\CartController::class, 'show'])->name('order_cosmica.show');
Route::get('/cart/count', [App\Http\Controllers\CartController::class, 'getCartCount'])->name('cart.count');
// =============== M O D U L O   F O L I O S ===============================
Route::get('/buscar/folio', [App\Http\Controllers\FoliosController::class, 'index'])->name('folio.index');
Route::get('/buscador/folio', [App\Http\Controllers\FoliosController::class, 'buscador'])->name('folio.buscador');

Route::get('/docmuento/cedula/{id}', [App\Http\Controllers\FoliosController::class, 'index_cedula'])->name('folio.index_cedula');
Route::get('/docmuento/titulo/{id}', [App\Http\Controllers\FoliosController::class, 'index_titulo'])->name('folio.index_titulo');
Route::get('/docmuento/diploma/{id}', [App\Http\Controllers\FoliosController::class, 'index_diploma'])->name('folio.index_diploma');
Route::get('/docmuento/crednecial/{id}', [App\Http\Controllers\FoliosController::class, 'index_crednecial'])->name('folio.index_crednecial');
Route::get('/docmuento/tira/{id}', [App\Http\Controllers\FoliosController::class, 'index_tira'])->name('folio.index_tira');


// =============== M O D U L O   C A M D O C U M E N T O S D I G I T A L E S ===============================

Route::get('cam/citas/independiente/edit/{code}', [App\Http\Controllers\CamNotasController::class, 'edit_citas'])->name('edit_independiente.citas');
Route::patch('cam/citas/independiente/{id}', [App\Http\Controllers\CamNotasController::class, 'citas_independiente'])->name('independiente.citas');

Route::get('cam/contrato/independiente/edit/{code}', [App\Http\Controllers\CamNotasController::class, 'edit_contrato'])->name('edit_independiente.contrato');
Route::patch('cam/contrato/independiente/{id}', [App\Http\Controllers\CamNotasController::class, 'contrato_independiente'])->name('independiente.contrato');

Route::get('cam/carta/independiente/edit/{code}', [App\Http\Controllers\CamNotasController::class, 'edit_carta'])->name('edit_independiente.carta');
Route::patch('cam/carta/independiente/{id}', [App\Http\Controllers\CamNotasController::class, 'carta_independiente'])->name('independiente.carta');

Route::get('cam/formato/independiente/edit/{code}', [App\Http\Controllers\CamNotasController::class, 'edit_formato'])->name('edit_independiente.formato');
Route::patch('cam/formato/independiente/{id}', [App\Http\Controllers\CamNotasController::class, 'formato_independiente'])->name('independiente.formato');

Route::get('cam/programa/independiente/edit/{code}', [App\Http\Controllers\CamNotasController::class, 'edit_programa'])->name('edit_independiente.programa');
Route::patch('cam/programa/independiente/{id}', [App\Http\Controllers\CamNotasController::class, 'programa_independiente'])->name('independiente.programa');

Route::get('cam/checklist/independiente/edit/{code}', [App\Http\Controllers\CamNotasController::class, 'edit_checklist'])->name('edit_independiente.checklist');
Route::patch('cam/checklist/independiente/{id}', [App\Http\Controllers\CamNotasController::class, 'checklist_independiente'])->name('independiente.checklist');

Auth::routes();

Route::post('/votar', [App\Http\Controllers\VotosController::class, 'votar'])->name('votar');

Route::get('/', [App\Http\Controllers\HomeUsersController::class, 'index'])->name('user.home');
Route::get('terminos', [App\Http\Controllers\WebPageController::class, 'terminos'])->name('user.terminos');
Route::get('avales', [App\Http\Controllers\WebPageController::class, 'avales'])->name('user.avales');
Route::get('nuestras_instalaciones', [App\Http\Controllers\WebPageController::class, 'instalaciones'])->name('user.instalaciones');
Route::get('videos', [App\Http\Controllers\WebPageController::class, 'videos'])->name('user.videos');
Route::get('nosotros', [App\Http\Controllers\WebPageController::class, 'nosotros'])->name('user.nosotros');
Route::get('show', [App\Http\Controllers\WebPageController::class, 'reality'])->name('user.reality');
Route::get('cosmica/revista', [App\Http\Controllers\WebPageController::class, 'revista'])->name('user.revista');

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
Route::post('/paquetes/resultado6', [App\Http\Controllers\OrderController::class, 'resultado'])->name('carrito.resultado6');
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
Route::patch('/perfil/certificaion/update/{code}', [App\Http\Controllers\ClientsController::class, 'update_certificaion'])->name('perfil.update_certificaion');
Route::patch('/perfil/formulario/{code}', [App\Http\Controllers\ClientsController::class, 'formulario'])->name('perfil.formulario');
Route::get('/admin/certificaciones/webinar/', [App\Http\Controllers\ClientsController::class, 'index_certificados_webinar'])->name('index.certificados_wbinar');

Route::patch('/perfil/update/{code}', [App\Http\Controllers\ClientsController::class, 'update'])->name('perfil.update');
Route::match(['post', 'patch'],'clientes/documentos/{id}', [App\Http\Controllers\ClientsController::class, 'update_documentos_cliente'])->name('clientes.update_documentos_cliente');
Route::post('clientes/documentos/estandar/{id}', [App\Http\Controllers\ClientsController::class, 'documentos_estandares_cliente'])->name('documentos.store_cliente');
Route::patch('admin/perfil/{id}', [App\Http\Controllers\ClientsController::class, 'update_situacionfiscal'])->name('perfil.update_situacionfiscal');
Route::post('/admin/factura/store', [App\Http\Controllers\ClientsController::class, 'store_factura'])->name('factura.store');

Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::post('custom-cam', [App\Http\Controllers\CustomAuthController::class, 'customcam'])->name('login_cam.custom');

Route::post('custom-registration', [App\Http\Controllers\CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [App\Http\Controllers\CustomAuthController::class, 'signOut'])->name('signout');


Route::get('certificacion', [App\Http\Controllers\ClientsController::class, 'certificaion'])->name('nuevo.certificaion');
Route::post('certificacion/store', [App\Http\Controllers\ClientsController::class, 'store_certificaion'])->name('certificaion.store');

Route::post('/eliminar-documento/{documento}', [App\Http\Controllers\ClientsController::class, 'eliminarDocumento'])->name('eliminar.documento');
Route::post('/eliminar-documento/{id}/{tipo}', [App\Http\Controllers\ClientsController::class, 'eliminarDocumentoPer'])->name('eliminar.documentoper');

Route::patch('/perfil/estatus/certificaion/{id}', [App\Http\Controllers\ClientsController::class, 'estatus_update_certificaion'])->name('estatus_update.certificaion');

// =============== M O D U L O   C U R S O ===============================
Route::get('/nota/curso', [App\Http\Controllers\NotasCursosController::class, 'index_user'])->name('notas.index_user');

// =============== M O D U L O   R E G I S T R O   C O M P R A S ===============================
Route::get('registro/compras/registrar', [App\Http\Controllers\RegistroComprasController::class, 'create'])->name('registro_compras.create');
Route::post('registro/compras/store', [App\Http\Controllers\RegistroComprasController::class, 'store'])->name('registro_compras.store');

// =============== M O D U L O   R E G I S T R O   B I E N V E N I D A ===============================
Route::get('registro/bienvenida/registrarse', [App\Http\Controllers\RegistroLlegadaController::class, 'create'])->name('registro_llegada.create');
Route::post('registro/bienvenida/store', [App\Http\Controllers\RegistroLlegadaController::class, 'store'])->name('registro_llegada.store');

// =============== M O D U L O   T E R M I N O S ===============================
Route::post('terminos/store', [App\Http\Controllers\TerminosController::class, 'store'])->name('terminos.store');

// =============== M O D U L O   C O N T R A T O S ===============================
Route::get('registro/imnas/reporte', [App\Http\Controllers\RegistroIMNASController::class, 'reporte'])->name('registro_imnas.reporte');
Route::get('registro/imnas/reporte/buscador', [App\Http\Controllers\RegistroIMNASController::class, 'buscador'])->name('registro_imnas.buscador');
Route::post('registro/imnas/reporte/pdf', [App\Http\Controllers\RegistroIMNASController::class, 'reporte_pdf'])->name('registro_imnas.pdf');

Route::get('/contrato/imnas/{code}', [App\Http\Controllers\RegistroIMNASController::class, 'contrato'])->name('contrato.edit');
Route::get('/contrato/afiliacion/{code}', [App\Http\Controllers\RegistroIMNASController::class, 'contrato_afiliacion'])->name('contrato_afiliacion.edit');

Route::patch('/registro/firma/contrato/{id}', [App\Http\Controllers\RegistroIMNASController::class, 'update_contrato'])->name('update_contrato.imnas');
Route::patch('/contrato/imnas/update/{id}', [App\Http\Controllers\RegistroIMNASController::class, 'contrato_update'])->name('contrato.update');

Route::post('registro/actualizar-estatus', [App\Http\Controllers\RegistroIMNASController::class, 'actualizarEstatus'])->name('actualizar.estatus');
Route::post('registro/actualizar-estatus/envio', [App\Http\Controllers\RegistroIMNASController::class, 'actualizarEstatusEnvio'])->name('actualizar.estatus_envio');

Route::group(['middleware' => ['auth']], function() {

    // =============== M O D U L O   C O M I S I O N E S ===============================
    Route::get('/admin/comision/kit/imprimir/{id}', [App\Http\Controllers\UserController::class, 'imprimir'])->name('comision_kit.imprimir');

    // =============== M O D U L O  L A B O R A T I O S ===============================

    Route::get('/laboratorio/nas', [App\Http\Controllers\LaboratoriosController::class, 'index_nas'])->name('laboratorio.nas');
    Route::get('/cosmica/laboratorio', [App\Http\Controllers\LaboratoriosController::class, 'index_cosmica'])->name('laboratorio.cosmica');
    Route::get('/laboratorio/nas/prodcutos', [App\Http\Controllers\LaboratoriosController::class, 'index_productos_nas'])->name('laboratorio_producto.nas');
    Route::get('/laboratorio/products/{id}/stock-history', [App\Http\Controllers\LaboratoriosController::class, 'getStockHistoryCosmica'])->name('products.stockHistoryCosmica');
    Route::get('/laboratorio/products/nas/{id}/stock-history', [App\Http\Controllers\LaboratoriosController::class, 'getStockHistoryNas'])->name('products.getStockHistoryNas');

    Route::get('/admin/ordenes/autorizados/{id}', [App\Http\Controllers\LaboratoriosController::class, 'show'])->name('productos_autorizado.show');
    Route::get('/cosmica/admin/ordenes/autorizados/{id}', [App\Http\Controllers\LaboratoriosController::class, 'show_cosmica'])->name('productos_autorizado.show_cosmica');

    Route::patch('/admin/ordenes/update/{id}', [App\Http\Controllers\LaboratoriosController::class, 'ordenes_lab_orden_update'])->name('ordenes_lab_update.update');
    Route::patch('/cosmica/admin/ordenes/update/{id}', [App\Http\Controllers\LaboratoriosController::class, 'cosmica_ordenes_lab_orden_update'])->name('cosmica_ordenes_lab_update.update');

    Route::get('/cosmica/laboratorio/prodcutos', [App\Http\Controllers\LaboratoriosController::class, 'index_productos_cosmica'])->name('laboratorio_producto.cosmica');

    Route::patch('/admin/ordenes/finalizar/update/{id}', [App\Http\Controllers\LaboratoriosController::class, 'ordenes_lab_orden_finalizar_update'])->name('ordenes_lab_update_finalizar.update');

    Route::get('/cosmica/cajas/stock/pdf', [App\Http\Controllers\LaboratoriosController::class, 'pdf_cajas'])->name('cajas.pdf');
    // =============== M O D U L O  V E R I  F I C A R T R A N S F E R E N C I A S ===============================
    Route::get('/admin/comprobar_transferenciass', [App\Http\Controllers\VerificarTransferenciasController::class, 'index'])->name('trasnferencias.index');
    Route::post('/admin/comprobar_transferencias/verificar', [App\Http\Controllers\VerificarTransferenciasController::class, 'store'])->name('trasnferencias.store');


    // =============== M O D U L O   P A Q U E T E S ===============================
    Route::get('/admin/paquetes', [App\Http\Controllers\PaquetesController::class, 'index'])->name('paquetes.index');
    Route::patch('/admin/paquetes/update/{id}', [App\Http\Controllers\PaquetesController::class, 'update'])->name('paquetes.update');

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
    Route::patch('/admin/users/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    // =============== M O D U L O   C U R S O S ===============================
    Route::get('/admin/cursos', [App\Http\Controllers\CursosController::class, 'index'])->name('cursos.index');
    Route::get('/admin/cursos/dia', [App\Http\Controllers\CursosController::class, 'index_dia'])->name('cursos.index_dia');
    Route::get('/admin/cursos/mes', [App\Http\Controllers\CursosController::class, 'index_mes'])->name('cursos.index_mes');
    Route::get('/admin/cursos/mes/filtro', [App\Http\Controllers\CursosController::class, 'filtro'])->name('cursos.filtro');
    Route::get('/admin/cursos/create', [App\Http\Controllers\CursosController::class, 'create'])->name('cursos.create');
    Route::post('/admin/cursos/store', [App\Http\Controllers\CursosController::class, 'store'])->name('cursos.store');
    Route::get('/admin/cursos/edit/{id}', [App\Http\Controllers\CursosController::class, 'edit'])->name('cursos.edit');
    Route::patch('/admin/cursos/update/{id}', [App\Http\Controllers\CursosController::class, 'update'])->name('cursos.update');
    Route::patch('/admin/cursos/update/guia/{id}', [App\Http\Controllers\CursosController::class, 'update_guia'])->name('cursos.update_guia');
    Route::patch('/admin/cursos/link_meet/{id}', [App\Http\Controllers\CursosController::class, 'update_meet'])->name('cursos.update_meet');
    Route::patch('/admin/cursos/material_clase/{id}', [App\Http\Controllers\CursosController::class, 'update_materialclase'])->name('cursos.material_clase');
    Route::delete('/admin/cursos/delete/{id}', [App\Http\Controllers\CursosController::class, 'destroy'])->name('cursos.destroy');
    Route::get('/admin/cursos/listas/{id}', [App\Http\Controllers\CursosController::class, 'listas'])->name('cursos.listas');
    Route::patch('/admin/cursos/estatus/doc/{id}', [App\Http\Controllers\CursosController::class, 'estatus_doc'])->name('cambiar.estatus_doc');
    Route::post('/admin/cursos/correo/{id}', [App\Http\Controllers\CursosController::class, 'correo'])->name('cursos.correo');

    Route::post('/admin/cursos/recordatorios/store', [App\Http\Controllers\CursosController::class, 'recordatorios_store'])->name('recordatorio.store');

    Route::post('/cursos/{id}/duplicar', [App\Http\Controllers\CursosController::class, 'duplicar'])->name('cursos.duplicar');
    Route::post('/cursos/inscripcion/masiva', [App\Http\Controllers\CursosController::class, 'inscribirUsuarios'])->name('masiva.inscripcion');
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
    Route::get('/admin/pagos-por-fuera/create', [App\Http\Controllers\PagosFueraController::class, 'create'])->name('pagos.create');
    Route::get('/admin/pagos-por-fuera/deudores', [App\Http\Controllers\PagosFueraController::class, 'deudores'])->name('pagos.deudores');

    // =============== M O D U L O   O R D E N E S ===============================
    Route::post('/clientes/curso/create', [App\Http\Controllers\OrderController::class, 'pay_externo'])->name('orden.pay_externo');


    // =============== M O D U L O   I N S C R I P C I O N E S ===============================
    Route::get('/admin/pagos', [App\Http\Controllers\PagosFueraController::class, 'index_pago'])->name('pagos.index_pago');
    Route::get('/admin/pagos/edit/{id}', [App\Http\Controllers\PagosFueraController::class, 'edit_pago'])->name('pagos.edit_pago');
    Route::patch('/admin/pagos/update/{id}', [App\Http\Controllers\PagosFueraController::class, 'update_pago'])->name('pagos.update_pago');
    Route::get('/admin/pagos/pendiente', [App\Http\Controllers\PagosFueraController::class, 'index_pago_pendiente'])->name('pagos.index_pago_pendiente');

    Route::get('/admin/pagos/mercado', [App\Http\Controllers\PagosFueraController::class, 'mercado_pago'])->name('mercado.pago');
    Route::get('/admin/pagos/mercado/recibo/{id}', [App\Http\Controllers\PagosFueraController::class, 'mercado_pago_recibo'])->name('mercado.pago_recibo');

    Route::patch('/cursos/cambio/{id}', [App\Http\Controllers\PagosFueraController::class, 'cambio'])->name('cursos.cambio');
    Route::get('/admin/pagos/edit/cambio/{id}',  [App\Http\Controllers\PagosFueraController::class, 'getTicketsByCurso']);

    Route::get('/admin/pagos/mercadopago', [App\Http\Controllers\PagosFueraController::class, 'index_mp'])->name('pagos.mp');

    Route::get('/admin/comprobante/tiendita/{id}', [App\Http\Controllers\PagosFueraController::class, 'comprobante_tiendita'])->name('comprobante.tiendita');
    /*|--------------------------------------------------------------------------
    |Configuracion
    |--------------------------------------------------------------------------*/
    Route::get('/configuracion', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('index.configuracion');
    Route::patch('/configuracion/update', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('update.configuracion');
    Route::get('/descargar-db', [App\Http\Controllers\DatabaseController::class, 'descargarBaseDeDatos'])->name('descargar.db');

    // =============== M O D U L O   C O M E N T A R I O S ===============================
    Route::get('/admin/comentarios', [App\Http\Controllers\ComentariosController::class, 'index'])->name('comentarios.index');
    Route::get('/admin/comentarios/create', [App\Http\Controllers\ComentariosController::class, 'create'])->name('comentarios.create');
    Route::post('/admin/comentarios/store', [App\Http\Controllers\ComentariosController::class, 'store'])->name('comentarios.store');
    Route::get('/admin/comentarios/edit/{id}', [App\Http\Controllers\ComentariosController::class, 'edit'])->name('comentarios.edit');
    Route::patch('/admin/comentarios/update/{id}', [App\Http\Controllers\ComentariosController::class, 'update'])->name('comentarios.update');

    // =============== M O D U L O   N o t i c i a s===============================
    Route::get('/admin/noticias', [App\Http\Controllers\NoticiasController::class, 'index'])->name('noticias.index');
    Route::get('/admin/noticias/create', [App\Http\Controllers\NoticiasController::class, 'create'])->name('noticias.create');
    Route::post('/admin/noticias/store', [App\Http\Controllers\NoticiasController::class, 'store'])->name('noticias.store');
    Route::get('/admin/noticias/edit/{id}', [App\Http\Controllers\NoticiasController::class, 'edit'])->name('noticias.edit');
    Route::patch('/admin/noticias/update/{id}', [App\Http\Controllers\NoticiasController::class, 'update'])->name('noticias.update');

    // =============== M O D U L O   R E P O R T E S ===============================
    Route::get('/admin/reporte/dia', [App\Http\Controllers\ReportesController::class, 'index_dia'])->name('reporte.index_dia');
    Route::get('/admin/reporte/semana', [App\Http\Controllers\ReportesController::class, 'index_semana'])->name('reporte.index_semana');
    Route::get('/admin/reporte/mes', [App\Http\Controllers\ReportesController::class, 'index_mes'])->name('reporte.index_mes');
    Route::get('/admin/reporte/custom', [App\Http\Controllers\ReportesController::class, 'index_custom'])->name('reporte.index_custom');
    Route::post('/admin/reporte/calculando_custom', [App\Http\Controllers\ReportesController::class, 'store_calculando_custom'])->name('reporte.store_custom');

    // =============== M O D U L O   R E P O R T E  C U R S O S ===============================

    Route::get('/admin/reporte/cursos', [App\Http\Controllers\ReportesController::class, 'index_cursos'])->name('reporte.index_cursos');
    Route::post('/admin/reporte/cursos_custom', [App\Http\Controllers\ReportesController::class, 'store_cursos_custom'])->name('cursos_reporte.store_custom');
    Route::post('/generar-reporte-pdf', [App\Http\Controllers\ReportesController::class, 'generarReportePDF'])->name('reporte.generarPDF');

    Route::get('pdf/anual/generar-reporte-pdf', [App\Http\Controllers\ReportesController::class, 'pdf_anual'])->name('reporte.pdf_anual');
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
    Route::get('/buscador/index/cliente', [App\Http\Controllers\ClientsController::class, 'buscador'])->name('advance_search.buscador');
    Route::get('admin/clientes/ajax', [App\Http\Controllers\ClientsController::class, 'getUsuarios'])->name('usuarios.json');
    Route::patch('/admin/clientes/documentos/{id}', [App\Http\Controllers\ClientsController::class, 'update_documentos'])->name('clientes.update_documentos');
    Route::post('clientes-import', [App\Http\Controllers\ClientsController::class, 'import_clientes'])->name('clientes.import');
    Route::post('/admin/clientes/documentos/estandar/{id}', [App\Http\Controllers\ClientsController::class, 'documentos_estandares'])->name('documentos.store');
    Route::get('documentos/descargar/{id}/{cliente_id}', [App\Http\Controllers\ClientsController::class, 'descargarDocumento'])->name('descargar_documento');
    Route::get('/admin/facturas', [App\Http\Controllers\FacturasController::class, 'index'])->name('facturas.index');
    Route::patch('/admin/facturas/update/{id}', [App\Http\Controllers\FacturasController::class, 'update'])->name('facturas.update');

    Route::post('/admin/borrar/usuarios', [App\Http\Controllers\ClientsController::class, 'destroy'])->name('usuarios.destroy');

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

    // =============== M O D U L O   TRAER PEDIDOS DE WOOCOMERCE ===============================
    Route::get('/admin/pedidos/woo', [App\Http\Controllers\PedidosWooController::class, 'index'])->name('pedidos_woo.index');
    Route::put('orders/update-status/{id}', [App\Http\Controllers\PedidosWooController::class, 'updateStatuWoo'])->name('orders.updateStatuWoo');

    Route::get('cosmica/admin/pedidos/cosmika/woo', [App\Http\Controllers\PedidosWooController::class, 'index_cosmika'])->name('pedidos_cosmica_woo.index');
    Route::put('cosmica/orders/update-status/{id}', [App\Http\Controllers\PedidosWooController::class, 'updateStatuWooCosmika'])->name('orders.updateStatuWooCosmika');

    // =============== M O D U L O  E C O M M E R C E ===============================
    Route::get('cosmica/admin/pedidos/cosmika/ecommerce', [App\Http\Controllers\PedidosWooController::class, 'index_cosmika_ecommerce_apro'])->name('pedidos_cosmica_ecommerce.index');
    Route::get('cosmica/admin/pedidos/cosmika/ecommerce/pendientes', [App\Http\Controllers\PedidosWooController::class, 'index_cosmika_ecommerce_pen'])->name('pedidos_cosmica_ecommerce.index_pen');
    Route::get('cosmica/admin/pedidos/cosmika/ecommerce/preparacion', [App\Http\Controllers\PedidosWooController::class, 'index_cosmika_ecommerce_preparacion'])->name('pedidos_cosmica_ecommerce.index_preparacion');
    Route::get('cosmica/admin/pedidos/cosmika/imprimir/{id}', [App\Http\Controllers\PedidosWooController::class, 'imprimir_cosmica'])->name('pedidos_cosmica.imprimir');
    Route::patch('cosmica/admin/pedidos/cosmika/guia/{id}', [App\Http\Controllers\PedidosWooController::class, 'update_guia_ecommerce'])->name('notas_cosmica.update_guia_ecommerce');
    Route::get('cosmica/admin/bodega/preparacion/scaner/{id}', [App\Http\Controllers\PedidosWooController::class, 'preparacion_scaner'])->name('preparacion_scaner.bodega_cosmica');
    Route::patch('cosmica/admin/bodega/estatus/{id}', [App\Http\Controllers\PedidosWooController::class, 'update_estatus'])->name('ecommerce_cosmica.update_estatus');
    Route::post('cosmica/admin/bodega/check-product', [App\Http\Controllers\PedidosWooController::class, 'checkProduct'])->name('check_cosmica_eco.product');
    // =============== M O D U L O   N O T A S ===============================
    Route::get('/admin/notas/cursos', [App\Http\Controllers\NotasCursosController::class, 'index'])->name('notas_cursos.index');
    Route::get('/admin/notas/cursos/crear', [App\Http\Controllers\NotasCursosController::class, 'create'])->name('notas_cursos.crear');
    Route::post('/admin/notas/cursos/store', [App\Http\Controllers\NotasCursosController::class, 'store'])->name('notas_cursos.store');
    Route::get('/admin/notas/cursos/edit/{id}', [App\Http\Controllers\NotasCursosController::class, 'edit'])->name('notas_cursos.edit');
    Route::patch('/admin/notas/cursos/update/{id}', [App\Http\Controllers\NotasCursosController::class, 'update'])->name('notas_cursos.update');
    Route::get('/admin/notas/cursos/imprimir/{id}', [App\Http\Controllers\NotasCursosController::class, 'imprimir'])->name('notas_cursos.imprimir');
    Route::get('/admin/notas/cursos/imprimir/canceladas/{id}', [App\Http\Controllers\NotasCursosController::class, 'imprimir_canceladas'])->name('notas_cursos.imprimir_canceladas');
    Route::post('/admin/notas/paquete/store', [App\Http\Controllers\NotasCursosController::class, 'store_paquete'])->name('notas_cursos.store_paquete');

    Route::get('/admin/listas/comprobante/mp/{id}', [App\Http\Controllers\CursosController::class, 'imprimir_mp'])->name('lista.imprimir_mp');

    Route::get('/admin/notas/productos', [App\Http\Controllers\NotasProductosController::class, 'index'])->name('notas_productos.index');
    Route::get('/admin/notas/ventas/get-descuento/{id}', [App\Http\Controllers\NotasProductosController::class, 'ventas_cliente']);
    Route::get('/admin/productos/create', [App\Http\Controllers\NotasProductosController::class, 'create'])->name('notas_productos.create');
    Route::post('/admin/notas/productos/store', [App\Http\Controllers\NotasProductosController::class, 'store'])->name('notas_productos.store');
    Route::get('/admin/notas/productos/edit/{id}', [App\Http\Controllers\NotasProductosController::class, 'edit'])->name('notas_productos.edit');
    Route::patch('/admin/notas/productos/update/{id}', [App\Http\Controllers\NotasProductosController::class, 'update'])->name('notas_productos.update');
    Route::get('/admin/notas/productos/buscador', [App\Http\Controllers\NotasProductosController::class, 'buscador'])->name('advance_productos.buscador');
    Route::patch('/admin/notas/productos/update/estatus/{id}', [App\Http\Controllers\NotasProductosController::class, 'update_estatus'])->name('notas_productos.update_estatus');

    Route::delete('/admin/notas/productos/delete/{id}', [App\Http\Controllers\NotasProductosController::class, 'delete'])->name('notas_productos.delete');
    Route::post('/admin/productos/update/', [App\Http\Controllers\NotasProductosController::class, 'update_productos'])->name('notas_productos.productos');

    Route::get('/admin/notas/productos/imprimir/{id}', [App\Http\Controllers\NotasProductosController::class, 'imprimir'])->name('notas_productos.imprimir');
    Route::delete('/notas/{id}', [App\Http\Controllers\NotasProductosController::class, 'eliminar'])->name('notas.eliminar');

    Route::get('/admin/notas/cotizacion', [App\Http\Controllers\CotizacionController::class, 'index'])->name('notas_cotizacion.index');
    Route::get('/admin/notas/cotizacion/aprobada', [App\Http\Controllers\CotizacionController::class, 'index_aprobada'])->name('notas_cotizacion.index_aprobada');
    Route::get('/admin/notas/cotizacion/cancelada', [App\Http\Controllers\CotizacionController::class, 'index_cancelada'])->name('notas_cotizacion.index_cancelada');

    Route::get('/admin/cotizacion/create', [App\Http\Controllers\CotizacionController::class, 'create'])->name('notas_cotizacion.create');
    Route::post('/admin/notas/cotizacion/store', [App\Http\Controllers\CotizacionController::class, 'store'])->name('notas_cotizacion.store');
    Route::patch('/admin/notas/cotizacion/estatus/{id}', [App\Http\Controllers\CotizacionController::class, 'update_estatus'])->name('notas_cotizacion.update_estatus');
    Route::get('/admin/notas/cotizacion/edit/{id}', [App\Http\Controllers\CotizacionController::class, 'edit'])->name('notas_cotizacion.edit');
    Route::patch('/admin/notas/cotizacion/update/{id}', [App\Http\Controllers\CotizacionController::class, 'update'])->name('notas_cotizacion.update');
    Route::get('/admin/notas/cotizacion/buscador', [App\Http\Controllers\CotizacionController::class, 'buscador'])->name('advance_cotizacion_productos.buscador');

    Route::delete('/admin/notas/cotizacion/delete/{id}', [App\Http\Controllers\CotizacionController::class, 'delete'])->name('notas_cotizacion.delete');
    Route::post('/admin/cotizacion/update/', [App\Http\Controllers\CotizacionController::class, 'update_cotizacion'])->name('notas_cotizacion.cotizacion');

    Route::get('/admin/notas/cotizacion/imprimir/{id}', [App\Http\Controllers\CotizacionController::class, 'imprimir'])->name('notas_cotizacion.imprimir');
    Route::delete('/notas/cotizacion/{id}', [App\Http\Controllers\CotizacionController::class, 'eliminar'])->name('notas_cotizacion.eliminar');
    Route::get('/admin/notas/cotizacion/reporte', [App\Http\Controllers\CotizacionController::class, 'imprimir_reporte'])->name('notas_cotizacion.imprimir_reporte');

    Route::get('/admin/notas/cotizacion/ecommerce/imprimir/{id}', [App\Http\Controllers\CotizacionController::class, 'imprimir_ecommerce'])->name('notas_cotizacion.imprimir_ecommerce');
    // =============== M O D U L O   C A J A ===============================
    Route::get('/admin/caja', [App\Http\Controllers\CajaController::class, 'index'])->name('caja.index');
    Route::post('/admin/caja/store', [App\Http\Controllers\CajaController::class, 'store'])->name('caja.store');
    Route::post('/caja/inicial/', [App\Http\Controllers\CajaController::class, 'caja_inicial'])->name('caja.caja_inicial');

    Route::get('/reporte/imprimir/corte', [App\Http\Controllers\CajaController::class, 'imprimir_corte'])->name('caja.print_corte');

     // =============== M O D U L O   WEB PAGE ===============================
     Route::get('/admin/products', [App\Http\Controllers\ProductsController::class, 'index'])->name('products.index');
     Route::get('/admin/products/bundle', [App\Http\Controllers\ProductsController::class, 'index_bundle'])->name('bundle.index');
     Route::patch('admin/products/update-estatus/{id}', [App\Http\Controllers\ProductsController::class, 'update_estatus'])->name('products.update_estatus');
     Route::get('/admin/products/create/bundle', [App\Http\Controllers\ProductsController::class, 'create_bundle'])->name('bundle.create');
     Route::post('/admin/products/store/bundle', [App\Http\Controllers\ProductsController::class, 'store_bundle'])->name('bundle.store');
     Route::get('/admin/products/bundle/edit/{id}', [App\Http\Controllers\ProductsController::class, 'edit_bundle'])->name('bundle.edit');
     Route::patch('/admin/products/bundle/update/{id}', [App\Http\Controllers\ProductsController::class, 'update_bundle'])->name('bundle.update');

     Route::post('/admin/products/import', [App\Http\Controllers\ProductsController::class, 'import_products'])->name('products.import');
     Route::post('/admin/products/store', [App\Http\Controllers\ProductsController::class, 'store'])->name('products.store');
     Route::patch('/admin/products/update/{id}', [App\Http\Controllers\ProductsController::class, 'update'])->name('products.update');
     Route::patch('/admin/products/ocultar/{id}', [App\Http\Controllers\ProductsController::class, 'update_ocultar'])->name('products.update_ocultar');
     Route::get('/products/{id}/stock-history', [App\Http\Controllers\ProductsController::class, 'getStockHistory'])->name('products.stockHistory');

     Route::get('/admin/products/historial', [App\Http\Controllers\ProductsController::class, 'productsHistorialVendidos'])->name('productsHistorialVendidos.index');
     Route::get('/admin/products/historial/filtro', [App\Http\Controllers\ProductsController::class, 'filtro'])->name('products_historial.filtro');
     Route::get('/admin/products/historial/pdf', [App\Http\Controllers\ProductsController::class, 'historial_pdf'])->name('products_historial.pdf');

     Route::post('/products/generate-barcodes', [App\Http\Controllers\ProductsController::class, 'generateBarcodes'])->name('generateBarcodes');
     Route::get('/admin/products/faltantes/pdf', [App\Http\Controllers\ProductsController::class, 'producto_pdf'])->name('producto_pdf.pdf');
    // =============== M O D U L O   S C A N N E R ===============================

     Route::get('/admin/scanner', [App\Http\Controllers\ScannerController::class, 'index'])->name('scanner.index');
     Route::get('/admin/scanner/buscador', [App\Http\Controllers\ScannerController::class, 'buscador_ajax'])->name('scanner.buscador');
     Route::get('/admin/scanner/buscador/palabra', [App\Http\Controllers\ScannerController::class, 'buscador_ajax_palabra'])->name('scanner.buscador_palabra');

     Route::get('/admin/products/{id}', [App\Http\Controllers\ProductsController::class, 'show'])->name('products.show');

     Route::get('/cosmica/admin/products/{id}', [App\Http\Controllers\LaboratoriosController::class, 'show_products_cosmica'])->name('cosmica_products.show');
     Route::get('/nas/admin/products/{id}', [App\Http\Controllers\LaboratoriosController::class, 'show_products_nas'])->name('nas_products.show');

     Route::post('/products/generate-skus', [App\Http\Controllers\ProductsController::class, 'generateSKUs'])->name('products.generateSkus');
     Route::get('/generate-pdf-all-products', [App\Http\Controllers\ProductsController::class, 'generateAllProductsPDF'])->name('products.generateAllPDF');

     Route::get('/admin/scanner/estatus', [App\Http\Controllers\ScannerController::class, 'esatus_nota'])->name('scanner.esatus_nota');
    // =============== M O D U L O   M A N U A L ===============================
    Route::get('/admin/manual', [App\Http\Controllers\ManualController::class, 'index'])->name('manual.index');
    Route::post('/admin/manual/store', [App\Http\Controllers\ManualController::class, 'store'])->name('manual.store');
    Route::patch('/admin/manual/update/{id}', [App\Http\Controllers\ManualController::class, 'update'])->name('manual.update');

    // =============== M O D U L O  Documentos tipos ===============================
    Route::get('/admin/documentos/tipos', [App\Http\Controllers\TipodocumentosController::class, 'index'])->name('documentos.index');
    Route::get('/buscador/index/documentos', [App\Http\Controllers\DocumentosController::class, 'buscador'])->name('advance_documentos.buscador');
    Route::post('/admin/documentos/store', [App\Http\Controllers\TipodocumentosController::class, 'store'])->name('documentos.store');
    Route::patch('/admin/documentos/update/{id}', [App\Http\Controllers\TipodocumentosController::class, 'update'])->name('documentos.update');

    Route::post('/admin/documentos/generar', [App\Http\Controllers\DocumentosController::class, 'generar'])->name('generar.documento');
    Route::post('/admin/documentos/enviar_generar', [App\Http\Controllers\DocumentosController::class, 'generar_enviar'])->name('generar_enviar.documento');
    Route::patch('/admin/documentos/bitacora/{id}', [App\Http\Controllers\DocumentosController::class, 'bitacora_documentos_estatus'])->name('bitacora_documentos.update');

    Route::post('/documentos/generar/alumno', [App\Http\Controllers\DocumentosController::class, 'generar_alumno'])->name('generar_alumno.documento');
    Route::post('/documentos/generar/dc_3', [App\Http\Controllers\DocumentosController::class, 'generar_alumno_dc'])->name('generar_alumno_dc.documento');


    Route::get('/admin/doc/generar', [App\Http\Controllers\DocumentosController::class, 'index'])->name('generar_documentos.index');
    Route::get('/obtener-ordenes/{usuario}', [App\Http\Controllers\DocumentosController::class, 'obtenerOrdenes']);

    Route::get('/getCursos/{id}', [App\Http\Controllers\DocumentosController::class, 'getCursos']);


    Route::get('/admin/documentos/faltantes', [App\Http\Controllers\DocumentosController::class, 'faltantes'])->name('documentos.faltantes');

    // =============== M O D U L O   R E C U R S O S ===============================
    Route::get('/recursos', [App\Http\Controllers\RecursosController::class, 'index'])->name('recursos.index');
    Route::get('/buscador/index/recursos', [App\Http\Controllers\RecursosController::class, 'buscador'])->name('advance_recursos.buscador');
    Route::post('/recursos/create', [App\Http\Controllers\RecursosController::class, 'store'])->name('recursos.store');
    Route::patch('/recursos/update/{id}', [App\Http\Controllers\RecursosController::class, 'update'])->name('recursos.update');

    // =============== M O D U L O   N O T A ===============================
    Route::get('/notas/cam', [App\Http\Controllers\NotasCamController::class, 'index'])->name('notascam.index');
    Route::get('/notas/cam/buscador/', [App\Http\Controllers\NotasCamController::class, 'buscador'])->name('notascam.buscador');
    Route::post('/notas/cam/store', [App\Http\Controllers\NotasCamController::class, 'store'])->name('notascam.store');
    Route::patch('/notas/cam/store/evaluador/{id}', [App\Http\Controllers\NotasCamController::class, 'store_evaluador'])->name('notascam.store_evaluador');
    Route::patch('/notas/cam/store/estatus/{id}', [App\Http\Controllers\NotasCamController::class, 'store_estatus'])->name('notascam.store_estatus');

    // =============== M O D U L O   R E G I S T R O  I M N A S ===============================
    Route::get('/registro/imnas/index', [App\Http\Controllers\RegistroIMNASController::class, 'index'])->name('index.imnas');
    Route::post('/order/pay/registro', [OrderController::class, 'pagar_registro'])->name('order.pay_registro');
    Route::get('/registro/imnas/show/{code}', [App\Http\Controllers\RegistroIMNASController::class, 'show_cliente'])->name('show_cliente.imnas');
    Route::post('/registro/imnas/generar_registro', [App\Http\Controllers\RegistroIMNASController::class, 'generar_registro'])->name('generar_registro.documento');
    Route::get('/registro/imnas/buscar/folio/{code}', [App\Http\Controllers\RegistroIMNASController::class, 'buscador_registro'])->name('folio_registro.buscador');
    Route::patch('/registro/imnas/guia/{id}', [App\Http\Controllers\RegistroIMNASController::class, 'update_guia'])->name('update_guia.imnas');

    Route::post('/registro/imnas/store', [App\Http\Controllers\RegistroIMNASController::class, 'store'])->name('registro_imnas.store');
    Route::post('/registro/imnas/update/{id}', [App\Http\Controllers\RegistroIMNASController::class, 'update_registro'])->name('update_registro.update');
    Route::get('/registro/imnas/especialidades/{id}', [App\Http\Controllers\RegistroIMNASController::class, 'show_especialidades'])->name('show_especialidades.imnas');
    Route::patch('/registro/imnas/especialidades/update/{id}', [App\Http\Controllers\RegistroIMNASController::class, 'update_especialidades'])->name('especialidades.update');

    Route::get('/registro/imnas/imprimir/{id}', [App\Http\Controllers\RegistroIMNASController::class, 'imprimir_especialidad'])->name('imprimir_especialidad.imprimir');
    Route::post('/eliminar/folio', [App\Http\Controllers\RegistroIMNASController::class, 'eliminar_folio'])->name('eliminar_folio.imnas');

    Route::get('registro/imnas/imprimir/especialidad/afi', [App\Http\Controllers\RegistroIMNASController::class, 'imprimir_especialidades_afi'])->name('imprimir.especialidades');
    // =============== M O D U L O   R E G I S T R O  I M N A S  C L I E N T E S ===============================
    Route::get('/registro/imnas/clientes/{code}', [App\Http\Controllers\RegistroIMNASController::class, 'index_clientes'])->name('clientes.imnas');
    Route::patch('/registro/imnas/subir/especialidad/{id}', [App\Http\Controllers\RegistroIMNASController::class, 'update_especialidad'])->name('update_especialidad.imnas');
    Route::patch('/registro/imnas/subir/doc/{id}', [App\Http\Controllers\RegistroIMNASController::class, 'update_clientes'])->name('update_clientes.imnas');
    Route::post('/registro/imnas/pdf/{id}', [App\Http\Controllers\RegistroIMNASController::class, 'reconoci_generarPDF'])->name('reconoci.generarPDF');
    Route::post('/registro/imnas/update/reconocimiento/{id}', [App\Http\Controllers\RegistroIMNASController::class, 'update_reconocimiento'])->name('reconocimiento.update');

    // =============== M O D U L O   R E G I S T R O   C O M P R A S ===============================

    Route::get('/meli/ventas', [App\Http\Controllers\MeliController::class, 'index'])->name('meli_ventas.index');
    Route::get('/mercado_libre_api', [App\Http\Controllers\MeliController::class, 'index_token'])->name('meli_token.index');
    Route::post('/meli/update-token', [App\Http\Controllers\MeliController::class, 'updateToken'])->name('meli.updateToken');
    Route::post('/meli/refresh-token', [App\Http\Controllers\MeliController::class, 'refreshToken'])->name('meli.refreshToken');
    Route::get('/meli/print/{shippingId}', [App\Http\Controllers\MeliController::class, 'downloadShippingLabel'])->name('meli.downloadShippingLabel');

    // =============== M O D U L O   R E G I S T R O   C O M P R A S ===============================
    Route::get('/cosmica/registro/compras', [App\Http\Controllers\RegistroComprasController::class, 'index'])->name('registro_compras.index');
    Route::get('/cosmica/registro/compras/buscador', [App\Http\Controllers\RegistroComprasController::class, 'buscador'])->name('registro_compras.buscador');


    // =============== M O D U L O   R E G I S T R O   B I E N V E N I D A ===============================
    Route::get('/cosmica/registro/llegada', [App\Http\Controllers\RegistroLlegadaController::class, 'index'])->name('registro_llegada.index');
    Route::get('/cosmica/registro/llegada/buscador', [App\Http\Controllers\RegistroLlegadaController::class, 'buscador'])->name('registro_llegada.buscador');

    // =============== M O D U L O   C O T I Z A C I O N E S   C O S M I C A ===============================
    Route::get('cosmica/cotizacion/', [App\Http\Controllers\CotizacionCosmicaController::class, 'index'])->name('cotizacion_cosmica.index');
    Route::get('cosmica/cotizacion/aprobadas', [App\Http\Controllers\CotizacionCosmicaController::class, 'index_aprobadas'])->name('cotizacion_cosmica.index_aprobadas');
    Route::get('cosmica/cotizacion/canceladas', [App\Http\Controllers\CotizacionCosmicaController::class, 'index_canceladas'])->name('cotizacion_cosmica.index_canceladas');

    Route::get('cosmica/cotizacion/buscador', [App\Http\Controllers\CotizacionCosmicaController::class, 'buscador'])->name('cotizacion_cosmica.buscador');
    Route::get('cosmica/cotizacion/create', [App\Http\Controllers\CotizacionCosmicaController::class, 'create'])->name('cotizacion_cosmica.create');
    Route::post('cosmica/cotizacion/store', [App\Http\Controllers\CotizacionCosmicaController::class, 'store'])->name('cotizacion_cosmica.store');
    Route::get('cosmica/cotizacion/edit/{id}', [App\Http\Controllers\CotizacionCosmicaController::class, 'edit'])->name('cotizacion_cosmica.edit');
    // Route::get('cosmica/cotizacion/meli/show/{id}', [App\Http\Controllers\MeliController::class, 'meli_show'])->name('cotizacion_cosmica.meli_show');
    // Route::get('cosmica/cotizacion/meli/show/{id}/{order_id}', [App\Http\Controllers\MeliController::class, 'meli_show'])->name('cotizacion_cosmica.meli_show');
    Route::get('cosmica/cotizacion/meli/show/{id}/{order_id?}', [App\Http\Controllers\MeliController::class, 'meli_show'])->name('cotizacion_cosmica.meli_show');
    Route::get('meli/show/{order_id}', [App\Http\Controllers\MeliController::class, 'meli_show_order'])->name('cotizacion_cosmica.meli_show_order');

    Route::patch('cosmica/cotizacion/update/{id}', [App\Http\Controllers\CotizacionCosmicaController::class, 'update'])->name('cotizacion_cosmica.update');
    Route::post('cosmica/cotizacion/meli/publish/{id}', [App\Http\Controllers\MeliController::class, 'publishToMeli'])->name('meli.publish');

    Route::get('cosmica/cotizacion/imprimir/{id}', [App\Http\Controllers\CotizacionCosmicaController::class, 'imprimir'])->name('cotizacion_cosmica.imprimir');
    // Route::get('nas/woo/imprimir/{id}', [App\Http\Controllers\BodegaController::class, 'imprimir'])->name('nas_woo.imprimir');
    Route::get('nas/orders/woo/pdf/{id}', [App\Http\Controllers\BodegaController::class, 'generateOrderWooNasPDF'])->name('woo_nas_orders.pdf');
    Route::get('cosmica/orders/woo/pdf/{id}', [App\Http\Controllers\BodegaController::class, 'generateOrderWooCosmicaPDF'])->name('woo_cosmica_orders.pdf');

    Route::get('/get-descuento/{id}', [App\Http\Controllers\CotizacionCosmicaController::class, 'getDescuento']);
    Route::get('cosmica/cotizacion/reporte', [App\Http\Controllers\CotizacionCosmicaController::class, 'imprimir_reporte'])->name('notas_cosmica.imprimir_reporte');
    Route::get('cotizacion_cosmica/imprimir_reporte', [App\Http\Controllers\CotizacionCosmicaController::class, 'imprimir_reporte'])->name('cotizacion_cosmica.imprimir_reporte');
    // =============== M O D U L O   c o s m i k a ===============================
    Route::get('cosmica/distribuidoras/', [App\Http\Controllers\CosmicaDistribuidoraController::class, 'index'])->name('distribuidoras.index');
    Route::post('cosmica/distribuidoras/store', [App\Http\Controllers\CosmicaDistribuidoraController::class, 'store'])->name('distribuidoras.store');
    Route::patch('cosmica/distribuidoras/update/{id}', [App\Http\Controllers\CosmicaDistribuidoraController::class, 'update'])->name('distribuidoras.update');
    Route::patch('cosmica/distribuidoras/update/ocultar/{id}', [App\Http\Controllers\CosmicaDistribuidoraController::class, 'update_ocultar'])->name('distribuidoras.update_ocultar');

    Route::patch('cosmica/distribuidoras/update/estatus/{id}', [App\Http\Controllers\CotizacionCosmicaController::class, 'update_estatus'])->name('distribuidoras.update_estatus');
    Route::patch('cosmica/distribuidoras/update/protocolo/{id}', [App\Http\Controllers\CotizacionCosmicaController::class, 'update_protocolo'])->name('distribuidoras.update_protocolo');

    Route::get('cosmica/protocolos/index', [App\Http\Controllers\CosmicaDistribuidoraController::class, 'index_protocolos'])->name('protocolos.index');

    // =============== M O D U L O   M A N U A L ===============================
    Route::get('cam/notas/', [App\Http\Controllers\CamNotasController::class, 'index'])->name('cam_users.index');
    Route::post('cam/notas/store', [App\Http\Controllers\CamNotasController::class, 'store'])->name('cam_users.store');

    // =============== M O D U L O   B O D E G A ===============================
    Route::get('bodega/preparacion/', [App\Http\Controllers\BodegaController::class, 'index_preparacion'])->name('index_preparacion.bodega');
    Route::get('bodega/preparados/', [App\Http\Controllers\BodegaController::class, 'index_preparados'])->name('index_preparados.bodega');
    Route::get('bodega/enviados/', [App\Http\Controllers\BodegaController::class, 'index_enviados'])->name('index_enviados.bodega');
    Route::get('bodega/entregados/', [App\Http\Controllers\BodegaController::class, 'index_entregados'])->name('index_entregados.bodega');
    Route::get('bodega/canceladas/', [App\Http\Controllers\BodegaController::class, 'index_canceladas'])->name('index_canceladas.bodega');

    Route::patch('bodega/preparacion/guia/{id}', [App\Http\Controllers\CotizacionController::class, 'update_guia'])->name('notas_cotizacion.update_guia');
    Route::patch('bodega/preparacion/guia/cosmica/{id}', [App\Http\Controllers\CotizacionCosmicaController::class, 'update_guia'])->name('notas_cosmica.update_guia');
    Route::put('bodega/preparacion/update_status/{id}', [App\Http\Controllers\BodegaController::class, 'update_guia_woo'])->name('bodega.update_guia_woo');
    Route::patch('bodega/preparacion/paradisus/{id}', [App\Http\Controllers\BodegaController::class, 'actualizarPedidoParadisus'])->name('actualizar.pedido.paradisus');
    Route::patch('bodega/preparacion/paradisus/repo/{id}', [App\Http\Controllers\BodegaController::class, 'actualizarPedidoParadisusrepo'])->name('actualizar.repo.paradisus');

    Route::get('/pdf_etiqueta/{tabla}/{id}', [App\Http\Controllers\BodegaController::class, 'generarEtiqueta'])->name('pdf_etiqueta.bodega');

    Route::get('cosmica/reporte/ventas/pdf', [App\Http\Controllers\BodegaController::class, 'reporte_ventas'])->name('reporte.ventas');

    Route::patch('bodega/preparacion/pago/cosmica/{id}', [App\Http\Controllers\CotizacionCosmicaController::class, 'update_pago'])->name('notas_cosmica.update_pago');

    Route::get('/admin/productos/stock', [App\Http\Controllers\BodegaPedidosController::class, 'productos_stock'])->name('productos_stock.index');
    Route::post('/admin/productos/guardar-carrito', [App\Http\Controllers\BodegaPedidosController::class, 'guardar'])->name('guardar.carrito');
    Route::get('/admin/productos/stock/show/{id}', [App\Http\Controllers\BodegaPedidosController::class, 'show'])->name('productos_stock.show');
    Route::get('/admin/productos/imprimir/{id}', [App\Http\Controllers\BodegaPedidosController::class, 'imprimir'])->name('productos_stock.imprimir');

    Route::get('/admin/productos/stock/ordenes', [App\Http\Controllers\BodegaPedidosController::class, 'ordenes_nas'])->name('ordenes_nas.index');
    Route::patch('/admin/productos/stock/orden/update/{id}', [App\Http\Controllers\BodegaPedidosController::class, 'ordenes_nas_orden_update'])->name('ordenes_nas_update.orden');

    Route::get('/cosmica/admin/productos/stock', [App\Http\Controllers\BodegaPedidosController::class, 'productos_stock_cosmica'])->name('productos_stock_cosmica.index');
    Route::post('/cosmica/admin/productos/guardar-carrito', [App\Http\Controllers\BodegaPedidosController::class, 'guardar_cosmica'])->name('guardar_cosmica.carrito');
    Route::get('/cosmica/admin/productos/stock/show/{id}', [App\Http\Controllers\BodegaPedidosController::class, 'show_cosmica'])->name('productos_stock_cosmica.show');
    Route::get('/cosmica/admin/productos/imprimir/{id}', [App\Http\Controllers\BodegaPedidosController::class, 'imprimir_cosmica'])->name('productos_stock_cosmica.imprimir');

    Route::get('/cosmica/admin/productos/stock/ordenes', [App\Http\Controllers\BodegaPedidosController::class, 'ordenes_cosmica'])->name('ordenes_cosmica.index');
    Route::patch('/cosmica/admin/productos/stock/orden/update/{id}', [App\Http\Controllers\BodegaPedidosController::class, 'ordenes_cosmica_orden_update'])->name('ordenes_cosmica_update.orden');
    Route::patch('/cosmica/laboratorio/cancelar/update/{id}', [App\Http\Controllers\BodegaPedidosController::class, 'cancelar'])->name('cancelar_pedido.update');

    Route::get('bodega/preparacion/scaner/{id}', [App\Http\Controllers\BodegaController::class, 'preparacion_scaner'])->name('preparacion_scaner.bodega');
    Route::post('/check-product', [App\Http\Controllers\BodegaController::class, 'checkProduct'])->name('check.product');

    Route::get('bodega/preparacion/scaner/cosmica/{id}', [App\Http\Controllers\BodegaController::class, 'preparacion_scaner_cosmica'])->name('preparacion_scaner_cosmica.bodega');
    Route::post('/check-product/cosmica', [App\Http\Controllers\BodegaController::class, 'checkProduct_cosmica'])->name('check_cosmica.product');

    Route::get('bodega/preparacion/scaner/paradisus/{id}', [App\Http\Controllers\BodegaController::class, 'preparacion_scaner_paradisus'])->name('preparacion_scaner_paradisus.bodega');
    Route::post('/check-product/paradisus', [App\Http\Controllers\BodegaController::class, 'checkProduct_paradisus'])->name('check_paradisus.product');

    Route::get('bodega/preparacion/scaner/paradisus/repo/{id}', [App\Http\Controllers\BodegaController::class, 'preparacion_scaner_paradisus_repo'])->name('preparacion_scaner_paradisus_repo.bodega');
    Route::post('/check-product/paradisus/repo', [App\Http\Controllers\BodegaController::class, 'checkProduct_paradisus_repo'])->name('check_paradisus_repo.product');

    Route::get('bodega/preparacion/scaner/nas/{id}', [App\Http\Controllers\BodegaController::class, 'preparacion_scaner_nas'])->name('preparacion_scaner_nas.bodega');
    Route::post('/check-product/nas', [App\Http\Controllers\BodegaController::class, 'checkProduct_nas'])->name('check_nas.product');

    Route::get('bodega/preparacion/scaner/cosmica/online/{id}', [App\Http\Controllers\BodegaController::class, 'preparacion_scaner_online_cosmica'])->name('preparacion_scaner_cosmica_online.bodega');
    Route::post('/check-product/cosmica/online', [App\Http\Controllers\BodegaController::class, 'checkProduct_online_cosmica'])->name('check_cosmica_online.product');
    // =============== M O D U L O   R E P O R T E  V E N T A S ===============================
    Route::get('reporte/ventas/', [App\Http\Controllers\ReporteVentasController::class, 'index'])->name('reporte_ventas.index');
    Route::get('reporte/ventas/buscador', [App\Http\Controllers\ReporteVentasController::class, 'buscador'])->name('reporte_ventas.buscador');

    // =============== M O D U L O   L A B O R A T O R I O  C O S M I C A ===============================
    Route::get('/cosmica/laboratorio/reporte/pdf', [App\Http\Controllers\LabCosmicaController::class, 'pdf_reporte'])->name('reporte.pdf');
    Route::get('/laboratorio-cosmica/pdf-produccion-estimado', [App\Http\Controllers\LabCosmicaController::class, 'pdfProduccionEstimado'])
    ->name('laboratorio_cosmica.pdf_produccion_estimado');
                    // =============== E N V A S E S ===============================
        Route::get('/cosmica/laboratorio/envases', [App\Http\Controllers\LabCosmicaController::class, 'index'])->name('envases.index');
        Route::post('/cosmica/laboratorio/envases/store', [App\Http\Controllers\LabCosmicaController::class, 'store'])->name('envases.store');
        Route::get('/cosmica/laboratorio/envases/edit/{id}', [App\Http\Controllers\LabCosmicaController::class, 'edit'])->name('envases.edit');
        Route::patch('/cosmica/laboratorio/envases/update/{id}', [App\Http\Controllers\LabCosmicaController::class, 'update'])->name('envases.update');

        Route::get('/cosmica/laboratorio/envases/show/{id}', [App\Http\Controllers\LabCosmicaController::class, 'show'])->name('envases.show');
        Route::patch('/cosmica/laboratorio/envases/show/update/{id}', [App\Http\Controllers\LabCosmicaController::class, 'show_update'])->name('envases.update');
        Route::get('/cosmica/laboratorio/envases/show/{id}/stock-history', [App\Http\Controllers\LabCosmicaController::class, 'getStockHistoryEnvases'])->name('envases.stockHistory');
        Route::get('/cosmica/laboratorio/envases/pdf', [App\Http\Controllers\LabCosmicaController::class, 'pdf_envases'])->name('envases.pdf');
                    // =============== C O N T E O  G R A N E L ===============================
        Route::get('/cosmica/laboratorio/granel', [App\Http\Controllers\LabCosmicaController::class, 'index_granel'])->name('granel.index');
        Route::get('/cosmica/laboratorio/granel/show/{id}', [App\Http\Controllers\LabCosmicaController::class, 'show_granel'])->name('granel.show');
        Route::patch('/cosmica/laboratorio/granel/show/update/{id}', [App\Http\Controllers\LabCosmicaController::class, 'show_update_granel'])->name('granel.update');
        Route::get('/cosmica/laboratorio/granel/show/{id}/stock-history', [App\Http\Controllers\LabCosmicaController::class, 'getStockHistoryGranel'])->name('granel.stockHistory');

        Route::get('/cosmica/laboratorio/granel/pdf', [App\Http\Controllers\LabCosmicaController::class, 'pdf_granel'])->name('granel.pdf');
                    // =============== C O N T E O  E T I Q U E T A S ===============================
        Route::get('/cosmica/laboratorio/etiqueta', [App\Http\Controllers\LabCosmicaController::class, 'index_etiqueta'])->name('etiqueta.index');
        Route::get('/cosmica/laboratorio/etiqueta/show/{id}', [App\Http\Controllers\LabCosmicaController::class, 'show_etiqueta'])->name('etiqueta.show');
        Route::patch('/cosmica/laboratorio/etiqueta/show/update/{id}', [App\Http\Controllers\LabCosmicaController::class, 'show_update_etiqueta'])->name('etiqueta.update');
        Route::get('/cosmica/laboratorio/etiqueta/show/{id}/stock-history', [App\Http\Controllers\LabCosmicaController::class, 'getStockHistoryEtiqueta'])->name('etiqueta.stockHistory');
        Route::get('/cosmica/laboratorio/etiquetas/pdf', [App\Http\Controllers\LabCosmicaController::class, 'pdf_etiquetas'])->name('etiquetas.pdf');

        Route::get('/cosmica/laboratorio/reporte/etiquetas/pdf', [App\Http\Controllers\LabCosmicaController::class, 'pdf_etiquetas_reporte'])->name('reporte_etiquetas.pdf');

    // =============== M O D U L O   L A B O R A T O R I O  N A S ===============================
    Route::get('/nas/laboratorio/reporte/pdf', [App\Http\Controllers\LabNasController::class, 'pdf_reporte'])->name('reporte_nas.pdf');
                    // =============== E N V A S E S ===============================
        Route::get('/nas/laboratorio/envases', [App\Http\Controllers\LabNasController::class, 'index'])->name('envases_nas.index');
        Route::post('/nas/laboratorio/envases/store', [App\Http\Controllers\LabNasController::class, 'store'])->name('envases_nas.store');
        Route::get('/nas/laboratorio/envases/edit/{id}', [App\Http\Controllers\LabNasController::class, 'edit'])->name('envases_nas.edit');
        Route::patch('/nas/laboratorio/envases/update/{id}', [App\Http\Controllers\LabNasController::class, 'update'])->name('envases_nas.update');

        Route::get('/nas/laboratorio/envases/show/{id}', [App\Http\Controllers\LabNasController::class, 'show'])->name('envases_nas.show');
        Route::patch('/nas/laboratorio/envases/show/update/{id}', [App\Http\Controllers\LabNasController::class, 'show_update'])->name('envases_nas.update');
        Route::get('/nas/laboratorio/envases/show/{id}/stock-history', [App\Http\Controllers\LabNasController::class, 'getStockHistoryEnvases'])->name('envases_nas.stockHistory');
        Route::get('/nas/laboratorio/envases/pdf', [App\Http\Controllers\LabNasController::class, 'pdf_envases'])->name('envases_nas.pdf');
                    // =============== C O N T E O  G R A N E L ===============================
        Route::get('/nas/laboratorio/granel', [App\Http\Controllers\LabNasController::class, 'index_granel'])->name('granel_nas.index');
        Route::get('/nas/laboratorio/granel/show/{id}', [App\Http\Controllers\LabNasController::class, 'show_granel'])->name('granel_nas.show');
        Route::patch('/nas/laboratorio/granel/show/update/{id}', [App\Http\Controllers\LabNasController::class, 'show_update_granel'])->name('granel_nas.update');
        Route::get('/nas/laboratorio/granel/show/{id}/stock-history', [App\Http\Controllers\LabNasController::class, 'getStockHistoryGranel'])->name('granel_nas.stockHistory');

        Route::get('/nas/laboratorio/granel/pdf', [App\Http\Controllers\LabNasController::class, 'pdf_granel'])->name('granel_nas.pdf');
                    // =============== C O N T E O  E T I Q U E T A S ===============================
        Route::get('/nas/laboratorio/etiqueta', [App\Http\Controllers\LabNasController::class, 'index_etiqueta'])->name('etiqueta_nas.index');
        Route::get('/nas/laboratorio/etiqueta/show/{id}', [App\Http\Controllers\LabNasController::class, 'show_etiqueta'])->name('etiqueta_nas.show');
        Route::patch('/nas/laboratorio/etiqueta/show/update/{id}', [App\Http\Controllers\LabNasController::class, 'show_update_etiqueta'])->name('etiqueta_nas.update');
        Route::get('/nas/laboratorio/etiqueta/show/{id}/stock-history', [App\Http\Controllers\LabNasController::class, 'getStockHistoryEtiqueta'])->name('etiqueta_nas.stockHistory');
        Route::get('/nas/laboratorio/etiquetas/pdf', [App\Http\Controllers\LabNasController::class, 'pdf_etiquetas'])->name('etiquetas_nas.pdf');

        Route::get('/nas/laboratorio/reporte/etiquetas/pdf', [App\Http\Controllers\LabNasController::class, 'pdf_etiquetas_reporte'])->name('reporte_etiquetas_nas.pdf');

        // =============== M O D U L O  P E R F I L  C L I E N T E ===============================
        Route::get('/perfil/cliente/index', [App\Http\Controllers\PerfilClienteController::class, 'index'])->name('peril_cliente.index');
        Route::get('/perfil/cliente/buscador', [App\Http\Controllers\PerfilClienteController::class, 'buscador'])->name('peril_cliente.buscador');
        Route::get('/perfil/cliente/informacion/{id}', [App\Http\Controllers\PerfilClienteController::class, 'informacion'])->name('peril_cliente.informacion');
        Route::get('/perfil/cliente/cursos/{id}', [App\Http\Controllers\PerfilClienteController::class, 'cursos'])->name('peril_cliente.cursos');
        Route::get('/perfil/cliente/compras/tiendita/{phone}', [App\Http\Controllers\PerfilClienteController::class, 'compras_tiendita'])->name('peril_cliente.compras_tiendita');
        Route::get('/perfil/cliente/cotizaciones/nas/{phone}', [App\Http\Controllers\PerfilClienteController::class, 'cotizaciones_nas'])->name('peril_cliente.cotizaciones_nas');
        Route::get('/perfil/cliente/cotizaciones/cosmica/{phone}', [App\Http\Controllers\PerfilClienteController::class, 'cotizaciones_cosmica'])->name('peril_cliente.cotizaciones_cosmica');
        Route::get('/perfil/cliente/reposicion/{id}', [App\Http\Controllers\PerfilClienteController::class, 'reposicion'])->name('peril_cliente.reposicion');
        Route::get('/perfil/cliente/membresia/cosmica/{id}', [App\Http\Controllers\PerfilClienteController::class, 'membresia_cosmica'])->name('peril_cliente.membresia_cosmica');

        Route::get('/perfil/cliente/search-phone', [App\Http\Controllers\PerfilClienteController::class, 'searchPhone'])->name('peril_cliente.searchPhone');
        Route::get('/perfil/cliente/search-name', [App\Http\Controllers\PerfilClienteController::class, 'searchName'])->name('peril_cliente.searchName');

        Route::post('/perfil/cliente/reporte/cosmica/create', [App\Http\Controllers\PerfilClienteController::class, 'reporte_cosmica'])->name('peril_cliente.reporte_cosmica');
        Route::post('/perfil/cliente/reporte/nas/create', [App\Http\Controllers\PerfilClienteController::class, 'reporte_nas'])->name('peril_cliente.reporte_nas');

        Route::get('/perfil/cliente/api/notas/{id}', [App\Http\Controllers\PerfilClienteController::class, 'getNotasByUsuario']);
        Route::get('/perfil/cliente/api/notas-cosmica/{id}', [App\Http\Controllers\PerfilClienteController::class, 'getNotasCosmicaByUsuario']);

        Route::get('/perfil/cliente/api/productos-nota/{notaId}', [App\Http\Controllers\PerfilClienteController::class, 'getProductosByNota']);
        Route::get('/perfil/cliente/api/productos', [App\Http\Controllers\PerfilClienteController::class, 'getAllProductos']);
        Route::post('/perfil/cliente/create/reposicion', [App\Http\Controllers\PerfilClienteController::class, 'create_reposicion'])->name('reposicion.create');
        Route::get('/perfil/cliente/liga/reposicion/{id}', [App\Http\Controllers\PerfilClienteController::class, 'liga_reposicion'])->name('reposicion.liga');
        // =============== M O D U L O  C O T I Z A C I O N  E X P O ===============================
        Route::get('/cotizacion/expo/index', [App\Http\Controllers\CotizacionCosmicaController::class, 'index_expo'])->name('corizacion_expo.index');
        Route::get('/cotizacion/expo/buscador', [App\Http\Controllers\CotizacionCosmicaController::class, 'buscador_expo'])->name('corizacion_expo.buscador');
        Route::get('/cotizacion/expo/create', [App\Http\Controllers\CotizacionCosmicaController::class, 'create_expo'])->name('corizacion_expo.create');
        Route::get('/cotizacion/expo/edit/{id}', [App\Http\Controllers\CotizacionCosmicaController::class, 'edit_expo'])->name('corizacion_expo.edit');

        Route::get('/cotizacion/expo/pdf', [App\Http\Controllers\CotizacionCosmicaController::class, 'pdf_expo'])->name('pdf_expo.pdf');
        // =============== M O D U L O  A S I S T E N C I A  E X P O ===============================
        Route::get('/asistencia/expo/index', [App\Http\Controllers\ProfesoresController::class, 'asistencia_expo'])->name('asistencia_expo.index');
        Route::post('/update-asistencia', [App\Http\Controllers\ProfesoresController::class, 'updateAsistencia'])->name('updateAsistencia');
        Route::post('/update-confirmacion', [App\Http\Controllers\ProfesoresController::class, 'updateConfirmacion'])->name('updateConfirmacion');
});

// Route::get('registro/login', function () {
//     return view('cam.auth.login');
// });

Route::get('/registro', [App\Http\Controllers\FoliosController::class, 'index_registro'])->name('folio_registro.index');
Route::get('/registro/nosotros', [App\Http\Controllers\FoliosController::class, 'index_nosotros'])->name('index_nosotros.registro');
Route::get('/registro/afiliados', [App\Http\Controllers\FoliosController::class, 'index_afiliados'])->name('index_afiliados.registro');
Route::get('/registro/afiliate', [App\Http\Controllers\FoliosController::class, 'index_afiliate'])->name('index_afiliate.registro');

Route::get('/buscador/folio/registro', [App\Http\Controllers\FoliosController::class, 'buscador_registro'])->name('folio_registro.buscador');
Route::patch('/registro/imnas/update/doc_digital/{id}', [App\Http\Controllers\FoliosController::class, 'update_docDigital'])->name('update.docDigital');
Route::patch('/reporte/docmuentos/update/{id}', [App\Http\Controllers\FoliosController::class, 'update_externos'])->name('update.documentos_externo');

Route::get('distribuidoras/', [App\Http\Controllers\CosmicaDistribuidoraController::class, 'index_distribuidoras'])->name('distribuidoras.index_distribuidoras');
Route::get('cosmica/protocolo/{id}', [App\Http\Controllers\CotizacionCosmicaController::class, 'index_protocolo'])->name('distribuidoras.index_protocolo');
Route::post('cosmica/protocolo/{id}', [App\Http\Controllers\CotizacionCosmicaController::class, 'validate_protocolo'])->name('distribuidoras.validate_protocolo');
    // Rutas para el sistema de documentos

    Route::group(['prefix' => 'cam', 'middleware' => 'web'], function () {

    Route::middleware(['auth'])->group(function () {


    Route::patch('evaluador/videos/edit/{id}', [App\Http\Controllers\Cam\CamClientesController::class, 'update_videos'])->name('evaluador.update_videos');

        // =============== M O D U L O   E X P E D I E N T E S ( C A R P E T A S)===============================
        Route::get('evaluador/expediente/{code}', [App\Http\Controllers\Cam\CamClientesController::class, 'index_expediente'])->name('evaluador.index_expediente');
        Route::get('/evaluador/ruta/para/obtener/archivos', [App\Http\Controllers\Cam\CamClientesController::class, 'obtenerArchivosPorCategoria'])->name('evaluador.obtener.archivos');
        Route::post('/evaluador/expediente/crear/certificado', [App\Http\Controllers\Cam\CamClientesController::class, 'crear_certificado'])->name('evaluador.crear.certificados');
        Route::post('/evaluador/expediente/crear/cedulas', [App\Http\Controllers\Cam\CamClientesController::class, 'crear_cedulas'])->name('evaluador.crear.cedulas');

        // =============== M O D U L O   E X P E D I E N T E S  I N D E===============================
        Route::get('/expedientes/independiente', [CamExpedientesController::class, 'index_ind'])->name('independiente.index');
        Route::get('/expediente', [CamExpedientesController::class, 'view'])->name('view.expediente');
        Route::get('/expediente/edit/{id}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'edit'])->name('expediente.edit');

        Route::patch('/expediente/estandar/estatus/update/{id}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'update_estatus'])->name('expediente.estatus');

        // =============== M O D U L O  dashboards===============================
        Route::get('dashboard/{code}', [App\Http\Controllers\Cam\CamDashboardController::class, 'index'])->name('cam.index');
        Route::get('videos/{code}', [App\Http\Controllers\Cam\CamClientesController::class, 'videos'])->name('dashboard.videos');


        // =============== M O D U L O   E X P E D I E N T E S  C E N T R O===============================
        Route::get('/expedientes/centro', [CamExpedientesController::class, 'index_centro'])->name('centro.index');
        Route::get('/expediente/centro/edit/{id}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'edit_centro'])->name('expediente.edit_centro');

        Route::post('/expediente/crear/doc/exp', [App\Http\Controllers\Cam\CamExpedientesController::class, 'crear_docexp'])->name('crear.docexp');
        Route::get('/expediente/obtener/doc/exp', [App\Http\Controllers\Cam\CamExpedientesController::class, 'mostrarArchivosSubidos'])->name('obtener.docexp');

        // =============== M O D U L O   E X P E D I E N T E S ( C A R P E T A S)===============================
        Route::get('/ruta/para/obtener/archivos', [App\Http\Controllers\Cam\CamExpedientesController::class, 'obtenerArchivosPorCategoria'])->name('obtener.archivos');
        Route::post('/expediente/crear/nomb', [App\Http\Controllers\Cam\CamExpedientesController::class, 'crear_nomb'])->name('crear.nomb');
        Route::get('/obtener-carpetas-compradas/{notaId}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'obtenerCarpetasCompradas'])->name('obtener.carpetas');
        Route::get('/ruta/para/obtener/archivos/carpetas', [App\Http\Controllers\Cam\CamExpedientesController::class, 'obtenerDocumentosPorCarpeta'])->name('obtener.archivos.carp');

        Route::patch('/expediente/user/update/{id}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'update_exp_user'])->name('update_exp_user');

        Route::patch('/expediente/cita/update/{id}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'update_citas'])->name('expediente.cita');
        Route::patch('/expediente/checklist/update/{id}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'update_checklist'])->name('expediente.checklist');
        Route::patch('/expediente/check/update/{id}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'update_check'])->name('expediente.check');

        Route::patch('/expediente/checklist/centro/update/{id}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'update_check_centro'])->name('expediente.checklist_centro');

        // =============== M O D U L O  P A G O S ===============================
        Route::post('/expediente/pago/nueva-emision', [App\Http\Controllers\Cam\CamExpedientesController::class, 'pago_nueva_emision'])->name('nueva_emision.pago');
        Route::post('/expediente/pago/nuevo-estandar', [App\Http\Controllers\Cam\CamExpedientesController::class, 'pago_nuevo_estandar'])->name('nuevo_estandar.pago');
        Route::post('/expediente/pago/renovacion', [App\Http\Controllers\Cam\CamExpedientesController::class, 'pago_renovacion'])->name('renovacion.pago');

        // =============== M O D U L O   E X P E D I E N T E S ( M I N I  E X P)===============================
        Route::get('/expediente/mini/{id}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'edit_mini'])->name('edit.mini_exp');
        Route::post('/expediente/mini/crear', [App\Http\Controllers\Cam\CamExpedientesController::class, 'crear_mini'])->name('crear.mini_exp');
        Route::patch('/expediente/mini/update/{id}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'update_mini'])->name('update.mini_exp');
        Route::post('/expediente/mini/estandar', [App\Http\Controllers\Cam\CamExpedientesController::class, 'crear_estandar_mini'])->name('crear_estandar.mini_exp');
        Route::patch('/esstatus/expedientes/update/{id}', [App\Http\Controllers\Cam\CamExpedientesController::class, 'update_estatus_expedientes'])->name('estatus_expediente.update');


        // =============== M O D U L O  N O T A S ===============================
        Route::get('/notas/index', [App\Http\Controllers\Cam\NotasCamController::class, 'index'])->name('index.notas');
        Route::post('/notas/crear', [App\Http\Controllers\Cam\NotasCamController::class, 'crear'])->name('crear.notas');

        // =============== M O D U L O   R E C U R S O S ===============================
        Route::get('/estandares/index', [App\Http\Controllers\Cam\CamEstandaresController::class, 'index'])->name('index.estandares');
        Route::post('/estandares/crear', [App\Http\Controllers\Cam\CamEstandaresController::class, 'crear'])->name('crear.estandares');

        // =============== M O D U L O   D O C U M E N T O S ===============================
        Route::get('/documentos/index', [App\Http\Controllers\Cam\CamDocuemntosController::class, 'index'])->name('index.documentos');
        Route::post('/documentos/carpeta/crear', [App\Http\Controllers\Cam\CamDocuemntosController::class, 'crear_carpeta'])->name('crear_carpeta.documentos');
        Route::post('/documentos/crear', [App\Http\Controllers\Cam\CamDocuemntosController::class, 'crear'])->name('crear.documentos');
        Route::get('/documentos/edit/{id}', [App\Http\Controllers\Cam\CamDocuemntosController::class, 'edit'])->name('edit.documentos');

        // =============== M O D U L O   videos CRUD ===============================
        Route::get('/admin/videos_cam', [App\Http\Controllers\Cam\CamVideosController::class, 'index'])->name('videos_cam.index');
        Route::post('/admin/videos_cam/store', [App\Http\Controllers\Cam\CamVideosController::class, 'store'])->name('videos_cam.store');
        Route::patch('/admin/videos_cam/update/{id}', [App\Http\Controllers\Cam\CamVideosController::class, 'update'])->name('videos_cam.update');
    });
});


// Route::controller(StripePaymentController::class)->group(function(){
//     Route::get('/stripe', 'stripe');
//     Route::post('stripe', 'stripePost')->name('stripe.post');
// });


Route::get('/messenger', fn() => view('messenger'));
// Route::ResourceView('template');

Route::get('/whatsapp', [ChatController::class, 'inicio']);

    // Templates
    Route::get('/whatsapp/ajax/template', [TemplateController::class, 'showTemplate']);
    Route::get('/whatsapp/ajax/breadcrumb', [BreadcrumbController::class, 'showBreadcrumb']);
    Route::get('/whatsapp/ajax/create', [TemplateController::class, 'createTemplate']);
    Route::get('/whatsapp/ajax/detail', [TemplateController::class, 'detailTemplate']);
    Route::get('/whatsapp/ajax/index', [TemplateController::class, 'indexTemplate']);
    Route::get('/whatsapp/ajax/update', [TemplateController::class, 'updateTemplate']);

    // Chat
    Route::get('/whatsapp/ajax/chat-bubble', [ChatController::class, 'showChatBubble']);
    Route::get('/whatsapp/ajax/send-media-message', [ChatController::class, 'showSendMediaMessage']);
    Route::get('/whatsapp/ajax/messenger', [ChatController::class, 'showMessenger']);
    Route::get('/whatsapp/ajax/messenger2', [ChatController::class, 'showMessenger2']);

    Route::get('/api/v1/message/{chat_id}', [ChatController::class, 'loadMessages']);

    Route::post('/whatsapp/webhook', [WhatsAppWebhookController::class, 'handleWebhook']);
    Route::get('/whatsapp/webhook', [WhatsAppWebhookController::class, 'verifyWebhook']);
