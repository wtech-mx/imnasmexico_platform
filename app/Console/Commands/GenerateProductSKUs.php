<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Products;

class GenerateProductSKUs extends Command
{
    protected $signature = 'products:generate-skus';
    protected $description = 'Genera códigos SKU aleatorios y únicos para todos los productos existentes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Obtener todos los productos sin SKU o con SKU nulo
        $products = Products::whereNull('sku')->orWhere('sku', '')->get();

        $this->info("Generando SKUs para {$products->count()} productos...");

        // Generar y asignar SKUs únicos
        foreach ($products as $product) {
            $sku = $this->generateUniqueSKU();

            $product->sku = $sku;
            $product->save();

            $this->info("SKU generado para el producto {$product->nombre}: {$sku}");
        }

        $this->info('¡SKUs generados exitosamente!');
    }

    // Función para generar un SKU único
    private function generateUniqueSKU()
    {
        do {
            // Generar un número aleatorio de 6 dígitos
            $sku = mt_rand(100000, 999999);
        } while (Products::where('sku', $sku)->exists()); // Verificar que el SKU sea único

        return $sku;
    }
}
