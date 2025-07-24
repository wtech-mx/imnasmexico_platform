<?php
namespace App\Services\Bancos;

use Stripe\Stripe;
use Stripe\Charge;
use TransactionServiceInterface;

class StripeService implements TransactionServiceInterface
{
    protected $banco;

    public function __construct(\App\Models\Bancos $banco)
    {
        $this->banco = $banco;
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function fetchTransactions(): \Illuminate\Support\Collection
    {
        $charges = Charge::all([
            'limit' => 100,
            'created' => [
              'gte' => strtotime(date('Y-m-01')),
              'lte' => time(),
            ],
        ]);

        $entradas = collect($charges->data)
            ->map(fn($c) => [
                'id'          => $c->id,
                'fecha'       => date('Y-m-d H:i:s', $c->created),
                'descripcion' => $c->description,
                'entrada'     => $c->amount / 100, // Stripe en centavos
                'salida'      => null,
            ]);

        // Si Stripe tuviera reembolsos como “salidas”, añádelos aquí…
        $salidas = collect(); // o map de reembolsos

        return $entradas
            ->merge($salidas)
            ->sortBy(fn($row) => strtotime($row['fecha']))
            ->values();
    }
}
