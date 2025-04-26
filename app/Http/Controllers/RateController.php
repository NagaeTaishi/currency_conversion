<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Rate\GetRateRequest;
use Illuminate\Http\JsonResponse;
use Src\Domain\ValueObjects\CurrencyAmount;
use Src\UseCase\GetRateUseCase;

class RateController extends Controller
{
    public function getRate(GetRateRequest $request): JsonResponse
    {
        $amount = new CurrencyAmount($request->validated()['amount']);
        $use_case = resolve(GetRateUseCase::class);
        $rates = $use_case->call($amount);

        return response()->json([
            'status' => 'success',
            'data' => [
                'rates' => $rates,
            ],
        ]);
    }
}
