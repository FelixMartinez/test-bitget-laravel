<?php

namespace App\Http\Controllers;

use App\Services\BitgetService;
use Illuminate\Http\Request;

class BitgetController extends Controller
{
    protected $bitgetService;

    public function __construct(BitgetService $bitgetService)
    {
        $this->bitgetService = $bitgetService;
    }

    /**
     * Mostrar el balance de la cuenta de Bitget
     */
    public function showBalance(Request $request)
    {
        $activeAccount = $request->user()->activeBitgetAccount;

        if (!$activeAccount) {
            return view('bitget.balance', [
                'success' => false,
                'message' => 'No tienes una cuenta de Bitget configurada. Ve a "Mis Cuentas API" para agregar una.',
                'balances' => [],
                'hasNoAccount' => true
            ]);
        }

        $result = $this->bitgetService->getAccountBalance($activeAccount);

        $balances = [];
        if ($result['success']) {
            $balances = $this->bitgetService->formatBalance($result['data']);
        }

        return view('bitget.balance', [
            'success' => $result['success'],
            'message' => $result['message'],
            'balances' => $balances,
            'activeAccount' => $activeAccount,
            'hasNoAccount' => false
        ]);
    }

    /**
     * Actualizar el balance (AJAX)
     */
    public function refreshBalance(Request $request)
    {
        $activeAccount = $request->user()->activeBitgetAccount;

        if (!$activeAccount) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes una cuenta activa configurada'
            ], 400);
        }

        $result = $this->bitgetService->getAccountBalance($activeAccount);

        if ($result['success']) {
            $balances = $this->bitgetService->formatBalance($result['data']);
            return response()->json([
                'success' => true,
                'balances' => $balances,
                'message' => $result['message']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message']
        ], 400);
    }
}
