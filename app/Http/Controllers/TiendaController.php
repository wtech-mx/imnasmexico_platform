<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;
use App\Models\BannersTienda;
use App\Models\Categorias;
use App\Models\ProductosStock;
use App\Models\SubCategorias;
use App\Models\Noticias;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Doctrine\Inflector\InflectorFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

use Illuminate\Support\Facades\Response;

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
        $productos_categoria = Products::take(30)->get();
        $nas_slide = Noticias::where('seccion', '=', 'NAS_SLIDE')->get();
        $banner_slide = Noticias::where('seccion', '=', 'NAS_BANNER')->get();
        $categoriasFacial = Categorias::where('linea', '=', 'facial')->orderBy('id','DESC')->get();
        $categoriasCorporal = Categorias::where('linea', '=', 'corporal')->orderBy('id','DESC')->get();

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

    public function getStockFromOdoo($id)
    {
        $stockOdoo = $this->odooService->getStockByProductIodoo($id);
        return response()->json(['stock' => $stockOdoo]);
    }

    public function cart(){
        return view('shop.cart');
    }

    public function single_product($slug)
    {
        $producto = Products::where('slug', '=', $slug)->first();

        // Obtener stock desde Odoo por id_woocommerce
        $stockDisponible = $this->odooService->getStockByProductIdWoo($producto->id_woocommerce);

        // Si hay un error en la conexión con Odoo, usamos el stock local
        if (isset($stockDisponible['error'])) {
            $stockDisponible = optional($producto->ProductoStock)->stock ?? 0;
        }

        // Aplicar descuento del 10% si es lunes y la categoría es 26
        $precioOriginal = $producto->ProductoStock->precio_normal;
        if (date('N') == 1 && $producto->id_categoria == 26) {
            $producto->ProductoStock->precio_normal = $precioOriginal * 0.9;
        }

        $productos_categoria = Products::join('productos_stock', 'productos.id', '=', 'productos_stock.id_producto')
            ->where('productos.id_categoria', '=', $producto->id_categoria)->take(10)->get();

        $productos_populares = Products::join('productos_stock', 'productos.id', '=', 'productos_stock.id_producto')
            ->inRandomOrder()->take(10)->select('Products.*')->get();

            if (date('N') == 1) {
                foreach ($productos_populares as $producto_popular) {
                    if ($producto_popular->id_categoria == 26) {
                        $producto_popular->precio_original = $producto_popular->ProductoStock->precio_normal;
                        $producto_popular->ProductoStock->precio_normal *= 0.9;
                    }
                }
            }

        return view('shop.single_product_ecommerce', compact('producto', 'productos_categoria', 'productos_populares', 'stockDisponible', 'precioOriginal'));
    }

    public function thankyou(){
        return view('shop.thankyou');
    }

    public function categories($slug)
    {
        // Obtener categoría desde slug
        $categoria = Categorias::where('slug', '=', $slug)->firstOrFail();

        // Obtener todas las categorías con sus subcategorías
        $categorias = Categorias::with('subcategorias')->get()->sortBy(function($cat) use ($categoria) {
            return $cat->id == $categoria->id ? 0 : 1;
        });

        // Obtener productos que pertenezcan a esta categoría (relación muchos a muchos)
        $productos = Products::whereHas('categorias', function ($q) use ($categoria) {
                $q->where('categorias.id', $categoria->id);
            })
            ->with('productoStock') // Traer relación con precio_normal
            ->get();

        // Aplicar descuento del 10% si es lunes y categoría es 26
        if (date('N') == 1 && $categoria->id == 26) {
            foreach ($productos as $producto) {
                if ($producto->productoStock) {
                    $producto->precio_original = $producto->productoStock->precio_normal;
                    $producto->productoStock->precio_normal *= 0.9;
                }
            }
        }

        return view('shop.categories', compact('categoria', 'categorias', 'productos'));
    }

    public function filter(Request $request)
    {
        $query = $request->get('query');
        $page = $request->get('page', 1);
        $itemsPerPage = 44;

        $productos = Products::query();

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

        return view('shop.filter', compact('productos'));
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
        $subcategoriasSeleccionadas = $request->get('subcategoria');
        $page = $request->get('page', 1);
        $itemsPerPage = 32;

        $productos = Products::query();

        // 🔁 Nuevo filtro por categoría usando la relación muchos a muchos
        if ($categoriaSeleccionada && $categoriaSeleccionada != 0) {
            $productos->whereHas('categorias', function ($q) use ($categoriaSeleccionada) {
                $q->where('id_categorias', $categoriaSeleccionada);
            });
        }

        // 🔁 Filtro por subcategorías (asumo que sigue en el producto directamente)
        if ($subcategoriasSeleccionadas && !empty($subcategoriasSeleccionadas)) {
            $productos->whereIn('id_subcategoria', $subcategoriasSeleccionadas);
        }

        // 🔁 Usar with() para traer stock y categorías
        $productos = $productos->with(['productoStock', 'categorias'])
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

        // ✅ 🚀 Obtener stock desde Odoo por id_woocommerce
        $stockDisponible = $this->odooService->getStockByProductIdWoo($product->id_woocommerce);

        // Si hay un error en la conexión con Odoo, usamos el stock local
        if (isset($stockDisponible['error'])) {
            $stockDisponible = optional($product->ProductoStock)->stock ?? 0;
        }

        // Aplicar descuento del 10% si es lunes y la categoría es 26
        $precio = $product->ProductoStock->precio_normal;

        $precioOriginal = $precio;
        if (date('N') == 1 && $product->id_categoria == 26) {
            $precio *= 0.9;

        }
        // 🛒 Obtener carrito actual desde la sesión
        $cart = session()->get('cart', []);

        // 📌 Obtener la cantidad actual del producto en el carrito
        $cantidadEnCarrito = isset($cart[$product->id]) ? $cart[$product->id]['cantidad'] : 0;

        // ⚠️ Verificar si al sumar la cantidad nueva se supera el stock disponible
        if (($cantidadEnCarrito + $cantidadNueva) > $stockDisponible) {
            return response()->json([
                'error' => '❌ No puedes agregar más de este producto. Stock insuficiente.'
            ], 400);
        }

        // ✅ Agregar o actualizar el producto en el carrito
        if (isset($cart[$product->id])) {
            $cart[$product->id]['cantidad'] += $cantidadNueva;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'nombre' => $product->nombre,
                'precio' => $precio,
                'precio_original' => $precioOriginal,
                'cantidad' => $cantidadNueva,
                'stock' => $stockDisponible,
                'imagen' => $product->imagen_principal,
            ];
        }

        // Guardar carrito en la sesión
        session()->put('cart', $cart);

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
        $cart = session('cart', []);

        if (isset($cart[$request->id])) {
            // Actualizamos la cantidad del producto en el carrito
            $cart[$request->id]['cantidad'] = $request->cantidad;

            // Recalculamos el precio total del producto
            $cart[$request->id]['total'] = $cart[$request->id]['precio'] * $request->cantidad;

            // Guardamos la sesión con los cambios
            session(['cart' => $cart]);
        }

        // Recalcular subtotal y total
        $subtotal = array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], $cart));
        $total = $subtotal; // Aquí podrías agregar el costo de envío si aplica

        return response()->json([
            'success' => true,
            'total_producto' => $cart[$request->id]['total'],
            'subtotal' => $subtotal,
            'total' => $total
        ]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function aviso(Request $request){

        return view('shop.aviso');
    }

    public function terminos(Request $request){

        return view('shop.terminos');

    }



}
