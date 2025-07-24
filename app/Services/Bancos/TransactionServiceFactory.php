<?php
namespace App\Services\Bancos;

use App\Models\Bancos;
use App\Services\Bancos\TransactionServiceInterface;

class TransactionServiceFactory
{
    public static function make(Bancos $banco): TransactionServiceInterface
    {
        return match($banco->driver) {
            'mercadopago' => new MercadoPagoService($banco),
            'mercadopago_cosmica' => new MercadoPagoCosmicaService($banco),
            'stripe'      => new StripeService($banco),
            default       => throw new \Exception("Driver no soportado: {$banco->driver}"),
        };
    }
}
