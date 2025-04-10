<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MeliSeeder::class,
        ]);
        //  $this->call(CreateAdminUserSeeder::class);
        //  $this->call(PermissionTableSeeder::class);
        //  $this->call(CreateRolesHasPermissions::class);
        //  $this->call(ConfiguracionSeeder::class);
    }
}
