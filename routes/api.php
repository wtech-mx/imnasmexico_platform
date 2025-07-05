<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Products;
use App\Models\ProductosBundleId;
use App\Http\Controllers\StpController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/enviar-productos', function () {
    // Definir los estatus que deseas filtrar

    $products = Products::where('categoria', '!=', 'Ocultar')->where('subcategoria', '!=', 'Tiendita')->orderby('nombre','asc')->get();

    // Retornar los datos en formato JSON
    return response()->json([
        'success' => true,
        'message' => 'Datos enviados correctamente',
        'data' => $products
    ]);
});

Route::get('/enviar-productos/bundle-pack', function () {
    // Definir los estatus que deseas filtrar

    $productsBundle = ProductosBundleId::get();

    // Retornar los datos en formato JSON
    return response()->json([
        'success' => true,
        'message' => 'Datos enviados correctamente',
        'data' => $productsBundle
    ]);
});

Route::post('/webhook/stp/estado', [StpController::class, 'webhookEstado'])
     ->name('stp.webhook.estado');

Route::post('/webhook/stp/abono', [StpController::class, 'webhookAbono'])
     ->name('stp.webhook.abono');
