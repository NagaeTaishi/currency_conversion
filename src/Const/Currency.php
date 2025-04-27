<?php

namespace Src\Const;

enum Currency: string
{
    case AUD = 'AUD';
    case CAD = 'CAD';
    case EUR = 'EUR';
    case GBP = 'GBP';
    case NZD = 'NZD';
    case USD = 'USD';

    public static function all(): array
    {
        return [
            self::AUD,
            self::CAD,
            self::EUR,
            self::GBP,
            self::NZD,
            self::USD,
        ];
    }
}
