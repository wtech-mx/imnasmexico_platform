<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;
use App\Models\BannersTienda;
use App\Models\Categorias;
use App\Models\ProductosStock;
use App\Models\Noticias;
use App\Models\OrdersNas;
use App\Models\OrdersNasOnline;
use App\Models\ProductosBundleId;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Doctrine\Inflector\InflectorFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use MercadoPago\{Exception, SDK, Preference, Item};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class TiendaController extends Controller
{


    public function buscar(Request $request) {
        $query = $request->get('query');

        // Remover acentos y convertir a minúsculas
        $query = $this->removeAccents(strtolower($query));

        // Separar las palabras clave
        $palabras = explode(' ', $query);

        // Crear inflector para singular/plural
        $inflector = InflectorFactory::create()->build();

        $productos = Products::query();

        // Aplicar filtros adicionales
        $productos->where('categoria', 'NAS')
                  ->where('subcategoria', '=', 'Producto');

        $productos->where(function($subQuery) use ($palabras, $inflector) {
            foreach ($palabras as $palabra) {
                $singular = $inflector->singularize($palabra);
                $plural = $inflector->pluralize($palabra);

                $subQuery->orWhereRaw("
                    LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) LIKE ?
                    OR LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) LIKE ?
                    OR LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) LIKE ?
                ", ["%{$palabra}%", "%{$singular}%", "%{$plural}%"]);
            }
        });

        // Priorizar coincidencias exactas primero
        $productos->orderByRaw("
            CASE
                WHEN LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) = ? THEN 1
                WHEN LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) LIKE ? THEN 2
                ELSE 3
            END", [$query, "%{$query}%"]);

        // Obtener los productos con los campos necesarios
        $productos = $productos->limit(30)->get(['id', 'nombre', 'imagenes', 'slug']);

        return view('shop.components.buscador', compact('productos'));
    }


    private function removeAccents($string) {
        return strtr($string, [
            'á'=>'a', 'é'=>'e', 'í'=>'i', 'ó'=>'o', 'ú'=>'u',
            'Á'=>'A', 'É'=>'E', 'Í'=>'I', 'Ó'=>'O', 'Ú'=>'U',
            'ñ'=>'n', 'Ñ'=>'N', 'ü'=>'u', 'Ü'=>'U'
        ]);
    }

    public function index_ecommerce()
    {
        $productos_populares = Products::orderby('nombre','asc')->where('categoria', 'NAS')->where('subcategoria', '=', 'Producto')->inRandomOrder()->take(30)->get();

        // Aplicar descuento del 10% si es lunes y la categoría es 26
        if (date('N') == 1) {
            foreach ($productos_populares as $producto_popular) {
                if ($producto_popular->id_categoria == 26) {
                    $producto_popular->precio_original = $producto_popular->ProductoStock->precio_normal;
                    $producto_popular->ProductoStock->precio_normal *= 0.9;
                }
            }
        }

        $producto = Products::inRandomOrder()->first();

        // 1. Obtener un id_categoria aleatorio que tenga productos activos y válidos
        $id_categoria_random = Products::where('categoria', 'NAS')
            ->where('subcategoria', 'Producto')
            ->whereNotNull('id_categoria')
            ->inRandomOrder()
            ->value('id_categoria');

        // 2. Si existe, traer productos solo de esa categoría aleatoria
        $productos_categoria = Products::where('categoria', 'NAS')
            ->where('subcategoria', 'Producto')
            ->where('id_categoria', $id_categoria_random)
            ->orderBy('nombre', 'asc')
            ->get();


        $nas_slide = Noticias::where('seccion', '=', 'NAS_SLIDE')->get();
        $banner_slide = Noticias::where('seccion', '=', 'NAS_BANNER')->get();
        $categoriasFacial = Categorias::where('linea', '=', 'facial')->where('estatus_visibilidad', '=', 'Activo')->orderBy('id','DESC')->get();
        $categoriasCorporal = Categorias::where('linea', '=', 'corporal')->where('estatus_visibilidad', '=', 'Activo')->orderBy('id','DESC')->get();

        return view('shop.ecommerce', compact('productos_populares', 'producto', 'productos_categoria','nas_slide','banner_slide','categoriasFacial','categoriasCorporal'));
    }

    public function generateFeed()
    {
        $productos = Products::join('productos_stock', 'productos.id', '=', 'productos_stock.id_producto')
            ->select('Products.*', 'productos_stock.precio_normal', 'productos_stock.stock', 'productos_stock.sku')
            ->get();

        $xml = new \SimpleXMLElement('<rss/>');
        $xml->addAttribute('version', '2.0');
        $xml->addAttribute('xmlns:g', 'http://base.google.com/ns/1.0');
        $channel = $xml->addChild('channel');
        $channel->addChild('title', 'Zocofresh');
        $channel->addChild('link', url('https://www.zocofresh.com'));
        $channel->addChild('description', 'Feed de productos google');

        foreach ($productos as $producto) {
            $item = $channel->addChild('item');
            $item->addChild('g:id', $producto->id, 'http://base.google.com/ns/1.0');
            $item->addChild('g:title', htmlspecialchars($producto->nombre), 'http://base.google.com/ns/1.0');
            $item->addChild('g:description', htmlspecialchars($producto->descripcion), 'http://base.google.com/ns/1.0');
            $item->addChild('g:link', url('/tienda/producto/' . $producto->slug), 'http://base.google.com/ns/1.0');

            $imageUrl = "https://www.zocofresh.com/imagen_principal/empresa1/{$producto->imagen_principal}";
            $item->addChild('g:image_link', htmlspecialchars($imageUrl, ENT_XML1, 'UTF-8'), 'http://base.google.com/ns/1.0');

            $item->addChild('g:price', number_format($producto->precio_normal, 2, '.', '') . ' MXN', 'http://base.google.com/ns/1.0');
            $item->addChild('g:availability', $producto->stock > 0 ? 'in_stock' : 'out_of_stock', 'http://base.google.com/ns/1.0');
            $item->addChild('g:gtin', explode('_', $producto->sku)[0], 'http://base.google.com/ns/1.0');
            $item->addChild('g:condition', 'new', 'http://base.google.com/ns/1.0');
            $item->addChild('g:brand', $producto->Marca->nombre ?? 'SM', 'http://base.google.com/ns/1.0');
            // dd($item);
        }

        return Response::make($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
    }

    public function cart(){
        return view('shop.cart');
    }

    public function single_product($slug)
    {
        $producto = Products::where('slug', '=', $slug)->first();

        $categoriasFacial = Categorias::where('linea', '=', 'facial')->where('estatus_visibilidad', '=', 'Activo')->orderBy('id','DESC')->get();
        $categoriasCorporal = Categorias::where('linea', '=', 'corporal')->where('estatus_visibilidad', '=', 'Activo')->orderBy('id','DESC')->get();
        $productos_categoria = Products::take(30)->get();

        $productos_populares = Products::orderby('nombre','asc')->where('categoria', 'NAS')->where('subcategoria', '=', 'Producto')->inRandomOrder()->take(30)->get();

        return view('shop.single_product_ecommerce', compact('producto', 'categoriasFacial','categoriasCorporal', 'productos_populares','productos_categoria'));
    }

    public function thankyou($code){
        $order = OrdersNas::where('code', $code)->firstOrFail();
        $order_ticket = OrdersNasOnline::where('id_order', '=', $order->id)->get();
        $productos_populares = Products::orderby('nombre','asc')->where('categoria', 'NAS')->where('subcategoria', '=', 'Producto')->inRandomOrder()->take(30)->get();

        return view('shop.thankyou', compact('order', 'order_ticket', 'productos_populares'));
    }

    public function categories($slug)
    {

        $categoria = Categorias::where('slug', '=', $slug)->where('estatus_visibilidad', '=', 'Activo')->first();
        $categorias  = Categorias::orderBy('nombre','asc')->where('estatus_visibilidad', '=', 'Activo')->get();
        $productos  = Products::orderby('nombre','asc')->where('categoria', 'NAS')->where('subcategoria', '=', 'Producto')->inRandomOrder()->take(30)->get();

        return view('shop.categories',compact('categoria','categorias','productos'));
    }

    public function filter(Request $request)
    {
        $query = $request->get('query');
        $page = $request->get('page', 1);
        $itemsPerPage = 44;

        $categorias  = Categorias::orderBy('nombre','asc')->where('estatus_visibilidad', '=', 'Activo')->get();

        $productos = Products::query();

        // Aplicar filtros adicionales
        $productos->where('categoria', 'NAS')
                  ->where('subcategoria', '=', 'Producto');

        if ($query) {
            // Remover acentos y convertir a minúsculas
            $query = $this->removeAccents(strtolower($query));

            // Separar las palabras clave
            $palabras = explode(' ', $query);

            // Crear inflector para singular/plural
            $inflector = InflectorFactory::create()->build();

            $productos->where(function($subQuery) use ($palabras, $inflector) {
                foreach ($palabras as $palabra) {
                    $singular = $inflector->singularize($palabra);
                    $plural = $inflector->pluralize($palabra);

                    $subQuery->orWhereRaw("
                        LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) LIKE ?
                        OR LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) LIKE ?
                        OR LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) LIKE ?
                    ", ["%{$palabra}%", "%{$singular}%", "%{$plural}%"]);
                }
            });

            // Priorizar coincidencias exactas primero
            $productos->orderByRaw("
                CASE
                    WHEN LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) = ? THEN 1
                    WHEN LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) LIKE ? THEN 2
                    ELSE 3
                END", [$query, "%{$query}%"]);
        } else {
            $productos->latest('productos.created_at');
        }

        $productos = $productos->skip(($page - 1) * $itemsPerPage)
                                ->take($itemsPerPage)
                                ->get();

        if ($request->ajax()) {
            return view('shop.filter_show', compact('productos'))->render();
        }

        return view('shop.filter', compact('productos','categorias'));
    }

    private function removeAccentsSearch($string) {
        $unwantedArray = [
            'á'=>'a', 'é'=>'e', 'í'=>'i', 'ó'=>'o', 'ú'=>'u',
            'Á'=>'A', 'É'=>'E', 'Í'=>'I', 'Ó'=>'O', 'Ú'=>'U',
            'ñ'=>'n', 'Ñ'=>'N', 'ü'=>'u', 'Ü'=>'U'
        ];
        return strtr($string, $unwantedArray);
    }

    public function filtrarPorCategoria(Request $request)
    {
        $categoriaSeleccionada = $request->get('categoria');
        $page = $request->get('page', 1);
        $itemsPerPage = 32;

        $productos = Products::query();

        // Aplicar filtros adicionales
        $productos->where('categoria', 'NAS')
                  ->where('subcategoria', '=', 'Producto');

        // Filtro por categoría usando las relaciones del modelo Categorias
        if ($categoriaSeleccionada && $categoriaSeleccionada != 0) {
            $productos->where(function ($query) use ($categoriaSeleccionada) {
                $query->where('id_categoria', $categoriaSeleccionada)
                      ->orWhere('id_categoria2', $categoriaSeleccionada);
            });
        }

        // Usar with() para traer las relaciones de categorías
        $productos = $productos->with(['categoria', 'categoria.products', 'categoria.products2'])
            ->orderBy('nombre', 'ASC')
            ->skip(($page - 1) * $itemsPerPage)
            ->take($itemsPerPage)
            ->get();

        if ($request->ajax()) {
            return view('shop.filter_show', compact('productos'))->render();
        }

        return view('shop.filter', compact('productos'));
    }

    public function agregar(Request $request)
    {
        $product = Products::find($request->id);

        $cantidadNueva = (float) $request->cantidad; // Cantidad a agregar
        if (!$product) {
            return response()->json(['error' => '❌ Producto no encontrado'], 404);
        }

        // 🛒 Obtener carrito actual desde la sesión
        $cart = session()->get('cart_productos', []);

        // 📌 Obtener la cantidad actual del producto en el carrito
        $cantidadEnCarrito = isset($cart[$product->id]) ? $cart[$product->id]['cantidad'] : 0;

        // ✅ Agregar o actualizar el producto en el carrito
        if (isset($cart[$product->id])) {
            $cart[$product->id]['cantidad'] += $cantidadNueva;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'nombre' => $product->nombre,
                'precio' => $product->precio_normal,
                'cantidad' => $cantidadNueva,
                'stock' =>  $product->stock,
                'imagenes' => $product->imagenes,
                'id_producto' => $product->id,
            ];
        }

        // Guardar carrito en la sesión
        session()->put('cart_productos', $cart);

        // 🔥 Calcular el total de productos sumando las cantidades
        $totalProductos = array_sum(array_column($cart, 'cantidad'));

        return response()->json([
            'mensaje' => '✅ Producto agregado al carrito',
            'carrito' => $cart,
            'total_productos' => $totalProductos
        ]);
    }

    public function update(Request $request)
    {
        $cart = session('cart_productos', []);

        if (isset($cart[$request->id])) {
            // Actualizamos la cantidad del producto en el carrito
            $cart[$request->id]['cantidad'] = $request->cantidad;

            // Recalculamos el precio total del producto
            $cart[$request->id]['total'] = $cart[$request->id]['precio'] * $request->cantidad;

            // Guardamos la sesión con los cambios
            session(['cart_productos' => $cart]);
        }

        // Recalcular subtotal
        $subtotal = array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], $cart));

        // Determinar el costo de envío
        $costoEnvio = 0;
        if ($request->envio === 'domicilio' && $subtotal < 1000) {
            $costoEnvio = 150;
        }

        // Calcular el total
        $total = $subtotal + $costoEnvio;

        return response()->json([
            'success' => true,
            'total_producto' => $cart[$request->id]['total'],
            'subtotal' => $subtotal,
            'costo_envio' => $costoEnvio,
            'total' => $total
        ]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart_productos', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart_productos', $cart);
        }

        // Recalcular subtotal
        $subtotal = array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], $cart));

        // Determinar el costo de envío
        $costoEnvio = 0;
        if ($request->envio === 'domicilio' && $subtotal < 1000) {
            $costoEnvio = 150;
        }

        // Calcular el total
        $total = $subtotal + $costoEnvio;

        return response()->json([
            'success' => true,
            'subtotal' => $subtotal,
            'costo_envio' => $costoEnvio,
            'total' => $total
        ]);
    }

    public function aviso(Request $request){

        return view('shop.aviso');
    }

    public function terminos(Request $request){

        return view('shop.terminos');

    }

    public function processPayment_nas(Request $request)
    {
        // Configurar el SDK de Mercado Pago con las credenciales de API
       SDK::setAccessToken(config('services.mercadopago.token'));

        // Crear un objeto de preferencia de pago
        $preference = new Preference();
        $code = Str::random(8);

        // Crear un objeto de artículo
        foreach (session('cart_productos') as $id => $details) {
            // dd(session('cart_productos'));
            $item = new Item();
            $item->title = $details['nombre'];
            $item->quantity = $details['cantidad'];
            $item->unit_price = $details['precio'];
            $ticketss[] = $item;
        }

        // Crear un objeto de preferencias de pago
        $preference = new \MercadoPago\Preference();

        $preference->back_urls = array(
            "success" => route('order_nas.pay'),
            "pending" => route('order_nas.pay'),
            "failure" => "https://plataforma.imnasmexico.com/tienda/nas",
        );

        $preference->auto_return = "approved";
        $preference->external_reference = $code;
        $preference->items = $ticketss;

        if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->telefono)->exists()) {
                $user = User::where('telefono', $request->telefono)->first();
                $user->postcode = $request->get('codigo_postal');
                $user->state = $request->get('state');
                $user->country = $request->get('colonia');
                $user->direccion = $request->get('calle_numero');
                $user->city = $request->get('estado');
                $user->alcaldia = $request->get('alcaldia');
                $user->referencia = $request->get('referencia');
                $user->update();
            } else {
                $user = User::where('email', $request->email)->first();
                $user->postcode = $request->get('codigo_postal');
                $user->state = $request->get('state');
                $user->country = $request->get('colonia');
                $user->direccion = $request->get('calle_numero');
                $user->city = $request->get('estado');
                $user->alcaldia = $request->get('alcaldia');
                $user->referencia = $request->get('referencia');
                $user->update();
            }
            $payer = $user;
        } else {
            $payer = new User;
            $payer->name = $request->get('name') . ' ' . $request->get('ape_paterno') . ' ' . $request->get('ape_materno');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->password = Hash::make($request->get('telefono'));

            $payer->postcode = $request->get('codigo_postal');
            $payer->state = $request->get('state');
            $payer->country = $request->get('colonia');
            $payer->direccion = $request->get('calle_numero');
            $payer->city = $request->get('estado');
            $payer->alcaldia = $request->get('alcaldia');
            $payer->referencia = $request->get('referencia');
            $payer->save();
            $datos = User::where('id', '=', $payer->id)->first();
        }

        try {
            // Crear la preferencia en Mercado Pago

            $preference->save();

            $fechaActual = date('Y-m-d');
            $total = 0;
            foreach (session('cart_productos') as $id => $details) {
                $total += $details['precio'] * $details['cantidad'];
            }

            $order_cosmica = new OrdersNas;
            $order_cosmica->id_usuario = $payer->id;
            $order_cosmica->pago = $total;
            $order_cosmica->forma_pago = 'Mercado Pago';
            $order_cosmica->fecha = $fechaActual;
            $order_cosmica->estatus = 0;
            $order_cosmica->code = $code;
            $order_cosmica->external_reference = $code;
            if($request->get('codigo_postal') != NULL ){
                $order_cosmica->forma_envio = 'envio';
            }
            $order_cosmica->save();

            foreach (session('cart_productos') as $id => $details) {

                $producto = Products::where('id', $details['id_producto'])->first();

                if ($producto) {
                    if ($producto && $producto->subcategoria == 'Kit') {
                        $productos_bundle = ProductosBundleId::where('id_product', $producto->id)->get();

                        foreach ($productos_bundle as $producto_bundle) {
                            $order_ticket = new OrdersNasOnline;
                            $order_ticket->id_order = $order_cosmica->id;
                            $order_ticket->nombre = $producto_bundle->producto;
                            $order_ticket->id_producto = $producto_bundle->id_producto;
                            $order_ticket->precio = '0';
                            $order_ticket->cantidad = $producto_bundle->cantidad;
                            $order_ticket->kit = '1';
                            $order_ticket->num_kit = $producto_bundle->id_product;
                            $order_ticket->save();
                        }
                    }else{
                        $order_ticket = new OrdersNasOnline;
                        $order_ticket->id_order = $order_cosmica->id;
                        $order_ticket->id_producto = $details['id_producto'];
                        $order_ticket->nombre = $details['nombre'];
                        $order_ticket->precio = $details['precio'];
                        $order_ticket->cantidad = $details['cantidad'];
                        $order_ticket->save();
                    }
                }
            }
            // Redirigir al usuario al proceso de pago de Mercado Pago
            return Redirect::to($preference->init_point);
        } catch (Exception $e) {
            // Manejar errores de Mercado Pago
            return Redirect::back()->withErrors(['message' => $e->getMessage()]);
        } catch (Throwable $e) {
            // Manejar errores de PHP
            return Redirect::back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function pay(OrdersNas $order, Request $request)
    {
        $payment_id = $request->get('payment_id');
        $external_reference = $request->get('external_reference');

        $dominio = $request->getHost();
        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-8901800557603427-041420-99b569dfbf4e6ce9160fc673d9a47b1e-1115271504");

        $response = json_decode($response);
        if (isset($response->error)) {
            return redirect()->route('order_nas.show', $order->code)->with('error', 'Hubo un problema al verificar el pago.');
        }
        $status = $response->status ?? null;
        $external_reference_api = $response->external_reference ?? null;
        $external_reference = $external_reference_api ?: $external_reference;

        // Si no se encuentra el external_reference, redirige con error
        if (!$external_reference) {
            return redirect()->route('order_nas.show', $order->code)->with('error', 'No se pudo verificar el pago. Falta external_reference.');
        }

        if ($status == 'approved') {
            $order = OrdersNas::where('code', '=', $external_reference)->first();
            $order->num_order = $payment_id;
            $order->estatus = 1;
            $order->update();

            Session::forget('cart_productos');
        } else {
            $order = OrdersNas::where('code', '=', $external_reference)->first();
            $order->num_order = $payment_id;
            $order->update();


            Session::forget('cart_productos');
        }
        return redirect()->route('order_nas.show', $order->code);
    }

    public function index(){
        $orders_pagadas = OrdersNas::orderBy('id','DESC')->where('estatus','=' , '1')->get();

        return view('admin.notas_productos.index_ecommerce', compact('orders_pagadas'));
    }

    public function update_guia_ecommerce(Request $request, $id){
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera/');
        }else{
            $pago_fuera = public_path() . '/pago_fuera/';
        }

        $nota = OrdersNas::findOrFail($id);
        $nota->fecha_preparacion  = date("Y-m-d H:i:s");
        $nota->estatus_bodega  = 'En preparacion';
        if ($request->hasFile("doc_guia")) {
            $file = $request->file('doc_guia');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $nota->guia_doc = $fileName;
        }
        $nota->save();

        return redirect()->back()->with('success', 'Se ha actualizada');

    }

    public function imprimir_admin($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = OrdersNas::find($id);

        $nota_productos = OrdersNasOnline::where('id_order', $nota->id)->get();


        $pdf = \PDF::loadView('admin.notas_productos.pdf_compra', compact('nota', 'today', 'nota_productos'));

        return $pdf->stream();
    }

    public function preparacion_scaner(Request $request, $id){

        $nota_scaner = OrdersNas::where('id', '=', $id)->first();
        $productos_scaner = OrdersNasOnline::where('id_order', '=', $id)
        ->get()
        ->map(function ($producto) {
            $producto->escaneados = $producto->escaneados ?? 0; // Asegúrate de incluir el valor actual
            return $producto;
        });

        $allChecked = $productos_scaner->every(function ($producto) {
            return $producto->estatus === 1;
        });

        return view('admin.bodega.scaner.show_nas_ecome', compact('nota_scaner', 'productos_scaner', 'allChecked'));
    }

    public function checkProduct(Request $request){

        $sku_scaner = $request->input('sku');
        $sku = trim($sku_scaner);
        $idNotaProducto = $request->input('id_notas_productos');

        // Busca el producto en la tabla `Products`
        $product = Products::where('sku', $sku)->first();

        if ($product) {
            // Verifica y actualiza el registro correcto en `productos_notas`
            $notaProducto = OrdersNasOnline::where('id_order', $idNotaProducto)
            ->where('id_producto', $product->id)
            ->first();

            if ($notaProducto) {
                if ($notaProducto->escaneados < $notaProducto->cantidad) {
                    $notaProducto->escaneados = intval($notaProducto->escaneados) + 1; // Convierte escaneados a entero y suma 1
                    if (intval($notaProducto->escaneados) === intval($notaProducto->cantidad)) { // Convierte cantidad a entero para comparar
                        $notaProducto->estatus = 1; // Marca como completo
                    }
                        $notaProducto->save();
                    return response()->json(['status' => 'success', 'escaneados' => $notaProducto->escaneados]);
                } else {

                    return response()->json(['status' => 'error', 'message' => 'Cantidad ya alcanzada']);
                }
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Producto no encontrado o no corresponde a la nota']);
    }
}
