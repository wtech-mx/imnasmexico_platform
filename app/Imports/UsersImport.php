<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\Importable;

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
        return 'code'; // La columna code será utilizada para detectar duplicados
    }

    public function model(array $row)
    {
        // Crea un nuevo objeto User con los datos de la fila actual
        $user = new User([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'telefono'    => $row['telefono'],
            'username'    => $row['username'],
            'code'    => $row['code'],
            'password' => Hash::make($row['password']),
        ]);

        return $user;
    }
}
