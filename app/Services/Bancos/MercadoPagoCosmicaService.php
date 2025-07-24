<?php
namespace App\Services\Bancos;

use MercadoPago\SDK;
use Carbon\Carbon;
use App\Services\Bancos\TransactionServiceInterface;

class MercadoPagoCosmicaService implements TransactionServiceInterface
{
    protected $banco;

    public function __construct(\App\Models\Bancos $banco)
    {
        $this->banco = $banco;
        SDK::setAccessToken(config('services.mercadopago_secundario.token'));
    }

    public function fetchTransactions(): \Illuminate\Support\Collection
    {
       $today            = date('Y-m-d');
        $startOfMonth     = date('Y-m-01');
        $filters = [
            'status'     => 'approved',
            'begin_date' => "{$startOfMonth}T00:00:00.000-00:00",
            'end_date'   => "{$today}T23:59:59.999-00:00",
            'limit'      => 100,
            'offset'     => 0,
        ];

        $pagos           = [];
        $comprasSinEmail = [];

        do {
            $searchResult = \MercadoPago\Payment::search($filters);
            $results      = $searchResult->getArrayCopy();

            foreach ($results as $pago) {
                if (empty($pago->payer->email)) {
                    $comprasSinEmail[] = $pago;
                } else {
                    $pagos[] = $pago;
                }
            }

            $filters['offset'] += $filters['limit'];
        } while (count($results) > 0);

        $entradas = collect($pagos)
            ->map(fn($pago) => [
                'id'          => $pago->id,
                'fecha'       => $pago->date_approved,
                'descripcion' => $pago->description,
                'entrada'     => $pago->transaction_amount,
                'salida'      => null,
            ]);

        $salidas = collect($comprasSinEmail)
            ->map(fn($pago) => [
                'id'          => $pago->id,
                'fecha'       => $pago->date_approved,
                'descripcion' => $pago->description,
                'entrada'     => null,
                'salida'      => $pago->transaction_amount,
            ]);

        return $entradas
            ->merge($salidas)
            ->sortBy(fn($row) => strtotime($row['fecha']))
            ->values();
    }
}
