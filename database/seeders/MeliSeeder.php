<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('meli')->insert([
            'app_id' => '4791982421745244',
            'client_secret' => 'QDjLYIwGbfAYnq6kgJeVO93pYTRyMuP8',
            'link_renovacion_token' => 'https://auth.mercadolibre.com.mx/authorization?response_type=code&client_id=4791982421745244&redirect_uri=https://plataforma.imnasmexico.com/mercado_libre_api',
            'accesstoken' => null,
            'autorizacion' => null,
            'sellerId' => '2084225921',
            'user_id' => '2084225921',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
