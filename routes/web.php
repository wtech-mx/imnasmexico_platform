<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\WebhooksController;
use App\Http\Controllers\StripePaymentController;

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
Route::get('check', function () {
    return view('user.components.checkout_paquetes');
});

Route::get('nuestras_instalaciones', function () {
    return view('user.instalaciones');
});

Route::get('login', function () {
    return view('auth.login');
});

Route::get('avales', function () {
    return view('user.avales');
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeUsersController::class, 'index'])->name('user.home');

// =============== P A G I N A  S I N G L E  C O U R S E ===============================
Route::get('/curso/{slug}', [App\Http\Controllers\CursoUsersController::class, 'show'])->name('cursos.show');

Route::get('/calendario', [App\Http\Controllers\CursoUsersController::class, 'index_user'])->name('cursos.index_user');
Route::get('/calendario/advance', [App\Http\Controllers\CursoUsersController::class, 'advance'])->name('advance_search');

// =============== P A Q U E T E S ===============
Route::get('/paquetes', [App\Http\Controllers\CursoUsersController::class, 'paquetes'])->name('cursos.paquetes');

Route::post('/paquetes/resultado', [App\Http\Controllers\OrderController::class, 'resultado'])->name('carrito.resultado');
Route::post('/paquetes/resultado2', [App\Http\Controllers\OrderController::class, 'resultado'])->name('carrito.resultado2');
Route::post('/paquetes/resultado3', [App\Http\Controllers\OrderController::class, 'resultado'])->name('carrito.resultado3');
Route::post('/paquetes/resultado4', [App\Http\Controllers\OrderController::class, 'resultado'])->name('carrito.resultado4');
Route::get('/paquetes/resumen', [App\Http\Controllers\CursoUsersController::class, 'resumen'])->name('carrito.resumen');

// =============== P A G O S ===============================
Route::post('/process-payment', [OrderController::class, 'processPayment'])->name('process-payment');

Route::post('/webhooks', WebhooksController::class);

Route::get('/orders/pay', [OrderController::class, 'pay'])->name('order.pay');
Route::get('/orders/{code}/show', [OrderController::class, 'show'])->name('order.show');

Route::post('/orders/pay/stripe', [OrderController::class, 'pay_stripe'])->name('order.pay_stripe');

Route::post('/paquete/pay/stripe', [OrderController::class, 'pay_stripe_paquete'])->name('order.pay_stripe_paquete');

// =============== C A R R I T O ===============================
Route::get('add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('add.to.cart');
Route::patch('/update-cart', [OrderController::class, 'update'])->name('update.cart');
Route::delete('/remove-from-cart', [OrderController::class, 'remove'])->name('remove.from.cart');

// =============== L O G I N  U S E R S ===============================
Route::get('perfil/{code}', [App\Http\Controllers\ClientsController::class, 'index'])->name('perfil.index');

Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::post('custom-registration', [App\Http\Controllers\CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [App\Http\Controllers\CustomAuthController::class, 'signOut'])->name('signout');

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
    Route::get('/admin/cursos/create', [App\Http\Controllers\CursosController::class, 'create'])->name('cursos.create');
    Route::post('/admin/cursos/store', [App\Http\Controllers\CursosController::class, 'store'])->name('cursos.store');
    Route::get('/admin/cursos/edit/{id}', [App\Http\Controllers\CursosController::class, 'edit'])->name('cursos.edit');
    Route::patch('/admin/cursos/update/{id}', [App\Http\Controllers\CursosController::class, 'update'])->name('cursos.update');
    Route::delete('/admin/cursos/delete/{id}', [App\Http\Controllers\CursosController::class, 'destroy'])->name('cursos.destroy');

    Route::get('/admin/cursos/listas/{id}', [App\Http\Controllers\CursosController::class, 'listas'])->name('cursos.listas');

    // =============== M O D U L O   P A G O S  P O R  F U E R A ===============================
    Route::get('/admin/pagos-por-fuera/inscripcion', [App\Http\Controllers\PagosFueraController::class, 'inscripcion'])->name('pagos.inscripcion');
    Route::post('/admin/pagos-por-fuera/inscripcion/store', [App\Http\Controllers\PagosFueraController::class, 'store'])->name('pagos.store');

    Route::get('/changeStatus', [App\Http\Controllers\PagosFueraController::class, 'ChangeInscripcionStatus'])->name('ChangeInscripcionStatus.pagos');
    Route::get('/changeStatus/pago', [App\Http\Controllers\PagosFueraController::class, 'ChangePendienteStatus'])->name('ChangePendienteStatus.pagos');
    Route::get('/changeStatus/deudor', [App\Http\Controllers\PagosFueraController::class, 'ChangeDeudorStatus'])->name('ChangeDeudorStatus.pagos');

    Route::get('/admin/pagos-por-fuera/pendientes', [App\Http\Controllers\PagosFueraController::class, 'pendientes'])->name('pagos.pendientes');
    Route::get('/admin/pagos-por-fuera/deudores', [App\Http\Controllers\PagosFueraController::class, 'deudores'])->name('pagos.deudores');

    // =============== M O D U L O   O R D E N E S ===============================
    Route::post('/clientes/curso/create', [App\Http\Controllers\OrderController::class, 'pay_externo'])->name('orden.pay_externo');


    /*|--------------------------------------------------------------------------
    |Configuracion
    |--------------------------------------------------------------------------*/
    Route::get('/configuracion', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('index.configuracion');
    Route::patch('/configuracion/update', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('update.configuracion');

     // =============== M O D U L O   Profile User ===============================
});

// Route::get('/admin/pagos-por-fuera/inscripcion', [App\Http\Controllers\StripePaymentController::class, 'inscripcion'])->name('pagos.inscripcion');
// Route::post('/admin/pagos-por-fuera/inscripcion/store', [App\Http\Controllers\StripePaymentController::class, 'store'])->name('pagos.store');


// Route::controller(StripePaymentController::class)->group(function(){
//     Route::get('/stripe', 'stripe');
//     Route::post('stripe', 'stripePost')->name('stripe.post');
// });


