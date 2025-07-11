<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Cosmikausers;
use App\Models\Cursos;
use App\Models\Noticias;
use App\Models\CursosTickets;
use App\Models\OrdersTickets;
use Session;
use Str;
use Illuminate\Support\Facades\Auth;

use App\Models\ProductosBundleId;
use Illuminate\Http\Request;


class EcommerceCosmikaController extends Controller
{
    public function home(){
        $products_popular = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->inRandomOrder()
        ->take(15)
        ->get();

        return view('tienda_cosmica.home', compact('products_popular'));
    }

    public function show($slug)
    {
        $fechaActual = date('Y-m-d');

        $noticias_gallery = Noticias::orderBy('id','DESC')->where('seccion','=','Galeria Cursos')->get();

        $curso = Cursos::where('slug','=', $slug)->firstOrFail();
        $cursos = Cursos::where('fecha_final','>=', $fechaActual)->where('estatus','=', '1')->get();
        $tickets = CursosTickets::where('id_curso','=', $curso->id)->where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->get();

        $usuarioId = Auth::id(); // Obtén el ID del usuario logueado
        // Verifica si el usuario ha comprado un ticket para el curso
        $usuario_compro = OrdersTickets::where('id_usuario', $usuarioId)
                        ->where('id_curso','=', $curso->id)
                        ->first();

        return view('tienda_cosmica.single_coursenew', compact('curso', 'tickets', 'usuario_compro','cursos','noticias_gallery'));
    }

    public function single_product($slug){
        $product = Products::where('slug', '=', $slug)->first();

        $products_interesar = Products::
        where('linea', $product->linea)
        ->where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->inRandomOrder()
        ->take(6)
        ->get();

        $products_popular = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->inRandomOrder()
        ->take(15)
        ->get();

        return view('tienda_cosmica.single_product', compact('product', 'products_interesar', 'products_popular'));
    }

    public function cart(){

        return view('tienda_cosmica.cart');
    }

    public function categories(){

        return view('tienda_cosmica.categories');
    }

    public function filter(){

        return view('tienda_cosmica.filter');
    }

    public function about(){

        return view('tienda_cosmica.about');
    }

    public function afiliadas(){

        $distribuidora = Cosmikausers::where('membresia','=','estelar')->where('membresia_estatus','=','Activa')->get();

        return view('tienda_cosmica.afiliadas', compact('distribuidora'));
    }

    public function productos(){

        $products = Products::orderBy('id','DESC')->where('categoria', '=', 'Cosmica')->where('subcategoria', '=', 'Producto')->orderby('nombre','asc')->get();
        $products_facial = Products::orderBy('id','DESC')->where('categoria', '=', 'Cosmica')->where('linea', '=', 'Facial')->where('subcategoria', '=', 'Producto')->orderby('nombre','asc')->get();
        $products_corporal = Products::orderBy('id','DESC')->where('categoria', '=', 'Cosmica')->where('linea', '=', 'Corporal')->where('subcategoria', '=', 'Producto')->orderby('nombre','asc')->get();

        return view('tienda_cosmica.productos', compact('products','products_facial','products_corporal'));
    }

    public function productos_faciales(){
        $products_constelacion = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Constelacion')
        ->orderBy('nombre','ASC')
        ->get();

        $products_espectro = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Espectro')
        ->orderBy('nombre','ASC')
        ->get();

        $products_lunar = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Lunar')
        ->orderBy('nombre','ASC')
        ->get();

        $products_mascarillas = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Mascarillas Estelares')
        ->orderBy('nombre','ASC')
        ->get();

        $products_nebulosa = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Nebulosa')
        ->orderBy('nombre','ASC')
        ->get();

        $products_pluton = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Pluton')
        ->orderBy('nombre','ASC')
        ->get();

        $products_solar = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Solar')
        ->orderBy('nombre','ASC')
        ->get();

        $products_venus = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Venus')
        ->orderBy('nombre','ASC')
        ->get();

        $products_lips = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Lips Glow')
        ->orderBy('nombre','ASC')
        ->get();

        $products_lumina = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Lumina')
        ->orderBy('nombre','ASC')
        ->get();

        return view('tienda_cosmica.productos_faciales', compact('products_lumina','products_lips','products_constelacion', 'products_espectro', 'products_lunar', 'products_mascarillas', 'products_nebulosa', 'products_pluton', 'products_solar', 'products_venus'));
    }

    public function productos_corporales(){

        $products_Estelar = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Estelar')
        ->orderBy('nombre','ASC')
        ->get();

        $products_Eclipse = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Eclipse')
        ->orderBy('nombre','ASC')
        ->get();

        $products_Galaxia = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Galaxia')
        ->orderBy('nombre','ASC')
        ->get();

        $products_Renacer = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Renacer')
        ->orderBy('nombre','ASC')
        ->get();

        $products_Flash = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Flash')
        ->orderBy('nombre','ASC')
        ->get();

        $products_Astros = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Astros')
        ->orderBy('nombre','ASC')
        ->get();

        $products_rose = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Rose Caviar')
        ->orderBy('nombre','ASC')
        ->get();

        $products_Esencia = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Esencia Vital')
        ->orderBy('nombre','ASC')
        ->get();

        $products_Pure = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->where('sublinea', 'Pure')
        ->orderBy('nombre','ASC')
        ->get();

        return view('tienda_cosmica.productos_corporales',compact('products_Galaxia','products_Pure','products_Estelar','products_Eclipse','products_Renacer','products_Flash','products_Astros','products_rose','products_Esencia'));
    }

    public function kits(){

        $products_kits = Products::orderBy('id','DESC')->where('categoria', '=', 'Cosmica')->where('subcategoria', '=', 'Kit')->orderby('nombre','asc')->where('estatus', '=', 'publicado')->get();

        return view('tienda_cosmica.kits', compact('products_kits'));
    }

    public function view_kit($id){

        $cotizacion = Products::find($id);
        $cotizacion_productos = ProductosBundleId::where('id_product', '=', $id)->where('price', '!=', NULL)->get();
        $products = Products::orderBy('nombre','ASC')->get();

        return view('tienda_cosmica.kits_view', compact('products', 'cotizacion', 'cotizacion_productos'));
    }

    public function buscar(Request $request) {
        $query = $request->get('query');
        $palabras = explode(' ', $query);

        $productos = Products::query();
        foreach ($palabras as $palabra) {
            $productos->where('nombre', 'LIKE', "%{$palabra}%");
        }

        // Obtener los productos con los campos necesarios
        $productos = $productos->where('categoria', '=', 'Cosmica')->where('subcategoria', '=', 'Producto')->limit(10)->get(['id', 'nombre', 'imagenes', 'precio_normal','slug']);

        // Retornar una vista parcial con los productos
        return view('tienda_cosmica.Components.buscador', compact('productos'));
    }

    public function buscarProductos(Request $request) {
        $query = $request->get('query');
        $palabras = explode(' ', $query);

        $products = Products::query();

        foreach ($palabras as $palabra) {
            $products->where('nombre', 'LIKE', "%{$palabra}%");
        }

        // Filtrar por categoría y subcategoría si es necesario
        $products = $products->where('categoria', 'Cosmica')
                               ->where('subcategoria', 'Producto')
                               ->get(['id', 'nombre', 'imagenes', 'precio_normal', 'slug']);

        return view('tienda_cosmica.Components.busqueda', compact('products', 'query'));
    }

    public function aviso(){

        return view('tienda_cosmica.aviso');
    }

    public function terminos(){

        return view('tienda_cosmica.terminos');

    }

}
