<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Probando conexión con Bitget ===\n\n";

$service = new App\Services\BitgetService();
$result = $service->getAccountBalance();

echo "Success: " . ($result['success'] ? 'SI' : 'NO') . "\n";
echo "Message: " . $result['message'] . "\n";
echo "Data count: " . count($result['data']) . "\n\n";

if ($result['success'] && !empty($result['data'])) {
    echo "Primeros 3 activos:\n";
    $limited = array_slice($result['data'], 0, 3);
    print_r($limited);
} else {
    echo "Detalles del error:\n";
    print_r($result);
}
