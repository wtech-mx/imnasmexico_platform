<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Str;

use Hash;

class UsersImport implements ToModel, WithHeadingRow,WithUpserts{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    use Importable;

    public function uniqueBy()
    {
        return 'telefono'; // La columna telefono será utilizada para detectar duplicados
        return 'email'; // La columna email será utilizada para detectar duplicados
    }

    public function model(array $row)
    {
        // Crea un nuevo objeto User con los datos de la fila actual
        $code = Str::random(8);
        $telefono_str = strval($row['telefono']);
        $user = new User([
            'code'      => $code,
            'name'      => $row['name'],
            'email'     => $row['email'],
            'telefono'  => $telefono_str,
            'username'  => $telefono_str,
            'cliente'   => $row['cliente'],
            'password'  => Hash::make($telefono_str,),
        ]);

        return $user;
    }
}
