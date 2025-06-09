<?php

namespace App\Http\Controllers;

use App\Models\Ordenes;
use App\Models\Productos;
use App\Models\OrdenesProductos;
use App\Models\Facturas;
use App\Models\NotasProductos;
use DOMDocument;
use Illuminate\Http\Request;
use Milon\Barcode\DNS2D;
use Milon\Barcode\QRcode;
use Fpdf\Fpdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MultiFacturaNasController extends Controller
{

    protected string $usuario;
    protected string $pass;
    protected string $passRfc;
    protected string $b64Cer;
    protected string $b64Key;
    protected string   $produccion;
    protected string   $rfc_receptor;
    protected string   $nombreRazonReceptor;
    protected string   $DomicilioFiscalReceptor;
    protected string   $RegimenFiscalReceptor;
    protected string   $UsoCFDI;
    protected string   $rfc_emisor;
    protected string   $nombreRazonEmisor;

    public function __construct()
    {
        $host = request()->getHost();

        // if (Str::contains($host, 'zocofresh.com')) {
        //     // —— Credenciales de ZocoFresh (producción) ——
        //     $this->usuario    = 'ZFR2306262N7';
        //     $this->pass       = 'ZFR2306262N7';
        //     $this->passRfc    = 'Tonatico1+';
        //     $this->b64Cer     = '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';  // tu cert
        //     $this->b64Key     = 'MIIFDjBABgkqhkiG9w0BBQ0wMzAbBgkqhkiG9w0BBQwwDgQIAgEAAoIBAQACAggAMBQGCCqGSIb3DQMHBAgwggS+AgEAMASCBMggwSL87OPirKEM4ZbjtQ/YOTkWxY6nBGBsF8ym5FDhr7DaXJ+VZEvVAutCsw+4EFQ+A4BfaBf4cYIZ5/FcIzmcj3rdhwCYCtSCN50bnt3+74FGEwxxa/cHpiqQyK70Gu8N/3g2iZF0NvwxN7LzsgbA4QD3NJ3SGxNJJeeidQs9zI5DcJ8+zJyjoWC7mbskqujRKNLiWvzw/g7Xiis+GsVzvVSp1hIBrlmYiwJ6+wLgG8xKpR5uA72qWo6d0iUSROD9GxJ08P38nxHhX2atmGD1fqTUwxV/W7Hj8vWDBoWbunhYn0uNQokxairL/yz+pK4G4zje+xlF8U8vTxZ3CXHkeLEIeTbojcwFDHPSYVzKmICZE+JMBDdUFe626WbPrrDchM5bMJU2myPF26JaGHasu0vBlWTHfgZ38FuVYwzJBr8h3YiC/oM1jEWPO52faVa29rOlxsAPd7OtpJJjQRzh4FkS0WRXqv7BfwdPzyyS95/RbVkWiFoiX9kaXHF/Z26Hn8kiKBeN16lgiRhfuWBnQTUIYAP47cPnVpOe+YZUR34Fd6aS0kj84wN8peu7HfATeIgzRFd5H42OqXxuO/F9rCk3aNB6kC9D4BQdKeFw8oRyzQhKn8fOKwSu8n0T1UQG4W+v8TunWRh7ecCf5VTmiv1U/CHXw3yJZzBweumEmrD27ZSbGnINKvXGd3LOcv9WaiOWZj+gHlDdaf1oEdyjT73JJphlgmcLRL8TrfN15X8l1pVUatHyx/YwsE579B4YbXLXgjuuvT7O0y/yl4nJ92PzmLZgoEL5vXJAOmbZFYCYthSSMo6kpUj8V0WXYOKpfzDUrMaD94pZBfRKDOxSOC6+igZucddi8NV/GgY5sdPL2iRA6KyOC26+L5w/avxQHujW9dMXnXr1zXICaUG1+Ro2BmdZ+a9SHO0MF2HSeGvKlDNLubqik3V84QpMtP5YFZGg0wJbujsEsp5bn81KXmxalKVlCmKIXN7qbjKcBhi8dNZCguCXoL4zEJI0ky0/1ZDpycUwHWDdswj0AOufB4/uxU3SbkLdV50/L8PQHR0eWZushjZPpBoKrz8flvXAdGdwG/0CPQVE72EcNulv9+6G1iHII4aZjaJbjX6DsoHEye1VxF1S/SVFpHfoYROcKV8b6dRDK8t2iCKGWMrwxK6kEQJ2Q4S1/Jg7hUPXWkGe+OA2HrYdS0h7UzNmo7X2hp9Ow5O1ZXwTWHGHCI00uyP4FgwN6mI3c9WniozBN7KH+zA/RTsPLK7O3L6U3jn6Lck7IWbCjFC1ofhG7qXYWjciQFLPbi3AhKrqWB6NS/OGFttURYWP1GUxbY/kjCH71xIgEdzOGFO6jGock9Ypi6RJrFKm60xENHOKBp11RFaSfK+oDKS0Xenhe0AZOR+kiaTkSWis/kTM9A56ezCZu8Thn4bBnkPwXpHcqu9aA1Y1LtCR9cZPUJl8F/YMBbFsW/kgq7+OTGlFfEyl2R5X4QtZJZ+hQuNJ1F5ujCPKPh7m1GdVpjKOxfFKuGsPpsrR6Jg0mDVnWkUPDQbm4A2ebgmg5H1cfT+EncwKdBxo5Kxsx7WBynSpx82oxDbshVdqsouYe9nWtMytpTa/KZuV+XbCCvO7pGg=';  // tu key
        //     $this->produccion = 'SI';

        //     $this->rfc_receptor = 'XAXX010101000';
        //     $this->nombreRazonReceptor = 'PUBLICO GENERAL';

        //     $this->DomicilioFiscalReceptor = '06700';
        //     $this->RegimenFiscalReceptor = '616';
        //     $this->UsoCFDI = 'S01';

        //     $this->rfc_emisor = 'ZFR2306262N7';
        //     $this->nombreRazonEmisor = 'ZOCO FRESH';

        // } else {
            // —— Credenciales de DEMO (entorno local/pruebas) ——
            $this->usuario    = 'DEMO700101XXX';
            $this->pass       = 'DEMO700101XXX';
            $this->passRfc    = '12345678a';
            $this->b64Cer     = 'MIIFsDCCA5igAwIBAgIUMzAwMDEwMDAwMDA1MDAwMDM0MTYwDQYJKoZIhvcNAQELBQAwggErMQ8wDQYDVQQDDAZBQyBVQVQxLjAsBgNVBAoMJVNFUlZJQ0lPIERFIEFETUlOSVNUUkFDSU9OIFRSSUJVVEFSSUExGjAYBgNVBAsMEVNBVC1JRVMgQXV0aG9yaXR5MSgwJgYJKoZIhvcNAQkBFhlvc2Nhci5tYXJ0aW5lekBzYXQuZ29iLm14MR0wGwYDVQQJDBQzcmEgY2VycmFkYSBkZSBjYWxpejEOMAwGA1UEEQwFMDYzNzAxCzAJBgNVBAYTAk1YMRkwFwYDVQQIDBBDSVVEQUQgREUgTUVYSUNPMREwDwYDVQQHDAhDT1lPQUNBTjERMA8GA1UELRMIMi41LjQuNDUxJTAjBgkqhkiG9w0BCQITFnJlc3BvbnNhYmxlOiBBQ0RNQS1TQVQwHhcNMjMwNTE4MTE0MzUxWhcNMjcwNTE4MTE0MzUxWjCB1zEnMCUGA1UEAxMeRVNDVUVMQSBLRU1QRVIgVVJHQVRFIFNBIERFIENWMScwJQYDVQQpEx5FU0NVRUxBIEtFTVBFUiBVUkdBVEUgU0EgREUgQ1YxJzAlBgNVBAoTHkVTQ1VFTEEgS0VNUEVSIFVSR0FURSBTQSBERSBDVjElMCMGA1UELRMcRUtVOTAwMzE3M0M5IC8gVkFEQTgwMDkyN0RKMzEeMBwGA1UEBRMVIC8gVkFEQTgwMDkyN0hTUlNSTDA1MRMwEQYDVQQLEwpTdWN1cnNhbCAxMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtmecO6n2GS0zL025gbHGQVxznPDICoXzR2uUngz4DqxVUC\/w9cE6FxSiXm2ap8Gcjg7wmcZfm85EBaxCx\/0J2u5CqnhzIoGCdhBPuhWQnIh5TLgj\/X6uNquwZkKChbNe9aeFirU\/JbyN7Egia9oKH9KZUsodiM\/pWAH00PCtoKJ9OBcSHMq8Rqa3KKoBcfkg1ZrgueffwRLws9yOcRWLb02sDOPzGIm\/jEFicVYt2Hw1qdRE5xmTZ7AGG0UHs+unkGjpCVeJ+BEBn0JPLWVvDKHZAQMj6s5Bku35+d\/MyATkpOPsGT\/VTnsouxekDfikJD1f7A1ZpJbqDpkJnss3vQIDAQABox0wGzAMBgNVHRMBAf8EAjAAMAsGA1UdDwQEAwIGwDANBgkqhkiG9w0BAQsFAAOCAgEAFaUgj5PqgvJigNMgtrdXZnbPfVBbukAbW4OGnUhNrA7SRAAfv2BSGk16PI0nBOr7qF2mItmBnjgEwk+DTv8Zr7w5qp7vleC6dIsZFNJoa6ZndrE\/f7KO1CYruLXr5gwEkIyGfJ9NwyIagvHHMszzyHiSZIA850fWtbqtythpAliJ2jF35M5pNS+YTkRB+T6L\/c6m00ymN3q9lT1rB03YywxrLreRSFZOSrbwWfg34EJbHfbFXpCSVYdJRfiVdvHnewN0r5fUlPtR9stQHyuqewzdkyb5jTTw02D2cUfL57vlPStBj7SEi3uOWvLrsiDnnCIxRMYJ2UA2ktDKHk+zWnsDmaeleSzonv2CHW42yXYPCvWi88oE1DJNYLNkIjua7MxAnkNZbScNw01A6zbLsZ3y8G6eEYnxSTRfwjd8EP4kdiHNJftm7Z4iRU7HOVh79\/lRWB+gd171s3d\/mI9kte3MRy6V8MMEMCAnMboGpaooYwgAmwclI2XZCczNWXfhaWe0ZS5PmytD\/GDpXzkX0oEgY9K\/uYo5V77NdZbGAjmyi8cE2B2ogvyaN2XfIInrZPgEffJ4AB7kFA2mwesdLOCh0BLD9itmCve3A1FGR4+stO2ANUoiI3w3Tv2yQSg4bjeDlJ08lXaaFCLW2peEXMXjQUk7fmpb5MNuOUTW6BE=';  // tu cert de demo
            $this->b64Key     = 'MIIFDjBABgkqhkiG9w0BBQ0wMzAbBgkqhkiG9w0BBQwwDgQIAgEAAoIBAQACAggAMBQGCCqGSIb3DQMHBAgwggS\/AgEAMASCBMh4EHl7aNSCaMDA1VlRoXCZ5UUmqErAbucoZQObOaLUEm+I+QZ7Y8Giupo+F1XWkLvAsdk\/uZlJcTfKLJyJbJwsQYbSpLOCLataZ4O5MVnnmMbfG\/\/NKJn9kSMvJQZhSwAwoGLYDm1ESGezrvZabgFJnoQv8Si1nAhVGTk9FkFBesxRzq07dmZYwFCnFSX4xt2fDHs1PMpQbeq83aL\/PzLCce3kxbYSB5kQlzGtUYayiYXcu0cVRu228VwBLCD+2wTDDoCmRXtPesgrLKUR4WWWb5N2AqAU1mNDC+UEYsENAerOFXWnmwrcTAu5qyZ7GsBMTpipW4Dbou2yqQ0lpA\/aB06n1kz1aL6mNqGPaJ+OqoFuc8Ugdhadd+MmjHfFzoI20SZ3b2geCsUMNCsAd6oXMsZdWm8lzjqCGWHFeol0ik\/xHMQvuQkkeCsQ28PBxdnUgf7ZGer+TN+2ZLd2kvTBOk6pIVgy5yC6cZ+o1Tloql9hYGa6rT3xcMbXlW+9e5jM2MWXZliVW3ZhaPjptJFDbIfWxJPjz4QvKyJk0zok4muv13Iiwj2bCyefUTRz6psqI4cGaYm9JpscKO2RCJN8UluYGbbWmYQU+Int6LtZj\/lv8p6xnVjWxYI+rBPdtkpfFYRp+MJiXjgPw5B6UGuoruv7+vHjOLHOotRo+RdjZt7NqL9dAJnl1Qb2jfW6+d7NYQSI\/bAwxO0sk4taQIT6Gsu\/8kfZOPC2xk9rphGqCSS\/4q3Os0MMjA1bcJLyoWLp13pqhK6bmiiHw0BBXH4fbEp4xjSbpPx4tHXzbdn8oDsHKZkWh3pPC2J\/nVl0k\/yF1KDVowVtMDXE47k6TGVcBoqe8PDXCG9+vjRpzIidqNo5qebaUZu6riWMWzldz8x3Z\/jLWXuDiM7\/Yscn0Z2GIlfoeyz+GwP2eTdOw9EUedHjEQuJY32bq8LICimJ4Ht+zMJKUyhwVQyAER8byzQBwTYmYP5U0wdsyIFitphw+\/IH8+v08Ia1iBLPQAeAvRfTTIFLCs8foyUrj5Zv2B\/wTYIZy6ioUM+qADeXyo45uBLLqkN90Rf6kiTqDld78NxwsfyR5MxtJLVDFkmf2IMMJHTqSfhbi+7QJaC11OOUJTD0v9wo0X\/oO5GvZhe0ZaGHnm9zqTopALuFEAxcaQlc4R81wjC4wrIrqWnbcl2dxiBtD73KW+wcC9ymsLf4I8BEmiN25lx\/OUc1IHNyXZJYSFkEfaxCEZWKcnbiyf5sqFSSlEqZLc4lUPJFAoP6s1FHVcyO0odWqdadhRZLZC9RCzQgPlMRtji\/OXy5phh7diOBZv5UYp5nb+MZ2NAB\/eFXm2JLguxjvEstuvTDmZDUb6Uqv++RdhO5gvKf\/AcwU38ifaHQ9uvRuDocYwVxZS2nr9rOwZ8nAh+P2o4e0tEXjxFKQGhxXYkn75H3hhfnFYjik\/2qunHBBZfcdG148MaNP6DjX33M238T9Zw\/GyGx00JMogr2pdP4JAErv9a5yt4YR41KGf8guSOUbOXVARw6+ybh7+meb7w4BeTlj3aZkv8tVGdfIt3lrwVnlbzhLjeQY6PplKp3\/a5Kr5yM0T4wJoKQQ6v3vSNmrhpbuAtKxpMILe8CQoo=';  // tu key de demo
            $this->produccion = 'NO';

            // Datos de MODO PRUEBAS
            $this->rfc_receptor = 'SOHM7509289MA';
            $this->nombreRazonReceptor = 'MIGUEL ANGEL SOSA HERNANDEZ';

            $this->DomicilioFiscalReceptor = '27054';
            $this->RegimenFiscalReceptor = '612';
            $this->UsoCFDI = 'G01';

            $this->rfc_emisor = 'EKU9003173C9';
            $this->nombreRazonEmisor = 'ESCUELA KEMPER URGATE';

        // }
    }

    public function CFDI_facturaDeContado($id_orden)
    {

        $orden = NotasProductos::with(['User', 'ProductosNotasId.Productos'])->find($id_orden);

        if (!$orden) {
            return ['success' => false, 'message' => 'Orden no encontrada'];
        }

        $conceptos = [];
        $subtotalFactura = 0.00;
        $totalImpuestos = 0.00;
        $impuestosGlobales = [];
        $mapaTraslados = [];
        $sumaIva = 0;
        $totalDescuentos = 0;

        // Recorrer los productos de la orden
        foreach ($orden->ProductosNotasId as $op) {
            $producto           = $op->Productos;
            $precioConImpuesto  = (float) $producto->precio_normal;
            if ($op->Productos->categoria == 'NAS') {
                $ivaPct = 0;
            }else{
                $ivaPct = 16;
            }
            $descPct = (float) ($op->descuento ?? 0);

            // 1) Extraer neto de impuestos
            $totalPct = $ivaPct;
            if ($op->descuento != NULL && $op->descuento > 0) {
                $factor     = 1 / (1 + $totalPct/100);
                $precioNeto = round($precioConImpuesto * $factor, 2);
            } else {
                $precioNeto = $precioConImpuesto;
            }

            $cantidad       = (float) $op->cantidad;
            // 2) Base antes de descuento
            $importeBruto   = round($precioNeto * $cantidad, 2);
            // 3) Monto del descuento
            $montoDescuento = round($importeBruto * ($descPct/100), 2);
            $totalDescuentos += $montoDescuento;
            // 4) Importe NETO ya con descuento
            $importeNeto   = round($importeBruto - $montoDescuento, 2);

            // 5) Acumular netos en subtotal
            $subtotalFactura += $importeBruto;

            // 6) Impuestos sobre el neto
            $ivaImporte   = round($importeNeto * $ivaPct  / 100, 2);
            $totalImpuestos += $ivaImporte;
            $sumaIva       += $ivaImporte;

            // 7) Construir traslados
            $traslados = [];
            if ($ivaImporte  > 0) $traslados[] = [
                "Base"       => $importeNeto,
                "Impuesto"   => "002",
                "TipoFactor" => "Tasa",
                "TasaOCuota" => number_format($ivaPct/100, 6, '.', ''),
                "Importe"    => $ivaImporte,
            ];
            if (count($traslados) === 0) {
                $traslados[] = [
                    "Base"       => $importeNeto,
                    "Impuesto"   => "002",
                    "TipoFactor" => "Tasa",
                    "TasaOCuota" => "0.000000",
                    "Importe"    => 0.00,
                ];
            }

            // 8) Formateos finales
            $montoDescuentoFormateado = number_format($montoDescuento, 2, '.', '');
            $importeFormateado        = number_format($importeBruto,   2, '.', '');

            // 9) Agregar concepto
            $concepto = [
                "cantidad"      => $cantidad,
                "unidad"        => $producto->unidad_venta   ?? 'NA',
                "ID"            => $producto->id,
                "descripcion"   => $producto->nombre,
                "valorunitario" => $producto->precio_normal,
                "importe"       => $importeFormateado,
                "ClaveProdServ" => '53131619',
                "ClaveUnidad"   => 'H87',
                "ObjetoImp"     => "02",
                "Impuestos"     => ["Traslados" => $traslados],
            ];

            if ($montoDescuento > 0) {
                $concepto["Descuento"] = number_format($montoDescuentoFormateado, 2, '.', '');
            }

            $conceptos[] = $concepto;
        }

        // Agrupamos por combinación: impuesto|tasa
        foreach ($conceptos as $c) {
            if (!isset($c['Impuestos']['Traslados'])) continue;

            foreach ($c['Impuestos']['Traslados'] as $t) {
                $clave = $t['Impuesto'] . '|' . $t['TasaOCuota'] . '|' . $t['TipoFactor'];

                if (!isset($mapaTraslados[$clave])) {
                    $mapaTraslados[$clave] = [
                        'Base' => 0,
                        'importe' => 0,
                        'impuesto' => $t['Impuesto'],
                        'tasa' => $t['TasaOCuota'],
                        'TipoFactor' => $t['TipoFactor'],
                    ];
                }

                $mapaTraslados[$clave]['Base'] += round($t['Base'], 2);
                $mapaTraslados[$clave]['importe'] += round($t['Importe'], 2);
            }
        }

        // Convertir a formato global
        foreach ($mapaTraslados as $t) {
            $impuestosGlobales[] = [
                'Base' => round($t['Base'], 2),
                'impuesto' => $t['impuesto'],
                'tasa' => $t['tasa'],
                'importe' => round($t['importe'], 2),
                'TipoFactor' => $t['TipoFactor'],
            ];
        }

        $totalDescuentosFormateado = number_format($totalDescuentos, 2, '.', '');
        // ⚙️ Armar el JSON completo

        $rfc_emisor = $this->rfc_emisor;
        $nombreRazonEmisor = $this->nombreRazonEmisor;


        // if($orden->factura == 'No'){

            // Datos de MODO PRUEBAS
            $rfc_receptor = $this->rfc_receptor;
            $nombreRazonReceptor = $this->nombreRazonReceptor;

            $DomicilioFiscalReceptor = $this->DomicilioFiscalReceptor;
            $RegimenFiscalReceptor = $this->RegimenFiscalReceptor;
            $UsoCFDI = $this->UsoCFDI;

        // }else{
        //     $rfc_receptor = $orden->Factura->rfc;
        //     $nombreRazonReceptor = $orden->Factura->razon_social;

        //     $DomicilioFiscalReceptor = $orden->Factura->codigo_postal;
        //     $RegimenFiscalReceptor = $orden->Factura->regimen_fiscal;
        //     $UsoCFDI = $orden->Factura->cfdi;
        // }


        $json_factura = [
            "version_cfdi" => "4.0",
            "validacion_local" => "NO",
            "PAC" => [
                "usuario" =>  $this->usuario,
                "pass" =>  $this->pass,
                "produccion" =>   $this->produccion,
            ],
            "conf" => [
                "cer" => $this->b64Cer,
                "key" => $this->b64Key,
                "pass" => $this->passRfc,
            ],
            "factura" => [
                "condicionesDePago" => "Contado",
                "fecha_expedicion" => "AUTO",
                "folio" =>  "100",
                "forma_pago" => "01",
                "LugarExpedicion" => "06700",
                "metodo_pago" => "PUE",
                "moneda" => "MXN",
                "serie" => "A",
                "subtotal"  => number_format($subtotalFactura,   2, '.', ''),
                "descuento" => number_format($totalDescuentos,  2, '.', ''),
                "total" => number_format($subtotalFactura - $totalDescuentos + $totalImpuestos, 2, '.', ''),
                "tipocambio" => 1,
                "tipocomprobante" => "E",
                "Exportacion" => "01"
            ],
            "emisor" => [
                "rfc" =>  $rfc_emisor,
                "nombre" =>  $nombreRazonEmisor,
                "RegimenFiscal" => "601"
            ],
            "receptor" => [
                "rfc" =>  $rfc_receptor,
                "nombre" =>  $nombreRazonReceptor,
                "UsoCFDI" => $UsoCFDI,
                "DomicilioFiscalReceptor" => $DomicilioFiscalReceptor,
                "RegimenFiscalReceptor" => $RegimenFiscalReceptor,
            ],
            "conceptos" => $conceptos,
            "impuestos" => [
                "TotalImpuestosTrasladados" => array_sum(array_column($impuestosGlobales, 'importe')),
                "translados" => $impuestosGlobales
            ]
        ];

        // Enviar a API de MultiFacturas
        $response = Http::asForm()
        ->withOptions(['verify' => false]) // ⛔ Desactiva validación SSL
        ->post('https://ws.multifacturas.com/api/', [
            'json' => json_encode($json_factura),
            'modo' => 'JSON'
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $factura = [
                'folio' => $data['uuid'],
                'fecha_timbrado' => $data['representacion_impresa_fecha_timbrado'][0] ?? '',
                'certificadoSAT' => $data['representacion_impresa_certificadoSAT'][0] ?? '',
                'certificadoCFDI' => $data['representacion_impresa_certificado_no'] ?? '',
                'selloCFDI' => $data['representacion_impresa_sello'][0] ?? '',
                'selloSAT' => $data['representacion_impresa_selloSAT'][0] ?? '',
                'qr' => $data['png'],
                'conceptos' => $json_factura['conceptos'],
                'subtotal' => $json_factura['factura']['subtotal'],
                'total' => $json_factura['factura']['total'],
                'forma_pago' => $json_factura['factura']['forma_pago'],
                'metodo_pago' => $json_factura['factura']['metodo_pago'],
                'receptor' => $json_factura['receptor'],
                'emisor' => $json_factura['emisor'],
                'uso_cfdi' => $json_factura['receptor']['UsoCFDI'] ?? '',
                'cadena_original' => $data['representacion_impresa_cadena'] ?? '',
                'sumaIva' => $sumaIva,
                'descuento' => $totalDescuentos,
            ];

             $pdf = \PDF::loadView('admin.facturas.pdf_multifactura', compact('factura'));

            // Guarda en public/facturas_pdf/factura_cfdi_UUID.pdf
            $nombreArchivo = 'factura_cfdi_' . $data['uuid'] . '.pdf';
            $ruta = public_path('facturas_pdf/' . $nombreArchivo);
            try {
                $pdf->save($ruta);

                return [
                    'success' => true,
                    'uuid' => $data['uuid'],
                ];

            } catch (\Exception $e) {
                \Log::error('Error al guardar PDF: ' . $e->getMessage());
                return false;
            }

        }else {
            return ['error' => true, 'mensaje' => $response->body()];
        }
    }

    public function cancelCFDI(Request $request, $id_orden)
    {
        $factura = Facturas::findOrFail($id_orden);
        $orden = Ordenes::findOrFail($factura->id_orden);

        // Extraer UUID desde archivo_factura
        $archivo = $factura->archivo_factura;

        if (!$archivo || !Str::startsWith($archivo, 'factura_cfdi_') || !Str::endsWith($archivo, '.pdf')) {
            return back()->withErrors('No se pudo obtener el UUID desde el nombre del archivo.');
        }

        $uuid = str_replace(['factura_cfdi_', '.pdf'], '', $archivo);

        $payload = [
            "PAC" => [
            "usuario" => $this->usuario,
            "pass" => $this->pass,
        ],
            "modulo" => "cancelacion2022",
            "accion" => "cancelar",
            "produccion" => $this->produccion,
            "uuid" => $uuid,
            "rfc" => $this->usuario,
            "password" =>  $this->passRfc,
            "motivo" => "02",
            "b64Cer" =>  $this->b64Cer,
            "b64Key" =>  $this->b64Key,
        ];

        // 2) Llamar al endpoint
        $response = Http::asForm()
            ->withOptions(['verify' => false])
            ->post('https://ws.multifacturas.com/api/cancelarCfdi.php', [
                'json' => json_encode($payload),
                'modo' => 'JSON',
            ]);

        if (! $response->successful()) {
            return back()
                ->withErrors('No se pudo cancelar la factura: '.$response->body());
        }

        $data = $response->json();

        if (($data['codigo_mf_numero'] ?? -1) !== 0) {
            // la API devolvió un error de negocio
            return back()
                ->withErrors('Error al cancelar: '.$data['codigo_mf_texto'] ?? $data['mensaje'] ?? 'Desconocido');
        }

        // 3) Marcar la orden como cancelada en la BD
        $factura->estatus = 'Cancelado';
        $factura->save();

        $orden->cancelada = 'SI';
        $orden->save();

        return back()->with('success', 'Factura cancelada correctamente.');
    }

}
