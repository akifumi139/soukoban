<?php

declare(strict_types=1);

namespace App\Enums;

enum CartActionStatus: string
{
    case BRING_OUT = '持ち出し';
    case DELIVERY = '搬入';
    case REMOVAL = '撤去';
    case RETURN = '返品';
}
