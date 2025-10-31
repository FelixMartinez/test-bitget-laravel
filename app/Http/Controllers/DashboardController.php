<?php

namespace App\Http\Controllers;

use App\Services\BitgetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    protected $bitgetService;

    public function __construct(BitgetService $bitgetService)
    {
        $this->bitgetService = $bitgetService;
    }

    public function index(Request $request)
    {
        $user = $request->user();

        // Estadísticas de cuentas
        $totalAccounts = $user->bitgetAccounts()->count();
        $activeAccount = $user->activeBitgetAccount;
        $demoAccounts = $user->bitgetAccounts()->where('is_demo', true)->count();
        $realAccounts = $totalAccounts - $demoAccounts;

        // Inicializar variables de balance
        $totalBalance = 0;
        $balanceChange = 0;
        $hasBalance = false;

        // Si hay una cuenta activa, obtener el balance
        if ($activeAccount) {
            // Cachear el balance por 5 minutos para no sobrecargar la API
            $cacheKey = "dashboard_balance_user_{$user->id}";

            $result = Cache::remember($cacheKey, 300, function () use ($activeAccount) {
                return $this->bitgetService->getAccountBalance($activeAccount);
            });

            if ($result['success'] && !empty($result['data'])) {
                $hasBalance = true;

                // Calcular balance total en USDT
                foreach ($result['data'] as $asset) {
                    $totalBalance += floatval($asset['usdtValue'] ?? 0);
                }

                // Obtener balance anterior (guardado hace 24h) para calcular cambio
                $yesterdayKey = "dashboard_balance_yesterday_user_{$user->id}";
                $yesterdayBalance = Cache::get($yesterdayKey, $totalBalance);

                // Calcular porcentaje de cambio
                if ($yesterdayBalance > 0) {
                    $balanceChange = (($totalBalance - $yesterdayBalance) / $yesterdayBalance) * 100;
                }

                // Guardar balance actual para comparación futura (cada 24h)
                if (!Cache::has($yesterdayKey)) {
                    Cache::put($yesterdayKey, $totalBalance, 86400); // 24 horas
                }
            }
        }

        return view('dashboard', [
            'totalAccounts' => $totalAccounts,
            'activeAccount' => $activeAccount,
            'realAccounts' => $realAccounts,
            'demoAccounts' => $demoAccounts,
            'totalBalance' => $totalBalance,
            'balanceChange' => $balanceChange,
            'hasBalance' => $hasBalance,
            'accountName' => $activeAccount ? $activeAccount->name : null,
            'isDemo' => $activeAccount ? $activeAccount->is_demo : false,
        ]);
    }
}
