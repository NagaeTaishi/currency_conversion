<?php

namespace Src\UseCase;

use Src\Const\Currency;
use Src\Domain\Infrastructures\OpenExchangeClient;
use Src\Domain\ValueObjects\CurrencyAmount;

class GetRateUseCase
{
    public function __construct(private OpenExchangeClient $client)
    {
    }

    public function call(CurrencyAmount $amount)
    {
        $rates = $this->client->getRates();
        $currencies = Currency::all();

        $converted_rates = [];
        foreach ($currencies as $currency) {
            if (!array_key_exists($currency->value, $rates)) {
                $converted_rates[$currency->value] = null;
                continue;
            }

            $converted_amount = $amount->value() * $rates[$currency->value];
            $converted_rates[$currency->value] = (new CurrencyAmount($converted_amount))->value();
        }

        return $converted_rates;
    }
}


