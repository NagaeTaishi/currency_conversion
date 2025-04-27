<?php

namespace Src\Domain\ValueObjects;

final class CurrencyAmount
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->validate($amount);
        $this->amount = $this->format($amount);
    }

    public function value(): float
    {
        return $this->amount;
    }

    private function validate(float $amount): void
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Amount must be non-negative.');
        }
    }

    private function format(float $amount): float
    {
        return number_format($amount, 2, '.', '');
    }
}
