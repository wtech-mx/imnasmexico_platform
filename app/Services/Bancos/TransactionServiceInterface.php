<?php
namespace App\Services\Bancos;

use Illuminate\Support\Collection;

interface TransactionServiceInterface
{
    /**
     * Obtiene una colección de transacciones:
     * [
     *   ['id'=>..., 'fecha'=>..., 'descripcion'=>..., 'entrada'=>..., 'salida'=>...],
     *   …
     * ]
     */
    public function fetchTransactions(): Collection;
}
