<?php

namespace App\Imports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Str;

use Hash;

class ProductsImport implements ToModel, WithHeadingRow,WithUpserts{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    use Importable;

    public function uniqueBy()
    {
        // return 'telefono'; // La columna telefono será utilizada para detectar duplicados
        // return 'email'; // La columna email será utilizada para detectar duplicados
    }

    public function model(array $row)
    {
        // Crea un nuevo objeto User con los datos de la fila actual
        $user = new Products([
            'nombre'      => $row['nombre'],
            'descripcion'     => $row['descripcion'],
            'precio_rebajado'  => $row['precio_rebajado'],
            'precio_normal'     => $row['precio_normal'],
            'imagenes'  => $row['imagenes'],
        ]);

        return $user;
    }
}
