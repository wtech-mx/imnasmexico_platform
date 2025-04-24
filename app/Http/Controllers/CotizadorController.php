<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categorias;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
class CotizadorController extends Controller
{
    public function index()
    {
        // Traemos las categorías
        $categoriasFacial = Categorias::where('linea', '=', 'facial')->orderBy('id','DESC')->get();
        $categoriasCorporal = Categorias::where('linea', '=', 'corporal')->orderBy('id','DESC')->get();

        // Añadimos un atributo dinámico para contar los productos de cada categoría
        foreach ($categoriasFacial as $cat) {
            $cat->productos_count = Products::where('id_categoria', $cat->id)->orWhere('id_categoria2', $cat->id)->count();
        }

        foreach ($categoriasCorporal as $cat) {
            $cat->productos_count = Products::where('id_categoria', $cat->id)->orWhere('id_categoria2', $cat->id)->count();
        }

        return view('cotizador.index', compact('categoriasFacial', 'categoriasCorporal'));
    }

    public function index_cosmica()
    {
        // Productos faciales
        $faciales = Products::where('linea', 'Facial')
            ->where('categoria', 'Cosmica')
            ->where('subcategoria', 'Producto')
            ->get()
            ->groupBy('sublinea');

        $categoriasFacial = $faciales->map(function ($productos, $sublinea) {
            return (object) [
                'id' => Str::slug($sublinea), // Puedes ajustar esto según lo que necesites como ID
                'nombre' => $sublinea,
                'imagen' => 'default.jpg', // Asignar imagen por defecto o lógica según sublinea
                'productos_count' => $productos->count(),
            ];
        })->values();

        // Productos corporales
        $corporales = Products::where('linea', 'Corporal')
            ->where('categoria', 'Cosmica')
            ->where('subcategoria', 'Producto')
            ->get()
            ->groupBy('sublinea');

        $categoriasCorporal = $corporales->map(function ($productos, $sublinea) {
            return (object) [
                'id' => Str::slug($sublinea),
                'nombre' => $sublinea,
                'imagen' => 'default.jpg',
                'productos_count' => $productos->count(),
            ];
        })->values();

        return view('cotizador.index_cosmica', compact('categoriasFacial', 'categoriasCorporal'));
    }

    public function mostrarProductosCategoria($id)
    {
        $productos = Products::query();

        $productos->where('categoria', 'NAS')
                  ->where('subcategoria', 'Producto');

        $productos->where(function ($query) use ($id) {
            $query->where('id_categoria', $id)
                  ->Where('id_categoria2', $id);
        });

        $productos = $productos->orderBy('nombre', 'ASC')->get();

        return view('cotizador.productos_categoria', compact('productos'));
    }

    public function mostrarProductosCategoriaCosmica($id)
    {
        $productos = Products::query();

        $productos->where('categoria', 'Cosmica')
                  ->where('subcategoria', 'Producto');

        $productos->where(function ($query) use ($id) {
            $query->where('sublinea', $id);
        });

        $productos = $productos->orderBy('nombre', 'ASC')->get();

        return view('cotizador.productos_categoria', compact('productos'));
    }

    public function buscar(Request $request)
    {
        $query = Str::lower($this->removeAccents($request->get('query', '')));
        $palabras = explode(' ', $query);

        $productos = Products::query();

        $productos->where('categoria', 'NAS')
                  ->where('subcategoria', '=', 'Producto');

        $productos->where(function($subQuery) use ($palabras) {
            foreach ($palabras as $palabra) {
                $variantes = $this->generarVariantesSingularPlural($palabra);

                foreach ($variantes as $variante) {
                    $subQuery->orWhereRaw("
                        LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) LIKE ?
                    ", ["%{$variante}%"]);
                }
            }
        });

        $productos = $productos->limit(40)->get();

        return view('cotizador.productos_categoria', compact('productos'));
    }


    private function removeAccents($string)
    {
        return strtr($string, [
            'á'=>'a', 'é'=>'e', 'í'=>'i', 'ó'=>'o', 'ú'=>'u',
            'Á'=>'A', 'É'=>'E', 'Í'=>'I', 'Ó'=>'O', 'Ú'=>'U',
            'ñ'=>'n', 'Ñ'=>'N', 'ü'=>'u', 'Ü'=>'U'
        ]);
    }
    private function generarVariantesSingularPlural($palabra)
    {
        $variantes = [$palabra];

        // Muy básico pero funcional para español (puedes mejorarlo)
        if (Str::endsWith($palabra, 'es')) {
            $singular = substr($palabra, 0, -2);
            $variantes[] = $singular;
        } elseif (Str::endsWith($palabra, 's')) {
            $singular = substr($palabra, 0, -1);
            $variantes[] = $singular;
        } else {
            $variantes[] = $palabra . 's';
            $variantes[] = $palabra . 'es';
        }

        return array_unique($variantes);
    }

    public function renderizarItemCarrito(Request $request)
    {
        $producto = $request->input('producto'); // Este será un array con los datos

        return view('cotizador.item_carrito', compact('producto'))->render();
    }


}
