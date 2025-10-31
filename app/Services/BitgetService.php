<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BitgetService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.bitget.base_url', 'https://api.bitget.com');
    }

    /**
     * Obtener el balance de la cuenta
     */
    public function getAccountBalance($account)
    {
        // Si está en modo demo, retornar datos de ejemplo
        if ($account->is_demo) {
            return $this->getDemoBalance();
        }

        try {
            $endpoint = '/api/v2/spot/account/assets';
            $timestamp = $this->getTimestamp();
            $method = 'GET';

            $signature = $this->generateSignature($timestamp, $method, $endpoint, '', $account->secret_key);

            // LOG: Petición a Bitget
            Log::info('🔵 Iniciando petición a Bitget API', [
                'url' => $this->baseUrl . $endpoint,
                'timestamp' => $timestamp,
                'api_key' => substr($account->api_key, 0, 10) . '...'
            ]);

            $response = Http::withHeaders([
                'ACCESS-KEY' => $account->api_key,
                'ACCESS-SIGN' => $signature,
                'ACCESS-TIMESTAMP' => $timestamp,
                'ACCESS-PASSPHRASE' => $account->passphrase,
                'Content-Type' => 'application/json',
                'locale' => 'es-ES'
            ])->get($this->baseUrl . $endpoint);

            // LOG: Respuesta de Bitget
            Log::info('✅ Respuesta de Bitget API', [
                'status' => $response->status(),
                'success' => $response->successful(),
                'data_count' => count($response->json()['data'] ?? [])
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['code']) && $data['code'] === '00000') {
                    return [
                        'success' => true,
                        'data' => $data['data'] ?? [],
                        'message' => 'Balance obtenido exitosamente'
                    ];
                }

                return [
                    'success' => false,
                    'data' => [],
                    'message' => $data['msg'] ?? 'Error desconocido'
                ];
            }

            Log::error('Error al obtener balance de Bitget', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return [
                'success' => false,
                'data' => [],
                'message' => 'Error al comunicarse con la API de Bitget'
            ];

        } catch (\Exception $e) {
            Log::error('Excepción al obtener balance de Bitget: ' . $e->getMessage());

            return [
                'success' => false,
                'data' => [],
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Obtener datos de demostración
     */
    protected function getDemoBalance()
    {
        return [
            'success' => true,
            'data' => [
                [
                    'coin' => 'BTC',
                    'available' => '0.50000000',
                    'frozen' => '0.00000000',
                    'usdtValue' => '34250.00'
                ],
                [
                    'coin' => 'ETH',
                    'available' => '5.25000000',
                    'frozen' => '0.50000000',
                    'usdtValue' => '9562.50'
                ],
                [
                    'coin' => 'USDT',
                    'available' => '10000.00000000',
                    'frozen' => '500.00000000',
                    'usdtValue' => '10500.00'
                ],
                [
                    'coin' => 'BGB',
                    'available' => '1500.00000000',
                    'frozen' => '0.00000000',
                    'usdtValue' => '1875.00'
                ],
                [
                    'coin' => 'SOL',
                    'available' => '50.00000000',
                    'frozen' => '10.00000000',
                    'usdtValue' => '3300.00'
                ],
                [
                    'coin' => 'ADA',
                    'available' => '2500.00000000',
                    'frozen' => '0.00000000',
                    'usdtValue' => '875.00'
                ],
                [
                    'coin' => 'DOGE',
                    'available' => '15000.00000000',
                    'frozen' => '0.00000000',
                    'usdtValue' => '1050.00'
                ],
                [
                    'coin' => 'XRP',
                    'available' => '3000.00000000',
                    'frozen' => '200.00000000',
                    'usdtValue' => '1600.00'
                ]
            ],
            'message' => '🧪 Modo Demo: Datos de ejemplo - Balance obtenido exitosamente'
        ];
    }

    /**
     * Generar firma para autenticación
     */
    protected function generateSignature($timestamp, $method, $requestPath, $body, $secretKey)
    {
        $prehash = $timestamp . strtoupper($method) . $requestPath . $body;
        return base64_encode(hash_hmac('sha256', $prehash, $secretKey, true));
    }

    /**
     * Obtener timestamp en milisegundos
     */
    protected function getTimestamp()
    {
        return (string) round(microtime(true) * 1000);
    }

    /**
     * Formatear el balance para visualización
     */
    public function formatBalance($balanceData)
    {
        $formatted = [];

        if (empty($balanceData)) {
            return $formatted;
        }

        foreach ($balanceData as $asset) {
            $available = floatval($asset['available'] ?? 0);
            $frozen = floatval($asset['frozen'] ?? 0);
            $total = $available + $frozen;

            // Solo mostrar activos con balance > 0
            if ($total > 0.00000001) {
                $formatted[] = [
                    'coin' => $asset['coin'] ?? 'N/A',
                    'available' => number_format($available, 8),
                    'frozen' => number_format($frozen, 8),
                    'total' => number_format($total, 8),
                    'usdValue' => isset($asset['usdtValue']) ? '$' . number_format(floatval($asset['usdtValue']), 2) : 'N/A'
                ];
            }
        }

        return $formatted;
    }
}
