<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Rate\GetRateRequest;

class RateController extends Controller
{
    public function getRate(GetRateRequest $request)
    {
        \Log::info('RateController getRate method called');
    }
}
