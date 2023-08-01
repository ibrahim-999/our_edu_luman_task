<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class UserTransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function userTransactions(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->transactionService->readProviders();
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json('No data is available for this research');
        }
    }
}
